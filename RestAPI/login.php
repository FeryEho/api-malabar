<?php

   if($_SERVER['REQUEST_METHOD']=='POST'){
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file
       include_once("config.php");
       
    $NoTelepon = $_POST['NoTelepon'];
 	$Password = md5($_POST['Password']);
 	
	 if( $NoTelepon == '' || $Password == '' ){
	        echo json_encode(array( "status" => "false","message" => "Parameter missing!") );
	 }else{
	 	$query= "SELECT * FROM register WHERE NoTelepon='$NoTelepon' AND Password='$Password'";
	        $result= mysqli_query($con, $query);
		 
	        if(mysqli_num_rows($result) > 0){  
	         $query= "SELECT * FROM register WHERE NoTelepon='$NoTelepon' AND Password='$Password'";
	                     $result= mysqli_query($con, $query);
		             $emparray = array();
	                     if(mysqli_num_rows($result) > 0){  
	                     while ($row = mysqli_fetch_assoc($result)) {
                                     $emparray[] = $row;
                                   }
	                     }
	           echo json_encode(array( "status" => "true","message" => "Login successfully!", "data" => $emparray) );
	        }else{ 
	        	echo json_encode(array( "status" => "false","message" => "Invalid No. Telepon or Password!") );
	        }
	         mysqli_close($con);
	 }
	} else{
			echo json_encode(array( "status" => "false","message" => "Error occured, please try again!") );
	}
?>