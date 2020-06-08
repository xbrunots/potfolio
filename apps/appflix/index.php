<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

function castUTF8($text){
      $fileEndEnd = mb_convert_encoding($text, 'HTML-ENTITIES', "UTF-8");
    return html_entity_decode($fileEndEnd);
// mb_convert_encoding($text, 'Windows-1252', 'UTF-8');
 }

if(isset($_GET["search_groups"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
    
$query = trim($_GET["search_groups"]);  
$limit_de = "0" ;
$limit_ate  = "200";
    $categoria = "";
    $rexx = "";
    
    if(isset($_GET["limit_de"])){
      $limit_de = $_GET["limit_de"];
    }
    if(isset($_GET["limit_ate"])){
     $limit_ate = $_GET["limit_ate"];
   }
     $params = "";
     
    if(isset($_GET["params"])){
         $params = $_GET["params"];
    }
    
   
    
    
    if(isset($_GET["mode"]) && $_GET["mode"]=="all"){
        

$sth = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where status > 0 and  title like  '%".$query."%' GROUP BY title ".$params." LIMIT ".$limit_de.", ".$limit_ate);
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
    
     
 $rexx = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).'}'; 
        
    }else{
   
$sth = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where status > 0 and  title like  '%".$query."%' GROUP BY title ".$params." LIMIT ".$limit_de.", ".$limit_ate);
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC);      
    
//acao 
$sth_aventura = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where  
                             status > 0 and    title like  '%".$query."%' and category like '%,28,%' or
                             status > 0 and    title like  '%".$query."%' and category like '%,80,%' or
                             status > 0 and    title like  '%".$query."%' and category like '%,36,%' or 
                             status > 0 and    title like  '%".$query."%' and category like '%,10752,%' or 
                             status > 0 and    title like  '%".$query."%' and category like '%,37,%' or
                             status > 0 and    title like  '%".$query."%' and category like '%,12,%' 
                                GROUP BY title ".$params." limit 300");
$sth_aventura->execute(); 
$result3 = $sth_aventura->fetchAll(\PDO::FETCH_ASSOC);  
    
    
    
    
    
    //fantasia 
$sth_fantasia = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where  
                             status > 0 and    title like  '%".$query."%' and category like '%,14,%' or
                             status > 0 and    title like  '%".$query."%' and category like '%,27,%' or
                             status > 0 and    title like  '%".$query."%' and category like '%,9648,%' or 
                             status > 0 and    title like  '%".$query."%' and category like '%,878,%' or
                             status > 0 and status > 0 and    title like  '%".$query."%' and category like '%,12,%' 
                                GROUP BY title ".$params." limit 300");
$sth_fantasia->execute(); 
$result4 = $sth_fantasia->fetchAll(\PDO::FETCH_ASSOC);  
    
    
    
    
    //morte 
$sth_terror = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where  
                             status > 0 and    title like  '%".$query."%' and category like '%,53,%' or
                             status > 0 and    title like  '%".$query."%' and category like '%,27,%' or
                            status > 0 and     title like  '%".$query."%' and category like '%,18,%' or 
                            status > 0 and     title like  '%".$query."%' and category like '%,80,%'   
                                GROUP BY title ".$params." limit 300");
$sth_terror->execute(); 
$result5 = $sth_terror->fetchAll(\PDO::FETCH_ASSOC);  
    
    
        
    
//familia 
$sth_familia = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where  
                             status > 0 and    title like  '%".$query."%' and category like '%,10770,%' or
                             status > 0 and    title like  '%".$query."%' and category like '%,10749,%' or
                             status > 0 and    title like  '%".$query."%' and category like '%,10402,%' or 
                             status > 0 and    title like  '%".$query."%' and category like '%,35,%' or 
                             status > 0 and    title like  '%".$query."%' and category like '%,36,%' or 
                              status > 0 and   title like  '%".$query."%' and category like '%,10751,%'   
                                GROUP BY title ".$params." limit 300");
$sth_familia->execute(); 
$result6 = $sth_familia->fetchAll(\PDO::FETCH_ASSOC);  
    
        
    
//ciencia 
$sth_ciencia = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where  
                              status > 0 and   title like  '%".$query."%' and category like '%,99,%'status > 0    or
                            status > 0 and  title like  '%".$query."%' and category like '%,878,%'     
                                GROUP BY title ".$params." limit 300");
$sth_ciencia->execute(); 
$result7 = $sth_ciencia->fetchAll(\PDO::FETCH_ASSOC);  
    
    
    
//comedia 
$sth_comedia = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where status > 0 and   
                                title like  '%".$query."%' and category like '%,35,%'     
                                GROUP BY title ".$params." limit 300");
$sth_comedia->execute(); 
$result8 = $sth_comedia->fetchAll(\PDO::FETCH_ASSOC);  
    
          
    
    
$sth_xxxx = $conn->prepare("SELECT * from promo where status > 0");
$sth_xxxx->execute(); 
$resultXXX = $sth_xxxx->fetchAll(\PDO::FETCH_ASSOC); 
    
    
    
    
    //3,4,5,6,7
    
    
  // echo utf8_decode($saida['setor'])
     
 $rexx = '{"aventura":'.json_encode($result3, JSON_PRETTY_PRINT).','.
  '"fantasia":'.json_encode($result4, JSON_PRETTY_PRINT).','.
  '"terror":'.json_encode($result5, JSON_PRETTY_PRINT).','.
  '"familia":'.json_encode($result6, JSON_PRETTY_PRINT).','.
  '"comedia":'.json_encode($result8, JSON_PRETTY_PRINT).','.
  '"ciencia":'.json_encode($result7, JSON_PRETTY_PRINT).','. 
   '"config":'.json_encode($resultXXX, JSON_PRETTY_PRINT).'}';
     //'"result":'.json_encode($result, JSON_PRETTY_PRINT ).'}';
    }
    
    
    $rexx = json_decode(
    json_encode(
        iconv(
            mb_detect_encoding($rexx, mb_detect_order(), true),
            'UTF-8',
            $rexx
        )
    ),
    true
    );
    //iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);

 echo $rexx;
    
}






