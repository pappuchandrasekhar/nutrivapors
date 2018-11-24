<?php 

header("Content-type: application/ms-excel");

header("Content-Disposition: attachment;Filename=excelreport.xls");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>StrongerRx Invoice</title>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<?php

include('../dbconfig.php');

include('includes/dbconnection.php');

include("model/store.class.php");

include("model/user.class.php");

$userObj=new userClass();

$storeObj=new storeClass();

$allorderlist=$storeObj->getAllOrdersList($fldname,$orderby,$start,$limit);


if($_GET['kw']){
	$allorderlist=$storeObj->searchkeyComments($_GET['kw'],$_GET['cpn'],$fldname,$orderby,$start,$limit);
	$total = count($allorderlist);
}

//print_r($allorderlist);

?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" >
  <thead>
    <tr height="25">
      <td width="49" height="22" align="center" valign="middle"><h3 class="style1">Sno</h3></td>
      <td width="195" align="left" valign="middle" ><h3 class="style1">Order No.</h3></td>
      <td width="195" align="left" valign="middle" ><h3 class="style1">Transaction Id</h3></td>
      
      <td width="128" align="left" valign="middle" ><h3 class="style1">Total price</h3></td>
      <td width="73" align="left" valign="middle" ><h3 class="style1">Items</h3></td>
      <td width="206" align="left" valign="middle" ><h3 class="style1">Ordered On</h3></td>
      <td width="134" align="left" valign="middle" ><h3 class="style1">First Name</h3></td>
      <td width="152" align="left" valign="middle" ><h3 class="style1">Last Name</h3></td>
      <td width="186" align="left" valign="middle" ><h3 class="style1">Email Id</h3></td>
      
      <td width="58"><h3 class="style1">Status</h3></td>
    </tr>
  </thead>
  <tbody>
    <?php

			if(sizeof($allorderlist)>0){

					$ii=0;

					foreach($allorderlist as $all_orderlists){
                 
				 
					$uservalues=userClass::getAdminUserData($all_orderlists->customer_id);
                    
					//print_r($uservalues);exit;

					?>
    <tr height="22">
      <td align="center" valign="middle"><?=($ii+1);?></td>
      <td align="left" valign="middle"><?php echo $all_orderlists->order_no;?>&nbsp;</td>
      <td align="left" valign="middle"><?php echo $all_orderlists->txn_id;?>&nbsp;</td>
      <td  align="left" valign="middle"><?php echo $all_orderlists->total_price;?></td>
      <td  align="left" valign="middle" ><?php echo $all_orderlists->item." Items";?></td>
      <td  align="left" valign="middle"><?php echo date("m-d-Y",strtotime($all_orderlists->ordered_date));?> <small>&nbsp;&nbsp;(MM/DD/YYYY)</small> </td>
      <td  align="left" valign="middle"><?php echo $all_orderlists->sh_f_name;?></td>
      <td  align="left" valign="middle"><?php echo $all_orderlists->sh_last_name;?></td>
      <td align="left" valign="middle"><a href="mailto:<?php echo $uservalues->email_address;?>"><?php echo $uservalues->email_address;?></a></td>
     <!-- <td align="left" valign="middle"><?php echo $all_orderlists->couponcode?>(<?php echo '$'.$all_orderlists->discountamount;?>)</td>-->
      <td><?php echo ucfirst($all_orderlists->ord_status);?></td>
    </tr>
    <?php

				$ii++; } } else{

			?>
    <tr>
      <td colspan="14" align="center" height="100">No Orders..</td>
    </tr>
    <?php 

			}

			?>
  </tbody>
  <tr>
    <td colspan="14" align="left">&nbsp;</td>
  </tr>
</table>
</body>
</html>
