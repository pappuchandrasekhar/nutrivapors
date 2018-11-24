<?php 

include('includes/session.php');

include("model/newsletter.class.php");

$newsletterObj=new newsletterClass();

if($_POST['submit']=="sitesettings")

{

$res=$newsletterObj->mailSubjectConetentSave($_POST);

}

$indivdata=$newsletterObj->getNewsletterContent();



?>

<script type="text/javascript">

function trim(stringToTrim)

{

return stringToTrim.replace(/^\s+|\s+$/g,"");

}

function validate(fld)

{

	if(trim(document.frmCreatestate.mailsubject.value)=="")

	{ 

		alert("Please enter Title");

		document.frmCreatestate.mailsubject.value='';

		document.frmCreatestate.mailsubject.focus();

		return false;

	}

		

document.frmCreatestate.submit();

return true;

}

</script>

<script>

function seldesc(val)

{

window.location="index.php?option=com_newslettercontent&tempid="+val;

}

</script>

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

      <h1><img src="allfiles/category.png" alt="">Newsletter</h1>

    </div>

    <div class="content">

      <form action="index.php?option=com_newslettercontent" method="post"  id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data"  onsubmit="return validate(this.image);">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">

            <?php 

			if($_GET['tempid']){

			$newtempid = $_GET['tempid'];

			$newslettertempdata=$newsletterObj->getNewslettertemplateContent($_GET['tempid']);

			$msg = $newslettertempdata->bigtext;

			}

			else {

			$newtempid = $indivdata->news_template;

			$msg = $indivdata->mailcontent;

			}

			?>

            <tr>

                <td width="6%" align="left" class="caption-field"><label class="title">Choose Template :</label></td>

                <td width="94%" align="left" valign="middle">

                <select name="news_template" id="news_template" class="select_medium required" onchange="seldesc(this.value)">

				<option value="">--Choose Template--</option>

				<?php

				$allcategorylist=$newsletterObj->getAllNewsTemplateList('Active','','','','');

				foreach($allcategorylist as $catlist)

				{

				?>

				<option value="<?php echo $catlist->id;?>"><?php echo stripslashes($catlist->title);?></option>

				<?php

				}

				?>

				</select>

				<script type="text/javascript">

                for(var i=0;i<document.getElementById('news_template').length;i++)

                {

						if(document.getElementById('news_template').options[i].value=="<?php echo $newtempid ?>")

						{

						document.getElementById('news_template').options[i].selected=true

						}

                }			

                </script></td>

			  </tr>

			   <tr><td colspan="2" height="7"></td></tr>

            

  <tr>

    <td width="14%" align="left" valign="top"><label class="title">Subject</label></td>

    <td width="86%" align="left" valign="middle"><input type="text" name="mailsubject" id="mailsubject" size="24" value="<?php echo stripslashes($indivdata->mailsubject); ?>" class="text_large" style="width:800px;" ></td>

  </tr>

    <tr>

    <td height="5" colspan="2" align="left" valign="middle"></td>

  </tr>

  <?php 

  

  ?>

  <tr>

                <td align="left" valign="top" class="caption-field"><label class="title">Content:<span style=" color:#FF0000; font-size:14px">*</span></label></td>

				<td align="left" valign="middle" class="caption-field">   
				<textarea name="content" id="content_matter" cols="157" rows="20"><?php echo  stripslashes($indivdata->bigtext);?></textarea>

	<?php /*?><?

				include 'fckeditor/fckeditor.php'; 

				$sBasePath = 'fckeditor/' ;//to change in web root

				$oFCKeditor = new FCKeditor('mailcontent');  //name of the form-field to be generated

				$oFCKeditor->BasePath	= $sBasePath;

				$oFCKeditor->Value		= stripslashes($msg);//the matter that may be in db

				$oFCKeditor->Height=400;

				$oFCKeditor->Width=900;

				$oFCKeditor->Create() ;

				?><?php */?>

				</td>

  </tr>

  <tr>

    <td height="5" colspan="2" align="left" valign="middle"></td>

  </tr>

    <tr>

    <td align="left" valign="middle"><p><label class="title">&nbsp;</label><input value="sitesettings" type="hidden"  name="submit"><input value="" class="button button_save" type="submit"  name="submitbutton"></p></td>

    <td align="left" valign="middle">&nbsp;</td>

  </tr>

</table>

</form>

    </div>

  </div>