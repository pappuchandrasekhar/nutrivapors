<?php
include('../dbconfig.php');
include('includes/dbconnection.php');
include('model/sitesettings.class.php');
global $callConfig;

$transaction_id=$_POST['transaction_id'];

$where="tx_no= ".$transaction_id;
$query=$callConfig->selectQuery(TPREFIX.TBL_CART_ORDER,'*',$where,'','','');
$cart_products=$callConfig->getAllRows($query);
//print_r($cart_products);
foreach($cart_products as $cartProducts)
{

	$where="spid= ".$cartProducts->prod_id;
	$query2=$callConfig->selectQuery(TPREFIX.TBL_STOREPRODUCTS,'*',$where,'','','');
    $stock_sizes=$callConfig->getRow($query2);
	
	$selectedsizes=explode("~",$stock_sizes->prodsizes);
	$selsizestock=explode("~",$stock_sizes->stocksizes);
	for($i=0;$i<sizeof($selsizestock);$i++)
	{
		if($selectedsizes[$i]==$cartProducts->prod_size)
		$stock_index=$i;
	}
		
	$available_stock=$selsizestock[$stock_index]-$cartProducts->quantity;
	
	for($i=0;$i<sizeof($selsizestock);$i++)
	{
		if($i!=$stock_index)
		$avail_stock[]=$selsizestock[$i];
		else
		$avail_stock[]=$available_stock;
	}
	$newstock=implode('~',$avail_stock);
	 $query="UPDATE ".TPREFIX.TBL_STOREPRODUCTS." SET stocksizes='".$newstock."' WHERE spid=".$cartProducts->prod_id;
	unset($avail_stock);
	mysql_query($query);
	
}
$data["true"]="true";
 json_encode($data);

?>