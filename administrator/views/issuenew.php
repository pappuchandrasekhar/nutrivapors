<?php 
include('includes/session.php');
include("model/issue.class.php");
$issueObj=new issueClass();
//echo "<pre>";
/*Multiple delete Starts*/
if($_POST['Delete_checked'])
{
$checked_count=count($_POST['list']);
for($i=0;$i<$checked_count;$i++)
{
$del_id = $_POST['list'][$i];
$issueObj->IssueDelete($del_id);
}
}
/*Multiple delete Ends*/
if($_GET['action']=="delete"){
   $issueObj->IssueDelete($_GET['id']);
}
if($_POST['admininsert']=="Submit"){
   $issueObj->insertIssue($_POST);
}
if($_POST['admininsert']=="Update"){
   $issueObj->updateIssue($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$issueObj->getissueData($_GET['id']); 
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
//else
//$limit=10;
//if($_GET['fld']!="")
//$fldname=$_GET['fld'];
//else
//$fldname="qid";
//if($_GET['ord']!="")
//$orderby=$_GET['ord'];
//else
//$orderby="DESC";
else

$limit=1;

if($_GET['fld']!="")

 $fiild=$_GET['fld'];

else

 $fiild="display_order";

if($_GET['ord']!="")

$ordby=$_GET['ord'];

else

$ordby="ASC";


$allforumlist=$issueObj->getAllissueList($fiild,$orderby,$start,$limit);
//print_r($allforumlist);
$total=$issueObj->getAllissueListCount('');

if($option!="com_issuenew_insert"){
?>
<div class="box" >
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt="">Exam&nbsp;&nbsp;>>&nbsp;Questions</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_issuenew_insert';"></td>
</tr>
</table>
</div>
<!----------starts------------------>
<script language="JavaScript">
$(function () {
       $('#select-all').click(function (event) {

           var selected = this.checked;
           // Iterate each checkbox  bye
		   
           $(':checkbox').each(function () {    this.checked = selected; });

       });
    });
</script>
<!----------ends------------------>
<div class="content">
<form name="myform"  action="" method="post">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
             <td width="49" align="center" valign="middle"><input type="checkbox" name="select-all" id="select-all"></td>
			   <td width="59" align="center" valign="middle">sno</td>
			   <td width="182" align="left" valign="middle" >Exam Type</td>
			   <td width="779" align="left" valign="middle" >Question </td>
              
 <td width="76" align="center" valign="middle" >Status</td>
              <td width="80" align="center" valign="middle" >Edit</td>
			  <td width="94" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
			if(sizeof($allforumlist)>0)
			{
				$ii=0;
				foreach($allforumlist as $allforum_list)
				{
			?>
			<tr height="22">
			<td align="center" valign="middle"> <input type="checkbox" id="list" name="list[]" value="<?php echo $allforum_list->qid;?>"></td>
			<td align="center" valign="middle"><?=($ii+1);?></td>
			<td  align="left" valign="middle"><?php $allforum_list->exam_id;
			$issuecat=$issueObj->getissueCategoryData($allforum_list->exam_id);
			echo $issuecat->catetitle;
			?>	</td>
			<td  align="left" valign="middle"><?php echo $allforum_list->bigtext;?>		</td>
			<td align="center" valign="middle"><?php echo $allforum_list->status; ?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=com_issuenew_insert&id=<?php echo $allforum_list->qid;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_issuenew&action=delete&id=<?php echo $allforum_list->qid;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>			  </td>
			</tr>
			<?php
				$ii++; }
				?>
			<tr>
			<td colspan="9" ><input type="submit" name="Delete_checked" value="Delete All" /></td>
			</tr>
			<?php
				 } else{
			?>
							<tr><td colspan="9" align="center" height="100">No Records..</td></tr>
			<?php 
			}
			?>
			</tbody>
						<tr><td colspan="11" align="left">
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
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_issuenew', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		
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
 if(trim(document.frmCreatestate.exam_id.value)=="")
	{ 
	alert(" Please Select Category");
	document.frmCreatestate.exam_id.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.cid.value)=="")
	{ 
	alert(" Please Select Exam Type");
	document.frmCreatestate.cid.focus();
	return false;
	}
	
	var news_info = tinyMCE.get('bigtext').getContent();
	if(news_info.length<1)
	{
	alert("Please Enter Question");  
	tinyMCE.get('bigtext').focus();
	return false;
	}	
	
	
	
	 var field_title=document.getElementsByName('field_title[]');


    for (var i = 0; i < field_title.length; i++)
    {
       
      if(field_title[i].value=='')
      {
     alert("Please field_title");
     field_title[i].value='';
     field_title[i].focus();
     return false;
      }
   
   
    }
	/*var imagehdnval="<?=$indivdata->image?>";
	if(imagehdnval=="")
	{
			var fup = document.getElementById('image');
			var fileName = fup.value;
			var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
			if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "doc")
			{
			
			} 
			else
			{
			alert("Upload atleast one Gif or Jpg image ");
			fup.focus();
			return false;
			}
	
	}
	else
	{

			if(document.frmCreatestate.hdn_image.value=="")
			{ 
			alert("Please Upload Image");
			document.frmCreatestate.hdn_image.value='';
			document.frmCreatestate.hdn_image.focus();
			return false;
			}
			if(!/(\.bmp|\.gif|\.jpg|\.jpeg|\.png|\.pdf)$/i.test(document.frmCreatestate.hdn_image.value))
			{
			alert("Please Upload Valid image/file type");
			document.frmCreatestate.hdn_image.value='';
			document.frmCreatestate.hdn_image.focus();
			return false;
			}
	}*/
	if(trim(document.frmCreatestate.answer.value)=="")
	{ 
	alert(" Please Enter  Answer");
	document.frmCreatestate.answer.focus();
	return false;
	}
	if(isNaN(document.frmCreatestate.answer.value))
	{ 
	alert(" Please Enter A Numeric  Answer Value");
	document.frmCreatestate.answer.focus();
	return false;
	}
	/*if(trim(document.frmCreatestate.marks.value)=="")
	{ 
		alert("Please Enter  Mraks");
		document.frmCreatestate.marks.value='';
		document.frmCreatestate.marks.focus();
		return false;
	} 
	if(isNaN(document.frmCreatestate.marks.value))
	{ 
	alert(" Please Enter A Numeric  Marks Value");
	document.frmCreatestate.marks.focus();
	return false;
	}*/
	
	
	
	
/* answer	if(trim(document.frmCreatestate.order.value)=="")   
	{ 
	alert(" Please Enter Order");
	document.frmCreatestate.order.focus();
	return false;
	}
	if(isNaN(document.frmCreatestate.order.value))   
	{ 
	alert(" Please Enter Numeric value");
	document.frmCreatestate.order.focus();
	return false;
	}
	
	var fup = document.getElementById('image_1');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "gif" || ext == "GIF" || ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext == "doc")
	{
		
	} 
	else
	{
		alert("Upload atleast one Gif or Jpg image ");
		fup.focus();
		return false;
	}*/
	
	/*var imagehdnval="<?=$indivdata->file_1?>";
	if(imagehdnval=="")
	{
		if(document.frmCreatestate.image_1.value=="")
		{ 
			alert("Please Upload Image");
			document.frmCreatestate.image_1.value='';
			document.frmCreatestate.image_1.focus();
			return false;
		}
		if(!/(\.bmp|\.gif|\.jpg|\.jpeg|\.png|\.pdf)$/i.test(document.frmCreatestate.image_1.value))
		{
			alert("Please Upload Valid image/file type");
			document.frmCreatestate.image_1.value='';
			document.frmCreatestate.image_1.focus();
			return false;
		}
	}
	var imagehdnval1="<?=$indivdata->file_2?>";
	if(imagehdnval1=="")
	{
		if(document.frmCreatestate.image_2.value=="")
		{ 
			alert("Please Upload Image");
			document.frmCreatestate.image_2.value='';
			document.frmCreatestate.image_2.focus();
			return false;
		}
		if(!/(\.bmp|\.gif|\.jpg|\.jpeg|\.png|\.pdf)$/i.test(document.frmCreatestate.image_2.value))
		{
			alert("Please Upload Valid File type");
			document.frmCreatestate.image_2.value='';
			document.frmCreatestate.image_2.focus();
			return false;
		}
	}
	
	*/
	/*var chks = document.getElementsByName('disp[]');
	var hasChecked = false;
	for (var i = 0; i < chks.length; i++)
	{
		if (chks[i].checked)
		{
			hasChecked = true;
			break;
		}
	}
	if (hasChecked == false)
	{
	alert("Please select at least one Term.");
	return false;
	}*/
	<!----------------image validation---------------------->
	
	
	
	
	
	return true;
}
	
function medical_validations()
{

 var field_title=document.getElementsByName('field_title[]');
var clamp_unit_cal=document.getElementsByName('clamp_unit_cal[]');
var clamp_standard_err=document.getElementsByName('clamp_standard_err[]');
var clamp_expended=document.getElementsByName('clamp_expended[]');


    for (var i = 0; i < field_title.length; i++)
    {
       
      if(field_title[i].value=='')
      {
     alert("Please field_title");
     field_title[i].value='';
     field_title[i].focus();
     return false;
      }
   
   
    }
  
   return true;
}

	
	/*var imagehdnval="<?=$indivdata->image?>";
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
		return false; editor_plugin
		}
	}*/
	

</script>
<?php /*?><script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "equation,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,equation",
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
		media_external_list_url : "tinymce/examples/lists/media_list.js",

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
<?php */?>

<script type="text/javascript" src="js/editordemo/jscripts/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js"></script>
<script type="text/javascript">
var AMTcgiloc = "http://www.imathas.com/cgi-bin/mimetex.cgi";  		//change me
</script>

<!-- TinyMCE -->
<script type="text/javascript" src="js/editordemo/jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    theme_advanced_buttons1 : "fontselect,fontsizeselect,formatselect,bold,italic,underline,strikethrough,separator,sub,sup,separator,cut,copy,paste,undo,redo",
    theme_advanced_buttons2 : "justifyleft,justifycenter,justifyright,justifyfull,separator,numlist,bullist,outdent,indent,separator,forecolor,backcolor,separator,hr,link,unlink,image,media,table,code,separator,asciimath,asciimathcharmap,asciisvg",
    theme_advanced_buttons3 : "",
    theme_advanced_fonts : "Arial=arial,helvetica,sans-serif,Courier New=courier new,courier,monospace,Georgia=georgia,times new roman,times,serif,Tahoma=tahoma,arial,helvetica,sans-serif,Times=times new roman,times,serif,Verdana=verdana,arial,helvetica,sans-serif",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    plugins : 'asciimath,asciisvg,table,inlinepopups,media',
   
    AScgiloc : 'http://www.imathas.com/editordemo/php/svgimg.php',			      //change me  
    ASdloc : 'http://www.imathas.com/editordemo/jscripts/tiny_mce/plugins/asciisvg/js/d.svg',  //change me  	
        
    content_css : "css/content.css"
});

