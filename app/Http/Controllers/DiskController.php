<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use Illuminate\Support\Facades\Storage;

class DiskController extends Controller
{
    // main index
    public function index($disk, $path = "")
    {
        $disks = config("filesystems.disks");
        $folder = new Folder($disk, $path);

        return view("disk")->with([
                'disks' => $disks,
                'disk' => $disk,
                'links' => $folder->links,
                'files' => $folder->files,
                'directories' => $folder->directories
        ]);
    }

    // today folder
    public function today(Request $request)
    {
        $folder = new Folder($request->route("disk"));
        return redirect(asset($folder->today()->url));
    }

    // today folder
    public function todayHome(Request $request)
    {
        $folder = new Folder($request->route("disk"));
        return redirect(asset($folder->today()->home()->url));
    }

    // upload file
    public function uploadFile(Request $request)
    {
        $folder = (new Folder($request->route("disk")))->today()->home();

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                Storage::disk($request->route("disk"))->put(
                    $folder->path . "/" . $file->getClientOriginalName(),
                    file_get_contents($file->getRealPath())
                );
            }
        }

        return redirect(asset($folder->url));
    }

}
