<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Services\ArtistService;
use Illuminate\Http\Request;

class ArtistController extends Controller
{

    public function __construct(ArtistService $artist)
    {
        $this->artist = $artist;
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
        $artists=$this->artist->index();
        $message = session('message');
        return view('test.artists.panel')->with('artists', $artists)->with('message', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO
        //return view with creation form here
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->artist->validateStore($request);
        $this->artist->store($request);
        return redirect()->action('ArtistController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        return view('test.artists.profile')->with('artist', $artist);
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
    public function update(Request $request, Artist $artist)
    {
        $this->artist->validateUpdate($request);
        $this->artist->update($artist, $request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        $this->artist->destroy($artist);
        return redirect()->action('ArtistController@index');
    }
}
