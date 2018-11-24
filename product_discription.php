<?php
 
 include("includes/header.php");
 //include("model/cart.class.php");
 //$cartobj= new cartClass;
$products="select * from tb_store_products where spid=".$_GET['spid']." ";
$productslist= $callConfig->getRow($products);
$productslistnew= $callConfig->getcount($products);

$query="select * from tb_store_category where scid=".$productslist->scid;
$category= $callConfig->getRow($query);
//echo $category->scid;

 $prodctvalue="select *  from tb_store_value  where  spid=".$_GET['spid']." order by  size ASC";
 
$valuelist=$callConfig->getALLRows($prodctvalue);


$similarproducts="select * from tb_store_products where scid=".$productslist->scid." order by 'spid' DESC LIMIT 0,6";
$simproductslist= $callConfig->getAllRows($similarproducts);
$simproductslistnew= $callConfig->getcount($similarproducts);

/*if($_POST['submit']=='Add to Cart')
{ 
//print_r($_POST);exit;
$cartobj->inserttempcartindivurl($_POST);
}
*/
if($_POST['submit']=='Add to Cartvalues')
{ 
//print_r($_POST);exit;
$cartobj->inserttempcartindivurl($_POST);
}
?>
<style> 
.disfolis li input[type="button"] {
width: 25%;
height: 40px;
background: #8ebe29;
border: none;
text-align: center;
cursor: pointer;
color: #FFF;
font-family: Arial, Helvetica, sans-serif;
font-size: 16px;
font-weight: bold;
-webkit-border-radius: 8px;
-moz-border-radius: 8px;
border-radius: 8px;
}
</style>
     <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="<?=SITEURL?>/images/aboutarow_03.png" alt=""></li>
                 <!--<li><a href="productpage.php?id=<?php echo $productslist->scid;?>"><?php echo $category->catetitle;?></a></li>-->
                 
       <li><a href="<?=SITEURL?>/<?=seoClass::fURL('productpage.php?id='.$productslist->scid)?>"><?php echo $category->catetitle;?></a></li>
                 
                 
                  <li><img src="<?=SITEURL?>/images/aboutarow_03.png" alt=""></li>
                 <li><a href="javascript:void(0);"><?php echo $productslist->prodtitle;?></a></li>
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div>
     <!--End bedgromms part-->
      <!--discrpitionpart-->
      
          <div class="full_wrapper innerpart">
            <div class="site_container"> 
               <div class="left_aplproduct">
                 <div>
                 
                  <?php    
	     $maxwidth = 483; // largest allowed width
     $maxheight = 407;  // largest allowed height
     list($width, $height, $type) = @getimagesize("uploads/store/products/".$productslist->image);
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
                 
                 
                  <a href="#"> <img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image;?>" alt="" class="res_images" height="<?=$maxheight?>" width="<?=$maxwidth?>"></a>
                 </div>
                 <ul class="left_dislis">
                
                   <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image1;?>" alt="" class="res_images" style="width:74px; height:73px;"></a></li>
                   <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image2;?>" alt="" class="res_images" style="width:74px; height:73px;"></a></li>
                   <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image3;?>" alt="" class="res_images" style="width:74px; height:73px;"></a></li>
                    
                     
                    <!-- <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/noimage.jpg" alt="" class="res_images" style="width:74px; height:73px;"></a></li>
                    -->
                     
                     
                     
                       
                 </ul>
                 <div class="clear_fix"></div>
               </div>
               <div class="prodiscriptrigt">
                <h3 style="color:green" id="sarat"><?=$_GET['msg'];?></h3>
                  <div>
                    <div class="disapleft">
                      <div style="margin-top:50px;">
                      <h3><?php echo $productslist->prodtitle;?></h3>
                      </div>
                    </div>
                    <div class="disapright"> 
                   
                       
                       <div style="margin-top:24px; width:210px;">
                       <div style=" float:left;">
                       <!--<a href="productpage.php?id=<?php echo $productslist->scid;?>">-->
                       
                        <a href="#"><img src="<?=SITEURL?>/images/smsoicons_06.jpg" alt=""></a>
                        <a href="#"><img src="<?=SITEURL?>/images/smsoicons_08.jpg" alt=""></a>
                        <a href="#"><img src="<?=SITEURL?>/images/smsoicons_10.jpg" alt=""></a>
                        <a href="#"><img src="<?=SITEURL?>/images/smsoicons_12.jpg" alt=""></a>
                       
                         <?php
			
			 $query="select * from tb_commentsection where pid='".$_GET['spid']."' and status='Active'";
			 $res=mysql_query($query);
			 
			 $cnt=mysql_num_rows($res);
                       
                      //print_r($cnt);?>
                       
                        (<?php echo $cnt;?> reviews)
                       </div>
 <div style='float:right;'><a href=" <?=SITEURL?>/<?=seoClass::fURL('productpage.php?id='.$productslist->scid)?>"><img src="<?=SITEURL?>/images/backbtn_03.jpg" alt=""></a></div>
                        
                       </div>
                    </div>
                   <div class="clear_fix"></div>
                  </div>
               
                  <div class="boline">
                  </div>
                 <div style="margin-top:10px;">
                   <div class="discriptiontext">
                     Description:
                   </div>
                  <p style="background-color !important;">
                   <?php echo  $productslist->bigtext;?>
                  </p>
                 </div>
                 <form name="productlist" id="productlist" method="post" >
                 <ul class="disfolis">
                 
                  <?php if($productslist->scid=='1')
				  { ?>
                   <li>
                    <span>E-Juice Bottle Size</span>
                    <select name="bottle_size" id="bottle_size" onchange="showUser(this.value);" required="required"  > 
                    <!-- <option value="">Select</option>-->
                    <?php foreach($valuelist as $listval){?>
                    <option value="<?php echo  $listval->size?>"><?php echo  $listval->size?><span style="color:red">ml</span></option>
                   <?php }?>
                    </select>
                   </li>  
               
				 <?php } ?>
                 
                  <?php if($productslist->scid=='1')
				  { ?>
                   
                   <li>
                    <span>E-Juice Nicotine Content</span>
                    <select name="cont_mg" id="cont_mg" required="required" >
                    
                    <option value="0mg">0mg</option>
                    <option value="3mg">3mg</option>
                    <option value="6mg">6mg</option>

                    <option value="8mg">8mg</option>
                    <option value="12mg">12mg</option>
                    <option value="14mg">14mg</option>
                    <option value="16mg">16mg</option>
                    <option value="18mg">18mg</option>
                    <option value="24mg">24mg</option>
                    
                    </select>
                   </li>
                   <?php }if($productslist->scid=='1')
				  {  ?>
                   
                    <li>
                    <span>E-Juice Finish:</span>
                    <select name="finish" id="finish" required="required" >
                    
                    <option value="Regular(90/10 VG/PG)">Regular (90/10 VG/PG)</option>
                    <option value="Smooth(100 VG)">Smooth (100 VG)</option>
                    </select>
                   </li>
                   
                   <?php } 
                   
                    $qq="select * from tb_store_value where spid=".$productslist->spid ;
				   $sqq=mysql_query($qq);
				   $qua=mysql_fetch_array($sqq);
				   $quantity=$qua['quantity'];
                   
                   
                   
                   ?>
                  
                   <li>
                    <span>Quantity</span>
                    <select name="qun" id="qun" onchange="User(this.value);" required="required"  >
                     <!--<option value="">Select Quantity</option>-->
                    <?php for($i=1; $i<$quantity+1; $i++) { ?>
                    <option value="<?php echo  $i;?>"><?php echo  $i;?></option>
                    <?php }?>
                    </select>
                   </li>
                   
                 <?php /*?>  <?php
				   if($productslist->scid=='2')
				   {?><?php */?>
                 <!-- <li>
                    <span>Available Colors:</span>
                    <select name="vcolor" id="vcolor">
                    <option value="">Select</option>
                    <option value="Red">Red</option>
                    <option value="Green">Green</option>
                    <option value="Blue">Blue</option>
                    <option value="Yellow">Yellow</option>
                    </select>
                   </li>-->
                 <?php /*?>  <?php }<?php */?>
				   
				   <?php  if($productslist->scid!='1')
				   {
				    ?>
                   <?php 
				   $vp="select * from tb_store_products where spid='".$_GET['spid']."'";
				   $vsq=mysql_query($vp);
				   $fsq=mysql_fetch_array($vsq);
				   $name=$fsq['d_type'];
				  
				   ?>
                   <li>
                    <span><?php  if($name!="")
					{
					 echo $name; 
					 } else { ?>
					 Size 
					 <?php }?></span>
                    <select name="bottle_size" id="bottle_size" onchange="showUser(this.value);" required="required"  > 
                    <!-- <option value="">Select</option>-->
                    <?php foreach($valuelist as $listval){?>
                    <option value="<?php echo  $listval->size?>"><?php echo  $listval->size?>..<span class="spclr">ml</span></option>
                   <?php }?>
                    </select>
                   </li>
                   
                   <?php } ?>
                   
                   
                   <li>
                    <span>Price</span>
                        <div id="txtHint">No Price</div>
                        <script>
                    function myFunction() {
                    var str = "<?php echo $price;?>";
                    var res = str.split(" ");
                    document.getElementById("demo").innerHTML = res;
                    }
                    </script>
                        
                     <input type="hidden" name="price" id="price" value="<?=number_format($price,0,2)?>" />
                        <input type="hidden" name="price2" id="price2" value="<?=number_format($price,0,2)?>" />
                  </li>
                   <li>
                   
                   <input type="hidden" name="weight" id="weight" value="<?=$_SESSION['weight']?>" />
                   <input type="hidden" name="spd" id="spd" value="<?php echo  $_GET['spid']?>"/>
                        <input type="hidden" name="pimg" value="<?php echo $productslist->image;?>"/>
                        <input type="hidden" name="probname" value="<?php echo $productslist->prodtitle;?>"/>
                        <input type="hidden" name="catid" value="<?php echo $category->scid; ?>"/>  