</script>



<script>
function showCustomer(str)
{
var xmlhttp;  
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","issue.php?q="+str,true);
xmlhttp.send();
}


function showSubcat(str)
{
	//alert(str);
var xmlhttp;    
if (str=="")
  {
  document.getElementById("txtHint1").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari

  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
	
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
    document.getElementById("cid").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getsub.php?subcat="+str,true);
xmlhttp.send();
}

</script>
 <div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt="">Exam&nbsp;&nbsp;>>&nbsp;&nbsp; Add Questions &nbsp;&nbsp;/&nbsp;&nbsp; Edit <strong>Product</strong></h1></td>
<td align="right" valign="bottom">&nbsp;</td>
</tr>
</table>
</div>
<div class="content">
<form action="index.php?option=com_issuenew_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate(this.image);">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
     
		<!--<tr><td colspan="2" height="7"></td></tr>
	 <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Sub Categories :</label></td>
                <td width="94%" align="left" valign="middle">
				
				<div id="txtHint1">
				<select name="scid"  id="scid" class="select_medium required" style="width:220px;">
				<option value="">Select Sub Category</option>
				<?php  
				$all_val=$issueObj->getissueAllSubCatData($indivdata->cid);
				foreach($all_val as $bank)
				{
				?>
				<option value="<?php echo $bank->scid;?>"><?php echo $bank->catetitle;?></option>
				<?php
				}
				?>
				</select>
				<script type="text/javascript">
                for(var i=0;i<document.getElementById('scid').length;i++)
                {
					if(document.getElementById('scid').options[i].value=="<?php echo $indivdata->scid?>")
					{
						document.getElementById('scid').options[i].selected=true
					}
                }			
                </script>
				</select>
				
				</div>
				
				<?php /*?><select name="banking"  id="banking" style="width:220px;" class="select_medium required" >
				<option value="">Select Banking / Organizer</option>
				<?php */?>
				</td>
	</tr>
			  <tr><td colspan="2" height="7"></td></tr>
			  
			  <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Plan:</label></td>
                <td width="94%" align="left" valign="middle">
				<select name="plans" id="plans" style="width:220px;" class="select_medium required">
				<option value="">Select Plan</option>
				<?php  
				$all_val=$issueObj->getAll_Data('plans');
				foreach($all_val as $plans)
				{
				?>
				<option value="<?php echo $plans->id;?>"><?php echo $plans->title;?></option>
				<?php
				}
				?>
				</select>
				<script type="text/javascript">
                for(var i=0;i<document.getElementById('plans').length;i++)
                {
					if(document.getElementById('plans').options[i].value=="<?php echo $indivdata->p_id?>")
					{
						document.getElementById('plans').options[i].selected=true;
					}
                }			
                </script>
				</td>
	</tr><tr><td colspan="2" height="7"></td></tr>
			    <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Title: </label></td>
                <td width="94%" align="left" valign="middle">
				<input name="title" class="text_large required" type="text" value="<?php echo $indivdata->title;?>" /></td>
	  </tr>
				-->
				
			 
                	

<script type="text/javascript" src="js/jquery.highlightFade.js"></script>
<script type="text/javascript">

function addFormField() {
	var id = document.getElementById("id").value;
	var count =document.getElementById("countid").value;
	
	
		$("#divTxt").append("<div id='row" + id + "'><div style='border:1px solid #ccc;position:relative;z-index:9;width:700px;height:auto;padding:10px'><div class='clearfix'></div><label>No:&nbsp;&nbsp;</label>&nbsp;&nbsp;<input type='text' size='2' name='option_val[]' value='" + id + "' />&nbsp;<label>Name:&nbsp;&nbsp;&nbsp;</label><input name='field_title[]' type='text' value='' maxlength='400' size='70' />&nbsp;<br> <div class='clearfix'></div><input type='hidden' name='no_count[]' value='" + id + "'><div class='clearfix'></div><a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;'><img src='allfiles/Delete-Button_06.png' alt='delete' style='position:absolute;top:-1px;right:-33px' /></a></div><br></div>");
	
	/*$('#row' + id).highlightFade({
		speed:1000
	});*/
	id = (id - 1) + 2;
	var countid = document.getElementById("countid").value;
	var b=1;
	document.getElementById("id").value = id;
	document.getElementById("countid").value=parseInt(countid)+parseInt(b);
}


function removeFormField(id) {
var countid = document.getElementById("countid").value;
	$(id).remove();
	var b=1;
	//document.getElementById("countid").value=parseInt(countid)-parseInt(b);
	document.getElementById("id").value=parseInt(document.getElementById("id").value)-parseInt(b);
}
</script>


	
				
			    <tr>
                <td align="left" valign="top" class="caption-field" ><label class="title">Options:</label></td>
				<td align="left" valign="top" class="caption-field" >
				
				<?php if($_GET['id']==''){?>
				<div style="border:1px solid #ccc; width:700px; height:auto;padding:10px"> 
       				
					<div class="clearfix"></div>
					<!--<label>Option Name:&nbsp;&nbsp;</label>
					<input name="title[]" type="text" class="dszentry" value="" maxlength="400" />-->
					<div class="clearfix"></div>
                    <label>No:&nbsp;&nbsp;</label>
                    <input type="text" size="2" name="option_val[]" value="1" />
					<label>Name :&nbsp;&nbsp;</label>
					<input name="field_title[]" type="text" class="dszentry" value="" maxlength="400" size="70"/><br />
					<!--<label>Value :&nbsp;&nbsp;</label>&nbsp;
					<input name="field_value[]" type="text" class="dszentry" value="" maxlength="400" size="109" />&nbsp;<br />-->
					&nbsp;<!--<input name="field_display[]" type="checkbox" class="dszentry" value="yes"   />-->
					
					<div class="clearfix"></div>
					
				  </div>
				<br />
				
				 <div id="divTxt">
	 			 </div>
				<?php 
				}
				else
				{ 
				//	echo $indivdata->id;
				$alloptionslist=$issueObj->getOptionsData($indivdata->qid);
				$ll=1;
				foreach($alloptionslist as $optionlist)
				{
				?>
				<div style="border:1px solid #ccc; width:700px; height:auto;padding:10px"> 
     				
					<div class="clearfix"></div>
					<!--<label>Option Name:&nbsp;&nbsp;</label>
					<input name="title[]" type="text" class="dszentry" value="<?php echo $optionlist->option_name;?>" maxlength="400" />-->
					<div class="clearfix"></div>
                    <label>No:&nbsp;&nbsp;</label>
                    <input type="text" size="2" name="option_val[]" value="<?php echo $optionlist->field_id;?>" />
					<label>Name :&nbsp;&nbsp;</label>
					<input name="field_title[]" type="text" class="dszentry" value="<?php echo $optionlist->value;?>" maxlength="400" size="70"/><br />
					<!--<label>Name:&nbsp;</label>
					<input name="field_title[]" type="text" class="dszentry" value="<?php echo $optionlist->value;?>" maxlength="400" size="70" /><br />
					<label>Value:&nbsp;&nbsp;</label>
					<input name="field_value[]" type="text" class="dszentry" value="<?php echo $optionlist->field_value;?>" maxlength="400" size="109" />&nbsp;<br />
					<label>Answer :&nbsp;&nbsp;</label>&nbsp;<input name="field_display[]" type="checkbox"  class="dszentry"  <?php if($optionlist->field_display=="yes"){?>  checked="checked"<?php }else{?>  <?php }?>  /><input type="text" size="2" name="field_val[]" value="<?php echo $ll;?>" />-->
					<input type="hidden" size="2" name="option_id[]" value="<?php echo $optionlist->id;?>" />
					<div class="clearfix"></div>
					
				  </div>
				<br />
				<?php 
				$ll++;
				}
				?>
				<div id="divTxt">
	 			 </div>
				<?php 
				}
				?>
					
				<a href="#" onClick="addFormField(); return false;"><img src="allfiles/Plus.png" alt="Plus" border="0" /></a>
				<?php if($_GET['id']!=''){
				$alloptionslist=$issueObj->getOptionsData($indivdata->id);
				$val_opt_cnt=count($alloptionslist)+1;
				?>
				
				<input type="hidden" name="id" id="id" value="<?php echo $val_opt_cnt;?>" />
				<?php }else{?>
				<input type="hidden" name="id" id="id" value="2" />
				<?php }?>
				<input type="hidden" name="countid" id="countid" value="2" />
				
				</td>
               
				</tr>
				
				<tr><td colspan="2" height="7"></td></tr>
				
				<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Answer : </label></td>
                <td width="94%" align="left" valign="middle">
				<?php $total_1=$issueObj->getAllissueListCount();
				$tt=$total_1+1;
				if($_GET['id']!='')
				$val=$indivdata->disp_order;
				else
				$val=$tt;
				?>
				<input name="answer" class="text_large required" type="text" value="<?php echo $indivdata->answer; ?>" /></td>
				</tr>
                <tr><td colspan="2" height="7"></td></tr>
				
				<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Marks : </label></td>
                <td width="94%" align="left" valign="middle">
				<?php $total_1=$issueObj->getAllissueListCount();
				$tt=$total_1+1;
				if($_GET['id']!='')
				$val=$indivdata->disp_order;
				else
				$val=$tt;
				?>
				<input name="marks" class="text_large required" type="text" value="<?php echo $indivdata->marks; ?>" /></td>
				</tr>
			   <tr><td colspan="2" height="7"></td></tr>
               <!-- <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Marks <span style=" color:#FF0000; font-size:14px">*</span></label></td>
                <td width="94%" align="left" valign="middle"><input name="marks" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->marks);?>" style="width:800px;"/></td>
			  </tr>
			 
			   <tr><td colspan="2" height="7"></td></tr>-->
				<tr>
                <td align="left" class="caption-field"><label class="title">Status :</label> </td>
                <td align="left" valign="middle" class="caption-field">
				<select name="status" id="status" class="select_large required" >
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
	<td align="left" valign="middle" colspan="2">
	<input name="hdn_id" type="hidden" value="<?php echo $indivdata->qid?>">
	<input name="issue_num" type="hidden" value="<?php echo $indivdata->issue_no?>">
	<input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert">
	<input <?php echo $hdn_in_up;?> type="submit" value="" >	</td>
	</tr>
  </table>
</form>	
	</div>
  </div>
 <?php }?>