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
		 
	 $fieldnames=array('first_name'=>$post['first_name'],'lastname'=>$post['lastname'],'username'=>$post['username'],'email_address'=>$post['email_address'],'password'=>$callConfig->passwordEncrypt($post['password']),'confpassword'=>$post['confpassword'],'gender'=>$post['gender'],'dob'=>$post['age'],'address'=>$post['address'],'city'=>$post['city'],'phone'=>$post['phone'],'state'=>$post['state'],'zip'=>$post['zip']);
	
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
		
		  
		  //echo "hai";
		  //print_r(email_address);
		  
		 $email_address=$_POST['email_address'];
		
		 $query="select * from tb_users_info where email_address='".$email_address."'";
		
		$nnn=$callConfig->getRow($query);
		
		if($nnn->email_address=="$email_address")
		{
		
		
		$callConfig->headerRedirect("register.php?msg=Email Already Exhists");
		}
		
		
		else
		{
		 
		  
		  
		  
		  $fieldnames=array('first_name'=>$post['first_name'],'lastname'=>$post['lastname'],'username'=>$post['username'],'email_address'=>$post['email_address'],'password'=>$callConfig->passwordEncrypt($post['password']),'confpassword'=>$post['confpassword'],'gender'=>$post['gender'],'dob'=>$post['age'],'address'=>$post['address'],'city'=>$post['city'],'phone'=>$post['phone'],'state'=>$post['state'],'zip'=>$post['zip']);
		//print_r($fieldnames);
		 $res=$callConfig->insertRecord(TPREFIX.TBL_USERS_INFO,$fieldnames);
		 
		 
		 
		 
		 $message="<table width='100%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse;font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#89806e; font-weight:bold;'>
       
         <tr>
				  <td colspan='2' align='left' valign='top'><img src='http://192.254.233.173/~rajeshch/nutrivapors/images/sitelogo_04.png' width='303' height='65'/></td>
				
				  </tr>
      
       
       <tr>
       <td >
        <table cellspacing='0' cellpadding='5'  align='center' width='100%' border='0' style=' font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
				  <tr>
					<td  colspan='2' align='left' valign='top'>Dear<strong> ".$row->username.",</strong></td>
				  </tr>
				  
				  <tr>
					<td valign='top' colspan='2' align='left'>
				Please find below the summary of your Nutrivapors Account Information:</td>
				  </tr>
				
				  <tr>
					<td valign='top' colspan='2' align='left'><table width='100%' border='1' cellspacing='0' cellpadding='0' style='border:1px solid #eeeeee; border-collapse:collapse;font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
						
					<tr>
					  <td width='15%' height='23' align='left' valign='middle' colspan=2 ><strong>Login Details:</strong></td>
					</tr>
					<tr>
					  <td width='15%' height='23' align='left' valign='middle'><strong>Name:</strong></td>
					  <td width='32%' height='23' align='left' valign='middle'>".$post['username']."</td>
					</tr>
					
					<tr>
					  <td width='15%' height='23' align='left' valign='middle'><strong>Email:</strong></td>
					  <td width='32%' height='23' align='left' valign='middle'>".$post['email_address']."</td>
					</tr>
					
					<tr>
					  <td width='15%' height='23' align='left' valign='middle'><strong>Password:</strong></td>
					  <td width='32%' height='23' align='left' valign='middle'>".$post['password']."</td>
					</tr>
					
				  <tr>
					<td valign='top' colspan='2' align='left'><a href='<?=SITEURL?>/login.php?regran=".$qq_user_fetch['ranid']."'>Click here to activate your account</a> </td>
				  
				 
				  
				  </tr>
			
				</table>
       </td>
       </tr>
       <tr >
         <td height='35'>
		 
		
		 
		 
         
         <br >
         <br >
         Sincerely <br >
         Nutrivapors <br > <br >
		
         
         
         </td>
       </tr>
     
    </table>

";

		//echo $message;exit;
		 
		 
		 $headers  = 'MIME-Version: 1.0' . "\r\n";

		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		//$headers .= 'From: StrongerRX <info@themedia3.com>' . "\r\n";

		$headers .= 'From:Nutrivapors <info@Nutrivapors.com>' . "\r\n";

		if(mail($post['email_address'],"Login Details",$message,$headers))

		{

		  $callConfig->headerRedirect("login.php?ferr_frg=4");

		  //exit;

		}

		else

		{

		   $callConfig->headerRedirect("login.php?ferr_frg=5");

		   //exit;

		}
		 
	

		if($res!="")
		{
	$callConfig->headerRedirect("login.php?msg=User Registration Successful");
	// header("Location:".SITEURL.'/'.seoClass::fURL('login.php?page_id=User Registration Successful');
		
		}
		else
		{
			$callConfig->headerRedirect("index.php?ferr=User registration failed");
		
		}
		
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
		  $_SESSION['lastname']=$qq_fecth_res['lastname'];
		 $_SESSION['frnt_memail']=$qq_fecth_res['email_address'];
		$_SESSION['frnt_created']=$qq_fecth_res['created_on'];
		$_SESSION['frnt_lastlogin']=$qq_fecth_res['lastlogin'];
		 $_SESSION['address']=$qq_fecth_res['address'];
		 $_SESSION['city']=$qq_fecth_res['city'];
		 $_SESSION['phone']=$qq_fecth_res['phone'];
		 $_SESSION['state']=$qq_fecth_res['state'];
		 $_SESSION['zip']=$qq_fecth_res['zip'];
		
		
		
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