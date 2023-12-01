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

    // protected $model = ConversationTopicFactory::class;
    // protected $fakerLocale = 'ru_RU';

    public function definition()
    {
      // $faker = Faker\Factory::create('ru_RU');
      // $this->faker-> locale('ru_RU');
        return [
            'user_id' => User::all()->random()->id,
            'topic' => $this->faker->realText($maxNbChars = 50, $indexSize = 2),
        ];
    }
}

// use App\Models\Post;
// use App\Models\User;
//
// class PostFactory extends Factory
// {
//     /**
//      * The name of the factory's corresponding model.
//      *
//      * @var string
//      */
//     protected $model = Post::class;
//
//     /**
//      * Define the model's default state.
//      *
//      * @return array
//      */
//     public function definition()
//     {
//         return [
//             'user_id' => function() {
//                 return User::factory()->create()->id;
//             },
//             'title' => $this->faker->sentence,
//             'content' => $this->faker->paragraph
//         ];
//     }
// }
