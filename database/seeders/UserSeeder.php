<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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

            // id 1
            'name'=>'Desarrollador' ,
            'email'=>'developer',
            'password'=>bcrypt('1234'),
        ]);
        User::create([
            // id 2
            'name'=>'Administrador' ,
            'email'=>'admin',
            'password'=>bcrypt('1234'),
        ]);

    }
}
