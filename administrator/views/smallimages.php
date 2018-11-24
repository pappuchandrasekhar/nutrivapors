<?php

include('includes/session.php');

include("model/smallimage.class.php");

$smallimageObj=new smallimageClass();

if($_GET['action']=="delete"){

   $smallimageObj->smallimagesDelete($_GET['id']);

}

if($_POST['admininsert']=="Submit"){

   $smallimageObj->insertsmallimages($_POST);

}

if($_POST['admininsert']=="Update"){

   $smallimageObj->updatesmallimages($_POST);

}

if(isset($_GET['id']) && $_GET['id']!=""){

   $hdn_value="Update";

   $indivdata=$smallimageObj->getsmallimagesData($_GET['id']); 

   $hdn_in_up='class="button button_save"';

} else { 

  $hdn_value="Submit";

  $hdn_in_up='class="button button_add"';

}

$start=0;

if($_GET['start']!="")

$start=$_GET['start'];

if($site_settings_disp->noofrecords!="0")

$limit=$site_settings_disp->noofrecords;

else

$limit=25;

if($_GET['fld']!="")

$fldname=$_GET['fld'];

else

$fldname="scid,disp_order";

if($_GET['ord']!="")

$orderby=$_GET['ord'];

else

$orderby="ASC";



$allsmallimages=$smallimageObj->getAllsmallimagesList($fldname,$orderby,$start,$limit);

$total=$smallimageObj->getAllsmallimagesListCount();



if($option!="com_smallimageslist_insert"){

?>



<div class="box">

<div class="heading">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt="">Official Partners</h1></td>

<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_smallimageslist_insert';"></td>

</tr>

</table>

</div>

<div class="content">

	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">

          <thead>

            <tr height="25">

              <td width="20" align="center" valign="middle">sno</td>

			   <td width="290" align="left" valign="middle" >Partner Name</td>

          <td width="808" align="left" valign="middle" class="sort">

					<div >

					<a href="index.php?option=com_smallimageslist&ord=ASC&fld=title" class="up" title="up"></a>

					<a href="index.php?option=com_smallimageslist&ord=DESC&fld=title" class="down" title="down"></a>

					</div>

</td>



<td width="290" align="left" valign="middle" >Logo</td>

			  <td width="290" align="left" valign="middle" >Status</td>

              <td width="35" align="center" valign="middle" >Edit</td>

			  <td width="35" align="center" valign="middle" >Delete</td>

            </tr>

          </thead>

			<tbody>

			<?php

			if(sizeof($allsmallimages)>0){

					$ii=0;

					foreach($allsmallimages as $all_smallimages){

					?>

			<tr height="22">

			<td align="center" valign="middle"><?=($ii+1);?></td>

			<td colspan="2" align="left" valign="middle"><?php echo stripslashes($all_smallimages->title);?></td>

            <td  align="left" valign="middle"><img src="../uploads/smallimage/<?php echo $all_smallimages->image; ?>" width="120" height="50" /></td>

			<td align="left" valign="middle"><?php echo $all_smallimages->status;?></td>

			<td align="center" valign="middle"x><a title="edit" href="index.php?option=com_smallimageslist_insert&id=<?php echo $all_smallimages->id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>

			<td align="center" valign="middle">

						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_smallimageslist&action=delete&id=<?php echo $all_smallimages->id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>

			  </td>

			</tr>

			<?php

				$ii++; } } else{

			?>

							<tr><td colspan="8" align="center" height="100">No Records..</td></tr>

			<?php 

			}

			?>

			</tbody>

						<tr><td colspan="10" align="left">

						<?php if($total>$limit)

			{

			?>

			<ul class="paginator" style="float:right; margin-left:-25px;">

			<?php 

			$param="";

			if($_GET['ord']!="")

			$param.="&ord=".$_GET['ord'];

			if($_GET['ord']!="")

			$param.="&fld=".$_GET['fld'];

			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_smallimageslist', $param);

			?>

			</ul>

			<?php 

			}

			?></td></tr>		



      </table>

	

	</div>

  </div>

 <?php } else { ?>

<script type="text/javascript">

function trim(stringToTrim)

{

return stringToTrim.replace(/^\s+|\s+$/g,"");

}

function validate(fld)

{



    var imagehdnval="<?=$indivdata->image?>";

	if(imagehdnval=="")

	{

		if(document.frmCreatestate.image.value=="")

		{ 

		alert("Please Upload Image");

		document.frmCreatestate.image.value='';

		document.frmCreatestate.image.focus();

		return false;

		}

		if(!/(\.bmp|\.gif|\.jpg|\.jpeg|\.png)$/i.test(fld.value))

		{

		alert("Please Upload Valid Image/file type");

		fld.value='';

		fld.focus();

		return false;

		}

	}

   		if(trim(document.frmCreatestate.content.value)=="")

	{ 

		alert("Please enter the Description");

		document.frmCreatestate.content.value='';

		document.frmCreatestate.content.focus();

		return false;

	}



 return true;

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



		// Replace values for the template plugin

		template_replace_values : {

			username : "Some User",

			staffid : "991234"

		}

	});

