<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
            ],
            //Add 2 more users: customer (customer role) and user (role)
            [
                'name'           => 'Njabulo Ivan Cele',
                'email'          => 'ivan@test.com',
                'password'       => bcrypt('P@ssw0rd'),
            ],
            [
                'name'           => 'Customer Nene',
                'email'          => 'customer@test.com',
                'password'       => bcrypt('P@ssw0rd'),
            ],
        ];

        foreach($users as $user) User::create($user); 
        //Create vs insert, create auto manages created_at and updated_at, created_at can be useful on some cases
    }
}