<!--                        <input type="submit" value="Add to Cart" name="submit" onclick="addtocart();" >
-->                        <input type="hidden" name="url" value="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$_GET['spid'])?>">
                        <input type="button" name="button" onclick="addtocart();" value="Add To Cart" >
                   </li>
                 </ul>
                 
                 </form>
                 
                 <script>
				 function addtocart()
				 {   
				 //ssecho "hai";  
					    var spid="<?=$_GET['spid']?>";
					   var pimg="<?php echo $productslist->image;?>";
					   var probname="<?php echo $productslist->prodtitle;?>";
					   var catid="<?php echo $category->scid;?>";
					  
					
					   var url="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$_GET['spid'])?>";
					   var price=document.getElementById('price').value;
					   var price2=document.getElementById('price2').value;
					   var qun=document.getElementById('qun').value;
					   //alert(cont_mg)
					   var bottle_size=document.getElementById('bottle_size').value;
					   if(catid==1)
					  {
					  var cont_mg=document.getElementById('cont_mg').value;
					   var finish=document.getElementById('finish').value;
					  }
					  else{
						  
						  var cont_mg="";
						  var finish="";
						  }
					  
					   //var vcolor=document.getElementById('vcolor').value;
					   
					   //if($category->scid
					   //alert(finish)
					   var weight=document.getElementById('weight').value;
					   
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
							document.getElementById("sarat").innerHTML=xmlhttp.responseText;
							}
						  }
						  				      // alert(price2);

					xmlhttp.open("GET","<?=SITEURL?>/ajax_cart.php?spid="+spid+" & pimg="+pimg+" & probname="+probname+" & catid="+catid+" & price="+price+" & price2="+price2+" & qun="+qun+" & cont_mg="+cont_mg+" & bottle_size="+bottle_size+" & finish="+finish+" & weight="+weight,true);
						xmlhttp.send();

					 }
					 
				 </script>
                  <div class="clear_fix"></div>
                 
               </div>
               <div class="clear_fix"></div>
            </div>
          </div>
           <div class="clear_fix"></div>
      <!--End discrpitionpart-->


