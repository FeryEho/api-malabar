<?php

   if($_SERVER['REQUEST_METHOD']=='POST'){
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file
       include_once("config.php");
       
        $nama = $_POST['Nama'];
 	$notelepon = $_POST['NoTelepon'];
 	$password = md5($_POST['Password']);

  
	 if($nama == '' || $notelepon == '' || $password == ''){
	        echo json_encode(array( "status" => "false","message" => "Silahkan Lengkapi Data!") );
	 }else{
			 
	        $query= "SELECT * FROM register WHERE NoTelepon='$notelepon'";
	        $result= mysqli_query($con, $query);
		 
	        if(mysqli_num_rows($result) > 0){  
	           echo json_encode(array( "status" => "false","message" => "No. Telepon Sudah Terdaftar!") );
	        }else{ 
		 	 $query = "INSERT INTO register (Nama,NoTelepon,Password) VALUES ('$nama','$notelepon','$password')";
			 if(mysqli_query($con,$query)){
			    
			     $query= "SELECT * FROM register WHERE NoTelepon='$notelepon'";
	                     $result= mysqli_query($con, $query);
		             $emparray = array();
	                     if(mysqli_num_rows($result) > 0){  
	                     while ($row = mysqli_fetch_assoc($result)) {
                                     $emparray[] = $row;
                                   }
	                     }
			    echo json_encode(array( "status" => "true","message" => "Registrasi Berhasil!" , "data" => $emparray) );
		 	 }else{
		 		 echo json_encode(array( "status" => "false","message" => "Registrasi Gagal, Silahkan Periksa Lagi!") );
		 	}
	    }
	            mysqli_close($con);
	 }
     } else{
			echo json_encode(array( "status" => "false","message" => "Registrasi Gagal, Silahkan Periksa Lagi!") );
	}
 
 ?>