<?php
class issueClass
{ 

  function getAllPackagesList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_PACKAGES,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllPackagesListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_PACKAGES,'p_id','','','','');
	 return $callConfig->getCount($query);
  } 
 
  function getPackageData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_PACKAGES,'*','p_id='.$id,'','','');
	return $callConfig->getRow($query);
  }
  function getPackageListData($id)
  {
	global $callConfig;
	$order=' id ASC ';
	$query=$callConfig->selectQuery(TPREFIX.TBL_PACKAGES_LIST,'*','p_id='.$id,$order,'','');
	return $callConfig->getAllRows($query);
  }
 
	function insertPackages($post)
	{
		global $callConfig;
		
		$image = $callConfig->freeimageUploadcomncode("package",'img',"../uploads/packages/","../uploads/packages/thumbs/",$post['hdn_image'],291,166);
		$fieldnames=array('p_name'=>mysql_real_escape_string($post['package_name']),'p_price'=>$_POST['price'],'p_img'=>mysql_real_escape_string($image),'p_status'=>$post['status']);
		$res=$callConfig->insertRecord(TPREFIX.TBL_PACKAGES,$fieldnames);
		if($res!="")
		{
			if(count($_POST['p_name'])>0)
			{
				for($i=0;$i<count($_POST['p_name']);$i++)
				{
					if($_POST['p_name'][$i]!=''){ 
					$fieldnames=array('p_id'=>$res,'p_order'=>$_POST['order_no'][$i],'p_product'=>$_POST['p_name'][$i],'p_prodprice'=>$_POST['p_price'][$i]);
					$res1=$callConfig->insertRecord(TPREFIX.TBL_PACKAGES_LIST,$fieldnames);
					}
				}
			}
			sitesettingsClass::recentActivities('Package created successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=packages&err=Package created successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Package creation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=packages&ferr=Package creation failed");
		}
	}
	
	
	function updatePackages($post)
	{
		global $callConfig;
		$res=$callConfig->deleteRecord(TPREFIX.TBL_PACKAGES_LIST,'p_id',$_POST['hdn_id']);
		
		$image = $callConfig->freeimageUploadcomncode("package",'img',"../uploads/packages/","../uploads/packages/thumbs/",$post['hdn_image'],291,166);
		$fieldnames=array('p_name'=>mysql_real_escape_string($post['package_name']),'p_price'=>$_POST['price'],'p_img'=>mysql_real_escape_string($image),'p_status'=>$post['status']);
		 $res=$callConfig->updateRecord(TPREFIX.TBL_PACKAGES,$fieldnames,'p_id',$_POST['hdn_id']);
		if($res!="")
		{
			if(count($_POST['p_name'])>0)
			{
				for($i=0;$i<count($_POST['p_name']);$i++)
				{
					if($_POST['p_name'][$i]!=''){ 
					$fieldnames=array('p_id'=>$_POST['hdn_id'],'p_order'=>$_POST['order_no'][$i],'p_product'=>$_POST['p_name'][$i],'p_prodprice'=>$_POST['p_price'][$i]);
					$res1=$callConfig->insertRecord(TPREFIX.TBL_PACKAGES_LIST,$fieldnames);
					}
				}
			}
			sitesettingsClass::recentActivities('Package updation successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=packages&err=Package updation successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Package updation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=packages&ferr=Package updation failed");
		}
	}
	
	
function PackagesDelete($id)
{	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_PACKAGES,'p_id',$id);
	if($res==1)
	{
		$res=$callConfig->deleteRecord(TPREFIX.TBL_PACKAGES_LIST,'p_id',$id);
		sitesettingsClass::recentActivities('Package deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=packages&err=Package deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Package deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=packages&ferr=Package deletion failed");
	}
}

  // end store //
}	
	?>