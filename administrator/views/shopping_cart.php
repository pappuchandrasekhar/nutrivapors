<?php include("includes/header.php");
 
//print_r($cartproducts);
if($_POST['update']=="cart")
{
	//echo "hi"; exit;
	$cartobj->updatetempcart();
}

 if($_GET['cid']!="")
{	
	//echo $_GET['cid']; 
	$cartobj->deletetempcart($_GET['cid']);
}


 //$_SESSION['CART_TEMP_RANDOM'];
	$cartproducts=$cartobj->getindcart();
	//print_r($cartproducts); 
	$discountchance=cartClass::couponEntryChance();

?>
     
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
              
                 <form name="cartform" id="cartform" method="post">
                 <?php if($tot_cou>0) { 
	       $i=1;
	 ?>

<div class="shopping_cart">
                
                
                  <div class="product_img">
                   
                    Product Details
                  
                  </div><!--product_img-->
                  
                  <div class="product_name">
                      Product Name
                  </div><!--product_name-->
                  
                 <!--product_edit-->
                  
                  <div class="unit_price">
                      Unit Price
                  </div><!--unit_price-->
                  
                  <div class="product_qty">
                       Qty
                  </div><!--product_qty-->
                  
                  <div class="product_subtotal">
                       Subtotal
                  </div><!--product_subtotal-->

                  <div class="product_delete">
                  Delete
                  </div><!--product_delete-->

                  <div class="clear_fix"></div>
 <?php 
 if($cartproduct->p_img!='' )
 //echo "hai";exit;
 $tol = 0;
 $totalweight=0;
 foreach($cartproducts as $prd){
	   
	   if($prd->p_img!='' )
							{
							  if(file_exists('uploads/store/products/'.$prd->p_img))
							  {
								$src='uploads/store/products/'.$prd->p_img;
							  }
							  else
							    $src='images/no_img.jpg';
							}
  ?>
<div class="addcart_pro">
                  <div class="product1_img">
                         <?php echo $i++; ?>
                  </div><!--product1_img-->
                  

                  <div class="product1_edit">
                  
                   <span style="float:left; padding-right:20px;"><a href="<?php echo SITEURL; ?>/product_discription.php?id=<?php echo $prd->prod_id;?>&cid=<?php echo $prd->cart_cid;?>&pname=<?php echo $prd->prod_name;?>&cart_id=<?php echo $prd->cart_id;?>">
               <img src="<?php echo SITEURL; ?>/<?php echo $src; ?>"  style="width:55px; height:56px;"/></a></span>
                              

                  </div><!--product1_edit-->
                  <div class="product1_name">
                     <?php echo stripslashes($prd->prod_name)?>
                        
                                                <div class="product_color">
                         <span>E-Juice Bottle Size:</span><span> <?php echo stripslashes($prd->bottle_size)?> ml </span>
                          
                        </div><!--product_color-->

                        <div class="product_color">
                          E-Juice Nicotine Content
                            <div style="margin-left:15px; margin-top:5px; font-weight:100;"><?php echo stripslashes($prd->cont_mg)?></div>
                        </div><!--product_color-->

                  </div><!--product1_name-->
                  
                  <div class="unit1_price">
					
					$<?php 
					$var = $prd->indiv_price;
					
					echo stripslashes($var);
					?> 
                  </div><!--unit1_price-->
                  
                  <div class="product1_qnty">


<?php /*?> <input type="hidden" name="prod_id" value="<?php echo $prd->prod_id;?>"/>
 <input type="hidden" name="cart_id" value="<?php echo $prd->cart_id; ?>"/>  
<?php */?>
        <?php
		/*echo $select=mysql_query("select * from tb_store_value where spid='$prd->prod_id");
		while($row=mysql_fetch_array($select, MYSQL_ASSOC))
		{
echo		$quantity=$row['quantity'];
		}*/
		?>
          
   <!--  <select name="quantity[]" id="pro_quantity<?=$cc?>" style="width:45px;" >
                        
                        
                        
                        </select>-->
					
			<!--<input type="number" min="1" max="99" name="quantity[]" id="pro_quantity<?=$cc?>" value="<?php echo stripslashes($prd->quantity)?>">-->
						
                        <!--  <script type="text/javascript">


                for(var i=0;i<document.getElementById('pro_quantity<?php echo $cc;?>').length;i++)

                {

						if(document.getElementById('pro_quantity<?php echo $cc;?>').options[i].value=="<?php echo $prd->quantity ;?>")
						{
						document.getElementById('pro_quantity<?php echo $cc;?>').options[i].selected=true
						}

                }	
                </script>-->
				
	
				
<!--<input name="quantity[]" type="text" style="width:35px;" id="pro_quantity<?=$cc?>" value="<?php echo $prd->quantity;?>" />-->
			
				
<input name="quantity[]" type="number" style="width:35px;" min="1" max="99" id="pro_quantity<?=$cc?>" value="<?php echo $prd->quantity ;?>" />
         <!--   <input name="weight" type="hidden"  value="<?php echo $prd->weight ;?>" />-->
                <br><br>
               <!-- <input type="text" value="<?php echo $prd->quantity;?>">-->
   <input type="hidden" name="update" value="cart"  />
	               <input type="image" src="images/update.png" style="width:45px;height:20px;"/>
<!--<input type="button" value="UPDATE" name="update" style="padding:6px 10px; background-color:#8ebe29; border:none; font-family: 'Roboto', sans-serif; font-size:10px; margin-top:10px; -webkit-border-radius: 3px;	-moz-border-radius: 3px; border-radius: 3px; color:#FFF; cursor:pointer;"/>
-->
 <!--<input type="number" min="1" max="99" name="quantity" value="<?php echo stripslashes($prd->quantity)?>">-->
                      <input type="hidden" name="cc" value="<?=$cc?>" />      
    <input type="hidden" name="indiv_price[]" value="<?=$prd->indiv_price?>" />
                         <input type="hidden" name="prod_id[]" value="<?=$prd->prod_id?>" />
                          <input type="hidden" name="cart_id[]" value="<?=$prd->cart_id?>" />
                         <input type="hidden" name="total_price" value="<?php echo number_format($prd->total_price,2); ?>"/>  
				    
			<?php  
			
			//echo	$initialweight=$prd->weight; 
		//echo $quantity=$prd->quantity;
		// $initialweight=
		 
		 
		 
			//$weight=$initialweight/$quantity; 
			 	
		//$_POST['weight']=$weight;
			
		// $_SESSION['weight']=$weight;
			?>	
								
					
 		<!-- <a href="shopping_cart.php?weight=<?php echo $_POST['weight']; ?>" name="update" ><img src="images/update.png"  style="width:45px;height:20px;"/></a>-->
		
      
					
                  </div><!--product1_qty-->
                   
                  <div class="product1_subtotal">
                     $<?php echo $valuetotal=stripslashes($prd->total_price);
					 
					  $tol=$valuetotal + $tol;
					  $totalweight+=stripslashes($prd->weight);
					 
					 ?>
                     
                  </div><!--product1_subtotal-->

                  <div class="product1_delete">
					
                     <a href="" onClick="var q = confirm('Are you sure you want to delete The Product ?'); if (q) { window.location = 'shopping_cart.php?cid=<?php echo $prd->cart_id;?>'; return false;}" name="remove"><img src="images/delete_icon_06.png" alt="" style="padding-left:10px;" /></a>
                  </div><!--product1_delete-->

</div>                  
                 
                <?php } ?>
                  <div class="clear_fix"></div>


<div class="addcart_pro">

                  <div class="product1_img">
                  </div><!--product1_img-->



                  
                  <div class="product2_name">
                      Cart Summary (<?php echo $tot_cou;  ?> Items)  
             
			 
	

 <!--coupon validation-->
 
 
 <script type="text/javascript">
 
 	
$("#but4").click(function(){
	$("#but4").css({background:backimg,width:bwid,height:bhit,border:bordr}).val("");
	
	var data = '<ul class="billlis"><li><table><tr><td style="float:left; margin-left:15px;">Total </td><td>:&emsp; </td><td></td><td align="right">$'+parseFloat($("#subtrh").val().toString()).toFixed(2)+'</td></tr>';
	if($("#disch").val()!=''){
	var dsvar = $("#disch").val();
	var shvar = $("#shiprh").val();	
	data = data+'<tr><td style="float:left; margin-left:15px;">Coupon </td><td> :&emsp;</td><td>-</td><td align="right">$'+parseFloat(dsvar.toString()).toFixed(2)+'</td></tr>';	}
	data = data+'<tr><td style=" margin-left:2px;">Delivery & Processing </td><td> :&emsp;</td><td>+</td><td align="right">$'+parseFloat(shvar.toString()).toFixed(2)+'</td></tr>';
	if($("#sstate").val()=="California"){
	data = data+'<tr><td>Total Before Tax </td><td> : </td><td></td><td align="right">$'+$("#totbtaxh").val()+'</td></tr>';
	data = data+'<tr><td>(CA 9%) Tax </td><td> :&emsp;+</td><td></td><td align="right">$'+tax+'</td></tr>';	}
	data = data+'<tr><td style=" margin-left:2px;">Grand Total </td><td> : </td><td></td><td align="right">$'+$("#toth").val()+'</td></tr></table></li></ul>';
	$("#sdiv4").html(data);	
	window.setTimeout(function(){$("#payinfo").css({background:bck,color:text});$("#div5").slideDown();$("#sdiv4").slideDown();$("#div4").slideUp();e=true;},stime);
	window.setTimeout(function(){$("#but4").css({background:abacolr,color:atcol,width:abwid,height:abhit,border:abordr}).val(atitle);},btime);
});


function getrates(rr){}

	
</script>
    <script type="text/javascript">
	function validateCouponcode(){
	 couponcodeval=document.getElementById('couponcode').value;
	 //alert(couponcodeval);
	 if(couponcodeval==""){
		//alert("Please Enter Coupon Code");
		document.getElementById('date_list').innerHTML = 'Please Enter Coupon Code';
		document.getElementById('invalidcoupon').style.display="none";
		document.getElementById('couponcode').value="";		
		document.getElementById('couponcode').focus();
		return false;
		}
		else{
			document.getElementById('date_list').innerHTML = '';
		}
	   if(couponcodeval!="")
		{
		$.ajax({   
			type: "POST",
			url: "<?php echo SITEURL; ?>/checkcoupon.php",
			
			data:{coupon_code:$("#couponcode").val(),cart_amount:parseFloat($("#subtrh").val().replace(',','')),randomid:$("#cartrandomid").val()},
			success: function(msg) {
			//alert(msg);
				var obj = $.parseJSON(msg);
				//alert(obj.amount);
				if(obj.amount==0)
				{
					$("#invalidcoupon").show();
				}
			else
				{
					$("#invalidcoupon").hide();
					var ff = parseFloat($("#subtrh").val().replace(',',''));
					var p = parseFloat(obj.amount.toString()).toFixed(2);
					$("#disch").val(parseFloat(p.toString()).toFixed(2));
					$("#dispdisc1").show();
					$("#dispdisc2").show();																				
					$("#discp").html(parseFloat(p.toString()).toFixed(2));						
					$("#discount_coupon_div").hide();	
					$("#discount_coupon_div2").show();						

					$("#amountdis").html(parseFloat(p.toString()).toFixed(2));
					//var ff = parseFloat($("#subtrh").val());
					ff = ff - obj.amount;
					var gg = parseFloat($("#shiprh").val());
					var to = ff+gg;
					if($("#sstate").val()=="California"){
						$("#totbtaxh").val(parseFloat(to.toString()).toFixed(2));
						$("#totbtax").html(parseFloat(to.toString()).toFixed(2));
						$("#totbeftax").show();
						tax = ((20/100)*to);
						to = to + ((20/100)*to);
						to = parseFloat(to.toString()).toFixed(2);
						tax = parseFloat(tax.toString()).toFixed(2);
						$("#taxh").val(tax);
						$("#taxs").html(tax);
						$("#taxrow1").show();
					}
					else
					{
						$("#taxh").val('');	$("#taxs").html(''); $("#taxrow1").hide(); $("#totbtaxh").val(''); $("#totbtax").html(''); $("#totbeftax").hide();
					}
					to = parseFloat(to.toString()).toFixed(2);		
					$("#toth").val(to);
					$("#example_payment_amuont").val(to);
					$("#tothp").val(to);
					$("#total").html(to);					
				}
			}
		});		
		}
		return false;
	}
	
</script>

 <!--end coupon validation-->
 <!--coupon in cart summary-->
		 
			 
			 
			 
			 
<!--<div class="clekedform" id="div4" style="display:none;" >-->
 <table>
<tr>
 <input type="hidden" name="prod_price[]" value="<?php echo $prd->total_price; ?>" />
<input type="hidden" name="prod_name[]" value="<?php echo $prd->prod_name; ?>" />
<input type="hidden" name="prod_id[]" value="<?php echo $prd->prod_id; ?>" />
<input type="hidden" name="prod_quantity[]" value="<?php echo $prd->quantity; ?>" />
</tr>                       
  <?php $totprc+=$prd->total_price;
 $cc++;
 ?>
 <tr>
<?php ?><td>
<?php if($prd->discount=='no'){?>
<div class="checkleft_btn1" id="discount_coupon_di">
Coupon
<input type="text" name="couponcode" id="couponcode"   >
<input type="hidden" name="cartrandomid" id="cartrandomid" value="<?php echo $_SESSION['CART_TEMP_RANDOM']?>">
 <input type="button" value="Apply" id="but4" onclick="javascript:return validateCouponcode()" style="padding:6px 10px; background-color:#8ebe29; border:none; font-family: 'Roboto', sans-serif; font-size:14px; margin-top:10px; -webkit-border-radius: 3px;	-moz-border-radius: 3px; border-radius: 3px; color:#FFF; cursor:pointer;"/>
                        
 </div>
<?php 
					//echo $prd->distype;
}
else if($prd->distype!=''){?>
<div class="checkleft_btn1" id="discount_coupon_di">
Coupon
<input type="text" name="couponcode" id="couponcode"   class="textcoupon">
<input type="hidden" name="cartrandomid" id="cartrandomid" value="<?php echo $_SESSION['CART_TEMP_RANDOM']?>">
<input type="button" value="Apply" id="but4"  onclick="javascript:return validateCouponcode()" style="padding:6px 10px; background-color:#8ebe29; border:none; font-family: 'Roboto', sans-serif; font-size:14px; margin-top:10px; -webkit-border-radius: 3px;	-moz-border-radius: 3px;  border-radius: 3px; color:#FFF; cursor:pointer;" />
<?php
$coupondiscountamount = $cartobj->discountCaliculation($prd->discountamount,$prd->distype,$totprc);
?>
                       
                        </div>                    	
<?php
}
else
{
                        ?>
                        <div class="checkleft_btn1" id="discount_coupon_di">
                        Coupon
                        <input type="text" name="couponcode" id="couponcode"   class="textcoupon">
                        <input type="hidden" name="cartrandomid" id="cartrandomid" value="<?php echo $_SESSION['CART_TEMP_RANDOM']?>">
                        
                      <input type="button" value="Apply" id="but4" onclick="javascript:return validateCouponcode()"  style="padding:6px 10px; background-color:#8ebe29; border:none; font-family: 'Roboto', sans-serif; font-size:14px; margin-top:10px; -webkit-border-radius: 3px;	-moz-border-radius: 3px;  border-radius: 3px; color:#FFF; cursor:pointer;" />
                       
                        </div>
                    <?php } ?>      
                        </td> <?php ?>      
                        <!--end coupon discount-->                             
                      <!--  <td>
						<div class="continue_btn"  align="right">
                            <input type="submit" id="but4" name="submit4" value="Continue"  >
                        </div>
						
                        </td>-->
                     </tr>
                    <tr>
                     	<td >
                        	<div style="display:none; color:#FF0000; margin-left:48px;" id="invalidcoupon">Invalid Coupon</div>                            <div id="date_list" style="color:#FF0000; margin-left:48px;"></div>
                        </td>
                     </tr>
                    
 
 
 
 
                   
 </table>
<!--/div--><!--end coupon in cart--> 
</div><!--product1_name-->
                
 <!-- end cart summary-->                    
		
                              
                  <div class="unit1_price">
                      Sub Total  <br/>
                      <br/>
					  Shipping Price
                      <br/>
                      <br/>
                      Coupon</br>
					  </br>
					  Grand Total
                  </div><!--unit1_price-->
                  
                  <div class="product1_subtotal">
				  <td align="right">$<?php echo number_format($totprc,2); ?>
 <input type="hidden" id="subtrh" value="<?php echo number_format($totprc,2); ?>"></td>                 		  

                <!--  <b>$<?php  echo number_format($tol,2); ?></b>-->
                 
                  
				  
				  
				 

<!--end coupon-->
  <!-- <b id="totbtax" class="money"></b>
  <input type="hidden" id="totbtaxh" value="" name="totbtaxh"></td>
 <td align="right"><?php echo "+&nbsp;"."$"; ?><b id="taxs" class="nmoney"></b>
  <input type="hidden" id="taxh" value="" name="taxh"></td>
 <td >$<b id="total" class="money"></b>
                            <input type="hidden" id="toth" value="" name="toth"></td>-->


<?php //echo number_format($coupondiscountamount,2);  ?></b>
<br/>
                  <br/>
				  
                  <b>$<?php
				  
				  $sel="Select * from tb_sitesettings";
						$rs=$callConfig->getRow($sel); 
	                   if($totalweight<=3){
						      //$additional=$rs->initial_rate; 
						echo $shippingamount=$rs->initial_rate;
						   
					   }else{
						    $additional=$rs->initial_rate; 
						   $shippingcahrs=$rs->add_rate_oz*$totalweight-3*$rs->add_rate_oz;
						   echo $shippingamount=$additional+$shippingcahrs;
				            
				   } 
				   
				   
				  $_SESSION['shippingamount']=$shippingamount; ?></b>
                  <br/>
				  <br/>
				  
				   <!--coupon-->
<?php if($prd->distype!=''){?>
<td id="dispdisc1"><?php
$coupondiscountamount=$cartobj->discountCaliculation($prd->discountamount,$prd->distype,$totprc);							
?>
-&nbsp;$<b id="discp"  class="nmoney"><?php echo number_format($coupondiscountamount,2); ?></b>
<input type="hidden" id="disch" name="disch" value="<?php echo number_format($coupondiscountamount,2); ?>"></td>
<?php
}
else
{
?>
<td id="dispdisc2" style="display:none;" >
<?php echo "-&nbsp;"."$"; ?><b id="discp"  class="nmoney">0.00</b>
<input type="hidden" id="disch" name="disch" value="0.00" style="display:none;">
</td>
<?php
}
?>
				  
				  
				  
				  <br/>
				  
                  <br/>
				  
                  <b>$<?php 
				  $grandtotalamount=$shippingamount-$coupondiscountamount+$tol;
				   echo number_format($grandtotalamount,2); ?></b>
                </div><!--product1_subtotal-->

                  <div class="product1_qty"></div>

				      <div class="clearcart_btn">
                
                    <a href="productpage.php?id=<?php echo $prd->cart_cid; ?>"> Continue Shopping</a>
                  <!-- <a href="#">Update Shopping Cart</a>-->
                   <a href="checkout.php">Check Out</a>
                
                </div>
                
                
                
               <div class="clear_fix"></div>                

                
          </div><!--shoppingcart_btn-->



                
                </div><!--shopping_cart-->
                
            <?php  } else{?>
          <div style="padding-top:35 px; text-align:left;">
          NO ITEMS IN THE CART
          </div>
            <?php }?>   
            </form>  
               
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