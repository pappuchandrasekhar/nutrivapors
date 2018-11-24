<?php 
//error_reporting(1);
include("includes/header.php");


if($_POST['submit']=="Submit")
{
	
	
	
	$products1=$_POST['products'];
	
	
	
	//print_r($products1);
	
	$values =implode('   ,   ', $products1);
	
	//print_r ($values);exit;
	
	//echo  "<br/>---------------------------------<br/>"; 
	//print_r($_POST);exit;
	
	
	//$values = explode(',', $products1);
	//print_r($products1);exit;
	
	
	//if( is_array($products1)){
//while (list ($key, $val) = each ($products1)) {
// "$val <br>"; 




//$products1=$_POST['products'];

//if ($products1)
//{
//    foreach ($products1 as $value)
//    {
//        echo $shiftarraycalc[]=$value;exit;
//		//print_r($shiftarraycalc[]);
//    }
//}

	$cbarray = $_POST['check1'];
	$cbarray2 = $_POST['check2'];
	
	//print_r($cbarray);exit;
	
	$check1=implode(',',$cbarray);
    $check2=implode(',',$cbarray2);
	
	//echo $products1;exit;
	
	
						 $sel="Select * from tb_sitesettings";
						$rs=$callConfig->getRow($sel);
						$to=$rs->bulkcontactusmail;
						$subject = 'Bulk Order :: Nutrivapors';
						$message="<table cellspacing='0' cellpadding='5'  align='center' width='100%' border='0' style='border:1px solid #CCCCCC; border-collapse:collapse; 	font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;'>
			  <tr>
			  <td colspan='2' align='left' valign='top' style='background-color:#002868'><img src='http://aswin/nutrivapors/images/sitelogo_04.png' width='180' height='55'/></td>
			
			  </tr>
						  <td width='15%' height='23' align='left' valign='middle' colspan=2 ><strong>Bulk Order Information:</strong></td>
						</tr>
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Name:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['name']."</td>
						</tr>
					
					   	<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Company:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['company']."</td>
						</tr>
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Email:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['email']."</td>
						</tr>
												
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Phone:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['phone']."</td>
						</tr>	
						
						
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Products:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$values."</td>
						</tr>		
					
						
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Vial Size:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$check1."</td>
						</tr>		
						
												
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Check All Apply:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$check2."</td>
						</tr>		
						
						
						
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Quantity:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['quantity']."</td>
						</tr>		
						
						
						<tr>
						  <td width='15%' height='23' align='left' valign='middle'><strong>Message:</strong></td>
						  <td width='32%' height='23' align='left' valign='middle'>".$_POST['message']."</td>
						</tr>		
						
											
						  </table></td>
					  
				  </tr>
				  <tr>
					<td valign='top' colspan='2' align='left'>&nbsp;</td>
				  </tr>
				  <tr>
					<td valign='top' colspan='2' align='left'>&nbsp;</td>
				  </tr>
				 
				  <tr>
					<td valign='top' colspan='2' align='left'>Thank You<br />
					</tr>
					<tr>
					<td valign='top' colspan='2' align='left'>".$_POST['name']."</td>
				  </tr>
				</table>";
				
					  //echo $message; exit;
					
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					    $headers .= 'From:'.$_POST['email']. "\r\n";
						 $ok=mail($to, $subject, $message, $headers);
						
			if($ok!='')
			{
				
				header("Location:bulkorderpage.php?msg=Thanks for your comments");
			}
			else
			{
				header("Location:bulkorderpage.php?msg=Failed to send your contact information.Please try after 5 mints..");
			}

}




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
	
 var first_name=document.form1.first_name.value;
 if(first_name=='')
 {
	alert('Please enter your first name');
	document.form1.first_name.focus();
	return false;
 }
	
 	
	var lastname=document.form1.lastname.value;
 if(lastname=='')
 {
	alert('Please enter your last name');
	document.form1.lastname.focus();
	return false;
 }
	

var username=document.form1.username.value;
 if(username=='')
 {
	alert('Please enter your username');
	document.form1.username.focus();
	return false;
 }



	var emailRegEx = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
 	var email1=document.form1.email_address.value;
 if(!document.forms["form1"]["email_address"].value.match(emailRegEx))
 {
	alert('Please enter valid Email address.');
	document.form1.email_address.focus();
	return false;
 }
