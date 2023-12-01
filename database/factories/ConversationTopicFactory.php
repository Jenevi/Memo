<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Faker\Generator as Faker;


class ConversationTopicFactory extends Factory
{
      /**
       * The name of the factory's corresponding model.
       *
      //  * @var string
      //  */
      // protected $model = ConversationTopic::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'topic' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
        ];
    }
}
