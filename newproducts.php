<?php include("includes/header.php");

$query="SELECT * FROM `tb_store_products`  where status='active' ORDER BY `spid` DESC";
$Allprodlist=$callConfig->getAllRows($query);

//echo $productslistnew;
?>
   
     <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="index.php">Home</a></li>
                <li><img src="images/aboutarow_03.png" alt=""></li>
                 <li>New Products</li>
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
            <h3 style="color:green" id="sarat2"></h3>

              <ul class="feturedprolis">
              
              
              
              <?php if(count($Allprodlist)>0){
				  foreach($Allprodlist as $prolist){
					  
					  
					  	 $queryvalue="select MIN(real_price) as real_price,id,size,weight from tb_store_value where spid=".$prolist->spid; 
					  $minimumvalues= $callConfig->getRow($queryvalue);
		
				  ?>
              
             <li > 
               <a href="product_discription.php?spid=<?php echo $prolist->spid?>">
             
               <?php if(($prolist->image)!=''){?>
               <img src="uploads/store/products/<?php echo $prolist->image;?>" alt="" class="res_images" >
               
               <?php }else {?>
                 <img src="images/sitelogo_04.png" alt="" class="res_images">
               <?php }?>
               
               </a>
               <h5><?php echo 
			   substr($prolist->prodtitle,0,15).'....';?></h5>
               <?php //echo $prolist->spid;?>
               <div class="matocl">
                <span style="float:left;">
                
    <?php if($prolist->scid=='1'){ ?>
               
              
               <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$prolist->spid)?>"> 
                
                <img  src="<?=SITEURL?>/images/cartround_55.png"></a>
              
               <?php } else{ ?>
            
               
<?php /*?>                <input type="hidden" value="Add to Cart" name="submit">
                <input type="image" src="<?=SITEURL?>/images/cartround_55.png" name="submit">
          <?php */?><a href="#"><img src="<?=SITEURL?>/images/cartround_55.png" onclick="addtocart2('<?php echo $porlist->spid;?>','<?php echo $porlist->image;?>','<?php echo $porlist->prodtitle;?>','<?php echo $porlist->scid; ?>','<?php echo $minimumvalues->size; ?>','<?php echo $minimumvalues->real_price; ?>','<?php echo $minimumvalues->real_price*1; ?>','<?=$minimumvalues->weight;?>');" alt=""></a>
				<?php } ?>              
                
                
                
</span> <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$<?php echo number_format($minimumvalues->real_price,2);?></h3></span>
                <div class="clear_fix"></div> 
                                         <input type="hidden" name="product_type" id="product_type2" value="direct"/>  
                        <input type="hidden" name="qun" id="qun2" value="1"/>  
                        
                        <input type="hidden" name="cont_mg" id="cont_mg2" value=""/>  
                        
               </div>
             </li>
           
             <?php }}?>
             
            </ul>
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
            
         </div>
       </div>
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php include("includes/clintblog.php")?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
  
 <?php include("includes/footer.php")?>