<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BouncerSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        //$this->call(MetadataTableSeeder::class);
        //$this->call(DiscsTableSeeder::class);
    }
}
