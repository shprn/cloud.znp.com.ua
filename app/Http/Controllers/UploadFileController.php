<?php
/**
 * Created by PhpStorm.
 * User: shapran
 * Date: 05.09.18
 * Time: 16:45
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Folder;

class UploadFileController extends Controller
{
    public function upload(Request $request) {

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