<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => 'admin',
                'avatar' => 'img\default.svg',
                'is_admin' => 'yes'
            ]
        );
    }
}