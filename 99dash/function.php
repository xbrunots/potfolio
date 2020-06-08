    
<?php

function upload_picture()
{
 if(isset($_FILES["user_picture"]))
 {
  $extension = explode('.', $_FILES['user_picture']['name']);
  $new_name = rand() . '.' . $extension[1];
  $destination = './upload/' . $new_name;
  move_uploaded_file($_FILES['user_picture']['tmp_name'], $destination);
  return $new_name;
 }
}

function get_picture_name($user_id)
{
 include('db.php');
 $statement = $connection->prepare("SELECT videos FROM videos WHERE id = '$user_id'");
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  return $row["picture"];
 }
}

function get_total_all_records()
{
 include('db.php');
 $statement = $connection->prepare("SELECT * FROM videos");
 $statement->execute();
 $result = $statement->fetchAll();
 return $statement->rowCount();
}

?>
   