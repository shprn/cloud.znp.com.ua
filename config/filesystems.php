<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'gas-arrival'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'gas-arrival' => [
            'driver' => 'local',
            'root' => '/home/shapran/azs-gaz',                                // phisical/path/to/dir
            'url' => env('APP_URL').'/gas-arrival-storage',             // ln -s in public dir
            'urlDirectory' => env('APP_URL').'/gas-arrival/storage',   // /[disk-name]/storage
            'visibility' => 'public',
            'title' => 'Слив газовоза',
            'controller' => '\App\Http\Controllers\Disks\GasArrivalDiskController',
        ],

        'azs-general' => [
            'driver' => 'local',
            'root' => '/home/shapran/azs-general',                            // phisical/path/to/dir
            'url' => env('APP_URL').'/azs-general-storage',             // ln -s in public dir
            'urlDirectory' => env('APP_URL').'/azs-general/storage',   // /[disk-name]/storage
            'visibility' => 'public',
            'title' => 'Общий вид АЗС',
            'controller' => '\App\Http\Controllers\Disks\DefaultDiskController',
        ],

        'office-general' => [
            'driver' => 'local',
            'root' => '/home/shapran/office-general',                            // phisical/path/to/dir
            'url' => env('APP_URL').'/office-general-storage',             // ln -s in public dir
            'urlDirectory' => env('APP_URL').'/office-general/storage',   // /[disk-name]/storage
            'visibility' => 'public',
            'title' => 'Головной офис',
            'controller' => '\App\Http\Controllers\Disks\DefaultDiskController',
        ],

    ],

    'home_folder' => 'azs-2-akim',
];
