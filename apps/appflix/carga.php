<?php
 

/*
$rs = $conn->query("SELECT `id`, `tag`, `picture`, `title`, `description` FROM `work` LIMIT 999");
while($row = $rs->fetch(PDO::FETCH_OBJ)){

}

*/
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");
header("Content-type: text/html;charset=utf-8");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
 
/*
 
$dirs = array_filter(glob('*'), 'is_dir');

for ($i=0;$i<sizeof($dirs);$i++){ 
    $its = scandir($dirs[$i]);
     for ($a=0;$a<sizeof($its);$a++){ 
     echo "Pasta:".$dirs[$i]." -> ".$its[$a]."<br>";
     }
}
  */

 
  $its = scandir("data", 999);
 for ($a=0;$a<sizeof($its);$a++){
     echo $its[$a] . "<br>"; 
   try
    {
      carga("data/".$its[$a]);
   }
  catch (SomeException $e)
    {
      echo "Error ->".$its[$a] . "<br>";  
  }
      
   }  
 

function carga($movies){
      
    $conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
); 
    
$thefilmes = file_get_contents($movies);
     
$filmes = explode("#EXTINF", $thefilmes);  
$list = array(); 
for ($i=1;$i<sizeof($filmes);$i++)
{  
    
    if (strpos($filmes[$i], 'group-title') > 0) {
    
           if(strlen($filmes[$i]) > 2){
          $filme = trim($filmes[$i]);
    
    $linhas = explode(PHP_EOL, $filme);
    
    $logo = explode('tvg-logo="', $filme); 
    $logoRepl = str_replace('" ', ' ', $logo[1]);
    $logoFim = explode(" ",   $logoRepl );
    $title = explode('group-title=', $filme);
    $titleRepl = str_replace('"', ' ', $title[1]);
    $titleA = explode("http", $titleRepl);
    $titleFim = explode(" ,", $titleA[0]);
    $desc = explode('",', $filme);
    $descFim =   "--";

   //  echo $titleFim[1];
    // echo "<br>";echo "<br>";
               
    $sizeLinhas = sizeof($linhas) - 1; 
                
               $mPicture = castUTF8($logoFim[0]);
               $mDesc = castUTF8($titleFim[1]);
               $mCat = "0";
               $date = "0000-00-00";
               $mTitle = castUTF8($titleFim[0]);
                    
               if(substr_count(castUTF8($titleFim[0]), "pltv-subgroup")>0){
                   $mTitleX = explode("pltv-subgroup", castUTF8($titleFim[0]));
                   $mTitle=$mTitleX[0];
               }
               if(useSubTitle($mTitle)==1){
                   $sql = 'INSERT INTO videos (picture, title, subtitle, description,  url, category, release_date) VALUES ("'.$mPicture.'", "'.castUTF8($titleFim[1]).'", "'.castUTF8($titleFim[1]).'", "'.$mDesc.'", "'.castUTF8($linhas[$sizeLinhas]).'", "'.$mCat.'", "'.$date.'")'; 
                  $conn->exec($sql) ;
                }else{
                      $sql = 'INSERT INTO videos (picture, title, subtitle, description,  url, category, release_date) VALUES ("'.$mPicture.'", "'.$mTitle.'", "'.castUTF8($titleFim[1]).'", "'.$mDesc.'", "'.castUTF8($linhas[$sizeLinhas]).'", "'.$mCat.'",  "'.$date.'")'; 
                  $conn->exec($sql) ;
               }
               

            
              // print_r($sql);
              // echo "<br>";
    }
         
        
    }else{
      
         
            if(strlen($filmes[$i]) > 2){
          $filme = trim($filmes[$i]);
    
    $linhas = explode(PHP_EOL, $filme);
    
    $title = explode(', ', $filme);   
    $title2 = explode('http', $title[1]);   
    
    $sizeLinhas = sizeof($linhas) - 1; 
                 
               $mPicture = " ";
               $mDesc = castUTF8($title2[0]);
               $mCat = "0";
               $date = "0000-00-00";
               $title = castUTF8($title2[0]);
               $subtitle = castUTF8($title2[0]); 
                    
               if(substr_count($title, "pltv-subgroup")>0){
                   $mTitleX = explode("pltv-subgroup", $title);
                   $title=$mTitleX[0];
               }
                 
                if(useSubTitle($title)==1){
                  $sql = 'INSERT INTO videos (picture, title, subtitle, description,  url, category, release_date) VALUES ("'.$mPicture.'", "'.$subtitle.'", "'.$subtitle.'", "'.$mDesc.'", "'.castUTF8($linhas[$sizeLinhas]).'", "'.$mCat.'", "'.$date.'")';
                    $conn->exec($sql) ;  
                }else{
                    $sql = 'INSERT INTO videos (picture, title, subtitle, description,  url, category, release_date) VALUES ("'.$mPicture.'", "'.seriesCast($title).'", "'.$subtitle.'", "'.$mDesc.'", "'.castUTF8($linhas[$sizeLinhas]).'", "'.$mCat.'", "'.$date.'")';
                    $conn->exec($sql) ;  
                }
                   
 
        
 /* $data = [ 
            "title" => castUTF8($title2[0]), 
            "url" => castUTF8($linhas[$sizeLinhas]) 
          ];
$sql = "INSERT INTO videos (title, url) VALUES (:title, :url)";
$stmt= $conn->prepare($sql)->execute($data);
  */
        
            }
        
        
  /*  $ar = array(
            "id" => time(),
            "picture" => $logoFim[0],
            "title" => $titleFim[0],
            "description" => $descFim[0],
            "url" => $linhas[$sizeLinhas] 
        );
      array_push( $list, $ar); */
    }
 
}  
    
}

