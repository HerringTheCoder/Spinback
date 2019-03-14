<?php

use Illuminate\Database\Seeder;
use App\User;
class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('admin')->everything();
        Bouncer::allow('manager')->toManage(User::class);
        Bouncer::forbid('user')->to('destroy', User::class);
        Bouncer::forbid('banned')->everything();

    }
}
