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

class ChatMessageController extends Controller
{
      public function __invoke()
      {
          // получим текущего пользовател
          $user = Auth::user();
          // получим все заголовки его диалогов
          // вытащив из коллекции значение 'header'
          $titles = $user->conversationTopics->pluck('topic');
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
          $titles = $user->conversationTopics->pluck('topic');
          return view('chat', ['user' => '$user', 'titles' => $titles]);
      }
}


// use Illuminate\Support\Facades\Auth;
//
//
// class ChatMessageController extends ControllerTitleOfDialogue
// {
//
//     public function __invoke()
//     {
//         $b = User::all();
//         // получим текущего пользователя
//         $user = Auth::user();
//         // получим все заголовки его диалогов
//         // вытащив из коллекции значение 'header'
//         $a = $user->titles_of_dialogues->pluck('header');
//         return view('testUser2', ['names' => $b, 'user' => $user, 'titles' => $a]);
//     }
//
//     public function store(Request $request)
//     {
//         // $input = $request->all();
//         $input = $request->input('text');
//
//         $input2 = $request->input('data');
//
//         $b = User::all();
//         // получим текущего пользователя
//         $user = Auth::user();
//         // получим все заголовки его диалогов
//         // вытащив из коллекции значение 'header'
//         $titles = $user->titles_of_dialogues->pluck('header');
//         return view('testUser2', ['names' => $b, 'user' => '$user', 'titles' => $titles]);
//     }
//
//
//     public function myMethod()
//     {
//         // Do some processing here...
//         return response()->json(['message' => 'Request received']);
//     }
//
//     public function refreshTable(Request $request)
//     {
//         // получим текущего пользователя
//         $user = Auth::user();
//
//         $title = $user->titles_of_dialogues()->where('header', $request->data)->first();
//         $names = $title->dialogues->pluck('text');
//
//         $content = "";
//         $length = count($names);
//         for ($i = 0; $i < $length; $i += 2) {
//             $item1 = $names[$i];
//             $item2 = ($i + 1 < $length) ? $names[$i + 1] : null;
//
//             $content .= "<div class='container darker'>
//                          <p>$item1</p>
//                          <span class='time-left'>11:05</span>
//                          </div>";
//             if ($item2 !== null) {
//                 $content .= "<div class='container'>
//                              <p>$item2</p>
//                              <span class='time-right'>11:02</span>
//                              </div>";
//             }
//         }
//         return response($content);
//     }
//
// }
