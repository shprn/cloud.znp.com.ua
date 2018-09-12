<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class Disk
{
    public $name = '';

    // from config-array to class
    private function fill($name, $values=null) {
        if(!$name)
            return;

        if(!$values)
            $values = config("filesystems.disks")[$name];

        if(!$values)
            return;

        $this->{'name'}= $name;
        foreach($values as $key => $value){
            $this->{$key}= $value;
        }

        return $this;
    }

    public static function current() {
        return new Disk(Request::route('disk'));
    }

    public static function default() {
        return new Disk(config("filesystems.default"));
    }

    public static function currentName() {
        $current = Disk::current();
        if($current)
            return $current->name;
        else
            return "";
    }

    // all disks
    public static function all()
    {
        $arrayDisks = config("filesystems.disks");
        foreach($arrayDisks as $name => &$disk) {
            $disk = (new Disk)->fill($name, $disk);
        }

        return $arrayDisks;
    }

    function __construct($diskName="") {
        if ($diskName)
            $this->fill($diskName);
    }

    public static function allowed()
    {
        if (Auth::guest()) {
            return array();
        }

        $disks = self::all();
        $disks = array_filter($disks, function ($elem) {
            return Auth::user()->can('read', $elem);
        });

        return $disks;
    }

}
