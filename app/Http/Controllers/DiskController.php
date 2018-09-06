<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disk;
use App\Folder;

class DiskController extends Controller
{
    // main index
    public function index(Request $request)
    {
        $diskName = $request->route("disk");
        $path = $request->route("path");
        $folder = new Folder($diskName, $path);

        $links = $folder->getLinks();
        $files = $folder->getFiles();
        $directories = $folder->getDirectories();

        return view("disk")->with([
                'disks' => Disk::all(),
                'disk' => $diskName,
                'links' => $links,
                'files' => $files,
                'directories' => $directories
        ]);
    }

    // today folder
    public function today(Request $request)
    {
        $diskName = $request->route("disk");
        $folder = new Folder($diskName);
        return redirect(asset($folder->today()->url));
    }

    // today folder
    public function todayHome(Request $request)
    {
        $path = $request->route("path");
        $folder = new Folder($path);
        return redirect(asset($folder->today()->home()->url));
    }
}
