<?php 
include('includes/session.php');
//include('model/subscribers.class.php');
if($option=='mail'){

include('includes/pageaccess.php');
if($_POST['assign']=="Send Mail")
{
	//print_r($_POST['email']);exit;
	
	$to=$_POST['email'];
  $subject = $_POST['subject'];//'.$rsjob->title;

  $message = "

  <html>

  <head>
  <title></title>

  <style>                 

  .textbold 

  {

  color:#000000;

  }


  </style>

  </head>

  <body>

  <table cellspacing='0' cellpadding='2'  align='center' width='600' border='border:1px solid #CCCCCC'  style=' font-weight:14px; border-collapse:collapse; ' >
				  <tr>
					 <td colspan='0' align='left' valign='top'><img src='".SITEURL."/images/sitelogo_04.png' width='200' height='65'/></td>
				
				  </tr>
	
	<tr>
	<td valign='top' align='left'><strong>Dear</strong>:".$_POST['name']."</td>
	</tr>
	
				 
  <tr>
  <td valign='top' align='left'>".$_POST['full_desc']."</td>
  </tr>
		<tr>
		<td valign='top'  align='left'>Thank You<br />
		</tr>
		<tr>
		<td valign='top' align='left'>Nutrivapors</td>
		</tr>

  </table>

   </body>

   </html>

   ";
echo  $message;  exit;
      $strSid = md5(uniqid(time()));
	  $strHeader  = 'MIME-Version: 1.0' . "\r\n";
      $strHeader .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $strHeader .= 'From: Sena Infotech  <info@senainfotech.com>' . "\r\n";
      $strHeader .= "Reply-To: info@senainfotech.com\r\n";
      $strHeader .= "Return-Path: info@senainfotech.com\r\n";
      $strHeader .= "X-Mailer: PHP5\n";
 /* mail($to, $subject, $message, $headers);
		  

       // $strHeader = "";  
       // $strHeader .= "From: ".$_POST["full_name"]."<".$_POST["email"].">\nReply-To: ".$_POST["email"]."";  

        $strHeader .= "MIME-Version: 1.0\n";  
        $strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";  
        $strHeader .= "This is a multi-part message in MIME format.\n";  

        //$strHeader .= "--".$strSid."\n";  
        //$strHeader .= "Content-type: text/html; charset=utf-8\n";  
        $strHeader .= "Content-Transfer-Encoding: 7bit\n\n";  
        $strHeader .= $message."\n\n";*/  

      
        if(@mail($to,$subject,$message,$strHeader))  // @ = No Show Error //  
       {
  header("Location:index.php?option=com_subscribers&ferr=Mail sent succesfully ");
    }
       else

  {
 header("Location:index.php?option=com_subscribers&ferr=Mail failed");
  } 
  

}

if($_GET['sid']!='')
{
	 $str=$callConfig->passwordDecrypt($_GET['sid']);
	 $str1=implode("','",explode(",",$str));
	 
	 $sql="select * from tb_newsletter_subscribers where id IN ('".$str1."')";
	 $rs=$callConfig->getAllRows($sql);
	 $emails='';
	 foreach($rs as $rs_email)
	 {
		 if($emails=='')
		 {
			 $emails=$rs_email->emailid;
		 }
		 else
		 {
			 $emails=$emails.",".$rs_email->emailid;
		 }
	 }
	 
}

?>


<?php /*?><div class="container_1">
        
           <div style="clear:both;"></div>
            
            <script type="text/javascript"  src="../ckeditor/ckeditor.js"></script>
            <div class='err' style="margin-top:1px; color:#9c1a0f;margin-left:290px border:2px solid red;width:400px; background-color:#0F3;"><?=$msg?></div>
            <div class="grid_12">
              <div style="font-size:14px;font-weight:bold;" ><a href="index.php?option=com_dashboard">Dashboard</a>&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;<a href="index.php?option=subscribers">Newsletter subscribers</a>&nbsp;&nbsp;&raquo;&raquo;&nbsp;&nbsp;Mail Id </div>
			<span><br /></span>
                <div class="module">
                     <h2><span>Add/Modify news & events</span></h2>
                        
                     <div class="module-body">
					 
					 <!-- Form Element -->
					 
					 <form action="" method="post" name="frmCreateAdmin" enctype="multipart/form-data" onsubmit="return validate();" >
					 
					 <p><label><font color="#FF0000">*</font>Email-ID:</label> <input type="text" class="input-short" name="email" id="email"  size="24" value="<?php echo $emails; ?>"  />
                       </p>
						
                        
                         <p><label><font color="#FF0000">*</font>Subject:</label> <input type="text" class="input-short" name="subject" id="subject"  size="24"/>
                       </p>
						
                          <p><label><font color="#FF0000">*</font>Name:</label> <input type="text" class="input-short" name="name" id="name"  size="24"/>
                       </p>
						
							 
						<p><label><font color="#FF0000">*</font>Description:</label> <textarea  name="full_desc" id="full_desc" class="ckeditor"  ></textarea></p>
							 		
							   <fieldset>
                            <input   type="submit" name="assign" value="Send Mail" class="submit-green" /> 
                              </fieldset>
                       
                       </form>
					 
					 
					 
					 
					 <!-- End Form Element -->
					 
			      </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div> <!-- End .grid_12 -->
                
            <!-- Settings-->
           
            <div style="clear:both;"></div>
        </div><?php */?>
        
           <script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",


		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		/*template_external_list_url : "tinymce/examples/lists/template_list.js",
		external_link_list_url : "tinymce/examples/lists/link_list.js",
		external_image_list_url : "tinymce/examples/lists/image_list.js",
		media_external_list_url : "tinymce/examples/lists/media_list.js",*/

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

         // Extended valid elements
         extended_valid_elements : "iframe[src|width|height|name|align|frameborder]",
        
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

        <div class="box">

    <div class="heading">

      <h1><img src="allfiles/content.jpeg" alt=""> Add Page &nbsp;&nbsp;/&nbsp;&nbsp; Edit Page</h1>

    </div>

    <div class="content">

	 <form action="" method="post" name="frmCreateAdmin" enctype="multipart/form-data" onsubmit="return validate();" >

	<table width="100%" border="0" cellspacing="0" cellpadding="0" >

<tr>

<td width="6%" align="left" class="caption-field"><label class="title">Email-id:<span style=" color:#FF0000; font-size:14px">*</span></label></td>

<td width="94%" align="left" valign="middle"><input type="text" class="text_large required" name="email" id="email" value="<?php echo $emails; ?>"  style="width:800px;" /></td>

</tr>
<tr><td colspan="2" height="7"></td></tr>
			
            <tr>

<td width="6%" align="left" class="caption-field"><label class="title">Subject:<span style=" color:#FF0000; font-size:14px">*</span></label></td>

<td width="94%" align="left" valign="middle"><input name="subject" id="subject" class="text_large required" type="text"  style="width:800px;"/></td>

</tr>
<tr><td colspan="2" height="7"></td></tr>
<tr>

<td width="6%" align="left" class="caption-field"><label class="title">Name:<span style=" color:#FF0000; font-size:14px">*</span></label></td>

<td width="94%" align="left" valign="middle"><input name="name" id="name"   class="text_large required" type="text" style="width:800px;"/></td>

</tr>


			  <tr><td colspan="2" height="7"></td></tr>

			
				   <tr>

            <td align="left" valign="top" class="caption-field"><label class="title">Content:<span style=" color:#FF0000; font-size:14px">*</span></label></td>

				<td align="left" valign="middle" class="caption-field">   
				<textarea name="full_desc" id="full_desc" cols="157" rows="20"></textarea>
                </td>

				</tr>

				 <tr><td colspan="2" height="7"></td></tr>

			

	<tr>

	<td align="left" valign="middle" colspan="2"><input type="submit" name="assign" value="Send Mail" class="submit-green" />

	</td>

	</tr>

        </table>

		</form>

</div>

</div>
        <?php }?>