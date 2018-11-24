<?php 
error_reporting(0);
include('includes/session.php');
include("model/bulkstore.class.php");
$storeObj=new storeClass();
include("model/color.class.php");

$colorObj=new colorClass();

include("model/brands.class.php");

$brandObj=new brandClass();

include("model/size.class.php");
$size=new sizeClass();

if($_GET['action']=="delete"){
   $storeObj->productsDelete($_GET['id']);
}
if($_POST['admininsert']=="Submit"){
	//print_r($_POST);exit;
   $storeObj->insertProducts($_POST);
}
if($_POST['admininsert']=="Update"){
	//print_r($_POST);exit;
   $storeObj->updateProducts($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$storeObj->getProductData($_GET['id']); 
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
if($_GET['id']!="")
$fldname=$_GET['id'];
else
$fldname="spid";
if($_GET['ord']!="")
$orderby=$_GET['ord'];
else
$orderby="DESC";
$allproductsdisp=$storeObj->getAllProductsList($fldname,$orderby,$start,$limit);
$total=$storeObj->getAllProductsListCount();

  $query1="select * from tb_products_size where pid='$indivdata->spid' ORDER BY id DESC";
  $resss=$callConfig->getRow($query1);



if($option!="com_bulkproducts_insert"){
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
<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt=""> Store &nbsp;&nbsp;>>&nbsp;&nbsp;Bulk Products</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_bulkproducts_insert';"></td>
</tr>
</table>
</div>
<div class="content">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0"  id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
          <thead>
            <tr height="30">
              <td align="middle" valign="middle">sno</th>
			  <td  align="middle" valign="middle" >Category</th>
             

		      <td  align="middle" valign="middle" >Product Name</th>
              
              <td  align="middle" valign="middle">Rating</th>
            
			   <td  align="middle" valign="middle" >Image</th>
              



              <td  align="center" valign="middle" >Edit</th>
			  <td  align="center" valign="middle" >Delete</th>
            </tr>
          </thead>
			<tbody>
			<?php
			if(sizeof($allproductsdisp)>0){
			$ii=0;
			foreach($allproductsdisp as $all_products){
			$categoryname=$storeObj->get_All_FullNames(TPREFIX.TBL_STORECATEGORY,'catetitle',"scid=".$all_products->scid);
			if($all_products->offer=="yes")
			$price="<s style='color:red;'> $".$all_products->oldprice."</s>&nbsp;&nbsp;$".$all_products->newprice;
			else
			$price="$".$all_products->newprice;
			?>
			<tr height="30">
			<td align="middle" valign="middle"><?=($ii+1);?></td>
			<td  align="middle" valign="middle"><?php echo stripslashes($categoryname);?></td>
			<td align="middle" valign="middle"><?php echo stripslashes($all_products->prodtitle);?></td>
            
            <td align="middle" valign="middle"><?php echo stripslashes($all_products->rank);?></td>
             
			<td align="middle" valign="middle"><img src="../uploads/store/products/<?php echo $all_products->image;?>" height="60" width="60"></td>
            
            
             
              
			  <?php /*?> <td  align="center" valign="middle">-<?php echo $all_products->init_stock;?></td>
			    <td  align="center" valign="middle">-<?php echo $all_products->aval_stock;?></td><?php */?>
			<td align="middle" valign="middle"x><a title="edit" href="index.php?option=com_bulkproducts_insert&id=<?php echo $all_products->spid;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="middle" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_bulkproducts&action=delete&id=<?php echo $all_products->spid;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
			  </td>
			</tr>
			<?php
				$ii++; } } else{
			?>
							<tr><td colspan="11" align="center" height="100">No Records..</td></tr>
			<?php 
			}
			?>
			</tbody>
						

      </table>
	
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
function validate()
{
	if(document.frmCreatestate.scid.value=="")
	{ 
		alert("Please Select Category ");
		document.frmCreatestate.scid.value='';
		document.frmCreatestate.scid.focus();
		return false;
	}
	
	
	if(document.frmCreatestate.bid.value=="")
	{ 
		alert("Please Select brands");
		document.frmCreatestate.bid.value='';
		document.frmCreatestate.bid.focus();
		return false;
	}
	
	
	
<?php /*?>if((document.frmCreatestate.color[0].checked == false) && (document.frmCreatestate.color[1].checked == false)) 
{
	alert ( "Please select Yes or no"); 
	return false;
}<?php */?>
if(trim(document.frmCreatestate.color.value)=="")
	{ 
		alert("Please Select color");
		document.frmCreatestate.color.value='';
		document.frmCreatestate.color.focus();
		return false;
	}
	

  if(trim(document.frmCreatestate.lot.value)=="")
	{ 
	alert("Please Enter Lot Number. It should be unique for each Product");
	document.frmCreatestate.lot.value='';
	document.frmCreatestate.lot.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.prodtitle.value)=="")
	{ 
		alert("Please Select Product Name");
		document.frmCreatestate.prodtitle.value='';
		document.frmCreatestate.prodtitle.focus();
		return false;
	}
    
	<?php /*?>if(trim(document.frmCreatestate.aval_stock.value)=="")
	{ 
		alert("Please enter available stock");
		document.frmCreatestate.aval_stock.value='';
		document.frmCreatestate.aval_stock.focus();
		return false;
	}<?php */?>
	
	
	

 if(document.getElementById('sid0').value=='')
	{
		alert("Please Select any Size");
		document.getElementById('sid0').focus();
		return false;
	}
	if(document.getElementById('rs0').value=='')
	{
		alert("Please Enter Price");
		document.getElementById('rs0').focus();
		return false;
	}


	if(trim(document.frmCreatestate.content.value)=="")
	{ 
	alert("Please Enter Description");
	document.frmCreatestate.content.value='';
	document.frmCreatestate.content.focus();
	return false;
	}
	
	/*if(trim(document.frmCreatestate.image.value)=="")
		{ 
			alert("Please Upload Image");
			document.frmCreatestate.image.value='';
			document.frmCreatestate.image.focus();
			return false;
		}*/
	
	<?php /*?>if(trim(document.frmCreatestate.fab.value)=="")
	{ 
	alert("Please Enter fabric");
	document.frmCreatestate.fab.value='';
	document.frmCreatestate.fab.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.ble.value)=="")
	{ 
	alert("Please Enter Blend");
	document.frmCreatestate.ble.value='';
	document.frmCreatestate.ble.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.car.value)=="")
	{ 
	alert("Please Enter Care");
	document.frmCreatestate.car.value='';
	document.frmCreatestate.car.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.pro.value)=="")
	{ 
	alert("Please Enter Protection");
	document.frmCreatestate.pro.value='';
	document.frmCreatestate.pro.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.fin.value)=="")
	{ 
	alert("Please Enter Finish");
	document.frmCreatestate.fin.value='';
	document.frmCreatestate.fin.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.silh.value)=="")
	{ 
	alert("Please Enter Silhouette");
	document.frmCreatestate.silh.value='';
	document.frmCreatestate.silh.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.clos.value)=="")
	{ 
	alert("Please Enter Closure");
	document.frmCreatestate.clos.value='';
	document.frmCreatestate.clos.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.coll.value)=="")
	{ 
	alert("Please Enter Collar");
	document.frmCreatestate.coll.value='';
	document.frmCreatestate.coll.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.leng.value)=="")
	{ 
	alert("Please Enter Length");
	document.frmCreatestate.leng.value='';
	document.frmCreatestate.leng.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.cuf.value)=="")
	{ 
	alert("Please Enter Cuff");
	document.frmCreatestate.cuf.value='';
	document.frmCreatestate.cuf.focus();
	return false;
	}
	

	
	if(trim(document.frmCreatestate.poc.value)=="")
	{ 
	alert("Please Enter Pocket");
	document.frmCreatestate.poc.value='';
	document.frmCreatestate.poc.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.wai.value)=="")
	{ 
	alert("Please Enter Waistband");
	document.frmCreatestate.wai.value='';
	document.frmCreatestate.wai.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.display_order.value)=="")
	{ 
	alert("Please Enter Display Order");
	document.frmCreatestate.display_order.value='';
	document.frmCreatestate.display_order.focus();
	return false;
	}<?php */?>
	
	if(trim(document.frmCreatestate.featured.value)=="")
	{ 
	alert("Please Enter Featured Listing");
	document.frmCreatestate.featured.value='';
	document.frmCreatestate.featured.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.page_title.value)=="")
	{ 
	alert("Please Enter Page Title");
	document.frmCreatestate.page_title.value='';
	document.frmCreatestate.page_title.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.title_slug.value)=="")
	{ 
	alert("Please Enter Page Title Slug. Please Provide Lotnumber As Title Slug");
	document.frmCreatestate.title_slug.value='';
	document.frmCreatestate.title_slug.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.meta_keyword.value)=="")
	{ 
	alert("Please Enter Page Meta Keyword");
	document.frmCreatestate.meta_keyword.value='';
	document.frmCreatestate.meta_keyword.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.meta_desc.value)=="")
	{ 
	alert("Please Enter Page Meta Description");
	document.frmCreatestate.meta_desc.value='';
	document.frmCreatestate.meta_desc.focus();
	return false;
	}
	
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
		alert("Please Upload Valid image/file type");
		document.frmCreatestate.image.value='';
		document.frmCreatestate.image.focus();
		return false;
		}
	}
	
	
	
	
	
	/*if(document.frmCreatestate.fab.value=="")
	{ 
	alert("Please Enter fabric");
	document.frmCreatestate.fab.value='';
	document.frmCreatestate.fab.focus();
	return false;
	}*/
	
	
	/*if(document.frmCreatestate.display_order.value=="")
	{ 
	alert("Please Enter display order");
	document.frmCreatestate.display_order.value='';
	document.frmCreatestate.display_order.focus();
	return false;
	}
	
	if(trim(document.frmCreatestate.page_title.value)=="")
	{ 
	alert("Please Enter page title");
	document.frmCreatestate.page_title.value='';
	document.frmCreatestate.page_title.focus();
	return false;
	}
	if(trim(document.frmCreatestate.title_slug.value)=="")
	{ 
	alert("Please Enter title slug");
	document.frmCreatestate.title_slug.value='';
	document.frmCreatestate.title_slug.focus();
	return false;
	}
	if(trim(document.frmCreatestate.meta_keyword.value)=="")
	{ 
	alert("Please Enter meta keyword");
	document.frmCreatestate.meta_keyword.value='';
	document.frmCreatestate.meta_keyword.focus();
	return false;
	}
	if(trim(document.frmCreatestate.meta_desc.value)=="")
	{ 
	alert("Please Enter meta description");
	document.frmCreatestate.meta_desc.value='';
	document.frmCreatestate.meta_desc.focus();
	return false;
	}*/
