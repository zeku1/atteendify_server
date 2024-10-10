<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
     /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Student::class;
    /**
    * 
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'school_id' => $this->generateRandomId(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'password' => 'password',
            'isEnrolled' => $this->faker->boolean(),
        ];
    }

    private function generateRandomId(){

        $part1 = str_pad(random_int(18, 24), 2, '0', STR_PAD_LEFT);

        $part2 = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

        $part3 = str_pad(random_int(0, 999), 3, '0', STR_PAD_LEFT);

        return "{$part1}-{$part2}-{$part3}";
    }
}
