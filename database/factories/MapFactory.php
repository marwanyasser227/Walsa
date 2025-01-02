<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Map>
 */
class MapFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hub_id' => 1,
            'map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3454.0184209224353!2d31.213914624609533!3d30.03632937492766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1458475ce529aa21%3A0xcf87e4c9713407ef!2zQmFyYWggY28td29ya2luZyBzcGFjZSAtINio2LHYp9it!5e0!3m2!1sar!2seg!4v1735839658836!5m2!1sar!2seg',
           
        ];
    }
}
