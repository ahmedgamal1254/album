<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use App\Models\Album;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $albums=Album::with('media')->get();
    
    // return $albums;
    return view('welcome',compact('albums'));
});

Route::get('/album', function () {
    return view('welcome');
});

Route::get('/create_album',[AlbumController::class,'create'])->name("create");
Route::post('/store_album',[AlbumController::class,'store'])->name("store");

