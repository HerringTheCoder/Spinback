<?php

use Illuminate\Database\Seeder;
use App\Disc;

class DiscsTableSeeder extends Seeder
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
                    'metadata_id' => 1,
                    'condition' => 'used',
                    'photo_path' => 'example.jpg',
                    'offer_price' => 50,
                    'sold' => 0,
                    'department_id' => 1,
                ],

                [
                    'id' => 2,
                    'metadata_id' => 2,
                    'condition' => 'used',
                    'photo_path' => 'example.jpg',
                    'offer_price' => 30,
                    'sold' => 1,
                    'department_id' => 2,
                ],

            ];

        foreach ($data as $row) {
            $model = Disc::firstOrNew(["id" => $row["id"]]);
            $model->fill($row);
            $model->save();
        }
    }
}
