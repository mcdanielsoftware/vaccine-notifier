<?php

namespace Database\Factories;

use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class SiteFactory extends Factory
{
    use WithFaker;

    protected $model = Site::class;


    public function definition(): array
    {
        return [
            'lat' => $this->faker->latitude,
            'long' => $this->faker->longitude,
            'url' => $this->faker->url,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'provider' => $this->faker->company,
            'time_zone' => $this->faker->timezone,
            'postal_code' => $this->faker->postcode,
            'appointments' => [],
            'provider_brand' => $this->faker->company,
            'carries_vaccines' => $this->faker->boolean,
            'appointment_types' => [],
            'provider_brand_id' => random_int(1, 10000),
            'provider_brand_name' => $this->faker->company,
            'provider_location_id' => random_int(1, 10000),
            'appointments_available' => $this->faker->boolean,
            'appointments_last_fetched' => now()->subMinutes(5),
            'appointments_last_modified' => now()->subMinutes(5),
            'appointments_available_all_doses' => $this->faker->boolean,
            'appointments_available_2nd_dose_only' => $this->faker->boolean,
        ];
    }
}
