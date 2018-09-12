<?php

namespace App\Http\Controllers\Disks;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Facade;
use App\Disk;

class DiskController extends Facade
{

    protected static function getFacadeAccessor() {
        $disk = Disk::current();

        if(!$disk)
            $disk = Disk::default();

        return $disk->controller;
    }
}
