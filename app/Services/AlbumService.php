<?php
namespace App\Services;

use App\Album;
use Bouncer;

class AlbumService
{

    public function destroy(Album $album): void
    {
        Disc::Where('album_id', $album)->update(array('album_id', NULL));
        $album->delete();
        return;
    }
}
