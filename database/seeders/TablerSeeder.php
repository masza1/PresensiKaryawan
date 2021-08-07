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
        $positions = [
            ['position_name' =>'Staff Junior Web Programmer', 'basic_salary' => 4300000, 'allowance' => 150000],
            ['position_name' =>'Staff Senior Web Programmer', 'basic_salary' => 5800000, 'allowance' => 200000],
            ['position_name' =>'Staff IT', 'basic_salary' => 4850000, 'allowance' => 150000]
        ];

        foreach ($positions as $value) {
            \App\Models\Position::create($value);
        }
        
        User::factory(2)->create();
        Employee::factory(10)->create();

    }
}
