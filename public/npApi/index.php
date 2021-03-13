<?php

header('Content-Type: application/json');

$rota = "home";

if(isset($_GET['ROUTE'])){
    $rota = $_GET['ROUTE'];
}
$str = file_get_contents('./'.$rota.'.json'); 
echo  $str;