<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        $album=new Album();
        $album->name=$request->name;

        $album->addMultipleMediaFromRequest(['images'])
        ->each(function ($file) use ($album) {
            $file->toMediaCollection('images');
        });

        $album->save();

    return response()->json('Images uploaded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $album=Album::find($id)->with('media')->first();
    
        $res=json_encode($album);
        $json=json_decode($res,true);

        return view('show',compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlbumRequest $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
