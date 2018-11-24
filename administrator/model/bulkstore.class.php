<?php
class storeClass
{ 
 // store category //
	function get_All_FullNames($tablename,$returnvar,$where)
	{ 
	    global $callConfig;
		$query=$callConfig->selectQuery($tablename,$returnvar,$where,'','','');
		$res=$callConfig->getRow($query); 
		return $res->$returnvar; 
	}
  function getAllStoreCategoryList($where,$sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	if($where!="")
	$whr=" status='".$where."'";
	 $query=$callConfig->selectQuery(TPREFIX.TBL_STORECATEGORY,'*',$whr,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllStoreCategoryListCount($where)
  {
	global $callConfig;
	if($where!="")
	$whr=" status='".$where."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORECATEGORY,'scid',$whr,'','','');
	return $callConfig->getCount($query);
  } 
  function getStoreCategoryData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORECATEGORY,'*','scid='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	function insertStoreCategory($post)
	{
	global $callConfig;
	$titleslug=$callConfig->remove_special_symbols2($post['title_slug']);
	
	
	$path="../uploads/store/category/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $img_name1 =$callConfig->freealbumImagesUpload3("cat",'image',$path,$path,$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$img_name1,$path,$path."thumbs/",$hdn_file_name,'200',$height);
   $image=$img_name1;
   
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$hdn_file_name,$width,$height);
  
  }
	
	/*$image = $callConfig->freeimageUploadcomncode("cat",'image',"../uploads/store/category/","../uploads/store/category/thumbs/",$post['hdn_image'],208,95);*/
	
	
	
	
$fieldnames=array('catetitle'=>mysql_real_escape_string($post['catetitle']),'bigtext'=>mysql_real_escape_string($post['content']),'image'=>$image,'title'=>mysql_real_escape_string($post['title']),'title_slug'=>$titleslug,'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'status'=>$post['status']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_STORECATEGORY,$fieldnames);
	if($res!="")
	{
		sitesettingsClass::recentActivities('Store >> Category created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_storecat&err=Store  Category created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Category creation failed on >> '.DATE_TIME_FORMAT.'','e');
		
		$callConfig->headerRedirect("index.php?option=com_storecat&ferr=Store Category creation failed");
	}
	}
	
	function updateStoreCategory($post)
	{
	global $callConfig;
	$titleslug=$callConfig->remove_special_symbols2($post['title_slug']);



$path="../uploads/store/category/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $img_name1 =$callConfig->freealbumImagesUpload3("cat",'image',$path,$path,$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$img_name1,$path,$path."thumbs/",$hdn_file_name,'200',$height);
   $image=$img_name1;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$post['hdn_image'],$width,$height);
  }


	/*$image = $callConfig->freeimageUploadcomncode("cat",'image',"../uploads/store/category/","../uploads/store/category/thumbs/",$post['hdn_image'],208,95);*/
	
	
	
	$fieldnames=array('catetitle'=>mysql_real_escape_string($post['catetitle']),'bigtext'=>mysql_real_escape_string($post['content']),'image'=>$image,'title'=>mysql_real_escape_string($post['title']),'title_slug'=>$titleslug,'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'status'=>$post['status']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_STORECATEGORY,$fieldnames,'scid',$post['hdn_id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Store >> Category updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_storecat&err=Store Category updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Category updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_storecat&ferr=Store Category updation failed");
	}
	}
	function storeCategoryDelete($id)
	{
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORECATEGORY,'image','scid='.$id,'','','');
	$imageres = $callConfig->getRow($query);
	$callConfig->imageCommonUnlink("../uploads/store/category/","../uploads/store/category/thumbs/",$imageres->image);
	$res=$callConfig->deleteRecord(TPREFIX.TBL_STORECATEGORY,'scid',$id);
	if($res==1)
	{
		$query=$callConfig->selectQuery(TPREFIX.TBL_BULKSTORE_PRODUCTS,'spid,image','scid='.$id,'','','');
		$productsres = $callConfig->getAllRows($query);
		$c=array();
		foreach($productsres as $res_prod){
		$c[]=$res_prod->spid;
		$callConfig->imageCommonUnlink("../uploads/store/products/","../uploads/store/products/thumbs/",$res_prod->image);
		}
		$callConfig->deleteRecord(TPREFIX.TBL_BULKSTORE_PRODUCTS,'spid',$c);
		sitesettingsClass::recentActivities('Store >> Category deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_storecat&err=Store Category deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Category deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_storecat&ferr=Store Category deletion failed");
	}
	}
