<?php
class seoClass
{ 

function fURL($url)
{
	
	global $con;
	$arr=parse_url($url);
	$pagename=$arr['path'];
	parse_str($arr['query'], $arr_query);
	switch($pagename){
		
			
			case 'productpage.php':
				$page_id=isset($arr_query['id'])?$arr_query['id']:1;
				$sql="select * from tb_store_category where scid='".$page_id."'";
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				/*$str="pages/".seoClass::strchangeforurl($row['title_slug']).".html";*/
				   $str ="productpage/".$page_id."/".seoClass::strchangeforurl($row['catetitle']).".html";
				
			break;
			
			
			
			case 'content.php':
				$page_id=isset($arr_query['id'])?$arr_query['id']:1;
				$sql="select * from tb_contentpages where page_id='".$page_id."'";
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				/*$str="pages/".seoClass::strchangeforurl($row['title_slug']).".html";*/
				   $str ="content/".$page_id."/".seoClass::strchangeforurl($row['title']).".html";
				
			break;
			
		  
			
			
			
			
			case 'product_discription.php':
			    
				$page1_id=isset($arr_query['spid'])?$arr_query['spid']:1;
			    $sql="select * from tb_store_products where spid='".$page1_id."'";
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				/*$str="pages/".seoClass::strchangeforurl($row['title_slug']).".html";*/
				  $str ="product_discription/".$page1_id."/".seoClass::strchangeforurl($row['prodtitle']).".html";
				
			break;
			
			
			
		case 'category.php':
			    
				$page1_id=isset($arr_query['id'])?$arr_query['id']:1;
			    $sql="select * from tb_store_category where scid='".$page1_id."'";
				$result=mysql_query($sql);
				$row=mysql_fetch_assoc($result);
				/*$str="pages/".seoClass::strchangeforurl($row['title_slug']).".html";*/
				  $str ="category/".$page1_id."/".seoClass::strchangeforurl($row['catetitle']).".html";
				
			break;
			
			
			
			
			
		    default:
			$str=$url;
			break;
	}
	return($str);
}

function strchangeforurl($str){
		//return($str);
		global $callConfig;
		return $callConfig->remove_special_symbols($str);
}


		
		
	 

}	



?>



