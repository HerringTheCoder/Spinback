<?php
namespace App\Services;
use App\Artist;
use Illuminate\Http\Request;
use Bouncer;

class ArtistService
{

    public function index()
    {
        $artist = Artist::All();
        return $artist;
    }


    public function store(Request $request) :void
    {
        $artist=new Artist();
        $artist->name = $request->input('name');
        $artist->country = $request->input('country');
        $artist->description= $request->input('description');
        $artist->save();
        session()->flash('message', 'Artist added successfully');
        return;
    }

    public function update(Artist $artist, Request $request) : void
    {
        $artist->name= $request->input('name');
        $artist->country = $request->input('country');
        $artist->description = $request->input('description');
        $artist->save();
        return;
    }


    public function destroy(Artist $artist) : void
    {

        $artist->delete();
        session()->flash('message','Artist deleted successfully');
        return;
    }

    public function validateUpdate(Request $request)
    {
        $request->validate([
            'name' => 'min:3|max:20',
            'country' => 'min:3|max:20',
        ]);
    }

    public function validateStore(Request $request)
    {
        $request->validate([
            'name' => 'min:3|max:25',
            'country' => 'min:3|max:20',
            'description' => 'max:250'
        ]);
    }

}
