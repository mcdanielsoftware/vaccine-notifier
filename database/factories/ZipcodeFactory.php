<?php

namespace Database\Factories;

use App\Models\Zipcode;
use Illuminate\Database\Eloquent\Factories\Factory;

class ZipcodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Zipcode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'zipcode' => $this->faker->postcode,
            'lat' => $this->faker->latitude,
            'long' => $this->faker->longitude,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
        ];
    }
}
