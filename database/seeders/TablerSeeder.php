<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class TablerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            ['name' => 'Staff HRD', 'email' => 'staff@gmail.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => \Str::random(10)],
            ['name' => 'Supervisor HRD', 'email' => 'supervisor@gmail.com', 'email_verified_at' => now(), 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' => \Str::random(10)]
        ];
        
        foreach ($users as $value) {
            \App\Models\User::create($value);
        }
        
        Employee::factory(3)->create();
    }
}
