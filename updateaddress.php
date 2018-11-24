<?php
session_start();
include('dbconfig.php');
include "administrator/includes/dbconnection.php";
include('model/cart.class.php');
	$storeObj=new cartClass();
	 $user_id=$_SESSION['frnt_mid'];
	//echo $user_id;exit;
//echo "hi";exit;
	if($user_id!='')
	{
		//echo $user_id;
		//echo "sarat";exit;
		$r=$updateaddress=$storeObj->insertuserbilladdr();		
	}
	else
	{   
      //  echo "sarat";exit;
	    $guestbilling=$storeObj->insertguestbillingaddress($post);
	}
	echo json_encode();
?>
