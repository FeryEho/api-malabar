<?php
	include_once("config.php");
	$TanggalAwal                   = $_POST['TanggalAwal'];
	$TanggalAkhir                  = $_POST['TanggalAkhir'];
	$query = mysqli_query($con, "SELECT * FROM buktitransfer where Tanggal >= '$TanggalAwal' and Tanggal <= '$TanggalAkhir'");
	while($row = mysqli_fetch_assoc($query)) {
		$set['data'][] = $row;
	}
	header('Content-Type: application/json; charset=utf-8');
    echo $val = str_replace('\/', '/', json_encode($set));	

	/*$TanggalAwal                   = date("Y-m-d",$_POST['TanggalAwal']);
	$TanggalAkhir                  = date("Y-m-d",$_POST['TanggalAkhir']);

	$query = mysqli_query($con, "SELECT * FROM buktitransfer where Tanggal >= '$TanggalAwal' and Tanggal <= '$TanggalAkhir' ");
	while($row = mysqli_fetch_assoc($query)) {
		$set['data'][] = $row;
	}
	header('Content-Type: application/json; charset=utf-8');
    echo $val = str_replace('\/', '/', json_encode($set));		
	*/
?>