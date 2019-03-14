<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();
        $data =
            [
                [
                    'id' => 1,
                    'login' => 'admin',
                    'first_name' => 'Jan',
                    'last_name' => 'Kowalski',
                    'password' => Hash::make('secret'),
                    'email' => 'admin@mail.com',
                    'email_verified_at' => \Carbon\Carbon::createFromDate(2000,01,01)->toDateTimeString(),

                ]


            ];
        foreach ($data as $row) {
            $model = User::firstOrNew(["id" => $row["id"]]);
            Bouncer::assign('user')->to($model);
            $model->fill($row);
            $model->save();
        }
    }
}