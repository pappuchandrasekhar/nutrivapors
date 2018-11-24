
<?php

ob_start();
session_start();
include('dbconfig.php');
include('administrator/includes/dbconnection.php');

$qual = $_GET['quan'];
$size=$_GET['q'];
$query="select  * from  tb_store_value where size='$size' and spid='$qual'"; 
$res=$callConfig->getRow($query);
$_SESSION['size']=$res->size;
$_SESSION['weight']=$res->weight;
echo number_format($res->real_price,2);?>