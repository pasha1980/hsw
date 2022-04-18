<?php


namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class FileFactory extends Factory
{

    public function definition()
    {
        return [
            'path' => 'uploads/' . $this->faker->shuffleString('qwertyuiopasdfghjklzxcvbnm',)
        ];
    }
}
