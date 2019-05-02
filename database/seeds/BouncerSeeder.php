<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Department;
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
        Bouncer::allow('manager')->everything();
        Bouncer::forbid('manager')->toManage(Department::class);
        Bouncer::allow('salesman')->everything();
        Bouncer::forbid('salesman')->toManage(User::class);
        Bouncer::forbid('salesman')->toManage(Department::class);
        Bouncer::forbid('salesman')->to('destroy', Transaction::class);
        Bouncer::forbid('deactivated')->everything();

    }
}
