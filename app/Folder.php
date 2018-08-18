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
    public $disk_title;
    public $path;
    public $name;
    public $url;
    public $directories;
    public $files;
    public $links;

    // resize and cache file
    public static function cacheImage($disk, $path)
    {

        // if not image
        $mimeType = Storage::disk($disk)->mimeType($path);
        if(!$mimeType)
            return asset("img/file.png");
        else if (substr($mimeType, 0, 6) != "image/")
            return asset("img/file.png");


        // if image
        if (!Storage::disk($disk)->exists("_cache/".$path))
        {
            $content = Storage::disk($disk)->get($path);
            $img = Image::make($content)
                ->fit(250, 250, function ($constraint) {
                    $constraint->upsize();
                });

            Storage::disk($disk)->put("_cache/" . $path, $img->encode());
        }

        return Storage::disk($disk)->url("_cache/".$path);

    }

    //
    public static function cacheDisk($disk)
    {
        $files = Storage::disk($disk)->allFiles("");
        foreach($files as $file)
        {
            Folder::cacheImage($disk, $file);
        }
    }

    //
    function __construct($disk, $path="")
    {
        $disks = config("filesystems.disks");
        $this->disk = $disk;
        $this->disk_title = $disks[$disk]['title'];
        $this->path = $path;
        $this->name =  basename($path);
        //$this->url =  Storage::disk($disk)->url($path);
        $this->url = $disks[$disk]['url-directory']. ($path == "" ? "" : "/".$path);

        $this->getDirectories();
        $this->getFiles();
        $this->getLinks();
    }

    //
    protected function getFiles()
    {
        $this->files = array_flip(Storage::disk($this->disk)->files($this->path));
        foreach($this->files as $cur_path => &$cur_params) {
            $arr = explode(".", $cur_path);
            $ext = array_pop($arr);
            if (strtolower($ext) == "db")
            {
                unset($this->files[$cur_path]);
                continue;
            }

            $cur_params = array();
            $names = explode("/", $cur_path);
            $cur_params['name'] = array_pop($names);
            $cur_params['url'] = Storage::disk($this->disk)->url($cur_path);
            $cur_params['url_image'] = Folder::cacheImage($this->disk, $cur_path);
        }

        ksort($this->files);
    }

    //
    protected function getDirectories()
    {
        $disks = config("filesystems.disks");
        $this->directories = array_flip(Storage::disk($this->disk)->directories($this->path));
        foreach($this->directories as $cur_path => &$cur_params) {
            if ($cur_path == "_cache")
            {
                unset($this->directories[$cur_path]);
                continue;
            }

            $cur_params = array();
            $names = explode("/", $cur_path);
            $cur_params['name'] = array_pop($names);
            $cur_params['url'] = $disks[$this->disk]['url-directory'] . ($cur_path == "" ? "" : "/" . $cur_path);
            $cur_params['empty'] = count(Storage::disk($this->disk)->directories($cur_path)) + count(Storage::disk($this->disk)->files($cur_path)) == 0 ? true : false;
        }

        if ($this->path == "")
            krsort($this->directories);
        else
            ksort($this->directories);
    }

    //
    protected function getLinks()
    {
        $this->links = array();

        $disks = config("filesystems.disks");
        // first element - project_name
        $path_elem = $disks[$this->disk]['url-directory'];
        $this->links[$this->disk_title] = $path_elem;

        $path_array = explode("/", $this->path);

        foreach($path_array as $elem)
        {
            if(empty($elem))
                continue;

            $path_elem .= "/".$elem;
            $this->links[$elem] = $path_elem;
        }

    }

    //
    public function createDirectory($name)
    {
        $path = $this->path=="" ? $name : $this->path."/".$name;
        if(!Storage::disk($this->disk)->exists($path))
            Storage::disk($this->disk)->makeDirectory($path);

        return new Folder($this->disk, $path);
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
