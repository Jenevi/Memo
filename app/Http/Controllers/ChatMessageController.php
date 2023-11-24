<?php

namespace App\Http\Controllers;
//
use Illuminate\Http\Request;
//
// class ChatMessageController extends Controller
// {
//     //
// }


use App\Models\User;
use App\Models\ConversationTopic;
use App\Models\ConversationMessage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatMessageController extends Controller
{
      public function __invoke()
      {
          // получим текущего пользовател
          $user = Auth::user();
          // получим все заголовки его диалогов
          // вытащив из коллекции значение 'header'
          $titles = [];
          if ($user and $user->conversationTopics) {
            // $titles = $user->conversationTopics->pluck('topic');
            $titles = $user->conversationTopics;
          }
          return view('chat', [ 'user' => $user, 'titles' => $titles]);
      }

      public function store(Request $request)
      {
          // $input = $request->all();
          $input = $request->input('text');

          $input2 = $request->input('data');

          // получим текущего пользователя
          $user = Auth::user();
          // получим все заголовки его диалогов
          // вытащив из коллекции значение 'header'
          if ($user->conversationTopics) {
            $titles = $user->conversationTopics->pluck('topic');
          }

          return view('chat', ['user' => '$user', 'titles' => $titles]);
      }

    public function refreshTable(Request $request)
    {
       // получим текущего (залогиненного) пользователя
      $user = Auth::user();
      //         // получим все заголовки его диалогов
      //         // вытащив из коллекции значение 'topic'
      // $topic = $user->conversationTopics->where('topic', $request->input('0'));
      $topic = ConversationTopic::all()->where('id', $request->input('0'))->first();

      // $messages = ConversationMessage::all()->where('conversation_topic_id', $topic->first()->id);
      $messages = ConversationMessage::all()->where('conversation_topic_id', $request->input('0'));


      return response()->json(['messages'=> $messages, 'topic' => $topic, 'test' => $request]);
      // return response()->json($request);

    }

    public function deleteMessage(Request $request)
    {
      //  // получим текущего (залогиненного) пользователя
      // $user = Auth::user();
      // //         // получим все заголовки его диалогов
      // //         // вытащив из коллекции значение 'topic'
      // $topic = $user->conversationTopics->where('topic', $request->input('0'));
      //
      // $messages = ConversationMessage::all()->where('conversation_topic_id', $request->input('0'));
      Log::error($request);
      $message = ConversationMessage::all()->where('id', $request->input('0'))->first();

      $message->delete();


      return response()->json($request);

      // $user = User::find($id);
      // $user->delete();
    }
}
