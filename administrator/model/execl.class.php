<?php
class execlClass
{ 
 //  door color //
	function get_All_FullNames1($tablename,$returnvar,$where)
	{ 
	    global $callConfig;
		$query=$callConfig->selectQuery($tablename,$returnvar,$where,'','','');
		$res=$callConfig->getRow($query); 
		return $res->$returnvar; 
	}
  function getAlldoorcolorList($where,$sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	if($where!="")
	$whr=" status='".$where."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_DOOR_COLOR,'*',$whr,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAlldoorcolorListCount($where)
  {
	global $callConfig;
	if($where!="")
	$whr=" status='".$where."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_NEW_EXECL,'id',$whr,'','','');
	return $callConfig->getCount($query);
  } 
  function getdoorcolorData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_NEW_EXECL,'*','id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
 
 
 
 function updatedoorcolor($post)

	{

		global $callConfig;
		//$prodimage = $callConfig->freeimageUploadcomncode('prod','image',"../uploads/panel/","../uploads/panel/thumbs/",$post['hdn_image'],160,128);

        $fieldnames=array('title'=>mysql_real_escape_string($post['title']),'color'=>$post['color'],'status'=>$post['status']);
 
        $res=$callConfig->updateRecord(TPREFIX.TBL_NEW_EXECL,$fieldnames,'dcid',$post['hdn_id']);

		if($res==1)

		{

			sitesettingsClass::recentActivities('colors>>color updated successfully on >> '.DATE_TIME_FORMAT.'','g');

			$callConfig->headerRedirect("index.php?option=com_color&err=colors>>  color updated successfully");

		}

		else

		{

			sitesettingsClass::recentActivities('colors >> color updation failed on >> '.DATE_TIME_FORMAT.'','e');

			$callConfig->headerRedirect("index.php?option=com_color&ferr=colors >> color updation failed");

		}

	}
	


	 
	 
	 
	 
	//door dimensions
	
	
	function get_All_FullNames($tablename,$returnvar,$where)
	{ 
	    global $callConfig;
		$query=$callConfig->selectQuery($tablename,$returnvar,$where,'','','');
		$res=$callConfig->getRow($query); 
		return $res->$returnvar; 
	}
  function getAlldoordimensionsList($where,$sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	if($where!="")
	$whr=" status='".$where."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_NEW_EXECL,'*',$whr,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAlldoordimensionsListCount($where)
  {
	global $callConfig;
	if($where!="")
	$whr=" status='".$where."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_DIMENSIONS,'ddid',$whr,'','','');
	return $callConfig->getCount($query);
  } 
  function getdoordimensionsData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_DIMENSIONS,'*','ddid='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
 
 function insertdoordimensions($post)
	{
		global $callConfig;
		/*if($post['reloc']=='color'){
			$prodimage = $post['my-color-picker'];
		}else{
 			$prodimage = $callConfig->freeimageUploadcomncode('prod','image',"../uploads/panel/","../uploads/panel/thumbs/",$post['hdn_image'],160,128);
		}*/
 $fieldnames=array('width'=>$post['width'],'height'=>$post['height'],'status'=>$post['status']);
// print_r($fieldnames); 
 $res=$callConfig->insertRecord(TPREFIX.TBL_DIMENSIONS,$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('dimensions >> dimensions created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_dimensions&err=dimensions >> dimensions created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('dimensions>> dimensions creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_dimensions&ferr=dimensions >> dimensions creation failed");
	}
	}
 
 function updatedoordimensions($post)

	{

		global $callConfig;
		//$prodimage = $callConfig->freeimageUploadcomncode('prod','image',"../uploads/panel/","../uploads/panel/thumbs/",$post['hdn_image'],160,128);

        $fieldnames=array('width'=>$post['width'],'height'=>$post['height'],'status'=>$post['status']);
 
        $res=$callConfig->updateRecord(TPREFIX.TBL_DIMENSIONS,$fieldnames,'ddid',$post['hdn_id']);

		if($res==1)

		{

			sitesettingsClass::recentActivities('dimensions >> dimensions updated successfully on >> '.DATE_TIME_FORMAT.'','g');

			$callConfig->headerRedirect("index.php?option=com_dimensions&err=panel >> dimensions updated successfully");

		}

		else

		{

			sitesettingsClass::recentActivities('dimensions >> dimensions updation failed on >> '.DATE_TIME_FORMAT.'','e');

			$callConfig->headerRedirect("index.php?option=com_dimensions&ferr=Shop >> dimensions updation failed");

		}

	}
	
	function doordimensionsDelete($id)

	{

	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_DIMENSIONS,'image','ddid='.$id,'','','');
	$imageres = $callConfig->getRow($query);
	/*$callConfig->imageCommonUnlink("../uploads/panel/","../uploads/panel/thumbs/",$imageres->image);*/
	$res=$callConfig->deleteRecord(TPREFIX.TBL_DIMENSIONS,'ddid',$id);
	if($res==1)

	{
		sitesettingsClass::recentActivities('dimensions >> dimensions deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_dimensions&err=panel >> dimensions deleted successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('dimensions >> dimensions deletion failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_dimensions&ferr=panel>> dimensions deletion failed");

	}

	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

 }

?>