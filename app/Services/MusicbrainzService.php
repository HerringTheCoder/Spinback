<?php

namespace App\Services;

class MusicbrainzService
{
    const BRAINZ_URL = 'http://musicbrainz.org/ws/2/';
    const COVERART_URL =  'http://coverartarchive.org/';

    const USER_AGENT = 'Spinback/1.0';

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client([
            'headers' => [
                'User-Agent' => self::USER_AGENT,
                'Accept' => 'application/json'
            ]
        ]);
    }

    public function searchArtist(string $name)
    {
        $url = self::BRAINZ_URL . 'artist';
        $query = "artist:{$name}";
        $res = $this->client->request('GET', $url, [
            'query' => [
                'query' => $query
            ]
        ]);
        return json_decode($res->getBody()->getContents())->artists;
    }
}
