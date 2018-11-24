<?php include("includes/header.php");
 
//print_r($cartproducts);
if($_POST['update']=="cart")
{
	//echo "hi"; exit;
	$cartobj->updatetempcart($_POST['prod_id']);
}

 if($_GET['cid']!="")
{	
	//echo $_GET['cid']; 
	$cartobj->deletetempcart($_GET['cid']);
}

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
 $tol = 0;
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


 <input type="hidden" name="prod_id" value="<?php echo $prd->prod_id;?>"/>
 <input type="hidden" name="cart_id" value="<?php echo $prd->cart_id; ?>"/>  

        
          
    <!--  <select name="quantity[]" id="pro_quantity<?=$cc?>" style="width:45px;" >
                        
                        
                         <?php // for($i=1;$i<=$attributes[0]->quantity;$i++) { ?>
                            <option value="<?php //echo $i; ?>" <?php //if($attributes[0]->quantity==$prd->quantity){ echo 'selected="selected"'; } ?>> <?php //echo $i; ?></option>
                            <?php //} ?>
                        </select>
						<input type="number" min="1" max="99" name="quantity[]" id="pro_quantity<?=$cc?>" value="<?php echo stripslashes($prd->quantity)?>">
						
                          <script type="text/javascript">


                for(var i=0;i<document.getElementById('pro_quantity<?php echo $cc;?>').length;i++)

                {

						if(document.getElementById('pro_quantity<?php echo $cc;?>').options[i].value=="<?php echo $prd->quantity ;?>")
						{
						document.getElementById('pro_quantity<?php echo $cc;?>').options[i].selected=true
						}

                }	
                </script>-->
				
				
				
				<input name="quantity[]" type="number" min="1" max="99" id="pro_quantity<?=$cc?>" value="<?php echo $prd->quantity ;?>" /><br><br>
       <input type="hidden" name="update" value="cart"  />
                    <input type="image" src="images/update.png" style="width:45px;height:20px;"/>
 
<!--<input type="number" min="1" max="99" name="quantity" value="<?php echo stripslashes($prd->quantity)?>">-->
                      <input type="hidden" name="cc" value="<?=$cc?>" />      
    <input type="hidden" name="indiv_price[]" value="<?=$prd->indiv_price?>" />
                         <input type="hidden" name="prod_id[]" value="<?=$prd->prod_id?>" />
                          <input type="hidden" name="cart_id[]" value="<?=$prd->cart_id?>" />
                         <input type="hidden" name="total_price" value="<?php echo number_format($prd->total_price,2); ?>"/>  
           
				    
                  </div><!--product1_qty-->
                   
                  <div class="product1_subtotal">
                     $<?php echo $valuetotal=stripslashes($prd->total_price);
					  $tol=$valuetotal + $tol;
					
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
                      

                  </div><!--product1_name-->
                
                              
                  <div class="unit1_price">
                      Grand Total
                  </div><!--unit1_price-->
                  

                  
                  <div class="product1_subtotal">
                  <b>$<?php  echo number_format($tol,2); ?></b>
                  
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