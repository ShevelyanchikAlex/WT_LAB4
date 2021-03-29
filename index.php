<html>
<head>
    <meta charset="utf-8"/>
    <link href="assets/css/style.css" rel="stylesheet">
    <title>HTML5</title>
</head>
<body class="body">
<p><b>Файл с отправленными сообщениями:</b></p>
<p><label>
<textarea class="text_area">
 <?php echo file_get_contents('./messages.txt'); ?>
 </textarea>
    </label></p>
<form action="index.php" method="POST">
    <p><b>Введите имя:</b></p>
    <p><label>
            <input class="text_input" type="text" name="name"/>
        </label>
    </p>
    <p><b>Введите сообщение:</b></p>
    <p><label>
            <textarea class="text_area" name="message"></textarea>
        </label>
    </p>
    <p><input class="btn" type="submit"/></p>
    <?php

    if (isset($_POST['name']) && !empty($_POST['name'])) {
        if (isset($_POST['message']) && !empty($_POST['message'])) {
            change_message();
            echo '<meta http-equiv="refresh" content="1; URL=index.php">';
        } else {
            show_alert_message(1);
        }
    } else {
        show_alert_message(2);
    }

    function change_message()
    {
        $regexp = "/\b([a-z0-9._-]+@(?!bsuir.by)[a-z0-9.]+)\b/ui";
        $final_message = preg_replace($regexp, '#Cтоп e-mail#', $_POST['message']);
        $file = fopen('messages.txt', 'a');
        fwrite($file, $final_message . PHP_EOL);
        fclose($file);
    }

    function show_alert_message($num_err)
    {
        switch ($num_err) {
            case 1:
                echo 'Некорректный ввод данных: не введено сообщение.';
                break;
            case 2:
                echo 'Некорректный ввод данных: не введено имя.';
                break;
        }
    }

    ?>

</form>
</body>
</html>