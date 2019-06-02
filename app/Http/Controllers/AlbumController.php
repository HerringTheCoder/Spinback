<?php

namespace App\Http\Controllers;

use App\Services\AlbumService;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateAlbum;
use App\Http\Requests\StoreAlbum;
use App\Album;
use App\Services\MusicbrainzService;
use Carbon\Carbon;

class AlbumController extends Controller
{
    public function __construct(MusicbrainzService $brainz)
    {
        $this->brainz = $brainz;
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
        $albums = Album::with('artist')->get();
        return view('metadata.albums.index')->with('albums', $albums);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $albumData = $this->brainz->getAlbum($request->input('id'));
        $album = [
            'id' => $albumData->id,
            'title' => $albumData->title,
            'artist_id' => $albumData->{'artist-credit'}[0]->artist->id
        ];
        if (isset($albumData->{'first-release-date'})) {
            $album['release_date'] = Carbon::parse($albumData->{'first-release-date'});
        }
        if (!empty($albumData->genres)) {
            // Choose genre with the highest score
            $album['genre'] = array_reduce($albumData->genres, function ($a, $b) {
                return $a ? ($a->count > $b->count ? $a : $b) : $b;
            })->name;
        }
        if ($this->brainz->saveAlbumCover($albumData->id)) {
            $album['cover'] = true;
        }
        Album::create($album);
        return redirect()->route('albums.index')->with('success', __('metadata.successfully_stored'));
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
        // $album->delete();
        return redirect()->route('metadata.albums.index')->with('success', __('metadata.successfully_deleted'));
    }

    public function search(Request $request)
    {
        $albums = $this->brainz->searchAlbum($request->input('query'), $request->input('artist'));
        return view('metadata.albums.results')->with('albums', $albums);
    }
}
