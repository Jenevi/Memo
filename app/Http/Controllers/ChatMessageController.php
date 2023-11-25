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

    // функция обновления таблицы реплик
    public function refreshTable(Request $request)
    {
      // в $request приходит id для ConversationTopic
      $topic = ConversationTopic::find($request->input('0'));
      $messages = ConversationMessage::where('conversation_topic_id', $request->input('0'))->get();
      return response()->json(['messages'=> $messages, 'topic' => $topic]);
    }

    public function deleteMessage(Request $request)
    {
      $message = ConversationMessage::find($request->input('0'));
      $message->delete();
      return response()->json($request);
    }

    public function addMessage(Request $request)
    {
      $message = new ConversationMessage;
      $message->message = $request->input('text');
      $message->conversation_topic_id = $request->input('topic_id');
      $message->save();
      return response()->json($request);
    }
}
