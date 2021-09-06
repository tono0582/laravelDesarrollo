<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition()
    {
        return [
			'id_empleado' => $this->faker->name,
			'codigo' => $this->faker->name,
			'nombres' => $this->faker->name,
			'apellidos' => $this->faker->name,
			'direccion' => $this->faker->name,
			'telefono' => $this->faker->name,
			'fecha_nacimiento' => $this->faker->name,
			'id_puesto' => $this->faker->name,
        ];
    }
}
