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
 $data_file_local="lastData.xml";
 $xml_local  = simplexml_load_file($data_file_local);
// $countTimes=count($xml_local->forecast->time);
 list($yearl, $monthl, $dayl, $hourl, $minl, $secl) = sscanf($xml_local->dateTo, "%d-%d-%dT%d:%d:%d");
// echo $yearl."  ".$monthl."  ".$dayl."  ".$hourl."  ".$minl."  ".$secl;
//echo "<br>".date('Y')." ".date('m')." ".date('d')." ".date('H')." ".date('i')." 0";
 $current_date = mktime (date('H'),date('i'),0, date('m') ,date('Y'),date('d'))+9*60*60; 
 $date_local = mktime ($hourl, $minl, $secl, $monthl, $yearl, $dayl); 
// echo $current_date."  ". $date_local;
 $difference = ($date_local-$current_date); //разница в секундах

 if($difference<=0)
   {
	$data_file = "http://openweathermap.org/data/2.5/forecast/weather?q=Volgograd,ru&APPID=8e246ef83baffbbe4adbc1f7f5f5fb7&units=metric&mode=xml";
    $xml  = simplexml_load_file($data_file);
	$bFound=false; $i=0;
	while(!$bFound)
	{
       list($year, $month, $day, $hour, $min, $sec) = sscanf($xml->forecast->time[$i]['to'], "%d-%d-%dT%d:%d:%d");
//	  echo "<br>".$year."  ".$month."  ".$day."  ".$hour."  ".$min."  ".$sec;
	   $date_fc = mktime ($hour, $min, $sec, $month, $year, $day);
	   if($date_fc-$current_date>0)
	      $bFound=true;
		else $i++;  
	}
	
	$current_wind_speed = $xml->forecast->time[$i]->windSpeed['mps'][0];
	$xml_local->dateTo=$xml->forecast->time[$i]['to'];
	$xml_local->wind=$current_wind_speed;
	$xml_local->asXML("lastData.xml");
   }
   else
    $current_wind_speed=$xml_local->wind; 
 
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