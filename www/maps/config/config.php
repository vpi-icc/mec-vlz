<?php
    /*
   	 $dblocation="mysql6.000webhost.com";  
	 $dbuser="a8987760_usermec";  
	 $dbpasswd="rusgidro8443";  
         $dbname="a8987760_mec";
*/
    include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
?>

<?
	function toUTF8($win1251)
	{
		return iconv( 'windows-1251', 'utf-8', $win1251 );
	}
?>