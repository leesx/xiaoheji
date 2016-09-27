<?php
include_once("config.php");

	 //$payitems = $_POST['payitems'][0];
	 $sql = "select * from  todaypay order by id";
	 $query = mysql_query($sql);
	 if(!$query)
		{
		  die('Could not get data: ' . mysql_error());
		}
	 while($row = mysql_fetch_array($query))
		{
			$arr[] = array(
				'id' => $row['id'],
				'name' => $row ['name'],
				'date' => $row['date'],
				'price' => $row['price']
			);
		    
		} 
	 echo json_encode(array(
	 	'rs'=>true,
	 	'data'=> $arr
	 ));
	 mysql_close();
?>