<script type="text/javascript">

size=document.getElementById('bottle_size').value;
 window.onload = function() {
  showUser(size);
};

function showUser(size) {
	//alert(size);
	var spid="<?=$_GET['spid'];?>";
	//alert(spid);
  if (size=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200) {
    // document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
	var val = xmlhttp.responseText;
	var quan = $('#qun').val();
	
	if(quan!=''){
		val  = val*quan;
	}
     $('#txtHint').html("$"+val);
	document.getElementById("price").value=val;
	document.getElementById("price2").value=xmlhttp.responseText;
    }
  }
  //alert(size);
  xmlhttp.open("GET","<?=SITEURL?>/ajax_get.php?q="+size+"&quan="+spid,true);
  xmlhttp.send();
}

function User(id){
	var val = $('#price2').val();

	if(val!=''){
		val  = val*id;
		dollarvalue="$"+" "+val.toFixed(2);
		 
		//alert(dollarvalue);
	}
     $('#txtHint').html(dollarvalue);
	sart=document.getElementById("price").value=val.toFixed(2);
	
}
</script>
         <!--reviewsblog-->
         <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
            <h2>Reviews</h2>
            
            <?php
			
			
			
			 $query="select * from tb_commentsection where pid='".$_GET['spid']."' and status='Active'";
			 $res=mysql_query($query);
			 
			 $cnt=mysql_num_rows($res);
			 
			 //print_r($cnt);
			 
			 
			//echo $cnt=mysql_fetch_array($res);
			
			//print_r($cnt);
			if($cnt>0)
			{
			while($row=mysql_fetch_array($res))
			{
			
			?>
            
            
            <p>
             <?php echo $row['review']; ?>
            </p>
            <div class="loernhover">
             <a href="#">-  <?php echo $row['name']; ?> </a>
            </div>
            <?php }} else { ?>  <div class="h2small">No Reviews Posted</div> <?php } ?>
            
            <br/>
            <ul class="disfolis">
      <li><a href="<?=SITEURL?>/comments.php?id=<?php echo $_GET['spid']; ?>"><input type="submit" Value="Add Customer Review"></a></li>
      
      </ul>

          </div>

        </div>
        
            <div class="clear_fix"></div>
         <!--End reviewsblog-->
    <!--innerpagepart-->
       <div class="full_wrapper innerpart">
         <div class="site_container">
            <h3>Similar Products</h3>
                            <h3 style="color:green" id="sarat1"></h3>

            <div class="concomimg">
              <ul class="feturedprolis">
			 			  
			  <?php  if(count($simproductslistnew)>0){
			  foreach($simproductslist   as $featured){
				 $queryvalue="select MIN(real_price) as real_price,id,size,weight from tb_store_value where spid=".$featured->spid;
					  $minimumvalues= $callConfig->getRow($queryvalue);
                
			  ?>
              
                            			<form name="featuredproducts" method="post">

           <li>
           
			  <!--<a href="product_discription.php?spid=<?php echo $featured->spid;?>">--> 
              
               <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$featured->spid)?>">
              
			   <img src="<?=SITEURL?>/uploads/store/products/<?php echo $featured->image; ?>" alt="" class="res_images" ></a>
    <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$featured->spid)?>"><h5><?php echo $featured->prodtitle; ?></h5> </a>
               <div class="matocl">
                <span style="float:left;">
                <a href="javascript:void(0);"><img src="<?=SITEURL?>/images/cartround_55.png" onclick="addtocart1('<?php echo $featured->spid;?>','<?php echo $featured->image;?>','<?php echo $featured->prodtitle;?>','<?php echo $featured->scid; ?>','<?php echo $minimumvalues->size; ?>','<?php echo $minimumvalues->real_price; ?>','<?php echo $minimumvalues->real_price*1; ?>','<?=$minimumvalues->weight;?>');" alt=""></a>
               <?php /*?>  <input type="hidden" value="Add to Cartvalues" name="submit">
                <input type="image" src="<?=SITEURL?>/images/cartround_55.png" name="submit">
               <?php */?>
                </span><span style="float:left; padding-left:15px; margin-top:5px;"><h3>$<?php echo  number_format($minimumvalues->real_price,2); ?></h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
             
             <input type="hidden" name="weights" id="weights" value="<?=$minimumvalues->weight;?>" />

              <input type="hidden" name="spd" id="spd1" value="<?php echo $featured->spid;?>"/>
                        <input type="hidden" name="pimg" id="pimg1" value="<?php echo $featured->image;?>"/>
                        <input type="hidden" name="probname" id="pimg1" value="<?php echo $featured->prodtitle;?>"/>
                        <input type="hidden" name="catid" id="catid1" value="<?php echo $featured->scid; ?>"/>  
                        <input type="hidden" name="bottle_size" id="bottle_size1" value="<?php echo $minimumvalues->size; ?>"/>  
                         <input type="hidden" name="prod_id" id="prod_id1" value="<?php echo $featured->spid; ?>"/>  

                         <input type="hidden" name="product_type" id="product_type1" value="direct"/>  

                        <input type="hidden" name="price2" id="price21" value="<?php echo $minimumvalues->real_price; ?>"/>  
                        <input type="hidden" name="price" id="price1" value="<?php echo $minimumvalues->real_price*1; ?>"/>  

                        <input type="hidden" name="qun" id="qun1" value="1"/>  
                        
                        <input type="hidden" name="cont_mg" id="cont_mg1" value=""/>  
                                             </form> 
			<?php  }} ?>
            
             <script>
				 function addtocart1(spid,pimg,probname,catid,bottle_size,price2,price,weight)
				 {     
                       var url="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$_GET['spid'])?>";
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
       </div>
       <div class="clear_fix"></div> 
            <!-- <li>
               <a href="#"><img src="images/products_36.jpg" alt="" class="res_images"></a>
               <h5>Strawberry Mango</h5>
               <div class="matocl">
                <span style="float:left;"><a href="#"><img src="images/cartround_55.png" alt=""></a></span> <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$10.99</h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
              <li>
               <a href="#"><img src="images/products_38.jpg" alt="" class="res_images"></a>
               <h5>Sour Kids Watermelon</h5>
               <div class="matocl">
                <span style="float:left;"><a href="#"><img src="images/cartround_55.png" alt=""></a></span> <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$10.99</h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
              <li>
               <a href="#"><img src="images/products_40.jpg" alt="" class="res_images"></a>
               <h5>Smokey Caramel</h5>
               <div class="matocl">
                <span style="float:left;"><a href="#"><img src="images/cartround_55.png" alt=""></a></span> <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$10.99</h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
             <li>
               <a href="#"><img src="images/products_42.jpg" alt="" class="res_images"></a>
               <h5>Hawaiian Drink</h5>
               <div class="matocl">
                <span style="float:left;"><a href="#"><img src="images/cartround_55.png" alt=""></a></span> <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$10.99</h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
              <li>
               <a href="#"><img src="images/products_44.jpg" alt="" class="res_images"></a>
               <h5>Strawberry Mango </h5>
               <div class="matocl">
                <span style="float:left;"><a href="#"><img src="images/cartround_55.png" alt=""></a></span> <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$10.99</h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
              <li>
               <a href="#"><img src="images/products_46.jpg" alt="" class="res_images"></a>
               <h5>Sour Kids Watermelon</h5>
               <div class="matocl">
                <span style="float:left;"><a href="#"><img src="images/cartround_55.png" alt=""></a></span> <span style="float:left; padding-left:15px; margin-top:5px;"><h3>$10.99</h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
                          
            </ul>
              
              <div class="clear_fix"></div> 
            </div>
            
         </div>
       </div>
       <div class="clear_fix"></div> -->
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php include("includes/clintblog.php")?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
  <?php include("includes/footer.php")?>