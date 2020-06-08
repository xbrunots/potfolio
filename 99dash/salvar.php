   
<?php

include('db.php');
include("function.php");

if(isset($_POST["user_id"]))
{  
     
     
 $statement = $connection->prepare(
   "UPDATE videos set title='".$_POST["title"]."', url='".$_POST["url"]."', picture='".$_POST["picture"]."' , category='".$_POST["category"]."'  WHERE id = :id"
 );
 $result = $statement->execute(
  array(
   ':id' => $_POST["user_id"]
  )
 );
 
 if(!empty($result))
 {
  echo 'Data Saved';
 }
}



?>