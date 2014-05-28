<?php
	require_once("service_func.php");
    $response = array('status'=>'no', 'message'=>'');
    header('Content-Type: application/json; charset=utf-8');
	$resStr=connect_db();
    if($resStr!="ok")
	   {$response['message']=$resStr;
	    $response['status']="no";}
	else
		 { if($_POST['passwd']=="мэк")
 			{	 
			$idPoint=$_POST["idpoint"]; 
			$query = "DELETE FROM points WHERE id=$idPoint";
			$res = mysql_query($query);
			if(file_exists("../photos/".$_POST["filename"]))
			   {
				    @unlink("../photos/".$_POST["filename"]);
     				@unlink("../photos/"."rs_".$_POST["filename"]);
			   }
			$response['status']="ok";
			}
			else
			{$response['status']="err";
			 $response['message']="Неверный пароль";
			}
		}
    print json_encode($response);
?>