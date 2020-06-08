<?php 

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
header("Content-type: text/html;charset=utf-8");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
error_reporting(0);

if(isset($_GET['server'])){
  
}else{
  //$server = file_get_contents('servers/pandoraIPTV');
  echo 'Defina um nome de server para abrir a conexão';
  die;
}

 $server = './servers/'. $_GET['server'];  
$archive = file_get_contents($server);
$array = explode("#EXTINF:", explode('#EXTM3U',$archive)[1]);
 if(strpos($archive, '#EXTM3U')===false){
   $array = explode("#EXTINF:", $archive);
 } 
     
  $videos = []; 
$id = 0;
foreach ($array as &$value) {    
 
$media =  explode(PHP_EOL, $value); 
  if($media[1]!=null) {
    $named = "";
    if(strpos($media[0], ',')===false){
      $named = trim(explode('-1',$media[0] )[1]);
    }else{
      $named = trim(explode(',',$media[0] )[1]);
    }
    
    $tag = str_replace('TV','',str_replace('CHANNEL','',str_replace('TV','',str_replace('NETWORK','',$named))));
    $tags = explode(' ',$named);
    
    if(strpos($named, '--')===false && 
       strpos($named, '==')===false && 
       strpos($named, '//')===false &&
       strlen ($named) > 1 &&
       $media[1]!=null){
    $videos[] = [
           'id' => $id++, 
           'name' => $named, 
           'subname' => $named, 
           'server' => $server, 
           'picture' => "https://i.ibb.co/QQWRR97/Banners-520x315-1.png", 
           'tag' =>    $tags,
           'url' => trim($media[1])
                   ];
   
  }
  }
} 
  
echo '{"result":'.json_encode($videos, JSON_PRETTY_PRINT).'}'; 
