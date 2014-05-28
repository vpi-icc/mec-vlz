<?php
	//require_once("../config/config.php");
	require_once("service_func.php");
    $response = array('status'=>'no', 'message'=>'');
    header('Content-Type: application/json; charset=utf-8');
    $resStr=connect_db();
    if($resStr!="ok")
	   {$response['message']=$resStr;
	    $response['status']="no";}
	else
		 {
			 $response['points']=array();
		     $query = "SELECT pointName, lat, lng, description, active, datefrom, dateto, id, filename from points";
			 $res = mysql_query($query) or die(mysql_error());
			 $i=0;
			  while ($row = mysql_fetch_array($res, MYSQL_ASSOC)) 
                {
					$response['points'][$i]=$row;
					$i++;
				}
			 $response['message']=$query;
		 }
      $response['status']="ok";
	  print json_encode($response);
?>