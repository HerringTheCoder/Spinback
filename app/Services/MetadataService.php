<?php
namespace App\Services;
use App\Metadata;
use Illuminate\Http\Request;
use Bouncer;

class MetadataService
{

    public function index()
    {
        $metadata = Metadata::All();
        return $metadata;
    }


    public function store(Request $request) :void
    {
        $metadata=new Metadata();
        $metadata->title = $request->input('title');
        $metadata->artist_id = $request->input('artist_id');
        $metadata->genre = $request->input('genre');
        $metadata->country = $request->input('country');
        $metadata->release_year = $request->input('release_year');
        $metadata->format = $request->input('format');
        $metadata->save();
        session()->flash('message', 'Metadata added successfully');
        return;
    }

    public function update(Metadata $metadata, Request $request) : void
    {
        $metadata->title = $request->input('title');
        $metadata->artist_id = $request->input('artist_id');
        $metadata->genre = $request->input('genre');
        $metadata->country = $request->input('country');
        $metadata->release_year = $request->input('release_year');
        $metadata->format = $request->input('format');
        $metadata->save();
        session()->flash('message', 'Metadata updated successfully');
        return;
    }


    public function destroy(Metadata $metadata) : void
    {

        $metadata->delete();
        session()->flash('message','Metadata deleted successfully');
        return;
    }

    public function validateUpdate(Request $request)
    {
        $request->validate([
            'title' => 'min:3|max:30',
            'artist_id' => 'exists',
            'genre' => 'string|min:3|max:15',
            'country' => 'string|max:20|min:3',
            'release_year' => 'date_format:"Y"',
            'format' =>'string',
        ]);
    }

    public function validateStore(Request $request)
    {
        $request->validate([
            'title' => 'min:3|max:30',
            'artist_id' => 'exists',
            'genre' => 'string|min:3|max:15',
            'country' => 'string|max:20|min:3',
            'release_year' => 'date_format:"Y"',
            'format' =>'string',
        ]);
    }

}
