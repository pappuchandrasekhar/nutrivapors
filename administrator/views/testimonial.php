<?php 
include('includes/session.php');
include("model/testimonial.class.php");
$testimonialObj=new testimonialClass();
if($_GET['action']=="delete"){
   $testimonialObj->neweventsDelete($_GET['id']);
}
if($_POST['admininsert']=="Submit"){
   $testimonialObj->insertNewevents($_POST);
}
if($_POST['admininsert']=="Update"){
   $testimonialObj->updateNewevents($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$testimonialObj->getNeweventData($_GET['id']); 
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
$limit=1;
if($_GET['fld']!="")
$fldname=$_GET['fld'];
else
$fldname="id";
if($_GET['ord']!="")
$orderby=$_GET['ord'];
else
$orderby="ASC";
$allnewevnets=$testimonialObj->getAllNeweventsList($fldname,$orderby,$start,$limit);
$total=$testimonialObj->getAllNeweventsListCount();

if($option!="com_testimonial_insert"){
?>
<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt=""> testimonial</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_testimonial_insert';"></td>
</tr>
</table>
</div>
<script type="text/javascript">

$(document).ready(function(){ 
	$(function() {

		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {

			var order = $(this).sortable("serialize") + '&action=updatetestimonial'; 

			$.post("updateDB.php", order, function(theResponse){

				$("#contentRight").html(theResponse);

			}); 															 

		}								  

		});







	});

});	

</script>
<div id="contentLeft" style="border:0px solid red;">
      <ul style="margin:0px;margin-left:-40px;margin-top:6px;">
        <li style="border:1px solid #CCCCCC;background-color:#F2F2F2;list-style-type: none; ">
          <table width="100%">
            <thead>
              <tr height="25">
               <!-- <td width="216" align="left" valign="middle"><strong>Category</strong></td>-->
                <td width="216" align="left" valign="middle"><strong>Title</strong></td>
                <td width="784" align="left" valign="middle" ><strong>Image</strong></td>
                <td width="93" align="left" valign="middle" ><strong>STATUS</strong></td>
                <td width="71" align="center" valign="middle" ><strong>EDIT</strong></td>
                <td width="120" align="center" valign="middle" ><strong>DELETE</strong></td>
              </tr>
            </thead>
          </table>
        </li>
      </ul>
    <ul style="margin:0px;margin-left:-40px;list-style-type: none;">
                <?php
				 $query  = "SELECT * FROM tb_testimonial ORDER BY display_order ASC";
				$query.=" LIMIT ".$start." ,".$limit;
				$result = mysql_query($query) or die(mysql_error());
				$ii=1;
				$rowcount=mysql_num_rows($result);
				if($rowcount>0)
				{
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				?>
        <li id="recordsArray_<?php echo $row['id']; ?>" >
          <table width="100%" border="0" style="border:1px solid #EDE8E8;">
            <tr height="25">
              <?php /*?><td width="216" align="left" valign="middle"><?php if($row['category']==1){ echo "Home";}elseif($row['category']==2){ echo "About Us";}elseif($row['category']==3){ echo "Features";}elseif($row['category']==4){ echo "Gallery";}elseif($row['category']==5){ echo "Our Range";}elseif($row['category']==6){ echo "Contact Us";} ?></td><?php */?>
              <td width="216" align="left" valign="middle"><?php echo  stripslashes($row['title']); ?></td>
              
              <td width="787" align="left" valign="middle" >
              <?php if($row['image']!=''){?>
              <img src="../uploads/testimonial/<?php echo $row['image'];?>" height="75" width="220">
              <?php }else{?>
              <img src="../uploads/testimonial/no_preview.gif" height="75" width="220">
              <?php }?>
              </td>
              <td width="93" align="left" valign="middle" ><?php echo  $row['status']; ?></td>
              <td width="72" align="center" valign="middle" ><a title="edit" href="index.php?option=com_testimonial_insert&id=<?php echo $row['id']?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
              <td width="86" align="center" valign="middle" ><a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_testimonial&action=delete&id=<?php echo $row['id'];?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a> </td>
            </tr>
          </table>
        </li>
        <?php 

				$ii++;

				} 
				}
				else
				{
				?>
               <table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"> No Records</td>
  </tr>
</table>

			<?php 
            }
            ?>
      </ul>
    </div>
  </div>
 <?php } else {?>
<script type="text/javascript">
function trim(stringToTrim)
{
return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function validate()
{
	<?php /*?>if(trim(document.frmCreatestate.category.value)=="")
	{ 
		alert("Please Select Category");
		document.frmCreatestate.category.value='';
		document.frmCreatestate.category.focus();
		return false;
	}<?php */?>
	if(trim(document.frmCreatestate.title.value)=="")
	{ 
		alert("Please Enter Title");
		document.frmCreatestate.title.value='';
		document.frmCreatestate.title.focus();
		return false;
	}
	var testimonial_info = tinyMCE.get('bigtext').getContent();
	if(testimonial_info.length<1)
	{
	alert("Please Enter Content");
	tinyMCE.get('bigtext').focus();
	return false;
	}
	var imagehdnval="<?=$indivdata->image?>";
	if(imagehdnval=="")
	{
		if(trim(document.frmCreatestate.image.value)=="")
		{ 
		alert("Please Upload Image");
		document.frmCreatestate.image.value='';
		document.frmCreatestate.image.focus();
		return false;
		}
		if(!/(\.bmp|\.gif|\.jpg|\.jpeg|\.png)$/i.test(fld.value))
		{
		alert("Please Upload Valid image/file type");
		fld.value='';
		fld.focus();
		return false;
		}
	}
		
//document.frmCreatestate.submit();
return true;
}
</script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">/*
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
	});*/
