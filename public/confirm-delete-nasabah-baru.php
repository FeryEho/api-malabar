<?php 

	if (isset($_GET['Id'])) {
		$ID = $_GET['Id'];
	} else {
		$ID = "";
	}
		
	// get image file from menu table
	$sql_query = "SELECT PhotoKTP FROM datanasabah WHERE Id = ?";	
	$stmt = $connect->stmt_init();
	if ($stmt->prepare($sql_query)) {	
		// Bind your variables to replace the ?s
		$stmt->bind_param('s', $ID);
		// Execute query
		$stmt->execute();
		// store result 
		$stmt->store_result();
		$stmt->bind_result($data['PhotoKTP']);
		$stmt->fetch();
		$stmt->close();
	}
			
	// delete image file from directory
	$delete = unlink('./RestAPI/upload/imagesktp/' . $data['PhotoKTP']);
	//$delete = unlink('upload/thumbs/'."$product_image");

	$sql_query = "SELECT PhotoNasabah FROM datanasabah WHERE Id = ?";	
	$stmt = $connect->stmt_init();
	if ($stmt->prepare($sql_query)) {	
		// Bind your variables to replace the ?s
		$stmt->bind_param('s', $ID);
		// Execute query
		$stmt->execute();
		// store result 
		$stmt->store_result();
		$stmt->bind_result($data['PhotoNasabah']);
		$stmt->fetch();
		$stmt->close();
	}
			
	// delete image file from directory
	$delete = unlink('./RestAPI/upload/images/' . $data['PhotoNasabah']);
			
	// delete data from menu table
	$sql_query = "DELETE FROM datanasabah WHERE Id = ?";
			
	$stmt = $connect->stmt_init();
	if ($stmt->prepare($sql_query)) {	
		// Bind your variables to replace the ?s
		$stmt->bind_param('s', $ID);
		// Execute query
		$stmt->execute();
		// store result 
		$delete_result = $stmt->store_result();
		$stmt->close();
	}
				
	// if delete data success back to reservation page
	if($delete_result) {
		header("location: manage-nasabah-baru.php");
	}

?>