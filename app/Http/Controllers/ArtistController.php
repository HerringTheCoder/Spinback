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
    public function index(Request $request)
    {
        $query = Artist::query();

        if ($request->filled('query')) {
            $query->where('name', 'like', '%' . $request->input('query') . '%');
        }

        $artists = $query->simplePaginate(20);

        return view('metadata.artists.index')->with('artists', $artists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArtist $request)
    {
        $artist = $this->brainz->getArtist($request->input('id'));
        Artist::create([
            'id' => $artist->id,
            'name' => $artist->name,
            'country' => isset($artist->country) ? $artist->country : '',
            'description' => isset($artist->disambiguation) ? $artist->disambiguation : ''
        ]);
        return redirect()->route('artists.index')->with('success', __('artists.successfully stored'));
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
        $artists = $this->brainz->searchArtist($request->input('query'));
        return view('metadata.artists.results')->with('artists', $artists);
    }

    public function pick(Request $request)
    {
        $artist = $this->brainz->getArtist($request->input('id'));
        Artist::create([
            'id' => $artist->id,
            'name' => $artist->name,
            'country' => isset($artist->country) ? $artist->country : '',
            'description' => isset($artist->disambiguation) ? $artist->disambiguation : ''
        ]);
        return redirect()->route('artists.index')->with('success', 'Succesfully added new artist');
    }

    public function autocomplete(Request $request)
    {
        $artists = Artist::where('name', 'like', '%' . $request->input('query') . '%')->get();
        return [
            'results' => $artists->map(function ($item) {
                return ['name' => $item->name];
            })
        ];
    }
}