</script>
 <div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt=""> Add testimonial &nbsp;&nbsp;/&nbsp;&nbsp; Edit testimonial</h1></td>
<td align="right" valign="bottom">&nbsp;</td>
</tr>
</table>
</div>
<div class="content">
<form action="index.php?option=com_testimonial_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
    		
				<!--<tr>
                <td align="left" class="caption-field"><label class="title">Name :</label> </td>
                <td align="left" valign="middle" class="caption-field">
   </td>
			  </tr>-->
	<?php /*?><tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Category:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
                <td width="94%" align="left" valign="middle"> 
                <select name="category" id="category" class="select_large required">
     <option value="1">Home</option>
	<option value="2">About Us</option>
    <option value="3">Features</option>
    <!--<option value="Create your Wardrobe">Create your Wardrobe</option>-->
    <option value="4">Gallery</option>
    <option value="5">Our Range</option>
    <option value="6">Contact Us</option>
	</select>

	<script type="text/javascript">
                for(var i=0;i<document.getElementById('category').length;i++)
                {
						if(document.getElementById('category').options[i].value=="<?php echo  stripslashes($indivdata->category);?>")
						{
						document.getElementById('category').options[i].selected=true
						}
                }			
                </script>
                </td>
	</tr><?php */?>
			  <tr><td colspan="2" height="7"></td></tr>
               <tr>   <td width="6%" align="left" class="caption-field"><label class="title">Title:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
               
               
               
               
                 <td width="94%" align="left" valign="middle"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title);?>" style="width:210px;"/></td>
               </tr>
               
                <tr><td colspan="2" height="7"></td></tr>
               
			    <tr>
                <td align="left" valign="top" class="caption-field"><label class="title">Comment:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
                <td align="left" valign="middle" class="caption-field"><textarea name="bigtext" id="bigtext"  cols="70" rows="5"><?php echo  stripslashes($indivdata->description);?></textarea>
				<?php /*?><?
				include 'fckeditor/fckeditor.php'; 
				$sBasePath = 'fckeditor/' ;//to change in web root
				$oFCKeditor = new FCKeditor('bigtext') ;  //name of the form-field to be generated
				$oFCKeditor->BasePath	= $sBasePath ;
				$oFCKeditor->Value		= stripslashes($indivdata->bigtext) ;//the matter that may be in db
				$oFCKeditor->Height=250;
				$oFCKeditor->Width=810;
				$oFCKeditor->Create() ;
				?><?php */?></td>
				</tr>
				 <tr><td colspan="2" height="7"></td></tr>
                 <tr>
          <td align="left" valign="middle" class="caption-field"><label class="title">Image :<span style=" color:#FF0000; font-size:14px">*</span></label></td>
          <td align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="31%"><input type="file" name="image" size="24" /></td>
                <td width="69%"><?php if($indivdata->image!=""){
				?>
                  <img src="../uploads/testimonial/<?php echo $indivdata->image; ?>" width="150" height="150" />
                  <input type="hidden" name="hdn_image" size="24" value="<?php echo $indivdata->image; ?>" />
                  <?php
				}
				
				
				?>
                
                <span style="font-size:11px">(Image sizes: width:100px height:100px)</span>
                </td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" height="7"></td>
        </tr>
                 
                  <tr>   <td width="6%" align="left" class="caption-field"><label class="title">Name:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
               
               
               
               
                 <td width="94%" align="left" valign="middle"><input name="name" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->name);?>" style="width:210px;"/></td>
               </tr>
                 
                 
                 
                 <tr>
          <td colspan="2" height="7"></td>
        </tr>
                 
                  <tr>   <td width="6%" align="left" class="caption-field"><label class="title">Designation:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
               
               
               
               
                 <td width="94%" align="left" valign="middle"><input name="designation" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->designation);?>" style="width:210px;"/></td>
               </tr>
                 
                 
                 
				
				<tr>
                <td align="left" class="caption-field"><label class="title">Status :</label> </td>
                <td align="left" valign="middle" class="caption-field">
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
			   <tr><td colspan="2" height="7"></td></tr>
               
			   <?php /*?><tr>
                <td align="left" class="caption-field"><label class="title">Display Order:</label> </td>
                <td align="left" valign="middle" class="caption-field"><input name="display_order" class="text_small required" type="text" value="<?php echo $indivdata->display_order;?>" style="width:30px;"/></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr><?php */?>
	<tr>
	<td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?><input <?php echo $hdn_in_up;?> type="submit" value="" >	</td>
	</tr>
        </table>
	</form>	
	</div>
  </div>
 <?php }?>