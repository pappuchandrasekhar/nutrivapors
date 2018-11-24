<?php 

$con = mysql_connect("localhost","user","Media3123");
$dbcon=mysql_select_db("nutrivaporsdb", $con);
$subcategory=$_REQUEST['q'];
$nag="delete from tb_store_value where id='".$subcategory."'";
$ddf=mysql_query($nag);


?>