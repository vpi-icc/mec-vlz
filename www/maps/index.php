<?php header('Content-type: text/html; charset=utf-8');
require_once("work/service_func.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <script src="scripts/jquery-1.9.1.js"></script>
  <script src="scripts/jquery-ui-1.10.3.custom.js"></script>
  <script src="scripts/jquery.validate.js"></script>
  <script src="scripts/jquery.ui.datepicker-ru.js"></script>
  <script src="scripts/ajaxfileupload.js"></script>
    <link rel="stylesheet" type="text/css" href="css/mec.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/page.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.custom.css" >
     <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
     <link  href="../css/page.css" type="text/css" rel="stylesheet">
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC2U2uxHdXagBgNb6PSsYxp-SmlUSyXv1s&sensor=true">
    </script>
     <script src="scripts/mecScripts.js"></script>
     <title>Мобильный энергетический комплекс. Геолокация</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
  <body>
<div id="map_content">
<?  
    head();
?>
   <div> 
     <div id="map_canvas"></div>
     <div id="pointInfo">
     <form method="post" action="javascript:sendForm()" id="savePointFrm" enctype="multipart/form-data">
       <span>Информация о точке</span>
       <div style="padding:5px; text-align:left">
         <p><div>
           <input type="text" placeholder="Введите название точки" id="title" name="title"/>
           
          </div>
           <label class="control-label" for="inputSuccess">Описание точки</label>
          <textarea rows="5" id="desc" name="desc"></textarea>
          
         <table>
           <tr>
             <td><span class="spnPointInfo">Развернут...</span>
              </td>
             <td> <input type="text" placeholder="выберите дату" id="datefrom" name="datefrom"/></td>
            </tr>
           <tr>
             <td><span class="spnPointInfo">Свернут...</span>
              </td>
             <td><input type="text" placeholder="выберите дату" id="dateto" name="dateto"/>
              </td>
            </tr>
         </table>
           <label class="checkbox" style="width:200px">
             <input type="checkbox" value="" name="isActive" id="isActive">
             Текущее положение МЭК
           </label>
          
         </p>
         <input type="hidden" name="idPoint" value="0" id="idPoint">
         <input type="hidden" name="fileName" value="" id="fileName">
         <input type="hidden" name="MAX_FILE_SIZE" value="4048000">
         <input type="file" placeholder="Выберите изображение" id="imgPict" name="imgPict" />
          <input type="password" placeholder="Введите пароль" id="passwd" name="passwd"/>
       </div>
      
       <div id="pointButtons" style=" position: absolute;bottom: 0px; ">
 		<button  type="submit"  class="btn btn-success" style="float:left; margin-right:20px" id="btnSavePoint">Сохранить</button> 
        <button type="button" class="btn btn-warning" style="float:left;  margin-right:20px" id="btnCancelPoint">Отмена</button>
        <button type="button" class="btn btn-danger" style="float:left" id="btnRemPoint">Удалить</button>
        <div style="float:left; margin-left:10px; font-size:16px"><span id="status" class="text-error"></span></div>
       </div>
       </form>
       </div>
          
     <div style="clear:both"></div>
   </div>
   <div class="btn btn-primary" id="btnAddPoint">Добавить точку</div>
   <div style="height:88px"></div>
   </div>
<? footer();
?>

  </body>
</html>