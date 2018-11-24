<?php
include "includes/header.php"; 
echo $transid=$_POST['txn_id'];exit;

//print_r($_SESSION);
// exit;
/************ retail users*****************/
if($_SESSION['frnt_mid']!="" || $_SESSION['user_email']!="")
{
	$query="select * from tb_user_billingaddress where user_id='".$_SESSION['front_userid']."'"; 
	$billaddress=$callConfig->getRow($query);
	$query2="select * from tb_user_shippingaddress where user_id='".$_SESSION['front_userid']."'";
	$shipaddress=$callConfig->getRow($query2);
	$res = mysql_query("select * from tb_cart where temprandid='".$_SESSION['CART_TEMP_RANDOM']."'"); 
	$count = mysql_num_rows($res);
	while($res2 = mysql_fetch_array($res))
	{
		
		$res3[] = $res2;
	}

	//print_r($res3);
	$_SESSION['pro_id'] = $res3;
	$shipamount = $_SESSION['shipamount']; 
    $shipmethod = $_SESSION['shipmethod']; 
	$total = $_SESSION['amount']; 
	$user_name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$usertype = $_SESSION['user_type'];
	$front_userid = $_SESSION['front_userid']; 
	for($i=1;$i<=$count;$i++)
	{
		$pro_id = $res3[$i-1][1];
		
		 $prn = mysql_query("SELECT * FROM  `tb_cart` WHERE `cart_id` ='$pro_id'") or die(mysql_error());
		$pron = mysql_fetch_assoc($prn);
		echo "<pre>";
		//print_r($pron);	
		echo $pron['attrib_value'];
		
		$pro_name = $res3[$i-1][2];
		$ind_price = $res3[$i-1][4];
		$pro_att = $res3[$i-1][3];
		$cat_ids = $res3[$i-1][13]; 
//		echo $b="SELECT * FROM  `tb_sizes` WHERE  `id` ='$pro_size'";
				
		 $ress = mysql_query("SELECT * FROM  `tb_sizes` WHERE  `id` ='$pro_size'") or die(mysql_error());
		$siz = mysql_fetch_assoc($ress);
		$pro_quan = $res3[$i-1][5];
		 $ins = "INSERT INTO `tb_cardusers` (`id`, `user_name`, `b_firstname`, `b_phone`, `user_email`, `cardtype`, `user_type`, `user_id`, `prod_id`, `transactionid`, `posteddate`, `grand_total`, `status`, `payment_status`,`pcolor`,`psize`,`pquan`,`indiv_price`,`pname`,`shipmethod`) VALUES (
		NULL, '$user_name', '', '','$email', '$creditCardType', '$usertype', '$front_userid', '$pro_id', '".$transid."', NOW(), '$total', '', 'success','','".$siz['sizes_p']."','$pro_quan','$ind_price','$pro_name','$shipmethod')";	
		
		
		mysql_query($ins) or die(mysql_error());
		//$color[] = $col['color_name'];
		$sizes[] = $siz['sizes_p'];
		$pname[] = $res3[$i-1][2];
		$pquan[] = $res3[$i-1][5];
		$in_price[] = $res3[$i-1][4];
		$attribs[] =  $pron['attrib_value'];
	}
	$samtot=0;
	for($i=0;$i<count($sizes);$i++)
	{
		$qtotal	=	$pquan[$i]*$in_price[$i];
		$attri = str_replace("-","&emsp;-&emsp;",str_replace(",","<br>",$attribs[$i]));
		$dd = $dd.'<tr><td align="left" valign="middle">'.$pname[$i].' </td><td align="left" valign="middle">'.$pquan[$i].'</td><td align="left" valign="middle">'.$attri.'</td><td align="left" valign="middle">'.$color[$i].'</td><td align="left" valign="middle">$'.$in_price[$i].'</td><td align="left" valign="middle">$'.$qtotal.'</td></tr>';
		$samtot=$samtot+$qtotal;			
	}
	$n = strpos($shipmethod,"$");
	$dd = $dd.'<tr><td align="left" valign="middle" colspan="3">&nbsp;</td><td align="left" valign="middle">Subtotal</td><td align="left" valign="middle">$'.$samtot.'</td></tr>';		
	$dd = $dd.'<tr><td align="left" valign="middle" colspan="3">&nbsp;</td><td align="left" valign="middle">'.substr($shipmethod,0,$n).'</td><td align="left" valign="middle">'.substr($shipmethod,$n).'</td></tr>';		
	$dd = $dd.'<tr><td align="left" valign="middle" colspan="3">&nbsp;</td><td align="left" valign="middle">Grand Total</td><td align="left" valign="middle">$'.$total.'</td></tr>';	

	 $subject		=	'Nutrivapors Order Confirmation.';
	 $to				=	$contact_person; 
	 $from			=	$_SESSION['user_email'];
	 $username		=	$_SESSION['user_name'];
	 
	 $countryid= mysql_query("Select * from tb_countries where id='".$billaddress->country."'");
	 $counname= mysql_fetch_assoc($countryid);
	 $stateid= mysql_query("Select * from tb_state where id='".$billaddress->state."'");
	 $statename= mysql_fetch_assoc($stateid);
	 $cityid= mysql_query("Select * from tb_city where id='".$billaddress->city."'");
	 $cityname= mysql_fetch_assoc($cityid);
	 //print_r($billaddress);
	 $ship_countryid= mysql_query("Select * from tb_countries where id='".$shipaddress->country."'");
	 $ship_counname= mysql_fetch_assoc($ship_countryid);
	 $ship_stateid= mysql_query("Select * from tb_state where id='".$shipaddress->state."'");
	 $ship_statename= mysql_fetch_assoc($ship_stateid);
	 $ship_cityid= mysql_query("Select * from tb_city where id='".$shipaddress->city."'");
	 $ship_cityname= mysql_fetch_assoc($ship_cityid);
	 
	 
	 $address		=	array($billaddress->address,$cityname[city_name],$statename[state_name],$counname[countryname],$billaddress->zip_code,$billaddress->phone,$shipaddress->address,$ship_cityname[city_name],$ship_statename[state_name],$ship_counname[countryname],$shipaddress->zip_code,$shipaddress->phone);
	 //print_r($address);
	
	messageadmin($subject,$to,$from,$username,$transid,$address,$dd,$total);
	messageuser($subject,$from,$to,$username,$transid,$address,$dd,$total);
	
	
	
	$del_cart = "DELETE FROM `tb_cart` WHERE `temprandid`='".$_SESSION['CART_TEMP_RANDOM']."'";
	mysql_query($del_cart);
	//unset($_SESSION['pro_id']); http://192.254.233.173/~rajeshch/ <?php echo SITEURL; 
	//header("location:http://www.plushcashmere.com/ThankYou?tranid=".$transid);
	header("location:thankyou.php?tranid=".$transid);
	//exit;
}


