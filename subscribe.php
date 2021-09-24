<?php

if((isset($_GET['type_sub']))&&(!empty($_GET['email'])))
{
	echo "Адрес почты: {$_GET['email']}<br><br>";

		echo "<ol>";
		foreach($_GET['type_sub'] as $a)
		{
		echo "<li> $a";
		}
	echo "</ol>";
}
?>