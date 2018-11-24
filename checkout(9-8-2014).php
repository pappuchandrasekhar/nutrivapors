<?php
 include("includes/header.php");
 
 
 $getuserdata=$bannerObj->getuserdata($_SESSION['frnt_mid']);
 print_r($getuserdata);
	if($_SESSION['frnt_mid']!='')
	{	
	
	   	$uquery="select * from tb_users_info where user_id='".$_SESSION['frnt_mid']."'";	  
		$ugetdat=$callConfig->getRow($uquery);
		
	  //$uquery="select * from tb_state where id='".$ugetdat->state."'";	  
//		$statedat=$callConfig->getRow($uquery);
//		
//		$uquery="select * from tb_city where id='".$ugetdat->city."'";	  
//		$citydat=$callConfig->getRow($uquery); 
//		
//		$uquery="select * from tb_countries where id='".$ugetdat->country."'";	  
//		$countrydat=$callConfig->getRow($uquery);
		
		$bquery="select * from tb_user_billingaddress where user_id='".$_SESSION['frnt_mid']."'";
		$userbilldata=$callConfig->getRow($bquery);	
	}
	else
	{
		$guestbill="select * from tb_guestubillingaddress order by id DESC LIMIT 0,1";
		$ugetdat=$callConfig->getRow($guestbill);
	}
	$cartproducts=cartClass::getindcart();
	//print_r($cartproducts); 
	$discountchance=cartClass::couponEntryChance();

 
 
?>

<script> 

