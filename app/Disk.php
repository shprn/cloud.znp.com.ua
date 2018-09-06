<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disk
{
    // from config-array to class
    private static function assign($name, $values) {
        $class = new self;
        $class->{'name'}= $name;
        foreach($values as $key => $value){
            $class->{$key}= $value;
        }
        return $class;
    }

    // all disks
    public static function all()
    {
        $arrayDisks = config("filesystems.disks");
        foreach($arrayDisks as $name => &$disk) {
            $disk = self::assign($name, $disk);
        }

        return $arrayDisks;
    }

    // find disk by disk-name
    public static function find($diskName) {
        $arrayDisks = config("filesystems.disks");
        return self::assign($diskName, $arrayDisks[$diskName]);
    }

    // default disk
    public static function default()
    {
        return self::find(config("filesystems.default"));
    }
}
