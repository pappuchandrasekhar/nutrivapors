<?php include("includes/header.php");
 $query="select * from tb_store_category where scid=".$_GET['id'];
$category= $callConfig->getRow($query);
 $products="select * from tb_store_products where scid=".$_GET['id']." and status =  'Active' order by spid DESC   ";
$productslist= $callConfig->getAllRows($products);
$productslistnew= $callConfig->getcount($products);
//echo $productslistnew;

if($_POST['submit']=='Add to Cart')
{ 
//print_r($_POST);exit;
$cartobj->inserttempcart($_POST);
}

?>
<!--<link href="<?=SITEURL?>/pagination.css" rel="stylesheet" type="text/css" /> -->


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


     <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="<?=SITEURL?>/images/aboutarow_03.png" alt=""></li>
                 <!--<li><a href="productpage.php?id=<?php echo $_GET['id']?>"><?php echo $category->catetitle;?></a></li>-->
                 
                 <li><a href="<?=SITEURL?>/<?=seoClass::fURL('productpage.php?id='.$_GET['id'])?>"><?php echo $category->catetitle;?></a></li>
                 
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
            <h2 style="font-size:21px;"><?php echo $category->catetitle;?></h2>
            
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
				   //print_r($productslist);exit;
				   if($productslist){
				  foreach($productslist as $prolist){
					  
			 $queryvalue="select MIN(real_price) as real_price,id,size,weight from tb_store_value where spid=".$prolist->spid; 
					  $minimumvalues= $callConfig->getRow($queryvalue);
					  
	//vekat query//	
				  
					  
	/*$sqlp="select * from tb_orderdetails";
	 
	 $product= $callConfig->getAllRows($sqlp);
	 
	*/
	
	 
	 
	 
	 
	 //echo $product->product_id;
	 
	 //print_r($product_id);
	 
	 
	 
	 $sql="select * from tb_cart";
	 
	 $cart= $callConfig->getAllRows($sql);
	 


	 //echo $cart->prod_id;
	 
	 
	
//vekat query//


					  //print_r($minimumvalues);
					  
					  // $maxwidth = 181; // largest allowed width
// 	                   $maxheight = 179;  // largest allowed height
//	 
//	 
//	 //list($width, $height, $type) = @getimagesize("http://www.secondhandweddingdresses.com.au/uploads/mainimages/".$getfed->images);
//     list($width, $height, $type) = @getimagesize("uploads/store/products/".$prolist->image);
//     // $width and $height are the dimensions of the image
//     if ($maxwidth < $width && $width >= $height) {
//		
//      //echo "1";
//       $thumbwidth = $maxwidth;
//       $thumbheight = ($thumbwidth / $width) * $height;
//     }
//     elseif ($maxheight < $height && $height >= $width) {
//      //echo "2";
//       $thumbheight = $maxheight;
//       $thumbwidth = ($thumbheight /$height) * $width;
//     }
//     else {
//		 //$maxwidth = 259; // largest allowed width
// 	  //$maxheight = 194;  // largest allowed height
//     	//echo 'else';
//        $thumbheight = $maxheight;
//        $thumbwidth = $maxwidth;
//	
//     } 





                
 list($width,$height)=@getimagesize("uploads/store/products/".$prolist->image);
 
 if($height<161){
  $setheight=161;
  }
 
 
if($height>161){
  $setheight=161;
  }
  else
  {
   $setheight=$height;
  }
  
   if($width<161){
  $setwidth=161;
  }
 
  if($width>161){
  $setwidth=161;
  }
  else
  {
   $setwidth=$width;
  }
  
  
   if($width<161){
  $setwidth=161;
  }
  /*else
  {
   $setwidth=$width;
  }*/

  /*  <img src="uploads/baner_gallery/<?php echo $all_banners->image; ?>" width="<?=$setwidth;?>" />*/
					  
	?>
              
             <li> 
            <!--  <a href="product_discription.php?spid=<?php echo $prolist->spid?>">-->
               
               <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$prolist->spid)?>">
               <?php if($_GET['id']=='2'){ ?>
               
               <?php if($prolist->image!='' && $prolist->count_stack=='0'){
			  
			   ?>
               
               
               <img src="<?=SITEURL?>/uploads/store/products/<?php echo $prolist->image;?>" alt="" class="res_images" style="height:161px;width:161px;"></a>
               <?php } elseif($prolist->count_stack=='1') {?>
               <img src="<?=SITEURL?>/images/download.jpg" class="res_images" style="height:161px;width:161px;">
			   
               
               <?php }else {?>
                 <img src="<?=SITEURL?>/images/sitelogo_04.png" alt="" class="res_images">
               <?php } }?>
               
               
               
                <?php if($_GET['id']!='2'){ ?>
               
               <?php if(($prolist->image)!='' && $prolist->count_stack=='0'){?>
               
               
               
     <!--venkat script  here -->
     
     
     
     
        
        
     <!--venkat script  here -->


               
               <img src="<?=SITEURL?>/uploads/store/products/<?php echo $prolist->image;?>" alt="" class="res_images" width="<?=$setwidth;?>" height="<?=$setheight;?>">
               
               <style type="text/css">
					
				.pic{
				width:161px;
				height:161px;
				background: url(<?=SITEURL?>/images/download.png) no-repeat;
							
							}
				.pic .red{
						position:relative;
						top:0px;
						width:161px;
						height:161px;
						//background:url(<?=SITEURL?>/images/download.png);
						
						opacity:0;
					}
					
					.pic .red
					{  
						opacity:0.8;
					}
				</style>
               
    <?php } elseif($prolist->count_stack=='1') {?>
   
    <div class="pic">           
               <img src="<?=SITEURL?>/uploads/store/products/<?php echo $prolist->image;?>" alt="" class="red" >
    </div>
               <?php /*?><img src="<?=SITEURL?>/images/download.jpg" class="res_images" style="height:161px;width:161px;"><?php */?>
			   
               
               
               <?php }else {?>
                 <img src="<?=SITEURL?>/images/sitelogo_04.png" alt="" class="res_images">
               <?php } }?>
               
               
               <h5><?php echo substr($prolist->prodtitle,0,15).'....';?></h5>
               <?php //echo $prolist->spid;?>
               <div class="matocl">
               <form method="post">
               
               
               <?php
			   
			    $id=$prolist->spid;
 
               ?>
			   
			
               
               
               
               <?php if($_GET['id']=='1'){ ?>
               
                <span style="float:left;">
              
               <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$prolist->spid)?>"> 
                
                <img  src="<?=SITEURL?>/images/cartround_55.png"></a>
               </span>
               
              
               <?php } else{ ?>
            
                              <span style="float:left;">
<?php /*?>                <input type="hidden" value="Add to Cart" name="submit">
                <input type="image" src="<?=SITEURL?>/images/cartround_55.png" name="submit">
          <?php */?><a href="#"><img src="<?=SITEURL?>/images/cartround_55.png" onclick="addtocart2('<?php echo $prolist->spid;?>','<?php echo $prolist->image;?>','<?php echo $prolist->prodtitle;?>','<?php echo $prolist->scid; ?>','<?php echo $minimumvalues->size; ?>','<?php echo $minimumvalues->real_price; ?>','<?php echo $minimumvalues->real_price*1; ?>','<?=$minimumvalues->weight;?>');" alt=""></a></span>
				<?php } ?>
                
                <?php if($minimumvalues->real_price!=""){ ?>
                
                 <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$<?php echo number_format($minimumvalues->real_price,2);?></h3></span>
				 <?php } else { ?>  <span style="float:left; padding-left:15px; margin-top:5px;"><div class="toprated"> No Price </div></span> <?php }  ?>
                 
                  <input type="hidden" name="spd" id="spd" value="<?php echo $prolist->spid;?>"/>
                        <input type="hidden" name="pimg" value="<?php echo $prolist->image;?>"/>
                   <input type="hidden" name="weight" value="<?php echo $minimumvalues->weight; ?>"/>  

                        <input type="hidden" name="probname" value="<?php echo $prolist->prodtitle;?>"/>
                        <input type="hidden" name="catid" value="<?php echo $prolist->scid; ?>"/>  
                        <input type="hidden" name="bottle_size" value="<?php echo $minimumvalues->size; ?>"/>  
                         <input type="hidden" name="prod_id" value="<?php echo $prolist->spid; ?>"/>  


                        <input type="hidden" name="price2" value="<?php echo $minimumvalues->real_price; ?>"/>  
                        <input type="hidden" name="price" value="<?php echo $minimumvalues->real_price*1; ?>"/>
                                                 <input type="hidden" name="product_type" id="product_type2" value="direct"/>  
                        <input type="hidden" name="qun" id="qun2" value="1"/>  
                        
                        <input type="hidden" name="cont_mg" id="cont_mg2" value=""/>  
                        
                   </form>     
                <div class="clear_fix"></div> 
               </div>
             </li>
           
             <?php }
			 
			 } else {?>
			 
			  <h2 style="font-size:21px; margin-left:530px;"><?php
			 
			 echo "No Records";?> </h2><?php
			 }
			 
			 } ?>
           <script>
				 function addtocart2(spid,pimg,probname,catid,bottle_size,price2,price,weight)
				 {     
				       //alert(pimg);return false;
					   var qun=document.getElementById('qun2').value;
                       var product_type1=document.getElementById('product_type2').value;
					   var cont_mg=document.getElementById('cont_mg2').value;
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
						xmlhttp.open("GET","<?=SITEURL?>/ajax_cart.php?spid="+spid+" & pimg="+pimg+" & probname="+probname+" & catid="+catid+" & price="+price+" & price2="+price2+" & qun="+qun+" & cont_mg="+cont_mg+" & bottle_size="+bottle_size+" & weight="+weight+" & product_type1="+product_type1,true);
						xmlhttp.send();
					 }
				 </script>
		
            </ul>
       
      
      
      
      
      
       <?php /*?><table style="float:right;">
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

      </table><?php */?>  
      
      
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