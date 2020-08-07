<?php
    include_once ('../includes/config.php');
    $connect->set_charset('utf8');
    

      $kodepengajuan    =$_POST['kodepengajuan'];
      $nama             =$_POST['nama'];
      $alamat           =$_POST['alamat'];
      $tgl_pengajuan    =$_POST['tgl_pengajuan'];
      $sifatkredit      =$_POST['sifatkredit'];
      $jenispenggunaan  =$_POST['jenispenggunaan'];
      $golongandebitur  =$_POST['golongandebitur'];
      $sektorekonomi    =$_POST['sektorekonomi'];
      $instansi         =$_POST['instansi'];
      $wilayah          =$_POST['wilayah'];
      $ao               =$_POST['ao'];
      $golonganpenjamin =$_POST['golonganpenjamin'];
      $plafond          =$_POST['plafond'];
      $jangkawaktu      =$_POST['jangkawaktu'];
      $jaminan          =$_POST['jaminan'];

      mysqli_query($connect, "INSERT INTO tbl_pengajuankredit VALUES (NULL,'$kodepengajuan','$nama','$alamat','$tgl_pengajuan','$sifatkredit','$jenispenggunaan','$golongandebitur','$sektorekonomi','$instansi','$wilayah','$ao','$golonganpenjamin','$plafond','$jangkawaktu','$jaminan')");

     
?>