return true;
}
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
    document.getElementById("txtHint1").innerHTML=xmlhttp.responseText;
    }
  }
  //alert(str);
xmlhttp.open("GET","get_subcategories.php?q="+str,true);
xmlhttp.send();
}
</script>
 <div class="box">
<div class="heading">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt=""> Store &nbsp;&nbsp;>>&nbsp;&nbsp;Add Bulk Product&nbsp;&nbsp;/&nbsp;&nbsp; Edit Bulk Product</h1></td>
<td align="right" valign="bottom">&nbsp;</td>
</tr>
</table>
</div>
<div class="content">
<form action="index.php?option=com_bulkproducts_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate();">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" >
			   
   
                  <tr><td colspan="5" height="7"></td></tr>
              
               
               
               
               
               <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Category :</label></td>
                <td width="94%" align="left" valign="middle">
				<select name="scid" id="scid" class="select_medium required" onchange="showCustomer(this.value)" required="required">
				<option value="">Select</option>
				<?php
				$allcategorylist=$storeObj->getAllStoreCategoryList('Active','scid','ASC','','');
				foreach($allcategorylist as $catlist)
				{
				?>
				<option value="<?php echo $catlist->scid;?>"><?php echo stripslashes($catlist->catetitle);?></option>
				<?php
				}
				?>
				</select>
				<script type="text/javascript">
                for(var i=0;i<document.getElementById('scid').length;i++)
                {
						if(document.getElementById('scid').options[i].value=="<?php echo $indivdata->scid ?>")
						{
						document.getElementById('scid').options[i].selected=true
						}
                }			
                </script></td>
			  </tr>
              
               <tr><td colspan="5" height="7"></td></tr>
              
               
               
               
               
               <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Products :</label></td>
                <td width="94%" align="left" valign="middle">
				<select name="sscid" id="txtHint1" class="select_medium required" onchange="" required="required">
				<option value="">Select</option>
				</select>
				<script type="text/javascript">
                for(var i=0;i<document.getElementById('txtHint1').length;i++)
                {
						if(document.getElementById('txtHint1').options[i].value=="<?php echo $indivdata->pid ?>")
						{
						document.getElementById('txtHint1').options[i].selected=true
						}
                }			
                </script></td>
			  </tr>
                         
