<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class Folder extends Model
{
    //public $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    public $disk;
    public $path;
    public $name;
    public $url;

    // resize and cache file
    public static function cacheImage($diskName, $path)
    {

        // if not image
        $mimeType = Storage::disk($diskName)->mimeType($path);
        if(!$mimeType)
            return asset("img/file.png");
        else if (substr($mimeType, 0, 6) != "image/")
            return asset("img/file.png");


        // if image
        if (!Storage::disk($diskName)->exists("_cache/".$path))
        {
            $content = Storage::disk($diskName)->get($path);
            $img = Image::make($content)
                ->fit(350, 350, function ($constraint) {
                    $constraint->upsize();
                });

            Storage::disk($diskName)->put("_cache/" . $path, $img->encode());
        }

        return Storage::disk($diskName)->url("_cache/".$path);

    }

    //
    public static function cacheDisk($diskName)
    {
        $files = Storage::disk($diskName)->allFiles("");
        foreach($files as $file)
        {
            Folder::cacheImage($diskName, $file);
        }
    }

    //
    function __construct($diskName, $path="")
    {
        $this->disk = Disk::find($diskName);
        $this->path = $path;
        $this->name =  basename($path);
        $this->url = $this->disk->url. ($path == "" ? "" : "/".$path);
    }

    //
    public function getFiles()
    {
        $files = array_flip(Storage::disk($this->disk->name)->files($this->path));
        foreach($files as $cur_path => &$cur_params) {
            $arr = explode(".", $cur_path);
            $ext = array_pop($arr);
            if (strtolower($ext) == "db")
            {
                unset($files[$cur_path]);
                continue;
            }

            $cur_params = array();
            $names = explode("/", $cur_path);
            $cur_params['name'] = array_pop($names);
            $cur_params['url'] = Storage::disk($this->disk->name)->url($cur_path);
            $cur_params['url_image'] = Folder::cacheImage($this->disk->name, $cur_path);
        }

        ksort($files);

        return $files;
    }

    //
    public function getDirectories()
    {
        $directories = array_flip(Storage::disk($this->disk->name)->directories($this->path));
        foreach($directories as $cur_path => &$cur_params) {
            if ($cur_path == "_cache")
            {
                unset($directories[$cur_path]);
                continue;
            }

            $cur_params = array();
            $names = explode("/", $cur_path);
            $cur_params['name'] = array_pop($names);
            $cur_params['url'] = $this->disk->urlDirectory . ($cur_path == "" ? "" : "/" . $cur_path);
            $cur_params['empty'] = count(Storage::disk($this->disk->name)->directories($cur_path)) + count(Storage::disk($this->disk->name)->files($cur_path)) == 0 ? true : false;
        }

        if ($this->path == "")
            krsort($directories);
        else
            ksort($directories);

        return $directories;
    }

    //
    public function getLinks()
    {
        $links = array();

        // first element - project_name
        $path_elem = $this->disk->urlDirectory;
        $links[$this->disk->title] = $path_elem;

        $path_array = explode("/", $this->path);

        foreach($path_array as $elem)
        {
            if(empty($elem))
                continue;

            $path_elem .= "/".$elem;
            $links[$elem] = $path_elem;
        }

        return $links;
    }

    //
    public function createDirectory($name)
    {
        $path = $this->path=="" ? $name : $this->path."/".$name;
        if(!Storage::disk($this->disk->name)->exists($path))
            Storage::disk($this->disk->name)->makeDirectory($path);

        return new Folder($this->disk->name, $path);
    }

    //
    public function today()
    {
        return $this->createDirectory(Carbon::now()->toDateString());
    }

    //
    public function home()
    {
        return $this->createDirectory(config("filesystems.home_folder"));
    }

}
