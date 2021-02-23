<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

//Route::get('download', function () {
//    $url = 'https://cdn.logo.com/hotlink-ok/logo-social.png';
//    $file = file_get_contents($url);
//
//    $name = substr($url, strrpos($url, '/') + 1);
//    $fileName = time() . $name;
//    Storage::put($fileName, $file);
//    return 'done';
//});

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
