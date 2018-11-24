<script type="text/javascript" src="js/cal/jsDatePick.min.1.3.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="js/cal/jsDatePick_ltr.min.css" />
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"postdate",
			dateFormat:"%Y-%m-%d"
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"beige",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>
<?php 

include('includes/session.php');

include("model/newsevent.class.php");

$newseventsObj=new newseventsClass();

if($_GET['action']=="delete"){

   $newseventsObj->neweventsDelete($_GET['id']);

}
if($_POST['updatedisporder']=="Update"){
   $newseventsObj->updateDispOrder($_POST);
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

$limit=1;

if($_GET['fld']!="")

$fldname=$_GET['fld'];

else

$fldname="id";

if($_GET['ord']!="")

$orderby=$_GET['ord'];

else

$orderby="ASC";

$allnewevnets=$newseventsObj->getAllNeweventsList($fldname,$orderby,$start,$limit);

$total=$newseventsObj->getAllNeweventsListCount();



if($option!="com_newseventslist_insert"){

?>

<div class="box">
  <div class="heading">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt=""> News</h1></td>
        <td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_newseventslist_insert';"></td>
      </tr>
    </table>
  </div>
  <div class="content">
    <form action="" method="post">
      <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
        <thead>
          <tr height="25">
            <td width="20" align="center" valign="middle">sno</td>
            <td width="290" align="left" valign="middle" >title</td>
            <td width="808" align="left" valign="middle" class="sort"><div > <a href="index.php?option=com_newseventslist&ord=ASC&fld=title" class="up" title="up"></a> <a href="index.php?option=com_newseventslist&ord=DESC&fld=title" class="down" title="down"></a> </div></td>
            <td width="290" align="left" valign="middle" >Status</td>
            <td width="190" align="center" valign="middle" >Display Order</td>
            <td width="35" align="center" valign="middle" >Edit</td>
            <td width="35" align="center" valign="middle" >Delete</td>
          </tr>
        </thead>
        <tbody>
          <?php

			if(sizeof($allnewevnets)>0){

					$ii=0;

					foreach($allnewevnets as $all_newevnets){

					?>
          <tr height="22">
            <td align="center" valign="middle"><?=($ii+1);?></td>
            <td colspan="2" align="left" valign="middle"><?php echo stripslashes($all_newevnets->title);?></td>
            <td align="left" valign="middle"><?php echo $all_newevnets->status;?></td>
            <td align="center" valign="middle">
			<input type="text" name="disp_order[]" value="<?=$all_newevnets->disp_order?>"  style="width:14px;height:12px;border:1px solid #E2DEDE;"/>
            <input type="hidden" name="disp_order_ids[]" value="<?=$all_newevnets->id?>"  />
			</td>
            <td align="center" valign="middle"x><a title="edit" href="index.php?option=com_newseventslist_insert&id=<?php echo $all_newevnets->id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
            <td align="center" valign="middle"><a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_newseventslist&action=delete&id=<?php echo $all_newevnets->id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a> </td>
          </tr>
          <?php

				$ii++; } } else{

			?>
          <tr>
            <td colspan="8" align="center" height="100">No Records..</td>
          </tr>
          <?php 

			}

			?>
        </tbody>
        <tr>
          <td colspan="4" align="right">&nbsp;</td>
          <td colspan="1" align="center"><input type="submit" name="updatedisporder" value="Update" /></td>
          <td colspan="3" align="right">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="10" align="left"><?php if($total>$limit)

			{

			?>
            <ul class="paginator" style="float:right; margin-left:-25px;">
              <?php 

			$param="";

			if($_GET['ord']!="")

			$param.="&ord=".$_GET['ord'];

			if($_GET['ord']!="")

			$param.="&fld=".$_GET['fld'];

			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_newseventslist', $param);

			?>
            </ul>
            <?php 

			}

			?></td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php } else {?>
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


<script type="text/javascript">

function trim(stringToTrim)

{

return stringToTrim.replace(/^\s+|\s+$/g,"");

}

function validate(fld)

{

	if(trim(document.frmCreatestate.title.value)=="")

	{ 

		alert("Please enter Title");

		document.frmCreatestate.title.value='';

		document.frmCreatestate.title.focus();

		return false;

	}

		if(trim(document.frmCreatestate.bigtext.value)=="")

	{ 

		alert("Please enter Content");

		document.frmCreatestate.bigtext.value='';

		document.frmCreatestate.bigtext.focus();

		return false;

	}

document.frmCreatestate.submit();

return true;

}

</script>
<div class="box">
  <div class="heading">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt=""> Add News &nbsp;&nbsp;/&nbsp;&nbsp; Edit News</h1></td>
        <td align="right" valign="bottom">&nbsp;</td>
      </tr>
    </table>
  </div>
  <div class="content">
    <form action="index.php?option=com_newseventslist_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate(this.image);">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td width="6%" align="left" class="caption-field"><label class="title">Testimonial Title:</label></td>
          <td width="94%" align="left" valign="middle"><input name="testimonialtitle" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->testimonialtitle);?>" style="width:800px;"/></td>
        </tr>
        <tr>
          <td colspan="2" height="7"></td>
        </tr>
		
		 <tr>
          <td width="6%" align="left" class="caption-field"><label class="title">Title:</label></td>
          <td width="94%" align="left" valign="middle"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title);?>" style="width:800px;"/></td>
        </tr>
		
		
		
		
		
		
		
		
		
		
        <!-- <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Posted Date:</label></td>
                <td width="94%" align="left" valign="middle">
               
                <input name="postdate" id="postdate" class="text_large required"  style="width:100px;" type="text" value="<?php echo  stripslashes($indivdata->postdate);?>"/></td>
			  </tr>-->
			  <tr><td colspan="2" height="7"></td></tr>
       <tr>

                <td align="left" valign="top" class="caption-field"><label class="title">Content:<span style=" color:#FF0000; font-size:14px">*</span></label></td>

				<td align="left" valign="middle" class="caption-field">   
				<textarea name="bigtext" id="content_matter" cols="157" rows="20"><?php echo  stripslashes($indivdata->bigtext);?></textarea>

           <?php /*?> <?

				include 'fckeditor/fckeditor.php'; 

				$sBasePath = 'fckeditor/' ;//to change in web root

				$oFCKeditor = new FCKeditor('bigtext') ;  //name of the form-field to be generated

				$oFCKeditor->BasePath	= $sBasePath ;

				$oFCKeditor->Value		= stripslashes($indivdata->bigtext) ;//the matter that may be in db

				$oFCKeditor->Height=250;

				$oFCKeditor->Width=810;

				$oFCKeditor->Create() ;

				?><?php */?>
                </td>
        </tr>
        <tr>
          <td colspan="2" height="7"></td>
        </tr>
        
        <tr><td colspan="2" height="7"></td></tr>
			   <tr>
				<td width="6%" align="left" valign="middle" class="caption-field"><label class="title">Image :</label></td>
				<td width="94%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				<td width="31%"><input type="file" name="image" size="24"></td>
				<td width="69%"><?php if($indivdata->image!=""){
				?>
				<img src="../uploads/newsevents/testimonial/<?php echo $indivdata->image; ?>" width="150" height="150" />
				<input type="hidden" name="image" size="24" value="<?php echo $indivdata->image; ?>">
				<?php
				}
				?> <span style="font-size:11px">(Image sizes: width:380px height:550px)</span></td>
				</tr>
						
				</table></td>
				</tr>
		
        <tr>
        <tr>
          <td align="left" class="caption-field"><label class="title">Status :</label>
          </td>
          <td align="left" valign="middle" class="caption-field"><select name="status" id="status" class="select_large required">
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
        <tr>
          <td colspan="2" height="7"></td>
        </tr>
       <!-- <tr>
          <td align="left" class="caption-field"><label class="title">Display Order:</label>
          </td>
          <td align="left" valign="middle" class="caption-field"><input name="disp_order" class="text_small required" type="text" value="<?php //echo $indivdata->disp_order;?>" style="width:30px;"/></td>
        </tr>-->
        <tr>
          <td colspan="2" height="7"></td>
        </tr>
        <tr>
          <td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->id?>">
            <input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert">
            <?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?>
            <input <?php echo $hdn_in_up;?> type="submit" value="" >
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php }?>
