<?php include "includes/header.php";?>  
<!--clearfix-->
		 <?php //$url = "http://www.plushcashmere.com"  
		 echo "thank u";
		 exit;
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
                   Thank you for shopping with Adnub.
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
    
           <script type="text/javascript">
			function Redirect() {
				window.location="<?php echo SITEURL; ?>/Home";
			}
			//document.write("You will be redirected to our main page in 10 seconds!");
			setTimeout('Redirect()', 10000);

          </script>
          
  <!--End productdiscriptin-->  
</body>
</html>