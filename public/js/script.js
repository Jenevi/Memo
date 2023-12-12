
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    // получаем текст заголовков (Title)
    $(document).ready(function() {

        $('.clickable-block').on('click', function(event){
          const data = $(event.target).attr('title_id'); // Получаем текст элемента
          sessionStorage.setItem('Title', data); // Сохраняем
          /// выбранный заголовок (Title)
          fetchDataAndUpdateTable(data)});
    });


    document.getElementById('submitButton1').addEventListener('click', function() {
        // Предположим, что вы хотите отправить форму без перезагрузки страницы
        const formData = new FormData(document.getElementById('myForm1'));

        let data = sessionStorage.getItem('Title');

        // Здесь вы можете использовать Fetch API для отправки данных
        fetch('Memo/addNote', { // Замените 'your-endpoint' на URL, куда нужно отправить форму
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          body: JSON.stringify({'title_id': data, 'text': formData.get('message')}),
        })
        .then(response => {
          if (response.ok) {
            return response.json(); // или response.text(), если ответ в виде текста
          }
          throw new Error('Network response was not ok.');
        })
        .then(data => {
          fetchDataAndUpdateTable(data.title_id);
        })
        .catch((error) => {
          console.error('Error:', error);
          // Здесь код для обработки ошибок отправки
        });
      });


document.getElementById('submitButton2').addEventListener('click', function() {
      // Предположим, что вы хотите отправить форму без перезагрузки страницы
      const formData = new FormData(document.getElementById('myForm2'));

      let data = sessionStorage.getItem('Title');

      // Здесь вы можете использовать Fetch API для отправки данных
      fetch('Memo/addTitle', { // Замените 'your-endpoint' на URL, куда нужно отправить форму
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({'text': formData.get('title')}),
      })
      .then(response => {
        if (response.ok) {
          return response.json(); // или response.text(), если ответ в виде текста
        }
        throw new Error('Network response was not ok.');
      })
      .then(data => {

        location.reload(true);
        // console.log(data);
        // fetchDataAndUpdateTable(data);
      })
      .catch((error) => {
        console.error('Error:', error);
        // Здесь код для обработки ошибок отправки
      });
    });

  function fetchDataAndUpdateTable(payload) {
    console.log('payload: ', payload);
    fetch('/Memo/refreshTable', {
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
    fetch('Memo/deleteNote', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      body: JSON.stringify({note_id: payload})
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
    // Получаем значение атрибута note_id
    let note_id = row.getAttribute('note_id');
    let title_id = row.getAttribute('title_id');
    fetchDeletingMessage(note_id); // функция удаления реплики
    fetchDataAndUpdateTable(title_id); // обновляем таблицу
  };
  return button;
}


    function updateTable(data) {
        const table = document.getElementById('dataTable');
        table.innerHTML = table.rows[0].innerHTML; // Очистить таблицу,
        Object.values(data.notes).forEach(item => {
            const row = table.insertRow();
            row.setAttribute("note_id", item.id); // Предполагая, что у каждого item есть свойство note_id
            row.setAttribute("title_id", item.title_id); // Предполагая, что у каждого item есть свойство note_id
            row.insertCell().textContent = item.note;
            const cellButton = row.insertCell();
            cellButton.appendChild(createDeleteButton());
        });
    }
