<?php

class sitesettingsClass

{

 function recentActivities($matter,$type)

 {

 	global $callConfig;

	$fieldnames=array('matter'=>$matter,'date_time'=>STR_TO_TIME,'type'=>$type);

	$res=$callConfig->insertRecord(TPREFIX.TBL_RECENTACTIVITIES,$fieldnames);

	$query=$callConfig->selectQuery(TPREFIX.TBL_RECENTACTIVITIES,'id','','id desc','25','100000000');

	$res=$callConfig->getAllRows($query);

	foreach($res as $r)

	{

	 $callConfig->deleteRecord(TPREFIX.TBL_RECENTACTIVITIES,'id',$r->id);

	}

 }

 function gettenrecentActivitiesList($limit)

 {

 	global $callConfig;

	$query=$callConfig->selectQuery(TPREFIX.TBL_RECENTACTIVITIES,'*','','id DESC','',$limit);

	return $callConfig->getAllRows($query);

 }

 function lastlogin()

 {

	global $callConfig;

	$query="UPDATE ".TPREFIX.TBL_ADMIN." SET lastlogin='".strtotime(date("m-d-Y H:i:s"))."' where user_id='".$_SESSION['userid']."'";

	$callConfig->executeQuery($query);

 }

  function sitesettings($post)

  {

	global $callConfig;

    $logobanner = $callConfig->freeimageUploadcomncode('logo','site_image',"../uploads/site/","../uploads/site/thumbs/",$post['hdn_site_image'],185,51);

	$fieldnames=array('theme_selection'=>$post['theme_selection'],'title'=>mysql_real_escape_string($post['title']),'site_image'=>$logobanner,'noofrecords'=>$post['noofrecords'],'footer_txt'=>mysql_real_escape_string($post['footer_txt']),'fblink'=>$post['fblink'],'twittlink'=>$post['twittlink'], 'ytlink'=>$post['ytlink'], 'plink'=>$post['plink'],'adminfooter_txt'=>mysql_real_escape_string($post['adminfooter_txt']),'shippingamount'=>$post['shippingamount'],'dollaramount'=>$post['dollaramount'],'googleanalytics'=>mysql_real_escape_string($post['googleanalytics']),'mail_fromname'=>$post['mail_fromname'],'mail_frommail'=>$post['mail_frommail'],'contactusmail'=>$post['contactusmail'],'ordermail'=>$post['ordermail'], 'phone'=>$post['phone'], 'address'=>$post['address'], 'initial_rate'=>$post['initial_rate'], 'add_rate_oz'=>$post['add_rate_oz'], 'email'=>$post['email'], 'contact'=>$post['contact']       , 'bulkcontactusmail'=>$post['bulkcontactusmail']);

	$res=$callConfig->updateRecord(TPREFIX.TBL_SITESETTINGS,$fieldnames,'','');

	if($res==1)

	{

		sitesettingsClass::recentActivities('Site settings updated successfully on >> '.DATE_TIME_FORMAT.'','g');

		$callConfig->headerRedirect("index.php?option=com_sitesettings&err=Site settings updated successfully");

	}

	else

	{

		sitesettingsClass::recentActivities('Site settings updation failed on >> '.DATE_TIME_FORMAT.'','e');

		$callConfig->headerRedirect("index.php?option=com_sitesettings&ferr=Site settings updation failed");

	}

  }

  function getsitesettings()

  {

	global $callConfig;

	$query=$callConfig->selectQuery(TPREFIX.TBL_SITESETTINGS,'*','','','','');

	return $callConfig->getRow($query);

  }

  function getTotalDatabaseTables()

  {

	global $callConfig;

	$query="SHOW TABLES";

	return $callConfig->getAllRows($query);

  }

  

  function databaseBackupTables($tables = '*')

	{

	global $callConfig;

	//get all of the tables

	if($tables == '*')

	{

		$tables = array();

		$result = mysql_query('SHOW TABLES');

		while($row = mysql_fetch_row($result))

		{

			$tables[] = $row[0];

		}

	}

	else

	{

		$tables = is_array($tables) ? $tables : explode(',',$tables);

	}

	

	//cycle through

	foreach($tables as $table)

	{

		$result = mysql_query('SELECT * FROM '.$table);

		$num_fields = mysql_num_fields($result);

		

		$return.= 'DROP TABLE '.$table.';';

		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));

		$return.= "\n\n".$row2[1].";\n\n";

		

		for ($i = 0; $i < $num_fields; $i++) 

		{

			while($row = mysql_fetch_row($result))

			{

				$return.= 'INSERT INTO '.$table.' VALUES(';

				for($j=0; $j<$num_fields; $j++) 

				{

					$row[$j] = addslashes($row[$j]);

					$row[$j] = ereg_replace("\n","\\n",$row[$j]);

					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }

					if ($j<($num_fields-1)) { $return.= ','; }

				}

				$return.= ");\n";

			}

		}

		$return.="\n\n\n";

	}

	

	//save file

	$path = $_SERVER['DOCUMENT_ROOT']."/omar/backups/";

	$handle = fopen($path."/".'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');

	fwrite($handle,$return);

	fclose($handle);

	 // change the path to fit your websites document structure

$fullPath = $path."/".'db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql';



if ($fd = fopen ($fullPath, "r")) {

    $fsize = filesize($fullPath);

    $path_parts = pathinfo($fullPath);

    $ext = strtolower($path_parts["extension"]);

    switch ($ext) {

        case "pdf":

        header("Content-type: application/pdf"); // add here more headers for diff. extensions

        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download

        break;

        default;

        header("Content-type: application/octet-stream");

        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");

    }

    header("Content-length: $fsize");

    header("Cache-control: private"); //use this to open files directly

    while(!feof($fd)) {

        $buffer = fread($fd, 2048);

        echo $buffer;

    }

}

fclose ($fd);

exit;

/*$gzdata = gzencode($return, 9);

$handle = fopen('db-'.date("ymd").'.sql.gz','w+');

fwrite($handle, $gzdata);

fclose($handle);*/

}  

}

?>