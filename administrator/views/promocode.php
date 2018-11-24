<?php 

include('includes/session.php');

include("model/promocode.class.php");

$couponsObj=new couponsclass();

if($_GET['action']=="delete"){

   $couponsObj->couponsDelete($_GET['id']);

}

if($_POST['admininsert']=="Submit"){

   $couponsObj->insertcoupons($_POST);

}

if($_POST['admininsert']=="Update"){

   $couponsObj->updatecoupons($_POST);

}

if(isset($_GET['id']) && $_GET['id']!=""){

   $hdn_value="Update";

   $indivdata=$couponsObj->getcouponsData($_GET['id']); 

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

$orderby="DESC";

$allforumlist=$couponsObj->getAllcouponsList($fldname,$orderby,$start,$limit);

$total=$couponsObj->getAllcouponsListCount();


if($option!="com_promocode_insert"){

?>



<div class="box">

<div class="heading">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt="">Store &nbsp;&nbsp;>>&nbsp;&nbsp;Promo Code</h1></td>

<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_promocode_insert';"></td>

</tr>

</table>

</div>

<div class="content">

	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">

          <thead>

            <tr height="25">

              <td width="20" align="center" valign="middle">sno</td>

			   <td width="238" align="left" valign="middle" >Promo Code</td>

                     <td width="238" align="left" valign="middle" >Coupon Title</td>
<td width="238" align="left" valign="middle" >Discount</td>



<td width="238" align="left" valign="middle" >Expired On</td>

    

              <td width="34" align="center" valign="middle" >Edit</td>

			  <td width="38" align="center" valign="middle" >Delete</td>

            </tr>

          </thead>

			<tbody>

			<?php /*?><?php

			if(sizeof($allforumlist)>0){

					$ii=0;

					foreach($allforumlist as $allforum_list){

					
					if(strtotime($allforum_list->expiredtime)<strtotime(date("m-d-Y")))

					$dispexp="<font color='red'> ( Expired )</font>";

					else

					$dispexp="";

					?><?php */?>
					<?php

			if(sizeof($allforumlist)>0){

					$ii=0;

					foreach($allforumlist as $allforum_list){

					

					if($allforum_list->expiredtime<date("Y-m-d"))

					$dispexp="<font color='red'> ( Expired )</font>";

					else

					$dispexp="";

					?>


			<tr height="22">

			<td align="center" valign="middle"><?=($ii+1);?></td>

			<td colspan="0" align="left" valign="middle"><?php echo $allforum_list->couponcode;?></td>
              <td align="left" colspan="0" valign="middle"><?php echo $allforum_list->coupon_title;?></td>
            <td align="left" colspan="0" valign="middle"><?php echo $allforum_list->discount;?></td>

            <td align="left" colspan="0" valign="middle"><?php echo date("Y-m-d",strtotime($allforum_list->expiredtime));?> <small>&nbsp;&nbsp;(yyyy/mm/dd)</small> <?=$dispexp?></td>

			<td align="center" valign="middle"x><a title="edit" href="index.php?option=com_promocode_insert&id=<?php echo $allforum_list->id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>

			<td align="center" valign="middle"><a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_promocode&action=delete&id=<?php echo $allforum_list->id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a></td>

			</tr>

			<?php

				$ii++; } } else{

			?>

							<tr><td colspan="10" align="center" height="100">No Records..</td></tr>

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

			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_promocode', $param);

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

function validate()

{

	if(trim(document.frmCreatestate.couponcode.value)=="")

	{ 

		alert("Please enter Coupon Code");

		document.frmCreatestate.couponcode.value='';

		document.frmCreatestate.couponcode.focus();

		return false;

	}

	if ( ( document.frmCreatestate.distype[0].checked == false ) && ( document.frmCreatestate.distype[1].checked == false ) ){

        alert ( "Please choose Discount Type!" );

        document.frmCreatestate.distype[0].focus();

        return false;

    }

	

	var numericExpression = /^[0-9]+$/;
	var numericExpression1 = /^[0-9]*[.][0-9]+$/;
	if(document.frmCreatestate.discount.value.match(numericExpression)==null && document.frmCreatestate.discount.value.match(numericExpression1)==null)
	{
		alert("Please enter Valid dicsount value.");

		document.frmCreatestate.discount.value='';

		document.frmCreatestate.discount.focus();

		return false;

	}

	if(document.frmCreatestate.expiredon.value=="")

	{ 

		alert("Please enter Expiry Date");

		document.frmCreatestate.expiredon.focus();

		return false;

	}

return true;

}

</script>

 <div class="box">

<div class="heading">

<table width="100%" border="0" cellspacing="0" cellpadding="0">

<tr>

<td align="left" valign="middle"> <h1><img src="allfiles/map.jpeg" alt=""> Store &nbsp;&nbsp;>>&nbsp;&nbsp; Add Coupon &nbsp;&nbsp;/&nbsp;&nbsp; Edit Coupon</h1></td>

<td align="right" valign="bottom">&nbsp;</td>

</tr>

</table>

</div>

<div class="content">

<form action="index.php?option=com_promocode_insert" method="post" id="frmCreatestate" name="frmCreatestate" class="middle_form" enctype="multipart/form-data" onsubmit="return validate();">

    <table width="100%" border="0" cellspacing="0" cellpadding="0" >

  <?php /*?>  <tr>

    <td width="6%" align="left" class="caption-field"><label class="title">Coupon Code :</label></td>

    <td width="94%" align="left" valign="middle"><input name="couponcode" class="text_large required" type="text" value="<?php echo $indivdata->couponcode;?>" /></td>

    </tr>
<?php */?>


   <tr><td colspan="5" height="7"></td></tr>
              
               
               
               
               
               <tr>
                <td width="6%" align="left" class="caption-field"><label class="title">Category :</label></td>
                <td width="94%" align="left" valign="middle">
				<select name="scid" id="scid" class="select_medium required" onchange="showCustomer(this.value)">
				<option value="">Select</option>
				<?php
				$allcategorylist=$couponsObj->getAllStoreCategoryList('Active','scid','ASC','','');
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
						if(document.getElementById('scid').options[i].value=="<?php echo $indivdata->cid ?>")
						{
						document.getElementById('scid').options[i].selected=true
						}
                }			
                </script></td>
			  </tr>
              
    
    
    
          <tr><td colspan="2" height="7"></td></tr>
      
  
     <tr>

    <td width="6%" align="left" class="caption-field"><label class="title">Promo Code Title :</label></td>

    <td width="94%" align="left" valign="middle"><input name="coupon_title" class="text_large required" type="text" value="<?php echo $indivdata->coupon_title;?>" /></td>

    </tr>

      <tr><td colspan="2" height="7"></td></tr>
      
  
     <tr>

    <td width="6%" align="left" class="caption-field"><label class="title">Promo Code :</label></td>

    <td width="94%" align="left" valign="middle"><input name="coupon_code" class="text_large required" type="text" value="<?php echo $indivdata->couponcode;?>" /></td>

    </tr>
    
    
    
    <tr><td colspan="2" height="7"></td></tr>

	<tr>

    <td width="6%" align="left" class="caption-field"><label class="title">Discount Type :</label></td>

    <td width="94%" align="left" valign="middle">

	

	<input name="distype"  type="radio" value="price" <?php if($indivdata->distype=='price'){?>checked="checked" <?php }?> />Price($)

	&nbsp; <input name="distype"  type="radio" value="percent"  <?php if($indivdata->distype=='percent'){?>checked="checked" <?php }?>/>Percentage(%)

	

	</td>

    </tr>

    <tr><td colspan="2" height="7"></td></tr>

    <tr>

    <td width="6%" align="left" class="caption-field"><label class="title">Discount :</label></td>

    <td width="94%" align="left" valign="middle"><input name="discount" id="discount" class="text_small required" type="text" value="<?php echo $indivdata->discount;?>"  style="width:50px;"/> </td>

    </tr>

    <tr><td colspan="2" height="7"></td></tr>

    <tr>

    <td width="6%" align="left" class="caption-field"><label class="title">Expired On :</label></td>

    <td width="94%" align="left" valign="middle">

    <?php

	if($indivdata->expiredtime!="")

	{

	$dateArray=explode('-',$indivdata->expiredtime);

	$dt = $dateArray[0].'-'.$dateArray[1].'-'.$dateArray[2];

	 
	 }?>

    <input name="expiredtime" id="expiredtime"  class="text_small required" type="text" value="<?php echo date("Y-m-d",strtotime($dt));?>" /><br /><small> (yyyy-mm-dd)</small></td>

    </tr>

    <tr><td colspan="2" height="7"></td></tr>

    <tr>

    <td align="left" valign="middle" colspan="2"><input name="hdn_id" type="hidden" value="<?php echo $indivdata->id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><?php /*?><input <?php echo $hdn_in_up;?> type="submit" value=""><?php */?><input <?php echo $hdn_in_up;?> type="submit" value="" >	</td>

    </tr>

    </table>

	</form>	

	</div>

  </div>
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
  <script>
$(function() {
$( "#expiredtime" ).datepicker({
minDate:0,
dateFormat:'yy-mm-dd'
});
});
</script>

 <?php }?>
 
 