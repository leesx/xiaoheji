<?php
include_once("config.php");
	//print_r($_POST);

	 $ID = $_POST['id'];
	 //echo $ID;
	 $sql = "delete from  todaypay where id='$ID'";
	 $query = mysql_query($sql);
	 if(!$query)
		{
		  die('Could not delete data: ' . mysql_error());
		}
	 
	 echo json_encode(array(
	 	'rs'=>true
	 ));
	 mysql_close();
?>
