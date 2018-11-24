<?php 

include('includes/session.php');

include("model/newsletter.class.php");

//include('model/subscribers.class.php');
$newsletterObj=new newsletterClass();

if($_GET['action']=="delete"){

   $newsletterObj->subsciberDelete($_GET['id']);

}

if($_GET['st']!="" || $_GET['st']=="Active" || $_GET['st']=="Inactive"){

   $newsletterObj->subsciberStatusChanging($_GET);

}

/*if($_POST['pageredirect']=="Send Mails")

{

 $newsletterObj->massMailSending($_POST);

}*/

if($_POST['assign']=="Send Mails")
{//print_r($_POST);exit;
 if(count($_POST['list'])>0)
 {
	//print_r($_POST);exit;
	  $str=implode(",",$_POST['list']);
	  header("Location:index.php?option=mail&sid=".$callConfig->passwordEncrypt($str));
 }

}
$start=0;

if($_GET['start']!="")

$start=$_GET['start'];

$limit=50;

if($_GET['fld']!="")

$fldname=$_GET['fld'];

else

$fldname="id";

if($_GET['ord']!="")

$orderby=$_GET['ord'];

else

$orderby="DESC";

$allsubscribers=$newsletterObj->getAllSubscibersList($fldname,$orderby,$start,$limit);

$total=$newsletterObj->getAllSubscibersListCount();

?>

<script type="text/javascript">

function getrelatedData(val)
{

window.location.href="index.php?option=com_subscribers&b_id="+val;

}

</script>

<script type="text/javascript" src="js/checkuncheckall.js"></script>



<div class="box">
<div class="heading">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="middle"><h1><img src="allfiles/map.jpeg" alt=""> Subscribers</h1></td>
        <td align="right" valign="bottom">&nbsp;</td>
      </tr>
    </table>
  </div>

<div class="content">
<form method="post" name="myform" action="">
	 <table width="100%" border="0" cellpadding="0" cellspacing="0" class="list">
          <thead>

            <tr height="50">

              <td width="20" align="center" valign="middle">sno</td>

			   <td width="238" align="left" valign="middle" >Email Id</td>

              <td width="721" align="left" valign="middle" class="sort">

					<div>

					<a href="index.php?option=com_subscribers&ord=ASC&fld=emailid" class="up" title="up"></a>

					<a href="index.php?option=com_subscribers&ord=DESC&fld=emailid" class="down" title="down"></a>

					</div>

</td>
			<td width="74" align="center" valign="middle" >Assign All

              <input type="checkbox" name="check" id="check"  value="" onclick="checkAlluncheckAll('myform', 'list')" style="margin-left:33px; margin-right:37px;"/></td>

			  <td width="63" align="center" valign="middle" >Status</td>
			  <td width="38" align="center" valign="middle" >Delete</td>
            </tr>
          </thead>
			<tbody>
			<?php
			if(sizeof($allsubscribers)>0){
					$ii=0;
					foreach($allsubscribers as $allsubscriberslist){
					?>
			<tr height="22">
			<td height="65" align="center" valign="middle"><?=($ii+1);?></td>
			<td colspan="2" align="left" valign="middle"><?php echo $allsubscriberslist->emailid;?></td>
            
            <td width="49"  valign="middle"  style=" vertical-align:middle; text-align:center;">
			
			<input type="checkbox" name="list[]" id="list" value="<?php echo $allsubscriberslist->id?>" <?php if( $allsubscriberslist->assign=='1'){echo 'checked';} ?>  />

 <input type="hidden" name="art[]" value="<?php echo $all_pages->id?>"/>
			&nbsp;&nbsp;</td>
			<td align="center" valign="middle"><a href="index.php?option=com_subscribers&id=<?php echo $allsubscriberslist->id;?>&st=<?php echo $allsubscriberslist->status;?>"><?php echo $allsubscriberslist->status;?></a></td>
            
			<td align="center" valign="middle">

						<a title="delete" href="#" onClick="var q = confirm('Are you sure you want to delete selected record?'); if (q) { window.location = 'index.php?option=com_subscribers&action=delete&id=<?php echo $allsubscriberslist->id;?>'; return false;}"><img src="allfiles/icon_delete.png"  alt="Delete" border="0"/></a>

			  </td>

			</tr>

			<?php

				$ii++; } } else{

			?>

				<tr><td colspan="8" align="center" height="100">No Subscribers..</td></tr>

			<?php 

			}

			?>
			</tbody>
            
            <tr>
          <td colspan="3" align="right">&nbsp;</td>
          <td colspan="2" align="center"><input type="submit" name="assign" value="Send Mails"  class="submit-green" style=" float:right;margin-right:136px;"/></td>
          <td colspan="3" align="right">&nbsp;</td>
        </tr>
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

			$callConfig->paginavigation($start, $limit, $total, 'index.php?option=com_subscribers', $param);

			?>

			</ul>

			<?php 

			}

			?>
            </td>
            </tr>
            </table>
	</form>
    </div>
    </div>

