<?php

use Illuminate\Database\Seeder;
use App\Artist;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'brainz_id' => '169c4c28-858e-497b-81a4-8bc15e0026ea',
                'name' => 'Porcupine Tree',
                'country' => 'GB'
            ],
            [
                'brainz_id' => '3a51b862-0144-40f6-aa17-6aaeefea29d9',
                'name' => 'Steven Wilson',
                'country' => 'GB',
                'description' => 'founder of Porcupine Tree'
            ],
            [
                'brainz_id' => '71297544-fd63-4c1f-8bac-5838ca201e3d',
                'name' => 'Omar Rodriguez-Lopez',
                'country' => 'US'
            ],
            [
                'brainz_id' => 'ca59a38e-cf39-4d95-ac03-b6ca4f43fd8f',
                'name' => 'Edyta Górniak',
                'country' => 'PL'
            ]
        ];

        foreach ($data as $row) {
            DB::table('artists')->insert($row);
        }
    }
}
