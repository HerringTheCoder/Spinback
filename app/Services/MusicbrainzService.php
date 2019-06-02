<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Exception\ClientException;

class MusicbrainzService
{
    const BRAINZ_URL = 'http://musicbrainz.org/ws/2/';
    const COVERART_URL =  'http://coverartarchive.org/';

    const USER_AGENT = 'Spinback/1.0';

    public function __construct()
    {
        $this->client = new Client([
            'headers' => [
                'User-Agent' => self::USER_AGENT,
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function searchArtist(string $name)
    {
        $url = self::BRAINZ_URL . 'artist?fmt=json';
        $query = "artist:{$name}";
        $res = $this->client->request('GET', $url, [
            'query' => [
                'query' => $query
            ]
        ]);
        return json_decode($res->getBody()->getContents())->artists;
    }

    public function getArtist(string $id)
    {
        $url = self::BRAINZ_URL . 'artist/' . $id . '?fmt=json';
        $res = $this->client->request('GET', $url);
        $contents = $res->getBody()->getContents();
        $decoded = json_decode($contents);
        return $decoded;
    }

    public function searchAlbum(string $name)
    {
        $url = self::BRAINZ_URL . 'release-group/?fmt=json';
        $query = "release:{$name}";
        $res = $this->client->request('GET', $url, [
            'query' => [
                'query' => $query
            ]
        ]);
        return json_decode($res->getBody()->getContents())->{'release-groups'};
    }

    public function getAlbum(string $id)
    {
        $url = self::BRAINZ_URL . 'release-group/' . $id . '?fmt=json&inc=artists genres';
        $res = $this->client->request('GET', $url);
        $contents = $res->getBody()->getContents();
        $decoded = json_decode($contents);
        return $decoded;
    }

    public function saveAlbumCover(string $id)
    {
        try {
            $url = self::COVERART_URL . 'release-group/' . $id . '/front-250';
            $res = $this->client->request('GET', $url);
            Storage::disk('public')->put('covers/' . $id . '.jpg', $res->getBody());
            return true;
        } catch (ClientException $e) {
            // Album cover is not present in database
            return false;
        }
    }
}