/****** guest users***********/
else if($_SESSION['frnt_mid']=="")
{
	//print_r($_SESSION);
	//print_r($_POST);
	//exit;
	$guestbill="select * from tb_guestubillingaddress order by user_id DESC LIMIT 0,1";
	$guestbilldata=$callConfig->getRow($guestbill);
	$guestship="select * from tb_guesthppingaddress order by user_id DESC LIMIT 0,1";
	$guestship=$callConfig->getRow($guestship);
	$to=$guestship->user_email;
	$from=$contact_person;
 //$z="select * from tb_cart where temprandid='".$_SESSION['CART_TEMP_RANDOM']."'";
	$res = mysql_query("select * from tb_cart where temprandid='".$_SESSION['CART_TEMP_RANDOM']."'"); 
	$count = mysql_num_rows($res);
	while($res2 = mysql_fetch_array($res))
	{
		$res3[] = $res2;
	}
	$_SESSION['pro_id'] = $res3;
	$shipmethod = $_SESSION['shipmethod']; 
	$total = $_SESSION['amount'];
	$user_name = $_SESSION['user_name'];
	$email = $_SESSION['user_email'];
	$usertype = $_SESSION['user_type'];
	$front_userid = $_SESSION['wuid']; 
	for($i=1;$i<=$count;$i++){
		$pro_id = $res3[$i-1][1];
		//echo $v="SELECT * FROM  `tb_cart` WHERE `cart_id` ='$pro_id'";
				$prn = mysql_query("SELECT * FROM  `tb_cart` WHERE `cart_id` ='$pro_id'") or die(mysql_error());
		$pron = mysql_fetch_assoc($prn);
		$pro_name = $res3[$i-1][2];
		 $ind_price = $res3[$i-1][4];
		 $pquan[] = $res3[$i-1][5];
		 $in_price[] = $res3[$i-1][4];
		/*$resc = mysql_query("SELECT * FROM  `tb_design_colors` WHERE `id` ='$pro_col'") or die(mysql_error());
		$col = mysql_fetch_assoc($resc);
		$pro_size = $res3[$i-1][3];*/
 $c="SELECT * FROM  `tb_sizes` WHERE  `id` =$pro_size";	
		 $h="SELECT * FROM  `tb_guestusers` WHERE  `id` =$pro_size";
	
		//$ress = mysql_query("SELECT * FROM  `tb_sizes` WHERE  `id` =$pro_size") or die(mysql_error());
		//$siz = mysql_fetch_assoc($ress);
		$pro_quan = $res3[$i-1][5];
		
		$ins = "INSERT INTO `tb_guestusers` (`id`, `user_name`, `b_firstname`, `b_phone`, `user_email`, `cardtype`, `user_type`, `user_id`, `prod_id`, `transactionid`, `posteddate`, `grand_total`, `status`, `payment_status`,`pcolor`,`psize`,`pquan`,`indiv_price`,`pname`,`shipmethod`,`cart_id`) VALUES (
		NULL, '$user_name', '', '','$email', '$creditCardType', '$usertype', '$front_userid', '$pro_id', '".$transid."', NOW(), '$total', '', 'success','".$col['color_name']."','".$siz['sizes_p']."','$pro_quan','$ind_price','$pro_name','$shipmethod','".$_SESSION['CART_TEMP_RANDOM']."')";	
		mysql_query($ins) or die(mysql_error());
		//$color[] = $col['color_name'];
		$sizes[] = $siz['size'];
		$pname[] = $res3[$i-1][2];
		$pquan[] = $res3[$i-1][5];
		$in_price[] = $res3[$i-1][4];
	}
	$samtot=0;
	for($i=0;$i<count($sizes);$i++)
	{
		$qtotal	=	$pquan[$i]*$in_price[$i];
		$dd = $dd.'<tr><td align="left" valign="middle">'.$pname[$i].' </td><td align="left" valign="middle">'.$pquan[$i].'</td><td align="left" valign="middle">'.$sizes[$i].'</td><td align="left" valign="middle">'.$color[$i].'</td><td align="left" valign="middle">$'.$in_price[$i].'</td><td align="left" valign="middle">$'.$qtotal.'</td></tr>';			
		$samtot=$samtot+$qtotal;
	}
	$n = strpos($shipmethod,"$");	
	$dd = $dd.'<tr><td align="left" valign="middle" colspan="3">&nbsp;</td><td align="left" valign="middle">Subtotal</td><td align="left" valign="middle">$'.$samtot.'</td></tr>';		
	$dd = $dd.'<tr><td align="left" valign="middle" colspan="3">&nbsp;</td><td align="left" valign="middle">'.substr($shipmethod,0,$n).'</td><td align="left" valign="middle">'.substr($shipmethod,$n).'</td></tr>';		
	$dd = $dd.'<tr><td align="left" valign="middle" colspan="3">&nbsp;</td><td align="left" valign="middle">Grand Total</td><td align="left" valign="middle">$'.$total.'</td></tr>';		
	$contactmail=$userdata_info->user_email;
	$username = $_REQUEST['customer_first_name'];
	$address = array($_REQUEST['customer_address1'],$_REQUEST['customer_city'],$_REQUEST['customer_state'],$_REQUEST['customer_country'],$_REQUEST['customer_zip'],$_REQUEST['telephone'],$_REQUEST['customer_address1'],$_REQUEST['customer_city'],$_REQUEST['customer_state'],$_REQUEST['customer_country'],$_REQUEST['customer_zip'],$_REQUEST['telephone']);

	$subject='Nutrivapors Confirmation.';
	messageadmin($subject,$to,$from,$username,$transid,$address,$dd,$total);
	messageuser($subject,$from,$to,$username,$transid,$address,$dd,$total);	
	$del_cart = "DELETE FROM `tb_cart` WHERE `temprandid`='".$_SESSION['CART_TEMP_RANDOM']."'";
	mysql_query($del_cart);
	//unset($_SESSION['pro_id']);
	//header("location:http://www.plushcashmere.com/ThankYou?tranid=".$transid);
	header("location:thankyou.php?tranid=".$transid);
	//exit;	    
}

 
function messageadmin($subject,$to,$from,$username,$transid,$address,$dd,$total)
{
 $message = '<table style="border:1px solid #cccccc;border-collapse:collapse;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px" cellpadding="5" cellspacing="0" align="center" border="0" width="100%">
	<tbody>
		<tr>
			<td colspan="2" align="left" valign="top"><a href="http://192.254.233.173/~rajeshch/nutrivapors" target="_blank"><img border="0"></a></td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">Dear<b> Administrator,</b></td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top"><b>'.$username.' Confirmed Order Details are Placed Below.</b> </td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top"><b>Order date:</b> '.date("d-m-Y").' (DD/MM/YYYY) </td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top"><b>Transaction ID:</b> '.$transid.' </td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
				<table style="border:1px solid #eeeeee;border-collapse:collapse;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px" cellpadding="0" cellspacing="0" border="1" width="100%">
					<tbody>
						<tr>
						<td align="left" bgcolor="#eeeeee" height="25" valign="middle" width="15%"><b>Billing Address:</b></td>
						<td align="left" bgcolor="#eeeeee" height="25" valign="middle" width="32%">&nbsp;</td>
						<td align="left" bgcolor="#eeeeee" height="25" valign="middle" width="15%"><b>Shipping Address:</b></td>
						<td align="left" bgcolor="#eeeeee" height="25" valign="middle" width="38%">&nbsp;</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>Address:</b></td>
						<td align="left" height="23" valign="middle">'.$address[0].'</td>
						<td align="left" height="23" valign="middle"><b>Address:</b></td>
						<td align="left" height="23" valign="middle">'.$address[6].'</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>City:</b></td>
						<td align="left" height="23" valign="middle">'.$address[1].'</td>
						<td align="left" height="23" valign="middle"><b>City:</b></td>
						<td align="left" height="23" valign="middle">'.$address[7].'</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>State:</b></td>
						<td align="left" height="23" valign="middle">'.$address[2].'</td>
						<td align="left" height="23" valign="middle"><b>State:</b></td>
						<td align="left" height="23" valign="middle">'.$address[8].'</td>
						</tr>
						
						<tr>
						<td align="left" height="23" valign="middle"><b>Country:</b></td>
						<td align="left" height="23" valign="middle">'.$address[3].'</td>
						<td align="left" height="23" valign="middle"><b>Country:</b></td>
						<td align="left" height="23" valign="middle">'.$address[9].'</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>Zip Code:</b></td>
						<td align="left" height="23" valign="middle">'.$address[4].'</td>
						<td align="left" height="23" valign="middle"><b>Zip Code:</b></td>
						<td align="left" height="23" valign="middle">'.$address[10].'</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>Phone:</b></td>
						<td align="left" height="23" valign="middle">'.$address[5].'</td>
						<td align="left" height="23" valign="middle"><b>Phone:</b></td>
						<td align="left" height="23" valign="middle">'.$address[11].'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
				<table style="border:1px solid #eeeeee;border-collapse:collapse;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px" cellpadding="3" cellspacing="0" border="1" width="100%">
					<tbody>
						<tr>
						<td align="left" valign="middle" width="396"><b>Product Name </b></td>
						<td align="left" valign="middle" width="239"><b>Quantity</b></td>
						<td align="left" valign="middle" width="239"><b>SelectAttributes</b></td>
						<td align="left" valign="middle" width="238"><b>Shipping Method</b></td>
						<td align="left" valign="middle" width="238"><b>Individual Price</b></td>
						<td align="left" valign="middle" width="312"><b>Total</b></td>
						</tr>
						
						'.$dd.'
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">Thank you for being a valued customer.<br>Adnub</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top"></td>
		</tr>
	</tbody>
</table>';	
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
mail($to, $subject, $message, $headers);

return;	
}

