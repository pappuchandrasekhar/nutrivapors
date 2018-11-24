<?php /* include("includes/header.php");
$query="select * from tb_contentpages where page_id=".$_GET['id'];
$contentpage= $callConfig->getRow($query);
$pages="select * from tb_contentpages where page_id=".$_GET['id']." and status =  'Active'";
$pageslist= $callConfig->getAllRows($pages);
*/
//print_r( $pageslist); exit;
?>


<?php include("includes/header.php");
$query="select * from tb_contentpages where page_id=".$_GET['id'];
$contentpage= $callConfig->getRow($query);
?>



 <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="<?=SITEURL?>/images/aboutarow_03.png" alt=""></li>
                 <li><?php echo $contentpage->title;?></li>
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div><p> 
     <!--End bedgromms part-->
  
    <!--innerpagepart-->
         <div class="full_wrapper innerpart">
         <div class="site_container">
            <h2><?php echo $contentpage->title;?></h2>
               
                 
                 
                  
                  <p>
                   <?php echo  $contentpage->content;?>
                  </p>
                
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