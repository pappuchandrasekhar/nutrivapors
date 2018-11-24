<?php include("includes/header.php");
$query="select * from tb_store_category where scid=".$_GET['id'];
$category= $callConfig->getRow($query);
$products="select * from tb_store_products where scid=".$_GET['id']." and status =  'Active' order by spid DESC   ";
$productslist= $callConfig->getAllRows($products);
$productslistnew= $callConfig->getcount($products);
//echo $productslistnew;
?>
  <!-- <link href="<?=SITEURL?>/paginationstyle.css" rel="stylesheet" type="text/css" /> -->
   
   
  <!-- <?php 
/*-------------------------------------------------------------------------------------------*/

$adjacents = 1;
$limit =18; 
/*if(isset($_GET['id']))
{
 $total_pages=$frontpageObj->getAllNewsListmostcount($_GET['id']);	
$targetpage = "news.php?id='".$_GET['id']."'"; 
}
else
{*/
$total_pages=$bannerObj->getAllfaqListCount();
//print_r($total_pages);
 //$targetpage = productpage.php; 

 $targetpage = SITEURL/seoClass::furl('productpage.php?id='.$_GET['id']); 
 

								//how many items to show per page
	 $page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
	$start = 0;		
/*if(isset($_GET['id']))
{

$news=$frontpageObj->getAllNewsListmost($_GET['id'],$sortfield,$orderby,$start,$limit);	
//print_r($news);
}
else
{*/
 $services11=$bannerObj->getAllfaq($_GET['id'],$orderby,$start,$limit);
 
//print_r($services11);

//print_r($allprope);exit;

if ($page == 0) $page = 1;	 				//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?page=$prev\">previous</a>";
		else
			$pagination.= "<span class=\"disabled\">previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?page=$next\">next</a>";
		else
			$pagination.= "<span class=\"disabled\">next</span>";
		$pagination.= "</div>\n";		
	}		
/*--------------funtion---------------------------*/
 function shorten_string($string, $wordsreturned)
/*  Returns the first $wordsreturned out of $string.  If string
contains fewer words than $wordsreturned, the entire string
is returned.
*/
{
$retval = $string;      //  Just in case of a problem
 
$array = explode(" ", $string);
if (count($array)<=$wordsreturned)
/*  Already short enough, return the whole thing
*/
{
$retval = $string;

}
else
/*  Need to chop of some words
*/
{
array_splice($array, $wordsreturned);
$retval = implode(" ", $array);
}
return $retval;
}

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
   
    <!--innerpagepart-->
       <div class="full_wrapper innerpart">
         <div class="site_container">
            <h2><?php echo $category->catetitle;?></h2>
            
            <div class="concomimg">
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
				  ?>
              
             <li > 
            <!--  <a href="product_discription.php?spid=<?php echo $prolist->spid?>">-->
               
               <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$prolist->spid)?>">
               
               
             
               <?php if(($prolist->image)!=''){?>
               <img src="<?=SITEURL?>/uploads/store/products/<?php echo $prolist->image;?>" alt="" class="res_images" >
               
               <?php }else {?>
                 <img src="<?=SITEURL?>/images/sitelogo_04.png" alt="" class="res_images">
               <?php }?>
               
               </a>
               <h5><?php echo 
			   substr($prolist->prodtitle,0,15).'....';?></h5>
               <?php //echo $prolist->spid;?>
               <div class="matocl">
                <span style="float:left;"><a href="#"><img src="<?=SITEURL?>/images/cartround_55.png" alt=""></a></span> <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$<?php echo $prolist->real_price;?></h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
           
             <?php }}?>
     
            </ul>
      
          <?php /*?>   <table style="float:right;">
                      <tr><td colspan="10" align="left" style="padding-left:15px;">
						<?php if($total>$limit)
			{
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['id']!='')
			//$param=$param."&catid=".$_GET['catid'];
			
			$callConfig->paginavigation_FrontEnd($start, $limit, $total, SITEURL."/productpage.php?id=".$_GET['id'], $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

      </table> <?php */?> 
      
      
              <div class="clear_fix"></div> 
            </div>
            
         </div>
        <!-- <div style="text-align:right;margin-right:140px; border-color: red"> <?=$pagination?></div>-->
         
       </div>
       
       
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php include("includes/clintblog.php")?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
  
 <?php include("includes/footer.php")?>