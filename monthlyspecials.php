<?php include("includes/header.php");
  $query="select * from tb_store_category where scid=".$_GET['id'];
$category= $callConfig->getRow($query);
  $products="select * from tb_store_products where bulkpacketcount!='0' and status =  'Active' order by spid DESC";
 $productslist= $callConfig->getAllRows($products);
 //print_r($productslist);
 
 //print_r($productslist->sscid);exit;
 
 
     			   //$pid=$productslist->sscid;
			   
			  //echo   $query1="select * from tb_store_products where spid='".$pid."'";	exit;		  
 
 
 
$productslistnew= $callConfig->getcount($products);
//print_r($productslist);

      //$pid=$productslist->sscid;

                 


if($_POST['submit']=='Add to Cart')
{ 
//print_r($_POST);exit;
$cartobj->inserttempcart($_POST);
}

?>
<link href="<?=SITEURL?>/pagination.css" rel="stylesheet" type="text/css" /> 


  <!-- <link href="<?=SITEURL?>/paginationstyle.css" rel="stylesheet" type="text/css" /> -->
   
   
  <!-- <?php 
/*-------------------------------------------------------------------------------------------*/
//
//$adjacents = 1;
//$limit =18; 
//if(isset($_GET['id']))
//{
// $total_pages=$frontpageObj->getAllNewsListmostcount($_GET['id']);	
//$targetpage = "news.php?id='".$_GET['id']."'"; 
//}
//else
//{
//$total_pages=$bannerObj->getAllfaqListCount();
//print_r($total_pages);
// $targetpage = productpage.php; 
//
// $targetpage = SITEURL/seoClass::furl('productpage.php?id='.$_GET['id']); 
// 
//
//								how many items to show per page
//	 $page = $_GET['page'];
//	if($page) 
//		$start = ($page - 1) * $limit; 			//first item to display on this page
//	else
//	$start = 0;		
//if(isset($_GET['id']))
//{
//
//$news=$frontpageObj->getAllNewsListmost($_GET['id'],$sortfield,$orderby,$start,$limit);	
////print_r($news);
//}
//else
//{
// $services11=$bannerObj->getAllfaq($_GET['id'],$orderby,$start,$limit);
// 
//print_r($services11);
//
//print_r($allprope);exit;
//
//if ($page == 0) $page = 1;	 				//if no page var is given, default to 1.
//	$prev = $page - 1;							//previous page is page - 1
//	$next = $page + 1;							//next page is page + 1
//	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
//	$lpm1 = $lastpage - 1;						//last page minus 1
//	
//	 
//		Now we apply our rules and draw the pagination object. 
//		We're actually saving the code to a variable in case we want to draw it more than once.
//	
//	$pagination = "";
//	if($lastpage > 1)
//	{	
//		$pagination .= "<div class=\"pagination\">";
//		previous button
//		if ($page > 1) 
//			$pagination.= "<a href=\"$targetpage?page=$prev\">previous</a>";
//		else
//			$pagination.= "<span class=\"disabled\">previous</span>";	
//		
//		pages	
//		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
//		{	
//			for ($counter = 1; $counter <= $lastpage; $counter++)
//			{
//				if ($counter == $page)
//					$pagination.= "<span class=\"current\">$counter</span>";
//				else
//					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
//			}
//		}
//		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
//		{
//			close to beginning; only hide later pages
//			if($page < 1 + ($adjacents * 2))		
//			{
//				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
//				{
//					if ($counter == $page)
//						$pagination.= "<span class=\"current\">$counter</span>";
//					else
//						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
//				}
//				$pagination.= "...";
//				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
//				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
//			}
//			in middle; hide some front and some back
//			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
//			{
//				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
//				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
//				$pagination.= "...";
//				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
//				{
//					if ($counter == $page)
//						$pagination.= "<span class=\"current\">$counter</span>";
//					else
//						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
//				}
//				$pagination.= "...";
//				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
//				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
//			}
//			close to end; only hide early pages
//			else
//			{
//				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
//				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
//				$pagination.= "...";
//				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
//				{
//					if ($counter == $page)
//						$pagination.= "<span class=\"current\">$counter</span>";
//					else
//						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
//				}
//			}
//		}
//		
//		next button
//		if($page < $counter - 1) 
//			$pagination.= "<a href=\"$targetpage?page=$next\">next</a>";
//		else
//			$pagination.= "<span class=\"disabled\">next</span>";
//		$pagination.= "</div>\n";		
//	}		
//--------------funtion---------------------------
// function shorten_string($string, $wordsreturned)
//  Returns the first $wordsreturned out of $string.  If string
//contains fewer words than $wordsreturned, the entire string
//is returned.
//
//{
//$retval = $string;      //  Just in case of a problem
// 
//$array = explode(" ", $string);
//if (count($array)<=$wordsreturned)
//  Already short enough, return the whole thing
//
//{
//$retval = $string;
//
//}
//else
//  Need to chop of some words
//
//{
//array_splice($array, $wordsreturned);
//$retval = implode(" ", $array);
//}
//return $retval;
//}
$start=0;
        if($_GET['start']!="")$start=$_GET['start'];
        $limit=15;
