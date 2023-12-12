
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
  <a href="http://127.0.0.1:8080/Dashboard" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
</div>


<!-- контент первого столбца -->
<div class="column1">

  <form id="myForm2">
    <input type="text" name="title" placeholder="Введите заголовок">
    <!-- Предположим, что у вас есть скрытое поле для note_id -->
    <input type="hidden" name="title_id" value="123">
    <button type="button" id="submitButton2">Отправить</button>
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
<form id="myForm1">
  <input type="text" name="message" placeholder="Введите сообщение">
  <!-- Предположим, что у вас есть скрытое поле для note_id -->
  <input type="hidden" name="note_id" value="123">
  <button type="button" id="submitButton1">Отправить</button>
</form>


<div class="table-container">
  <table id="dataTable" class="table_blur">
    <tr>
      <th>
        <div class="header-container">
          <span class="header-text">Messages</span>

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
