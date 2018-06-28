<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'name'  => 'User',
            'email' => 'user@user.com'
        ]);

        factory(User::class, 10)->create();
    }
}
