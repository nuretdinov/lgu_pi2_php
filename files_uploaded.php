<form method="post" enctype="multipart/form-data" action="files_uploaded.php">
    Заголовок новости: <input type="text" name="news_text"><br>
    Текст новости:<br>
    <textarea cols='60' rows='20' name="news_text_body"></textarea><br> <!-- пока нет обработки -->
    Картинка к новости: <input type="file" name="news_file"> <br>
    email пользователя: <input type="email" name="email"> <br>
    <input type="submit" value="загрузить">
</form>


<?php

// сохраняем новость
if (isset($_FILES["news_file"]["tmp_name"])) {
    if (is_uploaded_file($_FILES["news_file"]["tmp_name"]) && (!empty($_POST["news_text"]))) {

        date_default_timezone_set('Europe/Moscow'); //установили часовой пояс, тк на сервере был неправильный
        $news_date = date("d.m.Y H:i:s"); // получили дату и время

        move_uploaded_file($_FILES["news_file"]["tmp_name"], "news_img/" . $_FILES["news_file"]["name"]);

        $news_file = fopen("news.txt", "a");
        $news_file_write = $news_date . " & " . $_POST["news_text"] . PHP_EOL . $_FILES["news_file"]["name"] . PHP_EOL; // & - ввели разделитель между датой и новостью
        fputs($news_file, $news_file_write);
        fclose($news_file);

        //создаем файл с основным текстом новости, имя - имя файла картинки + .txt
        $file_text_body_name = $_FILES["news_file"]["name"] . ".txt";
        $news_file = fopen($file_text_body_name, "w");
        fputs($news_file, $_POST["news_text_body"]);
        fclose($news_file);

        echo "Новость добавлена!<br><br>";
    } else {
        echo "Все поля обязательны для заполнения!<br><br>";
    }

}

//выводим новостную ленту
if (file_exists("news.txt")) {
    $news_file = fopen("news.txt", "r");
    while (!feof($news_file)) {
        $news_text = fgets($news_file);
        $news_text = trim($news_text);
        if (empty($news_text)) break;

        $news_mass = explode("&", $news_text); // создали массив через разделитель &. массив 2 эл-та, 0 - дата и время, 1 - текст новости

        echo "<div style='width: 500px;'><p align='center'><b>" . $news_mass[0] . "</b></p>";
        $news_img = fgets($news_file);
        $news_img = trim($news_img);
        echo "<img src='news_img/" . $news_img . "'><br>";
        echo "<p align='center'>" . $news_mass[1] . "</p></div>";

        //вывод основного текста новости
        $news_body_file_name = $news_img . ".txt";
        $news_body_file = fopen($news_body_file_name, "r");
        while (!feof($news_body_file)) {
            echo "<p>";
            $out = fgets($news_body_file);
            echo $out . "</p>";
        }
        fclose($news_body_file);

    }
    fclose($news_file);
}


?>