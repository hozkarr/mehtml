<?php


mysql_connect("localhost", "root", "kirby94") or die (mysql_error());
mysql_select_db('google+') or die(mysql_error());

$text = $_POST['text'];


for ($i = 0; $i <= 20; $i++) {

    if($text[$i]== NULL){
        continue;
    }


    mysql_query("INSERT INTO `google+`.`bad_words` (`id`, `bad_word`, `replacement`, `repeat`)
        VALUES (NULL, '$text[$i]','[censurado]', '0');") or die (mysql_error());

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