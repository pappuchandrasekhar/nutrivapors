<?php 

include('../dbconfig.php');

include('includes/dbconnection.php');

include('model/sitesettings.class.php');

global $callConfig;
//print_r($_POST);exit;

/*$sitedata=sitesettingsClass::getsitesettings();

$query="select a.email,ai.b_firstname,ai.b_lastname from ".TPREFIX.TBL_ADMIN." a,".TPREFIX.TBL_ADMINSINFO." ai where ai.userid=a.user_id and a.user_id='".$_POST['userid']."'";

$resval=$callConfig->getRow($query);

$query="select tx_no,posted_date from ".TPREFIX.TBL_CART_TRANSACTION." where tx_id='".$_POST['id']."'";

$restr=$callConfig->getRow($query);*/



$fieldnames=array('ord_status'=>$_POST['status']);

$res=$callConfig->updateRecord(TPREFIX.TBL_ORDERS,$fieldnames,'oid',$_POST['id']);



if($res==1)

{





    /*$to=$resval->email;

	$username=$resval->b_firstname.' '.$resval->b_lastname;

	$tx_no=$restr->tx_no;

	$posted_date=$restr->posted_date;

	$posted_date=date("d/m/Y", strtotime($restr->posted_date));

	$subject="StrongerRX >> Your Order Status Details";

	$message="<table cellspacing='0' cellpadding='5'  align='center' width='100%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>

	<tr>

	<td align='left' valign='top'><a href='".SITEURL."'><img src='".SITEURL."/images/inner-logo_04.gif' border='0' ></a></td>

	</tr>

	<tr>

	<td align='left' valign='top'>Dear<strong> ".$username.",</strong></td>

	</tr>

	<tr>

	<td valign='top' align='left'><strong>Your Order Status Details:</strong></td>

	</tr>

	<tr>

	<td valign='top' align='left'><strong>Order date:</strong> ".$posted_date." (DD/MM/YYYY) </td>

	</tr>

	<tr>

	<td valign='top' align='left'><strong>Transaction ID:</strong> ".$tx_no." </td>

	</tr>

	<tr>

	<td valign='top' align='left'><strong>Status :</strong> ".$_POST['status']." </td>

	</tr>

	<tr>

	<td valign='top' align='left'>Thank You,<br />

	Support Team, StrongerRX</td>

	</tr>

	</table>";

	//echo $message; exit;

    $headers  = 'MIME-Version: 1.0' . "\r\n";

	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

	$headers .= 'From: '.$sitedata->mail_fromname.' <'.$sitedata->mail_frommail.'>' . "\r\n";

	mail($to, $subject, $message, $headers);*/

	echo ucfirst($_POST['status']);

}

?>



