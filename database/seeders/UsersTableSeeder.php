<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \notes\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->count(50)->create();
    }
}
