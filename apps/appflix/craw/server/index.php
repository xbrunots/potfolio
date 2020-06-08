<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8"); 


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
  
//$server = file_get_contents('./tvclube/servers/');
 
//$array = explode("#EXTINF:", explode('#EXTM3U',$server)[1]);
   

 $videos = [];
$id = 1000; 
 $its = scandir('./tvclube/servers/', 999);
 for ($a=0;$a<sizeof($its);$a++){ 
   try
    {
     if($its[$a]!="." && $its[$a]!=".." && $its[$a]!="..."){
       $videos[] = [
           'id' => $id++, 
           'name' => $its[$a] 
                   ];
     }
           
   }
  catch (SomeException $e)
    {
      echo "Error ->".$its[$a] . "<br>";  
  }
      
   }  
 

echo '{"result":'.json_encode($videos, JSON_PRETTY_PRINT).'}'; 

 
