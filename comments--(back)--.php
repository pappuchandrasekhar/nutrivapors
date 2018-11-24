<?php include "includes/header.php";
$products="select * from tb_store_products where spid=".$_GET['spid']." ";
$productslist= $callConfig->getRow($products);
$productslistnew= $callConfig->getcount($products);

$query="select * from tb_store_category where scid=".$productslist->scid;
$category= $callConfig->getRow($query);
//echo $category->scid;
$prodctvalue="select * from tb_store_value  where  spid=".$_GET['spid']." order by  size ASC";
$valuelist=$callConfig->getALLRows($prodctvalue);


$similarproducts="select * from tb_store_products where scid=".$productslist->scid." order by 'spid' DESC LIMIT 0,6";
$simproductslist= $callConfig->getAllRows($similarproducts);
$simproductslistnew= $callConfig->getcount($similarproducts);


//include("model/user.class.php");
	 

//if($_POST['submit']=="Register")
//{
//    //print_r($_POST); exit;
//userClass::userComments($_POST);
//		
//}
//
//if($_GET['id']!='')
//	
//	{
//
//
// $url=trim(str_replace('.htm',' ',$_REQUEST['id']));
//
//		$sel_prd="select * from tb_store_products where spid='".$_GET['id']."'";
//		//$content=$callConfig->getRow($sel);
//		
//
//   // $sel_prd="select * from tb_store_products where spid=".$_GET['id'];
//    $rs_prd=$callConfig->getRow($sel_prd);
//	
//	 /*$pid=$rs_prd->sscid;
//	 $pid2=$rs_prd->scid;
//		 
//		 
//		 
//	     
//		 
//		 $sel5="select * from tb_store_category where scid='".$pid2."'";
//		 $rs_Cat5=$callConfig->getRow($sel5);
//		 
//	     $sel4="select * from tb_store_subcategory where sscid='".$pid."'";
//		 $rs_Cat2=$callConfig->getRow($sel4);
//	*/
//	
//	}



?>
<script src="js/jquery.js"></script>
<script>

function checkingEmailUnique(eid)
{
	//alert(email_address);
	jQuery.ajax({
		type: "POST",
		url: "jquery_ajax_check_controls.php",
		data: "q="+eid,
		success: function(msg){
			//alert(data);
			$("#email_check_value").val(msg);
		}
	});
}


function validate()
{
	
 <?php /*?>var name=document.form1.f_name.value;
 if(name=='')
 {
	alert('Please enter your Name');
	document.form1.f_name.focus();
	return false;
 }<?php */?>
	
 	
	

	var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 	var email1=document.form1.email_address.value;
 if(!document.forms["form1"]["email_address"].value.match(emailRegEx))
 {
	alert('Please enter valid Email address.');
	document.form1.email_address.focus();
	return false;
 }




	<?php /*?>var loc=document.form1.location.value;
	if(loc=='')
	{
	alert("please enter  your location");
	document.form1.location.focus();
	return false;
	}
	<?php */?>
	
	
var ratng=document.form1.rating.value;
 if(ratng=='')
 {
	alert('Please select your rating');
	document.form1.rating.focus();
	return false;
 }
	
 var rvtit=document.form1.reviewtitle.value;
 if(rvtit=='')
 {
	alert('Please enter Review Title');
	document.form1.reviewtitle.focus();
	return false;
 }
	
	
	var rev=document.form1.review.value;
	if(rev=="")
	{
		alert("please  enter your  review");
		document.form1.review.focus();
		return false;
	}
	
	
	return true;
}
</script>





<div class="inner_content">
<div class="middle_inner">


<div class="baner_part" >
  <h1 style="margin-left:230px;margin-top:10px;">Other information regarding this product</h1>

<div class="left_aplproduct">
                 <div>
                  <a href="#"> <img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image;?>" alt="" class="res_images"></a>
                 </div>
                 <ul class="left_dislis">
                   <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image1;?>" alt="" class="res_images" style="width:74px; height:73px;"></a></li>
                    <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image2;?>" alt=""  class="res_images" style="width:74px; height:73px;"></a></li>
                     <li><a href="#"><img src="<?=SITEURL?>/uploads/store/products/<?php echo $productslist->image3;?>" alt=""  class="res_images" style="width:74px; height:73px;"></a></li>
                 </ul>
                 <div class="clear_fix"></div>
               </div>
