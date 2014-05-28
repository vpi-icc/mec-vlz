
<!DOCTYPE html>
<html>
    <head>
	<title>Мобильный энергетический комплекс - <?php if(isset($title)) {echo $title;}; ?> </title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">
	<link  href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/css/main.css" type="text/css" rel="stylesheet">
    <link  href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/css/page.css" type="text/css" rel="stylesheet">
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/css/ieFix.css" />
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/js/ieFix.js" type="text/javascript"></script>
    <![endif]-->
    <?php if(isset($extraStyleSheets)) {echo $extraStyleSheets;}; ?>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-9"><a href="/" class="white-text" id="main-page-link">
                                <img src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/img/logo.png" class="pull-left" id="mini-logo">
                                <div id="text-title" class="white-text">    
                                     <h1>Мобильный энергетический комплекс</h1>

                                </div>
                                </a>
                    </div>
                </div>
            </div>      
        </header>
        <div class="root">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="content">
                            <?php include "content.php";
                            ?>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="copyright  pull-left"><p>Copyright © 2013-2014 ОАО «РусГидро»</p></div>
                        <div class="copyright-img">
                        <a href="http://www.mpei.ru/"><img src="http://avatars.yandex.net/get-avatar/4611686018427388290/ce4d903942d10fdff73c5d84f9f3a8cd-normal"></a>
                            <a href="http://rushydro.ru/"><img src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/img/rusgidro.png" ></a>
                            <a href="http://volpi.ru/"><img src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/img/bf30879d02d6536be966df1620bbed8f_100x73.png"></a>
                            
                        </div>
                </div>
            </div>
            <hr>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src=http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/js/main.js" type="text/javascript"></script>
	<script src="http://<?php echo $_SERVER['SERVER_NAME'] ?>/template/js/bootstrap.min.js" type="text/javascript"></script>
    <?php if(isset($extraScripts)) {echo $extraScripts;}; ?>
    </body>
</html>