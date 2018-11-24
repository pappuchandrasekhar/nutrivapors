<?php 
$con = mysql_connect("localhost","root","");
$dbcon=mysql_select_db("nutrivapors", $con);

$subcategory=$_REQUEST['q'];
?>
<select name="sscid"  class="select_medium required" >
<option value="">Select</option>
<?php
$str=mysql_query("select * from tb_store_products where scid='".$subcategory."'");
$num_rows=mysql_num_rows($str);
if($num_rows!=''){
while($row=mysql_fetch_assoc($str)){
?>
<option value="<?php echo $row['spid'];?>,<?php echo $row['prodtitle'];?>"><?php echo $row['prodtitle'];?></option>
<?php }}else{ ?> 
<option >NO Products</option>
<?php }?>
</select>

