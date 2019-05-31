<?php

use Illuminate\Database\Seeder;
use App\Album;

class MetadataTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [
                [
                    'id' => 1,
                    'title' => "Seven steps to heaven",
                    'artist_id' => 1,
                    'genre' => 'jazz',
                    'country' => 'USA',
                    'release_year' => '1978',
                    'format' => 'Vinyl',
                ],

                [
                    'id' => 2,
                    'title' => "Kind of blue",
                    'artist_id' => 2,
                    'genre' => 'jazz',
                    'country' => 'Canada',
                    'release_year' => '1969',
                    'format' => 'Vinyl',
                ],

            ];

        foreach ($data as $row) {
            $model = Album::firstOrNew(["id" => $row["id"]]);
            $model->fill($row);
            $model->save();
        }
    }
}
