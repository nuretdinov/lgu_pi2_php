<?php

//добавление контактов
if(isset($_GET['fio'])){
    if((!empty($_GET['fio']))&&(!empty($_GET['tel']))){
        $file_data=fopen('phonebook.txt', "a");
        $new_contact=$_GET['fio'].PHP_EOL.$_GET['tel'].PHP_EOL;
        fputs($file_data, $new_contact);
        fclose($file_data);
        echo 'contact added<br><br>';
    }
}


//удаление контакта
if(isset($_GET['contact_delete'])) {
    $contact_list = '';
    if (file_exists("phonebook.txt")) {
        $file_data = fopen('phonebook.txt', "r");
        $contact_list .= "";
        while (!feof($file_data)) {
            $c_l = fgets($file_data);
            $c_l_trim = trim($c_l);

            if ($_GET['contact_delete'] == $c_l_trim)
            {
                fgets($file_data);
                continue;
            }

            $contact_list .= $c_l;
            $c_l = fgets($file_data);
            $contact_list .= $c_l;
        }
        fclose($file_data);
        $file_data = fopen('phonebook.txt', "w");
        fputs($file_data, $contact_list);
        fclose($file_data);
        echo 'Контакт удален!!!';
    }
}
?>

<form>
	FIO:<input type="text" name="fio">
	TEL:<input type="text" name="tel">
	<input type="submit" value="add contact">
</form>


<form>
	Find FIO:<input type="text" name="fio_find">
	<input type="submit" value="find contact">
</form>


<form>
    Find FIO for delete:
    <?php
    //вывод всех контактов
    //<option value='Значение'> 123 </option>
    $contact_list='<select name="contact_delete">';
    if(file_exists("phonebook.txt"))
    {
        $file_data=fopen('phonebook.txt', "r");
        while(!feof($file_data))
        {
            $c_l=fgets($file_data);
            $c_l=trim($c_l);

            if(empty($c_l)) break;

            $contact_list.="<option value='";
            $contact_list.= $c_l."'>".$c_l."</option>";
            fgets($file_data);
            //if(empty($c_l)) break;
        }
        fclose($file_data);
        $contact_list.="</select>";
        echo $contact_list;
    }
    ?>
    <input type="submit" value="delete contact">
</form>

<?php


//поиск контакта
if(isset($_GET['fio_find'])){
	if(file_exists("phonebook.txt"))
	{
	$file_data=fopen('phonebook.txt', "r");
	while(!feof($file_data))
	{
		$fio_find=fgets($file_data);
		$fio_find=trim($fio_find);
			if($fio_find==$_GET['fio_find'])
			{
			$tel_find=fgets($file_data);
			echo "Данные контакта <strong>".$_GET['fio_find'];
			echo "</strong>. Тел: ".$tel_find;
			break;
			}
			else {
				fgets($file_data);
				}

	}
	fclose($file_data);
	}
}



//вывод всех контактов
$contact_list='<ol>';
if(file_exists("phonebook.txt"))
{
	$file_data=fopen('phonebook.txt', "r");
	while(!feof($file_data))
    {
	$c_l=fgets($file_data);
	$c_l=trim($c_l);

	if(empty($c_l)) break;

	$contact_list.="<li>";
	$contact_list.=$c_l;
	$contact_list.=" ";
	$c_l=fgets($file_data);
	$c_l=trim($c_l);
	$contact_list.=$c_l;
	}
	fclose($file_data);
	$contact_list.="</ol>";
	echo $contact_list;
}

?>