<?php 
include("includes/header.php");
include("includes/banner.php");

$categoylist=$bannerObj->getAllCategoyList('','','','');
$query="SELECT * FROM `tb_store_products`  where status='active' ORDER BY `spid` DESC LIMIT 0,6";
$Allprodlist=$callConfig->getAllRows($query);

$featuredlist=$bannerObj->getAllFeaturedList('','','','');
 $query="SELECT * FROM `tb_store_products`  where featuredlisting='yes' ORDER BY `spid` DESC LIMIT 0,6";
 $Allfeaturedlist=$callConfig->getAllRows($query);
 
 //print_r($Allfeaturedlist);exit;


 
$query="select * from tb_faq where id=".$_GET['id'];
$contentpage= $callConfig->getRow($query);



if($_POST['submit']=='Add to Cart')
{ 
//print_r($_POST);exit;
$cartobj->inserttempcart($_POST);
}

?>

 <!--vavepensblog-->
     <div class="full_wrapper vavepens">
       <div class="site_container vavepensin">
          <ul class="vapenslis">
          <?php if(count($categoylist)>0){
			  foreach($categoylist as $categoy){
				  
			  ?>
           <li>
                <?php    
	     $maxwidth = 290; // largest allowed width
     $maxheight = 152;  // largest allowed height
     list($width, $height, $type) = @getimagesize("uploads/store/category/".$categoy->image);
     // $width and $height are the dimensions of the image
     if ($maxwidth < $width && $width >= $height) {
      //echo "1";
       $thumbwidth = $maxwidth;
       $thumbheight = ($thumbwidth / $width) * $height;
     }
     elseif ($maxheight < $height && $height >= $width) {
      //echo "2";
       $thumbheight = $maxheight;
       $thumbwidth = ($thumbheight /$height) * $width;
     }
     else {
      //echo "else";
       $thumbheight = $maxheight;   
       $thumbwidth = $maxwidth;
     }
	 ?>
      
            <img src="<?=SITEURL?>/uploads/store/category/<?php echo $categoy->image; ?>" alt=""  style="width:290; height:152px;" class="h2ttle">
          <!--  <a href="category.php?id=<?php echo $categoy->scid;?>">  <h3><?php echo $categoy->catetitle; ?></h3>-->
               <a href="<?=SITEURL?>/<?=seoClass::fURL('category.php?id='.$categoy->scid)?>">  <h3 class="h2ttle"><?php echo $categoy->catetitle; ?></h3>
            
             <p><?php   $text=$categoy->bigtext;
			 $to=cut_paragraph($text,24);
print substr($to,0,150)."[MORE]"
			 ?> </p></a>
           </li>
           <?php  }}?>

          </ul>
       </div>
     </div>
      <div class="clear_fix"></div> 
   <!--End vavepensblog-->
   
  
   <!--feturedproducts-->
      <div class="full_wrapper feturedproducts">
        <div class="site_container feturedproductsin">
            <h3>Featured Products</h3>
            <h3 style="color:green" id="sarat1"></h3>
            <ul class="feturedprolis">
			<?php  if(count($featuredlist)>0){
			  foreach($featuredlist as $featured){
				 $queryvalue="select MIN(real_price) as real_price,id,size,weight from tb_store_value where spid=".$featured->spid;
					  $minimumvalues= $callConfig->getRow($queryvalue);
                       //print_r($minimumvalues); 
			  ?>
              			<form name="featuredproducts" method="post">

           <li>
           
			  <!--<a href="product_discription.php?spid=<?php echo $featured->spid;?>"> -->
              
              <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$featured->spid)?>"> 
			   <img src="<?=SITEURL?>/uploads/store/products/<?php echo $featured->image; ?>" alt="" class="res_images" ></a>
  <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$featured->spid)?>">  <h5><?php echo substr($featured->prodtitle,0,10).'....'; ?></h5> </a>
                <div class="matocl">
                <span style="float:left;">
                
