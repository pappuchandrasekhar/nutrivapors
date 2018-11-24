<?php
//error_reporting(1);
?>
<?php
if($_SERVER['HTTP_HOST'] == "localhost" ){
$host = "localhost";
$username = "root";
$password = " ";
$dbname = "firesafety";
}

$connection=mysqli_connect($host,$username,$password,$dbname);

// Check connection
if (mysqli_connect_errno($connection))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

if( $_POST['mobiles'] ){
	$mobiles = explode( "\r\n", $_POST['mobiles'] );
	$res = mysqli_query( $connection, "select * from wpr_company ");
	while( $row = mysqli_fetch_array( $res ) ){
		$vv = false;
		foreach( $mobiles as $i=>$j ){
			if( $j == $row['mobile'] && $row['mobile'] != "" ){
				$vv = true;
				break;
			}
		}
		echo "<div>" . $row['id'] . " : " . $row['mobile'] .  " = " . ($vv?"True":"False") . " </div>";
		if( !$vv ){
			$query = "update postlist_tataphoton_dec set done = 'z', date = '' where id = " . $row['id'];
			echo "<div>" . $query . "</div>";
			mysqli_query( $connection, $query );
		}
	}
	exit;
}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd" >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
<title>Firesafety</title>
<style type="text/css" >
<!--
body,td,th {font-family: Arial, Helvetica, sans-serif;font-size: 11px;}
-->
</style></head>
<body>
<form name="form1" method="post" action="" enctype="multipart/form-data" >
  <table width="950" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" >
    <tr>
      <td bgcolor="#f0f0f0"><strong>Upload Excel File:</strong></td>
    </tr>
    <tr>
      <td bgcolor="#ffffff">
      <table width="500"  border="0" align="center" cellpadding="5" cellspacing="1" >
        <tr>
          <td>Excel File:</td>
          <td><input type="file" name="file" id="file" ></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" value="Upload"></td>
        </tr>
      </table>
      <p><strong>Columns in excel file:</strong>glno,schemeno,name,father_name,citizenship,age,regi_date </p>
<!--      <p><strong>State list should be in:</strong>CHENNAI,KOLKATA,MUMBAI,ANDHRAPRADESH</p>
-->      <p><strong>Column names should be lower case.</strong></p>
      </td>
    </tr>
  </table>
  <input type="hidden" name="action" value="upload" >
