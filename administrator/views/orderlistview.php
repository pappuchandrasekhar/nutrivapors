<?php 

include('includes/session.php');

include("model/store.class.php");

$storeObj=new storeClass();

if($_GET['action']=="delete"){

   $storeObj->OrderDelete($_GET['id']);

}

if($_GET['st']!="" || $_GET['st']=="Pending" || $_GET['st']=="Delivered"){

   $storeObj->OrderStatusChanging($_GET);

}

if($_POST['adminpopupupdate']=="Submit"){

   $storeObj->updateOrderComment("remarks",$_POST);

}

$start=0;

if($_GET['start']!="")

$start=$_GET['start'];

if($site_settings_disp->noofrecords!="0")

$limit=$site_settings_disp->noofrecords;

else

$limit=25;

if($_GET['fld']!="")

$fldname=$_GET['fld'];

else

$fldname="tx_id";

if($_GET['ord']!="")

$orderby=$_GET['ord'];

else

$orderby="DESC";

$allorderlist=$storeObj->getAllOrdersList($fldname,$orderby,$start,$limit);

$total=$storeObj->getAllOrdersListCount();

?>

<script type="text/javascript">

function getrelatedData(val){

window.location.href="index.php?option=com_orderlist&b_id="+val;

}

</script>

<div class="box">

<div class="heading">



<table width="100%" border="0" cellspacing="0" cellpadding="0" id="noprint">

<tr>

<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt=""> Store &nbsp;&nbsp;>>&nbsp;&nbsp;Order Details</h1></td>

<td align="right" valign="bottom">

<table width="35%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td><a href="invoice.php?id=<?php echo $_REQUEST["id"];?>"><img src="allfiles/print-printer.png" alt="Print Invoice" width="34" height="34" border="0" /></a></td>

    <td align="left" valign="top"><a href="invoice.php?id=<?php echo $_REQUEST["id"];?>"><h1>Print Invoice</h1></a></td>

  </tr>

</table>

</td>

</tr>

</table>

</div>

<div class="content">

<?php 

$query=$callConfig->selectQuery(TPREFIX.'orders','*',"oid='".$_GET['id']."'",'','','');

$trasactiondetails=$callConfig->getRow($query);





$query=$callConfig->selectQuery(TPREFIX.'orderdetails','*',"order_id='".$_GET['id']."'",'','','');

$resitems=$callConfig->getAllRows($query);






?>

<table cellspacing="0" cellpadding="0"  align="left" width="100%" border="0" style="border:1px solid #CCCCCC; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;" class="list">



<tr>

<td height="25" colspan="2" align="left" valign="top"><strong>Order date:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("M d, Y",strtotime($trasactiondetails->ordered_date));?> <small>&nbsp;&nbsp;</small> </td>

</tr>

<tr>

<td height="25" colspan="2" align="left" valign="top"><strong>Transaction ID:</strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $trasactiondetails->txn_id;?> </td>

</tr>

<tr>

<td height="25" colspan="2" align="left" valign="top"><strong>Status:</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $trasactiondetails->ord_status ?> </td>

</tr>

<tr>

<td height="25" colspan="2" align="left" valign="top"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #eeeeee; border-collapse:collapse;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">

<tr>

<td width="396" height="25" align="left" valign="middle"><strong>Product Name </strong></td>
<td  ></td>

<td width="100" align="left" valign="middle"><strong>Size</strong></td>
<td ></td>

<td width="239" height="25" align="left" valign="middle"><strong>Quantity</strong></td>

<td width="238" height="25" align="left" valign="middle"><strong>Price</strong></td>
<td width="238" height="25" align="left" valign="middle"><strong>Shipping Price</strong></td>
<td width="312" height="25" align="left" valign="middle"><strong>Total</strong></td>

</tr>

