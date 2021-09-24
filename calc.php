<?php

$a = $_GET["num1"];
$b = $_GET["num2"];
$c = $_GET["znak"];

if($c=="1") $result = $a + $b;
else 
	if($c=="2") $result = $a - $b;
		else 
			if($c=="3") $result = $a * $b;
				else 
					if($c=="4") $result = $a / $b;
						else $result="wrong!!!";


echo "<b>Результат:</b> $result <br>";

?>