<?php 
include('includes/session.php');
include("model/color.class.php");
$colorObj=new  colorClass();
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

if($option!="com_color_insert"){
?>

<div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"><h1>Panel</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onClick="window.location.href='index.php?option=com_color_insert';"></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="31" align="center" valign="middle">sno</td>
			   <td width="275" align="left" valign="middle" >title</td>
              <td width="50" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=com_color&ord=ASC&fld=title" class="up" title="up"></a>
					<a href="index.php?option=com_color&ord=DESC&fld=title" class="down" title="down"></a>
					</div>
</td>
              <td width="403" align="center" valign="middle" >Color</td>
              <td width="248" align="center" valign="middle" >Status</td>
              <td width="49" align="center" valign="middle" >Edit</td>
			  <td width="106" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
			if(sizeof($allforumlist)>0){
					$ii=0;
					foreach($allforumlist as $allforum_list){
					?>
			<tr height="22">
			<td align="center" valign="middle"><?=($ii+1);?></td>
			<td colspan="2" align="left" valign="middle"><?php echo stripslashes($allforum_list->title);?></td>
			<td align="center" valign="middle"><?php echo $allforum_list->color;?></td>
			<td align="center" valign="middle"><?php echo $allforum_list->status;?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=com_color_insert&id=<?php echo $allforum_list->dcid;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle">
			<?php
			 if($allforum_list->dcid){?>
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_color&action=delete&id=<?php echo $allforum_list->dcid;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
						<?php } else { echo "Default Caregory"; }?>
			  </td>
			</tr>
			<?php
				$ii++; } } else{
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
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_color', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		

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
 <div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1> Panel &nbsp;&nbsp;>>&nbsp;&nbsp; Add color &nbsp;&nbsp;/&nbsp;&nbsp; Edit color</h1></td>
<td align="right" valign="bottom">&nbsp;</td>
</tr>
</table>
</div>
<div class="content">
<form action="index.php?option=com_color_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onSubmit="return validate(this.image);">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
    
    <!-- <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">panel :<span style=" color:#FF0000; font-size:14px">*</span></label></td>
                <td width="94%" align="left" valign="middle">
				<select name="pid" id="pid" class="select_medium required">
				<option value="">Select</option>
				<?php
				$alldoorlist=$colorObj->getAlldoorcolorList('Active','dcid','ASC','','');
				foreach($alldoorlist as $dlist)
				{
				?>
				<option value="<?php echo $dlist->dcid;?>"><?php echo stripslashes($dlist->title);?></option>
				<?php
				}
				?>
				</select>
				<script type="text/javascript">
                for(var i=0;i<document.getElementById('pid').length;i++)
                {
						if(document.getElementById('pid').options[i].value=="<?php echo $indivdata->pid ?>")
						{
						document.getElementById('pid').options[i].selected=true
						}
                }			
                </script></td>
			  </tr>-->
   
    
    
	<tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Title:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
                <td width="94%" align="left" valign="middle"><input name="title" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->title);?>" style="width:250px;"/></td>
	</tr>
			
              <tr><td colspan="2" height="7"></td></tr>
                <tr>
				<td width="6%" align="left" valign="top" class="caption-field"><label class="title">Image:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
				<td width="94%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				<td > 
	          	<!--<input type="radio"  name="reloc" value="color" onchange="document.getElementById('my-color-picker').style.display='block';document.getElementById('image').style.display='block';document.getElementById('my-color-picker-button').style.display='none';" />want to specify color-->
            
              <!--<input type="radio"  name="reloc" value="color" onchange="document.getElementById('my-color-picker').style.display='block';document.getElementById('image').style.display='none';document.getElementById('my-color-picker-button').style.display='none';" />want to specify color-->
              
			    <!--<script type="text/javascript" src="js/farbtastic/jquery.js"></script>-->
                
                
					 <script type="text/javascript" src="js/farbtastic/farbtastic.js"></script>
                     <link rel="stylesheet" href="js/farbtastic/farbtastic.css" type="text/css" />
                     <script type="text/javascript" charset="utf-8">
                      $(document).ready(function() {
                        $('#demo').hide();
                        $('#picker').farbtastic('#color1');
                      });
                     </script>
                       
  <div class="form-item"><label for="color">Color:</label><input type="text" id="color1" name="color" value="#123456" /></div><div id="picker"></div>
				</td>

				
                
                
                
             <!--   <tr>
				<td width="31%">
               <input type="text" name="my-color-picker" value="" id="my-color-picker" style="display:none;" />
				<input type="text" name="image" value=""  class="minicolors" id="minicolors"  />
				</td>
				-->
                
                
                
				</tr>
				
				</table></td>
				</tr>
			   
				<tr><td colspan="2" height="7"></td></tr>
                 
                
                
                
             
			   <tr><td colspan="2" height="7"></td></tr>
    <tr>
    <td align="left" class="caption-field"><label class="title">Status :<span style=" color:#FF0000; font-size:14px">*</span></label> </td>
    <td align="left" valign="middle" class="caption-field">
    <select name="status" id="status" class="select_large required">
	<option value="">Select</option>
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
	<td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->dcid?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?><input <?php echo $hdn_in_up;?> type="submit" value="" style="width:100px;">	</td>
	</tr>
        </table>
	</form>	
	</div>
  </div>
 <?php }?>