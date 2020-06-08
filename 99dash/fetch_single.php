    
<?php
include('db.php');
include('function.php');
if(isset($_POST["user_id"]))
{
 $output = array();
 $statement = $connection->prepare(
  "SELECT * FROM picture 
  WHERE id = '".$_POST["user_id"]."' 
  LIMIT 1"
 );
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output["title"] = $row["title"];
  $output["url"] = $row["url"];
  if($row["picture"] != '')
  {
   $output['user_picture'] = '<img src="'.$row["picture"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_user_picture" value="'.$row["picture"].'" />';
  }
  else
  {
   $output['user_picture'] = '<input type="hidden" name="hidden_user_picture" value="" />';
  }
 }
 echo json_encode($output);
}
?>
   