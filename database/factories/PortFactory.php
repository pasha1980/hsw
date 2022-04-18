<?php


namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class PortFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->name()
        ];
    }
}