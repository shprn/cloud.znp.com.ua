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
    Route::get('/', "HomeController@index")->name("home");

    // group disk/
    Route::group(['prefix' => '/{disk}', 'middleware' => ['checkdisk', 'checkpath']], function($disk) {

        Route::get('/storage/{path?}', function() { return DiskController::index(); })->where('path', '.*')->name('disk');
        Route::post('/uploadFile', function() { return DiskController::uploadFiles(); });
        Route::post('/createDirectory/{path?}', function() { return DiskController::createDirectory(); })->where('path', '.*');
    });



});


Auth::routes();
