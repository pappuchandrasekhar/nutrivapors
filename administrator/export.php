<?php
$filename ="excelreport.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n"; header('Content-type: application/ms-excel'); header('Content-Disposition: attachment; filename='.$filename);
$contents="sreerama";
echo $contents;
?>