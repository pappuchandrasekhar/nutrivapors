
<?php

ob_start();
session_start();
include('dbconfig.php');
include('administrator/includes/dbconnection.php');

$qual = $_GET['quan'];
$size=$_GET['q'];
 echo $query="select  * from  tb_store_value where size='$size' and spid='$qual'";  exit;
$res=$callConfig->getRow($query);
//$_SESSION['size']=$res->size;
echo $res->real_price;

?>