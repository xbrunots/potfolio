<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true"); 



ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

function castUTF8($text){
      $fileEndEnd = mb_convert_encoding($text, 'HTML-ENTITIES', "UTF-8");
    return html_entity_decode($fileEndEnd);
// mb_convert_encoding($text, 'Windows-1252', 'UTF-8');
 }



//search_category
if(isset($_GET["query"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
    
    $params = "";
    if(isset($_GET["params"])){
        $params =$_GET["params"];
    }
    
     
$commandd= "SELECT * FROM videos where title like '%".$_GET["query"]."%' ".$params." GROUP BY id desc";
      
 $users = $conn->query($commandd); 
    
foreach ($users as $row) {
    print  "<div> <img src='". $row["picture"] . "' style='width: 177px; height: 255px;'> " . $row["title"] ."<br/><a>ID: ".$row["id"] ."</a> <div>";
}
echo "<br/>";
foreach ($users as $row) {
    print $row["name"] . "-" . $row["sex"] ."<br/>";
} 
    
}

