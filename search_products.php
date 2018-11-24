<?php include ('includes/header.php');?>

<link href="pagination.css" rel="stylesheet" type="text/css" />




<div class="full_wrapper innerpart">
         <div class="site_container">
            <h2><?php echo $category->catetitle;?></h2>
            
            <div class="concomimg">
            
            
     
              <ul class="feturedprolis">
              
              
             <?php
$start=0;
if($_GET['start']>0)
{
$start=	$_GET['start'];
}
$limit=20;
 $abd=$_GET['search'];
 $query="SELECT * FROM `tb_store_products` WHERE prodtitle LIKE '%$abd%'  ORDER BY spid DESC limit ".$start.",".$limit;
  $sear=$callConfig->getAllRows($query);
  $sql_total="SELECT * FROM `tb_store_products` WHERE prodtitle LIKE '%$abd%' or lotnumber LIKE '%$abd%'";
  $total=$callConfig->getCount($sql_total);
  //print_r($sear);
      
	 foreach($sear as $searh){
	  
	 $query1="SELECT * FROM `tb_products_size` WHERE pid='$searh->spid' ORDER BY id DESC";
	 $price=$callConfig->getRow($query1);
?>
              
             <li> 
            
               
             <?php /*?> <?php $querylat="select * from tb_store_sku where c_lotid='$searh->prodtitle_slug' ORDER BY c_lotid DESC";
				$resss=$callConfig->getRow($querylat);
?>
               <?php */?>
               
             
             <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$searh->spid)?>"> <img src="uploads/store/products/<?php echo $searh->image ;  ?>" style="width:130px;height:170px;"></a>
               
               </a>
               <h5><p><?php echo  substr($searh->prodtitle,0,15).'....';?></p>
               
               
               <?php if($searh->real_price!=""){ ?>

<b>Price: $<?php echo $searh->real_price;?></b></h5>

<?php } else { ?>  No Price  <?php } ?>
               <?php //echo $prolist->spid;?>
               <div class="matocl">
                    
                <div class="clear_fix"></div> 
               </div>
             </li>
             
             <?php  }  if(count($sear)=='0'){  ?><div style="margin-top:80px;color:#F00;font-size:15px;" align="center"><?php  echo "No Products Available.......";?></div> <?php } ?>
           
             
     
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





<?php /*?><div class="inner_content" >
<div class="middle_inner">
<div class="baner_part" style=" min-height:250px;">
<br />





<h1>Search Products</h1>

<div class="inneproducts">

<ul class="product_list">
<?php
$start=0;
if($_GET['start']>0)
{
$start=	$_GET['start'];
}
$limit=20;
 $abd=$_GET['search'];
 echo $query="SELECT * FROM `tb_store_products` WHERE prodtitle LIKE '%$abd%'  ORDER BY spid DESC limit ".$start.",".$limit;
  $sear=$callConfig->getAllRows($query);
  $sql_total="SELECT * FROM `tb_store_products` WHERE prodtitle LIKE '%$abd%' or lotnumber LIKE '%$abd%'";
  $total=$callConfig->getCount($sql_total);
  //print_r($sear);
      
	 foreach($sear as $searh){
	  
	 $query1="SELECT * FROM `tb_products_size` WHERE pid='$searh->spid' ORDER BY id DESC";
	 $price=$callConfig->getRow($query1);
?>

<li>
<div class="product">
<div class="inproduct">

<?php $querylat="select * from tb_store_sku where c_lotid='$searh->prodtitle_slug' ORDER BY c_lotid DESC";
				$resss=$callConfig->getRow($querylat);
?>


<a href="<?=SITEURL?>/<?=seoClass::fURL('product_details.php?id='.$searh->spid)?>"> <img src="uploads/store/products/<?php echo $searh->image ;  ?>" style="width:130px;height:170px;"></a>

<!--<div  style="width:150px; height:100px;"><a href='uploads/store/products/<?php echo $searh->image ; ?>' class="jqzoom" title="<?=stripslashes($searh->prodtitle)?>" rel='gal1'   ><img src="uploads/store/products/<?php echo $searh->image ;  ?>"  alt=''  style="width:150px;height:100px;"/></a></div>
-->
<p><?php echo  UcFirst($searh->prodtitle);?></p>

<b>Price: $<?php echo number_format($resss->n_listprice,2);?></b>

</div>


</div>



</li>


<?php  }  if(count($sear)=='0'){  ?><div style="margin-top:80px;color:#F00;font-size:15px;" align="center"><?php  echo "No Products Available.......";?></div> <?php } ?>




</ul>


</div>
<table style="float:right;">
                      <tr><td colspan="10" align="left" style="padding-left:15px;">
						<?php if($total>$limit)
			{
			?>
			<ul class="paginator">
			<?php 
			$param="&search=".$abd;
			
			$callConfig->paginavigation_FrontEnd($start, $limit, $total, 'search_products.php', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

      </table>

<!--baner part-->



</div><!--middle inner-->

</div>
<div class="inner_down">

<div class="mid_one">

<div class="innershadowtwo"></div>

<?php include "includes/footer.php"?><!--down foot-->



</div><!--mid one-->


</div><!--inner down-->



</div><?php */?><!--wraper-->


 

</body>
</html>
