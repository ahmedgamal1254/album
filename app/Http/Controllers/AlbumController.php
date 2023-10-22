<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Media;
use App\Http\Requests\StoreAlbumRequest;
use App\Http\Requests\UpdateAlbumRequest;
use Illuminate\Http\Request;

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

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $album=Album::with('media')->find($id);

        return view('show',compact('album'));
    }

    public function edit($id)
    {
        $album=Album::with('media')->find($id);

        return view("edit",compact("album"));
    }

    public function update(UpdateAlbumRequest $request, Album $album)
    {
        $album=Album::find($request->id);
        $album->name=$request->name;

        if($request->hasFile('images')){
            $album->addMultipleMediaFromRequest(['images'])
            ->each(function ($file) use ($album) {
                $file->toMediaCollection('images');
            });
        }

        $album->save();

        return redirect('/');
    }

    public function delete($id)
    {
        $album=Album::with('media')->find($id);

        if ($album) {
            $album = $album->toArray();
            $media=$album["media"];

            return view("delete", compact("album","media"));
        } else {
            // Album not found
            return "Album not found.";
        }
    }

    public function destroy(Request $request){
        if($request->has("album")){
            foreach($request->images as $image){

                $media = Media::find($image);
                $media->model_id=$request->album_id;
                $media->save();                
            }
        }
    }
}
