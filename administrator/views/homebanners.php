<?php 
include('includes/session.php');
include("model/banners.class.php");
$newseventsObj=new bannersClass();
if($_GET['action']=="delete"){
   $newseventsObj->neweventsDelete($_GET['id']);
}
if($_POST['admininsert']=="Submit"){
   $newseventsObj->insertNewevents($_POST);
}
if($_POST['admininsert']=="Update"){
   $newseventsObj->updateNewevents($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$newseventsObj->getNeweventData($_GET['id']); 
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
$fldname="id";
if($_GET['ord']!="")
$orderby=$_GET['ord'];
else
$orderby="ASC";
$allnewevnets=$newseventsObj->getAllNeweventsList($fldname,$orderby,$start,$limit);
$total=$newseventsObj->getAllNeweventsListCount('');

if($option!="com_bannerslist_insert"){
?>
<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt=""> Banners</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_bannerslist_insert';"></td>
</tr>
</table>
</div>
<script type="text/javascript">

$(document).ready(function(){ 
	$(function() {

		$("#contentLeft ul").sortable({ opacity: 0.6, cursor: 'move', update: function() {

			var order = $(this).sortable("serialize") + '&action=updateBanners'; 

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
        <li style="list-style:none;border:1px solid #CCCCCC;background-color:#F2F2F2;">
          <table width="100%">
            <thead>
              <tr height="25">
                <td width="216" align="left" valign="middle"><strong>Title</strong></td>
                <td width="784" align="left" valign="middle" ><strong>Image</strong></td>
                <td width="93" align="left" valign="middle" ><strong>STATUS</strong></td>
                <td width="71" align="center" valign="middle" ><strong>EDIT</strong></td>
                <td width="88" align="center" valign="middle" ><strong>DELETE</strong></td>
              </tr>
            </thead>
          </table>
        </li>
      </ul>
    <ul style="margin:0px;margin-left:-40px;">
                <?php
				$query  = "SELECT * FROM tb_banners ORDER BY display_order ASC";
				$query.=" LIMIT ".$start." ,".$limit;
				$result = mysql_query($query) or die(mysql_error());
				$ii=1;
				$rowcount=mysql_num_rows($result);
				if($rowcount>0)
				{
				while($row = mysql_fetch_array($result, MYSQL_ASSOC))
				{
				?>
        <li id="recordsArray_<?php echo $row['id']; ?>"  style="list-style:none" >
          <table width="100%" border="0" style="border:1px solid #EDE8E8;">
            <tr height="25">
          
           
              <td width="203" align="left" valign="middle"><?php echo  stripslashes($row['title']); ?></td>
              
              <td width="751" align="left" valign="middle" >
              <?php if($row['image']!=''){?>
              <img src="../uploads/banners/<?php echo $row['image'];?>" height="75" width="220">
              <?php }else{?>
              <img src="../uploads/banners/no_preview.gif" height="75" width="220">
              <?php }?>
              </td>
              <td width="88" align="left" valign="middle" ><?php echo  $row['status']; ?></td>
              <td width="69" align="center" valign="middle" ><a title="edit" href="index.php?option=com_bannerslist_insert&id=<?php echo $row['id']?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
              <td width="88" align="center" valign="middle" ><a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_bannerslist&action=delete&id=<?php echo $row['id'];?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a> </td>
            </tr>
            
             <?php
				$ii++; } } else{
			?>
							<tr><td colspan="11" align="center" height="100">No Records..</td></tr>
			<?php 
			}
			?>
			</tbody>
            
            
            <tr><td align="left" colspan="12">
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
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_bannerslist', $param);
			//print_r($_GET); exit;
			?>
			</ul>
			<?php 
			}
			?> </td></tr>
            		
</table></li>
            
            
            
            
            
            
          
       
     

		
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
	if(trim(document.frmCreatestate.title.value)=="")
	{ 
		alert("Please Enter Title");
		document.frmCreatestate.title.value='';
		document.frmCreatestate.title.focus();
		return false;
	}
	
	
	if(trim(document.frmCreatestate.content.value)=="")
	{ 
		alert("Please Enter short content");
		document.frmCreatestate.content.value='';
		document.frmCreatestate.content.focus();
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
<script type="text/javascript">
	tinyMCE.init({
		
		
	forced_root_block : "", 
    force_br_newlines : true,
    force_p_newlines : false,
		
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
<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt=""> Add Banners &nbsp;&nbsp;/&nbsp;&nbsp; Edit Banners</h1></td>
<td align="right" valign="bottom">&nbsp;</td>
</tr>
</table>
</div>
<div class="content">
<form action="index.php?option=com_bannerslist_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Title:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
                <td width="94%" align="left" valign="middle"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title);?>" style="width:800px;"/></td>
	</tr>
    
    
    
    
    <tr>
       <td width="6%" align="left" class="caption-field"><label class="title">Short Content:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
       <td width="94%" align="left" valign="middle"><textarea name="content" id="content_matter" rows="6" cols="60" maxlength="300"  value="<?php echo  stripslashes($indivdata->content);?>"   /><?php echo  stripslashes($indivdata->content);?></textarea>
       &nbsp;<span style=" color:#FF0000; font-size:14px;margin-left:30px;">*</span>&nbsp;( Max Length 300 Characters ) </span>
       </td>
	
    </tr>
    
     <tr><td colspan="2" height="7"></td></tr>
			       

<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Url Link:</label></td>
                <td width="94%" align="left" valign="middle"><input name="url" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->url);?>" style="width:800px;"/></td>
	</tr>
    

    
    
    
    
			  <tr><td colspan="2" height="7"></td></tr>
			   
				 <tr><td colspan="2" height="7"></td></tr>
                 <tr>
          <td align="left" valign="middle" class="caption-field"><label class="title">Image :<span style=" color:#FF0000; font-size:14px">*</span></label></td>
          <td align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
              <tr>
                <td width="31%"><input type="file" name="image" size="24" /></td>
                <td width="69%"><?php if($indivdata->image!=""){
				?>
                  <img src="../uploads/banners/<?php echo $indivdata->image; ?>" width="150" height="150" />
                  <input type="hidden" name="hdn_image" size="24" value="<?php echo $indivdata->image; ?>" />
                  <?php
				}
				?> <span style=" color:#FF0000; font-size:14px;margin-left:30px;">*</span>&nbsp;( Image size width:1066px ,height:447px ) </span></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td colspan="2" height="7"></td>
        </tr>
                 
				<tr>
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