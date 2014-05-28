<?php
   	 $dblocation="mysql6.000webhost.com";  
	 $dbuser="a8987760_usermec";  
	 $dbpasswd="mec2014";  
         $dbname="a8987760_mec";
?>

<?
	function toUTF8($win1251)
	{
		return iconv( 'windows-1251', 'utf-8', $win1251 );
	}
?>