$(document).ready(function(){
	
		$("#flip0").click(function(){
			//alert("d");
	$("#div0").slideToggle("slow");
	$(".clekedform").not("#div0").slideUp('slow');
	});
	
	<?php if($_SESSION['frnt_mid']=="") {    ?>
	$('#submit_button').click(function() {
		//alert("dd");
		if($('#checktype2').is(':checked')){
			
			<?php $_SESSION['checkout']="checkout";?>
			window.location.href = '<?php echo SITEURL; ?>/Register';
		}
		else if($('#checktype1').is(':checked')){
			//alert("safrsd");
			$("#div0").slideUp('slow');
			$("#div1").slideDown('slow');
		}
		else{
			document.getElementById("errordiv").innerHTML="Please Checkout as Guest or Register *";
			return false;
		}
	});
	
	$('#login_button').click(function() {
		
	
	if($("#email").val()==""){$("#valemail").html("*Please enter Email!"); $("#email").focus(); return false;}else{if(IsEmail1($("#email").val())==false){$("#valemail").html("*Enter valid email!"); $("#email").focus(); return false; }else{$("#valemail").html("");}}
	if($("#password").val()==""){$("#valpassword").html("*Please enter Password!"); $("#password").focus(); return false;}else{$("#valpassword").html("");}
	
if($("#password").val()!="" && $("#email").val()!="" )	{

//alert("sf");
<?php $_SESSION['login']="login";?>
 document.loginform.submit();	
}
	});
	
	<?php } else { ?>
	$("#div0").remove();
	$("#div1").slideDown('slow');
	
	

	<?php }?>
	
	
	
		
	function IsEmail1(email) {
	//alert(email);
	var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(!regex.test(email)) {
   	return false;
	}else{
   		return true;
	}
}
	});
	</script>
    
   
     <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="#">Home</a></li>
                <li><img src="images/aboutarow_03.png" alt=""></li>
                 <li><a href="#">Checkout</a></li>
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
              
                <div class="checkout_left">

                    <div class="first_method">
                         <span>1.</span> Checkout Method
                    </div><!--first_method-->
                    <?php //echo $_SESSION['frnt_mid'];  ?>
                    <div class="checkout_method">
                    
                       <div class="check_left">
                        
                         <h4>CHECKOUT AS A GUEST OR REGISTER</h4>
                         <div class="checkleft_para1">Register with us for future convenience:</div><!--checkleft_para-->
                         <div class="radio_btn"><input type="radio"> Checkout as Guest</div><!--radio_btn-->
                         <div class="radio_btn"><input type="radio"> Register</div><!--radio_btn-->
                         
                         <h4>REGISTER AND SAVE TIME!</h4>
                         
                         <div class="checkleft_para">Register with us for future convenience:</div><!--checkleft_para-->
                         <div class="checkleft_para2">Fast and easy check out</div><!--checkleft_para-->
                         <div class="checkleft_para">Easy access to your order history and status</div><!--checkleft_para-->
                         
                         <div class="continue_btn">
                            <input type="submit" value="Continue" />
                        </div><!--continue_btn-->
                         
                       
                       </div><!--check_left-->
                       <form name="checkout" id="checkout" method="post" >
                       
                        <input type="hidden" value="<?php echo $_SESSION['frnt_mid']; ?>" name="uid" id="uid" />
  
  <input type="hidden" name="user_name" value="<?php echo $ugetdat->firstname; ?> <?php echo $ugetdat->lastname; ?>" />
  <input type="hidden" name="paypal" value="paypal" />
  <input type="hidden" name="user_email" value="<?php echo $ugetdat->email; ?>" />
                       
                       <div class="check_right">
          
                           <h4>LOGIN</h4>
                         <div class="checkleft_para2">Already registered?</div><!--checkleft_para-->
                         <div class="checkleft_para">Please log in below:</div><!--checkleft_para-->
                         
                         <div class="checkleft_text">Email Adress<span>*</span></div><!---checkleft_text--->
                         <div class="checkleft_btn"><input type="text" name="email" id="email"></div>
                         <div class="clear_fix"></div>
            <b id="valemail" class="valchk"></b><!---checkleft_btn--->
                         
                         <div class="checkleft_text">Password<span>*</span></div><!---checkleft_text--->
                         <div class="checkleft_btn"><input type="password" name="password" id="password"></div>
                         <div class="clear_fix"></div>
             <b id="valpassword" class="valchk"></b><!---checkleft_btn--->
                         
                         
                         <div class="forgot_pwd"><a href="#">Forgot Password?</a></div><!--forgot_pwd-->
                         
                         <div class="submit_btn">
                         
                          <input type="submit" value="LOGIN">
                          
                         <div class="checkleft_para2"><span class="red">*</span>Required Fields</div><!--checkleft_para-->
                         
                         </div><!--submit_btn-->
                         
                       
                       </div><!--check_right-->
                       
                       <div class="clear_fix"></div>
                    
                    </div><!--checkout_method-->
                    

                    <div class="second_method">
                         <a href="#"><span>2.</span> Billing Information</a>
                    </div><!--second_method-->
                    
                    <div class="checkout_method">
                    
                       <div class="check_left">
                       <div class="checkleft_text"> First Name <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text"> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_right">
                       <div class="checkleft_text"> Last Name <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text"> </div><!--checkleft_btn-->
                       </div><!--check_right-->

                       <div class="clear_fix"></div>
                    
                       <div class="check_left">
                       <div class="checkleft_text">Company</div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text"> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_right">
                       <div class="checkleft_text">Email Address<span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text"> </div><!--checkleft_btn-->
                       </div><!--check_right-->
                       <div class="clear_fix"></div>
                       
                       
                       <div class="checkleft_text">Address <span>*</span></div><!--checkleft_text-->
                       <div class="checkleft_btn1">
                        <textarea></textarea>
                       </div><!--checkleft_btn1-->

                       <div class="checkleft_btn1">
                        <textarea></textarea>
                       </div><!--checkleft_btn1-->

                       <div class="check_left">
                       <div class="checkleft_text">City <span>*</span></div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text"> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_right">
                       <div class="checkleft_text">State/Province <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"><select> <option></option> </select></div><!--checkleft_btn-->
                       </div><!--check_right-->
                       <div class="clear_fix"></div>



                       <div class="check_left">
                       <div class="checkleft_text">Zip/Postal Code<span>*</span></div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text"> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_right">
                       <div class="checkleft_text">Country <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"><select> <option></option> </select> </div><!--checkleft_btn-->
                       </div><!--check_right-->
                       <div class="clear_fix"></div>

                       <div class="check_left">
                       <div class="checkleft_text">Telephone <span>*</span> </div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text"> </div><!--checkleft_btn-->
                       </div><!--check_left-->
                       
                       <div class="check_right">
                       <div class="checkleft_text">Fax</div><!--checkleft_text-->
                       <div class="checkleft_btn"> <input type="text"> </div><!--checkleft_btn-->
                       </div><!--check_right-->
                       <div class="clear_fix"></div>


                       <div class="checkleft_btn1"><input type="radio"> Ship to this address</div><!--checkleft_btn1-->
                       <div class="checkleft_btn1"><input type="radio"> Ship to different address</div><!--checkleft_btn1-->
                       
                         <div class="submit_btn">
                         <div class="checkleft_para2"><span class="red">*</span>Required Fields</div><!--checkleft_para-->
                         
                          <input type="submit" value="Continue">
                          
                         
                         </div><!--submit_btn-->

                       <div class="clear_fix"></div>

                    </div><!--checkout_method-->
                    
                    
                    <div class="second_method">
                         <a href="#"><span>3.</span> Shipping Information</a>
                    </div><!--first_method-->
                    
                    
                    <div class="checkout_method">
                    
                   
                   
                   <div class="enter_mail">Enter a shipping address</div><!--enter_mail-->

                   <div class="shipping_text">Pincode: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text"> </div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text">Full Name: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text"> </div><!--shipping_btn-->

                   <div class="clear_fix"></div>
                   <div class="shipping_text">Shipping Address: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><textarea></textarea></div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text">Nearest Landmark: </div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text"></div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text">City: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text"></div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text">State/Province/Region: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn">

                   <select>
                    <option></option>
                   </select>

                   </div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text">Mobile: <span>*</span></div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text"></div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text">Landline</div><!--shipping_text-->
                   <div class="shipping_btn"><input type="text"> </div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text"> </div><!--shipping_text-->
                   <div class="shipping_btn"><input type="checkbox"> Is this for someone else?
                   </div><!--shipping_btn-->
                   <div class="clear_fix"></div>

                   <div class="shipping_text"> </div><!--shipping_text-->
                   <div class="shipping_btn"><input type="submit" value="CONTINUE"></div><!--shipping_btn-->
                   <div class="clear_fix"></div>



               

                       <div class="clear_fix"></div>

                    </div><!--checkout_method-->

                    <div class="second_method">
                         <a href="#"><span>4.</span> Shipping Method</a>
                    </div><!--first_method-->

                    <div class="second_method">
                         <a href="#"><span>5.</span> Payment Information</a>
                    </div><!--first_method-->

                    <div class="second_method">
                        <a href="#"><span>6.</span> Order Review</a>
                    </div><!--first_method-->
</form>

                 </div><!--checkout_left-->

 
                <div class="checkout_right">
                
                
                   <div class="checkright_method"><a href="#">Billing Address</a></div><!--checkright_method-->
                   <div class="checkright_method"><a href="#">Shipping Address</a></div><!--checkright_method-->
                   <div class="checkright_method"><a href="#">Shipping Method</a></div><!--checkright_method-->
                   <div class="checkright_method"><a href="#">Payment Method</a></div><!--checkright_method-->


                 </div><!--checkout_right-->
                 
               <div class="clear_fix"></div>
              
            </div><!--concomimg-->
         </div><!--site_container-->
       </div><!--innerpart-->
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php include("includes/clintblog.php")?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
  <?php include("includes/footer.php")?>