<?php /*?>                <input type="hidden" value="Add to Cart" name="submit">
                <input type="image" src="<?=SITEURL?>/images/cartround_55.png" name="submit">
              <?php */?>  
                   <?php if($featured->scid!=1){ ?>
                 <a href="javascript:void(0);" onclick="addtocart1('<?php echo $featured->spid;?>','<?php echo $featured->image;?>','<?php echo $featured->prodtitle;?>','<?php echo $featured->scid; ?>','<?php echo $minimumvalues->size; ?>','<?php echo $minimumvalues->real_price; ?>','<?php echo $minimumvalues->real_price*1; ?>','<?=$minimumvalues->weight;?>');">
                 <img src="<?=SITEURL?>/images/cartround_55.png"    alt=""></a>
                 <?php } else if($featured->scid==1){ ?>
                 <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$featured->spid)?>" ><img src="<?=SITEURL?>/images/cartround_55.png"    alt=""></a>
                 
                 <?php }?>
                 
                 </span> 
                <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$<?=number_format($minimumvalues->real_price,2);?></h3></span>
                
                   <input type="hidden" name="spd" id="spd" value="<?php echo $featured->spid;?>"/>
                        <input type="hidden" name="pimg" value="<?php echo $featured->image;?>"/>
                        <input type="hidden" name="probname" value="<?php echo $featured->prodtitle;?>"/>
                        <input type="hidden" name="catid" value="<?php echo $featured->scid; ?>"/>  
                        <input type="hidden" name="bottle_size" value="<?php echo $minimumvalues->size; ?>"/>  
                        <input type="hidden" name="weight" value="<?php echo $minimumvalues->weight; ?>"/>  
                        <input type="hidden" name="prod_id" value="<?php echo $featured->spid; ?>"/>  

                        <input type="hidden" name="product_type" id="product_type1" value="direct"/>  

                        <input type="hidden" name="price2" value="<?php echo $minimumvalues->real_price; ?>"/>  
                        <input type="hidden" name="price" value="<?php echo $minimumvalues->real_price*1; ?>"/>  

                        <input type="hidden" name="qun" id="qun1" value="1"/>  
                        
                        <input type="hidden" name="cont_mg" id="cont_mg1" value=""/>  
                        
                <div class="clear_fix"></div> 
               </div>
             </li>
                                </form> 

             
			<?php  }} ?>
            
             <script>
				 function addtocart1(spid,pimg,probname,catid,bottle_size,price2,price,weight)
				 {     
				     
					   var qun=document.getElementById('qun1').value;
                       var product_type1=document.getElementById('product_type1').value;
					   

					   var cont_mg=document.getElementById('cont_mg1').value;
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
							document.getElementById("sarat1").innerHTML=xmlhttp.responseText;
							}
						  }
						  				       //alert(price2);
						xmlhttp.open("GET","<?=SITEURL?>/ajax_cart.php?spid="+spid+" & pimg="+pimg+" & probname="+probname+" & catid="+catid+" & price="+price+" & price2="+price2+" & qun="+qun+" & cont_mg="+cont_mg+" & bottle_size="+bottle_size+" & weight="+weight+" & product_type1="+product_type1,true);
						xmlhttp.send();
					 }
				 </script>
			
			 </ul>
			  <div class="clear_fix"></div> 
       </div>
     </div>
      
			<div class="clear_fix"></div> 
			
			
			
			
			
               <!--End feturedproducts-->
   
   
    <!--freeshoping-->
      <div class="full_wrapper freeshoping">
        <div class="site_container freeshopingin">
          <div class="btncenter">
            <a href="<?=SITEURL?>/featuredproducts.php"><img src="<?=SITEURL?>/images/leadmorebtn_59.png" alt=""></a>
          </div>
          <div class="clear_fix"></div> 
          <ul class="grbtnlis">
          <li>
             <span class="grebtnspan"><a href="<?=SITEURL?>/<?=seoClass::fURL('content.php?id=7')?>"><img src="<?=SITEURL?>/images/freeshiping_imges_62.jpg" alt="" class="res_images"></a></span>
             <span class="grelefsp">
            <a href="<?=SITEURL?>/<?=seoClass::fURL('content.php?id=7')?>"> <h4>Free Shipping</h4></a>
             <p>For order over $100</p>
             </span>
              <div class="clear_fix"></div> 
           </li>
            <li>
			
			
			 
			
		
                  
             <span class="grebtnspan"><a href="<?=SITEURL?>/<?=seoClass::fURL('faq.php')?>"><img src="<?=SITEURL?>/images/freeshiping_imges_65.jpg" alt=""  class="res_images"></a></span>
			 	 	
             <span class="grelefsp">
             <h4>Got questions? No Problem</h4>
             <p>
             Lorem ipsum dolor sit amet, consectetur
adipiscing elit. Pellentesque non
             </p>
             </span>
              <div class="clear_fix"></div> 
           </li>
           <li>
		   
		   
		     <?php  

 
$securepayment=$bannerObj->getSecurePayment('','','','');?>
 <?php    if(count($securepayment)>0){
			  foreach($securepayment as $secure){?>
			 
          
      
		   
           <!-- <a href="content.php?id=<?php echo $contentpage->page_id;?>">  <?php echo $contentpage->title; ?> </a>-->
            
           
            <span class="grebtnspan">
		   
           
		 	   
		 		   
		   
             <a href="<?=SITEURL?>/<?=seoClass::fURL('content.php?id='.$secure->page_id)?>"><img src="<?=SITEURL?>/images/freeshiping_imges_68.jpg" alt=""  class="res_images"></a> 
			 </span>
			
			 	<?php  }}
 
 ?>	
		   
		   
		   
		
             <span class="grelefsp">
             <h4>Secured Payment</h4>
             <p>
             Lorem ipsum dolor sit amet, consectetur
