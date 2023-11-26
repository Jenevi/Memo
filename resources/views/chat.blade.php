
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Chat Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- получим токен CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- подключим CSS   -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>


<h2>Chat Messages</h2>

<div class='fixed top-0 right-0 px-6 py-4'>
  <a href="http://127.0.0.1:8080/Dashboard" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
</div>


<!-- контент первого столбца -->
<div class="column1">
  <!-- {{--    выводим заголовки диалогов--}} -->
  @foreach ($titles as $title)
    <div class='container darker hovered clickable-block' topic_id='{{ $title->id }}' id='{{ $title->topic }}'>
        <p class='clickable-block' topic_id='{{ $title->id }}' id='{{ $title->topic }}'>{{ $title->topic }}</p>
    </div>
  @endforeach
</div>


<div class="column2">
<!-- контент второго столбца -->

<!-- {{--    кнопка ввода новой реплики--}} -->
<form id="myForm1">
  <input type="text" name="message" placeholder="Введите сообщение">
  <!-- Предположим, что у вас есть скрытое поле для message_id -->
  <input type="hidden" name="message_id" value="123">
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
