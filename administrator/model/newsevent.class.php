<?php

class newseventsClass

{ 

 // Product category //

  function getAllNeweventsList($sortfield,$order,$start,$limit)

  {

	global $callConfig;

	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;

	$query=$callConfig->selectQuery(TPREFIX.TBL_NEWSEVENTS,'*','',$order,$start,$limit);

	return $callConfig->getAllRows($query);

  } 

  function getAllNeweventsListCount()

  {

	global $callConfig;

	$query=$callConfig->selectQuery(TPREFIX.TBL_NEWSEVENTS,'id','','','','');

	 return $callConfig->getCount($query);

  } 

  

  function getNeweventData($id)

  {

	global $callConfig;

	$query=$callConfig->selectQuery(TPREFIX.TBL_NEWSEVENTS,'*','id='.$id,'','','');

	return $callConfig->getRow($query);

  }

 

	function insertNewevents($post)

	{

	global $callConfig;
	
	
	
	
   $path="../uploads/newsevents/testimonial/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $testimage =$callConfig->freeimageUploadcomncode("cat",'image',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$testimage,$path,$path,$hdn_file_name,'200',$height);
   $image=$testimage;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$hdn_file_name,$width,$height);
  }



	$fieldnames=array('testimonialtitle'=>mysql_real_escape_string($post['testimonialtitle']),'title'=>mysql_real_escape_string($post['title']),'bigtext'=>mysql_real_escape_string($post['bigtext']),'status'=>$post['status'],'image'=>$image);

	$res=$callConfig->insertRecord(TPREFIX.TBL_NEWSEVENTS,$fieldnames);

	if($res!="")

	{

		sitesettingsClass::recentActivities('News created successfully on >> '.DATE_TIME_FORMAT.'','g');

		$callConfig->headerRedirect("index.php?option=com_newseventslist&err=News created successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('News creation failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_newseventslist&ferr=News creation failed");

	}

	}

	
function updateNewevents($post)

	{

	global $callConfig;
	
	
	$path="../uploads/newsevents/testimonial/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $testimage =$callConfig->freeimageUploadcomncode("cat",'image',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$testimage,$path,$path,$hdn_file_name,'200',$height);
   $image=$testimage;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$post['hdn_image'],$hdn_file_name,$width,$height);
  }
  
	
	
	
	
	

	$fieldnames=array('testimonialtitle'=>mysql_real_escape_string($post['testimonialtitle']),'title'=>mysql_real_escape_string($post['title']),'bigtext'=>mysql_real_escape_string($post['bigtext']),'image'=>$image,'status'=>$post['status']);

	$res=$callConfig->updateRecord(TPREFIX.TBL_NEWSEVENTS,$fieldnames,'id',$post['hdn_id']);

	if($res==1)

	{

		sitesettingsClass::recentActivities('News updated successfully on >> '.DATE_TIME_FORMAT.'','g');

		$callConfig->headerRedirect("index.php?option=com_newseventslist&err=News updated successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('News updation failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_newseventslist&ferr=News updation failed");

	}

	}


	function neweventsDelete($id)

	{

	global $callConfig;

	$res=$callConfig->deleteRecord(TPREFIX.TBL_NEWSEVENTS,'id',$id);

	if($res==1)

	{

		sitesettingsClass::recentActivities('News deleted successfully on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_newseventslist&err=News deleted successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('News deletion failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_newseventslist&ferr=News deletion failed");

	}

	}

	
	
	function updateDispOrder($post)
	{
	global $callConfig;
	
	//babu codes starts
	for($i=0; $i<count($post['disp_order']); $i++){
	$fieldnames=array('disp_order'=>$post['disp_order'][$i]);
	$res=$callConfig->updateRecord(TPREFIX.TBL_NEWSEVENTS,$fieldnames,'id',$post['disp_order_ids'][$i]);
	}
	//babu codes ends
	
	if($res==1)
	{
		sitesettingsClass::recentActivities('Display Order updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_newseventslist&err=Display Order updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Display Order updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_newseventslist&ferr=Display Order updation failed");
	}
	} 

}	

	?>