<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ConversationTopic;
use Faker\Generator as Faker;

class ConversationMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = ConversationMessageFactory::class;
     protected $fakerLocale = 'ru_RU';


    public function definition()
    {
      // $faker = Faker\Factory::create('ru_RU');
      // $this->faker-> locale('ru_RU');
        return [
          'conversation_topic_id' => ConversationTopic::all()->random()->id,
          'message' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
        ];
    }
}
