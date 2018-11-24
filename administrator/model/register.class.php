<?php

class registerUserClass

{ 

  function getCountAllTablesDataCount($tablename,$fieldname,$where)
  {
	global $callConfig;
	if($where!="")
	$whr=$where;
	$query=$callConfig->selectQuery($tablename,$fieldname,$whr,'','','');
	return $callConfig->getCount($query);
  }

 function getAllAdminUsersList($usertype,$sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	/*if($usertype=="senior")
	$whr=" roletype='senior'"; 	
	if($usertype=="level2")
	$whr=" roletype='".$usertype."'";*/
	$query=$callConfig->selectQuery(TPREFIX.TBL_USERS_INFO,'*',$whr,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 

		function getCountry_Data($table_name,$order,$start,$limit)
		{
			global $callConfig;
			$query='SELECT * FROM `tb_country`  GROUP BY `country` ORDER BY id DESC';
			//$callConfig->    selectQuery(TPREFIX.$table_name,'*','',$order,$start,$limit);
			return $callConfig->getAllRows($query);
		}
		
		function getAll_states($table_name,$order,$start,$limit)
		{
			global $callConfig;
			$whr=" country =  'United States of America'";
			$query=$callConfig->selectQuery(TPREFIX.$table_name,'*',$whr,$order,$start,$limit);
			return $callConfig->getAllRows($query);
		}
		function getAll_Data($table_name,$order,$start,$limit)
		{
			global $callConfig;
			
			$query=$callConfig->selectQuery(TPREFIX.$table_name,'*','',$order,$start,$limit);
			return $callConfig->getAllRows($query);
		}

  function getAllAdminUsersListCount($usertype)
  {
	global $callConfig;
	/*if($usertype=="senior")
	$whr=" roletype='senior'";
	if($usertype=="level2")
	$whr=" roletype='".$usertype."'";	*/
	$query=$callConfig->selectQuery(TPREFIX.TBL_USERS_INFO,'user_id',$whr,'','','');
	 return $callConfig->getCount($query);
  } 
  
   function getAdminUserData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_USERS_INFO,'*','user_id='.$id,'','','');
	return $callConfig->getRow($query);
  }
  
  function checkAdmin()

 {
    global $callConfig;
$where="us_name='".$_POST['chrUserName']."' and password='".$callConfig->passwordEncrypt($_POST['chrPassword'])."' and status='Active' and 	(roletype='senior' or roletype='level1')";
	$query=$callConfig->selectQuery(TPREFIX.TBL_ADMIN,'*',$where,'','','');
	$row=$callConfig->getRow($query);
	if($row->user_id!="")
	{
	$_SESSION['userid']=$row->user_id;
	$_SESSION['us_name']=$row->us_name;
	$_SESSION['email']=$row->email;
	$_SESSION['lastlogin']=$row->lastlogin;
	$_SESSION['roletype']=$row->roletype;
	$_SESSION['adminmemberjoinedon']=$row->createdon;
	sitesettingsClass::recentActivities($_SESSION['us_name'].' >> login sucessfully on >> '.DATE_TIME_FORMAT.'','g');
	header("location:index.php?option=com_dashboard");
	exit;
	}

	else

	{

	header("location:index.php?ferr=Login failed, please check the login details");

	exit;

	}

 } 

 

    function userAuthentication()

