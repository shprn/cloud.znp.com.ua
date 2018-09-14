<?php

namespace App\Http\Controllers\Disks;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request;
use App\Disk;
use App\Folder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class GasArrivalDiskController extends BaseDiskController
{
    //
    protected function dateNameDirectory($date) {
        return $date->format('Y-m-d');
    }

    //
    protected function getAllowedDateNameDirectories() {
        return  [
            $this->dateNameDirectory(Carbon::today()),
            $this->dateNameDirectory(Carbon::today()->addDays(-1)),
            $this->dateNameDirectory(Carbon::today()->addDays(-2))
        ];
    }

    //
    protected function getAllowedAzsNameDirectories() {
        $names = array();
        $rights = Auth::user()->rights;

        foreach($rights as $right) {
            $arr = explode('/', $right->access_mask);
            if(count($arr) == 3)
                array_push($names, $arr[2]);
        }

        return $names;
    }

    //
    protected function getContextForms() {

        if(Auth::guest())
            return array();

        $forms = array();

        // create directory button
        $path = Folder::current()->path;
        $arrPath = explode('/', $path);

        // root directory
        if($path == '') {
            $forms = array_add($forms, 'createDirectoryButton', [
                'newNameDirectory' => $this->dateNameDirectory(Carbon::today()),
                'newNameDirectoryOptions' => $this->getAllowedDateNameDirectories(),
            ]);

        // 1 level - date directory
        } else if (count($arrPath) == 1) {

            $params = array('newNameDirectory' => '');
            if(!Auth::user()->admin)
                $params = array_add($params, 'newNameDirectoryOptions', $this->getAllowedAzsNameDirectories());

            $forms = array_add($forms, 'createDirectoryButton', $params);

        // 2 level - azs directory
        } else if (count($arrPath) == 2) {
            // upload files button
            $forms = array_add($forms, 'uploadFilesButton', []);
        }

        return $forms;
    }

}
