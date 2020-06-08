<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: text/html; charset=UTF-8");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

function castUTF8($text){
      $fileEndEnd = mb_convert_encoding($text, 'HTML-ENTITIES', "UTF-8");
    return html_entity_decode($fileEndEnd);
// mb_convert_encoding($text, 'Windows-1252', 'UTF-8');
 }

//id, picture, title, subtitle, url 







if(isset($_POST['form_submitted'])){
    var_dump($_POST);
}else{
       $conn = new PDO(
        'mysql:host=sql157.main-hosting.eu;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
        array(
              PDO::ATTR_PERSISTENT => true
              )
        );

    $commandoSql = " SELECT * FROM videos";
    $rs = $conn->query($commandoSql);

    $cont = 0; 
    foreach ($rs as $row) { 
echo '<form action="/manager.php" method="POST" style="    display: flex;">
<img src="'.$row['picture'].'" style="
    height: 80px;
">

    ID: 
  <input type="text" name="id" value="'.$row['id'].'" disabled>
  
  PICTURE: 
  <input type="text" name="picture"  value="'.$row['picture'].'" >
  TITLE: 
  <input type="text" name="title"  value="'.$row['title'].'" >
  SUBTITLE: 
  <input type="text" name="subtitle"  value="'.$row['subtitle'].'" >
  URL: 
  <a href="'.$row['url'].'" target="_blank">ABRIR URL</a>
  <input type="text" name="url"  value="'.$row['url'].'" >
   <input type="hidden" name="form_submitted" value="1" />
  <input type="submit" value="Submit">
    </form> ';
      }
  
    
}