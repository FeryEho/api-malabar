<?php
	include_once("config.php");

	$query = mysqli_query($con, 'SELECT * FROM daftarbank');
	while($row = mysqli_fetch_assoc($query)) {
		$set['data'][] = $row;
	}
	header('Content-Type: application/json; charset=utf-8');
    echo $val = str_replace('\/', '/', json_encode($set));		
	
?>