function messageuser($subject,$to,$from,$username,$transid,$address,$dd,$total)
{
 $message = '<table style="border:1px solid #cccccc;border-collapse:collapse;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px" cellpadding="5" cellspacing="0" align="center" border="0" width="100%">
	<tbody>
		<tr>
			<td colspan="2" align="left" valign="top"><a href="http://192.254.233.173/~rajeshch/jewellerynew" target="_blank"><img border="0"></a></td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">Dear <b>'.$username.' </b>,</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">We are delighted that you have selected Adnub as your preferred choice of brand.  Thank you for shopping with Adnub.</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top"><b>Order date:</b> '.date("d-m-Y").' (DD/MM/YYYY) </td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top"><b>Transaction ID:</b> '.$transid.' </td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
				<table style="border:1px solid #eeeeee;border-collapse:collapse;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px" cellpadding="0" cellspacing="0" border="1" width="100%">
					<tbody>
						<tr>
						<td align="left" bgcolor="#eeeeee" height="25" valign="middle" width="15%"><b>Billing Address:</b></td>
						<td align="left" bgcolor="#eeeeee" height="25" valign="middle" width="32%">&nbsp;</td>
						<td align="left" bgcolor="#eeeeee" height="25" valign="middle" width="15%"><b>Shipping Address:</b></td>
						<td align="left" bgcolor="#eeeeee" height="25" valign="middle" width="38%">&nbsp;</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>Address:</b></td>
						<td align="left" height="23" valign="middle">'.$address[0].'</td>
						<td align="left" height="23" valign="middle"><b>Address:</b></td>
						<td align="left" height="23" valign="middle">'.$address[6].'</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>City:</b></td>
						<td align="left" height="23" valign="middle">'.$address[1].'</td>
						<td align="left" height="23" valign="middle"><b>City:</b></td>
						<td align="left" height="23" valign="middle">'.$address[7].'</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>State:</b></td>
						<td align="left" height="23" valign="middle">'.$address[2].'</td>
						<td align="left" height="23" valign="middle"><b>State:</b></td>
						<td align="left" height="23" valign="middle">'.$address[8].'</td>
						</tr>
						
						<tr>
						<td align="left" height="23" valign="middle"><b>Country:</b></td>
						<td align="left" height="23" valign="middle">'.$address[3].'</td>
						<td align="left" height="23" valign="middle"><b>Country:</b></td>
						<td align="left" height="23" valign="middle">'.$address[9].'</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>Zip Code:</b></td>
						<td align="left" height="23" valign="middle">'.$address[4].'</td>
						<td align="left" height="23" valign="middle"><b>Zip Code:</b></td>
						<td align="left" height="23" valign="middle">'.$address[10].'</td>
						</tr>
						<tr>
						<td align="left" height="23" valign="middle"><b>Phone:</b></td>
						<td align="left" height="23" valign="middle">'.$address[5].'</td>
						<td align="left" height="23" valign="middle"><b>Phone:</b></td>
						<td align="left" height="23" valign="middle">'.$address[11].'</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">
				<table style="border:1px solid #eeeeee;border-collapse:collapse;font-family:Verdana,Arial,Helvetica,sans-serif;font-size:11px" cellpadding="3" cellspacing="0" border="1" width="100%">
					<tbody>
						<tr>
						<td align="left" valign="middle" width="396"><b>Product Name </b></td>
						<td align="left" valign="middle" width="239"><b>Quantity</b></td>
						<td align="left" valign="middle" width="239"><b>Select Attribute</b></td>
						<td align="left" valign="middle" width="238"><b>Shipping Method</b></td>
						<td align="left" valign="middle" width="238"><b>Individual Price</b></td>
						<td align="left" valign="middle" width="312"><b>Total</b></td>
						</tr>
						'.$dd.'
					</tbody>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">Thank you for being a valued customer.<br>Adnub</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top"></td>
		</tr>
	</tbody>
</table>';
//exit;
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: '.$from.' <'.$from.'>' . "\r\n";
mail($to, $subject, $message, $headers);
return;
}
?>