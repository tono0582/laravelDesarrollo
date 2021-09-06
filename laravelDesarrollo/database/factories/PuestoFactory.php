<?php

namespace Database\Factories;

use App\Models\Puesto;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PuestoFactory extends Factory
{
    protected $model = Puesto::class;

    public function definition()
    {
        return [
			'id_puesto' => $this->faker->name,
			'puesto' => $this->faker->name,
        ];
    }
}
