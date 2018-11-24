<?php
//echo 'hi'; exit;
ob_start();
session_start();
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
 $spid = intval($_GET['spid']);
 $pimg=$_GET['pimg'];
   $probname=$_GET['probname'];

 $catid=$_GET['catid'];
$price=$_GET['price'];
$price2=$_GET['price2'];
 $qun=$_GET['qun']; 
$type=$_GET['type']; 

$cont_mg=$_GET['cont_mg'];
 $bottle_size=$_GET['bottle_size']; 
$weight=intval($_GET['weight']);
$finish=$_GET['finish'];
$vcolor=$_GET['vcolor'];
$product_type1=$_GET['product_type1'];
//$product_type1=$_GET['catid'];

//echo 'hi'; exit;
 //echo $_POST['price']; *($_POST['quantity']+$res->quantity)
			global $callConfig;
			 
			if($_SESSION['CART_TEMP_RANDOM'] == "") 
			{
			$_SESSION['CART_TEMP_RANDOM'] = rand(10, 10).sha1(crypt(time())).time();
			}
			//$id=$_POST['spid']; 
			if($product_type1=="direct")
			{
				$id=$spid;
				
				}else{
			  $id=$spid; }
		
			 $sel="select * from ".TPREFIX.TBL_CART." where temprandid='".$_SESSION['CART_TEMP_RANDOM']."' and prod_id='".$id."'";
		     $res=$callConfig->getRow($sel);
		
		//print_r($res);exit;
           //echo $res->prod_id;
		  // echo $id;
		//if($res->prod_id==$_POST['spid'] && $res->bottle_size==$_POST['bottle_size'] && $res->quantity==$_POST['qun'])
		 
		 
		 	if($catid!="" && $catid==1){ 
		 $sarat= $res->cont_mg==$cont_mg;
		}
		else {
			$sarat= $res->prod_id==$id;
			}
		  	
		if($res->prod_id==$id && $res->bottle_size==$bottle_size && $sarat)
		{
		//echo "sarat";exit;
		$quantity=$qun+$res->quantity;
		$totlaprice=$res->indiv_price*$quantity;
		$newweight=$weight*$qun;
		$weight1=$res->weight+$newweight;
		//$weight1=$res->weight+$weight;
		           
		 $fieldnames=array('cart_cid'=>$catid,'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($probname),'bottle_size'=>$bottle_size,'cont_mg'=>$cont_mg,'indiv_price'=>$price2,'weight'=>$weight1,'quantity'=>$quantity,'bulkpacketcount'=>$_POST['bulkpacketcount'],'type'=>$_POST['type'],'total_price'=>$totlaprice,'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$pimg,'type'=>$type,'ejuicefinish'=>$finish,'vcolor'=>$vcolor);
		
		$whr = "prod_id='".$id."' and temprandid='".$_SESSION['CART_TEMP_RANDOM']."' ";
			$res=$callConfig->updateRecord1(TPREFIX.TBL_CART,$fieldnames,$whr,'');
					echo '<script>alert("Your Item(s) have been added to the cart!");</script>';
		}
		else
			{
				/* $fieldnames=array('cart_cid'=>$_POST['catid'],'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($_POST['probname']),'bottle_size'=>$_POST['bottle_size'],'cont_mg'=>$_POST['cont_mg'],'indiv_price'=>$_POST['price2'],'quantity'=>$_POST['qun'],'total_price'=>$_POST['price']*($_POST['quantity']),'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$_POST['pimg']);*/
					$weight=$weight*$qun;
	         $fieldnames=array('cart_cid'=>$catid,'prod_id'=>$id,'prod_name'=>mysql_real_escape_string($probname),'bottle_size'=>$bottle_size,'cont_mg'=>$cont_mg,'indiv_price'=>$price2,'weight'=>$weight,'quantity'=>$qun,'bulkpacketcount'=>$_POST['bulkpacketcount'],'type'=>$_POST['type'],'total_price'=>$price,'temprandid' =>$_SESSION['CART_TEMP_RANDOM'],'p_img'=>$pimg,'type'=>$type,'ejuicefinish'=>$finish,'vcolor'=>$vcolor);
			//print_r($fieldnames);exit;
			$res=$callConfig->insertRecord(TPREFIX.TBL_CART,$fieldnames);
			}
		//echo "sarat";exit;
		echo "Your Item has been added to the cart&nbsp;<a href='".SITEURL."/shopping_cart.php'><strong>Go To Shopping Cart</strong></a>";
		exit;
		 //header("Location:".$_POST['url']."&msg=Your Item has been added to the cart");
 
?>