<?php 
include('includes/session.php');
include("model/store.class.php");
$storeObj=new storeClass();
if($_GET['action']=="delete"){
   $storeObj->storeCategoryDelete($_GET['id']);
}
if($_POST['admininsert']=="Submit"){
   $storeObj->insertStoreCategory($_POST);
}
if($_POST['admininsert']=="Update"){
   $storeObj->updateStoreCategory($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$storeObj->getStoreCategoryData($_GET['id']); 
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
$fldname="scid";
if($_GET['ord']!="")
$orderby=$_GET['ord'];
else
$orderby="DESC";
$allforumlist=$storeObj->getAllStoreCategoryList('',$fldname,$orderby,$start,$limit);
$total=$storeObj->getAllStoreCategoryListCount('');

if($option!="com_storecat_insert"){
?>

 <script>window.jQuery || document.write('<script src="assets/jquery-2.0.3.min.js"><\/script>')</script> 
        <script src="assets/datatables/jquery.dataTables.js"></script>
        <script>
            $(function() { metisTable(); metisSortable();});
        </script> <script src="assets/js/main.js"></script>
        <script src="assets/tablesorter/js/jquery.tablesorter.min.js"></script>
        <script src="assets/datatables/DT_bootstrap.js"></script>

       <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
       <link rel="stylesheet" href="assets/datatables/css/DT_bootstrap.css">
       <style>
	   .row
	   {
		   width:850px;
	   }
	   .col-lg-6
	   {
		   width:367px;
	   }
	     .dataTables_length{ margin-top:-55px;}
	   </style>

<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt="">Store &nbsp;&nbsp;>>&nbsp;&nbsp;Category</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_storecat_insert';"></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
          <thead>
            <tr height="40">
                <th width="20" align="center" valign="middle">sno</th>
                 <th width="50" align="left" valign="middle" >title</th>
                 <th width="220" align="left" valign="middle" >Image</th>
                <th width="80" align="left" valign="middle" >Status</th>
                <th width="50" align="left" valign="middle" >Edit</th>
                <th width="90" align="center" valign="middle" >Delete</th>
               
            </tr>
          </thead>
          
			<tbody>
			<?php
			if(sizeof($allforumlist)>0){
					$ii=0;
					foreach($allforumlist as $allforum_list){
					?>
			<tr height="30">
			<td align="middle" valign="middle"><?=($ii+1);?></td>
			<td  align="middle" valign="middle" ><?php echo stripslashes($allforum_list->catetitle);?></td>
            <td  align="middle" valign="middle"><img src="../uploads/store/category/<?php echo $allforum_list->image; ?>" height="60" width="60"/></td>
			<td align="middle" valign="middle"><?php echo $allforum_list->status;?></td>
			<td align="middle" valign="middle"x><a title="edit" href="index.php?option=com_storecat_insert&id=<?php echo $allforum_list->scid;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="middle" valign="middle">
			
			<?php if(($allforum_list->scid=='3') || ($allforum_list->scid=='4') || ($allforum_list->scid=='5') || ($allforum_list->scid=='6') || ($allforum_list->scid=='1') || ($allforum_list->scid=='2')) {?> default <?php } else {?>
            <a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_storecat&action=delete&id=<?php echo $allforum_list->scid;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
				<?php }?>		
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
						
      </table>
	
	</div>
  </div>
 <?php } else {?>
<script type="text/javascript">
function trim(stringToTrim)
{
return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function validate(fld)
{
	if(trim(document.frmCreatestate.catetitle.value)=="")
	{ 
		alert("Please enter Category title");
		document.frmCreatestate.catetitle.value='';
		document.frmCreatestate.catetitle.focus();
		return false;
	}
		<?php /*?>if(trim(document.frmCreatestate.bigtext.value)=="")
	{ 
		alert("Please enter Description");
		document.frmCreatestate.bigtext.value='';
		document.frmCreatestate.bigtext.focus();
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
	}<?php */?>
	 var pgtit=trim(document.frmCreatestate.title.value);
           if(pgtit=="")

			{

				alert("Please Enter pagetitle");

				document.frmCreatestate.title.focus();

				return false;

		    }
			var titslug=trim(document.frmCreatestate.title_slug.value);
           if(titslug=="")

			{

				alert("Please Enter titleslug");

				document.frmCreatestate.title_slug.focus();

				return false;

		    }
			var mtkey=trim(document.frmCreatestate.meta_keyword.value);
           if(mtkey=="")

			{

				alert("Please Enter metakeyword");

				document.frmCreatestate.meta_keyword.focus();

				return false;

		    }
			
			var metdsc=trim(document.frmCreatestate.meta_desc
.value);
           if(metdsc=="")

			{

				alert("Please Enter metadescription");

				document.frmCreatestate.meta_desc.focus();

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
<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt=""> Store &nbsp;&nbsp;>>&nbsp;&nbsp; Add Category &nbsp;&nbsp;/&nbsp;&nbsp; Edit Category</h1></td>
<td align="right" valign="bottom">&nbsp;</td>
</tr>
</table>
</div>
<div class="content">
<form action="" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate(this.image);">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Title:</label></td>
                <td width="94%" align="left" valign="middle"><input name="catetitle" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->catetitle);?>" style="width:800px;"/></td>
	</tr>
			 <?php /*?> <tr><td colspan="2" height="7"></td></tr>
			    <tr>
                <td align="left" valign="top" class="caption-field"><label class="title">Description:</label></td>
                <td align="left" valign="middle" class="caption-field"><textarea name="bigtext" id="bigtext" cols="157" rows="2"><?php echo  stripslashes($indivdata->bigtext);?></textarea></td>
				</tr>
				 <tr><td colspan="2" height="7"></td></tr>
				 <tr>
				<td width="6%" align="left" valign="top" class="caption-field"><label class="title">Image:</label></td>
				<td width="94%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				<td width="31%"><input type="file" name="image" size="24"></td>
				<td width="69%"><?php if($indivdata->image!=""){
				?>
				<img src="../uploads/store/category/<?php echo $indivdata->image; ?>" width="185" height="79" />
				<input type="hidden" name="hdn_image" size="24" value="<?php echo $indivdata->image; ?>">
				<?php
				}
				?></td>
				</tr>
				</table></td>
				</tr><?php */?>
			   
				<tr><td colspan="2" height="7"></td></tr>
                
                 <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Page Title:</label></td>
                <td width="94%" align="left" valign="middle"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title);?>" style="width:800px;"/></td>
			  </tr>
              
              
              
              <tr><td colspan="2" height="7"></td></tr>
              
                <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">CONTENT:</label></td>
                <td width="94%" align="left" valign="middle"><textarea name="content" id="content_matter" cols="157" rows="20"><?php echo  stripslashes($indivdata->bigtext);?></textarea></td>
			  </tr>
              
              
              
              <tr><td colspan="2" height="7"></td></tr>
              
              <tr>
				<td width="6%" align="left" valign="middle" class="caption-field"><label class="title">Image :</label></td>
				<td width="94%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				<td width="31%"><input type="file" name="image" size="24"></td>
				<td width="69%"><?php if($indivdata->image!=""){
				?>
				<img src="../uploads/store/category/<?php echo $indivdata->image; ?>" width="150" height="150" />
				<input type="hidden" name="hdn_image" size="24" value="<?php echo $indivdata->image; ?>">
				<?php
				}
				?> <span style="font-size:11px">(Image sizes: width:321px height:376px)</span></td>
				</tr>
				</table></td>
				</tr>
              
              
              
              
              
			  <tr><td colspan="2" height="7"></td></tr>
               <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Title Slug :</label></td>
                <td width="94%" align="left" valign="middle"><input name="title_slug" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title_slug);?>" style="width:800px;"/><br />
                <small style="color:#FF0000">* (Provide Unique Slug Name )</small>                </td>
	</tr>
			  <tr><td colspan="2" height="7"></td></tr>
               <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Meta Keyword:</label> </td>
                <td width="94%" align="left" valign="middle"><input name="meta_keyword" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->meta_keyword);?>" style="width:800px;"/></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
			  <tr>
                <td width="6%" align="left" class="caption-field"> <label class="title">Meta Description:</label> </td>
                <td width="94%" align="left" valign="middle"><input name="meta_desc"  class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->meta_desc);?>" style="width:800px;"/></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
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
                </script>
				</td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
	<tr>
	<td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->scid?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?><input <?php echo $hdn_in_up;?> type="submit" value="" >	</td>
	</tr>
        </table>
	</form>	
	</div>
  </div>
 <?php }?>