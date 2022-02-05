<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);
        User::findOrFail(2)->roles()->sync(2); //User with id 2 is test user and role 2 is also users permissions
        User::findOrFail(3)->roles()->sync(3); 
    }
}
