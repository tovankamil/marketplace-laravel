<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@blue.com',
            'email_verified_at'=>now(),
            'password'=>bcrypt('12345678')
        ]);
        User::factory()->new()->count(15)->create();
    }
}
