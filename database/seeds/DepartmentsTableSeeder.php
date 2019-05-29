<?php

use Illuminate\Database\Seeder;
use App\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Department::class, 20)->create();
        $data =
            [
                [
                    'id' => 1,
                    'name' => 'LCA01',
                    'address'=>'Sejmowa 5C',
                    'city' => 'Legnica',
                    'phone_number' => 777666555
                ],

                [
                    'id' => 2,
                    'name' => 'LCA02',
                    'city' => 'Legnica',
                    'address' => 'Sejmowa 5D',
                    'phone_number' => 222333444
                ],

                [
                    'id'=>3,
                    'name'=>'BDG01',
                    'city' =>'Bydgoszcz',
                    'address' => 'Tragutta 15/4',
                    'phone_number' => 777999666
                ]


            ];

        foreach ($data as $row) {
            $model = Department::firstOrNew(["id" => $row["id"]]);
            $model->fill($row);
            $model->save();
        }
    }
}
