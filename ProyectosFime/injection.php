<?php


mysql_connect("localhost", "root", "kirby94") or die (mysql_error());
mysql_select_db('google+') or die(mysql_error());

$name = $_POST['name'];
$last = $_POST['last'];
$text = $_POST['text'];
$date = $_POST['date'];


for ($i = 0; $i <= 20; $i++) {

    mysql_query("INSERT INTO `google+`.`post` (`id`, `name`, `last`, `comment`, `date`)
        VALUES (NULL, '$name[$i]', '$last[$i]', '$text[$i]', '$date[$i]');") or die (mysql_error());

}

echo '<SCRIPT LANGUAGE="javascript">
        location.href = "index.php";
        </SCRIPT>';

/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 07/05/15
 * Time: 8:19
 */ 