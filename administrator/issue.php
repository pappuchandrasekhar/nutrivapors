<?php 
ob_start();
session_start();
include('../dbconfig.php');
include('includes/dbconnection.php');
include("model/issue.class.php");
$issueObj=new issueClass();

$q = strtolower($_GET["q"]);
//print_r($_GET);
if($_GET['q']!='')
{
	$allcategorylist=$issueObj->getSubjectsData($_GET['q']);?>
	<select name="subid" id="subid" class="select_medium required" style="width:220px;">
	<option value=""> Select Subjects </option>
	<?php
	foreach($allcategorylist as $catlist)
	{
	?>
	<option value="<?php echo $catlist->id;?>"><?php echo stripslashes($catlist->title);?></option>
	<?php
	}
	?>
	</select>
	
	
	<?php 
}
elseif($_GET['subcat']!='')
{
	 $allcategorylist=$issueObj->getissueAllSubCatData($_GET['subcat']);
	//print_r($allcategorylist);
	?>
	<select name="scid" id="scid" class="select_medium required" style="width:220px;" onchange="showFields(this.value)">
	<option value=""> Select SubCategory </option>
	<?php
	foreach($allcategorylist as $catlist)
	{
	?>
	<option value="<?php echo $catlist->scid;?>"><?php echo stripslashes($catlist->catetitle);?></option>
	<?php
	}
	?>
	</select>
	<?php
}
/*elseif($_GET['sub']!='')
{
	//echo "sub";exit;
	$value_disp=explode(',',$_GET['sub']);
	//print_r($value_disp);exit;
	$cnt_disp=count($value_disp)-1;
	//echo $cnt_disp;exit;
	for($i=0;$i<=$cnt_disp;$i++)
	{
		//echo $_POST['value_disp'][$i];
		 $allsubjectslist=$proofObj->getSubjectsData($value_disp[$i]);
		  foreach($allsubjectslist as $allsubjects)
		  {
		  	echo  "<input type='checkbox' name='subject[]' value='".$allsubjects->id."'  />".$allsubjects->title."<br>";
		  }
	}
}*/
/*elseif($_GET['sss']!='')
{
	$allfieldslist=$issueObj->getallFieldsList($_GET['sss']);
	$fields_val=explode(',',$allfieldslist->fields_vals);
	$fields_cnt=count($fields_val);
?>
	<div id="contentLeft">
	<ul>
<?php
	for($k=0;$k<$fields_cnt;$k++)
	{
		//echo $fields_val[$k];
		$new_field_id=$issueObj->getFields_by_id($fields_val[$k]);
		//$new_field_value_id=$issueObj->getFields_value_by_id($_GET['sss'],$_GET['pid'],$fields_val[$k]);
		//$new_field_value_id=$issueObj->getFields_value_by_id($_GET['product_id'],$fields_val[$k]);
		$sub_cat_id=$issueObj->getProduct_sub_id($_GET['sss']);
		if($_GET['product_id']!='')
		{
			$new_field_value_id=$issueObj->getFields_value_by_id($_GET['product_id'],$sub_cat_id->id,$fields_val[$k]);
		}
		else
		{
			//$new_field_value_id=$issueObj->getFields_value_by_id('',$sub_cat_id->id,$fields_val[$k]);
		}
		?>
		<li id="recordsArray_<?php echo $k ?>">
		<table  border="0" cellspacing="0" cellpadding="0" height="30">
		  <tr>
			<td width="150"><?php echo $new_field_id->field_name;?></td>
			<td width="200">
			<input type="text" name="new_field_val[]" value="<?php echo $new_field_value_id->value;?>"  size="100"/>
			<input type="hidden" name="new_field_s[]" value="<?php echo $new_field_id->id;?>"  size="100"/>
			<input type="hidden" name="new_position[]" value="<?php echo $k+1;?>" />
			<input type="hidden" name="new_product_id" value="<?php echo $_GET['product_id'];?>" />
			</td>
		  </tr>
		</table>
		</li>
		<?php
		
	}
	?>
	</ul>
	</div>
<?php
}
?>*/


