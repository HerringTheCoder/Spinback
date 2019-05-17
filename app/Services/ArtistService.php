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


    public function store(Request $request)
    {
        //TODO
    }

    public function update(Artist $artist, Request $request) : void
    {
        $artist->name= $request->input('name');
        $artist->country = $request->input('country');
        $artist->save();
        return;
    }


    public function destroy(Artist $artist) : void
    {

        $artist->delete();
        session()->flash('message','User deleted successfully');
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

    }

}
