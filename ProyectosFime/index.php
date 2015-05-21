<?php

require 'vendor/autoload.php';
$faker = Faker\Factory::create();

$name = array();
$last = array();
$date  =array();

for ($i = 0; $i <= 20; $i++) {

     $name[] = $faker->name;

     $last[] = $faker->lastName;

     $date[] = $faker->dateTimeBetween($startDate = "now", $endDate = "30 days")->format('Y-m-d H:i:s');

    /*mysql_query("INSERT INTO `google+`.`post` (`id`, `name`, `last`, `comment`, `date`)
            VALUES (NULL, '$name', '$last', '$comment', '$date');") or die (mysql_error());*/
}

echo "<table>";
echo"<form>";
echo"<tr><td>Nombre</td><td>Apellido</td><td>Comentario</td><td>Fecha</td>";

for ($i = 0; $i <= 20; $i++) {

    echo"<tr><td><input type='text' name='name[]' id='name' value='".$name[$i]."'readonly ></td>";
    echo"<td><input type='text' name='last[]' id='name' value='".$last[$i]."'readonly ></td>";
    echo"<td><input type='text' name='text[]' id='name'></td>";
    echo"<td><input type='text' name='date[]' id='name' value='".$date[$i]."'readonly ></td>";
    echo"</tr>";

}
echo"<td><input type='submit' value='Enviar' ></td></tr>";

echo "</form></table>";