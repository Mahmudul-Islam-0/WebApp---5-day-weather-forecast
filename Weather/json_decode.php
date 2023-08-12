<?php

$url = "https://api.openweathermap.org/data/2.5/weather?q=London&appid=4cc35b789e1d25c86e9a5aada44582bf";

$contents = file_get_contents($url);
$climate = json_decode($contents);

$temp_max = $climate->main->temp_max;
$temp_min = $climate->main->temp_min;

$today = date("F j, Y, g:i a");
$cityname = $climate->name;

echo $cityname . " - " .$today . "<br>";
echo "Temp Max: " .$temp_max ."&deg;C<br>"; 
echo "Temp Min: " .$temp_min ."&deg;C<br>";

?>