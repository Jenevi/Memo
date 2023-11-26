
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        // получаем текст заголовков (ConversationTopic)
        $(document).ready(function() {

            $('.clickable-block').on('click', function(event){
              const data = $(event.target).attr('topic_id'); // Получаем текст элемента
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
                fetchDataAndUpdateTable(data.topic_id);
              })
              .catch((error) => {
                console.error('Error:', error);
                // Здесь код для обработки ошибок отправки
              });
            });


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
      body: JSON.stringify({message_id: payload})
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
    fetchDeletingMessage(messageId); // функция удаления реплики
    fetchDataAndUpdateTable(topicId); // обновляем таблицу
  };
  return button;
}


    function updateTable(data) {
        const table = document.getElementById('dataTable');
        table.innerHTML = table.rows[0].innerHTML; // Очистить таблицу,

        Object.values(data.messages).forEach(item => {
            const row = table.insertRow();
            row.setAttribute("message_id", item.id); // Предполагая, что у каждого item есть свойство message_id
            row.setAttribute("topic_id", item.conversation_topic_id); // Предполагая, что у каждого item есть свойство message_id
            row.insertCell().textContent = item.message;
            const cellButton = row.insertCell();
            cellButton.appendChild(createDeleteButton());
        });
    }
