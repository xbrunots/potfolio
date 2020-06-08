    
<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $picture = '';
  if($_FILES["user_picture"]["name"] != '')
  {
   $picture = upload_picture();
  }
  $statement = $connection->prepare("
   INSERT INTO videos (title, url, picture) 
   VALUES (:title, :url, :picture)
  ");
  $result = $statement->execute(
   array(
    ':title' => $_POST["title"],
    ':url' => $_POST["url"],
    ':picture'  => $picture
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }
 if($_POST["operation"] == "Edit")
 {
  $picture = '';
  if($_FILES["user_picture"]["name"] != '')
  {
   $picture = upload_picture();
  }
  else
  {
   $picture = $_POST["hidden_user_picture"];
  }
  $statement = $connection->prepare(
   "UPDATE videos 
   SET title = :title, url = :url, picture = :picture  
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
    ':title' => $_POST["title"],
    ':url' => $_POST["url"],
    ':picture'  => $picture,
    ':id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }
}

?>
   