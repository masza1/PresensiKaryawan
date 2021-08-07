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
        $position_id = $this->faker->randomElement([1,2,3]);

        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $gender,
            'place_of_birth' => $this->faker->city(),
            'birthdate' => $this->faker->date('Y-m-d', $max = 'now'),
            'user_id' => 1,
            'position_id' => $position_id,
        ];
    }
}
