<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware'=>'web'], function(){
    Route::get('/', function() {
        return redirect("/".config("filesystems.default")."/storage");
    })->name("disk_default");

    // group disk/
    Route::group(['prefix' => '/{disk}', 'middleware'=>'checkdisk'], function() {
        Route::get('/storage/{path?}', 'Disk@index')->where('path', '.*');
        Route::get('/today', 'Disk@today');
        Route::get('/todayHome', 'Disk@todayHome');
        Route::post('/uploadFile', 'Disk@uploadFile');
    });
});

