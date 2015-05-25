<?php

require 'vendor/autoload.php';
$faker = Faker\Factory::create();


echo "<table>";
echo"<form action='injection.php' method='post'>";

for ($i = 0; $i <= 20; $i++) {

    echo"<td><input type='text' name='text[]' id='name'></td>";
    echo"</tr>";

}
echo"<td><input type='submit' value='Enviar' ></td></tr>";

echo "</form></table>";