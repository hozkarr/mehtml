<?php
$con = mysql_connect("localhost", "root", "kirby94") or die  (mysql_error());
mysql_select_db("google+", $con) OR DIE (mysql_error());

if (!$con) {
    die('Could not connect: ' . mysql_error());
}

/**
 * Created by PhpStorm.
 * User: OscarGarciaRuiz
 * Date: 18/05/15
 * Time: 10:59
 */ 