
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Memo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- получим токен CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- подключим CSS   -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>


<h2>Memo</h2>


<div class='fixed top-0 right-0 px-6 py-4'>
  <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit">Logout</button>
  </form>
</div>


<!-- контент первого столбца -->
<div class="column1">

  <form id="addTitleForm">
    <input type="text" name="title" placeholder="Input title" class='inpF'>
    <!-- Предположим, что у вас есть скрытое поле для note_id -->
    <input type="hidden" name="title_id" class='inpF'>
    <button type="button" id="addTitleButton" class='inpF'>Add title</button>
  </form>


  <!-- {{--    выводим заголовки диалогов--}} -->
  @foreach ($titles as $title)
    <div class='container darker hovered clickable-block' title_id='{{ $title->id }}' id='{{ $title->title }}'>
        <p class='clickable-block' title_id='{{ $title->id }}' id='{{ $title->title }}'>{{ $title->title }}</p>
    </div>
  @endforeach
</div>


<div class="column2">
<!-- контент второго столбца -->

<!-- {{--    кнопка ввода новой реплики--}} -->
<form id="addNoteForm">
  <input type="text" name="message" placeholder="Input note" class='inpF'>
  <!-- Предположим, что у вас есть скрытое поле для note_id -->
  <input type="hidden" name="note_id" class='inpF'>
  <button type="button" id="addNoteButton" class='inpF'>Add note</button>
</form>


<div class="table-container">
  <table id="dataTable" class="table_blur">
    <tr>
      <th>
        <div class="header-container">
          <span class="header-text">Notes</span>

        </div>
      </th>
    </tr>
    <!-- Содержимое таблицы будет вставлено сюда с помощью JavaScript -->
  </table>
</div>


<!-- подключим библиотеку jquery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
