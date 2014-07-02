<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 18.05.14
 * Time: 11:19
 */

function http_build_str(array $data)
{
    $req = '';
    foreach ( $data as $param => $value )
        $req .= $param . '=' . $value . '&';

    return rtrim($req, '&');
}

$server_url = 'http://' . $_SERVER['SERVER_NAME'] . "/";
$handler_name = 'di.php';

/*
$data = array(
    'session' => '',
    'lat' => rand(40, 50) + rand(0, 100) / 100,
    'lon' => rand(40, 50) + rand(0, 100) / 100
);
*/

// create a new cURL resource
$ch = curl_init();

/*
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, $server_url . "/" . $handler_name . "?" . http_build_str($data));
//curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);

// grab URL and pass it to the browser
curl_exec($ch);
*/

//$n = rand(50, 100);


date_default_timezone_set('UTC');

$n = 60;

for ( $i = -$n; $i <= $n; $i++ )
{
    $ts = time() + $i * 60;
    $data = array(
        'date' => date("ymd", $ts),
        'time' => date("His", $ts),
        'trv' => rand(30, 100) + rand(0, 100) / 100, // turbine rotating velocity, RPM
        'wtop' => rand(20, 50) + rand(0, 100) / 100, // wind turbine output power, Watt
        'sbop' => rand(5, 20) + rand(0, 100) / 100, // solar battery output power, Watt
        'bcl' => rand(0, 99) + rand(0, 100) / 100, // battery charge level
        'lat' => rand(40, 50) + rand(0, 100) / 100, // latitude
        'lon' => rand(40, 50) + rand(0, 100) / 100 // longitude
    );
    curl_setopt($ch, CURLOPT_URL, $server_url . "/" . $handler_name . "?" . http_build_str($data));
    curl_exec($ch);
}

// close cURL resource, and free up system resources
curl_close($ch);

//echo $result;