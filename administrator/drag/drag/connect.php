<?php
$dbhost							= "localhost";
$dbuser							= "root";
$dbpass							= "root";
$dbname							= "istepup";

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ("Error connecting to database");
mysql_select_db($dbname);
?>