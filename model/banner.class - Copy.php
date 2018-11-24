<?php
class bannerClass
{ 
  
  function getAllBannersList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	//if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_BANNERS,'*',"status='Active' ",$order,$start,$limit);
	return $callConfig->getAllRows($query);
  }  
  
  
  function getAllrightbanlist($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	//if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	  $query=$callConfig->selectQuery(TPREFIX.TBL_STOREPRODUCTS,'*',"status='Active ' ",'spid DESC',0,5);
	return $callConfig->getAllRows($query);
  }  
  
 function getAllCategoyList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	//if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_STORECATEGORY,'*',"status='Active' ",$order,0,3);
	return $callConfig->getAllRows($query);
  }  
  
 function getAllPages($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	$where="cid!=5 && cid!=6";
	
	 $query=$callConfig->selectQuery(TPREFIX.TBL_CONTENTPAGES,'*', $where ,"status='Active'", $order,$start,$limit);
	return $callConfig->getAllRows($query);
  }  
  
  
  
 function getAllterms()
  {
	  //echo "hai";
	global $callConfig;
	
	
	 $query="select * from tb_contentpages where page_id='5'";
	return $callConfig->getRow($query);
  }  
  
  
  
 
 function getPages($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	$where="cid=5";
	 $query=$callConfig->selectQuery(TPREFIX.TBL_CONTENTPAGES,'*', $where, "status='Active' ",$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
 
 
 
 
 
  function getSecurePayment($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	$where="cid=6";
	 $query=$callConfig->selectQuery(TPREFIX.TBL_CONTENTPAGES,'*', $where, "status='Active' ",$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
 
 
  function getFaq($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	//$where="cid=6";
	 $query=$callConfig->selectQuery(TPREFIX.TBL_FAQ, '*', "status='Active' ",$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
 
 
 
 
 
 
 
 
 	function getuserdata($id)
{
	    global $callConfig;
		$whr="user_id='$id'";
	    $query=$callConfig->selectQuery(TPREFIX.TBL_USERS_INFO,'*',$whr,'','','');
		return $callConfig->getRow($query);

}




   function getAllFeaturedList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	//if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_STOREPRODUCTS,'*',"featuredlisting='yes' ",$order,$start,$limit);
	return $callConfig->getAllRows($query);
  }  
  



/////////////////////////////-------pagetitle-----------///////////////////////




  function getpagetitle($id)
  {
	  global $callConfig;
	   $query="select * from tb_store_category where scid='".$id."'";
	   
	  return $callConfig->getRow($query);
  }



   function getproductdescription($sid)
   {
	    global $callConfig;
		$query="select * from tb_store_products where spid='".$sid."'";
		return $callConfig->getRow($query);
	   
   }



///////////////////////////-------pagetitleend-----------/////////////////////



///////////////----------pagenation----////////////////


function getAllfaq($id,$order,$start,$limit)
  {
	global $callConfig;
	//if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$whr="scid='$id'";
	 $query=$callConfig->selectQuery(TPREFIX.TBL_STOREPRODUCTS,'*',$whr,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  }   
	
	
	
	
	/*function getAllfaqListCount()
  {
	global $callConfig;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_STOREPRODUCTS,'spid','','','','');
	
	 return $callConfig->getCount($query);
	  
  } 
*/




///////////////----------pagenationend----////////////////

function gettoprated()
{
	global $callConfig;
	
  $query="SELECT * FROM tb_commentsection WHERE STATUS = 'Active'  order by rating DESC 0,3";
	
  //$query=$callConfig->selectQuery('tb_commentsection','MAX(rating) as rating',"status='Active' a",'',0,3);
	return $callConfig->getAllRows($query); 
	
}


function loginchecking($post)
	{
	 	
		$_POST['password'];
		global $callConfig;
	 //$pagenavigatings=$_SESSION['url'];
	 $passwd=$callConfig->passwordEncrypt($_POST['password']);
	 $where="email_address='".$_POST['email']."' and password='".$passwd."' and status='Active'";
	  $query=$callConfig->selectQuery(TPREFIX.TBL_USERS_INFO,'*',$where,'','','');
		//echo  $query; 
  $row=$callConfig->getRow($query); 
 	print_r($row);
	  
	 if($row=="") 
	 {
		
	  if($_SESSION['login']=="login"){
	   unset($_SESSION['login']);
	   $_SESSION['msg1']="failed";
		//$callConfig->headerRedirect(SITEURL."/Checkout");
		 header("Location:checkout.php");
		exit;
	   }
	   else { 
	  
	   $_SESSION['msg']="failed";
		//$callConfig->headerRedirect(SITEURL."/Login");
		 header("Location:register.php");
		exit;
	   }
	 }
	  
	 else
	 {
	//echo $row->status.$row->user_id; 
		//$row->id; exit;
	
	if($row->user_id!="")
		{
		//echo $row->user_id; exit;
		 /*****************************Remember passowrd************************/
			
        if($_POST['rember']=="yes"){
		setcookie("Password", $_POST['password']);
		setcookie("Password", $_POST['password'], time()+3600);  /* expire in 1 hour */
		setcookie("Password", $_POST['password'], time()+3600, "/~rasmus/", "example.com", 1);
		
		setcookie("Username", $_POST['first_name']);
		setcookie("Username", $_POST['first_name'], time()+3600);  /* expire in 1 hour */
		setcookie("Username", $_POST['first_name'], time()+3600, "/~rasmus/", "example.com", 1);
		
		setcookie("Useremail", $_POST['email_address']);
		setcookie("Useremail", $_POST['email_address'], time()+3600);  /* expire in 1 hour */
		setcookie("Useremail", $_POST['email_address'], time()+3600, "/~rasmus/", "example.com", 1);
		
		}
        
		/************************************************************************/
		//echo 1; exit;
		    $_SESSION['frnt_mid']=$row->user_id;

		    $_SESSION['email_address']=$row->email_address;

			 $_SESSION['firstname']=$row->first_name;

			 $_SESSION['lastname']=$row->lastname;

			$now = time();

			 $_SESSION['last_activity'] = $now;			
			
			
	
	  if($_SESSION['login']=="login"){	   
			unset($_SESSION['login']);
			unset($_SESSION['support']);
			//print_r($_SESSION);
			//$callConfig->headerRedirect(SITEURL."/Checkout");
			 header("Location:checkout.php");
			exit;
	  }
	  else if($_SESSION['support']=="support")
	  {
		  unset($_SESSION['support']);
		  unset($_SESSION['login']);
		  //print_r($_SESSION);
		 // $callConfig->headerRedirect(SITEURL."/Support");
		   header("Location:support.php");
		  exit;		  
	  }
	  else
	  {
		//$callConfig->headerRedirect(SITEURL);
		 header("Location:index.php");
		exit;			 
	  }
			
			
		}
	
	
  
//$callConfig->headerRedirect(SITEURL."/Profile");
 header("Location:index.php");   
			
		  exit;

 
 }
 }


  
}

?>