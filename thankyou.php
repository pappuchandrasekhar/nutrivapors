<?php include "includes/header.php";?>  
<!--clearfix-->

<?php     

 $query="select * from tb_cart order by cart_id DESC LIMIT 1;";
$res=mysql_query($query);
$row=mysql_fetch_array($res);

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
                      Total price
                  </div><!--product_subtotal-->

                  <div class="product_delete">
                  sssss
                  </div><!--product_delete-->

                  <div class="clear_fix"></div>
 
<div class="addcart_pro">
                  <div class="product1_img">
                         
                  </div><!--product1_img-->
                  

                  <div class="product1_edit">
                  
                  
                  
                  <?php /*?> <span style="float:left; padding-right:20px;"><a href="<?php echo SITEURL; ?>/product_discription.php?id=<?php echo $prd->prod_id;?>&cid=<?php echo $prd->cart_cid;?>&pname=<?php echo $prd->prod_name;?>&cart_id=<?php echo $prd->cart_id;?>"><?php */?>
               
               <?php
			   
			   $id=$row['prod_id'];
			   
			   $query="select * from  tb_store_products where spid='".$id."'";
			   
			   $ress=mysql_query($query);
			   $row11=mysql_fetch_array($ress);
			   
			   ?>
               
               <img src="uploads/store/products/<?php echo $row11['image']; ?>"  style="width:55px; height:56px;"/></a></span>
            
                  
                  </div><!--product1_edit-->


                  <div class="product1_name">
                     <?php echo $row['prod_name'] ?>
                        
                                                <div class="product_color">
                         <span>E-Juice Bottle Size:</span><span> <?php echo $row['bottle_size']; ?> ml </span>
                          
                        </div><!--product_color-->

                        <div class="product_color">
                         <span> E-Juice Nicotine Content:</span>
                            <span><?php echo $row['cont_mg']; ?></span>
                        </div><!--product_color-->

                  </div><!--product1_name-->
                  
                  
                  <div class="unit1_price">
					
					$<?php echo $row['indiv_price'] ?> 
                  </div><!--unit1_price-->
                  
                  <div class="product1_qty">

 					 <?php echo $row['quantity'] ?>
                    
                  </div><!--product1_qty-->
                  
                  <div class="product1_subtotal">
                  <?php
				   $query="select * from tb_orders order by oid DESC LIMIT 1";
				  $res=mysql_query($query);
				  $nn=mysql_fetch_array($res);
				  $ship_price=$nn['ship_price'];
				  
				  ?>
                  
                  
                     $<?php echo ($row['total_price']+$ship_price);
					  
					
					 ?>
                  </div><!--product1_subtotal-->

                  <div class="product1_delete">
					
                   ssss
                    
                  </div><!--product1_delete-->

</div>                  
                 
               
                  <div class="clear_fix"></div>


<?php /*?><div class="addcart_pro">

                  <div class="product1_img">
                  </div><!--product1_img-->



                  
                  <div class="product2_name">
                      Cart Summary (<?php echo $tot_cou;  ?> Items)  
                      

                  </div><!--product1_name-->
                
                              
                  <div class="unit1_price">
                      Grand Total
                  </div><!--unit1_price-->
                  

                  
                  <div class="product1_subtotal">
                  <b>$<?php global  $tol; echo $tol; ?></b>
                  
                </div><!--product1_subtotal-->

                  <div class="product1_qty"></div>

                
                
                
               <div class="clear_fix"></div>                

                
          </div><?php */?><!--shoppingcart_btn-->



                
                </div>







 

		 <?php //$url = "http://www.plushcashmere.com"  
		 echo "thank u";
		 $url = "'".SITEURL."'";
		  ?>
        <div class="clearfix">
        </div>
        <!--End clearfix-->
        <!--productdiscriptin-->
        <div class="prodiscription" style="margin-left:250px; float:left; width:1014px;  ">
            <?php $tid=$_GET['tranid']; 
            if($tid!="")
            {
		
			               ?>
            <div class="prodiscriptionin">
            <div class="aboutbg" style="font-family:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold; height:400px; margin-left: 220px;margin-top: 50px; width: 500px;">
                
                   Dear <?php if($_SESSION['frnt_mid']!='' || $_SESSION['user_email']!='') { ?><?php echo $_SESSION['user_name'];?><?php }else { ?>Guest<?php } ?>
				   ,<br><br>
                   Thank you for shopping with Nutrivapors.
                   <br><br>
                   Kindly check your email for Order Confirmation details.<br><br><br>
                   
 <a href="<?php echo SITEURL; ?>/ProductCategories"><input type="submit" value="Continue Shopping" style="margin-right: 20px; margin-top:10px;" />                   
                   </a>                          
                  
                        
                </div>
            </div>
            
          
            <?php } ?><?php //exit; ?>
        </div>
    </div>
  
 
 <?php unset($_SESSION['CART_TEMP_RANDOM']); ?>
    <!--
           <script type="text/javascript">
			function Redirect() {
				window.location="<?php echo SITEURL; ?>/Home";
			}
			//document.write("You will be redirected to our main page in 10 seconds!");
			setTimeout('Redirect()', 10000);

          </script>-->
          
  <!--End productdiscriptin-->  
</body>
</html>