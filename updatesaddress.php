<?php
session_start();
include('dbconfig.php');
include "administrator/includes/dbconnection.php";
include('model/cart.class.php');
	$storeObj=new cartClass();
	$user_id=$_SESSION['frnt_mid'];
	
	if($user_id!='')
	{
		$r = $updateaddress=$storeObj->insertshipuserbilladdr();		
	}
	else
	{
	//print_r($_GET);exit;
		$guestshiping=$storeObj->inserguestshippingaddress($_GET);
	}	
	echo json_encode();
?>