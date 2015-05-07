<?php

mysql_connect("localhost", "root", "kirby94") or die (mysql_error());
mysql_select_db('google+') or die(mysql_error());


require 'vendor/autoload.php';
$faker = Faker\Factory::create();



for ($i = 0; $i <= 20; $i++) {

    echo $i;
     $name = $faker->name;
     $last = $faker->lastName;
     $comment = $faker->text;
     $date = $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d H:i:s')."<br>";

    /*mysql_query("INSERT INTO `google+`.`post` (`id`, `name`, `last`, `comment`, `date`)
            VALUES (NULL, '$name', '$last', '$comment', '$date');") or die (mysql_error());*/
}

//var_dump(get_object_vars($date));

