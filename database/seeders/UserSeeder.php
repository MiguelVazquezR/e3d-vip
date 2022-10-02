<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            [
                'name' => 'Administrador',
                'email' => 'miguelvz26.mv@gmail.com',
                'rfc' => 'varm123',
                'bussines_name' => 'e3d-vip',
                'phone_number' => '3312155731',
                'email_verified_at' => now(),
                'password' => bcrypt('123123123'),
                'remember_token' => Str::random(10),
                'is_admin' => 1,
                'created_at' => now(),
            ],
        ));
    }
}
