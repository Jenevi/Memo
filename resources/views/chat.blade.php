
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
                    <p>$title</p>
                    <span class='time-left'>11:05</span>
                    </div>
                ";
            }
       ?>

</div>


<div class="column2">
    <!-- контент первого столбца -->

{{--    кнопка ввода новой реплики--}}
    <div id="chatbox"></div>

    <form method="POST" action="/ChatMessage">
        @csrf
        <input type="text" name="text">
        <button type="submit">Отправить</button>
    </form>

    <div id="messagesContainer"></div>

</div>


<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function() {
        $('.clickable-block').on('click', function() {
            const data = $(this).attr('id');

            $.post('/ChatMessage/refreshTable', {
                _token: '{{ csrf_token() }}',
                data: data,
            }, function(response) {
                $('#messagesContainer').html(response);
            });

            console.log("Clicked block with date:", data);
            // location.reload();
            // Perform your desired action here
        });
    });
</script>

</body>
</html>