?>

-->

<style>
.feturedprolis li {
float: left;
width: 31%;
padding: 5px 0px;
margin: 0px 0.7%;
}
</style>
     <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="<?=SITEURL?>/images/aboutarow_03.png" alt=""></li>
                 <!--<li><a href="productpage.php?id=<?php echo $_GET['id']?>"><?php echo $category->catetitle;?></a></li>-->
                 
                 <li>Monthly Specials</li>
                 
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div>
     <!--End bedgromms part-->
   <link href="<?=SITEURL?>/pagination.css" rel="stylesheet" type="text/css" /> 

    <!--innerpagepart-->
       <div class="full_wrapper innerpart">
         <div class="site_container">
            <h2 style="size:21px;">Monthly Specials</h2>
            
            <div class="concomimg">
            
            <h3 style="color:green" id="sarat2"></h3>
     
              <ul class="feturedprolis">
              
              
              
              <?php
			  
			  /*	$start=0;
        if($_GET['start']!="")$start=$_GET['start'];
        $limit=10;*/	


 //echo $products="select * from tb_store_products where scid=".$_GET['id']." and status =  'Active' order by spid DESC  limit ".$start.",".$limit."";
              //$productslist= $callConfig->getAllRows($products);
      
	  			    //$total=$productslistnew;
			  
			   if(count($productslistnew)>0){
				  foreach($productslist as $prolist){
					  
					   $queryvalue="select MIN(real_price) as real_price,id,size from tb_store_value  where spid=".$prolist->spid; 
					  $minimumvalues= $callConfig->getRow($queryvalue);
                       //print_r($minimumvalues);
				  ?>
              
             <li> 
            <!--  <a href="product_discription.php?spid=<?php echo $prolist->spid?>">-->
               
               <a href="<?=SITEURL?>/bulkproduct_discription.php?spid=<?=$prolist->spid?>">
               
               
             
               <?php if(($prolist->image)!=''){?>
               <img src="<?=SITEURL?>/uploads/store/products/<?php echo $prolist->image;?>" style="width:300px;height:280px;" alt="" class="res_images" >
               
               <?php }else {?>
                 <img src="<?=SITEURL?>/images/sitelogo_04.png" alt="" class="res_images">
               <?php }?>
               
               </a>
               
              
                   
			   
               <h5><?php echo 
			   substr($prolist->prodtitle,0,40).'....';?></h5>
               
           
               
               <div class="matocl">
               <form method="post">
                
              <?php if($prolist->scid=='1'){ 
			  
			  //print_r($prolist->scid);
			  ?>
               
                <span style="float:left;">
              
               <a href="<?=SITEURL?>/<?=seoClass::fURL('bulkproduct_discription.php?spid='.$prolist->spid)?>"> 
                
                <img  src="<?=SITEURL?>/images/cartround_55.png"></a>
               </span>
               
              
               <?php } else{ 
			   
			   //print_r($prolist->scid);
			   ?>
               
               
            
               
                <span style="float:left;">
<?php /*?>                <input type="hidden" value="Add to Cart" name="submit">
                <input type="image" src="<?=SITEURL?>/images/cartround_55.png" name="submit">
				
				addtocart3('<?php echo $porlist->spid;?>','<?php echo $porlist->image;?>','<?php echo $porlist->prodtitle;?>','<?php echo $porlist->scid; ?>','<?php echo $minimumvalues->size; ?>','<?php echo $minimumvalues->bulk_price; ?>','<?php echo $minimumvalues->bulk_price*1; ?>','<?=$minimumvalues->weight;?>');
				
          <?php */?><a href="#"><img src="<?=SITEURL?>/images/cartround_55.png" onclick="addtocart3('<?php echo $prolist->spid;?>','<?php echo $prolist->image;?>','<?php echo $prolist->prodtitle;?>','<?php echo $prolist->scid; ?>','<?php echo $minimumvalues->size; ?>','<?php echo $minimumvalues->real_price; ?>','<?php echo $minimumvalues->real_price*1; ?>','<?=$minimumvalues->weight;?>');" alt=""></a></span>
				<?php } ?>  
                 <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$<?php echo $minimumvalues->real_price;?></h3></span>
                  <input type="hidden" name="spd" id="spd" value="<?php echo $prolist->spid;?>"/>
                        <input type="hidden" name="pimg" value="<?php echo $prolist->image;?>"/>
                        <input type="hidden" name="probname" value="<?php echo $prolist->prodtitle;?>"/>
                        <input type="hidden" name="catid" value="<?php echo $prolist->scid; ?>"/>
                        <input type="hidden" name="bottle_size" value="<?php echo $minimumvalues->size; ?>"/>  
                         <input type="hidden" name="prod_id" value="<?php echo $prolist->spid; ?>"/>  
                         <input type="hidden" name="bulkpacketcount" value="<?php echo $prolist->bulkpacketcount; ?>"/>  

                                                  <input type="hidden" name="product_type" value="direct"/>  

                        <input type="hidden" name="price2" value="<?php echo $minimumvalues->real_price; ?>"/>  
                        <input type="hidden" name="price" value="<?php echo $minimumvalues->real_price*1; ?>"/>  
                        <input type="hidden" name="bulkpacketcount" value="<?php echo $productslist->bulkpacketcount; ?>"/>  
                        <input type="hidden" name="type" value="monthly"/>  

                        <input type="hidden" name="qun" value="1"/>  
                        
                        <input type="hidden" name="cont_mg" value=""/>  
                        
                   </form>     
                <div class="clear_fix"></div> 
               </div>
             </li>
           
             <?php }}?>
             
                 <script>
				 function addtocart3(spid,pimg,probname,catid,bottle_size,price2,price)
				 {     
				 
				//alert('hii');
				 //alert(type);
				 //spid,pimg,probname,catid,bottle_size,price2,price,weight
				       //alert(probname);  //price price2,qun,weight,product_type1,type
					   //var qun=document.getElementById('qun2').value;
					   //alert(qun);
                       //var product_type1=document.getElementById('product_type2').value;
					   //var cont_mg=document.getElementById('cont_mg2').value;
					   //alert(bottle_size);
					 //  var type=document.getElementById('type').value;

					   //alert(qun);
					   var xmlhttp;
						if (window.XMLHttpRequest)
						  {// code for IE7+, Firefox, Chrome, Opera, Safari
						  xmlhttp=new XMLHttpRequest();
						  }
						else
						  {// code for IE6, IE5
						  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						  }
						xmlhttp.onreadystatechange=function()
						  {
						  if (xmlhttp.readyState==4 && xmlhttp.status==200)
							{
							document.getElementById("sarat2").innerHTML=xmlhttp.responseText;
							}
						  }
						  				       //alert(price2);
						xmlhttp.open("GET","<?=SITEURL?>/ajax_cart.php?spid="+spid+" & pimg="+pimg+" & probname="+probname+" & catid="+catid+" & bottle_size="+bottle_size+" & price="+price+" & price2="+price2,true);
						xmlhttp.send();
					 }
				 </script>
		
     
            </ul>
       
      
      
      
      
      
       <table style="float:right;">
                      <tr><td colspan="10" align="left" style="padding-left:15px;">
						<?php if($productslistnew>$limit)
			{
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['id']!='')
			//$param=$param."&catid=".$_GET['catid'];
			
			$callConfig->paginavigation_FrontEnd($start, $limit, $productslistnew, SITEURL."/productpage.php?id=".$_GET['id'], $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

      </table>  
      
      
              <div class="clear_fix"></div> 
            </div>
            
         </div>
<?php /*?>         <div style="text-align:right;margin-right:140px; border-color: red"> <?=$pagination?></div>
<?php */?>         
       </div>
       
       
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php include("includes/clintblog.php")?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
  
 <?php include("includes/footer.php")?>