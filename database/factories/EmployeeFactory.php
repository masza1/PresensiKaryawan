<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['Laki-laki', 'Perempuan']);
        $positions = [
            ['position_name' =>'Staff Junior Web Programmer', 'basic_salary' => 4300000, 'allowance' => 150000],
            ['position_name' =>'Staff Senior Web Programmer', 'basic_salary' => 5800000, 'allowance' => 200000],
            ['position_name' =>'Staff IT', 'basic_salary' => 4850000, 'allowance' => 150000]
        ];
        array_rand($positions);
        return [
            'NIP' => random_int(0000, 9999),
            'name' => $this->faker->name(),
            'gender' => $gender,
            'place_of_birth' => $this->faker->city(),
            'position_name' => $positions[0]['position_name'],
            'basic_salary' => $positions[0]['basic_salary'],
            'allowance' => $positions[0]['allowance'],
            'birthdate' => $this->faker->date('Y-m-d', $max = 'now'),
            'user_id' => 1,
        ];
    }
}
