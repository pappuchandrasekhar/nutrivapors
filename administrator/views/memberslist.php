<?php 
include('includes/session.php');
if($_GET['action']=="delete"){
   $userObj->forntuserDelete($_GET['id']);
}
if($_GET['st']!="" || $_GET['st']=="Active" || $_GET['st']=="Inactive"){
   $userObj->forntuserStatusChanging($_GET);
}
/*if($_POST['bulksubmit']=="Apply"){
   $userObj->adminusersBulkAction($_POST);
}
if($_POST['admininsert']=="Submit"){
   $userObj->insertAdminUser($_POST);
}
if($_POST['admininsert']=="Update"){
   $userObj->updateAdminUser($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$userObj->getAdminUserData($_GET['id']); 
   $hdn_in_up='class="button button_save"';
} else { 
  $hdn_value="Submit";
  $hdn_in_up='class="button button_add"';
}*/
$start=0;
if($_GET['start']!="")$start=$_GET['start'];
if($site_settings_disp->noofrecords!="0")
$limit=$site_settings_disp->noofrecords;
else
$limit=25;
if($_GET['fld']!="")
$fldname=$_GET['fld'];
else
$fldname="user_id";
if($_GET['ord']!="")
$orderby=$_GET['ord'];
else
$orderby="ASC";
$allusers=$userObj->getAllAdminUsersList('level2',$fldname,$orderby,$start,$limit);
$total=$userObj->getAllAdminUsersListCount('level2');
?>
<script type="text/javascript">
function trim(stringToTrim)
{
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}
function validate()
{
		
		var name=trim(document.frmCreateAdmin.name.value);
			if(name.length<1)
			{
				alert("Please Enter User Name");
				document.frmCreateAdmin.name.focus();
				return false;
		    }
			
			var password=trim(document.frmCreateAdmin.password.value);
			if(password.length<1)
			{
				alert("Please Enter Password");
				document.frmCreateAdmin.password.focus();
				return false;
		    }		
			
		
			var email=trim(document.frmCreateAdmin.email.value);
			if(email.length<1)
			{
				alert("Please Enter Email");
				document.frmCreateAdmin.email.focus();
				return false;
			}	
			
			var emailreg=/^[a-zA-Z0-9\.\_]+@[a-zA-Z0-9\.\_]+\.[a-zA-Z0-9\.]+$/		
			if(document.frmCreateAdmin.email.value.search(emailreg) == -1){
				alert("Please Enter Valid Email");
				document.frmCreateAdmin.email.focus();
				return false;
			}

}

</script>
<?php
if($option!="com_memberlist_insert"){
?>
<div class="box">
<div class="heading"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/users.jpeg" alt=""> Users</h1></td>
<td align="right" valign="bottom"><?php /*?> <a href="index.php?option=com_memberlist_insert" >
<input class="button button_add" value="" type="button"></a><?php */?></td>
</tr>
</table>
</div>
<div class="content">
		<form method="post" name="adminForm" id="adminForm" action="" onSubmit="if(document.getElementById('bulkaction').value=='bulktrash')confirm('Are you sure you want to delete selected records?'); return true;">
		<?php /*?><table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
		<thead>
		<tr>
		<td width="11%" align="left" valign="middle">
		<select name="bulkaction" id="bulkaction" class="select_small required" style="text-transform:none; width:130px; height:26px;">
		<option value="">--Bulk Actions--</option>
		<option value="Active">Active</option>
		<option value="Inactive">Inactive</option>
		<option value="bulktrash">Move to Trash</option>
		</select>
		</td>
		<td width="89%" align="left" valign="middle"><input type="submit" name="bulksubmit" value="Apply"/></td>
		</tr>
		</thead>
		</table><?php */?>
	 
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="38" align="left" valign="middle" style="text-align: center;"><?php /*?><input type="checkbox" name="check" id="check" value="All" onClick="checkAlluncheckAll('adminForm', 'list')"/><?php */?>sno</td>
            
              <td width="110" align="left" valign="middle" >password</td>
			  <td width="105" align="left" valign="middle" >&nbsp;</td>
			  <td width="194" align="left" valign="middle" >email</td>
			  <td width="165" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=com_memberlist&ord=ASC&fld=email" class="up" title="up"></a>
					<a href="index.php?option=com_memberlist&ord=DESC&fld=email" class="down" title="down"></a></div></td>
			  <td width="35" align="center" valign="middle" >status</td>
<td width="76" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
					$ii=0;
					foreach($allusers as $all_users){
					?>
			<tr height="22">
			<td align="center" valign="middle"><?php echo ($ii+1);?>			</td>
			<td colspan="2" align="left" valign="middle">* * * * * * *</td>
			<td colspan="2" align="left" valign="middle" ><?php echo $all_users->email;?></td>
			<td align="center" valign="middle"><a href="index.php?option=com_memberlist&id=<?php echo $all_users->user_id;?>&st=<?php echo $all_users->status;?>"><?php echo $all_users->status;?></a></td>
			<td align="center" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_memberlist&action=delete&id=<?php echo $all_users->user_id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a></td>
			</tr>
			<?php
					$ii++;
							}
							?>
			</tbody>
						<tr><td colspan="14" align="left"><?php if($total>$limit){
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['ord']!="")
			$param.="&ord=".$_GET['ord'];
			if($_GET['ord']!="")
			$param.="&fld=".$_GET['fld'];
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_memberlist', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		
      </table>
	 </form>
	</div>
  </div>
   <?php }?>