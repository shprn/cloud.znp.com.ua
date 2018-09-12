<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class File
{
    //
    public $folder;
    public $name;
    public $url;
    public $urlImage = "";
    public $infoImage = array();

    //
    function __construct($folder, $name)
    {
        $this->folder = $folder;
        $this->name = $name;
        $this->url = Storage::disk($this->diskName())->url($this->path());
    }

    //
    public function diskName() {
        if (!isset($this->folder->disk))
            return '';

        return $this->folder->disk->name;
    }

    //
    public function path() {
        if (!isset($this->folder))
            return '';

        return $this->folder->path . "/" . $this->name;
    }

    //
    public function getCacheImage() {
        // if not image
        $mimeType = Storage::disk($this->diskName())->mimeType($this->path());
        if(!$mimeType)
            return asset("img/file.png");
        else if (substr($mimeType, 0, 6) != "image/")
            return asset("img/file.png");

        // if image
        if (!Storage::disk($this->diskName())->exists("_cache/".$this->path()))
        {
            $content = Storage::disk($this->diskName())->get($this->path());
            $this->image = Image::make($content);

            $img = $this->image->fit(350, 350, function ($constraint) {
                    $constraint->upsize();
                });

            Storage::disk($this->diskName())->put("_cache/" . $this->path(), $img->encode());
        }

        return Storage::disk($this->diskName())->url("_cache/".$this->path());
    }

    public function withCacheImage() {
        $this->urlImage = $this->getCacheImage();
        return $this;
    }

    public function getInfoImage() {
        $mimeType = Storage::disk($this->diskName())->mimeType($this->path());
        if(!$mimeType)
            return array();
        else if ($mimeType != "image/jpeg")
            return array();

        $infoImage = exif_read_data(str_replace(' ', '%20', $this->url));
        return $infoImage;
    }

    public function withInfoImage() {
        $this->infoImage = $this->getInfoImage();
        return $this;
    }

}
