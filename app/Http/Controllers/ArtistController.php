<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Http\Requests\UpdateArtist;
use App\Http\Requests\StoreArtist;
use Illuminate\Http\Request;
use App\Services\MusicbrainzService;

class ArtistController extends Controller
{
    public function __construct(MusicbrainzService $brainz)
    {
        $this->brainz = $brainz;
        $this->authorizeResource(Artist::class);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artists = Artist::all();
        return view('artists.index')->with('artists', $artists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtist $request)
    {
        Artist::create($request->validated());
        return redirect()->route('artists.index')->with('success', __('artists.successfully stored'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //TODO
        //Return view with edit form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtist $request, Artist $artist)
    {
        $artist->update($request->validated());
        return redirect()->route('artists.index')->with('success', __('artists.successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();
        return redirect()->action('ArtistController@index')->with('success', __('departments.successfully_deleted'));
    }

    public function search(Request $request)
    {
        $artists = $this->brainz->searchArtist($request->input('artist'));
        return view('artists.results')->with('data', $artists);
    }
}
