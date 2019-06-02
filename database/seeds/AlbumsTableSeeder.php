<?php

use Illuminate\Database\Seeder;
use App\Album;
use App\Services\MusicbrainzService;

class AlbumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brainzService = new MusicbrainzService();

        $data = [
            [
                'id' => '07574c97-1763-332e-b197-8f0acde2497d',
                'title' => 'Lightbulb Sun',
                'artist_id' => '169c4c28-858e-497b-81a4-8bc15e0026ea',
                'genre' => '',
                'release_date' => '2000-05-01'
            ],
            [
                'id' => '85a9ae2a-6954-36ea-871b-44d0e1957265',
                'title' => 'Old Money',
                'artist_id' => '71297544-fd63-4c1f-8bac-5838ca201e3d',
                'genre' => '',
                'release_date' => '2008-11-10',
            ],
            [
                'id' => '94cfdc4c-5eb5-3b62-9dbe-8e051528c6e5',
                'title' => 'In Absentia',
                'artist_id' => '169c4c28-858e-497b-81a4-8bc15e0026ea',
                'genre' => 'progressive rock',
                'release_date' => '2002-09-24'
            ],
            [
                'id' => 'b1c5ea39-8f96-355b-bfe4-84a7805db75f',
                'title' => 'Insurgentes',
                'artist_id' => '3a51b862-0144-40f6-aa17-6aaeefea29d9',
                'genre' => 'experimental',
                'release_date' => '2008-11-26'
            ],
            [
                'id' => 'bca73156-8f32-3e56-8d83-2fb537b8fb6e',
                'title' => 'Fear of a Blank Planet',
                'artist_id' => '169c4c28-858e-497b-81a4-8bc15e0026ea',
                'genre' => 'rock',
                'release_date' => '2007-04-13'
            ],
            [
                'id' => 'c954158d-5b13-3498-a513-2acd90b634ab',
                'title' => 'Dotyk',
                'artist_id' => 'ca59a38e-cf39-4d95-ac03-b6ca4f43fd8f',
                'genre' => '',
                'release_date' => '1995-05-08'
            ]
        ];

        foreach ($data as $row) {
            $model = Album::firstOrNew(["id" => $row["id"]]);
            $model->fill($row);
            if ($brainzService->saveAlbumCover($row['id'])) {
                $model->cover = true;
            }
            $model->save();
        }
    }
}
