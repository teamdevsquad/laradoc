<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create([
            'name'  => 'User',
            'email' => 'root@email.com'
        ]);

        factory(User::class, 10)->create();
    }
}
