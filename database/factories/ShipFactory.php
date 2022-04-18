<?php


namespace Database\Factories;


use App\Models\Port;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->streetName(),
            'imo' => $this->faker->numerify(),
            'residence' => 'UA',
            'residence_port' => Port::factory()->create()->getAttribute('id')
        ];
    }
}
