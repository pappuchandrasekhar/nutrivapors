<?php 
include('includes/session.php');
include("model/register.class.php");
$reguserObj=new registerUserClass();
if($_GET['action']=="delete"){
   $reguserObj->registeruserDelete($_GET['id']);
}
if($_POST['bulksubmit']=="Apply"){
   $reguserObj->adminusersBulkAction($_POST);
}
if($_POST['admininsert']=="Submit"){
   $reguserObj->insertRegisterUser($_POST);
}
if($_POST['admininsert']=="Update"){
   $reguserObj->updateRegisterUser($_POST);
}
if(isset($_GET['id']) && $_GET['id']!=""){
   $hdn_value="Update";
   $indivdata=$reguserObj->getAdminUserData($_GET['id']); 
   $hdn_in_up='class="button button_save"';
} else { 
  $hdn_value="Submit";
  $hdn_in_up='class="button button_add"';
}
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
$allusers=$userObj->getAllUsersList('','','','');
$total=$userObj->getAllUsersListCount();
?>
<script>
function checkingEmailUnique(email_address)
{
	//alert(email_address);
	jQuery.ajax({
		type: "POST",
		url: "jquery_ajax_check_controls.php",
		data: "email_address="+email_address,
		
		success: function(msg){
			//alert(data);
			$("#email_check_value").val(msg);
		}
	});
}
</script>

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
				alert("Please Enter first name");
				document.frmCreateAdmin.name.focus();
				return false;
		    }
			
			
			var lname=trim(document.frmCreateAdmin.lastname.value);
			if(lname.length<1)
			{
				alert("Please Enter last name");
				document.frmCreateAdmin.lastname.focus();
				return false;
		    }
			
			
			
			
			
			
			var emailreg=/^[a-zA-Z0-9\.\_]+@[a-zA-Z0-9\.\_]+\.[a-zA-Z0-9\.]+$/		
			if(document.frmCreateAdmin.email.value.search(emailreg) == -1){
				alert("Please Enter Valid Email");
				document.frmCreateAdmin.email.focus();
				return false;
			}
			
			
			var data=$("#email_check_value").val();
        //alert(data);
           if(data==1)
       {
	//var validemail=document.getElementById('msgdiv_email').innerHTML='Send allerede Registered.Please Logg inn med denne e-id';
	
	alert('email already registered please login with another email id');
	document.frmCreateAdmin.email.focus();
	document.frmCreateAdmin.email.select;
	return false;
    }

			
			
			
			<?php /*?>var email=trim(document.frmCreateAdmin.email.value);
			if(email.length<1)
			{
				alert("Please Enter Email");
				document.frmCreateAdmin.email.focus();
				return false;
			}	<?php */?>
			
			var password=trim(document.frmCreateAdmin.password.value);
			if(password.length<1)
			{
				alert("Please Enter Password");
				document.frmCreateAdmin.password.focus();
				return false;
		    }		
			var city=trim(document.frmCreateAdmin.city.value);
			if(city.length<1)
			{
				alert("Please Enter city");
				document.frmCreateAdmin.city.focus();
				return false;
		    }	
		
		
		var state=trim(document.frmCreateAdmin.state.value);
			if(state.length<1)
			{
				alert("Please Enter state");
				document.frmCreateAdmin.state.focus();
				return false;
		    }	
			
			
			var zip=trim(document.frmCreateAdmin.zip.value);
			if(zip.length<1)
			{
				alert("Please Enter zip");
				document.frmCreateAdmin.zip.focus();
				return false;
		    }	
			
			
			if(isNaN(zip))
 {
	 alert("please enter only numbers");
	 document.frmCreateAdmin.zip.focus();
	 return false;
 }
			
			
			var phone=trim(document.frmCreateAdmin.phone.value);
			if(phone.length<1)
			{
				alert("Please Enter phone number");
				document.frmCreateAdmin.phone.focus();
				return false;
		    }
			
			
			
			if(isNaN(phone))
 {
	 alert("please enter only numbers");
	 document.frmCreateAdmin.phone.focus();
	 return false;
 }
	
	if(phone.length<10)
 {
	 alert("mobile number should contain 10 numbers");
	 document.frmCreateAdmin.phone.focus();
	 return false;
 }

			
			
			
			
			var address=trim(document.frmCreateAdmin.address.value);
			if(address.length<1)
			{
				alert("Please Enter address");
				document.frmCreateAdmin.address.focus();
				return false;
		    }	
			
			
			
			var stat=trim(document.frmCreateAdmin.status.value);
			if(stat.length<1)
			{
				alert("Please specify status");
				document.frmCreateAdmin.status.focus();
				return false;
		    }	
