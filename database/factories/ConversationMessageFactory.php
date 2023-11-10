<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ConversationTopic;

class ConversationMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'conversation_topic_id' => ConversationTopic::all()->random()->id,
          'message' => $this->faker->sentence,
        ];
    }
}
