<?php
    include_once ('../includes/config.php');
    $connect->set_charset('utf8');
    

//$kode = $_POST['kode'];
  $nama = $_POST['nama'];
  $kelamin = $_POST['kelamin'];
  $ktp = $_POST['ktp'];
  $tgllahir = $_POST['tgllahir'];
  $agama = $_POST['agama'];
  $pekerjaan = $_POST['pekerjaan'];
  $alamat = $_POST['alamat'];
  $kodya = $_POST['kodya'];
  $kecamatan = $_POST['kecamatan'];
  $kelurahan = $_POST['kelurahan'];
  $statusperkawinan = $_POST['statusperkawinan'];
  $telepon = $_POST['telepon'];
  $statuskewarganegaraan = $_POST['statuskewarganegaraan'];
  $plafond = $_POST['plafond'];
  $penghasilankotor = $_POST['penghasilankotor'];
  $jaminan = $_POST['jaminan'];

  mysqli_query($connect, "INSERT INTO tbl_registerbaru VALUES (NULL,'$nama','$kelamin','$ktp','$tgllahir','$agama','$pekerjaan','$alamat','$kodya','$kecamatan','$kelurahan','$statusperkawinan','$telepon','$statuskewarganegaraan','$plafond','$penghasilankotor','$jaminan')");


?>