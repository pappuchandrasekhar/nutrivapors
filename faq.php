<?php /* include("includes/header.php");
$query="select * from tb_contentpages where page_id=".$_GET['id'];
$contentpage= $callConfig->getRow($query);
$pages="select * from tb_contentpages where page_id=".$_GET['id']." and status =  'Active'";
$pageslist= $callConfig->getAllRows($pages);
*/
//print_r( $pageslist); exit;
?>


<?php include("includes/header.php");
$query="select * from tb_faq where id=".$_GET['id'];
$contentpage= $callConfig->getRow($query);
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("li").click(function(){
			$(this).toggleClass("active");
			$(this).next("div").stop('true','true').slideToggle("slow");
		});
	});
</script>  

 <!--bedgromms part-->
        <div class="full_wrapper bedgrampart">
          <div class="site_container bedgrampartin">
              <ul class="bedgromslist"> 
                <li><a href="<?=SITEURL?>/home.html">Home</a></li>
                <li><img src="<?=SITEURL?>/images/aboutarow_03.png" alt=""></li>
                 <li>Got Questions</li>
              </ul>
               <div class="clear_fix"></div>
          </div>
        </div>
        <div class="clear_fix"></div><p> 
     <!--End bedgromms part-->
  
    <!--innerpagepart-->
         <div class="full_wrapper innerpart">
         <div class="site_container">

                <h2>Got Questions</h2>
        <br>
          
	                <ul>
                    
					
					   <?php  

 
$contentlist=$bannerObj->getFaq('','','','');
   if(count($contentlist)>0){
			  foreach($contentlist as $contentpage){?>
			 
           
                 <li >Q : <?php echo strip_tags($contentpage->question); ?></li>
                    <div style="display:none; border:0px solid #CCCCCC; position:relative; top:-9px; padding:7px;">
                  <?php echo $contentpage->answer; ?> 
			   
             </div>
           
             <?php  }}
 
 ?>
					
					   
                </ul>
					
				
			   
		<div class="clear_fix"></div>
	</div>

			  
            
       
       </div>
       <div class="clear_fix"></div> 
    <!--End innerpagepart-->

   
   <!--clintblog-->
   <?php include("includes/clintblog.php")?> 
   <div class="clear_fix"></div> 
  <!--ENd clintblog-->
  
 <?php include("includes/footer.php")?>