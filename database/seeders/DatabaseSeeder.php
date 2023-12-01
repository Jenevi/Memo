<?php

// namespace Database\Seeders;
//
// use Illuminate\Database\Seeder;
//
// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      *
//      * @return void
//      */
//     public function run()
//     {
//         // \App\Models\User::factory(10)->create();
//
//     }
// }

//
namespace Database\Seeders;

use App\Models\User;
use App\Models\ConversationTopic;
use App\Models\ConversationMessage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Создаем 5 пользователей
        // User::factory(10)
        //     ->has(ConversationTopic::factory()->count(rand(3, 4)), 'conversationTopics')
        //     ->create();

        User::factory(5)
        ->has(ConversationTopic::factory()
            ->count(3)
            ->has(ConversationMessage::factory()->count(40))
        )
        ->create();
    }
}
