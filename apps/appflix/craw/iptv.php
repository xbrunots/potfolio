<?php 
$canal = 'HBO';

if(isset($_GET['q'])){
  $canal = $_GET['q'];
}
 
$uuurl = 'https://www.oneplaylist.space/';
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

 include "simplehtmldom/simple_html_dom.php"; 
 

// Create DOM from URL or file
$html = file_get_html($uuurl);

// creating an array of elements
$videos = [];

// Find top ten videos
$i = 1; 
/*
   foreach ($html->find('.devicepadding') as $video) {
         $name = $video->find('.licontent', 0);
        $name3 = $video->find('.licontent', 0);
        $other = $video->find('.lileft', 0);  
      if($name!=null){style="color:#06C"
         $videos[] = [
                'name' => $name->children(0)->plaintext,
                'type' => $name->children(1)->plaintext,
                'time' => $other->plaintext, 
        ];
     }
      

        $i++;
  } 
 */ 

  foreach ($html->find('span') as $video) {
         $name = $video->find('style="color:#06C"', 0); 
         $pais= $video->find('style="color:#000"', 0); 
      if($video!=null && strpos($video->style,'#06C')!==false && strpos($video.plaintext, 'lista')!==false){
         $videos[] = [
           'pais' => $pais->plaintext,
           'url' => $video->plaintext
           
        ];
     }
      

        $i++;
  } 
 


echo json_encode($videos);
 
 
