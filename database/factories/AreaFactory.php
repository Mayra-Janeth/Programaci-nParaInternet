<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @var string
     */
    protected $model = Area::class;
   
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_area' => $this->faker->words(4,true),
            'titular' => $this->faker->name(),
            'informacion' => $this->faker->sentence(),
            'telefono' => $this->faker->phoneNumber(),
        ];
    }
}
