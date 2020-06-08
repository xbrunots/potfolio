   
<?php 

include('db.php');
include("function.php"); 

ini();

function ini(){

$conn = new PDO(
    'mysql:host=mysql.hostinger.com;dbname=u915481333_torre', 'u915481333_torre', 'ana010118',
    array(
        PDO::ATTR_PERSISTENT => true
    )
);  
 

$sth = $conn->prepare( "insert into videos(picture, title,subtitle,description,episodio,temporada,url,extra,status,is_tv) 
      values('".$_POST['picture']."','".$_POST['title']."','".$_POST['subtitle']."','".$_POST['description']."',
      '".$_POST['episodio']."','".$_POST['temporada']."','".$_POST['url']."','".$_POST['extra']."',".$_POST['status'].",
      ".$_POST['is_tv']."); ");
$sth->execute();  
 
  
}

?>