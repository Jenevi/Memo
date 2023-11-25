
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
  /* border-collapse: separate; /* Отключаем слияние границ */
  border-spacing: 0px; /* Убираем расстояние между ячейками */
  text-align: left;
}

.table_blur th,
.table_blur td {
  border: 0px solid #e3eef7;
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
  border-top: 0px solid #777777;
  border-bottom: 0px solid #777777;
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



/* для кнопки home */

.hidden{display:none}
.fixed{position:fixed}
.top-0{top:0}
.right-0{right:0}
.px-6{padding-left:1.5rem;padding-right:1.5rem}
.py-4{padding-top:1rem;padding-bottom:1rem}




.header-container {
  display: flex;
  justify-content: space-between;
  align-items: center; /* Это выровняет элементы по центру по вертикали */
}

.header-text {
  flex: 1; /* Это позволяет тексту занимать доступное пространство */
}

.button-size {
  background-color: transparent;
  border: none;
  width: 20px;
  height: 20px;
}

.button-image {
  width: 20px;
  height: 20px;
}








.table_blur th, .table_blur td {
  border: 0px solid #ddd;
  border-collapse: collapse;
}

/* Стилизация для скрытия границ между определенными ячейками */
.no-border-right {
  border-right: none;
}

.no-border-left {
  border-left: none;
}

/* Дополнительные стили для выравнивания содержимого */
.table-cell-group {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 8px;
}









</style>
</head>
<body>

<h2>Chat Messages</h2>



<div class='fixed top-0 right-0 px-6 py-4'>
  <a href="http://127.0.0.1:8080/Dashboard" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a>
</div>


{{--подключим библиотеку jquery--}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<!-- контент первого столбца -->
<div class="column1">

<!-- {{--    выводим заголовки диалогов--}} -->
    <?php
    /**
     * @var string $titles
     */
            foreach ($titles as $title){
                $escapedTitle = htmlspecialchars($title, ENT_QUOTES, 'UTF-8');  // экранирование символов
                echo "
                    <div class='container darker hovered clickable-block' topic_id='$title->id' id='$title->topic'>
                    <p class='clickable-block' topic_id='$title->id' id='$escapedTitle'>$title->topic</p>
                    </div>
                ";
            }
       ?>

</div>


<div class="column2">
    <!-- контент первого столбца -->

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



<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        // получаем текст заголовков (ConversationTopic)
        $(document).ready(function() {

            $('.clickable-block').on('click', function(event){
              // var data = $(event.target).text(); // Получаем текст элемента
              var data = $(event.target).attr('topic_id'); // Получаем текст элемента
              sessionStorage.setItem('ConversationTopic', data); // Сохраняем
              /// выбранный заголовок (ConversationTopic)
              fetchDataAndUpdateTable(data)});
        });


          document.getElementById('submitButton1').addEventListener('click', function() {
              // Предположим, что вы хотите отправить форму без перезагрузки страницы
              const formData = new FormData(document.getElementById('myForm1'));
              console.log(formData.text);

              let data = sessionStorage.getItem('ConversationTopic');

              // Здесь вы можете использовать Fetch API для отправки данных
              fetch('ChatMessage/addMessage', { // Замените 'your-endpoint' на URL, куда нужно отправить форму
                method: 'POST',
                headers: {
                  'Accept': 'application/json',
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({'topic_id': data, 'text': formData.get('message')}),
              })
              .then(response => {
                if (response.ok) {
                  return response.json(); // или response.text(), если ответ в виде текста
                }
                throw new Error('Network response was not ok.');
              })
              .then(data => {
                // console.log('Success:', data);
                // Здесь код для обработки успешной отправки
                // updateTable();
                fetchDataAndUpdateTable(data.topic_id);
                console.log('then', data.topic_id);
              })
              .catch((error) => {
                console.error('Error:', error);
                // Здесь код для обработки ошибок отправки
              });
            });

        // // вызов функции заплнения таблицы при окончании загрузки страницы
        // document.addEventListener('DOMContentLoaded', function() {
        //     fetchDataAndUpdateTable();
        // });


  function fetchDataAndUpdateTable(payload) {

    // console.log(payload);
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
      // let firstElement = data[0]; // Первый элемент - массив
      // let idsFromFirstElement = firstElement.map(item => item.id);
        // data = data['messages']
        // console.log("Полученные данные:", data); // Проверяем, что получаем данные
        // console.log('updateTable(data):', data);
        updateTable(data);
    })
    .catch(error => console.error('Ошибка:', error));
  }

  function fetchDeletingMessage(payload) {
    // запрос удаления сообщения
    fetch('ChatMessage/deleteMessage', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body: JSON.stringify(payload)
    })
  }



  // Функция для создания кнопки
function createDeleteButton() {
  const button = document.createElement("button");
  button.className = "button-size";
  button.innerHTML = '<img src="/images/remove-button.png" alt="Button Image" class="button-image">';
  // Добавьте здесь логику для удаления строки
  button.onclick = function() {
    // Логика удаления

    // Находим ближайшую родительскую строку (<tr>)
    let row = this.closest('tr');
    // Получаем значение атрибута message_id
    let messageId = row.getAttribute('message_id');
    let topicId = row.getAttribute('topic_id');
    // console.log('Message ID:', messageId, 'Topic_id:', topicId);

    // var text = $(this).closest('tr').getAttribute('message_id');
    // var ftch = sessionStorage.getItem('message_id');
    // console.log('messageId:', messageId, 'topicId:', topicId);

    fetchDeletingMessage(messageId); // функция удаления реплики
    fetchDataAndUpdateTable(topicId); // обновляем таблицу
    // Действия с текстом, например, вывод в консоль
    // console.log(text);
  };
  return button;
}


    function updateTable(data) {
        const table = document.getElementById('dataTable');
        table.innerHTML = table.rows[0].innerHTML; // Очистить таблицу,
        // но сохранить заголовки
        // console.log('updData', data);

        Object.values(data.messages).forEach(item => {
            const row = table.insertRow();
            row.setAttribute("message_id", item.id); // Предполагая, что у каждого item есть свойство message_id
            row.setAttribute("topic_id", item.conversation_topic_id); // Предполагая, что у каждого item есть свойство message_id
            row.insertCell().textContent = item.message;
            // Добавление ячейки с кнопкой
            // console.log('updateTable(data):', data.topic.id);
            // console.log('updateTable(data):', item.conversation_topic_id);
            const cellButton = row.insertCell();
            cellButton.appendChild(createDeleteButton());
        });
    }

</script>

</body>
</html>
