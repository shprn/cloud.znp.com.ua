<?php

namespace App\Http\Controllers\Disks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use App\Disk;
use App\Folder;
use Illuminate\Support\Facades\Auth;

abstract class BaseDiskController extends Controller
{

    protected function getContextForms() {

        return ['createDirectoryButton' => [], 'uploadFilesButton' => []];
    }

    protected function getContextLinks() {
        $links = array();

        $folders = Folder::current()->root()->getAllowedDirectories();
        $folders = array_slice($folders, 0, 5);

        foreach($folders as $elem)
            $links[$elem->name] = $elem->url;

        return $links;
    }

    protected function getDisks() {
        return Disk::allowed();
    }

    protected function getFolders() {
        return Folder::current()->getAllowedDirectories();
    }

    protected function getFiles() {
        return Folder::current()->getAllowedFiles();
    }

    protected function getBreadcrumbs() {
        return Folder::current()->getBreadcrumbs();
    }

    // main index
    public function index()
    {
        $disks = $this->getDisks();
        //$folders = $this->getFolders();
        //$files = $this->getFiles();
        $breadcrumbs = $this->getBreadcrumbs();
        $forms = $this->getContextForms();
        $links = $this->getContextLinks();

        return view("index")->with([
                'disks' => $disks,
                'breadcrumbs' => $breadcrumbs,
                //'folders' => $folders,
                //'files' => $files,
                'forms' => $forms,
                'links' => $links
        ]);
    }

    //
    public function getFoldersJson() {
        $folders = $this->getFolders();

        $arr = array();
        foreach($folders as $folder) {
            array_push($arr, [
                'name' => $folder->name,
                'path' => $folder->path,
                'url' => $folder->url,
                'empty' => $folder->empty,
            ]);
        }

        return response()->json($arr);
    }

    //
    public function getFilesJson() {
        $files = $this->getFiles();
        $arr = array();
        foreach($files as $file) {
            array_push($arr, [
                'name' => $file->name,
                'url' => $file->url,
                'urlImage' => $file->urlImage,
                ]);
        }

        return response()->json($arr);
    }

    //
    public function getPropertiesFile() {
        $file = new \App\File(Folder::current(), Request::input('file'));
        return response()->json($file->getInfoImage());
    }

    //
    public function uploadFiles() {
        // folder from input
        $folder = new Folder(Request::input('disk'), Request::input('path'));

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

    //
    public function createDirectory() {

        $validator = Validator::make(Request::all(), [
            'nameDirectory' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator);
        }

        $folder = new Folder(Request::route('disk'), Request::route('path'));

        $folder = $folder->createDirectory(Request::input('nameDirectory'));

        return redirect(asset($folder->url));
    }
}