	{

		if($_SESSION['userid']!="")

		{

			header("location:index.php?option=com_dashboard");

		}

	}
function insertAdminUser($post)
	{
		global $callConfig;
		$fieldnames=array('us_name'=>$post['name'],'`password`'=>$callConfig->passwordEncrypt($post['password']),'email'=>$post['email'],'roletype'=>'senior','status'=>$post['status']);
		$res=$callConfig->insertRecord(TPREFIX.TBL_ADMIN,$fieldnames);
		if($res!="")
		{
			sitesettingsClass::recentActivities('Admin User created successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_adminlist&err=Admin User created successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Admin User creation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_adminlist&ferr=Admin User creation failed");
		}
	}

	

	function updateAdminUser($post)
	{
		global $callConfig;
		if($post['status']!="")
		{
		$fieldnames=array('us_name'=>$post['name'],'`password`'=>$callConfig->passwordEncrypt($post['password']),'email'=>$post['email'],'status'=>$post['status']);
		}
		else
		{
		 $fieldnames=array('us_name'=>$post['name'],'`password`'=>$callConfig->passwordEncrypt($post['password']),'email'=>$post['email']);
		}
		$res=$callConfig->updateRecord(TPREFIX.TBL_ADMIN,$fieldnames,'user_id',$post['hdn_user_id']);
		if($res==1)
		{
			sitesettingsClass::recentActivities('Admin User updated successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_adminlist&err=Admin User updated successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Admin User updation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_adminlist&ferr=Admin User updation failed");
		}
	}

	function adminuserDelete($id)
	{
		global $callConfig;
		$res=$callConfig->deleteRecord(TPREFIX.TBL_ADMIN,'user_id',$id);
		if($res==1)
		{
			sitesettingsClass::recentActivities('Admin User deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_adminlist&err=Admin User deleted successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Admin User deletion failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_adminlist&ferr=Admin User deletion failed");
		}
	}

	

	function forntuserDelete($id)

	{

	global $callConfig;

	$res=$callConfig->deleteRecord(TPREFIX.TBL_ADMIN,'user_id',$id);

	if($res==1)

	{

	    $callConfig->deleteRecord(TPREFIX.TBL_ADMINSINFO,'userid',$id);

		sitesettingsClass::recentActivities('User >> deleted successfully on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_memberlist&err=User >> deleted successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('User >> deletion failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_memberlist&ferr=User >> deletion failed");

	}

	}

	

	function forntuserStatusChanging($get){

	global $callConfig;

	if($get['st']=="Active")

	$statusbe='Inactive';

	else

	$statusbe='Active';

	$fieldnames=array('status'=>$statusbe);

	$res=$callConfig->updateRecord(TPREFIX.TBL_ADMIN,$fieldnames,'user_id',$get['id']);

	if($res==1)

	{

		sitesettingsClass::recentActivities('User >> Status changed successfully on >> '.DATE_TIME_FORMAT.'','g');

		$callConfig->headerRedirect("index.php?option=com_memberlist&err=User >> Status changed successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('User >> Status changing failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_memberlist&ferr=User >> Status changing failed");

	}

	}
function getRegisterUserData($id,$search_val='')
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TBL_USERS_INFO,'*','usergetAllAdminUsersListid='.$id,'','','');
	return $callConfig->fetchRow($query);
  }
  
  

  function getAllRegisterUList($whr,$sortfield,$order,$start,$limit)
  {
	global $callConfig;
	$whr=" status='".$whr."'";
    $query=$callConfig->selectQuery(TPREFIX.TBL_USERS_INFO,'*',$whr,$order,$start,$limit); 
	return $callConfig->fetchRows($query);
  } 
  
  
  function getAllRegisterUsersList($parentid,$sortfield,$order,$start,$limit,$search_name='')
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	if($search_name) $whr = 'username like "%'.$search_name.'%"';
	$query=$callConfig->selectQuery(TBL_USERS_INFO,'*',$whr,$order,$start,$limit);
	return $callConfig->fetchRows($query);
  } 
  
  
  function getAllRegisterUsersListCount()
  {
	global $callConfig;
	$whr="";
	$query=$callConfig->selectQuery(TBL_USERS_INFO,'user_id',$whr,'','','');
	 return $callConfig->fetchCount($query);
  } 
  
  function registeruserStatusChanging($get){
	global $callConfig;
	if($get['st']=="Active")
	$statusbe='Inactive';
	else
	$statusbe='Active';
	if($get['pid']=='0' && $get['st']=="Inactive")
	{
	$statusbe='Active';
	}
	$fieldnames=array('status'=>$statusbe);
	$res=$callConfig->updateRecord(TBL_USERS_INFO,$fieldnames,'user_id='.$get['id'] .$cond);
	if($res==1)
	{
		sitesettingsClass::recentActivities('User >> Status changed successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_userslist&err=User >> Status changed successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('User >> Status changing failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_userslist&ferr=User >> Status changing failed");
	}
	}
  
 
 function registeruserDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_USERS_INFO,'user_id',$id);
	if($res>=1)
	{
		sitesettingsClass::recentActivities('Register User deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_userslist&err=Register User deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Register User deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_userslist&ferr=Register User deletion failed");
	}
	}
	function insertRegisterUser($post)
	{
		global $callConfig;
		$res = $callConfig->getRow($query);
	    $fieldnames1=array('first_name'=>$post['name'],'`password`'=>$callConfig->passwordEncrypt($post['password']),'email_address'=>$post['email'],'lastname'=>$post['lastname'],'city'=>$post['city'],'state'=>$post['state'],'zip'=>$post['zip'],'phone'=>$post['phone'],'address'=>mysql_real_escape_string($post['address']),'status'=>$post['status']);
		//print_r($fieldnames1);  exit; 

		$res1=$callConfig->insertRecord(TPREFIX.TBL_USERS_INFO,$fieldnames1);   
		if($res1!="")
		{
			sitesettingsClass::recentActivities('Registred User created successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_userslist&err=Registered User created successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Registred User creation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_userslist&ferr=Registered User creation failed");
		}
	}
	
	function updateRegisterUser($post)
	{
		global $callConfig;
		$res = $callConfig->getRow($query);
		$fieldnames1=array('first_name'=>$post['name'],'`password`'=>$callConfig->passwordEncrypt($post['password']),'lastname'=>$post['lastname'],'city'=>$post['city'],'state'=>$post['state'],'zip'=>$post['zip'],'phone'=>$post['phone'],'address'=>mysql_real_escape_string($post['address']),'email_address'=>$post['email'],'status'=>$post['status']);
		//print_r($fieldnames1);    exit;
		
		$res1=$callConfig->updateRecord(TPREFIX.TBL_USERS_INFO,$fieldnames1,'user_id',$post['hdn_user_id']);   
		if($res1!="")
		{
			sitesettingsClass::recentActivities('Registred User updated successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_userslist&err=Registered User updated successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Registred User updation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_userslist&ferr=Registered User updation failed");
		}
	}
	

}

?>