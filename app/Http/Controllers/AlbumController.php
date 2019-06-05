<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\Services\MetadataService;
use App\Exceptions\ArtistNotFoundException;

class AlbumController extends Controller
{
    public function __construct(MetadataService $metadataService)
    {
        $this->metadataService = $metadataService;
        $this->authorizeResource(Album::class);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Album::query();
        if ($request->filled('query')) {
            $query->where('title', 'like', '%' . $request->input('query') . '%');
        }
        $query->orderBy('title', 'asc');
        $query->with('artist');
        $albums = $query->simplePaginate(20);
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
        try {
            $this->metadataService->addAlbum($request->input('id'));
        } catch (ArtistNotFoundException $e) {
            return redirect()->route('albums.index')->with('error', __('metadata.artist_exception'));
        }
        return redirect()->route('albums.index')->with('success', __('metadata.successfully_stored'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Metadata  $metadata
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        $this->metadataService->deleteAlbum($album);
        return redirect()->route('albums.index')->with('success', __('metadata.successfully_deleted'));
    }

    public function import(Request $request)
    {
        $albums = $this->metadataService->findAlbums($request->input('query'));
        return view('metadata.albums.results')->with('albums', $albums);
    }

    public function search(Request $request)
    {
        $albums = Album::where('title', 'like', '%' . $request->input('query') . '%')
            ->with('artist')
            ->take(10)
            ->get();
        return [
            'results' => $albums->map(function ($item) {
                $result = [
                    'id' => $item->id,
                    'title' => $item->title,
                    'artist' => $item->artist->name
                ];
                if ($item->cover) {
                    $result['image'] = $item->image();
                }
                return $result;
            })
        ];
    }
}
