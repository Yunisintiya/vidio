<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jeonghan',
            'email' => 'jeonghan@gmail.com',
            'password' => bcrypt('Jeonghan06'),
        ]);

        User::create([
            'name' => 'Yuni',
            'email' => 'yunisintiya@gmail.com',
            'password' => bcrypt('SEVENTEEN'),
        ]);
    }
}