if(isset($_GET["categorias"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
    
$query = trim($_GET["categorias"]);  
    $params = "";
      if(isset($_GET["params"])){
         $params = $_GET["params"];
    }
     
    
  
$sth = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where status > 0 and category LIKE '%,".$query.",%'  GROUP BY title   ".$params );
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
    
     
 $ssss = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).'}'; 
          
    
    
 echo $ssss;
    
}





if(isset($_GET["error"]) && isset($_GET["server"]) && isset($_GET["canal"]) ){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
    
$server = trim($_GET["server"]); 
$canal = trim($_GET["canal"]);   
      
$sth = $conn->prepare(" INSERT INTO `reports`( `server`, `canal`) VALUES ('".$server."','".$canal."') ");
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
     
 $ssss = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).'}'; 
     
 echo $ssss;
    
}


if(isset($_GET["reports"]) ){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
      
$sth = $conn->prepare("select * from reports");
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
     
 $ssss = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).'}'; 
     
 echo $ssss;
    
}





//






 



if(isset($_GET["search"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
    $limit_de = "0" ;
$limit_ate  = "200";
$query = trim($_GET["search"]);  
    $params = "";
      if(isset($_GET["params"])){
         $params = $_GET["params"];
    }
    
        if(isset($_GET["limit_de"])){
      $limit_de = $_GET["limit_de"];
    }
    if(isset($_GET["limit_ate"])){
     $limit_ate = $_GET["limit_ate"];
   } 
    
        

$sth = $conn->prepare("SELECT *, COUNT(title) AS episodios FROM videos where status > 0 and title like  '%".$query."%' ".$params." GROUP BY title  LIMIT ".$limit_de.", ".$limit_ate); 
    
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
    
     
$sth_xxxx = $conn->prepare("SELECT * from promo where status > 0");
$sth_xxxx->execute(); 
$resultXXX = $sth_xxxx->fetchAll(\PDO::FETCH_ASSOC); 
    
 $rexx = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).','. 
  ' "config":'.json_encode($resultXXX, JSON_PRETTY_PRINT).'}';  
      
    
    
 echo $rexx;
    
}



if(isset($_GET["tvclube"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
     
     
$sth_xxxx = $conn->prepare("SELECT * from tvclube where status > 0  ");
$sth_xxxx->execute(); 
$resultXXX = $sth_xxxx->fetchAll(\PDO::FETCH_ASSOC); 
     
     
$sth_xxxx3 = $conn->prepare("SELECT * from tvclube where status > 0 group by subname ");
$sth_xxxx3->execute(); 
$resultXXX3 = $sth_xxxx3->fetchAll(\PDO::FETCH_ASSOC); 
    
  $sth_xxxx1 = $conn->prepare("SELECT category as name, COUNT(category) AS size FROM tvclube GROUP BY category order by category desc ");
$sth_xxxx1->execute(); 
$resultXXX1 = $sth_xxxx1->fetchAll(\PDO::FETCH_ASSOC); 
    
 $rexx = '{"category":'.json_encode($resultXXX1, JSON_PRETTY_PRINT) .','.  
   '"group":'.json_encode($resultXXX3, JSON_PRETTY_PRINT) .','.  
    '"result":'.json_encode($resultXXX, JSON_PRETTY_PRINT) .'}';  
       
 echo $rexx;
    
}





if(isset($_GET["config"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
     
     
$sth_xxxx = $conn->prepare("SELECT * from promo where status > 0");
$sth_xxxx->execute(); 
$resultXXX = $sth_xxxx->fetchAll(\PDO::FETCH_ASSOC); 
    
 $rexx = '{"result":'.json_encode($resultXXX, JSON_PRETTY_PRINT) .'}';  
       
 echo $rexx;
    
}


if(isset($_GET["open"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
     
     
$sth_xxxx = $conn->prepare("SELECT * from videos where status > 0 and id =".$_GET["open"]);
$sth_xxxx->execute(); 
$resultXXX = $sth_xxxx->fetchAll(\PDO::FETCH_ASSOC); 
    
 $rexx = '{"result":'.json_encode($resultXXX, JSON_PRETTY_PRINT) .'}';  
       
 echo $rexx;
    
}








if(isset($_GET["filmes"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
$limit_de = "0" ;
$limit_ate  = "502";
$query = trim($_GET["filmes"]);  
    $params = "";
      if(isset($_GET["params"])){
         $params = $_GET["params"];
    }
    
        if(isset($_GET["limit_de"])){
      $limit_de = $_GET["limit_de"];
    }
    if(isset($_GET["limit_ate"])){
     $limit_ate = $_GET["limit_ate"];
   } 
  
  $categoria = "";
  
  if(isset($_GET['category'])){
      $categoria = " and category like '".$_GET['category']."'";
  } 
  
  
  $queryString = "SELECT * FROM videos where 
status > 0 and title like  '%"  .$query."%'  ".  $categoria." and temporada is null ".$params." and is_tv is null 
or 
 viewtype = 1 and status > 0 
 ORDER BY viewtype desc, date desc LIMIT ".$limit_de.", ".$limit_ate;

  
  // echo $queryString; die;
    $sth = $conn->prepare($queryString); 
     
     
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
    
     
$sth_xxxx = $conn->prepare("SELECT * from promo where status > 0");
$sth_xxxx->execute(); 
$resultXXX = $sth_xxxx->fetchAll(\PDO::FETCH_ASSOC); 
    
 $rexx = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).'}';  
    
    
 echo $rexx;
    
}


if(isset($_GET["test_url"])){
  corrigirUndefined();
}
    function corrigirUndefined(){
    $conn = new PDO(
        'mysql:host=sql157.main-hosting.eu;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
        array(
              PDO::ATTR_PERSISTENT => true
              )
        );

    $commandoSql="SELECT id,title, url from videos limit 10";
    $rs = $conn->query($commandoSql); 
     //$users = $stm->fetchAll();
      $cont = 0;
    foreach ($rs as $row) { 
      if(endereco_existe($row['url'])){
echo " Video:".$row['title']." id: ".$row['id']." verificado e OK <br><br>";
}else{
  echo " Alterando Status do video :".$row['title']." id: ".$row['id']." para OFFLINE";
  //$sql = 'UPDATE videos set status = 0 where id = '.$row['id'];
  //$conn->exec($sql);
    $cont=$cont+1;
      if($cont==39){
        $cont= 0;
        print_r("Pause para evitar estouro DDOs");
        sleep(10);
    } 
  
        
}
      
    } 
       
}


function endereco_existe($url) {  
    $h = get_headers($url);
    $status = array();
    preg_match('/HTTP\/.* ([0-9]+) .*/', $h[0] , $status);
    return ($status[1] == 200);
} 

if(isset($_GET["series"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
$limit_de = "0" ;
$limit_ate  = "502";
$query = trim($_GET["series"]);   
    
        if(isset($_GET["limit_de"])){
      $limit_de = $_GET["limit_de"];
    }
    if(isset($_GET["limit_ate"])){
     $limit_ate = $_GET["limit_ate"];
   } 
    
      $params = "";
      if(isset($_GET["params"])){
         $params = $_GET["params"];
    }
    
    $categoria = "";
  
  if(isset($_GET['category'])){
      $categoria = " and category like '".$_GET['category']."'";
  } 
        
//viewtype = 1 /promo filmes
//viewtype = 2 /promo series
 
//viewtype = 3 /promo tv

  $sqlCmd=  " select distinct title, episodio, temporada, COUNT(temporada) as temporadas, videos.* from videos  
	  WHERE 
    title like '%".$query."%' and    temporada IS NOT null AND     is_tv is null and    STATUS > 0 ".$params."   " . $categoria."
    or viewtype = 2 and status > 0   GROUP BY title  ORDER BY viewtype desc, date desc LIMIT ".$limit_de.", ".$limit_ate;
   // echo $sqlCmd; die;
   
     // echo $sqlCmd; die;
  
  $sth = $conn->prepare( $sqlCmd);
       
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
     
     $rexx = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).'}' ;   
 echo $rexx;
    
}








if(isset($_GET["tv_online"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
$limit_de = "0" ;
$limit_ate  = "502";
$query = trim($_GET["tv_online"]);   
    
        if(isset($_GET["limit_de"])){
      $limit_de = $_GET["limit_de"];
    }
    if(isset($_GET["limit_ate"])){
     $limit_ate = $_GET["limit_ate"];
   } 
    
      $params = "";
      if(isset($_GET["params"])){
         $params = $_GET["params"];
    }
    
    $categoria = "";
  
  if(isset($_GET['category'])){
      $categoria = " and category like '".$_GET['category']."'";
  } 
         

  $sqlCmd=  " select * from tv  
	  WHERE 
    title like '%".$query."%' and  STATUS > 0 ".$params."   " . $categoria." ORDER BY title limit ".$limit_de.", ".$limit_ate;
   // echo $sqlCmd; die;
   
     // echo $sqlCmd; die;
  
  $sth = $conn->prepare( $sqlCmd);
       
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
     
     $rexx = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).'}' ;   
 echo $rexx;
    
}












if(isset($_GET["tv"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
$query = trim($_GET["tv"]);   
     
        

$sth = $conn->prepare("  SELECT * FROM videos WHERE title like '%".$query."%' and is_tv = true ");
	   
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
    
     
$sth_xxxx = $conn->prepare("SELECT * from promo where status > 0 and viewtype = 3");
$sth_xxxx->execute(); 
$resultXXX = $sth_xxxx->fetchAll(\PDO::FETCH_ASSOC); 
    
 $rexx = '{"result":'.json_encode($result, JSON_PRETTY_PRINT).'}' ;  
      
    
    
 echo $rexx;
    
}










 






//search_category
if(isset($_GET["search_category"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
    $str2 = substr_replace($_GET["search_category"], ' ', -1);
    $str = substr($str2,  1); 
    
    $query =  explode(",",trim($str));
    $ssss = "";
     
  foreach ($query as $stringArray)
  {
	$ssss = " trim(category) like '%".$stringArray."%' or ".$ssss;
  }
     
$commandd= "SELECT *, COUNT(title) AS episodios FROM videos where ".substr_replace($ssss, ' ', -3)." and temporada is null and status > 0  GROUP BY title  limit 30 ";
      
$sth = $conn->prepare($commandd);
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
     
 $re3 = '{"result":'.json_encode($result, JSON_PRETTY_PRINT ).'}';
 echo $re3;
    
}

if(isset($_GET["serie_item"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
   $query = trim($_GET["serie_item"]);   
     
$cccc= "SELECT temporada FROM videos WHERE  trim(title) = '".$query."' GROUP BY temporada";
$sthx = $conn->prepare($cccc);
$sthx->execute(); 
$temporada = $sthx->fetchAll(\PDO::FETCH_ASSOC); 
     
    
    
$commandd= "SELECT * FROM videos where trim(title) = '".$query."'";
$sth = $conn->prepare($commandd);
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
    
     
 $re3 = '{"result":'.json_encode($result, JSON_PRETTY_PRINT ).','.
  ' "temporadas":'.json_encode($temporada, JSON_PRETTY_PRINT ).'}';
 echo $re3;
    
}

/*

if(isset($_GET["series"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
    
$query = trim($_GET["series"]);  
    $limit_de = "0" ;
$limit_ate  = "500";
    
    
    if(isset($_GET["limit_de"])){
      $limit_de = $_GET["limit_de"];
    }
    if(isset($_GET["limit_ate"])){
     $limit_ate = $_GET["limit_ate"];
   }
    
$sth = $conn->prepare("  SELECT title, COUNT(title)  AS total   FROM videos where title like  '%".$query."%' or description like  '%".$query."%'  GROUP BY title LIMIT ".$limit_de.", ".$limit_ate);
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
echo json_encode($result, JSON_PRETTY_PRINT );
    
}

*/

if(isset($_GET["favoritos"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
    
$sth = $conn->prepare("SELECT videos.* FROM videos 
INNER JOIN favoritos ON videos.id = favoritos.idVideo
where videos.status > 0 and favoritos.email =  '".$_GET["favoritos"]."' 
ORDER BY favoritos.date DESC  ");
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
 echo  '{"result":'.json_encode($result, JSON_PRETTY_PRINT ).'}'; 
    
}




if(isset($_GET["stories"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
    
$sth = $conn->prepare(" SELECT * from stories where status = 1 order by date desc");
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
  
  $sth1 = $conn->prepare(" SELECT * from promo where status = 1 and type = 1  order by date desc");
$sth1->execute(); 
$result1 = $sth1->fetchAll(\PDO::FETCH_ASSOC);
  
  $sth2 = $conn->prepare(" SELECT * from promo where status = 1  and type = 2  order by date desc");
$sth2->execute(); 
$result2 = $sth2->fetchAll(\PDO::FETCH_ASSOC);
        
     
 echo   '{"result":'.json_encode($result, JSON_PRETTY_PRINT ).','.
        '"filmes":'.json_encode($result1, JSON_PRETTY_PRINT ).','. 
        '"series":'.json_encode($result2, JSON_PRETTY_PRINT ).'}'; 
  
    
}

//remove_favorito


if(isset($_GET["remove_favorito"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
  
  
  $id = $_GET["remove_favorito"];
  $email = $_GET["email"]; 
        
$sth = $conn->prepare(" DELETE FROM favoritos WHERE idVideo = ".$id." and email = '".$email."'");
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
  
 $retorno = '{"status":"ok","statusBool": true}';   
 echo  $retorno; 
      
}






if(isset($_GET["favoritar"])){
$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);   
  
  
  $id = $_GET["favoritar"];
  $email = $_GET["email"];
  $retorno = ' {"status":false,"message":"item ja favoritado"}';
  if(countFavoritos($email,$id)>0){
    $retorno = ' {"status":false,"message":"item ja favoritado"}';
  }else{
        
$sth = $conn->prepare("INSERT INTO favoritos (idVideo, email) VALUES ( '".$id."', '".$email."')");
$sth->execute(); 
$result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
 $retorno = '{"status":true ,"message":"Item adicionado a lista de favoritos com sucesso!"}';  
        
  }
  
 echo  $retorno; 
      
}






function countFavoritos($mail, $id){
 $conn = new PDO(   'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',   array(      PDO::ATTR_PERSISTENT => true   )); 
 
$sql = "SELECT count(*) FROM `favoritos` WHERE trim(email) = '".trim($mail)."' and  idVideo = ".trim($id); 
$result = $conn->prepare($sql); 
$result->execute();  
   
  return    $result->fetchColumn(); 
    
}


