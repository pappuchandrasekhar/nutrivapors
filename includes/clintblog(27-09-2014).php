<div class="full_wrapper freeshoping">
        <div class="site_container freeshopingin1">
          <?php if(basename($_SERVER['PHP_SELF'])=='index.php'){?>
          <div class="btncenter">
            <a href="<?=SITEURL?>/newproducts.html"><img src="<?=SITEURL?>/images/leadmorebtn_59.png" alt=""></a>
          </div>
          <?php } ?>
          <div class="clintrated">
		  
                <div class="topratedleft">
         
		        <div class="toprated">
          
		        Top Rated
                </div>
                
                <ul class="topratedlis">
                
                <?php
				 // print_r($catlist);
				 
				
				if(count($catlist)>0){
			    foreach($catlist as $cat){
				   $queryvalue="select MIN(real_price) as real_price,id,size from tb_store_value where spid=".$cat->spid;
					
					 // $queryvalue="select MAX(rating)  from tb_store_value where spid=".$cat->spid;
					
					  $minimumvalues= $callConfig->getRow($queryvalue);
               
		
			
			
				 // $toprrr=$bannerObj->toprrr($cat->pid);
				  
			  ?>
                
                  <li>
                    <div>
                      <div class="topratimg"><img src="<?=SITEURL?>/images/penborderimages_81.jpg" alt="" class="res_images"></div>
                      <div class="topratedsiderates">
                      <div class="downloadproduct">
                      <?php 
					  $ssid=$cat->pid;
					  
					   $query="select * from tb_store_products where spid='".$ssid."'";
					  $query=mysql_query($query)
					  
					  ?>
					                                                                     
                        <a href="#"><?php echo  $cat->prodtitle?></a>
                        <a href="#"><?php echo  $cat->prodtitle?></a>
                       </div>
                       <div class="downloadproducto">
                       $<?php echo  $minimumvalues->real_price?>
                       </div>
                       
                       <div style="margin-top:10px;">
                        <span>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_86.png" alt=""></a>
                        </span>
                        <span>1 Review(S)</span>
                        <div class="clear_fix"></div>
                       </div>
                      </div>
					  
                      <div class="clear_fix"></div>
                    </div>
					</div>
					
				
                  
				  </li>
                  
                      <?php  }}?>
                  
                  <?php /*?><li>
                    <div>
                      <div class="topratimg"><img src="<?=SITEURL?>/images/penborderimages_84.jpg" alt="" class="res_images"></div>
                      <div class="topratedsiderates">
                       <div class="downloadproduct">
                        <a href="#">Virtual Product</a>
                       </div>
                       <div class="downloadproducto">
                       $100.00
                       </div>
                       <div style="margin-top:10px;">
                        <span>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_86.png" alt=""></a>
                        </span>
                        <span>1 Review(S)</span>
                        <div class="clear_fix"></div>
                       </div>
                      </div>
                      <div class="clear_fix"></div>
                    </div>
                  </li>
                  <li>
                    <div>
                      <div class="topratimg"><img src="<?=SITEURL?>/images/penborderimages_86.jpg" alt="" class="res_images"></div>
                      <div class="topratedsiderates">
                       <div class="downloadproduct">
                        <a href="#">Virtual Product</a>
                       </div>
                       <div class="downloadproducto">
                       $900.00
                       </div>
                       <div style="margin-top:10px;">
                        <span>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_84.png" alt=""></a>
                         <a href="#"><img src="<?=SITEURL?>/images/stars_86.png" alt=""></a>
                        </span>
                        <span>1 Review(S)</span>
                        <div class="clear_fix"></div>
                       </div>
                      </div>
                      <div class="clear_fix"></div>
                    </div>
                  </li>
                  <?php */?>
              
                </ul>
              </div>
              
              
<div class="torteright">
 <div class="toprated">
  About Us 
</div>

<p>

<?php
$query="select * from tb_contentpages where page_id=1";
$siteAboutUs=$callConfig->getRow($query); 

$con=$siteAboutUs->content;
$to=cut_paragraph($con,25);?>
<a href="<?=SITEURL?>/<?=seoClass::fURL('content.php?id='.'1')?>" style="color: rgb(101, 101, 101);"><?php print substr($to,0,150)."[MORE]"; ?></a>     

<!--<a href="content.php?id=1" style="color: rgb(101, 101, 101);"><?php print substr($to,0,150)."[MORE]"; ?></a> -->
           
</p>

<?php 
	
	$query="SELECT * FROM `tb_sitesettings` ";
	$siteDetails=$callConfig->getRow($query);
	
	$query="SELECT * FROM `tb_contentpages` where page_id=6 ";
	$siteAddress=$callConfig->getRow($query);
?>
<div class="borbotdd">
</div>
<div>
  <span class="spanmap"><a href="#"><img src="<?=SITEURL?>/images/mapicons_92.png" alt=""></a></span>
  <span class="persapns" style=" margin-top:-3px"><a href="#"><?php echo $siteAddress->content; ?></a></span>
  <div class="clear_fix"></div>
</div>
<!-- <div>
  <span class="spanmap"><a href="#"><img src="images/mapicons_92.png" alt=""></a></span>
  <span class="persapns"><a href="#"><?php //echo $siteAddress->content; ?></a></span>
  <div class="clear_fix"></div>
</div>-->
 <div class="borbotdd">
</div>
<div>
  <span class="spanmap" style="margin-top:10px;"><a href="#"><img src="<?=SITEURL?>/images/mapicons_97.png" alt=""></a></span>
  <span class="persapns"><a href="#">Email: <?php print  $siteDetails->contactusmail; ?></a></span>
  <div class="clear_fix"></div>
</div>
 <div class="borbotdd">
</div>
 <div>
  <span class="spanmap" style="margin-top:5px;"><a href="#"><img src="<?=SITEURL?>/images/mapicons_100.png" alt=""></a></span>
  <span class="persapns"><a href="#">Phone:<?php print  $siteDetails->phone; ?></a></span>
  <div class="clear_fix"></div>
</div>
 <div class="borbotdd">
</div>
</div>
                
                
                <div class="torteright">
                 <div class="toprated">
                  WHAT CLIENT SAYS
                </div>
                <!--<p>
   <i>            
"Nulla molestie postulant qui ne, movet quando salutatus ea sea. Impetus aperiam convenire vel et, ei brute autem ornatus est. Stet dictas patrioque mea ea. Antiopam iracundia ei eos, an usu nostro ancillae dissentias"
</i>
                </p>
                 <div class="jhonedoie">
                  John Doe Account Manager
                 </div>
                 <div>
                  <img src="images/myacountborder_96.png" alt="">
                 </div>
                 <div class="clintimg">
                   <a href="#"><img src="images/clintsays_100.png" alt=""></a>
                 </div>
                 <div class="clintimg">
                 <a href="#"> <img src="images/roundicons_112.png" alt=""></a>
                 <a href="#"> <img src="images/roundicons_114.png" alt=""></a>
                 </div>
                </div>-->
				<?php 
                    include("includes/downslider.php");                                    
                ?>
                </div>
                
             <div class="clear_fix"></div> 
             <div style="height:50px;">
             </div>
              
          </div>
          
       </div>
   </div>