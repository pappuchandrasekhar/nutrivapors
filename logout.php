<?php
//include "includes/header_top.php";
session_start();
//print_r($_SESSION);

//session_destroy();
//header("Location:login.php?errmsg=You are successfully logged out from the account.");



if (isset($_SESSION['frnt_mid']))
{
	
	unset($_SESSION['frnt_usname']);
	unset($_SESSION['email']);
	unset($_SESSION['roletype']);
	unset($_SESSION['CART_TEMP_RANDOM']);
	unset($_SESSION['frnt_memail']);
	unset($_SESSION['frnt_created']);
	unset($_SESSION['frnt_mid']);
	unset($_SESSION['frontlast_activity']);

}

if($_SESSION['frnt_mid']=="")
{
	//session_destroy();
	////$query=$callConfig->selectQuery(TPREFIX.TBL_CART,'*',"temprandid=".$_SESSION['CART_TEMP_RANDOM']."",'','','');
	//$order_details=$callConfig->getRow($query);
	header("Location:login.php?errmsg=You are successfully logged out from the account.");
	//header("Location:index.php");
	exit();
}
header("Location:login.php?errmsg=You are successfully logged out from the account.");
	
?>