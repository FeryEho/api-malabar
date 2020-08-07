<?php 

	if (isset($_GET['No'])) {
		$ID = $_GET['No'];
	} else {
		$ID = "";
	}
			
	// delete data from menu table
	$sql_query = "DELETE FROM tbl_pengajuankredit WHERE No = ?";
			
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
				
	// if delete data success back to previous page
	if($delete_result) {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
	}

?>