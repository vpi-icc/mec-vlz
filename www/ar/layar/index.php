<?

	require_once("../../maps/config/config.php");

	header("Content-type text/javascript; charset=utf-8");
		
	$dblocation = "mysql6.000webhost.com";  
	$dbuser = "a8987760_usermec";  
	$dbpasswd = "mec2014";  
	$dbname = "a8987760_mec";
	
	$dsn = 'mysql:dbname=' . $dbname . ';host=' . $dblocation;
	$params = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'');
	//$params = array();
	
	try
	{
    	$dbh = new PDO($dsn, $dbuser, $dbpasswd, $params);
	}
	catch (PDOException $e)
	{
		echo 'Connection failed: ' . $e->getMessage();
		die();
	}


	$response = array();
	$response['layer'] = 'testlayer8443';
	$response['layer'] = 'mecvlz';
	$response['errorCode'] = 0;
	$response['errorString'] = 'Ok';
	$response['radius'] = 250000;
	$response['refreshInterval'] = 1;
	
	$baseUrl = 'http://mec-vlz.comuv.com';

	$sql = "
		SELECT id, pointName, lat, lng, description, active, datefrom, dateto, filename
		FROM points 
	";	
	
	foreach ( $dbh->query($sql) as $row )
	{
		$descr = $row['description'] . toUTF8( "\n���������� $datefrom\n������� $dateto" );
		$title = $row['pointName'];		
		$iconName = $row['active'] ? 'WindGenActive' : 'WindGen';
		$response['hotspots'][] = (object) array(
			"id" => $row['id'],
			"anchor" => (object) array( 'geolocation' => (object) array(
				'lat' => $row['lat'],
				'lon' => $row['lng']
			) ),
			"text" => (object) array("title" => $title, "description" => $descr, "footnote" => $baseUrl),
			'imageURL' => $baseUrl . '/maps/photos/rs_' . $row['filename'],
			//'icon' => (object) array( 'url' => $baseUrl . '/maps/images/' . $iconName . '.png', 'type' => 1 )
			//'object' => (object) array( 'reducedURL' => 'http://volpi.ru/images/photos/photos_2013/dedication_to_students_2013/p13111529.jpg', 'url' => 'http://volpi.ru/images/photos/photos_2013/dedication_to_students_2013/p13111529_large.jpg', 'contentType' => 'image/vnd.layar.generic', 'size' => 100.0 )
		);
	}
/*

    $response = array();
	$response['layer'] = 'mecvlz';
	$response['errorCode'] = 0;
	$response['errorString'] = 'Ok';
	$response['radius'] = 250000;
	$response['refreshInterval'] = 1;

    $descr = '(филиал) ФГБОУ ВПО «Волгоградский государственный технический университет»';
	$title = 'Волжский политехнический институт';	
	$response['hotspots'][] = (object) array(
		"id" => 1,
		"anchor" => (object) array( 'geolocation' => (object) array(
			'lat' => 48.79065,
			'lon' => 44.774517
		) ),
		"text" => (object) array( "title" => $title, "description" => $descr, "footnote" => 'http://volpi.ru' ),
		'imageURL' => 'http://mec-vlz.comuv.com/maps/images/case_a.jpg',
		'icon' => (object) array( 'url' => 'http://mec-vlz.comuv.com/maps/images/case_a_icon.jpg', 'type' => 0 ),
		'object' => (object) array(
		    //'reducedURL' => 'http://mec-vlz.comuv.com/maps/images/vpi_students.jpg',
		    'url' => 'http://mec-vlz.comuv.com/maps/images/vpi_students.jpg',
		    'contentType' => 'image/vnd.layar.generic',
		    'size' => 7.5 )
	);
*/
	echo json_encode($response);
?>