<?php /*?>                <tr><td colspan="2" height="7"></td></tr>
             
           <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Product Name :</label></td>
                <td width="94%" align="left" valign="middle"><input name="prodtitle" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->prodtitle);?>" /></td>
	</tr>&nbsp;&nbsp;<br/>
<?php */?>
      <tr><td colspan="2" height="7"></td></tr>
             
           <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Product Packet Count :</label></td>
                <td width="94%" align="left" valign="middle"><input name="packetcount" class="text_large required" type="text" value="<?php echo  stripslashes($indivdata->packetcount);?>" required="required" /></td>
	</tr>&nbsp;&nbsp;<br/>
              
              <tr><td colspan="2" height="7"></td></tr> 
<?php
                 if($_GET['id']!='')
				 {
                 $optin='';
				  $asqffds="select * from tb_bulkstore_value where spid='".$indivdata->spid."' "; 
				 $pricefgf=$callConfig->getALLRows($asqffds);
				foreach($pricefgf as $slist)
 
				{
				$optin=$optin."<option value='".$slist->size."'>".stripslashes($slist->size).'ml</option>';
				}
				 }else{
				$optin='';
				  $sizelist="select * from tb_bottlesize order by id ASC";
				$nag=$callConfig->getAllRows($sizelist);

				foreach($nag as $slist)

				{
				$optin=$optin."<option value='".$slist->size."'>".stripslashes($slist->size).'ml</option>';
				}
				}

				?>   
              
              
              
         <tr>
			   <?php    echo  $asq="select * from tb_store_value where spid='".$indivdata->spid."' "; 
				         $price=$callConfig->getRow($asq);
						 $sid_single = $price->id;
						
						  
				                   ?>
			  <td width="7%" align="left" class="caption-field"><label class="title">Size:<span style=" color:#FF0000; font-size:14px">*</span></label></td>

                <td width="100%" colspan="4" align="left" valign="middle">
                
              
			    <select name="sid[<?php print $sid_single;?>]" id="sid0" class="select_medium">
                <option value="">Select</option>
			    
			
				<?php print $optin;ml ?>
				</select>  
             <script type="text/javascript">
                for(var i=0;i<document.getElementById('sid0').length;i++)
                {
						if(document.getElementById('sid0').options[i].value=="<?php echo $price->size;?>")
						{
						document.getElementById('sid0').options[i].selected=true
						}
                }			
                </script>
                <strong>price:</strong>
               
                <input type="text" name="rs[]" id="rs0"  value="<?php echo $price->real_price;?>"/>
