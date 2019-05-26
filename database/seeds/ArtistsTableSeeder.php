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
        $data =
            [
                [
                    'id' => 1,
                    'name' => 'Oscar Peterson',
                    'country' => 'Canada',
                    'description' => 'A famous jazz pianist'
                ],

                [
                'id' => 2,
                'name' => 'John Coltrane',
                'country' => 'USA',
                'description' => 'A famous hard-bop jazz saxophonist'
                ],


            ];

        foreach ($data as $row) {
            $model = Artist::firstOrNew(["id" => $row["id"]]);
            $model->fill($row);
            $model->save();
        }
    }
}