// end store category //

 function getAllStoreSubCategoryList($where,$sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	if($where!="")
	$whr=" status='".$where."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORESUBCATEGORY,'*',$whr,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllStoreSubCategoryListCount($where)
  {
	global $callConfig;
	if($where!="")
	$whr=" status='".$where."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORESUBCATEGORY,'sscid',$whr,'','','');
	return $callConfig->getCount($query);
  } 
  function getStoreSubCategoryData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORESUBCATEGORY,'*','sscid='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
 function getStoreSubCategory_D($id)
  {
	global $callConfig;
	echo $query=$callConfig->selectQuery(TPREFIX.TBL_STORESUBCATEGORY,'*','scid='.$id,'','','');
	return $callConfig->getAllRows($query);
 }
 
 
	function insertStoreSubCategory($post)
	{
		
		global $callConfig;
		$titleslug=$callConfig->remove_special_symbols2($post['title_slug']);
		
		/*$image = $callConfig->freeimageUploadcomncode("cat",'image',"../uploads/store/subcategory/","../uploads/store/subcategory/thumbs/",$post['hdn_image'],208,95);*/
		
		
		
		$path="../uploads/store/subcategory/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $img_name1 =$callConfig->freealbumImagesUpload3("cat",'image',$path,$path,$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$img_name1,$path,$path."thumbs/",$hdn_file_name,'200',$height);
   $image=$img_name1;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$hdn_file_name,$width,$height);
  }
	
		
		
		
		
		$fieldnames=array('scid'=>$post['scid'],'subcatetitle'=>mysql_real_escape_string($post['catetitle']),'bigtext'=>mysql_real_escape_string($post['bigtext']),'image'=>$image,'title'=>mysql_real_escape_string($post['title']),'title_slug'=>$titleslug,'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'status'=>$post['status']);
		$res=$callConfig->insertRecord(TPREFIX.TBL_STORESUBCATEGORY,$fieldnames);
		if($res!="")
		{
			sitesettingsClass::recentActivities('Store >> SubCategory created successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_storesubcat&err=Store  SubCategory created successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Store >> SubCategory creation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_storesubcat&ferr=Store SubCategory creation failed");
		}
	}
	
	function updateStoreSubCategory($post)
	{ 
	
		global $callConfig;
		$titleslug=$callConfig->remove_special_symbols2($post['title_slug']);
		
		
		
		/*$image = $callConfig->freeimageUploadcomncode("cat",'image',"../uploads/store/subcategory/","../uploads/store/subcategory/thumbs/",$post['hdn_image'],208,95);*/
		
		$path="../uploads/store/subcategory/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $img_name1 =$callConfig->freealbumImagesUpload3("cat",'image',$path,$path,$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$img_name1,$path,$path."thumbs/",$hdn_file_name,'200',$height);
   $image=$img_name1;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$post['hdn_image'],$width,$height);
  }
	
		
		
		
		
		
		$fieldnames=array('scid'=>$post['scid'],'subcatetitle'=>mysql_real_escape_string($post['catetitle']),'bigtext'=>mysql_real_escape_string($post['bigtext']),'image'=>$image,'title'=>mysql_real_escape_string($post['title']),'title_slug'=>$titleslug,'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'status'=>$post['status']);
		
		//print_r($fieldnames); 
		  $res=$callConfig->updateRecord(TPREFIX.TBL_STORESUBCATEGORY,$fieldnames,'sscid',$post['hdn_id']); 
	//exit;
		if($res==1)
		{
			sitesettingsClass::recentActivities('Store >> SubCategory updated successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_storesubcat&err=Store SubCategory updated successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Store >> SubCategory updation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_storesubcat&ferr=Store  SubCategory updation failed");
		}
	}
	function storeSubCategoryDelete($id)
	{
		global $callConfig;
		$query=$callConfig->selectQuery(TPREFIX.TBL_STORESUBCATEGORY,'image','sscid='.$id,'','','');
		$imageres = $callConfig->getRow($query);
		$callConfig->imageCommonUnlink("../uploads/store/subcategory/","../uploads/store/subcategory/thumbs/",$imageres->image);
		$res=$callConfig->deleteRecord(TPREFIX.TBL_STORESUBCATEGORY,'sscid',$id);
		if($res==1)
		{
			$query=$callConfig->selectQuery(TPREFIX.TBL_BULKSTORE_PRODUCTS,'spid,image','scid='.$id,'','','');
			$productsres = $callConfig->getAllRows($query);
			$c=array();
			foreach($productsres as $res_prod){
			$c[]=$res_prod->spid;
			$callConfig->imageCommonUnlink("../uploads/store/products/","../uploads/store/products/thumbs/",$res_prod->image);
			}
			$callConfig->deleteRecord(TPREFIX.TBL_BULKSTORE_PRODUCTS,'spid',$c);
			sitesettingsClass::recentActivities('Store >> SubCategory deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_storesubcat&err=Store SubCategory deleted successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Store >> Category deletion failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_storesubcat&ferr=Store SubCategory deletion failed");
		}
	}


























 // Product store //
 function getAllProductSizes($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORESIZES,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  }
 function getAllProductsList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_BULKSTORE_PRODUCTS,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllProductsListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BULKSTORE_PRODUCTS,'spid','','','','');
	 return $callConfig->getCount($query);
  } 
  
