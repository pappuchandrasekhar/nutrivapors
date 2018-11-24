<?PHP
$conn = mysql_connect("localhost", "root", "root");
mysql_select_db("strongerrx", $conn);
 // Original PHP code by Chirp Internet: www.chirp.com.au // Please acknowledge use of this code by including this header. 
function cleanData(&$str) { 
$str = preg_replace("/\t/", "\\t", $str); $str = preg_replace("/\r?\n/", "\\n", $str);
 if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
 } 
// filename for download
 $filename = "website_data_" . date('Ymd') . ".xls"; 
 header("Content-Disposition: attachment; filename=\"$filename\"");
  header("Content-Type: application/vnd.ms-excel"); 
  $flag = false; 
  $result = mysql_query("SELECT * FROM tb_cart_transcation ORDER BY tx_id") or die('Query failed!'); 
  while(false !== ($row = mysql_fetch_assoc($result))) { if(!$flag) { // display field/column names as first row 
  echo implode("\t", array_keys($row)) . "\r\n"; $flag = true; } array_walk($row, 'cleanData'); echo implode("\t", array_values($row)) . "\r\n"; } exit; ?>