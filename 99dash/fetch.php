    
<?php
include('db.php');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM videos ";
if(isset($_POST["search"]["value"]))
{
$query .= 'WHERE title LIKE "%'.$_POST["search"]["value"].'%" and status > 0   ';
$query .= 'OR url LIKE "%'.$_POST["search"]["value"].'%" and status > 0 ';
  
// $query .= 'WHERE  status > 0 and title LIKE "S%-E%" ';
 //$query .= '    ';
}
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}
if($_POST["length"] != -1)
{
 $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $connection->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach($result as $row)
{
 $picture = '';
 if($row["picture"] != '')
 {
  $picture = '<img src="'.$row["picture"].'" class="img-thumbnail" width="200" height="35" />';
 }
 else
 {
  $picture = '';
 }
 $sub_array = array();
 $sub_array[] = $picture;
  $sub_array[] = '<a href="https://www.google.com.br/search?source=hp&ei=3mKdXJihNdyv5OUPkL6q8AM&q=filme+'.$row["title"].'"  id="'.$row["id"].'_title"  target="_blank"> '.$row["title"].' </a>';
  $sub_array[] = '<input value="'.$row["url"].'"  id="'.$row["id"].'_url" />';
 $sub_array[] = '<input value="'.$row["picture"].'"  id="'.$row["id"].'_picture" />';
 $sub_array[] = '<input value="'.$row["category"].'"  id="'.$row["id"].'_category" />'; 
 $sub_array[] = '<button type="button" name="Salvar" id="'.$row["id"].'" class="btn btn-success btn-xs Salvar">Salvar</button>';
 $data[] = $sub_array;
}
$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  $filtered_rows,
 "recordsFiltered" => get_total_all_records(),
 "data"    => $data
);
echo json_encode($output);
?>