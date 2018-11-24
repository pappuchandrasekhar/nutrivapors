<?php 

include('includes/session.php');

include("model/store.class.php");

$storeObj=new storeClass();

if($_GET['action']=="delete"){

   $storeObj->OrderDelete($_GET['id']);

}

if($_GET['st']!="" || $_GET['st']=="Pending" || $_GET['st']=="Delivered"){

   $storeObj->OrderStatusChanging($_GET);

}

if($_GET['fu']!="" || $_GET['fu']=="Yes" || $_GET['fu']=="No")

{

   $storeObj->forntuserFollowStatusChanging($_GET);

}



if($_GET['smuid']!="")

{

//print_r($_GET);exit;
	$storeObj->SendStatusMail($_GET['smuid'],$_GET['smtid']);

}

if($_POST['adminpopupupdate']=="Submit"){

   $storeObj->updateOrderComment("remarks",$_POST);

}
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ Tracking System @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@//
if(isset($_POST['tracksys_update']))
{
//print_r($_POST);
$res=$storeObj->Update_TrackingNumber($_POST);
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

$fldname="ordered_date";

if($_GET['ord']!="")

$orderby=$_GET['ord'];

else

$orderby="DESC";



if($_REQUEST['serchkeyword']!=''){
	//$allorderlist=$storeObj->searchkeyComments($_POST['serchkeyword'],$_POST['coupcode'],$fldname,$orderby,$start,$limit);
	//$total = count($allorderlist);
	$allorderlist=$storeObj->getAllOrdersList1($fldname,$orderby,$start,$limit,$_REQUEST['serchkeyword']);

$total=$storeObj->getAllOrdersListCount1($_REQUEST['serchkeyword']);
}
else
{
	$allorderlist=$storeObj->getAllOrdersList($fldname,$orderby,$start,$limit);

$total=$storeObj->getAllOrdersListCount();
}

?>
<script type="text/javascript">

function getrelatedData(val){

window.location.href="index.php?option=com_orderlist&b_id="+val;

}

</script>

<div class="box">
  <div class="heading">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="36%" align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt=""> Store &nbsp;&nbsp;>>&nbsp;&nbsp;Orders</h1></td>
        <td width="49%" align="left" valign="middle"><script type="text/javascript">
// <![CDATA[
function display(obj,id1) {
txt = obj.options[obj.selectedIndex].value;
document.getElementById(id1).style.display = 'none';
if ( txt.match(id1) ) {
document.getElementById(id1).style.display = 'block';
}
}

// ]]>
</script>
          <form action="" method="post">
            <div float="left" style="width:550px;border:0px solid red;">
              <!-- <input type="text" width="200"  name="serchkeyword" value="<?php echo $searchword; ?>"/>-->
              <table width="90%" border="0" cellspacing="0" cellpadding="1">
                <tr>
                  <td width="46%">Filter By :
                    <select name="serchkeyword" id="serchkeyword" onchange="display(this,'');">
                      <option value="">-Choose-</option>
                      <option value="New Order">New Order</option>
                      <option value="In Process">In Process</option>
			  <option value="Shipped">Shipped</option>
			  <option value="Delivered">Delivered</option>
              <option value="Not Delivered">Not Delivered</option>
              <option value="Returned">Returned</option>
              <option value="Cancelled">Cancelled</option>
			  <option value="Received">Received</option>
			  <option value="Completed">Completed</option>
                    </select>
				<script type="text/javascript">
                for(var i=0;i<document.getElementById('serchkeyword').length;i++)                
                {                
                if(document.getElementById('serchkeyword').options[i].value=="<?php echo $_POST['serchkeyword']; ?>")                
                {                
                document.getElementById('serchkeyword').options[i].selected=true;                
                }                
                }	                
                </script>
                    </td>
                  <td width="5%"><div id="coupcode" style="display: none;">
                      <input name="coupcode" type="text" id="coupcode" size="10">
                    </div></td>
                  <td width="49%"><input type="submit" name="searchkey" value="Submit" /></td>
                </tr>
              </table>
            </div>
          </form></td>
        <td width="15%" align="left" valign="middle"><a href="exportorder.php?kw=<?php echo $_POST['serchkeyword']; ?>&cpn=<?php echo $_POST['coupcode']; ?>">
          <input type="submit" name="searchkey" value="Export to Excel" style="font-weight:bold;font-size:14px;text-decoration:none;color:#106499"/>
          </a></td>
      </tr>
    </table>
  </div>
  <div class="content">
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
      <thead>
        <tr height="25">
          <td width="21" align="center" valign="middle">sno</td>
           <td width="53" align="left" valign="middle" >Order No.</td>
          <td width="94" align="left" valign="middle" >Transaction Id</td>
          <td width="2" align="left" valign="middle" class="sort"><div > <a href="index.php?option=com_orderlist&ord=ASC&fld=txn_id" class="up" title="up"></a> <a href="index.php?option=com_orderlist&ord=DESC&fld=txn_id" class="down" title="down"></a> </div></td>
          <td width="53" align="left" valign="middle" >total price</td>
          <td width="8" align="left" valign="middle" class="sort"><div > <a href="index.php?option=com_orderlist&ord=ASC&fld=total_price" class="up" title="up"></a> <a href="index.php?option=com_orderlist&ord=DESC&fld=total_price" class="down" title="down"></a> </div></td>
          
          <td width="143" align="left" valign="middle" >Ordered On</td>
          <td width="1" align="left" valign="middle" class="sort"><div > <a href="index.php?option=com_orderlist&ord=ASC&fld=ordered_date" class="up" title="up"></a> <a href="index.php?option=com_orderlist&ord=DESC&fld=ordered_date" class="down" title="down"></a> </div></td>
          <td width="72" align="left" valign="middle" >First Name</td>
		  
		  
		  
          <td width="73" align="left" valign="middle" >Last Name</td>
          <td width="51" align="left" valign="middle" >Email Id</td>
          <td width="2" align="left" valign="middle" class="sort"><div > <a href="index.php?option=com_orderlist&ord=ASC&fld=customer_id" class="up" title="up"></a> <a href="index.php?option=com_orderlist&ord=DESC&fld=customer_id" class="down" title="down"></a> </div></td>
         
          <td width="121" align="center" valign="middle" >Order Details</td>
         
          <td width="108" align="center" valign="middle" >Status</td>
	<!--	  <td width="79" align="center" valign="middle" >Update Status</td>-->
		 
		  
          <td width="69" align="center" valign="middle" >Delete</td>
        </tr>
      </thead>
      <tbody>
        <script type="">

					function getdrop(index)

					{

						document.getElementById('statusdisp'+index).style.display="";

						document.getElementById('resultdisp'+index).style.display="none";

					}

					function statusUpdate(st,id,index,customer_id)

					{

					

						if(st!="")

						{

							if(st=='In Process')

							{

								transaction_id=$("#transaction_id"+index).val();

								$.ajax({

		 							type: "POST",

							        url: 'descrease_productscount.php',

									data:{transaction_id:transaction_id},

									 success: function(msg) {

									 		//alert(msg);

										  //var obj = jQuery.parseJSON(msg);

										 

									 }

								});	

							}

							jQuery.ajax({

								type: "POST",

								url: "ajax_status.php",

								data: "&status="+st+"&id="+id+"&customer_id="+customer_id,

								success: function(msg){

								jQuery("#resultdisp"+index).html(msg);

								document.getElementById('resultdisp'+index).style.display="";

								document.getElementById('statusdisp'+index).style.display="none";

								}

							});

						}

					}

					</script>
        <?php

			if(sizeof($allorderlist)>0){
				?>
					<a href="#dialog" class="fancybox"></a>
					<a href="#dialog1" class="fancybox1"></a>
				<?php
					$ii=0;

					foreach($allorderlist as $all_orderlists){

					//$uservalues=userClass::getAdminUserData($all_orderlists->customer_id);
//$sel="select * from tb_users_info where user_id=".$all_orderlists->customer_id;
$sel="select * from tb_orders where customer_id=".$all_orderlists->customer_id;


$rs_customer=$callConfig->getRow($sel);
					?>
        <tr height="22">
          <td align="center" valign="middle"><?=($ii+1);?></td>
          <td  align="left" valign="middle"><?php echo $all_orderlists->order_no;?></td>
          <td colspan="2" align="left" valign="middle"><?php echo $all_orderlists->txn_id;?>
            <input type="hidden" name="transaction_id" id="transaction_id<?= $ii;?>" value="<?= $all_orderlists->txn_id;?>" /></td>
          <td colspan="2" align="left" valign="middle"><?php echo '$&nbsp;'.$all_orderlists->total_price;?>&nbsp;</td>
         
          <td colspan="2" align="left" valign="middle"><?php echo date("M d, Y",strtotime($all_orderlists->ordered_date));?></td>
          <td  align="left" valign="middle"><?php echo $all_orderlists->b_f_name;?></td>
          <td  align="left" valign="middle"><?php echo $all_orderlists->b_last_name;?></td>
          <td colspan="2" align="left" valign="middle"><a href="mailto:<?php echo $all_orderlists->b_email;?>"><?php echo $all_orderlists->b_email;?></a></td>
         
          <td width="121" align="center" valign="middle" ><a href="index.php?option=com_orderlistview&id=<?php echo $all_orderlists->oid;?>">Click Here</a></td>

          <script type="text/javascript">
		$(document).ready(function() {
			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
			$("#various<?=$ii?>").fancybox({
				'titlePosition'		: 'inside',
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});

		});



	</script>

          <script type="text/javascript">
            function closeopen(op,cl,index)
			{
				 document.getElementById(op+index).style.display="";
				 document.getElementById(cl+index).style.display="none";
			}
            </script>
        
          <td align="center" valign="bottom"> <a href="javascript:void(0);"  id="resultdisp<?=$ii;?>" onclick="getdrop('<?=$ii;?>');"><?php  echo ucfirst($all_orderlists->ord_status);?></a>

            <select name="statusdisp" id="statusdisp<?=$ii;?>" style="display:none;" onchange="statusUpdate(this.value,'<?php echo $all_orderlists->oid;?>','<?=$ii;?>','<?php echo $all_orderlists->oid;?>');">

              <option value="">-- Choose --</option>
			  <option value="In Process">In Process</option>
			  <option value="Shipped">Shipped</option>
			  <option value="Delivered">Delivered</option>
              <option value="Not Delivered">Not Delivered</option>
              <option value="Returned">Returned</option>
              <option value="Cancelled">Cancelled</option>
			  <option value="Received">Received</option>
			  <option value="Completed">Completed</option>
            </select>

            <script type="text/javascript">



			for(var i=0;i<document.getElementById('statusdisp<?=$ii;?>').length;i++)



			{



				if(document.getElementById('statusdisp<?=$ii;?>').options[i].value=="<?php echo $all_orderlists->ord_status; ?>")



				{



					document.getElementById('statusdisp<?=$ii;?>').options[i].selected=true;



				}



			}			



			</script>

            &nbsp; <a href="index.php?option=com_orderlist&smuid=<?php echo $all_orderlists->customer_id; ?>&smtid=<?php echo $all_orderlists->oid; ?>" title="Send Email"><img src="allfiles/mail.jpg" width="18" height="19" border="0" /></a>
			
			</td>
			
			
			<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ Tracking @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
			
			
			
<?php /*?>			 <td width="79" align="center" valign="middle" >
			 <a href="javascript:void(0);" class="update_fancy" id="update_transaction<?php echo $all_orderlists->oid."-". $all_orderlists->customer_id;?>">Update</a>			 </td>
<?php */?>			<!-- 
			 <td width="79" align="center" valign="middle" >
			 <a href="javascript:void(0);" class="view_status" id="view_transaction<?php echo $all_orderlists->oid;?>">View</a>			 </td>-->
          
		  <!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ Tracking Ends @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
		  
		  
		  <td align="center" valign="middle"><a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_orderlist&action=delete&id=<?php echo $all_orderlists->oid;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a> </td>
        </tr>
        <?php

				$ii++; } } else{

			?>
        <tr>
          <td colspan="19" align="center" height="100">No Orders..</td>
        </tr>
        <?php 

			}

			?>
      </tbody>
      <tr>
        <td colspan="19" align="left"><?php if($total>$limit)

			{

			?>
          <ul class="paginator" style="float:right; margin-left:-25px;">
            <?php 

			$param="";

			if($_GET['ord']!="")

			$param.="&ord=".$_GET['ord'];

			if($_GET['ord']!="")

			$param.="&fld=".$_GET['fld'];
			if($_REQUEST['serchkeyword']!="")

			$param.="&serchkeyword=".$_REQUEST['serchkeyword'];

			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_orderlist', $param);

			?>
          </ul>
          <?php 

			}

			?></td>
      </tr>
    </table>
  </div>
</div>


<!--- Tracking code (9-02-2013) -->


<script type="text/javascript">
$(function(){
	$(".update_fancy").click(function(){
		$("#upadte_transx_id").val($(this).attr("id").substr(18));
		$(".fancybox").trigger('click');
	});

	$(".fancybox").fancybox(
	{
		'onStart': function(){	}
	}
	);
	
	$(".view_status").click(function(){
	
		$("#view_transx_id").val($(this).attr("id").substr(16));
		$(".fancybox1").trigger('click');
		
	});
	
	$(".fancybox1").fancybox(
	{
		'onStart': function(){
			transaction_id=$("#view_transx_id").val(); 
			$.ajax({
			type: "POST",
			url: 'getorderstatus.php',
			data:{transaction_id:transaction_id},
			success: function(msg) {
				//jQuery("#resultdisp").html(msg);
				var obj = jQuery.parseJSON(msg);
				$("#status_disp").text(obj.status);
				$("#shipment_number_disp").text(obj.shipping_no);
				$("#trns_messg_disp").text(obj.tracking_messg);
				//alert(obj.status);
			}
			});
					
			}
	}
	);
	
	
});
</script>
<div style="display:none">
<div id="dialog" style="padding:10px; bottom:10px;">
<form method="post" action="" name="order_tracking" onSubmit="">
			<table width="100%" border="0" align="left" cellpadding="5" cellspacing="0"  style="border:#CCCCCC solid; border-radius:8px;" >
			<tr>
				<td height="4" align="left" valign="middle" colspan="2" ><input type="hidden" name="upadte_transx_id" id="upadte_transx_id"  value="" /> 
				
				
				</td>
			  </tr>
			   <tr>
				<td height="4" align="left" valign="middle" colspan="2" ></td>
			  </tr>
			  <tr>
				<td height="12" align="center" valign="middle" colspan="2" style="font-style:italic;color:#FF0000" >&nbsp;Update the Status  Here.</td>
			  </tr>
			   <tr>
				<td height="8" align="left" valign="middle" colspan="2" >&nbsp;</td>
			  </tr>
			  <tr>
									   
				<td width="28%" height="28" align="left" valign="middle" >Status:</td>
		  <td width="72%" height="28" align="left" valign="middle"><select name="tracking_status" class="order_required" id="tracking_status">
		  <option value="0">---choose---</option>
		<option value="In Process">In Process</option>
		<option value="Shipped">Shipped</option>
		<option value="Delivered">Delivered</option>
		<option value="Not Delivered">Not Delivered</option>
		<option value="Returned">Returned</option>
		   
		  </select>
					</td>
			  </tr>
			   <tr>
				<td height="28" align="left" valign="middle" >Shippment&nbsp;Number<br /><small>(If shipped)</small>:</td>
				<td height="28" align="left" valign="middle"><input type="text" name="trns_shipment_number"  id="trns_shipment_number" class="order_required" ></td>
			  </tr>
			  <tr>
				<td height="28" align="left" valign="middle" >Message:</td>
				<td height="28" align="left" valign="middle"><textarea  name="trns_messg" style="resize:none" id="trns_messg" class="order_required" ></textarea></td>
			  </tr>
			 
			  <tr>
			<td align="left" valign="middle" colspan="2" height="10"></td>
			</tr>                                    
			<tr>
			<td height="28" align="left" valign="middle"></td>
			<td height="28" align="left" valign="middle">
			<input type="submit" name="tracksys_update" value="Save" id="tracksys_update"></td>
			</tr>
			<tr>
			<td height="28" align="left" valign="middle"></td>
			<td height="28" align="left" valign="middle">
			&nbsp;&nbsp;<!--<a href="Forgot-Password.php" class="footertext">Forgot Password ?</a>--></td>
			</tr>
			  </table>
					  </form>
</div>
</div>



<?php /*?><div style="display:">
<div id="dialog1" style="padding:50px;  width:400px;  min-height:150px;">
<form method="post" action="" name="view_tracking" onSubmit="">
			<table width="100%" border="0" align="left" cellpadding="5" cellspacing="0"  style="border:#CCCCCC solid; border-radius:8px; " >
			<tr>
				<td height="4" align="left" valign="middle" colspan="2" >
				<input type="hidden" name="view_transx_id" id="view_transx_id"  value="" />
				
				</td>
			  </tr>
			   <tr>
				<td height="4" align="left" valign="middle" colspan="2" ></td>
			  </tr>
			  <tr>
				<td height="12" align="center" valign="middle" colspan="2" style="font-style:italic;color:#FF0000" >&nbsp;Previous Status .</td>
			  </tr>
			   <tr>
				<td height="8" align="left" valign="middle" colspan="2" >&nbsp;</td>
			  </tr>
			  <tr>
									   
				<td width="28%" height="28" align="left" valign="middle" ><strong>Status:</strong></td>
		 		 <td width="72%" height="28" align="left" valign="middle">
				 <label id="status_disp"></label>
				 <!--<input type="text" name="status_disp" id="status_disp" value="" readonly="" />-->
				 
				 </td>
			  </tr>
			   <tr>
				<td height="28" align="left" valign="middle" ><strong>Shippment&nbsp;Number</strong><br /><small>(If shipped)</small>:</td>
				<td height="28" align="left" valign="middle">
				<label id="shipment_number_disp"></label><strong></strong>
				<!--<input type="text" name="shipment_number_disp"  id="shipment_number_disp" class="order_required" readonly="" >--></td>
			  </tr>
			  <tr>
				<td height="28" align="left" valign="middle" ><strong>Message:</strong></td>
				<td height="28" align="left" valign="middle">
				<label id="trns_messg_disp"></label><strong></strong>
				<!--<textarea  name="trns_messg_disp" style="resize:none" id="trns_messg_disp" class="order_required" readonly="readonly" ></textarea>--></td>
			  </tr>
			 
			  <tr>
			<td align="left" valign="middle" colspan="2" height="10"></td>
			</tr>                                    
			<!--<tr>
			<td height="28" align="left" valign="middle"></td>
			<td height="28" align="left" valign="middle">
			<input type="submit" name="tracksys_update" value="Save" id="tracksys_update"></td>
			</tr>-->
			<tr>
			<td height="28" align="left" valign="middle"></td>
			<td height="28" align="left" valign="middle">
			&nbsp;&nbsp;<!--<a href="Forgot-Password.php" class="footertext">Forgot Password ?</a>--></td>
			</tr>
			  </table>
					  </form>
</div>
</div><?php */?>





<?php  ?>
<script type="text/javascript">

/*$("#tracksys_update").click(function(){
  $(".order_required").each(function(){
    //alert($(this).val());
	if($(this).val()=="")
	{
	alert("please check the Fields");
	return  false;
	}
	
	
	
  });
});*/

$("#tracksys_update").click(function(){
if($("#tracking_status").val()==0){
alert("Please select the status of the Order");
return false;
}

});


</script>