elseif($_GET['sss']!='')
{
	//echo $_GET['id'];
	/*$allfieldslist=$issueObj->getallFieldsList($_GET['sss']);
	$fields_val=explode(',',$allfieldslist->fields_vals);
	$allfdlist_1=$issueObj->getallFieldsList_new($allfieldslist->fields_vals,$_GET['product_id'],$_GET['sss']);*/
	$allfieldslist=$issueObj->getallFieldsList($_GET['sss']);
	$fieldsForsubcat=$issueObj->getSubcatFieldList($allfieldslist->fields_vals);
	
	//if(count($allfdlist_1)>0)
	//{
		?>
		<div id="contentLeft">
		<ul>
		<?php
		
		$k=1;
		foreach($fieldsForsubcat as $fields)
		{
		$allfdlist_1=$issueObj->getallFieldsList_new($fields->id,$_GET['product_id'],$_GET['sss']);
		?>
		<li id="recordsArray_<?php echo $fields->id;?>">
			<table width="700" border="0" cellspacing="0" cellpadding="0" height="30">
			  <tr>
				<td width="250"  align="left" valign="middle"><?php echo $fields->field_name;?><sup><?php echo stripslashes($allfdlist_1->sup_value);?></sup></td>
				<td width="200"  align="left" valign="middle">
				<input type="text" name="new_field_val[]" value="<?php echo $allfdlist_1->value;?>" size="80" class="sort_text_field"/>
				<input type="hidden" name="new_field_s[]" value="<?php echo $allfdlist_1->id."~~".$fields->id;?>"  />
				<input type="hidden" name="new_position[]" value="<?php echo $k++;?>" />
				<input type="hidden" name="new_product_id" value="<?php echo $_GET['product_id'];?>" />
				</td>
				<td width="100" align="left" valign="middle"><input type="text" name="sup_value[]" value="<?php echo $allfdlist_1->sup_value_new;?>"  size="6"  /></td>
			  </tr>
			</table>
		</li>	
		<?php
		 }	
		 ?>
		</ul>
		</div>
		<?php 
	//}
	//else
	//{
		 /*?>$allfdlist_1=$issueObj->getFields_valueslist_by_id($_GET['sss']);
		$fields_val=explode(',',$allfdlist_1->fields_vals);
		//print_r($fields_val);
		$fields_cnt=count($fields_val);
		?>
		<div id="contentLeft">
		<ul>
		<?php
		
		$k=0;
		for($k=0;$k<$fields_cnt;$k++)
		{
			$new_field_id=$issueObj->getFields_by_id($fields_val[$k]);
		?>
		<li id="recordsArray_<?php echo $new_field_id->id;?>">
			<table width="700"  border="0" cellspacing="0" cellpadding="0" height="30">
			  <tr>
				<td width="250" align="left" valign="middle"><?php echo $new_field_id->field_name;?></td>
				<td width="200" align="left" valign="middle">
				<input type="text" name="new_field_val[]" value="<?php echo $new_field_id->value;?>"  size="80" class="sort_text_field"/>
				<input type="hidden" name="new_field_s[]" value="<?php echo $new_field_id->id;?>"  />
				<input type="hidden" name="new_position[]" value="<?php echo $k+1;?>" />
				<input type="hidden" name="new_product_id" value="<?php echo $_GET['product_id'];?>" />
				</td>
				<td width="100" align="left" valign="middle"><input type="text" name="sup_value[]" value="<?php echo $fields->sup_value_new;?>"  size="6"  /></td>
			  </tr>
			</table>
		</li>	
		<?php
		 }	
		 ?>
		</ul>
		</div><?php */?>
		<?php
	//}
	?>
	
	 <?php			
}	

elseif($_GET['getcount']!='')
{
	//echo $_GET['getcount'];
	?>
		
				<div id="txtHint">
				<?php 
				$total_1=$issueObj->getSubcategoryCount($_GET['getcount']);
				$val=count($total_1)+1;
				?>
				<input name="order" class="text_large required" type="text" value="<?php echo $val;?>" />
				</div>
				
	<?php
}
?>


