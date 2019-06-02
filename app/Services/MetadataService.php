<?php

namespace App\Services;

use App\Artist;
use App\Exceptions\ArtistNotFoundException;
use Carbon\Carbon;
use App\Album;
use App\Disc;

class MetadataService
{
    public function __construct(MusicbrainzService $brainz)
    {
        $this->brainz = $brainz;
    }

    public function addAlbum(string $id)
    {
        $albumData = $this->brainz->getAlbum($id);
        $artistId = $albumData->{'artist-credit'}[0]->artist->id;
        if (!Artist::where('id', $artistId)->exists()) {
            throw new ArtistNotFoundException();
        }
        $album = [
            'id' => $albumData->id,
            'title' => $albumData->title,
            'artist_id' => $albumData->{'artist-credit'}[0]->artist->id
        ];
        if (isset($albumData->{'first-release-date'})) {
            $album['release_date'] = Carbon::parse($albumData->{'first-release-date'});
        }
        if (!empty($albumData->genres)) {
            $album['genre'] = $this->findHighestScoreGenre($albumData->genres);
        }
        if ($this->brainz->saveAlbumCover($albumData->id)) {
            $album['cover'] = true;
        }
        Album::create($album);
    }

    public function deleteAlbum(Album $album)
    {
        Disc::where('album_id', $album)->update(['album_id' => null]);
        $album->delete();
    }

    public function addArtist(string $id)
    {
        $artist = $this->brainz->getArtist($id);
        Artist::create([
            'id' => $artist->id,
            'name' => $artist->name,
            'country' => isset($artist->country) ? $artist->country : '',
            'description' => isset($artist->disambiguation) ? $artist->disambiguation : ''
        ]);
    }

    public function findAlbums(string $query)
    {
        return $this->brainz->searchAlbum($query);
    }

    public function findArtists(string $query)
    {
        return $this->brainz->searchArtist($query);
    }

    private function findHighestScoreGenre(array $genres)
    {
        return array_reduce($genres, function ($a, $b) {
            return $a ? ($a->count > $b->count ? $a : $b) : $b;
        })->name;
    }
}
