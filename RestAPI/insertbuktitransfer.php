<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
	include_once("config.php");

  $NoTelepon                   = $_POST['NoTelepon'];
	$NoRekening              	   = $_POST['NoRekening'];
  $NamaPemilikRekening         = $_POST['NamaPemilikRekening'];
  $TotalSetor                  = $_POST['TotalSetor'];

  $Tanggal = date("Y-m-d");
  $DateTime = date("Y-m-d h:m:s");

	$target_dir              = "./upload/imagesbuktitransfer";
    $image                 = $_POST['image'];

    if(!file_exists($target_dir)){
      mkdir($target_dir, 0777, true);
    }

    $target_dir = $target_dir ."/". $NoTelepon ."_". $DateTime . ".jpeg";
    file_put_contents($target_dir, base64_decode($image));

    $PhotoBukti = $NoTelepon ."_". $DateTime . ".jpeg";


    mysqli_query($con, "INSERT INTO buktitransfer VALUES (NULL,'$NoTelepon','$NoRekening','$NamaPemilikRekening','$TotalSetor','$PhotoBukti','$Tanggal','$DateTime')");

	 	//$query = "INSERT INTO buktitransfer (Kode, Nama, PhotoBukti) VALUES (NULL,'$NoRekening','$NamaPemilikRekening','$PhotoBukti')";
		//mysqli_query($con,$query);
    $set['keterangan']='Data Berhasil Disimpan!';
    header('Content-Type: application/json; charset=utf-8');
    echo $val = str_replace('\/', '/', json_encode($set));
  }else{
  	$set['keterangan']='Data Gagal Disimpan!';
  	header('Content-Type: application/json; charset=utf-8');
    echo $val = str_replace('\/', '/', json_encode($set));
  }
?>