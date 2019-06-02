<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Http\Requests\StoreArtist;
use Illuminate\Http\Request;
use App\Services\MetadataService;

class ArtistController extends Controller
{
    private $metadataService;

    public function __construct(MetadataService $metadataService)
    {
        $this->metadataService = $metadataService;
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
        $query->orderBy('name', 'asc');
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
        $this->metadataService->addArtist($request->input('id'));
        return redirect()->route('artists.index')->with('success', __('artists.successfully stored'));
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
        $artists = $this->metadataService->findArtists($request->input('query'));
        return view('metadata.artists.results')->with('artists', $artists);
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
