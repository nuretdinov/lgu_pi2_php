<?php
$error_status=false;
$error_text="";

if(!isset($_GET['type_sub'])) {$error_status=true; $error_text.=" Не выбраны подписки";}
if(empty($_GET['email'])) {$error_status=true; $error_text.=" Нет почты";}

if(!$error_status)
{
	echo "Адрес почты: {$_GET['email']}<br><br>";

		echo "<ol>";
		foreach($_GET['type_sub'] as $a)
		{
		echo "<li> $a";
		}
	echo "</ol>";
}
else
{
	if($error_status) echo $error_text;
	echo '
	<html><head><meta charset="utf-8"></head>
<body lang="ru">
<form action="subscribe.php">
Email:<input type="text" name="email"><br>
<input type="checkbox" name="type_sub[]" value="Спорт">Спорт<br>
<input type="checkbox" name="type_sub[]" value="Путешествия">Путешествия<br>
<input type="checkbox" name="type_sub[]" value="Политика">Политика<br>
<input type="checkbox" name="type_sub[]" value="Красота">Красота<br>
<input type="submit" value="subscribe">
</form>
	';
}
?>

</body></html>