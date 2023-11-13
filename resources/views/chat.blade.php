
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chat Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    margin: 0 auto;
    max-width: 1600px;
    padding: 0 20px;
}

.container {
    border: 2px solid #dedede;
    background-color: #f6d2e5;
    border-radius: 5px;
    padding: 10px;
    margin: 10px 0;
    word-wrap: break-word;
}

.darker {
    border-color: #ccc;
    background-color: #ddd;
    word-wrap: break-word;
    position: relative;
    left: -20px; /* Смещение вправо на -20 пикселей */
}

.container::after {
    content: "";
    clear: both;
    display: table;
}

.container img {
    float: left;
    max-width: 60px;
    width: 100%;
    margin-right: 20px;
    border-radius: 50%;
}

.container img.right {
    float: right;
    margin-left: 20px;
    margin-right:0;
}

.time-right {
    float: right;
    color: #aaa;
}

.time-left {
    float: left;
    color: #999;
}

 .column1 {
     width: 30%; /* каждый столбец занимает половину ширины родителя */
     float: left; /* элементы "плавают" слева */
     box-sizing: border-box; /* чтобы padding не увеличивал размер элемента */
     padding: 10px; /* небольшой отступ внутри столбца */
 }

.column2 {
    width: 70%; /* каждый столбец занимает половину ширины родителя */
    float: left; /* элементы "плавают" слева */
    box-sizing: border-box; /* чтобы padding не увеличивал размер элемента */
    padding: 10px; /* небольшой отступ внутри столбца */
}

.hovered:hover {
    background-color: #96aa96;
}

.clickable-block {
    cursor: pointer;
    /* ... any other styles to make them visually appealing ... */
}

.clickable-block:hover {
    background-color: #f0f0f0;  /* Example hover effect */
}


.table_blur {
  background: #f5ffff;
  border-collapse: separate; /* Отключаем слияние границ */
  border-spacing: 5px; /* Убираем расстояние между ячейками */
  text-align: left;
}

.table_blur th,
.table_blur td {
  border: 1px solid #e3eef7;
  padding: 10px 15px;
  position: relative;
  transition: all 0.5s ease;
}

/* Скругляем углы у первых и последних ячеек в строках для достижения эффекта скругленной таблицы */
.table_blur th:first-child,
.table_blur td:first-child {
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
}

.table_blur th:last-child,
.table_blur td:last-child {
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
}

/* Дополнительные стили для th */
.table_blur th {
  border-top: 1px solid #777777;
  border-bottom: 1px solid #777777;
  /* Остальные стили */
}

.table_blur tr:nth-child(even) td {
  background-color: #e6f7ff; /* Цвет фона для ячеек в четных строках */
}

/* Дополнительные стили для td */
.table_blur td {
  /* Остальные стили */
}


.table-container {  /* контейнер для прокрутки
  height: 300px; /* Высота контейнера, может быть любой, в зависимости от вашего дизайна */
  overflow-y: scroll; /* Включаем вертикальную прокрутку */
  display: flex;
  flex-direction: column-reverse; /* Переворачиваем порядок элементов, чтобы новые элементы появлялись снизу */
}




</style>
</head>
<body>

<h2>Chat Messages</h2>

{{--подключим библиотеку jquery--}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- контент первого столбца -->
<div class="column1">

{{--    выводим заголовки диалогов--}}
    <?php
    /**
     * @var string $titles
     */
            foreach ($titles as $title){
                $escapedTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');  // экранирование символов
                echo "
                    <div class='container darker hovered clickable-block' id='$escapedTitle'>
                    <p class='clickable-block' id='$escapedTitle'>$title</p>
                    </div>
                ";
            }
       ?>

</div>


<div class="column2">
    <!-- контент первого столбца -->

<!-- {{--    кнопка ввода новой реплики--}} -->
    <div id="chatbox"></div>

    <form method="POST" action="/ChatMessage">
        @csrf
        <input type="text" name="text">
        <button type="submit">Отправить</button>
    </form>

    <div id="messagesContainer"></div>

    <!-- здесь должна быть таблица реплик -->

    <div class="table-container">
      <table id="dataTable" class = 'table_blur'>
        <tr>
            <th>Messages</th>
        </tr>
      <!-- Содержимое таблицы будет вставлено сюда с помощью JavaScript -->
      </table>
    </div>
</div>


<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


        $(document).ready(function() {

            $('.clickable-block').on('click', function(event){
              // var data = $(event.target).text(); // Получаем текст элемента
              var data = $(event.target).attr('id'); // Получаем текст элемента

              fetchDataAndUpdateTable(data)});
        });

        // вызов функции заплнения таблицы при окончании загрузки страницы
        document.addEventListener('DOMContentLoaded', function() {
            fetchDataAndUpdateTable();
        });


  function fetchDataAndUpdateTable(payload) {


    fetch('/ChatMessage/refreshTable', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body: JSON.stringify(payload)
    })
    .then(response => {
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
        console.log("Полученные данные:", data); // Проверяем, что получаем данные
        updateTable(data);
    })
    .catch(error => console.error('Ошибка:', error));
  }


    function updateTable(data) {
        const table = document.getElementById('dataTable');
        table.innerHTML = table.rows[0].innerHTML; // Очистить таблицу, но сохранить заголовки

        data.forEach(item => {
            const row = table.insertRow();
            row.insertCell().textContent = item;
        });
    }

</script>

</body>
</html>
