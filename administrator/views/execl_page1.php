
<?php 
include('includes/session.php');
include("model/execl.class.php");
ini_set('max_execution_time','30000');
$colorObj=new  execlClass();
if($_GET['action']=="delete"){
   $colorObj->doorcolorDelete($_GET['id']);
}
if($_POST['admininsert']=="Submit"){
   $colorObj->insertdoorcolor($_POST);
}
if($_POST['admininsert']=="Update"){
  $colorObj-> updatedoorcolor($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$colorObj->getdoorcolorData($_GET['id']); 
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
$fldname="dcid";
if($_GET['ord']!="")
$orderby=$_GET['ord'];
else
$orderby="ASC";
$allforumlist=$colorObj->getAlldoorcolorList('',$fldname,$orderby,$start,$limit);
$total=$colorObj->getAlldoorcolorListCount('');

if($option!="com_execl_insert"){
?>

<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"><h1>Excel</h1></td>

<td align="right"  valign="bottom">
</td>
</tr>
</table>
</div>
<?php
require_once 'Excel/reader.php';
if($_POST['import']=='Import Excel File')
{
  $str='';
  $data = new Spreadsheet_Excel_Reader();
  $data->setOutputEncoding('CP1251');
  $data->read($_FILES['excel_file']['tmp_name']);
	error_reporting(E_ALL ^ E_NOTICE);

	 for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
	 $ques=array();
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
		   /* if($str=='')
			$str=$data->sheets[0]['cells'][$i][$j];
		    else
			$str=$str.",".$data->sheets[0]['cells'][$i][$j];*/
			//$str=$str.",<a href='view_products.php?id=".$rs->id."'>".$data->sheets[0]['cells'][$i][$j]."</a>;
				
			$ques[]=$data->sheets[0]['cells'][$i][$j];
		}
		
	 if(count($ques)>0)
	 {
	    //$ques=explode(",", $str);
		//5
		
		$fieldnames=array('c_lotid'=>mysql_real_escape_string($ques[0]),'x_description'=>mysql_real_escape_string($ques[1]) ,'x_dim1'=>mysql_real_escape_string($ques[2]),'x_dim2'=>mysql_real_escape_string($ques[3]),'n_listprice'=>mysql_real_escape_string($ques[4]),'n_netprice'=>mysql_real_escape_string($ques[5]));
		//print_r($fieldnames); exit;
	    $res=$callConfig->insertRecord(TPREFIX.TBL_STORE_SKU,$fieldnames);
		$str='';
		//print_r($);
			  
	 }
	//if( 'lotnumber'!= "" ){
		
	
	}
	
	
	header("Location:index.php?option=com_execl&err=Execl>>Excel updated successfully");
	
		
	
	
	
}




?>
<script>
function validate_excel()
{
   var valid_extensions = /(.xls)$/i; 
   
  if(document.frmexcel.excel_file.value=='')
  {
     alert("Please upload a excel file");
	 document.frmexcel.excel_file.focus();
	 return false;
  }
    else if(!valid_extensions.test(document.frmexcel.excel_file.value))
  { 
    alert("Please Upload .xls  file only for Ex:97-2003 save copy Execl ");
	 document.frmexcel.excel_file.focus();
	 return false;
  }
}
</script>
<div style="border:1px solid grey;"  >
<table >
<tr>
<td  valign="bottom">
<table width="400" border="0" ><tr><td width="94%">
<form action="" method="post" name="frmexcel" onsubmit="return validate_excel();" enctype="multipart/form-data">

<input type="file" name="excel_file" /><input type="submit" name="import" value="Import Excel File" />
<input type="hidden" name="book_id" value="<?=$_GET['id']?>" />
</form>

</td><td align="right" width="6%">

 
</td></tr></table>
</td>
</tr>
</table>
</div>

  </div>
 <?php } else {?>

<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" ></script>-->
<!--<link rel="stylesheet" type="text/css" href="js/color_picker/css/jqolor.css" />-->
<!--<link rel="stylesheet" type="text/css" href="js/color_picker/css/bootstrap.css" />-->
<!--<script type="text/javascript" src="js1/jquery.minicolors.js"></script>
<link rel="stylesheet" type="text/css" href="js1/jquery.minicolors.css"/>
<script type="text/javascript">
	$(document).ready(
		function() {
			//var myColorPicker = $('#my-color-picker').jQolor( { color : '1C72B5' } );
			//myColorPicker.bind( 'colorChange',function( event, data ) {  } );
			$('INPUT.minicolors').minicolors(settings);
		});
</script>-->


<script type="text/javascript">
function trim(stringToTrim)
{
return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function validate(fld)
{
	if(trim(document.frmCreatestate.title.value)=="")
	{ 
		alert("Please enter  title");
		document.frmCreatestate.title.value='';
		document.frmCreatestate.title.focus();
		return false;
	}
		
var color=document.frmCreatestate.color.value;
	//alert(password);
	if(color=='#123456' || color=='')
	{
	alert("please select Color");
	document.frmCreatestate.color.focus();
	return false;
	}



if(trim(document.frmCreatestate.status.value)=="")
	{ 
		alert("Please select status");
		document.frmCreatestate.status.value='';
		document.frmCreatestate.status.focus();
		return false;
	}	
	
return true;
}
</script>
 
 <?php }?>