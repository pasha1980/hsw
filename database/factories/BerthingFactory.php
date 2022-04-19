<?php


namespace Database\Factories;


use App\Models\File;
use App\Models\Port;
use App\Models\Ship;
use Illuminate\Database\Eloquent\Factories\Factory;

class BerthingFactory extends Factory
{

    public function definition()
    {
        return [
            'ship_id' => Ship::factory()->create()->id,
            'port_id' => Port::factory()->create()->id,
            'file_id' => File::factory()->create()->id,
            'dateStart' => $this->faker->dateTime(),
            'dateEnd' => $this->faker->dateTime(),
            'isLoad' => $this->faker->boolean(),
            'isShortage' => $this->faker->boolean(),
            'cargo' => $this->faker->shuffleString('qwertyuiopasdlfkghjnzvxcm'),
            'const' => $this->faker->randomNumber(),
        ];
    }
}
