<?php

namespace App\Http\Controllers\Disks;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
use App\Disk;
use App\Folder;
use Carbon\Carbon;

class GasArrivalDiskController extends BaseDiskController
{
    //
    protected function getContextForms() {
        return ['uploadFilesForm'];
    }

    //
    public function uploadFiles() {

        $folder = new Folder(Disk::currentName());
        $folder = $folder->createDirectory(Carbon::today()->format("Y-m-d"));

        if (Request::hasFile('files')) {
            foreach (Request::file('files') as $file) {
                Storage::disk($folder->disk->name)->put(
                    $folder->path . "/" . $file->getClientOriginalName(),
                    file_get_contents($file->getRealPath())
                );
            }
        }

        return redirect(asset($folder->url));
    }


}
