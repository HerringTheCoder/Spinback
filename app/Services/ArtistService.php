<?php
namespace App\Services;
use App\Artist;
use Illuminate\Http\Request;
use App\Metadata;


class ArtistService
{

    public function destroy(Artist $artist) : void
    {
       Metadata::where('artist_id', $artist->id)->update(array('artist_id',NULL));
        $artist->delete();
        return;
    }

}