//  function getAllProductColors()
//  {
//	global $callConfig;
//  if($sortfield!="" && $order!="")  $order=$sortfield.' '.$order;
//  $query=$callConfig->selectQuery(TPREFIX.TBL_BULKSTORE_PRODUCTS,'*','',$order,$start,$limit);
//	  
//	}
  
  function getProductData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BULKSTORE_PRODUCTS,'*','spid='.$id,'','','');
	return $callConfig->getRow($query);
 }
 
	/*function insertProducts($post)
	{
		global $callConfig;
		
		
    $path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage =$callConfig->freeimageUploadcomncode("cat",'image',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage,$path,$path,$hdn_file_name,'200',$height);
   $image=$prodimage;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$hdn_file_name,$width,$height);
  }
		
	
	$titleslug=$callConfig->remove_special_symbols2($post['title_slug']);
	$lang= $_POST['colorstab'];
    $colors = implode(",",$lang);
	
	
	$fieldnames=array('scid'=>$post['scid'],'sscid'=>$_POST['sscid'],'bid'=>$post['bid'],'prodtitle'=>mysql_real_escape_string($post['prodtitle']),'prodsizes'=>$sizepro,'prodtitle_slug'=>$titleslug,'bigtext'=>mysql_real_escape_string($post['content']),'image'=>$image,'color'=>$post['color'],'colorstab'=>$colors,'real_price'=>$post['real_price'],'featuredlisting'=>$_POST['featured'],'aval_stock'=>$post['aval_stock'],'title_slug'=>$titleslug,'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'lotnumber'=>mysql_real_escape_string($post['lot']),


'fabric'=>mysql_real_escape_string($post['fab']),

'blend'=>mysql_real_escape_string($post['ble']),

'care'=>mysql_real_escape_string($post['car']),

'protection'=>mysql_real_escape_string($post['pro']),
'finish'=>mysql_real_escape_string($post['fin']),

'silhouette'=>mysql_real_escape_string($post['silh']),
'closure'=>mysql_real_escape_string($post['clos']),
'collar'=>mysql_real_escape_string($post['coll']),
'length'=>mysql_real_escape_string($post['leng']),
'cuff'=>mysql_real_escape_string($post['cuf']),
'pocket'=>mysql_real_escape_string($post['poc']),
'waistband'=>mysql_real_escape_string($post['wai']),'status'=>$post['status']);
	$res=$callConfig->insertRecord(TPREFIX.TBL_BULKSTORE_PRODUCTS,$fieldnames);
	
	if($res!="")

	
	{
		
		for($i=0;$i<count($_POST['sid']);$i++)
		{
		if($_POST['sid'][$i]!='' || $_POST['rs'][$i])
			{
				
				$fieldnames=array('x_dim2'=>$_POST['sid'][$i],'n_listprice'=>$_POST['rs'][$i],'n_netprice'=>$_POST['rs'][$i],'pid'=>$res,'c_lotid'=>mysql_real_escape_string($post['lot']));
				
		        $res2=$callConfig->insertRecord(TPREFIX.TBL_STORE_SKU,$fieldnames);
				
			}
		}
		
		sitesettingsClass::recentActivities('Store >> Product created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&err=Store Product created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Product creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&ferr=Store  Product creation failed");
	}
	}
	
	function updateProducts($post)
	{
	global $callConfig;
	
	if($post['nosize']=="")
	{
		
	for($i=1;$i<8;$i++){
	$ssss[]=$post['size'.$i];
	$ssss2[]=$post['sizestock'.$i];
	}
	
	 $prodsizes=implode("~",$ssss);
	 $stocksizes=implode("~",$ssss2);
		
	if($stocksizes=="~")
	$stocksizes="";
	
	if($prodsizes=="~")
	$prodsizes="";
	
	}
	else
	{
	$stocksizes=$post['nosize'];
			$prodsizes="";
	}
	
	$path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage =$callConfig->freeimageUploadcomncode("cat",'image',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage,$path,$path,$hdn_file_name,'200',$height);
   $image=$prodimage;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$post['hdn_image'],$hdn_file_name,$width,$height);
  }
		
	
	
	if($post['offer']=="no"){
	$oldprice="";
	$newprice=$post['newprice'];
	} else {
	$oldprice=$post['oldprice'];
	$newprice=$post['newprice'];
	}
	$titleslug=$callConfig->remove_special_symbols2($post['title_slug']);
	$lang= $_POST['colorstab'];
    $colors = implode(",",$lang);
	
	$sizes= $_POST['size'];
    $sizepro= implode(",",$sizes);
	
	
	$fieldnames=array('scid'=>$post['scid'],'sscid'=>$_POST['sscid'],'bid'=>$post['bid'],'prodtitle'=>mysql_real_escape_string($post['prodtitle']),'prodsizes'=>$sizepro,'prodtitle_slug'=>$titleslug,'bigtext'=>mysql_real_escape_string($post['content']),'image'=>$image,'color'=>$post['color'],'colorstab'=>$colors,'real_price'=>$post['real_price'],'featuredlisting'=>$_POST['featured'],'aval_stock'=>$post['aval_stock'],'title_slug'=>$titleslug,'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'lotnumber'=>mysql_real_escape_string($post['lot']),

'fabric'=>mysql_real_escape_string($post['fab']),

'blend'=>mysql_real_escape_string($post['ble']),

'care'=>mysql_real_escape_string($post['car']),

'protection'=>mysql_real_escape_string($post['pro']),
'finish'=>mysql_real_escape_string($post['fin']),

'silhouette'=>mysql_real_escape_string($post['silh']),
'closure'=>mysql_real_escape_string($post['clos']),
'collar'=>mysql_real_escape_string($post['coll']),
'length'=>mysql_real_escape_string($post['leng']),
'cuff'=>mysql_real_escape_string($post['cuf']),
'pocket'=>mysql_real_escape_string($post['poc']),
'waistband'=>mysql_real_escape_string($post['wai']),'status'=>$post['status']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_BULKSTORE_PRODUCTS,$fieldnames,'spid',$post['hdn_id']);
	
	
	if($res==1)
	{
		
			$res=$callConfig->deleteRecord(TPREFIX.TBL_PRODUCTS_SIZE,'pid',$post['hdn_id']);
			
			
		for($i=0;$i<count($_POST['sid']);$i++)
		{
			
			if($_POST['sid'][$i]!='' || $_POST['rs'][$i])
			{
			
			 $fieldnames=array('x_dim2'=>$_POST['sid'][$i],'n_listprice'=>$_POST['rs'][$i],'n_netprice'=>$_POST['rs'][$i],'c_lotid'=>mysql_real_escape_string($post['lot']),'pid'=>$post['hdn_id']);
		        $res2=$callConfig->insertRecord(TPREFIX.TBL_PRODUCTS_SIZE,$fieldnames);
				
			}
		}
		
		
		sitesettingsClass::recentActivities('Store >> Product updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&err=Store Product updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Product updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&ferr=Store  Product updation failed");
	}
	}*/
	
	
	
	
	
	
	function insertProducts($post)
	{
		global $callConfig;
		
		/*if($post['nosize']=="")
		{
			for($i=1;$i<8;$i++)
			{
				$ssss[]=$post['size'.$i];
				
			}
		
			$prodsizes=implode(",",$ssss);
			
			
		
			if($prodsizes==",")
				$prodsizes="";
		}
		else
		{
			
			$prodsizes="";
		}*/
	
		/*$prodimage = $callConfig->freeimageUploadcomncode('prod','image',"../uploads/store/products/","../uploads/store/products/thumbs/",$post['hdn_image'],160,128);
		$prodimage2 = $callConfig->freeimageUploadcomncode('prod','image2',"../uploads/store/products/","../uploads/store/products/thumbs/",$post['hdn_image2'],160,128);
		$prodimage3 = $callConfig->freeimageUploadcomncode('prod','image3',"../uploads/store/products/","../uploads/store/products/thumbs/",$post['hdn_image3'],160,128);
		$prodimage4 = $callConfig->freeimageUploadcomncode('prod','image4',"../uploads/store/products/","../uploads/store/products/thumbs/",$post['hdn_image4'],160,128);*/
		
    $path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage =$callConfig->freeimageUploadcomncode("cat",'image',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage,$path,$path,$hdn_file_name,'200',$height);
   $image=$prodimage;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$hdn_file_name,$width,$height);
  }
  
  /*image1*/
  
   $path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image1"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage1 =$callConfig->freeimageUploadcomncode("cat",'image1',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage1,$path,$path,$hdn_file_name,'200',$height);
   $image1=$prodimage1;
  }
  else
  {
   $image1 =$callConfig->freealbumImagesUpload("cat",'image1',$path,$path."/thumbs/",$hdn_file_name,$width,$height);
  }


