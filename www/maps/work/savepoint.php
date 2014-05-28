<?php

function checkErr()
{
		switch($_FILES[$fileElementName]['error'])
						{
							
							case '1':
								$error = 'Размер файла с изоброажением слишком велик';
								break;
							case '2':
								$error = 'Размер файла с изоброажением слишком велик';
								break;
							case '3':
								$error = 'Ошибка загрузки изображения';
								break;
							case '4':
								$error = 'Ошибка загрузки изображения';
								break;
							case '6':
								$error = 'Ошибка загрузки изображения';
								break;
							case '7':
								$error = 'Ошибка записи файла с изображением на диск';
								break;
							case '8':
								$error = 'Неверное расширение файла';
								break;
		    		}//switch($_FILES[$fileElementName]['error'])
					return $error;
}
function makeImg($photo)
{
		
						$dest_width = 255;
						$dest_height = 177;
						$quality= 85;
						$dest_image = "../photos/".$photo;

						$src_img = imageCreateFromJPEG("../photos/".$photo);

						$src_width = imageSX ($src_img);
						$src_height = imageSY ($src_img);

						$mc1 = $dest_width/$src_width;
						$mc2 = $dest_height/$src_height;

						$k = min($mc1,$mc2);

						$dest_width = round($src_width * $k);
						$dest_height = round($src_height * $k);

						$dst_img = imageCreateTrueColor($dest_width,$dest_height);
						imageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width, $dest_height, $src_width, $src_height);

						imageJPEG($dst_img, $dest_image, $quality);

						imageDestroy($src_img);
						imageDestroy($dst_img);

						//Making small preview
						$dest_width = 120;
						$dest_height = 80;
						$quality= 85;
						$dest_image = "../photos/"."rs_".$photo;

						$src_img = imageCreateFromJPEG("../photos/".$photo);

						$src_width = imageSX ($src_img);
						$src_height = imageSY ($src_img);

						$mc1 = $dest_width/$src_width;
						$mc2 = $dest_height/$src_height;

						$k = min($mc1,$mc2);

						$dest_width = round($src_width * $k);
						$dest_height = round($src_height * $k);

						$dst_img = imageCreateTrueColor($dest_width,$dest_height);

						imageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $dest_width,
	$dest_height, $src_width, $src_height);

						imageJPEG($dst_img, $dest_image, $quality);

						imageDestroy($src_img);
						imageDestroy($dst_img);
						

}
	
	
	require_once("../config/config.php");
    $response = array('status'=>'no', 'message'=>'oooo');
	$response['message']="Данные успешно добавлены в базу";
	header('Content-Type: application/json; charset=utf-8');
    if($_POST['passwd']=="мэк")
 {	 
	$fileElementName="imgPict";
   if( isset($_POST['lat']) && isset($_POST['lng']))
	{
	 $lat=$_POST['lat'];
	 $lng=$_POST['lng'];
	 $pointName=$_POST["title"];
	 $desc=$_POST["desc"];
	 $isActive=$_POST["isActive"];
	 $datefrom=$_POST["datefrom"];
	 $idPoint=$_POST["idpoint"];
	   
	 $dbcnx=@mysql_connect($dblocation, $dbuser, $dbpasswd); 
	 if (!$dbcnx)  
       $response['message']="Сервер базы данных недоступен!!!"; 
     else    
      {
		mysql_query("SET NAMES 'utf8';"); 
		if(!@mysql_select_db($dbname, $dbcnx))
		 $response['message']="Сервер базы данных недоступен??";
		else
		 {
			if($isActive=="true")
			   {
				 $query = "UPDATE points set active=false where active=true";
			     $res = mysql_query($query) or die(mysql_error());
			if($idPoint==0)	 
			    $query = "INSERT INTO points (pointName, lat, lng, description, active, datefrom, dateto) VALUES('$pointName', '$lat', '$lng', '$desc', $isActive, '$datefrom', 'NULL')";
			else
			   	 $query = "UPDATE points SET  pointName='$pointName', lat='$lat', lng='$lng', description='$desc', active= $isActive, datefrom='$datefrom', dateto='NULL' where id=$idPoint";
			   }//if($isActive=="true")
			   else
			 {
				 if($idPoint==0)
				  {if(empty($_POST["dateto"]))
				    $query = "INSERT INTO points (pointName, lat, lng, description, active, datefrom) VALUES('$pointName', '$lat', '$lng', '$desc', $isActive, '$datefrom')";	
				 else{
				   $dateto=$_POST["dateto"];
				   $query = "INSERT INTO points (pointName, lat, lng, description, active, datefrom, dateto) VALUES('$pointName', '$lat', '$lng', '$desc', $isActive, '$datefrom', '$dateto')";
				    }
				  }
				 else
				 {
				  if(empty($_POST["dateto"]))
				    $query = "UPDATE points SET pointName='$pointName', lat='$lat', lng='$lng', description='$desc', active= $isActive, datefrom='$datefrom' where id=$idPoint";	
				 else{
				   $dateto=$_POST["dateto"];
				   $query = "UPDATE  points SET pointName='$pointName', lat='$lat', lng='$lng', description='$desc', active= $isActive, datefrom='$datefrom', dateto='$dateto' where id=$idPoint";
					 }
				 }
				//$response['message']=$query; 
			} //else if($isActive=="true")
		//	$response['message']=$query; 
			$res = mysql_query($query) or die(mysql_error());
			if($idPoint==0)
			   $idPoint=mysql_insert_id();
			if(!empty($_POST["filename"])&& file_exists("../photos/".$_POST["filename"]))
			   {
				    @unlink("../photos/".$_POST["filename"]);
     				@unlink("../photos/"."rs_".$_POST["filename"]);
			   }
			$fileElementName = 'imgPict';
			// $response['message']=$_FILES[$fileElementName]['name'];
 			 if(!empty($_FILES[$fileElementName]['name']))
  			{ 
    			$extension=strstr($_FILES[$fileElementName]['name'], ".");
    			$extension=strtoupper($extension);
    			if ($extension!=".JPG" && $extension!=".GIF" && $extension!=".BMP" && $extension!=".JPEG")
     				{
      					$response['message']="Неправильный формат картинки.<br>Допускаются файлы следующего формата: JPG, JPEG, BMP";
      					$checkField=false; 
     				}
   				if(!empty($_FILES[$fileElementName]['error']))
					{
						$error=checkErr($_FILES[$fileElementName]['error']);
						
		  				$response['message']=$error;
				     }//if(!empty($_FILES[$fileElementName]['error']))
	 		$ext=array(".jpg", ".jpeg", ".bmp", ".gif");
	
	 		$flag=1;
			$photonewname=$idPoint.$extension;
			
	       	if (imageCreateFromJPEG($_FILES[$fileElementName]['tmp_name']))
    			{
					
     				if(move_uploaded_file($_FILES[$fileElementName]['tmp_name'],"../photos/$photonewname"))
       				 {
						$query = "UPDATE points set filename='".$photonewname."' where id=$idPoint";
						$res = mysql_query($query);
						$photo = $photonewname;
						makeImg($photo);
					}//if(move_uploaded_file($_FILES[$fileElementName]
				else
		 			$response['message'].="Не удалось скопировать файл с изображением";
 			}// if (imageCreateFromJPEG($_FILES[$fileElementName]['tmp_name']))
   		else
    	    $response['message'].="Неверный формат файла с изображением";
 		
		}// if(!empty($_FILES[$fileElementName]['name']))
	
   
	}//else if(!@mysql_select_db($dbname, $dbcnx))
   }// else if (!$dbcnx)
   $response['status']="ok";
  }//if( isset($_POST['lat']) && isset($_POST['lng']))
 else
  {$response['message']="Некорректный запрос"; 
   $response['status']="err";
  }
 }
 else
  {$response['message']="Неверный пароль"; 
   $response['status']="err";
  }
print json_encode($response);
?>