return true;
}





</script>
<?php
if($option!="com_userslist_insert"){
?>
<div class="box">
<div class="heading"><table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="middle"> <h1><img src="allfiles/users.jpeg" alt="">Registered Users</h1></td>
<td align="right" valign="bottom"><input class="button button_add" value="" type="button" onclick="window.location.href='index.php?option=com_userslist_insert';"></td>
</tr>
</table>
</div>

		
        <div class="content">
		<form method="post" name="adminForm" id="adminForm" action="" onsubmit="if(document.getElementById('bulkaction').value=='bulktrash')confirm('Are you sure you want to delete selected records?'); return true;">
	 
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>
            <tr height="25">
              <td width="38" align="left" valign="middle" style="text-align: center;"><?php /*?><input type="checkbox" name="check" id="check" value="All" onClick="checkAlluncheckAll('adminForm', 'list')"/><?php */?>sno</td>
			   <td width="88" align="left" valign="middle" >Username</td>
              <td width="158" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=com_userslist&ord=ASC&fld=us_name" class="up" title="up"></a>
					<a href="index.php?option=com_userslist&ord=DESC&fld=us_name" class="down" title="down"></a>
			  </div></td>
              <td width="110" align="left" valign="middle" >password</td>
			  <td width="105" align="left" valign="middle" >&nbsp;</td>
			  <td width="194" align="left" valign="middle" >email</td>
			  <td width="165" align="left" valign="middle" class="sort">
					<div >
					<a href="index.php?option=com_userslist&ord=ASC&fld=email" class="up" title="up"></a>
					<a href="index.php?option=com_userslist&ord=DESC&fld=email" class="down" title="down"></a></div></td>
			  <td width="35" align="center" valign="middle" >status</td>
              <td width="32" align="center" valign="middle" >Edit</td>
			  <td width="76" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
					$ii=0;
					foreach($allusers as $all_users){
					?>
			<tr height="22">
			<td align="center" valign="middle"><?php echo ($ii+1);?></td>
			<td colspan="2" align="left" valign="middle"><?php echo $all_users->first_name;?></td>
			<td colspan="2" align="left" valign="middle">* * * * * * *</td>
			<td colspan="2" align="left" valign="middle" ><?php echo $all_users->email_address;?></td>
			<td align="center" valign="middle"><?php echo $all_users->status;?></td>
			<td align="center" valign="middle"x><a title="edit" href="index.php?option=com_userslist_insert&id=<?php echo $all_users->user_id;?>"><img src="allfiles/icon_edit.png" alt="Edit" border="0"></a></td>
			<td align="center" valign="middle">
						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_userslist&action=delete&id=<?php echo $all_users->user_id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>
						</td>
			</tr>
			<?php
					$ii++;
							}
							?>
			</tbody>
						<tr><td colspan="12" align="left"><?php if($total>$limit){
			?>
			<ul class="paginator" style="float:right; margin-left:-25px;">
			<?php 
			$param="";
			if($_GET['ord']!="")
			$param.="&ord=".$_GET['ord'];
			if($_GET['ord']!="")
			$param.="&fld=".$_GET['fld'];
			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_userslist', $param);
			?>
			</ul>
			<?php 
			}
			?></td></tr>		
      </table>
	 </form>
	</div>
  </div>
   <?php } else {?>
   <div class="box">
    <div class="heading">
      <h1><img src="allfiles/users.jpeg" alt=""> Add Registeruser &nbsp;&nbsp;/&nbsp;&nbsp; Edit Registeruser</h1>
    </div>
    <div class="content">
	<form action="index.php?option=com_userslist_insert" method="post" id="frmCreateAdmin" name="frmCreateAdmin" class="middle_form" onsubmit="return validate();">
	
    
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td width="26%" align="left" valign="middle"><label class="title">First Name:<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td width="74%" align="left" valign="middle"><input name="name" id="name" class="text_large required" type="text" value="<?php echo $indivdata->first_name?>">&nbsp;&nbsp;<span id="uname_error" style="display:none;">Please Enter Username</span></td>
	</tr>
	
       <tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<?php /*?>onblur="getdata(this.value);"<?php */?> 
    <tr>
	<td align="left" valign="middle"><label class="title">last name :<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle"><input name="lastname" id="lastname" class="text_large required" type="text" value="<?php echo $indivdata->lastname;?>">&nbsp;&nbsp;<span id="password_error" style="display:none;">Please Enter Password</span></td>
	</tr>
    
    
    
    <tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">Email :<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle"><input name="email" id="email" class="text_large required" type="text" onChange="checkingEmailUnique(this.value);" onblur="getdata(this.value);" value="<?php echo $indivdata->email_address?>">&nbsp;&nbsp;<span id="email_error" style="display:none;">Please Enter Email</span>
    <input type="hidden" name="email_check_value" id="email_check_value" value="" />
    </td>
	</tr>
    
    
    
    
    <tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">Password :<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle"><input name="password" id="password" class="text_large required" type="password" value="<?php echo $callConfig->passwordDecrypt($indivdata->password);?>">&nbsp;&nbsp;<span id="password_error" style="display:none;">Please Enter Password</span></td>
	</tr>
    
    
    <tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">city :<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle"><input name="city" id="city" class="text_large required" type="text" value="<?php echo $indivdata->city;?>"></td>
	</tr>
         
       
    
       
        
    <tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">state :<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle"><input name="state" id="state" class="text_large required" type="text" value="<?php echo $indivdata->state;?>"></td>
	</tr>
         
         
          <tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">zip code:<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle"><input name="zip" id="zip" class="text_large required" type="text" value="<?php echo $indivdata->zip;?>"></td>
	</tr>
    
    
    
       <tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">phone number:<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle"><input name="phone" id="phone" class="text_large required" type="text" value="<?php echo $indivdata->phone;?>"></td>
	</tr>
    
     <tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<tr>
	<td align="left" valign="middle"><label class="title">address:<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle"><input name="address" id="address" class="text_large required" type="text" value="<?php echo $indivdata->address;?>"></td>
	</tr>
    
    
	
	<tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<?php /*?><?php 
	if($indivdata->user_id!="1"){
	?><?php */?>
	<tr>
	<td align="left" valign="middle"><label class="title">Status :<span style=" color:#FF0000; font-size:14px">*</span> </label></td>
	<td align="left" valign="middle">
	<select name="status" id="status" class="select_large required">
	<option value="">select</option>
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
	<tr>
	<td colspan="2" height="5" align="left" valign="middle" ></td>
	</tr>
	<?php /*?><?php
	}
	?><?php */?>
	<tr>
	<td align="left" valign="middle" colspan="2"><input name="hdn_user_id" type="hidden" value="<?php echo $indivdata->user_id?>"><input value="<?php echo $hdn_value;?>" class="button button_add" type="hidden" name="admininsert"><input <?php echo $hdn_in_up;?> type="submit" value="">
	</td>
	</tr>
	</table>
	</form>
</div>
</div>
	 <?php }?>