<?php

   if($_SERVER['REQUEST_METHOD']=='POST'){
  // echo $_SERVER["DOCUMENT_ROOT"];  // /home1/demonuts/public_html
//including the database connection file
       include_once("config.php");
       
    
 	$Nama 					= $_POST['Nama'];
 	$NoTelepon 				= $_POST['NoTelepon'];
 	$JenisKelamin 			= $_POST['JenisKelamin'];
 	$TempatLahir 			= $_POST['TempatLahir'];
 	$TglLahir 				= $_POST['TglLahir'];
 	$Agama 					= $_POST['Agama'];
 	$StatusPerkawinan 		= $_POST['StatusPerkawinan'];
 	$Pendidikan 			= $_POST['Pendidikan'];
 	$Pekerjaan 				= $_POST['Pekerjaan'];
 	$Penghasilan 			= $_POST['Penghasilan'];
 	$Alamat 				= $_POST['Alamat'];
 	$RtRw 					= $_POST['RtRw'];
 	$Kota 					= $_POST['Kota'];
 	$Kecamatan 				= $_POST['Kecamatan'];
 	$Kelurahan 				= $_POST['Kelurahan'];
 	$KTP 					= $_POST['KTP'];
 	$NPWP 					= $_POST['NPWP'];
 	$Email 					= $_POST['Email'];
 	$Pasangan 				= $_POST['Pasangan'];
 	$IbuKandung 			= $_POST['IbuKandung'];
 	$AhliWaris 				= $_POST['AhliWaris'];
 	$TempatLahirAhliWaris 	= $_POST['TempatLahirAhliWaris'];
 	$TglLahirAhliWaris 		= $_POST['TglLahirAhliWaris'];
 	$HubunganAhliWaris 		= $_POST['HubunganAhliWaris'];
 	$TanggalPermohonan 		= $_POST['TanggalPermohonan'];

 	$target_dirktp 			= "./upload/imagesktp";
 	$image                 	= $_POST['image'];

 	$target_dirpoto 		= "./upload/images";
 	$image1                 = $_POST['image1'];

	//kodingan untuk upload ktp
 	if(!file_exists($target_dirktp)){
      mkdir($target_dirktp, 0777, true);
    }

    $target_dirktp = $target_dirktp ."/". $KTP . ".jpeg";
    file_put_contents($target_dirktp, base64_decode($image));

    $PhotoKTP = $KTP . ".jpeg";

    //kodingan untuk upload poto
    if(!file_exists($target_dirpoto)){
      mkdir($target_dirpoto, 0777, true);
    }

    $target_dirpoto = $target_dirpoto ."/". $Nama . ".jpeg";
    file_put_contents($target_dirpoto, base64_decode($image1));

    $PhotoNasabah = $Nama . ".jpeg";
 	//$PhotoKTP	 = $_POST['PhotoKTP'];
 	//$PhotoNasabah = $_POST['PhotoNasabah'];
 

  
	 if($Nama == '' || $NoTelepon == ''){
	        echo json_encode(array( "status" => "false","message" => "Silahkan Lengkapi Data!") );
	 }else{
	 		 $query = "INSERT INTO datanasabah (Id, Nama,NoTelepon,JenisKelamin, TempatLahir, TglLahir, Agama, StatusPerkawinan, Pendidikan, Pekerjaan, Penghasilan, Alamat, RtRw, Kota, Kecamatan, Kelurahan, KTP, NPWP, Email, Pasangan, IbuKandung, AhliWaris, TempatLahirAhliWaris, TglLahirAhliWaris, HubunganAhliWaris, PhotoKTP, PhotoNasabah, TanggalPermohonan) VALUES (NULL,'$Nama','$NoTelepon','$JenisKelamin','$TempatLahir','$TglLahir','$Agama','$StatusPerkawinan','$Pendidikan','$Pekerjaan','$Penghasilan','$Alamat','$RtRw','$Kota','$Kecamatan','$Kelurahan','$KTP','$NPWP','$Email','$Pasangan','$IbuKandung','$AhliWaris','$TempatLahirAhliWaris','$TglLahirAhliWaris','$HubunganAhliWaris','$PhotoKTP','$PhotoNasabah','$TanggalPermohonan')";
			 if(mysqli_query($con,$query)){
			    
			     $query= "SELECT * FROM datanasabah WHERE NoTelepon='$NoTelepon'";
	                     $result= mysqli_query($con, $query);
		             $emparray = array();
	                     if(mysqli_num_rows($result) > 0){  
	                     while ($row = mysqli_fetch_assoc($result)) {
                                     $emparray[] = $row;
                                   }
	                     }
			    echo json_encode(array( "status" => "true","message" => "Data Berhasil Disimpan" , "data" => $emparray) );
		 	 }else{
		 		 echo json_encode(array( "status" => "false","message" => "Data Gagal Disimpan!, Silahkan Periksa Lagi!") );
		 	}
	    }
	    mysqli_close($con);
	 }else{
			echo json_encode(array( "status" => "false","message" => "Insert Gagal, Silahkan Periksa Lagi!") );
	}
    
 
 ?>