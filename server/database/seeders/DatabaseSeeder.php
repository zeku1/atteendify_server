<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // User::create([
        //     'name' => 'Admintify',
        //     'email' => 'admin@attendify.systems',
        //     'password' => 'attendify_password'
        // ]);

       Teacher::factory()
            ->count(5)
            ->create();

        Student::factory()
            ->count(5)
            ->create();
    }
}
