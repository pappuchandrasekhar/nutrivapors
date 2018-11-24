<?php 
include('includes/session.php');
include("model/faq.class.php");
$faqObj=new faqClass();
if($_GET['action']=="delete"){
   $faqObj->faqDelete($_GET['id']);
}
if($_POST['admininsert']=="Submit"){
	//print_r($_POST);
	//echo "hai"; exit;
   $faqObj->insertfaq($_POST);
}
if($_POST['admininsert']=="Update"){
   $faqObj->updatefaq($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$faqObj->getfaqData($_GET['id']); 
  // print_r($indivdata);
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
$orderby="DESC";
$allfaq=$faqObj->getAllfaqClassList($fldname,$orderby,$start,$limit);
$total=$faqObj->getAllfaqClassListCount();
if($_POST['serchkeyword'])
$searchword = $_POST['serchkeyword'];
if($_GET['serchkeyword'])
$searchword = $_GET['serchkeyword'];
if($_POST['serchkeyword']){
	$allfaq=$faqObj->searchkeyword($searchword,$fldname,$orderby,$start,$limit);
	$total=$faqObj->getsearchkeyword1Count($searchword);
	$total = count($allfaq);
}

if($option!="com_faq_insert"){
?>
  <!-------------------------------------------->

<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/content.jpeg" alt="">FAQ</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_faq_insert';"></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="20" align="center" valign="middle" style="text-align: center;">Sno</td>
			   
             
               
               
               <td width="290" align="middle" valign="middle">question</td>
                <td width="290" align="middle" valign="middle">answer</td>
                
			  <td width="43" align="center" valign="middle" >status</td>
              <td width="35" align="center" valign="middle" >Edit</td>
			 <td width="35" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
				if(sizeof($total)>0){
					$ii=0;
					foreach($allfaq as $all_faq)
					{
				$category=$faqObj->get_All_FullNames(TPREFIX.TBL_CATEGORY,'title',"cid=".$all_faq->category);
					?>
			<tr height="22">
			<td align="center" valign="middle"><?=$ii+1;?></td>
		
           
             <td align="left" valign="middle"><?php echo $all_faq->question;?></td>
             <td align="left" valign="middle"><?php echo $all_faq->answer;?></td>
             <td align="left" valign="middle"><?php echo $all_faq->status;?></td>
             
            
			<!--<td align="center" valign="middle"x><a title="edit" href="index.php?option=com_Homepage_insert&id=<?php echo $all_faq->id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>-->
            <td align="center" valign="middle"x><a title="edit" href="index.php?option=com_faq_insert&id=<?php echo $all_faq->id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_faq&action=delete&id=<?php echo $all_faq->id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
			  </td>
			</tr>
			<?php
				$ii++; } } else{
			?>
							<tr><td colspan="6" align="center" height="100">No Records..</td></tr>
			<?php 
			}
			?>
			</tbody>
			<tr><td colspan="10" align="left"><?php if($total>$limit)
			{
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['ord']!="")
			$param.="&ord=".$_GET['ord'];
			if($_GET['ord']!="")
			$param.="&fld=".$_GET['fld'];
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_faq', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

    </table>
	
  </div>
  </div>
  
  
  
  <!------------------------------->
 <?php } else {    ?>
 <script type="text/javascript">
function trim(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function testivalidation(fld)
{


	var news_info1 = tinyMCE.get('bigtext1').getContent();
  	if(news_info1.length<1)
    {
     alert("Please Enter  question");
     tinyMCE.get('bigtext1').focus();
      return false;
     }
	
	
	 
	
var news_info = tinyMCE.get('bigtext').getContent();
  	if(news_info.length<1)
    {
     alert("Please Enter answer description");
     tinyMCE.get('bigtext').focus();
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
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockfaq,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt="" />Add faq &nbsp;&nbsp;/&nbsp;&nbsp; Edit faq</h1></td>
<td align="right" valign="bottom">&nbsp;</td>
</tr>
</table>
</div>
<div class="content">
<form action="index.php?option=com_faq_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" 
 onsubmit="return testivalidation();">
 
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
                 
    
    
    
            
    
    
    <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">question:</label></td>
                <td width="94%" align="left" valign="middle">
                <textarea name="question" ><?php echo  stripslashes($indivdata->question);?></textarea>
                </td>
	</tr>
    <tr><td colspan="2" height="7"></td></tr>
    <tr><td colspan="2" height="7"></td></tr>
    
    			
                
   <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Answer:</label></td>
                <td width="94%" align="left" valign="middle">
                <textarea name="answer" id="bigtext" cols="100" rows="25"><?php echo  stripslashes($indivdata->answer);?></textarea>
                </td>
	</tr>
			 

				<tr>
                <!--<td width="6%" align="left" class="caption-field"><label class="title">Display Order : </label></td>
                <td width="94%" align="left" valign="middle">
				<?php $total_1=$faqObj->getAllfaqClassListCount();
				$tt=$total_1+1;
				if($_GET['id']!='')
				$val=$indivdata->display_order;
				else
				$val=$tt;
				?>
				<input name="order" class="text_large required" type="text" value="<?php echo $val;?>" /></td>-->
                </tr>
            
              
			  <tr><td colspan="2" height="7"></td></tr>
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
                </script></td>
			  </tr>
			   <tr><td colspan="2" height="7"></td></tr>
                <tr><td colspan="2" height="7"></td></tr>
	
    <tr>
	<td align="left" valign="middle" colspan="2">
    <input name="hdn_id" type="hidden" value="<?php echo $indivdata->id?>">
    <input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert">
	<?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?>
    <input <?php echo $hdn_in_up;?> type="submit" value="" >	</td>
	</tr>
      </table>
	</form>	
	</div>
  </div>
 <?php }?>