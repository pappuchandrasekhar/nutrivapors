<?php
ob_start();
session_start();
include('dbconfig.php');
include('administrator/includes/dbconnection.php');
global $callConfig;
$query = "select real_price from tb_store_value where id=".$_GET['id'];
$data = $callConfig->getRow($query);
/*print number_format($data->n_listprice,2);
*/

/*print "<label style='text-decoration:line-through;font-size:15px;color:#000;margin-left:13px;'>$".number_format($data->n_listprice,2)."</label><br/>";

print "$".number_format($data->n_netprice,2);*/

print number_format($data->real_price,2);
print ":::";
print number_format($data->real_price,2);

?>