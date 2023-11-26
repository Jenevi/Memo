<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\ConversationTopic;
use App\Models\ConversationMessage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatMessageController extends Controller
{
      public function __invoke()
      {
          // пользователь залогинен?
          $user = Auth::user();
          // если user не null, получаем conversationTopics,
          // иначе, получаем []
          $titles = $user ? $user->conversationTopics : [];
          return view('chat', ['user' => $user, 'titles' => $titles]);
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
      $message = ConversationMessage::find($request->input('message_id'));
      if ($message) {
          $message->delete();
          return response()->json(['status' => 'success']);
      }

      return response()->json(['status' => 'error', 'message' => 'Message not found'], 404);
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
