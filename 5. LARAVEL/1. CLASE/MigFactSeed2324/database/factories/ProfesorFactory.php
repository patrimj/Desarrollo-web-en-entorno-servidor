<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Parte;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profesor>
 */
class ProfesorFactory extends Factory
{
    //protected $model = Profesor::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'cargo' => $this->faker->randomElement(['profesor', 'jefe de estudios', 'tutor','guardián de la luz de Ellendhil']),
            'departamento' => $this->faker->randomElement(['Informática', 'Administración', 'Educación Física','Frío y Calor','Física o Química']),
            'edad' => rand(18,65),
            'observaciones' => $this->faker->text(100)
        ];
    }

    /**
     * 'afterMaking' se utiliza para definir acciones que se ejecutarán después de que se haya creado una instancia del modelo, pero antes de que se haya guardado en la base de datos.
     * 'afterCreating' se utiliza para definir acciones que se ejecutarán después de que se haya creado una instancia del modelo y esta haya sido guardada en la base de datos.
     */
    public function configure(): static
    {
        return $this
        ->afterCreating(function ($prof, $faker) {
            $numeroPartes = rand(0,5); // Cambia esto al número deseado de partes por profesor.
            Parte::factory($numeroPartes)->create(['idProfesor' => $prof->id]);
        })
        // ->afterMaking(function ($profesor, $faker) {
        //    // Hacemos lo que sea con los datos del modelo del profesor antes de guardarlo definitivamente en la base de datos.
        //    // $profesor->save();
        // })
        ;
    }
}