&nbsp;<span style=" color:#FF0000; font-size:14px;margin-left:30px;">*</span>&nbsp;( If you want to add more sizes click below Plus button to Add and <strong>Place Over All Price Based On Packets Count</strong> ) </span></td>
</tr>
		<tr>	  
            <td></td>  
             
             <td>
	 <div id="divTxt" style="margin-top:10px;">
     <?php 
	 
	 
	 $asq1="select * from tb_store_value where spid='".$indivdata->spid."' "; 
				         $price1=$callConfig->getALLRows($asq1);
	 
	  /*$asq1="select * from tb_store_sku where c_lotid=".$indivdata->lotnumber." order by id"; 
          $price1=$callConfig->getRow($asq1);*/
		
				$i=0;
				
				foreach($price1 as $s_price){ $i++;
				if($i>1){
				?>		 
     
     <div id='row<?=$i?>'><div style='border:1px solid #6DB5FF;width:390px; height:45px;padding:2px 2px 2px 2px;'><p>
     <select name='sid[<?php print $s_price->id;?>]' id='sid<?=$i?>' class='select_medium'><option value=''>Select</option><?php print $optin; ?></select>
       <script type="text/javascript">
                for(var i=0;i<document.getElementById('sid<?=$i?>').length;i++)
                {
						if(document.getElementById('sid<?=$i?>').options[i].value=="<?php echo $s_price->size;?>")
						{
						document.getElementById('sid<?=$i?>').options[i].selected=true
						}
                }			
                </script>
     price:<input type='text' value="<?=$s_price->real_price?>" name='rs[]' id='rs<?=$i?>' class='inputtype_field_input' /></p>
     <div class='clearfix'></div><a href='#' onClick='removeFormField("#row<?=$i?>"); return false;'><img src='allfiles/Delete-Button_06.png' alt='delete' style='position:relative;top:-56px;right:-393px' /></a></div><br></div>
     
    <?php } } ?> 
     
     </div>
	 
     
     	<a href="javascript:void();" onClick="addFormField(); return false;"><img src="allfiles/Plus1.png" alt="Plus" border="0" /></a>
         	<input type="hidden" name="id" id="id" value="<?=count($price1)?>" />
	<input type="hidden" name="countid" id="countid" value="<?=count($price1)+1?>" />   </td>
   </tr>
              
               
    <script type="text/javascript">
	<?php 
	$all_xdims = $callConfig->getALLRows("SELECT * FROM tb_bottlesize"); 
	$optino = '';
	foreach($all_xdims as $sin_dim){
		$optino .= "<option value='".$sin_dim->size."'>".$sin_dim->size."ml</option>";
	}
	?>
