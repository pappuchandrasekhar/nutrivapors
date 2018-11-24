<?php
 include("includes/header.php");
 //include("model/cart.class.php");
 //$cartobj= new cartClass;
 
 
 $products="select * from tb_store_products where spid=".$_GET['id']." ";
$productslist= $callConfig->getRow($products);
$productslistnew= $callConfig->getcount($products);

$query="select * from tb_store_category where scid=".$productslist->scid;
$category= $callConfig->getRow($query);
//echo $category->scid;
  $prodctvalue="select *  from tb_store_value  where  spid=".$_GET['id']." order by  size ASC";
 
 $query=mysql_query($prodctvalue);
 
 $value=mysql_fetch_array($query);
 
 //print_r( $value);
 
//$valuelist=$callConfig->getALLRows($prodctvalue);


 $similarproducts="select * from tb_store_products where scid=".$productslist->scid." order by 'spid' DESC LIMIT 0,6";
$simproductslist= $callConfig->getAllRows($similarproducts);
$simproductslistnew= $callConfig->getcount($similarproducts);




if($_POST['submit']=="Send")
{
	
	$name=$_POST['name'];
	$email=$_POST['email'];  
	$rating= $_POST['rating'];  
	$review=$_POST['review'];  
	      
	 $query="insert into tb_commentsection(name,email,rating,review,status,pid) values('".$name."','".$email."','".$rating."','".$review."','Inactive','".$_POST['productid']."')";
	$query=mysql_query($query);
	
}




?>
   
     <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="<?=SITEURL?>/images/aboutarow_03.png" alt=""></li>
                 
                 <li>Customer Review</li>
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div>
     <!--End bedgromms part-->
      <!--discrpitionpart-->
      
      
        <?php 
				   
				   
				   $query="select * from tb_store_products where spid='".$_GET['id']."'";
				   $res=mysql_query($query);
				   $row=mysql_fetch_array($res);
				   
				   ?>
      
          <div class="full_wrapper innerpart">
            <div class="site_container"> 
               <div class="left_aplproduct">
                 <div>
                  <a href="#"> <img src="<?=SITEURL?>/uploads/store/products/<?php echo $row['image'];?>" alt="" class="res_images" style="width:300px;height:250px;"></a>
                 </div>
                 <!--<ul class="left_dislis">
                   <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image1;?>" alt="" class="res_images" style="width:74px; height:73px;"></a></li>
                    <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image2;?>" alt=""  class="res_images" style="width:74px; height:73px;"></a></li>
                     <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image3;?>" alt=""  class="res_images" style="width:74px; height:73px;"></a></li>
                 </ul>-->
                 <div class="clear_fix"></div>
               </div>
               <div class="prodiscriptrigt">
               
                  <div>
                    <div class="disapleft">
                      <div style="margin-top:50px;">
                      <h2><?php echo $row['prodtitle'];?></h2>
                      </div>
                    </div>
                    <div class="disapright"> 
                       <div>
                       </div>
                       <div style="margin-top:5px;">
                        <!--(1 review)-->
                       </div>
                       <div style="margin-top:8px;">
                       
                       <!--<a href="productpage.php?id=<?php echo $productslist->scid;?>">-->
                       
                       
                       
                         <a href=" <?=SITEURL?>/<?=seoClass::fURL('productpage.php?id='.$productslist->scid)?>"><img src="<?=SITEURL?>/images/backbtn_03.jpg" alt=""></a>
                        <!-- <a href="#"><img src="<?=SITEURL?>/images/smsoicons_06.jpg" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/smsoicons_08.jpg" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/smsoicons_10.jpg" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/smsoicons_12.jpg" alt=""></a>-->
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
                   <?php echo $row['bigtext']; ?>
                  </p>
                 </div>
                 <form name="productlist" id="productlist" method="post">
                 <ul class="disfolis">
                   
                   
                   
                   <li>
                    <!--<span>Price</span>
                        <div id="txtHint">NO Price</div>-->
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
                   <input type="hidden" name="spd" id="spd" value="<?php echo  $_GET['spid']?>"/>
                        <input type="hidden" name="pimg" value="<?php echo $productslist->image;?>"/>
                        <input type="hidden" name="probname" value="<?php echo $productslist->prodtitle;?>"/>
                        <!--<input type="hidden" name="catid" value="<?php echo $category->scid; ?>"/>  
                        <input type="submit" value="Add to Cart" name="submit" >-->
                   </li>
                 </ul>
                 
                 </form>
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
          
                <div class="loginleft">
                
           <h1 >Customer Review Form</h1>
           
            <form name="form1" id="contact" method="post" action="" onsubmit="return validate()">
                  <ul class="loglis">
                   <li>
                     <div>Name</div>
                     <input type="text" name="name" id="name">
                   </li>
                   <li>
                     <div>Your Email</div>
                     <input type="text" name="email" id="email">
                   </li>
                   
                   <input type="hidden" name="productid" value="<?php echo $_GET['id'];?>" />
                     <li>
                    <div>Rating</div>
                      <select class="sekhar" name="rating" >

<option value="">---Select Rating---</option>
<option value="1">1star</option>
<option value="2">2star</option>
<option value="3">3star</option>
<option value="4">4star</option>
<option value="5">5star</option>



</select>

                   </li>
                  
				  <li>
				  <div>Review:</div>
				  <textarea class="area" name="review" id="review" style="margin-top:10px;width:428px;"></textarea>
				  </li>
                  
                  
				  
                    <li>
                     <input type="submit" name="submit" value="Send">
                   </li>
                  </ul>
                  </center>
                  </form>
                  
                  </div>

          </div>

        </div>
        
            <div class="clear_fix"></div>
         <!--End reviewsblog-->
    <!--innerpagepart-->
       <div class="full_wrapper innerpart">
         <div class="site_container">
            <h3>Similar Products</h3>
            
            <div class="concomimg">
              <ul class="feturedprolis">
			  
			  
			  
			  <?php  if(count($simproductslistnew)>0){
			  foreach($simproductslist   as $featured){
			  ?>
           <li>
           
			  <!--<a href="product_discription.php?spid=<?php echo $featured->spid;?>">--> 
              
               <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$featured->spid)?>">
              
			   <img src="<?=SITEURL?>/uploads/store/products/<?php echo $featured->image; ?>" alt="" class="res_images" ></a>
            <a href="<?=SITEURL?>/<?=seoClass::fURL('product_discription.php?spid='.$featured->spid)?>"> <h5><?php echo $featured->prodtitle; ?></h5> </a>
               <div class="matocl">
                <span style="float:left;"><a href="#"><img src="<?=SITEURL?>/images/cartround_55.png" alt=""></a></span><span style="float:left; padding-left:15px; margin-top:5px;"><h3>$<?php echo  $value['real_price'] ?></h3></span>
                <div class="clear_fix"></div> 
               </div>
             </li>
             
			<?php  }} ?>
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