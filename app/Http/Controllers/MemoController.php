<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Title;
use App\Models\Note;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MemoController extends Controller
{
      public function __invoke()
      {
          // пользователь залогинен?
          $user = Auth::user();
          // если user не null, получаем Titles,
          // иначе, получаем []
          $titles = $user ? $user->Titles : [];
          return view('memo', ['user' => $user, 'titles' => $titles]);
      }

    // функция обновления таблицы реплик
    public function refreshTable(Request $request)
    {
      // в $request приходит id для Title
      $title = Title::find($request->input('0'));
      $notes = Note::where('title_id', $request->input('0'))->get();
      return response()->json(['notes'=> $notes, 'title' => $title]);
    }


    public function deleteNote(Request $request)
    {
      $note = Note::find($request->input('note_id'));
      if ($note) {
          $note->delete();
          return response()->json(['status' => 'success']);
      }

      return response()->json(['status' => 'error', 'note' => 'Note not found'], 404);
    }


    public function addNote(Request $request)
    {
      $note = new Note;
      $note->note = $request->input('text');
      $note->title_id = $request->input('title_id');
      $note->save();
      return response()->json($request);
    }

    public function addTitle(Request $request)
    {
      $title = new Title;
      $title->title = $request->input('text');
      $user = Auth::user();
      $title->user_id = $user->id;
      $title->save();
      return response()->json($title->id);
    }
}