<?php $tot=0;$ship_price1=0; foreach($resitems as $itemlist)
{
$p_name=$itemlist->prod_name;	
$total=$itemlist->quantity*$itemlist->price;
$ship=$trasactiondetails->ship_price;
$ship_price=$ship*$itemlist->quantity;
$ship_price1=$ship_price1+$ship_price;
$total1=$total1+$total+$ship_price1;
?>

<tr>
<?php 
if(trim($itemlist->prod_type)=='Products')
{

  $sele="select * from tb_store_products where spid=".$itemlist->product_id;
$rs_prd=$callConfig->getRow($sele);
?>
<!--<td height="25" align="left" valign="middle"><?php echo $rs_prd->prodtitle;?></td>-->

<?php

}

else
{
	$sele="select * from tb_packages where p_id=".$itemlist->product_id;
$rs_prd=$callConfig->getRow($sele);
	?>

<?php } ?>
    <td height="25" align="left" valign="middle"><?php echo $itemlist->prod_name;?></td>


	<td align="left" valign="middle"><?php echo $itemlist->prod_type;?></td>
<td align="left" valign="middle"><?php echo $itemlist->p_size;?></td>
<td align="left" valign="middle"><?php if($itemlist->p_color!=""){?>
<div  style="text-align:center;cursor:pointer;padding:5px;width:16px;height:8px;background-color:<?=$itemlist->p_color?>"  >&nbsp;</div>
<?php }?></td>

<td height="25" align="left" valign="middle"><?php echo $itemlist->quantity;?></td>

<td height="25" align="left" valign="middle"><?php echo '$&nbsp;'.$itemlist->price;?></td>
<td height="25" align="left" valign="middle">$<?php echo number_format($ship_price,2);?></td>

<td height="25" align="left" valign="middle"><?php echo '$&nbsp;'.number_format($total+$ship_price,2);?></td>

</tr>

<?php  }?>

<tr>

<td height="25" colspan="6" align="right" valign="middle" >&nbsp;</td>

<td height="25" align="right" valign="middle" ><strong>Shipping Rate:</strong></td>

<td height="25"  align="left" valign="middle" ><strong><?php echo '$&nbsp;'.number_format($ship_price1,2);?></strong></td>

</tr>








<tr>

<td height="25" colspan="6" align="right" valign="middle" >&nbsp;</td>

<td height="25" align="right" valign="middle" ><strong>Grand Total:</strong></td>

<td height="25"  align="left" valign="middle" ><strong><?php echo '$&nbsp;'.($trasactiondetails->total_price);?></strong></td>

</tr>




<tr>

<td height="25" colspan="0" align="left" valign="top"></td>

</tr>

</table>
<table width="1000" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #eeeeee; border-collapse:collapse;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">

<tr>

<td width="15%" height="25" align="left" valign="middle" style="padding-left:5px;"><strong>Billing Address:</strong></td>

<td width="32%" height="25" align="left" valign="middle" >&nbsp;</td>

<td width="15%" height="25" align="left" valign="middle" style="padding-left:5px;"><strong>Shipping Address:</strong></td>

<td width="38%" height="25" align="left" valign="middle" >&nbsp;</td>

</tr>

<tr>

  <td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>First Name:</strong></td>

  <td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_f_name;?></td>

  <td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>First Name:</strong></td>

  <td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_f_name;?></td>

</tr>

<tr>

  <td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Last Name:</strong></td>

  <td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_last_name;?></td>

 <td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Last Name:</strong></td>

  <td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_last_name;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Address:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_address;?></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Address:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_address;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>City:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_city;?></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>City:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_city;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>State:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_state;?></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>State:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_state;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Country:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_country;?></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Country:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_country;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Zip Code:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_zip_code;?></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Zip Code:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_zip_code;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Phone:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_phone;?></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Phone:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_phone;?></td>

</tr>


<tr>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Fax:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_fax;?></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Fax:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_fax;?></td>

</tr>
<tr>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Company Name:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->b_company;?></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><strong>Company Name:</strong></td>

<td height="23" align="left" valign="middle" style="padding-left:5px;"><?php echo $trasactiondetails->sh_company;?></td>

</tr>


</table>
  </div>

  </div>
 