<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Disk;

class HomeController extends Controller
{
    //
    public function index() {

        $disks = Disk::allowed();

        //if (Auth::guest())
        //    return redirect()->route('login');
        if (count($disks) > 0)
            return redirect()->route('disk', ['disk' => reset($disks)->name, 'path' => '']);
        else
            return view("home")->with(['disks' => $disks]);
    }
}
