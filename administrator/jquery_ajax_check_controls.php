<?php 

@ob_start();
@session_start();
include('../dbconfig.php');
include_once("includes/sessions.php");
include('includes/dbconnection.php');

	$operation=$_REQUEST['email_address']; 

    $qq= "select * from tb_users_info where email_address='".$operation."'"; 
	$str=mysql_query($qq);
	$cnt=mysql_num_rows($str);
	if($cnt>0)
	echo 1; 
	else
	echo 0; 


	
?>
