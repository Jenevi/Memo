<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Note;
use App\Models\Title;
use Faker\Generator as Faker;

class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        return [
          'title_id' => Title::all()->random()->id,
          'note' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
        ];
    }
}
