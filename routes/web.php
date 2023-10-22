<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ProfileController;
use App\Models\Album;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $albums=Album::with('media')->get();
    
    return view('welcome',compact('albums'));
});

Route::get('/album', function () {
    return view('welcome');
});

Route::get('/create_album',[AlbumController::class,'create'])->name("create");
Route::post('/store_album',[AlbumController::class,'store'])->name("store");
Route::get('/album/edit/{id}',[AlbumController::class,'edit'])->name('edit');
Route::post('/album/update',[AlbumController::class,'update'])->name('update');
Route::get('/album/show/{id}',[AlbumController::class,'show'])->name('show');
Route::get('/album/del/{id}',[AlbumController::class,'delete'])->name('delete');
Route::post('/album/destroy',[AlbumController::class,'destroy'])->name('destroy');