adipiscing elit. Pellentesque non
             </p>
             </span>
              <div class="clear_fix"></div> 
           </li>
          </ul>
          <div class="clear_fix"></div> 
        </div>
      </div>
      <div class="clear_fix"></div> 
   <!--End freeshoping-->
   
   
   <!--Newproducts-->
      <div class="full_wrapper feturedproducts">
        <div class="site_container feturedproductsin">
            <h3>New Products</h3>
                        <h3 style="color:green" id="sarat2"></h3>

            <ul class="feturedprolis">
            <?php foreach($Allprodlist as $porlist){
			 $queryvalue="select MIN(real_price) as real_price,id,size,weight from tb_store_value where spid=".$porlist->spid;
					  $minimumvalues= $callConfig->getRow($queryvalue);
					  
					  
					  list($width,$height)=@getimagesize("uploads/store/products/".$porlist->image);
					  
					  
					   /*if($height<161){
						   //echo "hello";
                        $setheight=161;
                            }*/
					  
 
                         if($height>161){
							//echo $height; //echo "hai";
                        $setheight=161;
                            }
							
							
/*							 if($height<161){
							 //echo "hai";
                        $setheight=161;
                            }
*/							
                        /*else
                          {
							  //echo "hello";
                    $setheight=161;
                          }*/
						  
						  
						  
					   
 
                    if($width>161){
						//echo $width;
                     $setwidth=161;
                     }
					 
					 /*if($width<161){
						//echo "hello";
                     $setwidth=161;
                     }*/
					 
					 
                 /* else
                    {
              $setwidth=$width;
                    }*/
					  
                
					  
					
					  
				
				?>
                              			<form name="featuredproducts" method="post">

             <li>
               
                <?php if(($porlist->image)!=''){?>
                <!--<a href="product_discription.php?spid=<?php echo  $porlist->spid?>">-->
                
               <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='. $porlist->spid)?>"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $porlist->image;?>" alt="" class="res_images" width="<?=$setwidth;?>" height="<?=$setheight;?>"></a>
               
               <?php }else {?>
                 <a href="#"><img src="images/sitelogo_04.png" alt="" class="res_images"  ></a>
               <?php }?>
               
              <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='. $porlist->spid)?>"><h5><?php echo substr($porlist->prodtitle,0,15).'....';?></h5></a>
               <div class="matocl">
                <span style="float:left;">
                                   <?php if($porlist->scid!=1){ ?>

                
                <a href="javascript:void(0);" >
                <img src="<?=SITEURL?>/images/cartround_55.png" onclick="addtocart2('<?php echo $porlist->spid;?>','<?php echo $porlist->image;?>','<?php echo $porlist->prodtitle;?>','<?php echo $porlist->scid; ?>','<?php echo $minimumvalues->size; ?>','<?php echo $minimumvalues->real_price; ?>','<?php echo $minimumvalues->real_price*1; ?>','<?=$minimumvalues->weight;?>');"  alt="">
                </a>
                 <?php } else if($porlist->scid==1){ ?>
                 <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$porlist->spid)?>" ><img src="<?=SITEURL?>/images/cartround_55.png"    alt=""></a>
                 
                 <?php }?>
                
              <?php /*?>  <input type="hidden" value="Add to Cart" name="submit">
                <input type="image" src="<?=SITEURL?>/images/cartround_55.png" name="submit">
              <?php */?>  
                
                
                </span> 
                <?php if($minimumvalues->real_price!="") { ?>
                
     <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$<?php echo number_format($minimumvalues->real_price,2);?></h3></span>
				
	<?php } else {?> <span style="float:left; padding-left:15px; margin-top:5px;"><div class="toprated">  No Price </div></span>
                
                <?php } ?>
                
                       <script>
				 function addtocart2(spid,pimg,probname,catid,bottle_size,price2,price,weight)
				 {     
				       //alert(spid);
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
		
                <div class="clear_fix"></div> 
               </div>
                                       <input type="hidden" name="weight" value="<?php echo $minimumvalues->weight; ?>"/>  
                  <input type="hidden" name="spd" id="spd" value="<?php echo $porlist->spid;?>"/>
                        <input type="hidden" name="pimg" value="<?php echo $porlist->image;?>"/>
                        <input type="hidden" name="probname" value="<?php echo $porlist->prodtitle;?>"/>
                        <input type="hidden" name="catid" value="<?php echo $porlist->scid; ?>"/>  
                        <input type="hidden" name="bottle_size" value="<?php echo $minimumvalues->size; ?>"/> 
                         <input type="hidden" name="prod_id" value="<?php echo $porlist->spid; ?>"/>  

                                                  <input type="hidden" name="product_type2" id="product_type2" value="direct"/>  

                        <input type="hidden" name="price2" value="<?php echo $minimumvalues->real_price; ?>"/>  
                        <input type="hidden" name="price" value="<?php echo $minimumvalues->real_price*1; ?>"/>  

                        <input type="hidden" name="qun" id="qun2" value="1"/>  
                        
                        <input type="hidden" name="cont_mg2" id="cont_mg2" value=""/>  
                              </li>
             </form>
             <?php }?>
            </ul>
            <div class="clear_fix"></div> 
        </div>
      </div>
      <div class="clear_fix"></div> 
   <!--End Newproducts-->
   
   <!--clintblog-->
  	<div>	
	<?php include("includes/clintblog.php")?> </div>
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
  
 <?php include("includes/footer.php")?>