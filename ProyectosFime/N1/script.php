<?php
include '../php/con.php';


function bad_wordcensor($txt)
{
    $q = mysql_query("SELECT bad_word, replacement FROM bad_words") or die (mysql_error());
    while ($row_bad = mysql_fetch_array($q))
    {
        $txt = str_ireplace($row_bad['bad_word'], "[censurado]", $txt);
    }

    return $txt;


}



echo bad_wordcensor($_POST["comments"]);

/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 18/05/15
 * Time: 10:29
 */ 