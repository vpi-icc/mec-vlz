<?
	if ( count($_GET) > 0 )
	{
		$res = "You've submitted the following params: ";
		foreach ( $_GET as $param => $value ) {
			$res .= $param . ' => ' . $value . '; ';
		}
	}
	else $res = "No params";
	echo $res;