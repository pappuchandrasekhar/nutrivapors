<?php 

include('includes/session.php');

if($_POST['submit']=="sitesettings")

{

$res=sitesettingsClass::sitesettings($_POST);

}

?>

<div class="box">

    <div class="heading">

      <h1><img src="allfiles/category.png" alt="">Site settings</h1>

    </div>

    <div class="content">

      <form action="index.php?option=com_sitesettings" method="post" id="frmCreateListing" class="middle_form" enctype="multipart/form-data">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="14%" align="left" valign="middle"><p><label class="title">Theme</label></p></td>

    <td width="86%" align="left" valign="middle">

	<select name="theme_selection" id="theme_selection" class="select_large required" >

	<!--<option value="darkblue">Blue</option>-->

	<option value="green">Light Green</option>

	<!--<option value="darkgreen">Dark Green</option>

	<option value="brown">Brown</option>

	<option value="pink">Red</option>-->

	</select><script type="text/javascript">

                for(var i=0;i<document.getElementById('theme_selection').length;i++)

                {

						if(document.getElementById('theme_selection').options[i].value=="<?php echo $site_settings_disp->theme_selection; ?>")

						{

						document.getElementById('theme_selection').options[i].selected=true

						}

                }			

                </script>

	</td>

  </tr>

  <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">Admin Page Title</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="title" size="24" value="<?php echo stripslashes($site_settings_disp->title); ?>" class="text_large" ><br /></td>

  </tr>

    <tr>

    <td height="5" colspan="2" align="left" valign="middle"></td>

  </tr>

  <tr>

    <td width="14%" align="left" valign="middle"><p><label class="title">Site Logo</label></p></td>

    <td width="86%" align="left" valign="middle">

      <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">

        <tr>

          <td width="23%"><input type="file" name="site_image" size="24"></td>

          <td width="77%"><?php if($site_settings_disp->site_image!="")

	{

	?>

	<img src="../uploads/site/<?php echo $site_settings_disp->site_image; ?>" style="width:185px; height:79px;" />

	<input type="hidden" name="hdn_site_image" size="24" value="<?php echo $site_settings_disp->site_image; ?>">

	<?php

	}

	?></td>

        </tr>

      </table>

	

	</td>

  </tr>

  <tr>

    <td height="5" colspan="2" align="left" valign="middle"></td>

  </tr>

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">No Of Records Per Page</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="noofrecords" size="24" value="<?php echo $site_settings_disp->noofrecords; ?>" class="text_large" ><br /><small>If it is zero it takes the default LIMIT from the code</small></td>

  </tr>

    <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

  
<tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">Shipping Rate</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="shippingamount" size="24" value="<?php echo $site_settings_disp->shippingamount; ?>" class="text_large" ></td>

  </tr>

<tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">Initial Rate(Minimum);</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="initial_rate" size="24" value="<?php echo $site_settings_disp->initial_rate; ?>" class="text_large" ></td>

  </tr>

<tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>



  <tr>

    <td width="14%" align="left" valign="top"><label class="title">Additional Rate / oz:</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="add_rate_oz" size="24" value="<?php echo $site_settings_disp->add_rate_oz; ?>" class="text_large" ></td>

  </tr>





    <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