</form>
<?php
//	print_r( $_POST );
	if( $_POST['action'] == "upload" ){

		$error_list=array();
		print_r( $_FILES );
		if ( isset( $_FILES['file']['tmp_name'] ) ){

			if( preg_match( "/(\.xlsx)/i", $_FILES['file']['name'] ) ){
				echo "<h2>Upload .xls  file .. office 2003 format</h2>";	exit;
			}

			if($_SERVER['HTTP_HOST'] == "localhost" ){
				//$d = "D:/AppServ/www/mani/temp.xls";
				$d="D:/xampp/htdocs/firesafety/administrator/excel/temp.xls";
			  //echo $d;
			}else{
				$d = "/home/wepaarco/public_html/application/excel/temp.xls";
			}
			@unlink( "temp.xls" );
			move_uploaded_file( $_FILES['file']['tmp_name'] , $d );
			@chmod( "temp.xls" , 0777 );

			include('team/excellreader/excel_reader2.php');

			$data = new Spreadsheet_Excel_Reader();
			$data->setOutputEncoding('CP1251');
			$error = $data->read( "temp.xls" );
			if( $error ){
				echo "<h2>Got Error in process <br>" . $error . "</h2>";
				exit;
			}else{
				$p = $data->sheets[0];
				$d =  $p['cells'];
				//echo "<div>Total Rows: " . $p['numRows'] . "</div>";
				//echo $d[1][5];
				//exit;

				$errors = array();
				$rows = array();

                 /*if(!($d[1][1] == "name" && $d[1][2] == "email" && $d[1][3] == "mobile" && $d[1][4] == "state" && $d[1][5] == "city" )   )*/

				if(!($d[1][1] == "glno" && $d[1][2] == "doorno" && $d[1][3] == "streetname" && $d[1][4] == "location" && $d[1][5] == "city" && $d[1][6] == "pincode")){
					//echo "<div>" . $d[1][1] . " - " . $d[1][2] . " - " . $d[1][3] . " - " . $d[1][4] . " - " . $d[1][5] . " - " . $d[1][6] . "</div>";
					echo "<h2>Column Names Not Correct, column names should be 1 =glno,  2 =doorno, 3 =streetname, 4 =location, 5=city, 6=pincode </h2>";
								
					exit;
				}else{
					$errors = false;
					for ($i = 2; $i <=$data->sheets[0]['numRows']; $i++){
						
						$glno 	= strip_tags( @addslashes($d[$i][1]) );
						$doorno   =  strip_tags( @addslashes($d[$i][2]) ) ;
						$streetname   =  strip_tags( @addslashes($d[$i][3]) ) ;
						$location   = strip_tags( @addslashes($d[$i][4]) ) ;
						$city   =  strip_tags( @addslashes($d[$i][5]) ) ;
						$pincode  =  strip_tags( @addslashes($d[$i][6]) ) ;
						
						
						
						/*$phone   = strtolower( strip_tags( @addslashes($d[$i][8]) ) );
						$phone2   = ucwords(strtolower( strip_tags( @addslashes($d[$i][9]) ) ));
						$phone3   = ucwords(strtolower( strip_tags( @addslashes($d[$i][10]) ) ));
						$mobile   = ucwords(strtolower( strip_tags( @addslashes($d[$i][11]) ) ));*/
						

						if( $glno == "" ){
							echo "<h2>Line :" . $i . ": Gl No is empty</h2>" ;$errors = true;
						//	exit;
						}
						
						//echo $companyslug;
				

						$rows[] = array( $glno ,$doorno,$streetname,$location,$city,$pincode);
						
						//print_r($rows);
						

					}

					if( $errors ){
						exit;
					}

					$dberrors = 0;
					$dbdone = 0;
					foreach( $rows as $i=>$j ){
						$glno = $j[0];
						$doorno = $j[1];
						$streetname = $j[2];
						$location= $j[3];
						$city  = $j[4];
						$pincode = $j[5];
						//$regi_date = $j[6];
						/*$address = $j[8];
						$phone = $j[9];
						$phone2 = $j[10];
						$phone3 = $j[11];
						$mobile = $j[12];
						$website = $j[13];
						$emailid = $j[14];
						*/
						//$files = $glno.".pdf";
						//$visitor = $glno.".pdf";

						//$query = "insert into postlist_tataphoton_dec ( name, email, mobile, state,city, pincode) values (
						$query = "insert into tb_aswin (glno,doorno,streetname,location,city,pincode) values (
						'" . mysqli_escape_string( $connection, $glno ) . "',
						'" . mysqli_escape_string( $connection, $doorno ) . "',
						'" . mysqli_escape_string( $connection,$streetname ) . "',
						'" . mysqli_escape_string( $connection, $location) . "',
						'" . mysqli_escape_string( $connection,$city ) . "',
						'" . mysqli_escape_string( $connection, $pincode  ) . "'
										
						) ";
						
						echo "<div>" . $query . "</div>";
						
						mysqli_query( $connection, $query );
						echo mysqli_affected_rows ($connection );
						if(  mysqli_error( $connection ) != "" ){
							echo "<div>" . $query . "</div>";
							echo "<div>" . mysqli_error( $connection ) . "</div>";
							$dberrors++;
						}else{
							$dbdone++;
						}
						//insert into postlist_tataphoton_dec ( name, email, mobile, mobile, city, pin, type ) values ( "shekar", "kasabashekar@rediffmail.com", "-", "9845598931", "Bangalore", "48","apollo"); 
					}

					echo "<h2>Inserted: " . $dbdone . "</h2>";
					echo "<h2>Errors: " . $dberrors . "</h2>";
					echo '<h3 align="center" ><a href="report1.php" >back</a></h3>' ;

				}
			}
			//echo "-" . $data->sheets[1]['cells'][2][15] . "==";

		}else{
			echo "file not uploaded";
			exit;
		}
	}

function findStateId($cityid = "", $states = array())
{
foreach($states as $stateid => $cities)
{ 	
	if(array_search($cityid, $cities)!== FALSE)
	{
	return $stateid;
	}
}
}

?>

</body>
</html>