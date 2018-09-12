<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Disk;

class HomeController extends Controller
{
    //
    public function index() {

        $disks = Disk::allowed();

        if (count($disks) == 1)
            return redirect()->route("disk", [
                'disk' => array_shift($disks)->name,
                'path' => ""
            ]);

        return view("home")->with([
            'disks' => $disks,
            'disk' => ''
        ]);
    }
}
