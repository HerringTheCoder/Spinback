<?php

namespace App\Http\Controllers;

use App\Services\AlbumService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAlbum;
use App\Http\Requests\StoreAlbum;
use App\Album;

class AlbumController extends Controller
{
    public function __construct(AlbumService $album)
    {
        $this->album = $album;
        $this->authorizeResource(Album::class);
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::all();
        return view('metadata.albums.index')->with('albums', $albums);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlbum $request)
    {
        Album::create($request->validated());
        return redirect()->route('metadata.albums.index')->with('success', __('metadata.successfully_stored'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //TODO: Return view with edit form (probably not recommended)
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbum $request, Album $album)
    {
        $album->update($request->validated());
        return redirect()->route('metadata.albums.index')->with('success', __('metadata.successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $album->delete();
        return redirect()->route('metadata.albums.index')->with('success', __('metadata.successfully_deleted'));
    }
}
