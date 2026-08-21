<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GeoVisitLog;

class GeoVisitLogFactory extends Factory
{
    protected $model = GeoVisitLog::class;

    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4,
            'country' => $this->faker->country,
            'city' => $this->faker->city,
            'timezone' => $this->faker->timezone,
            'browser' => $this->faker->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge']),
            'platform' => $this->faker->randomElement(['Windows', 'MacOS', 'Linux', 'Android', 'iOS']),
            'visited_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