/*
var data=$("#email_check_value").val();
//alert(data);
if(data==1)
{
	document.getElementById('msgdiv_email').innerHTML='Email Already Registered.Please Login with another emailid';
	document.form1.email_address.focus();
	
	
	return false;
}
else
{
	document.getElementById('msgdiv_email').innerHTML='';
}*/
	var password=document.form1.password.value;
	if(password=='')
	{
	alert("please enter  password");
	document.form1.password.focus();
	return false;
	}
	
	var confpassword=document.form1.confpassword.value;
	if(confpassword=='')
	{
	alert("please enter confirm password");
	document.form1.confpassword.focus();
	return false;
	}
	
	 var genderM=document.form1.gender.value;
   

    if(genderM=='')
       {
            alert("You must select male or female");
            return false;
       }   
 
	
	var age=document.form1.age.value;
   

    if(age=='')
       {
            alert("You must select your age");
            return false;
       }   
 
	
	return true;
}



</script>

        <link rel='stylesheet' id='camera-css'  href='js/camera_silde/camera.css' type='text/css' media='all'> 
		<link type="text/css" rel="stylesheet" href="style.css">
        <script type='text/javascript' src='js/camera_silde/jquery.min.js'></script>
        <script type='text/javascript' src='js/camera_silde/jquery.mobile.customized.min.js'></script>
        <script type='text/javascript' src='js/camera_silde/jquery.easing.1.3.js'></script> 
        <script type='text/javascript' src='js/camera_silde/camera.min.js'></script> 
        <script>
			jQuery(function(){
			
				jQuery('#camera_wrap_1').camera({
				height: '487px',
				
				thumbnails: true
				});
				
				
			});
        </script>


  <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="images/aboutarow_03.png" alt=""></li>
                 <li><a href="<?=SITEURL?>/register.html">Bulk Order</a></li>
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div>
     <!--End bedgromms part-->
   
    <!--innerpagepart-->
       <div class="full_wrapper innerpart">
         <div class="site_container">
            <div class="concomimg">
              <div class="rigleft">
                    <h2>Bulk Order  (Customer Bulk Order)</h2>
					<form name="form1" id="form1" method="post" action="" onsubmit="return validate()">
                    <ul class="rigilis">
                      <li>
                       <span>Name:</span><input type="text" name="name" id="name" required="required" >
                      </li>
                      <li>
                       <span>Company:</span><input type="text" name="company" id="company">
                      </li>
                       <li>
                       <span> Email :</span><input type="text" name="email" id="email" required="required" >
                      </li>
                       <li>
                       <span>Phone:</span><input type="text" required name="phone" id="phone">
                      </li>
                      <li>
                       <span>Products:</span><select name="products[]"  id="products[]" multiple="multiple" value=""  style="background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    border: 1px solid #b0b0b0;
    border-radius: 10px;
    height: 40px;
    margin-top: 5px;
    padding: 0 10px;
    width: 70%;
    height:200px;">
    
    <?php
	$query="select * from tb_store_products order by spid DESC";
	$res=mysql_query($query);
	//$cnt=mysql_num_rows($res);

	while($row99=mysql_fetch_array($res))
	
	{
	
	?>
					   
                       <option value="<?php echo $row99['prodtitle'];?>"><?php echo $row99['prodtitle'];?> </option>
                       
                       
                       <?php } ?>
					  
					   </select>
                      </li>
                      <li>
                       <span>Vial Size:</span><input type="checkbox" name="check1[]"  value="10ml">10ml 
                     <!--<input type="checkbox" name="check1[]"  value="20ml">20ml-->
                     <input type="checkbox" name="check1[]"  value="30ml">30ml
<!--                     <input type="checkbox" name="check1[]"  value="40ml">40ml
-->                     
                      </li>
                      <li>
                      
                      
                      
                      <!--<li>
                       <span>Check all the apply:</span><input type="checkbox"   value="10ml">10ml 
                     <input type="checkbox" name="check2[]"  value="20ml">20ml
                     <input type="checkbox" name="check2[]"  value="30ml">30ml
                     <input type="checkbox" name="check2[]"  value="40ml">40ml
                     
                      </li>-->
                      
                      <li>
                       <span>Qunatity:</span><input type="text" name="quantity" id="quantity">
                      </li>
                      
                      <li>
                      
                       <li>
				  <span>Message:</span>
				  <textarea name="message" id="message" ></textarea>
				  </li>
                      
                      
                      
                       
                      <li>
                     <input type="submit" name="submit" value="Submit" style="margin-left:119px;">
                   </li> 
                      
                      
                    </ul></form>
                    <div class="clear_fix"></div>
              </div>
               <div class="rigright">
               <a href="#"> <img src="images/bulk2.png" alt="" class="res_images"></a>
               </div>
              <div class="clear_fix"></div> 
            </div>
            
         </div>
       </div>
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php include("includes/clintblog.php")
  
   ?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->


<?php 

include("includes/footer.php")?>