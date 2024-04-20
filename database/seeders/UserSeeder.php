<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            "name" => "Admin",
            "username" => "admin",
            "password" => bcrypt("4dm1n")
        ]);
        $petugas = User::create([
            "name" => "fikri",
            "username" => "sopo",
            "password" => bcrypt("s0p0s")
        ]);

        $admin->assignRole("admin");
        $petugas->assignRole("petugas");
    }
}
