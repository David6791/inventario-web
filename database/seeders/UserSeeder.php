<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Joaquin David',
            'phone' => '68403147',
            'email' => 'joaquin1837@gmail.com',
            'profile' => 'ADMIN',
            'status' => 'ACTIVE',
            'password' => bcrypt('asdasd123'),
        ]);
        User::create([
            'name' => 'David',
            'phone' => '68403147',
            'email' => 'david@gmail.com',
            'profile' => 'EMPLEADO',
            'status' => 'ACTIVE',
            'password' => bcrypt('asdasd123'),
        ]);
    }
}
