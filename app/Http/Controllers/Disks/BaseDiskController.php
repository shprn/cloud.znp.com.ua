<?php

namespace App\Http\Controllers\Disks;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use App\Disk;
use App\Folder;

abstract class BaseDiskController extends Controller
{

    protected function getContextForms() {

        return ['createDirectoryForm', 'uploadFilesForm'];
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
        $folders = $this->getFolders();
        $files = $this->getFiles();
        $breadcrumbs = $this->getBreadcrumbs();
        $forms = $this->getContextForms();
        $links = $this->getContextLinks();

        return view("disk")->with([
                'disks' => $disks,
                'breadcrumbs' => $breadcrumbs,
                'folders' => $folders,
                'files' => $files,
                'forms' => $forms,
                'links' => $links
        ]);
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
        // folder from input
        $folder = new Folder(Request::input('disk'), Request::input('path'));

        $validator = Validator::make(Request::all(), [
            'nameDirectory' => 'required|max:100',
        ]);

        if ($validator->fails()) {
            return redirect(asset($folder->url))
                ->withErrors($validator);
        }

        $folder->createDirectory(Request::input('nameDirectory'));

        return redirect(asset($folder->url));
    }
}
