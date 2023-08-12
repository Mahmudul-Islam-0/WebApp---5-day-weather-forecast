<?php
    $city = $_GET['city'] ?? 'Dhaka';


    if($city == ""){
        $city = 'Dhaka';
    }

    $url = "http://api.openweathermap.org/data/2.5/forecast?q=$city&appid=4cc35b789e1d25c86e9a5aada44582bf&units=metric";

    $contents = file_get_contents($url);
    $weather = json_decode($contents);

    $city = $weather->city->name;
    $country= $weather->city->country;
    $today = date(" F j, Y");

    $cdata = $weather->list[0];
    $ctemp = $cdata->main->temp;
    $cpressure=$cdata->main->pressure;
    $chumidity = $cdata->main->humidity;
    $cwindspeed = $cdata->wind->speed;
    $cicon = "http://openweathermap.org/img/wn/".$cdata->weather[0]->icon."@4x.png";


    $cdate = $cdata->dt_txt;
    $tomorrow = new DateTimeImmutable($cdate);


    $counter = 0;
    $temp = array("0", "0", "0", "0");

    $icon = array("0", "0", "0", "0");

    for ($i = 5; $i < 30; $i = $i + 8){
        $tempdata=$weather->list[$i];
        $temp[$counter] = $tempdata->main->temp;
        $icon[$counter] =  "http://openweathermap.org/img/wn/".$cdata->weather[0]->icon."@2x.png";
        $counter =$counter +1;



    };

?>

<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Weather Forecast</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,300;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

</head>


<body>


    <div id="header">

        <h1>Weather Forecast</h1>
        <form id="search" >
            <input id="searchbar" type="text" name="city" placeholder="  Enter city">
            <input id="button" type="submit" name="button"></input>
        </form>

    </div>

    <div id="current_day">
        <div >
            <div id="today"><p><?= $city . "," . $country ?></p><img src="location2.png" alt="nav_icon"></div>

            <p><?= $today ?></p>
            <p>Sunday</p>
        </div>

        <div ><img id="cimg" src="<?= $cicon ?>" alt="weather_icon"></div>

        <div>
            <div id="temp"><img src="temp_icon.png" alt="temp">
            <p><?= $ctemp?> °C</p></div>

            <p>Pressure: <?=$cpressure?> mb</p>
            <p>Humidity: <?=$chumidity?> %</p>
            <p>Windspeed: <?=$cwindspeed?> m/s</p>
        </div>

    </div>

    <div id="other_days">

        <div class="wcards">

            <img src="<?= $icon[0]?>" alt="wicon">
            <p><?= $temp[0]?> °C</p>
            <p><?= $tomorrow->modify('+1day')->format('d-m-Y')?></p>

        </div>

        <div class="wcards">

            <img src="<?= $icon[1]?>" alt="wicon">
            <p><?= $temp[1]?> °C</p>
            <p><?= $tomorrow->modify('+2day')->format('d-m-Y')?></p>

        </div>

        <div class="wcards">

            <img src="<?= $icon[2]?>" alt="wicon">
            <p><?= $temp[2]?> °C</p>
            <p><?= $tomorrow->modify('+3day')->format('d-m-Y')?></p>

        </div>

        <div class="wcards">

            <img src="<?= $icon[3]?>" alt="wicon">
            <p><?= $temp[3]?> °C</p>
            <p><?= $tomorrow->modify('+4day')->format('d-m-Y')?></p>

        </div>

    </div>



</body>

</html>
