<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'first_name' => $this->faker->lastName,
            'last_name' => $this->faker->firstName,
            'gender' => $this->faker->numberBetween(1,3),
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'building' => $this->faker->secondaryAddress,
            'detail' => $this->faker->realText(100),
        ];
    }
}
