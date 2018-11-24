<?php 
$file_name="invoice".date('Ymdhis').".doc";
header("Content-type: application/vnd.ms-word");

header("Content-Disposition: attachment;Filename=".$file_name);?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>StrongerRx Invoice</title>

</head>



<body>

<?php

include('../dbconfig.php');

include('includes/dbconnection.php');

include("model/store.class.php");

$storeObj=new storeClass();
$query=$callConfig->selectQuery(TPREFIX.'orders','*',"oid='".$_GET['id']."'",'','','');

$trasactiondetails=$callConfig->getRow($query);

$query=$callConfig->selectQuery(TPREFIX.'orderdetails','*',"order_id='".$_GET['id']."'",'','','');

$resitems=$callConfig->getAllRows($query);



?>

<div id="container">

  <div id="content">

    <div>

      

      <div>

        <table cellspacing="0" cellpadding="0" align="left" width="100%" border="0">

          <tbody>

          <tr>

              <td height="25" colspan="2" align="left" valign="top"><img src="<?=SITEURL?>/images/logo_06.png"  width="237" height="90"/>&nbsp;&nbsp;&nbsp;</td>

            </tr>

             <tr>

               <td height="25" colspan="2" align="center" valign="top">&nbsp;</td>

             </tr>

             <tr>

              <td height="25" colspan="2" align="center" valign="top"><span>ORDER INVOICE</span></td>

            </tr>

           <tr>

              <td height="25" colspan="2" align="left" valign="top">&nbsp;</td>

            </tr>

             <tr>

              <td height="25" colspan="2" align="left" valign="top">&nbsp;</td>

            </tr>

            <tr>

              <td height="25" colspan="2" align="left" valign="top"><strong>Order date:</strong>   <?php echo date("M d, Y",strtotime($trasactiondetails->ordered_date));?></td>

            </tr>

            <tr>

              <td height="25" colspan="2" align="left" valign="top"><strong>Transaction ID:</strong>   <?php echo $trasactiondetails->txn_id;?></td>

            </tr>

            <tr>

              <td height="25" colspan="2" align="left" valign="top"><strong>Status:</strong> <?php echo $trasactiondetails->ord_status ?></td>

            </tr>

            <tr>

              <td height="25" colspan="2" align="left" valign="top">
<table width="100%" border="1" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #eeeeee; border-collapse:collapse;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">

<tr>

<td width="396" height="25" align="left" valign="middle"><strong>Product Name </strong></td>
<td width="100" height="25" align="left" valign="middle"><strong>Product Type </strong></td>

<td width="100" align="left" valign="middle"><strong>Size</strong></td>
<td width="100" align="left" valign="middle"><strong>Color</strong></td>

<td width="239" height="25" align="left" valign="middle"><strong>Quantity</strong></td>

<td width="238" height="25" align="left" valign="middle"><strong>Price</strong></td>
<td width="238" height="25" align="left" valign="middle"><strong>Shipping Price</strong></td>
<td width="312" height="25" align="left" valign="middle"><strong>Total</strong></td>

</tr>

<?php $tot=0;$ship_price1=0; foreach($resitems as $itemlist)
{
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
<td height="25" align="left" valign="middle"><?php echo $rs_prd->prodtitle;?></td>

<?php

}
else
{
	$sele="select * from tb_packages where p_id=".$itemlist->product_id;
$rs_prd=$callConfig->getRow($sele);
	?>
    <td height="25" align="left" valign="middle"><?php echo $rs_prd->p_name;?></td>

<?php } ?>


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

 

      

</table>
              

                            </td>

            </tr>

            <tr>

              <td> </td>

            </tr>

            <tr>

              <td height="25" colspan="2" align="left" valign="top">

              <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #eeeeee; border-collapse:collapse;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">

<tr>

<td width="15%" height="25" align="left" valign="middle" ><strong>Billing Address:</strong></td>

<td width="32%" height="25" align="left" valign="middle" >&nbsp;</td>

<td width="15%" height="25" align="left" valign="middle" ><strong>Shipping Address:</strong></td>

<td width="38%" height="25" align="left" valign="middle" >&nbsp;</td>

</tr>

<tr>

  <td height="23" align="left" valign="middle"><strong>First Name:</strong></td>

  <td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_f_name;?></td>

  <td height="23" align="left" valign="middle"><strong>First Name:</strong></td>

  <td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_f_name;?></td>

</tr>

<tr>

  <td height="23" align="left" valign="middle"><strong>Last Name:</strong></td>

  <td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_last_name;?></td>

 <td height="23" align="left" valign="middle"><strong>Last Name:</strong></td>

  <td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_last_name;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle">6<strong>Address:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_address;?></td>

<td height="23" align="left" valign="middle"><strong>Address:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_address;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle"><strong>City:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_city;?></td>

<td height="23" align="left" valign="middle"><strong>City:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_city;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle"><strong>State:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_state;?></td>

<td height="23" align="left" valign="middle"><strong>State:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_state;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle"><strong>Country:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_country;?></td>

<td height="23" align="left" valign="middle"><strong>Country:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_country;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle"><strong>Zip Code:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_zip_code;?></td>

<td height="23" align="left" valign="middle"><strong>Zip Code:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_zip_code;?></td>

</tr>

<tr>

<td height="23" align="left" valign="middle"><strong>Phone:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_phone;?></td>

<td height="23" align="left" valign="middle"><strong>Phone:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_phone;?></td>

</tr>


<tr>

<td height="23" align="left" valign="middle"><strong>Fax:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_fax;?></td>

<td height="23" align="left" valign="middle"><strong>Fax:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_fax;?></td>

</tr>
<tr>

<td height="23" align="left" valign="middle"><strong>Company Name:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->b_company;?></td>

<td height="23" align="left" valign="middle"><strong>Company Name:</strong></td>

<td height="23" align="left" valign="middle"><?php echo $trasactiondetails->sh_company;?></td>

</tr>


</table>              </td>

            </tr>

             <tr>

              <td height="25" colspan="2" align="center" valign="top">

              Copyright © 2014 The Nutrivapors. All Rights Reserved.              </td></tr>

          </tbody>

        </table>

      </div>

    </div>

  </div>

</div>

</body></html>