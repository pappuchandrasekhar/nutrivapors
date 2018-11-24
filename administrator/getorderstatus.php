<?php

include('../dbconfig.php');
include('includes/dbconnection.php');
include('model/sitesettings.class.php');
global $callConfig;
$transaction_id=$_POST['transaction_id'];
$where="oid= ".$transaction_id;
$query=$callConfig->selectQuery(TPREFIX.TBL_ORDERS,'*',$where,'','','');
$cart_products=$callConfig->getRow($query);
$data['status']=$cart_products->ord_status;
$data['shipping_no']=$cart_products->shipping_no;
$data['tracking_messg']=$cart_products->tracking_messg;
//print_r($cart_products); 
//$data["true"]="true";
echo json_encode($data);



?>