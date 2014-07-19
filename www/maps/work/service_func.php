<?php
function head()
{
echo <<<HEAD
		 <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9"><a href="/" class="white-text" id="main-page-link">
                                <img src="http://mec-vlz.comuv.com/template/img/logo.png" class="pull-left" id="mini-logo">
                                <div id="text-title" class="white-text">    
                                     <h1>Мобильный энергетический комплекс</h1>

                                </div>
                                </a>
                    </div>
                </div>
            </div>      
        </header>
HEAD;
}	
function footer()
{
echo <<<FOOTER
	  <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="copyright  pull-left"><p>Copyright © 2013 ОАО «РусГидро»</p></div>
                        <div class="copyright-img">
                        <a href="http://www.mpei.ru/"><img src="http://avatars.yandex.net/get-avatar/4611686018427388290/ce4d903942d10fdff73c5d84f9f3a8cd-normal">
                            <a href="http://rushydro.ru/"><img src="http://mec-vlz.comuv.com/template/img/rusgidro.png" ></a>
                            <a href="http://volpi.ru/"><img src="http://mec-vlz.comuv.com/template/img/bf30879d02d6536be966df1620bbed8f_100x73.png">
                            
                        </div>
                </div>
            </div>
            <hr>
        </div>
    </footer>
FOOTER;
}
function connect_db()
{
	 require_once("../config/config.php");
	 $dbcnx=@mysql_connect($dbhost, $dbuser, $dbpass);
	 if (!$dbcnx)  
       return "Сервер базы данных недоступен!!!"; 
     else    
      { mysql_query("SET NAMES 'utf8';"); 
		if(!@mysql_select_db($dbname, $dbcnx))
		 return "Сервер базы данных недоступен??";
		else
		  return "ok";
	  }
}
?>
