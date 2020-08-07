<?php

	if($_SERVER['REQUEST_METHOD']=='POST'){
	include_once("config.php");

	$Nama              	   = $_POST['Nama'];

	$target_dir            = "./upload/imagesprofil";
    $image                 = $_POST['image'];

    if(!file_exists($target_dir)){
      mkdir($target_dir, 0777, true);
    }

    $target_dir = $target_dir ."/". $Nama . ".jpeg";
    file_put_contents($target_dir, base64_decode($image));

    $PhotoProfil = $Nama . ".jpeg";

    mysqli_query($con, "INSERT INTO profil VALUES (NULL,'$Nama','$PhotoProfil')");

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