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
        factory(Disc::class, 100)->create();
    }
}
