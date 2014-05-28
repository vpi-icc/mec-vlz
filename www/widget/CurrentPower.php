<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Текущая мощность установки</title>
</head>

<body>
    <div id="circle">
        <div id="wrapper">
            <p>Текущая мощность установки  &#8776;</p>
            <h1 id="result"></h1>  
            <p id="windPower">*При скорости ветра &#8776; </p>  
        </div>
    </div>
<?php

 $data_file = "http://openweathermap.org/data/2.5/forecast/weather?q=Volgograd,ru&APPID=8e246ef83baffbbe4adbc1f7f5f5fb7&units=metric&mode=xml";

  $xml  = simplexml_load_file($data_file);
  $current_wind_speed = $xml->forecast->time->windSpeed['mps'][0];

echo "<input value=\"$current_wind_speed\" id=\"input\" style=\"display: none;\">";
?>
<script type="text/javascript">
var getCurrentPower = function(windSpeed) {
    return round((0.50 * 1.23 * 0.05 * 0.35 * (windSpeed * windSpeed * windSpeed) * 0.80 * 0.95), 5);
} ,
    round = function (a,b) {
 b = b || 0;
 return Math.round(a*Math.pow(10,b))/Math.pow(10,b);
};
(function() {
    var windSpeed = document.getElementById('input').value;
    document.getElementById('result').innerHTML +=  getCurrentPower(windSpeed) + 'Вт';
    document.getElementById('windPower').innerHTML += windSpeed + ' м/с';
}())
</script>
<style>
* {
    margin: 0;
    padding: 0;
}
body {
    font-family: helvetica, arial;
    color: #ecf0f1;
    text-shadow:1px 2px 2px #3498db;
    text-align: center;

}
h1 {
    font-size: 60px;    
}
#circle {
    width: 300px;
    height: 300px;
    border-radius: 150px;
    background: #2ecc71;
    box-shadow: 1px 2px 10px #3498db;
}   
#circle div {
    padding-top: 85px;
}
</style>
</body>
</html>