</script>

 <div class="box">

<div class="heading">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt=""> Add Official Partners&nbsp;&nbsp;/&nbsp;&nbsp; Edit Official Partners</h1></td>

<td align="right" valign="bottom">&nbsp;</td>

</tr>

</table>

</div>

<div class="content">

<form action="index.php?option=com_smallimageslist_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate(this.image);">

	<table width="100%" border="0" cellspacing="0" cellpadding="0" >

	<tr>

                <td width="6%" align="left" class="caption-field"><label class="title"> Title:</label></td>

          <td align="left" valign="middle" colspan="2"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title);?>" style="width:200px;"/></td>

	</tr>

			  <tr><td colspan="3" height="7"></td></tr>

			    <tr>

                <td width="6%" align="left" class="caption-field"><label class="title"> Hyperlink:</label></td>

          <td align="left" valign="middle" colspan="2"><input name="hyplink" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->hyplink);?>" style="width:200px;"/>&nbsp;&nbsp;&nbsp;<small>Please provide link including http like http://www.google.co.in</small></td>

	</tr>

			  <tr><td colspan="3" height="7"></td></tr>

                 

                 <tr>

                <td align="left" valign="top" class="caption-field"><label class="title">Image:</label></td>

                <td width="19%" align="left" valign="middle" class="caption-field">

        		<input type="file" name="image" size="24" class="text_large required">

                <td width="72%"><?php if($indivdata->image!=""){

				?>

				<img src="../uploads/smallimage/<?php echo $indivdata->image; ?>" width="120" height="50" />

				<input type="hidden" name="hdn_image" size="24" value="<?php echo $indivdata->image; ?>">

				<?php

				}

				?>

                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small> *Please upload image size WIDTH*HEIGHT -- 265 * 120</small>

                </td>

                <td width="3%"></td>

				</tr>

				 <tr><td colspan="2" height="7"></td></tr>

            <tr>

            <td width="6%" align="left" class="caption-field"><label class="title"> Description:</label></td>

            <td align="left" valign="middle" colspan="2"><textarea style="width:250px; height:50px;" name="content" class="textarea_medium" ><?php echo stripslashes($indivdata->content); ?> </textarea>

        </tr>

                  <tr><td colspan="3" height="7"></td></tr>

                 

				<tr>

				<tr>

                <td align="left" class="caption-field"><label class="title">Status :</label> </td>

                <td align="left" valign="middle" class="caption-field" colspan="2">

    <select name="status" id="status" class="select_large required">

	<option value="Active">Active</option>

    <option value="Inactive">Inactive</option>

	</select>



	<script type="text/javascript">

                for(var i=0;i<document.getElementById('status').length;i++)

                {

						if(document.getElementById('status').options[i].value=="<?php echo $indivdata->status; ?>")

						{

						document.getElementById('status').options[i].selected=true

						}

                }			

                </script></td>

			  </tr>

			   <tr><td colspan="3" height="7"></td></tr>

	<tr>

	<td align="left" valign="middle" colspan="3"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?><input <?php echo $hdn_in_up;?> type="submit" value="" >	</td>

	</tr>

        </table>

	</form>	

	</div>

  </div>

 <?php }?>