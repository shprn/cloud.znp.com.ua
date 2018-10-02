<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;

class Folder
{
    //public $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
    public $disk;
    public $path;
    public $name;
    public $url;
    public $empty = false;

    //
    function __construct($diskName, $path="")
    {
        $this->disk = new Disk($diskName);
        $this->path = $path;
        $this->name = self::getName($path);
        $this->url = $this->disk->urlDirectory. ($path == "" ? "" : "/".$path);
    }

    public static function current() {
        return new Folder(urldecode(Request::route("disk")), urldecode(Request::route("path")));
    }

    private static function getName($path) {
        $arrPath = explode('/', $path);
        return array_pop($arrPath);
    }

    public function pathWithDisk()
    {
        return $this->disk->name . ($this->path == "" ? "" : "/" . $this->path);
    }

    //
    public function getAllFiles()
    {
        $files = Storage::disk($this->disk->name)->files($this->path);
        $files = array_filter($files, function($elem) {
            $arr = explode(".", $elem);
            $ext = array_pop($arr);
            return strtolower($ext) != "db";
        });

        foreach($files as &$elem) {
            $arr =  explode("/", $elem);
            $elem = (new \App\File($this, array_pop($arr)))
                ->withCacheImage();
                //->withInfoImage();
        }

        usort($files, function ($elem1, $elem2) {
            return ($elem1->name > $elem2->name) ? 1 : -1;
        });

        return $files;
    }

    public function getAllowedFiles() {

        // any user
        return $this->getAllFiles();

        // guest
        if (Auth::guest())
            return array();

        if (Auth::user()->cant('read', $this))
            return array();

        $files = $this->getAllFiles();
        $files = array_filter($files, function ($elem) {
            return Auth::user()->can('read', $elem);
        });

        return $files;
    }

    //
    public function getAllDirectories()
    {

        $directories = Storage::disk($this->disk->name)->directories($this->path);

        // delete __cache directory
        $directories = array_filter($directories, function($elem) {
                return $elem != "_cache";
            });

        // string -> Folder
        foreach($directories as &$elem) {
            $elem = new Folder($this->disk->name, $elem);
        }

        if ($this->path == "") {
            usort($directories, function ($elem1, $elem2) {
                return ($elem1->name > $elem2->name) ? -1 : 1;
            });
        } else {
            usort($directories, function ($elem1, $elem2) {
                return ($elem1->name > $elem2->name) ? 1 : -1;
            });
        }


        return $directories;
    }

    public function getAllowedDirectories() {

        // any user
        return $this->getAllDirectories();

        // guest
        if (Auth::guest())
            return array();

        if (Auth::user()->cant('read', $this))
            return array();

        $folders = $this->getAllDirectories();
        $folders = array_filter($folders, function ($elem) {
            return Auth::user()->can('read', $elem);
        });

        return $folders;
    }

    //
    public function getBreadcrumbs()
    {
        $breadcrumbs = array();

        // first element - project_name
        $path_elem = $this->disk->urlDirectory;
        $breadcrumbs[0] = ['title' => $this->disk->title, 'url' => $path_elem];

        $path_array = explode("/", $this->path);

        foreach($path_array as $elem)
        {
            if(empty($elem))
                continue;

            $path_elem .= "/".$elem;
            array_push($breadcrumbs, ['title' => $elem, 'url' => $path_elem]);
        }

        return $breadcrumbs;
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
    public function root() {
        return new Folder($this->disk->name, '');
    }
}