<!--<div class="loginleft">
                    <h2>Contact Us</h2>
					<form name="form1" id="contact" method="post" action="" onsubmit="return validate()">
                  <ul class="loglis">
                   <li>
                     <div>Your Name(required):</div>
                     <input type="text" name="name">
                   </li>
                   <li>
                     <div>Your Email (required):</div>
                     <input type="text" name="email_address">
                   </li>
                     <li>
                     <div>Subject:</div>
                     <input type="text" name="subject">
                   </li>
                  
				  <li>
				  <div>Message:</div>
				  <textarea name="message" ></textarea>
				  </li>
                  
                  <li>
                  <div>Captcha Code:</div>
                  <input type="text" name="captchacode" />
                  </li>
				  <li>
                       <div style="width: 226px; float: left; height: 80px;padding: 5px;
background-color: #ffffff;border: #e6e6e6 solid 2px;-webkit-border-radius: 10px;-moz-border-radius: 10px; border-radius: 10px;">
      <img id="siimage" align="left" style="padding-right: 5px; border: 0; margin-top:-9px; )" src="captach/securimage_show.php?sid=<?php echo md5(time()) ?>" />
      </div>
 <a tabindex="-1" style="border-style: none" href="#" title="Refresh Image" onClick="document.getElementById('siimage').src = 'captach/securimage_show.php?sid=' + Math.random(); return false"><img src="captach/refresh.gif" alt="Reload Image" border="0" onClick="this.blur()" align="bottom" /></a>
                       
                       </li>
                    <li>
                     <input type="submit" name="submit" value="Send">
                   </li>
                  </ul>
                  </form>
              </div>-->













<!--<div style="border:0px solid red;margin-top:15px;margin-right:0px; ">


<table width="681" border="0" cellspacing="0" cellpadding="0"  style="border:0px solid red;padding-right:250px;">
 
 
  <tr height="35">
    <td  align="left"><font style="font-size:16px;width:50px">ProductName:</font>&nbsp;</td>
 <td style="width:400px;"> <font style="font-size:15px"><?php  echo stripslashes($rs_prd->prodtitle);?></font></td>
  </tr>
  
  
  
 
 <?php /*?> <tr height="35">
    <td align="middle" ><font style="font-size:16px;width:30px;">&nbsp;&nbsp;&nbsp;&nbsp;collar:</font>&nbsp;&nbsp;&nbsp;</td>
   <td style="width:150px;"> <font style="font-size:15px"><?php  echo stripslashes($rs_prd->collar);?></font>
    </td>
   <td>
								
  					
   </tr><?php */?>
			
  <tr height="35">
    <td align="middle"><font style="font-size:16px;width:100px;margin-left:30px;">&nbsp;Closure :</font></td>
    
    
   <td style="width:400px;"> <font style="font-size:15px"><?php  echo stripslashes($rs_prd->closure);?></font>
    
    </td>
   
  </tr>
  
  
 <tr height="35">
    <td align="middle"><font style="font-size:16px;width:100px;margin-left:30px;">&nbsp;&nbsp;Fabric :</font></td>
   <td style="width:400px;"><font style="font-size:15px"> <?php  echo stripslashes($rs_prd->fabric);?></font>
    </td>
    
  </tr>
  
  
  <tr height="35" >
    <td align="middle" ><font style="font-size:16px;margin-left:30px;">&nbsp;&nbsp;Care :</font> </td>
    
   <td style="width:400px;"><font style="font-size:15px"> <?php  echo stripslashes($rs_prd->care);?></font></td>
  
  
  </tr>
  
  
  
  
  <?php /*?><tr height="35">
    <td align="middle" ><font style="font-size:16px">length:</font>&nbsp;&nbsp;&nbsp;</td>
     <td style="width:150px;"><font style="font-size:15px"><?php  echo stripslashes($rs_prd->length);?></font>
    </td>
    <td></td>
  </tr><?php */?>
  
  
  
  
  <tr height="35">
    <td align="middle" ><font style="font-size:16px;margin-left:28px;">Pocket :</font></td>
    <td style="width:400px;"><font style="font-size:15px"> <?php  echo stripslashes($rs_prd->pocket);?></font>
    </td>
    <td></td>
  </tr>
  
  
  <?php /*?> <tr height="35">
    <td align="middle" ><font style="font-size:16px">&nbsp;&nbsp;&nbsp;cuff:</font>&nbsp;</td>
    <td style="width:150px;"> <font style="font-size:15px"><?php  echo stripslashes($rs_prd->cuff);?></font>
    </td>
    <td></td>
  </tr><?php */?>
  
  
  
    <tr height="35">
    <td></td>
    <td>
    
   <?php /*?> <input type="button" value="Register" class="submit" name="sub"/><?php */?>
    
    
   <?php /*?> <input type="hidden" id="submit" value="Register" name="submit" >
<input type="image" src="images/button_03.png" value="Register" name="submit"  class="submit" style="margin-top:10px;"><?php */?>
    
    
    </td>
  </tr>
  
  
  
