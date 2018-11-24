
<?php include("includes/header.php");
$query="select * from tb_store_category where scid=".$_GET['id'];
$category= $callConfig->getRow($query);

//print_r($category);
$products="select * from tb_store_products where scid=".$_GET['id']." and status='Active' order by spid DESC   LIMIT 0 , 6  ";

$productslist= $callConfig->getAllRows($products);
//print_r($productslist);exit;
?>
     <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="<?=SITEURL?>/images/aboutarow_03.png" alt=""></li>
           <!--      <li><a href="productpage.php?id=<?php echo $category->scid?>"><?php echo  $category->catetitle;?></a></li>-->
          <li><a href=""><?php echo  $category->catetitle;?></a></li>
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div>
     <!--End bedgromms part-->
   
 <!--innerpagepart-->
       <div class="full_wrapper innerpart">
         <div class="site_container">
            <h2><?php echo  $category->catetitle;?></h2>
            
            <div class="concomimg">
            
             <h3 style="color:green" id="sarat2"></h3>
              <div class="ineppage_lef">
                <p><?php echo  $category->bigtext;?>
                  </p>
              </div>
              <div class="innerpageright">
              
                   <?php    
	     $maxwidth = 380; // largest allowed width
     $maxheight =430;  // largest allowed height
     list($width, $height, $type) = @getimagesize("uploads/store/category/".$categoy->image);
     // $width and $height are the dimensions of the image
     if ($maxwidth < $width && $width >= $height) 
	 {
      //echo "1";
       $thumbwidth = $maxwidth;
       $thumbheight = ($thumbwidth / $width) * $height;
     }
     elseif ($maxheight < $height && $height >= $width) 
	 {
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
      
                <a href="#"><img src="<?=SITEURL?>/uploads/store/category/<?php echo $category->image; ?>" alt="" ></a>
              </div>
              <div class="clear_fix"></div> 
            </div>
            
         </div>
       </div>
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->



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



   
     <!--Newproducts-->
      <div class="full_wrapper feturedproducts" style="background-color:#FFF;">
        <div class="site_container feturedproductsin">
            <h3>New Products</h3>
            <ul class="feturedprolis">
            <?php foreach ($productslist as $prolist){
             $queryvalue="select MIN(real_price) as real_price,id,size,weight from tb_store_value where spid=".$prolist->spid; 
					  $minimumvalues= $callConfig->getRow($queryvalue);
?>            
             <li > 
            <!--  <a href="product_discription.php?spid=<?php echo $prolist->spid?>">-->
               
               <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$prolist->spid)?>">
               <?php if($_GET['id']=='2'){ ?>
               
               <?php if(($prolist->image)!=''){
			   echo $prolist->spid;
			   ?>
               <img src="<?=SITEURL?>/uploads/store/products/<?php echo $prolist->image;?>" alt="" class="res_images" style="height:161px;width:161px;">
               
               <?php }else {?>
                 <img src="<?=SITEURL?>/images/sitelogo_04.png" alt="" class="res_images">
               <?php } }?>
               
               
               
                <?php if($_GET['id']!=='2'){ ?>
               
               <?php if(($prolist->image)!=''){?>
               <img src="<?=SITEURL?>/uploads/store/products/<?php echo $prolist->image;?>" alt="" class="res_images" width="<?=$setwidth;?>" height="<?=$setheight;?>">
               
               <?php }else {?>
                 <img src="<?=SITEURL?>/images/sitelogo_04.png" alt="" class="res_images">
               <?php } }?>
               
               
               </a>
               <h5><?php echo substr($prolist->prodtitle,0,15).'....';?></h5>
               <?php //echo $prolist->spid;?>
               <div class="matocl">
               <form method="post">
               
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
             <?php }?>
            
            </ul>
            <div class="clear_fix"></div> 
        </div>
      </div>
      <div class="clear_fix"></div> 
   <!--End Newproducts-->
<?php include("includes/footer.php")?>