<?php /*?><tr>
    <td width="14%" align="left" valign="top"><label class="title">Dollar Amount TO Eliminate flat rate shipping</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="dollaramount" size="24" value="<?php echo $site_settings_disp->dollaramount; ?>" class="text_large" ></td>
  </tr><?php */?>
    <tr>
    <td height="10" colspan="2" align="left" valign="middle"></td>
  </tr>

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">From Name</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="mail_fromname" size="24" value="<?php echo $site_settings_disp->mail_fromname; ?>" class="text_large" ></td>

  </tr>

    <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">From Email Address</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="mail_frommail" size="24" value="<?php echo $site_settings_disp->mail_frommail; ?>" class="text_large" ></td>

  </tr>

    <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">Receive Mail Address for Contact Us Form</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="contactusmail" size="24" value="<?php echo $site_settings_disp->contactusmail; ?>" class="text_large" ></td>

  </tr>

    <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>
  
  
  
  <tr>

    <td width="14%" align="left" valign="top"><label class="title">Receive Mail Address for Bulk Order FORM</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="bulkcontactusmail" size="24" value="<?php echo $site_settings_disp->bulkcontactusmail; ?>" class="text_large" ></td>

  </tr>
  
  
  <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>
  

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">Receive Mail Address for Orders</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="ordermail" size="24" value="<?php echo $site_settings_disp->ordermail; ?>" class="text_large" ></td>

  </tr>

    <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

  <tr>

    <td width="14%" align="left" valign="middle"><label class="title">Google Analytics Code</label></td>

    <td width="86%" align="left" valign="middle">

	<textarea name="googleanalytics" id="googleanalytics" class="textarea_install"><?php echo  stripslashes($site_settings_disp->googleanalytics);?></textarea></td>

  </tr>

 <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

<tr>
    <td width="14%" align="left" valign="top"><label class="title">Facebook link</label></td>
    <td width="86%" align="left" valign="middle">https://<input type="text" name="fblink" size="24" value="<?php  echo $site_settings_disp->fblink; ?>" class="text_large" ></td>
  </tr>
   <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

<tr>
    <td width="14%" align="left" valign="top"><label class="title">Twitter Link</label></td>
    <td width="86%" align="left" valign="middle">https://<input type="text" name="twittlink" size="24" value="<?php echo $site_settings_disp->twittlink; ?>" class="text_large" ></td>
  </tr>
 
  <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

<tr>
    <td width="14%" align="left" valign="top"><label class="title">Youtube link</label></td>
    <td width="86%" align="left" valign="middle">https://<input type="text" name="ytlink" size="24" value="<?php  echo $site_settings_disp->ytlink; ?>" class="text_large" ></td>
  </tr>
 <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>
<tr>
    <td width="14%" align="left" valign="top"><label class="title">Pinterest link</label></td>
    <td width="86%" align="left" valign="middle">https://<input type="text" name="plink" size="24" value="<?php  echo $site_settings_disp->plink; ?>" class="text_large" ></td>
  </tr>


    <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

<tr>
    <td width="14%" align="left" valign="top"><label class="title">Phone:</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="phone" size="10" value="<?php  echo $site_settings_disp->phone; ?>" class="text_large" ></td>
  </tr>

<tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>
  
  
  
  <tr>
    <td width="14%" align="left" valign="top"><label class="title">Adress:</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="address" size="10" value="<?php  echo $site_settings_disp->address; ?>" class="text_large" ></td>
  </tr>
  
  
  <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>
  
  <tr>
    <td width="14%" align="left" valign="top"><label class="title">Email:</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="email" size="10" value="<?php  echo $site_settings_disp->email; ?>" class="text_large" ></td>
  </tr>
  
   <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>
  
  <tr>
    <td width="14%" align="left" valign="top"><label class="title">Contact:</label></td>
    <td width="86%" align="left" valign="middle"><input type="text" name="contact"  value="<?php  echo $site_settings_disp->contact;?>" class="text_large" ></td>
  </tr>
  
  <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>
  

  <tr>

    <td width="14%" align="left" valign="middle"><label class="title">Admin Footer</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="footer_txt" value="<?php echo stripslashes($site_settings_disp->footer_txt); ?>" class="text_large" style="width:600px;"></td>

  </tr>
 <tr>

    <td height="10" colspan="2" align="left" valign="middle"></td>

  </tr>

<tr>

    <td width="14%" align="left" valign="middle"><label class="title">Footer</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="adminfooter_txt" value="<?php echo stripslashes($site_settings_disp->adminfooter_txt); ?>" class="text_large" style="width:600px;"></td>

  </tr>




  <tr>

    <td align="left" valign="middle"><p><label class="title">&nbsp;</label><input value="sitesettings" type="hidden"  name="submit"><input value="" class="button button_save" type="submit"  name="submitbutton"></p></td>

    <td align="left" valign="middle">&nbsp;</td>

  </tr>

</table>

</form>

    </div>

  </div>