</table>
</div>-->

<div class="boline">
                  </div>

<div style="margin-top:10px;">
                   <div class="discriptiontext">
                     Description:
                   </div>
                   
                   <?php 
				   
				   
				   $query="select * from tb_store_products where spid='".$_GET['id']."'";
				   $res=mysql_query($query);
				   $row=mysql_fetch_array($res);
				   
				   ?>
                   
                   
                  <p>
                   <?php echo  $row['bigtext'];?>
                  </p>
                 </div>
                 <form name="productlist" id="productlist" method="post" >
                 <ul class="disfolis">
                   <li>
                   <span><?php echo $row['prodtitle']; ?></span>
                   </li>
                   
                   
                   <li>
                    <span>Price</span>
                        <div id="txtHint">NO Price</div>
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
        <input type="hidden" name="catid" value="<?php echo $category->scid; ?>"/>  
                        
                   </li>
                 </ul>
                 
                 </form>

<div>

<h1 style="margin-left:229px;margin-top:20px;">Customer Review Form</h1>


<form name="form1" method="post" action="" id="form1" onSubmit="return validate()">

<table width="500" border="0" cellspacing="0" cellpadding="0" class="tabs" style="border:3px solid #b5b5b5;margin-left:250px;margin-top:20px; ">
 
 
 
  <?php /*?><tr height="35">
    <td align="right">Product Name<span style="color:#FF0000;">*</span> :&nbsp;&nbsp;&nbsp;</td>
   <td ><input type="text" class="input_id" name="f_name" id="f_name" /></td>
  </tr>
  <?php */?>
  
  
   <tr height="35">
    <td align="right">Name:&nbsp;&nbsp;&nbsp;</td>
   <td ><input type="text" class="input_id" name="f_name" id="f_name" /></td>
  </tr>
 
  <tr height="35">
    <td align="right">Your Email<span style="color:#FF0000;">*</span> :&nbsp;&nbsp;&nbsp;</td>
   <td><input type="text" class="input_id" name="email_address" id="email_address" onChange="checkingEmailUnique(this.value);" />
   
	<br/>
    							
  					
   </tr>
			
 <?php /*?> <tr height="35">
    <td align="right">Your Location:&nbsp;&nbsp;&nbsp;</td>
    <td><input type="text" class="input_id" name="location" id="location"/></td>
  </tr>
  <?php */?>
  
  
  <tr height="35">
    <td align="right">Rating<span style="color:#FF0000;">*</span> :&nbsp;&nbsp;&nbsp;</td>
   <td>
   
   <select class="selct" name="rating" style="width:140px;">

<option value="">---Select Rating---</option>
<option value="1">1star</option>
<option value="2">2star</option>
<option value="3">3star</option>
<option value="4">4star</option>
<option value="5">5star</option>



</select>

</td>

  
  
  </tr>
  <tr height="110">
    <td align="right" valign="middle" >Review<span style="color:#FF0000;">*</span> :&nbsp;&nbsp;&nbsp;</td>
    <td><textarea class="area" name="review" id="review" style="margin-top:10px;width:300px;"></textarea></td>
  </tr>
    <tr height="35">
    <td></td>
    <td style="padding-bottom:30px;">
    
   <?php /*?> <input type="button" value="Register" class="submit" name="sub"/><?php */?>
    <input type="hidden" name="prodid" value="<?=$rs_prd->spid?>">
    
    <input type="hidden" id="submit" value="Register" name="submit" >
<input type="image" src="images/button_03.png" value="Register" name="submit"  class="submit" style="margin-top:10px;width:60px;">
    
    
    </td>
    
   
    
    
  </tr>
  
  
 
  
 
</table>

</form>


</div>

</div><!--baner part-->



</div><!--middle inner-->

</div>

<div class="inner_down">

<div class="mid_one">
  <!--total mid-->
  <!--innercontent two-->

<div class="innershadowtwo"></div>

<?php include "includes/footer.php";?> 


</div><!--mid one-->


</div><!--inner down-->



</div><!--wraper-->
</body>
</html>
