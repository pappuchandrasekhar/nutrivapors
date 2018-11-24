<?php

class userClass
{ 




  function getAll_Data_id_new($table_name,$id,$id_name,$order)
		{
		//echo "hai";
			global $callConfig;
		   	 $query=$callConfig->selectQuery(TPREFIX.$table_name,'*',$id_name.'='.$id,$order,$order,'','');
			return $callConfig->getRow($query);
		}
		
	
	
	
	function userProfileEditing($post)

{

//echo "hai";

		global $callConfig;

		$b_date=$_POST['start_year']."-".$_POST['start_month']."-".$_POST['start_day'];
		 
	 $fieldnames=array('first_name'=>$post['first_name'],'lastname'=>$post['lastname'],'username'=>$post['username'],'email_address'=>$post['email_address'],'password'=>$callConfig->passwordEncrypt($post['password']),'confpassword'=>$post['confpassword'],'gender'=>$post['gender'],'dob'=>$post['age'],'address'=>$post['address'],'city'=>$post['city'],'phone'=>$post['phone']);
	
/*$fieldnames=array('mobile'=>$post['mobile'],'email_address'=>$post['email_address'],'password'=>$callConfig->passwordEncrypt($post['password']),'r_class'=>$post['r_class'],'first_name'=>$post['f_name'],'s_name'=>$post['s_name'],'address'=>mysql_real_escape_string($post['address']),'post'=>$post['post'],'dob'=>$post['dob'],'gender'=>$post['rad'],'school'=>$post['school']);*/

		//print_r($fieldnames); exit;

			$res=$callConfig->updateRecord(TPREFIX.TBL_USERS_INFO,$fieldnames,'user_id',$_SESSION['frnt_mid']);

		if($res==1)

		{	
			$callConfig->headerRedirect("editprofile.php?msg=your profile updated successfully");
			//exit;
		}

		else
		{
			$callConfig->headerRedirect("editprofile.php?msg=fail");
			//exit;
		}

}





   function userRegistration($post)  
	{
		//dob=$_POST['age'];
		
		global $callConfig;
		
		//$randomid=rand();
		//print_r($_POST);exit;
		//echo  ("hi");exit;
		
		  
		  
		  
		  $fieldnames=array('first_name'=>$post['first_name'],'lastname'=>$post['lastname'],'username'=>$post['username'],'email_address'=>$post['email_address'],'password'=>$callConfig->passwordEncrypt($post['password']),'confpassword'=>$post['confpassword'],'gender'=>$post['gender'],'dob'=>$post['age']);
		//print_r($fieldnames);exit;
		$res=$callConfig->insertRecord(TPREFIX.TBL_USERS_INFO,$fieldnames);
		

		if($res!="")
		{
	$callConfig->headerRedirect("login.php?msg=User Registration Successful");
		
		}
		else
		{
			$callConfig->headerRedirect("index.php?ferr=User registration failed");
		
		}
		
	}
	function emailInsert($post)
	{
	
		 // echo 'inside insert query';exit;
		global $callConfig;
		 $fieldnames=array('emailid'=>$post['email']);
		$res=$callConfig->insertRecord(TPREFIX.TBL_SUBSCRIBERS,$fieldnames);
	
	}
	
	
	
	
		
function checkMemberLogin()
{
    global $callConfig;
	$nowfront = time();
	$qq="select * from tb_users_info where email_address='".$_POST['email_address']."' and password='".$callConfig->passwordEncrypt($_POST['password'])."' and status='Active'";
	$qq_res=mysql_query($qq);
	$qq_fecth_res=mysql_fetch_array($qq_res);
	$qq_num_rows=mysql_num_rows($qq_res);
	//echo $qq_num_rows;exit;
	if($qq_num_rows>0)
	{	
		 $_SESSION['frnt_mid']=$qq_fecth_res['user_id']; 
		$_SESSION['frnt_usname']=$qq_fecth_res['first_name'];
		$_SESSION['frnt_memail']=$qq_fecth_res['email_address'];
		$_SESSION['frnt_created']=$qq_fecth_res['created_on'];
		$_SESSION['frnt_lastlogin']=$qq_fecth_res['lastlogin'];
		$_SESSION['frontlast_activity'] = $nowfront;
	 /*if($_SESSION['url']!='')
	 {
		header("location:index.php?msg=Login success");
		exit;
	 }
	 else
	{
		header("Location:".$_SESSION['url']);
		
		exit;
	}*/
	
	 if($_SESSION['frnt_mid']!='')
	 {
		header("location:".SITEURL."/index.php?msg=Login success");
		exit;
	 }
	 else
	{
		header("Location:".$_SESSION['url']);
		
		exit;
	}
		//echo "email";exit;
	}
	else if($_GET['act']=="recart")
	{
		$_SESSION['frnt_mid']=$qq_fecth_res['user_id'];
		$_SESSION['frnt_usname']=$qq_fecth_res['username'];
		$_SESSION['frnt_memail']=$qq_fecth_res['email_address'];
		$_SESSION['frnt_created']=$qq_fecth_res['created_on'];
		$_SESSION['frnt_lastlogin']=$qq_fecth_res['lastlogin'];
		$_SESSION['frontlast_activity'] = $nowfront;
		//$_SESSION['memberjoinedon']=$row->createdon;
		//$cartupdattion=userClass::cartitemsUpdatedToUserAccount();
		//$cntfilledornot=userClass::checkShippingBillingaddresFilleed();
		header("location:Shop-Cart.php");
		exit;
	}
	
	else
	{
		header("location:login.php?msg=Login fail, please enter correct details");
		exit;
	}	
} 

 
 

 

    function userAuthentication()

	{

		if($_SESSION['frnt_mid']!="")

		{

			header("location:index.php");

		}

	}

	

	
	
	
	
	
	
	
	
	
	
	
	
	}
	?>