<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
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
        $admin = User::create([
            'name'=>'yaman',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('password'), 
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        // $admin->assignRole('Admin');

        User::factory(10)->create();
    }
}