function useSubTitle($text){
    //Filmes,  Sessao Bonus, Classicos 
     $use = false;
      if(substr_count($text, "Filmes")>0){
         $use= true;echo "<br>".$text." A1";
       } else if(substr_count($text, "Sessao Bonus")>0){
         $use= true;echo "<br>".$text." A2";
       } else if(substr_count($text, "Classicos")>0){
         $use= true;echo "<br>".$text." A3";
       } else{
           $use= false;echo "<br>".$text." RES->".$use;
      }
       echo "<br>".$text." RES->".$use;
    return $use;
}

function seriesCast($text){
    $textFinal = $text;
      if(substr_count($text, "S1")>0){
         $textX =  explode("S1", $text);
         $textFinal =  $textX[0];
       }
      if(substr_count($text, "S2")>0){
                   $textX =  explode("S2", $text);
         $textFinal =  $textX[0];
       }
      if(substr_count($text, "S3")>0){
                  $textX =  explode("S3", $text);
         $textFinal =  $textX[0]; 
       }
      if(substr_count($text, "S4")>0){
                 $textX =  explode("S4", $text);
         $textFinal =  $textX[0];  
       }
      if(substr_count($text, "S5")>0){
               $textX =  explode("S5", $text);
         $textFinal =  $textX[0];    
       }
      if(substr_count($text, "S6")>0){
                 $textX =  explode("S6", $text);
         $textFinal =  $textX[0];  
       }
      if(substr_count($text, "S7")>0){
               $textX =  explode("S7", $text);
         $textFinal =  $textX[0];    
       }
      if(substr_count($text, "S8")>0){
           $textX =  explode("S8", $text);
         $textFinal =  $textX[0];        
       }
      if(substr_count($text, "S9")>0){
               $textX =  explode("S9", $text);
         $textFinal =  $textX[0];    
       }
       if(substr_count($text, "S10")>0){
              $textX =  explode("S10", $text);
         $textFinal =  $textX[0];     
       }
    return $textFinal;
}

function castUTF8($text){
      $fileEndEnd = mb_convert_encoding($text, 'HTML-ENTITIES', "UTF-8");
    return html_entity_decode($fileEndEnd);
// mb_convert_encoding($text, 'Windows-1252', 'UTF-8');
 }
  
function getDataMovies($text){
$query = rawurlencode("Rei leão");
$objeto = json_decode(file_get_contents('https://api.themoviedb.org/3/search/movie?api_key=a7e80a5116f8513c2a2e9eebaf100e89&language=pt-BR&query='.$query.'&page=1&include_adult=false'));
 
$item = null;
    
if(isset($objeto)) {
    if(sizeof($objeto->results) > 0) {
   // echo $objeto->results[0]->poster_path;
   // echo $objeto->results[0]->overview;
   $item = $objeto->results[0];
  }
}
    return $item;
}

//print_r(json_encode($list));