/*image2*/
  
   $path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image2"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage2 =$callConfig->freeimageUploadcomncode("cat",'image2',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage2,$path,$path,$hdn_file_name,'200',$height);
   $image2=$prodimage2;
  }
  else
  {
   $image2 =$callConfig->freealbumImagesUpload("cat",'image2',$path,$path."/thumbs/",$hdn_file_name,$width,$height);
  }



/*image3*/
  
   $path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image3"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage3 =$callConfig->freeimageUploadcomncode("cat",'image3',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage3,$path,$path,$hdn_file_name,'200',$height);
   $image3=$prodimage3;
  }
  else
  {
   $image3 =$callConfig->freealbumImagesUpload("cat",'image3',$path,$path."/thumbs/",$hdn_file_name,$width,$height);
  }





		
		//if($post['offer']=="no"){
//			$oldprice="";
//			$newprice=$post['newprice'];
//		} 
//		else {
//			$oldprice=$post['oldprice'];
//			$newprice=$post['newprice'];
//		}
	$titleslug=$callConfig->remove_special_symbols2($post['title_slug']);
	$lang= $_POST['colorstab'];
    $colors = implode(",",$lang);
	
	 $nag=$_POST['sscid']; 
	$nga=explode(',',$nag);
	
	$nag1=$nga[0];
	$nag2=$nga[1];
	//$sizes= $_POST['size'];
    //$sizepro= implode(",",$sizes);
	/*'disp_order'=>$post['display_order'],*/
	$fieldnames=array('scid'=>$post['scid'],'sscid'=>$nag1,'prodtitle'=>mysql_real_escape_string($nag2),'packetcount'=>mysql_real_escape_string($post['packetcount']),'prodsizes'=>$sizepro,'prodsizes'=>$_POST['prodsizes'],'prodtitle_slug'=>$titleslug,'bigtext'=>mysql_real_escape_string($post['content']),'image'=>$image,'image1'=>$image1,'image2'=>$image2,'image3'=>$image3,'color'=>$post['color'],'colorstab'=>$colors, 'featuredlisting'=>$_POST['featured'],'finish'=>$_POST['finish'],'real_price'=>$_POST['real_price'],'rank'=>$_POST['rank'],'title_slug'=>$titleslug,'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'lotnumber'=>mysql_real_escape_string($post['lot']),


'fabric'=>mysql_real_escape_string($post['fab']),

'blend'=>mysql_real_escape_string($post['ble']),

'care'=>mysql_real_escape_string($post['car']),

'protection'=>mysql_real_escape_string($post['pro']),
//'finish'=>mysql_real_escape_string($post['fin']),

'silhouette'=>mysql_real_escape_string($post['silh']),
'closure'=>mysql_real_escape_string($post['clos']),
'collar'=>mysql_real_escape_string($post['coll']),
'length'=>mysql_real_escape_string($post['leng']),
'cuff'=>mysql_real_escape_string($post['cuf']),
'pocket'=>mysql_real_escape_string($post['poc']),
'waistband'=>mysql_real_escape_string($post['wai']),'status'=>$post['status']);

	$res=$callConfig->insertRecord(TPREFIX.TBL_BULKSTORE_PRODUCTS,$fieldnames);
	//print_r($fieldnames); exit;
	//print_r($res);exit;
	if($res!="")
	//
	
	{
		
		// sizes
		//$size;
		//$rr;
		for($i=0;$i<count($_POST['sid']);$i++)
		{
			//print_r($_POST['sid']);
			if($_POST['sid'][$i]!='' || $_POST['rs'][$i])
			{
				//insert
				$fieldnames=array('size'=>$_POST['sid'][$i],'real_price'=>$_POST['rs'][$i],'spid'=>$res,'pid'=>$_POST['sscid']);
				//print_r($fieldnames); exit;
		        $res2=$callConfig->insertRecord(TPREFIX.TBL_BULKSTORE_VALUE,$fieldnames);
				
			}
		}
		/*echo $size;
		echo $rr;exit;*/
		
		//$fieldnames=array('size'=>$size,'price'=>$rr,'pid'=>$res);
		//$res2=$callConfig->insertRecord(TPREFIX.TBL_PRODUCTS_SIZE,$fieldnames);
		//print_r($fieldnames);exit;
		sitesettingsClass::recentActivities('Store >> Product created successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&err=Store Product created successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Product creation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&ferr=Store  Product creation failed");
	}
	}
	
	function updateProducts($post)
	{
	global $callConfig;
	//print_r($_POST);exit;
	if($post['nosize']=="")
	{
		
	for($i=1;$i<8;$i++){
	$ssss[]=$post['size'.$i];
	$ssss2[]=$post['sizestock'.$i];
	}
	
	 $prodsizes=implode("~",$ssss);
	 $stocksizes=implode("~",$ssss2);
		
	if($stocksizes=="~")
	$stocksizes="";
	
	if($prodsizes=="~")
	$prodsizes="";
	
	}
	else
	{
	$stocksizes=$post['nosize'];
			$prodsizes="";
	}
	
	
	/*$prodimage = $callConfig->freeimageUploadcomncode('prod','image',"../uploads/store/products/","../uploads/store/products/thumbs/",$post['hdn_image'],160,128);
	$prodimage2 = $callConfig->freeimageUploadcomncode('prod','image2',"../uploads/store/products/","../uploads/store/products/thumbs/",$post['hdn_image2'],160,128);
	$prodimage3 = $callConfig->freeimageUploadcomncode('prod','image3',"../uploads/store/products/","../uploads/store/products/thumbs/",$post['hdn_image3'],160,128);
	$prodimage4 = $callConfig->freeimageUploadcomncode('prod','image4',"../uploads/store/products/","../uploads/store/products/thumbs/",$post['hdn_image4'],160,128);*/
	
	$path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage =$callConfig->freeimageUploadcomncode("cat",'image',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage,$path,$path,$hdn_file_name,'200',$height);
   $image=$prodimage;
  }
  else
  {
   $image =$callConfig->freealbumImagesUpload("cat",'image',$path,$path."/thumbs/",$post['hdn_image'],$hdn_file_name,$width,$height);
  }
  
  $path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image1"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage1 =$callConfig->freeimageUploadcomncode("cat",'image1',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage1,$path,$path,$hdn_file_name,'200',$height);
   $image1=$prodimage1;
  }
  else
  {
   $image1 =$callConfig->freealbumImagesUpload("cat",'image1',$path,$path."/thumbs/",$post['hdn_image1'],$hdn_file_name,$width,$height);
  }
	
	
	$path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image2"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage2 =$callConfig->freeimageUploadcomncode("cat",'image2',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage2,$path,$path,$hdn_file_name,'200',$height);
   $image2=$prodimage2;
  }
  else
  {
   $image2 =$callConfig->freealbumImagesUpload("cat",'image2',$path,$path."/thumbs/",$post['hdn_image2'],$hdn_file_name,$width,$height);
  }
	
	
	$path="../uploads/store/products/";
    list($width, $height, $type, $attr) = getimagesize($_FILES["image3"]['tmp_name']);
   
   if($width>300)
   {
   $prodimage3 =$callConfig->freeimageUploadcomncode("cat",'image3',$path,$path."thumbs/",$hdn_file_name,$width,$height);
   $callConfig->freealbumImagesUpload2('cat',$prodimage3,$path,$path,$hdn_file_name,'200',$height);
   $image3=$prodimage3;
  }
  else
  {
   $image3 =$callConfig->freealbumImagesUpload("cat",'image3',$path,$path."/thumbs/",$post['hdn_image3'],$hdn_file_name,$width,$height);
  }
	
		
	
	
	if($post['offer']=="no"){
	$oldprice="";
	$newprice=$post['newprice'];
	} else {
	$oldprice=$post['oldprice'];
	$newprice=$post['newprice'];
	}
	$titleslug=$callConfig->remove_special_symbols2($post['title_slug']);
	$lang= $_POST['colorstab'];
    $colors = implode(",",$lang);
	
	
	/*'disp_order'=>$post['display_order'],*/
		///print_r($_POST); exit;

	$fieldnames=array('scid'=>$post['scid'],'sscid'=>$_POST['sscid'],'bid'=>$post['bid'],'prodtitle'=>mysql_real_escape_string($post['prodtitle']),'prodtitle_slug'=>$titleslug,'bigtext'=>mysql_real_escape_string($post['content']),'image'=>$image,'color'=>$post['color'],'colorstab'=>$colors,'real_price'=>$post['real_price'],'nicotinecontent'=>$_POST['nicotinecontent'],'finish'=>$post['finish'],'rank'=>$_POST['rank'], 'featuredlisting'=>$_POST['featured'], 'prodsizes'=>$_POST['prodsizes'],'title_slug'=>$titleslug,'meta_keyword'=>mysql_real_escape_string($post['meta_keyword']),'meta_desc'=>mysql_real_escape_string($post['meta_desc']),'lotnumber'=>mysql_real_escape_string($post['lot']),

'fabric'=>mysql_real_escape_string($post['fab']),

'blend'=>mysql_real_escape_string($post['ble']),

'care'=>mysql_real_escape_string($post['car']),

'protection'=>mysql_real_escape_string($post['pro']),
//'finish'=>mysql_real_escape_string($post['fin']),

'silhouette'=>mysql_real_escape_string($post['silh']),
'closure'=>mysql_real_escape_string($post['clos']),
'collar'=>mysql_real_escape_string($post['coll']),
'length'=>mysql_real_escape_string($post['leng']),
'cuff'=>mysql_real_escape_string($post['cuf']),
'pocket'=>mysql_real_escape_string($post['poc']),
'waistband'=>mysql_real_escape_string($post['wai']),'status'=>$post['status']);
	$res=$callConfig->updateRecord(TPREFIX.TBL_BULKSTORE_PRODUCTS,$fieldnames,'spid',$post['hdn_id']);
	
	
	if($res!='')
	{
		
			/*$res=$callConfig->deleteRecord(TPREFIX.TBL_PRODUCTS_SIZE,'pid',$post['hdn_id']);*/
			 $sid_keys = array_keys($_POST['sid']);
			print_r($sid_keys);
			//exit;
		print "<pre>";
		for($i=0;$i<count($_POST['sid']);$i++)
		{
			//print_r($_POST['sid']);
			if($_POST['sid'][$i]!='' || $_POST['rs'][$i]!='')
			{
				//insert
				//$fieldnames=array('x_dim2'=>$_POST['sid'][$sid_keys[$i]],'n_listprice'=>$_POST['rs'][$i],'c_lotid'=>mysql_real_escape_string($post['lot']),'pid'=>$post['hdn_id']);
				//$fieldnames=array('size'=>$_POST['sid'][$sid_keys[$i]],'real_price'=>$_POST['rs'][$i],'spid'=>$post['hdn_id']);
				//print $sid_keys[$i];
		        //print_r($fieldnames); 
                 
  				//$res2=$callConfig->updateRecord(TPREFIX.TBL_BULKSTORE_VALUE,$fieldnames,'spid='.$post['hdn_id'].' & id='.$sid_keys[$i],'');
				//print_r($res2);
 $query="update tb_bulkstore_value SET size='".$_POST['sid'][$sid_keys[$i]]."',real_price='".$_POST['rs'][$i]."',spid='".$post['hdn_id']."',pid='".$post['sscid']."' WHERE spid='".$post['hdn_id']."' and id='".$sid_keys[$i]."'";
mysql_query($query); 

			}
			
		}//die;
		//exit;
		
		sitesettingsClass::recentActivities('Store >> Product updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&err=Store Product updated successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Product updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&ferr=Store  Product updation failed");
	}
	}
	
	
	
	
	function productsDelete($id)
	{
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_BULKSTORE_PRODUCTS,'image,image2,image3','spid='.$id,'','','');
	$imageres = $callConfig->getRow($query);
	$callConfig->imageCommonUnlink("../uploads/store/products/","../uploads/store/products/thumbs/",$imageres->image);
	$callConfig->imageCommonUnlink("../uploads/store/products/","../uploads/store/products/thumbs/",$imageres->image2);
	$callConfig->imageCommonUnlink("../uploads/store/products/","../uploads/store/products/thumbs/",$imageres->image3);
	$res=$callConfig->deleteRecord(TPREFIX.TBL_BULKSTORE_PRODUCTS,'spid',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Store >> Product deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&err=Store  Product deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Product deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_bulkproducts&ferr=Store Product deletion failed");
	}
	}
	
	
	
	
	function getAllOrdersList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery('tb_orders','*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllOrdersListCount()
  {
	global $callConfig;
	$query=$callConfig->selectQuery('tb_orders','oid','','','','');
	 return $callConfig->getCount($query);
  } 
  
  function getAllOrdersList1($sortfield,$order,$start,$limit,$search)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	if($search!='')
	{
		$where="ord_status='".$search."'";
	}
	$query=$callConfig->selectQuery('tb_orders','*',$where,$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllOrdersListCount1($search)
  {
	global $callConfig;
	if($search!='')
	{
		$where="ord_status='".$search."'";
	}
	$query=$callConfig->selectQuery('tb_orders','oid',$where,'','','');
	 return $callConfig->getCount($query);
  } 
  
  function OrderStatusChanging($get){
	global $callConfig;
	if($get['st']=="Pending")
	$statusbe='Delivered';
	$fieldnames=array('status'=>$statusbe);
	$res=$callConfig->updateRecord(TPREFIX.TBL_CART_TRANSACTION,$fieldnames,'tx_id',$get['id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Order Status changed successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_orderlist&err=Order Status changed successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Order Status changing failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_orderlist&ferr=Order Status changing failed");
	}
	}
	
	function OrderDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.'orders','oid',$id);
	if($res==1)
	{
	    $callConfig->deleteRecord('tb_orderdetails','order_id',$id);
		 $callConfig->deleteRecord('tb_orderpackagelist','o_id',$id);
		sitesettingsClass::recentActivities('Order deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_orderlist&err=Order deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Order deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_orderlist&ferr=Order deletion failed");
	}
	}
	
	 // store coupons //
	 
	 
  function getAllStoreCouponList($sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order=$sortfield.' '.$order;
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'*','',$order,$start,$limit);
	return $callConfig->getAllRows($query);
  } 
  function getAllStoreCouponListCount($where)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'id','','','','');
	return $callConfig->getCount($query);
  } 
  function getStoreCouponData($id)
  {
	global $callConfig;
	$query=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'*','id='.$id,'','','');
	return $callConfig->getRow($query);
 }
 	
	function insertStoreCoupon($post)
	{
	global $callConfig;
	$querysel=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'couponcode'," couponcode='".$post['couponcode']."' ",'','','');
	$cnt=$callConfig->getCount($querysel);
	if($cnt<=0)
	{
		//print_r($post['expiredon']);
		
		$dateArray=explode('-',$post['expiredon']);
		$dt = $dateArray[2].'-'.$dateArray[0].'-'.$dateArray[1];
		
		$fieldnames=array('couponcode'=>$post['couponcode'],'distype'=>$post['distype'],'discount'=>$post['discount'],'expiredon'=>$dt);
		$res=$callConfig->insertRecord(TPREFIX.TBL_STORECOUPONS,$fieldnames);
		if($res!="")
		{
			sitesettingsClass::recentActivities('Store >> Coupon created successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_storecoupons&err=Store Coupon created successfully");
			exit;
		}
		else
		{
			sitesettingsClass::recentActivities('Store >> Coupon creation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_storecoupons&ferr=Store Coupon creation failed");
			exit;
		}
	} 
	else 
	{
	        sitesettingsClass::recentActivities('Store >> Coupon already exist in database >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_storecoupons&ferr=Store Coupon already exist in database");
	}
	}
	
	function updateStoreCoupon($post)
	{
	global $callConfig;
	$querysel=$callConfig->selectQuery(TPREFIX.TBL_STORECOUPONS,'couponcode'," couponcode='".$post['couponcode']."' and id!='".$post['hdn_id']."' ",'','','');
	$cnt=$callConfig->getCount($querysel);
	if($cnt<=0)
	{
	    $dateArray=explode('-',$post['expiredon']);
		$dt = $dateArray[2].'-'.$dateArray[0].'-'.$dateArray[1];
		
		$fieldnames=array('couponcode'=>$post['couponcode'],'distype'=>$post['distype'],'discount'=>$post['discount'],'expiredon'=>$dt);
	    $res=$callConfig->updateRecord(TPREFIX.TBL_STORECOUPONS,$fieldnames,'id',$post['hdn_id']);
		if($res==1)
		{
			sitesettingsClass::recentActivities('Store >> Coupon updated successfully on >> '.DATE_TIME_FORMAT.'','g');
			$callConfig->headerRedirect("index.php?option=com_storecoupons&err=Store Coupon updated successfully");
		}
		else
		{
			sitesettingsClass::recentActivities('Store >> Coupon updation failed on >> '.DATE_TIME_FORMAT.'','e');
			$callConfig->headerRedirect("index.php?option=com_storecoupons&ferr=Store Coupon updation failed");
		}
	} 
	else 
	{
	    sitesettingsClass::recentActivities('Store >> Coupon already exist in database >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_storecoupons&ferr=Store Coupon already exist in database");
	}
	}
	
	
	
	function storeCouponDelete($id)
	{
	global $callConfig;
	$res=$callConfig->deleteRecord(TPREFIX.TBL_STORECOUPONS,'id',$id);
	if($res==1)
	{
		sitesettingsClass::recentActivities('Store >> Coupon deleted successfully on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_storecoupons&err=Store Coupon deleted successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('Store >> Coupon deletion failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_storecoupons&ferr=Store Coupon deletion failed");
	}
	}
	
	
	 
	
	 function getOrder_Comments($txid)
  {
	global $callConfig;
	 $query=$callConfig->selectQuery(TPREFIX.TBL_CART_TRANSACTION,'*','tx_id='.$txid,'','','');
	return $callConfig->getRow($query);
  }
	
	
   function updateOrderComment($field,$post)
	{
	global $callConfig;
	if($field=="remarks")
	$fieldnames=array('order_comments'=>mysql_real_escape_string($post['ge_remarks']));
    $res=$callConfig->updateRecord(TPREFIX.TBL_CART_TRANSACTION,$fieldnames,'tx_id',$post['hdn_popupenquiry_id']);
	if($res==1)
	{
		//sitesettingsClass::recentActivities('Store >> Color updated successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=".$post['redirectpath']."&id=".$post['hdn_tranx_no']."&err=Comment updated successfully");
	}
	else
	{
		//sitesettingsClass::recentActivities('Store >> Color updation failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=".$post['redirectpath']."&id=".$post['hdn_tranx_no']."&ferr=Comment updation failed");
	}
	}	
	
	
// end store coupons //
	
  
   function searchkeyComments($key,$coupcode,$sortfield,$order,$start,$limit)
  {
	global $callConfig;
	if($sortfield!="" && $order!="") $order='a.'.$sortfield.' '.$order;
	if($key=='view')
	$whr=" order_comments!='' ";
	if($key=='post')
	$whr=" order_comments='' ";
	if($key=='del')
	$whr=" status='Delivered' ";
	if($key=='inpro')
	$whr=" status='In Process' ";
	if($key=='notdel')
	$whr=" status='Not Delivered' ";
	if($key=='fol')
	$whr=" followup='Yes' ";
	if($key=='unfol')
	$whr=" followup='No' ";
	if($coupcode!='')
	$whr=" couponcode='".$coupcode."'";
	$query=$callConfig->selectQuery(TPREFIX.TBL_CART_TRANSACTION,'*',$whr,'','','');
	return $callConfig->getAllRows($query);
  }
  
  
  function forntuserFollowStatusChanging($get){
	global $callConfig;
	if($get['fu']=="Yes")
	$statusbe='No';
	else
	$statusbe='Yes';
	$fieldnames=array('followup'=>$statusbe);
	$res=$callConfig->updateRecord(TPREFIX.TBL_CART_TRANSACTION,$fieldnames,'tx_id',$get['id']);
	if($res==1)
	{
		sitesettingsClass::recentActivities('User >> Status changed successfully on >> '.DATE_TIME_FORMAT.'','g');
		$callConfig->headerRedirect("index.php?option=com_orderlist&err=User  Status changed successfully");
	}
	else
	{
		sitesettingsClass::recentActivities('User >> Status changing failed on >> '.DATE_TIME_FORMAT.'','e');
		$callConfig->headerRedirect("index.php?option=com_orderlist&ferr=User  Status changing failed");
	}
	}
  
  
  // end store //
  
/* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ changed Functions Erubabu @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ */
  
  /* @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ Copy of the Functions @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ 
  function SendStatusMail($uid,$txid)
  {
	global $callConfig;
		$sitedata=sitesettingsClass::getsitesettings();
		$query="select a.email,ai.b_firstname,ai.b_lastname from ".TPREFIX.TBL_ADMIN." a,".TPREFIX.TBL_ADMINSINFO." ai where ai.userid=a.user_id and a.user_id='".$uid."'";
		$resval=$callConfig->getRow($query);
		$query="select tx_no,posted_date,status from ".TPREFIX.TBL_CART_TRANSACTION." where tx_id='".$txid."'";
		$restr=$callConfig->getRow($query);
		
		
	$to=$resval->email;
	$username=$resval->b_firstname.' '.$resval->b_lastname;
	$tx_no=$restr->tx_no;
	$status=$restr->status;
	$posted_date=$restr->posted_date;
	$posted_date=date("m/d/Y", strtotime($restr->posted_date));
	$subject="StrongerRX >> Your Order Status Details";
	$message="<table cellspacing='0' cellpadding='5'  align='center' width='100%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
	<tr>
	<td align='left' valign='top'><a href='".SITEURL."'><img src='".SITEURL."/images/inner-logo_04.gif' border='0' width='120' height='80' ></a></td>
	</tr>
	<tr>
	<td align='left' valign='top'>Dear<strong> ".$username.",</strong></td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Your Order Status Details:</strong></td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Order date:</strong> ".$posted_date." (MM/DD/YYYY) </td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Transaction ID:</strong> ".$tx_no." </td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Status :</strong> ".$status." </td>
	</tr>
	<tr>
	<td valign='top' align='left'>Thank You,<br />
	Support Team, StrongerRX</td>
	</tr>
	<tr>
		<td valign='top' colspan='2' align='left'>".$sitedata->email_sign."</td>
		</tr>
	</table>";
	//echo $message; exit;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$sitedata->mail_fromname.' <'.$sitedata->mail_frommail.'>' . "\r\n";
	mail($to, $subject, $message, $headers);
  }
  */
  
  function SendStatusMail($uid,$txid)
  {
	global $callConfig;
	$sitedata=sitesettingsClass::getsitesettings();
		 $query="select email_address,first_name,s_name from ".TPREFIX.TBL_USERS_INFO." where user_id='".$uid."'"; 
 $resval=$callConfig->getRow($query);
	  $query="select * from ".TPREFIX.TBL_ORDERS." where oid='".$txid."'";
	$restr=$callConfig->getRow($query);
		
		
	$to=$resval->email_address;
	$username=$resval->first_name.' '.$resval->s_name;
	$tx_no=$restr->txn_id;
	$status=$restr->ord_status;
	$posted_date=$restr->ordered_date;
	 $posted_date=date("M d,Y", strtotime($restr->ordered_date));
	$subject="Firesafety>> Your Order Status Details";
	$message="<table cellspacing='0' cellpadding='5'  align='center' width='100%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
	<tr>
	<td align='left' valign='top'><a href='".SITEURL."'><img src='".SITEURL."/images/firesafety_11.png' border='0' width='120' height='80' ></a></td>
	</tr>
	<tr>
	<td align='left' valign='top'>Dear<strong> ".$username.",</strong></td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Your Order Status Details:</strong></td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Order date:</strong> ".$posted_date." (MM/DD/YYYY) </td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Transaction ID:</strong> ".$tx_no." </td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Status :</strong> ".$status." </td>
	</tr>
	<tr>
	<td valign='top' align='left'>Thank You,<br />
	Support Team, Firesafety</td>
	</tr>
	<tr>
		<td valign='top' colspan='2' align='left'>".$sitedata->email_sign."</td>
		</tr>
	</table>";
	echo $message; exit;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$sitedata->mail_fromname.' <'.$sitedata->mail_frommail.'>' . "\r\n";
	mail($to, $subject, $message, $headers);
	header('Location:index.php?option=com_orderlist&err=Send mail successfully');
  }
  
  
  function Update_TrackingNumber($post)
  {
  global $callConfig;
  
   $array=explode("-",$post['upadte_transx_id']);
   $transx_id=$array[0];
   $uid=$array[1];
  
  
  	$fieldnames=array('shipping_no'=>$post['trns_shipment_number'],'tracking_messg'=>$post['trns_messg'],'status'=>$post['tracking_status']);
	//print_r($fieldnames);
	$res=$callConfig->updateRecord(TPREFIX.TBL_CART_TRANSACTION,$fieldnames,'tx_id',$transx_id);
	
	$sitedata=sitesettingsClass::getsitesettings();
	$query="select a.email,ai.b_firstname,ai.b_lastname from ".TPREFIX.TBL_ADMIN." a,".TPREFIX.TBL_ADMINSINFO." ai where ai.userid=a.user_id and a.user_id='".$uid."'";
	$resval=$callConfig->getRow($query);
	$query="select tx_no,posted_date,status,shipping_no,tracking_messg  from ".TPREFIX.TBL_CART_TRANSACTION." where tx_id='".$transx_id."'";  
	$restr=$callConfig->getRow($query);
		
		
	$to=$resval->email;
	$username=$resval->b_firstname.' '.$resval->b_lastname;
	$tx_no=$restr->tx_no;
	$shipping_no=$restr->shipping_no ;
	$status=$restr->status;
	$posted_date=$restr->posted_date;
	$details_message=$restr->tracking_messg;
	$posted_date=date("m/d/Y", strtotime($restr->posted_date));
	$subject="Firesafety >> Your Order Status Details";
	
	if ($shipping_no==NULL || $shipping_no=='')
	{
	$message="<table cellspacing='0' cellpadding='5'  align='center' width='70%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
<thead>
<tr><td>
<strong>Order Status Changed</strong>
</td></tr>
</thead>
	<tr>
	<td align='left' valign='top'><a href='".SITEURL."'><img src='".SITEURL."/images/firesafety_11.png' border='0' width='120' height='80' ></a></td>
	</tr>
	<tr>
	<td align='left' valign='top'>Dear<strong> ".$username.",</strong></td>
	</tr>
	<tr><td>An order you recently placed on our website has had its status changed.</td></tr>
	<tr>
	<tr><td>The status of order is now <strong>".$status."</strong> </td></tr>
	<td valign='top' align='left'><strong>Your Order Status Details:</strong></td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Order date:</strong> ".$posted_date." (MM/DD/YYYY) </td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Transaction ID:</strong> ".$tx_no." </td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Status :</strong> ".$status."</td>
	</tr>
	
	<td valign='top' align='left'>Thank You,<br />
	Support Team, Firesafety</td>
	</tr>
	<tr>
		<td valign='top' colspan='2' align='left'>".$sitedata->email_sign."</td>
		</tr>
	</table>";
	}
	else {
	
	$message="<table cellspacing='0' cellpadding='5'  align='center' width='70%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
<thead>
<tr><td>
<strong>Order Status Changed</strong>
</td></tr>
</thead>
	<tr>
	<td align='left' valign='top'><a href='".SITEURL."'><img src='".SITEURL."/images/firesafety_11.png' border='0' width='120' height='80' ></a></td>
	</tr>
	<tr>
	<td align='left' valign='top'>Dear<strong> ".$username.",</strong></td>
	</tr>
	<tr><td>An order you recently placed on our website has had its status changed.</td></tr>
	<tr>
	<tr><td>The status of order is now <strong>".$status."</strong> </td></tr>
	<td valign='top' align='left'><strong>Your Order Status Details:</strong></td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Order date:</strong> ".$posted_date." (MM/DD/YYYY) </td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Transaction ID:</strong> ".$tx_no." </td>
	</tr>
	<tr>
	<td valign='top' align='left'><strong>Status :</strong> ".$status." </td>
	</tr>
	<tr><td><strong>Shipment Tracking Numbers:</strong> ".$shipping_no."</td></tr>
	<tr><td><strong>Details:</strong> ".$details_message."</td></tr>
	<tr>
	<td valign='top' align='left'>Thank You,<br />
	Support Team, Firesafety</td>
	</tr>
	<tr>
		<td valign='top' colspan='2' align='left'>".$sitedata->email_sign."</td>
		</tr>
	</table>";
	
	
	
	
	}
	
	
	
	
	//echo $message; exit;
    $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$sitedata->mail_fromname.' <'.$sitedata->mail_frommail.'>' . "\r\n";
	mail($to, $subject, $message, $headers);
	
	
  
  }
  
  
  
  
}	
	?>