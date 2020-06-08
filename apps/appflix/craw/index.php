<?php 
$canal = 'tenis';
$limit = '16';

if(isset($_GET['q'])){
  $canal = $_GET['q'];
}

if(isset($_GET['limit'])){
  $limit = $_GET['limit'];
}
 
$uuurl = 'https://atacadobarato.com.br/buscar.html?search=Tenis+'.$canal.'&limit='.$limit;
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
if(isset($_GET['DEBUG'])){
  ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
}

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
      if($name!=null){
         $videos[] = [
                'name' => $name->children(0)->plaintext,
                'type' => $name->children(1)->plaintext,
                'time' => $other->plaintext, 
        ];
     }
      

        $i++;
  } 
 */ 

  foreach ($html->find('.product') as $video) {
         $pic = $video->find('.left', 0); 
         $image = $pic->find('.image', 0); 
         $imageA = $image->find('a', 0); 
         $url = $imageA->href;
         $imgA = $imageA->find('img', 0); 
         $imgSRC = str_replace('228x228','700x600',$imgA->src); 
    
         $data = $video->find('.right', 0); 
         $dataA = $data->find('.name', 0); 
         $dataName = $dataA->find('a', 0); 
         $name = $dataName->plaintext; 
         
         $price = $data->find('.price-old', 0)->plaintext;  
         $priceNew = $data->find('.price-new', 0)->plaintext;  
      
     $priceNumber   = explode("R$", $price)[1];
     $priceNewX   = explode("R$", $priceNew)[1];
     $priceNewNumber   = explode(",", $priceNewX)[0].",90";
      
    $reversedParts = explode('_', strrev($imgSRC), 2);
    $reversedParts2 = explode('_', strrev(strrev($reversedParts[1])), 2);
    
    $sss1 = explode('-',strrev($reversedParts[0]))[0];
    
    //echo strrev($reversedParts[0])."<br>";
   // echo strrev($reversedParts2[0])."<br>";
   // echo strrev($reversedParts2[0])."<br>";
   //  picture1: "https://www.mixbarato.com.br/image/cache/catalog/2018/camisas/adidas/dri-fit/200118/camisa_adidas_dri-fit_200118_001-700x600.jpg",

    
    $imgSRC2 =  $sss1+1;  
    $imgSRC3=   $sss1+2;  
     
    $pic2 =  str_replace($sss1."-", $imgSRC2."-",$imgSRC);
    $pic3 =  str_replace($sss1."-", $imgSRC3."-",$imgSRC);
     
    if($name!=null){
         $videos[] = [
                'name' => $name,
                'category' => 'tenis',
                'picture1' => $imgSRC, 
                'picture2' => $pic2, 
                'picture3' => $pic3, 
                'url' => $url,
                'priceString' => $price,
                'priceString_new' => $priceNew,
                'price' =>  $priceNumber,
                'price_new' =>   $priceNewNumber
        ];
     }
      

        $i++;
  } 
 

echo '{
"configs":{"itens":'.count($videos).'},
"result":'.json_encode($videos, JSON_PRETTY_PRINT).'}'; 
 

 
 