function addFormField() {
	var id = document.getElementById("id").value;
	var count =document.getElementById("countid").value;
$("#divTxt").append("<div id='row" + id + "'><div style='border:1px solid #6DB5FF;width:390px; height:45px;padding:2px 2px 2px 2px;'><p><select name='sid[]' id='sid"+id+"' class='select_medium'><option value=''>Select</option><?php print $optino; ?></select>price:<input type='text' name='rs[]' id='rs"+id+"' class='inputtype_field_input' /></p><div class='clearfix'></div><a href='#' onClick='removeFormField(\"#row" + id + "\"); return false;'><img src='allfiles/Delete-Button_06.png' alt='delete' style='position:relative;top:-56px;right:-393px' /></a></div><br></div>");
$("label").inFieldLabels(); 
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

                <td align="left" valign="top" class="caption-field"><label class="title">Content:<span style=" color:#FF0000; font-size:14px">*</span></label></td>

				<td align="left" valign="middle" class="caption-field">   
				<textarea name="content" id="content_matter" cols="157" rows="20"><?php echo  stripslashes($indivdata->bigtext);?></textarea>

                <?php /*?><td align="left" valign="middle" class="caption-field">
				<?php
				include 'fckeditor/fckeditor.php'; 
				$sBasePath = 'fckeditor/' ;//to change in web root
				$oFCKeditor = new FCKeditor('bigtext') ;  //name of the form-field to be generated
				$oFCKeditor->BasePath	= $sBasePath ;
				$oFCKeditor->Value		= stripslashes($indivdata->bigtext) ;//the matter that may be in db
				$oFCKeditor->Height=250;
				$oFCKeditor->Width=810;
				$oFCKeditor->Create() ;
				?><?php */?>
				<?php /*?><textarea name="bigtext" id="bigtext" cols="150" rows="4"><?php echo  stripslashes($indivdata->bigtext);?></textarea><?php */?>
				</tr>
                <tr><td colspan="2" height="7"></td></tr>
			    <tr><td colspan="2" height="7"></td></tr>
			   <tr>
				<td width="6%" align="left" valign="middle" class="caption-field"><label class="title">Main Image :</label></td>
				<td width="94%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				<td width="31%"><input type="file" name="image" size="24"></td>
				<td width="69%"><?php if($indivdata->image!=""){
				?>
				<img src="../uploads/store/products/<?php echo $indivdata->image; ?>" width="150" height="150" />
				<input type="hidden" name="hdn_image" size="24" value="<?php echo $indivdata->image; ?>">
				<?php
				}
				?> <span style="font-size:11px">(Image sizes: width:380px height:550px)</span></td>
				</tr>
						
				</table></td>
				</tr>
				
							
				
						<tr>
				<td width="6%" align="left" valign="middle" class="caption-field"><label class="title">Image1 :</label></td>
				<td width="94%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				<td width="31%"><input type="file" name="image1" size="24"></td>
				<td width="69%"><?php if($indivdata->image1!=""){
				?>
				<img src="../uploads/store/products/<?php echo $indivdata->image1; ?>" width="150" height="150" />
				<input type="hidden" name="hdn_image1" size="24" value="<?php echo $indivdata->image1; ?>">
				<?php
				}
				?> <span style="font-size:11px">(Image sizes: width:380px height:550px)</span></td>
				</tr>
				
				</table></td>
				</tr>
				
				<tr>
				<td width="6%" align="left" valign="middle" class="caption-field"><label class="title">Image2 :</label></td>
				<td width="94%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				<td width="31%"><input type="file" name="image2" size="24"></td>
				<td width="69%"><?php if($indivdata->image2!=""){
				?>
				<img src="../uploads/store/products/<?php echo $indivdata->image2; ?>" width="150" height="150" />
				<input type="hidden" name="hdn_image2" size="24" value="<?php echo $indivdata->image2; ?>">
				<?php
				}
				?> <span style="font-size:11px">(Image sizes: width:380px height:550px)</span></td>
				</tr>
				
					</table></td>
				</tr>
						
				<tr>
				<td width="6%" align="left" valign="middle" class="caption-field"><label class="title">Image3 :</label></td>
				<td width="94%" align="left" valign="middle"><table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
				<td width="31%"><input type="file" name="image3" size="24"></td>
				<td width="69%"><?php if($indivdata->image3!=""){
				?>
				<img src="../uploads/store/products/<?php echo $indivdata->image3; ?>" width="150" height="150" />
				<input type="hidden" name="hdn_image3" size="24" value="<?php echo $indivdata->image3; ?>">
				<?php
				}
				?> <span style="font-size:11px">(Image sizes: width:380px height:550px)</span></td>
				</tr>
				</table></td>
				</tr>
                 <tr><td colspan="2" height="7"></td></tr>
    <tr>
   <td width="6%" align="left" class="caption-field"><label class="title">Rating:<span style=" color:#FF0000; font-size:14px">*</span></label></td>
   <td width="94%" align="left" valign="middle">
   
   
  <?php /*?> <div>
          School overall rating<br>
           <!-- PMR Rating starts -->
                          <script type="text/javascript" src="rating_old/jquery-1.2.3.min.js"></script>
                        <script type="text/javascript" src="rating_old/jquery.rating.js"></script>
                        <link rel="stylesheet" type="text/css" href="rating_old/rating.css" />
                        
                        <script type="text/javascript">
                        $(document).ready(function() {
                        $('#rate1').rating('example.php', {maxvalue:5,increment:.5});
                        
                        });
                        </script>
                        
                        <script type="text/javascript">
                        $(document).ready(function() {
                        $('#rate1').rating('example.php', {maxvalue:5,increment:.5});
                        });
                        </script>
						<div >  
                        <div id="rate1" class="rating" style="margin:0"></div>
                        </div>
                        
                        <!--PMR Rating ends -->
          </div><?php */?>
   
  
   <select name="rank" id="rank" requried="required" >
   <option value="">Select</option>
   <option value="0">0</option>
   <option value="0.5">0.5</option>
   <option value="1">1</option>
   <option value="1.5">1.5</option>
   <option value="2">2</option>
   <option value="2.5">2.5</option>
   <option value="3">3</option>
   <option value="3.5">3.5</option>
   <option value="4">4</option>
   <option value="4.5">4.5</option>
   <option value="5">5</option>
   </select>
   
    	<script type="text/javascript">
		
                for(var i=0;i<document.getElementById('rank').length;i++)
                {
						if(document.getElementById('rank').options[i].value=="<?php echo $indivdata->rank; ?>")
						{
						document.getElementById('rank').options[i].selected=true
						}
                }			
				
        </script>
   </td>
	</tr>
    
	          <tr><td colspan="5" height="7"></td></tr>
               
                  <tr><td colspan="2" height="7"></td></tr>
               <tr>
                <td align="left" class="caption-field"><label class="title">Featured Listing</label> </td>
                <td align="left" valign="middle" class="caption-field"><input type="checkbox" name="featured" value="yes"  style="width:30px;" <?php if($indivdata->featuredlisting=="yes") {?>  checked="checked" <?php }?>/></td>
			  </tr>
               <tr><td colspan="5" height="7"></td></tr>
              	<tr>
                <td align="left" class="caption-field"><label class="title">Status :</label> </td>
                <td align="left" valign="middle" class="caption-field">
    <select name="status" id="status" class="select_large required">
	<option value="Active">Active</option>
    <option value="Inactive">Inactive</option>
	</select>
	<script type="text/javascript">
				$(function(){
					$("#none_size").click(function(){
						value=$(this).prop("checked");
						if(value==true)
						{
							$(".check_boxes").attr("disabled","disabled");
							$("#nosize").css("display","block");
						}
						else
						{
							 $(".check_boxes").removeAttr ( "disabled" );
							 $("#nosize").css("display","none");
						}
					});
				});
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
	<td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->spid?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?><input <?php echo $hdn_in_up;?> type="submit" value="" >	</td>
	</tr>
        </table>
	</form>	
	</div>
  </div>
 <?php }?>