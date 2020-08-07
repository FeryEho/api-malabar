<?php

  include_once ('../includes/config.php');
  $connect->set_charset('utf8');

  $sql_query      = "SELECT * FROM tbl_admin ORDER BY id DESC LIMIT 1";
  $user_result    = mysqli_query($connect, $sql_query);
  $user_row       = mysqli_fetch_assoc($user_result);
  $admin_email    = $user_row['email'];  
  
  $access_key = "123456" ;
  
  if (isset($_GET['login'])) {    
    $imei         = $_POST['imei'] ;
    $username     = $_POST['username'] ;
    $password     = $_POST['password'] ;
    $query        = "SELECT imei,username,password FROM tbl_username_mcolektor WHERE imei = '$imei' AND username ='$username' AND password = '$password'  ORDER BY imei DESC";       
    $resouter = mysqli_query($connect, $query);

    $set = array();
      $total_records = mysqli_num_rows($resouter);
      if($total_records >= 1) {
      if ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
         $set['login'][]['status']      = true ;
       }
     }else{
       $set['login'][]['status']      = false ;
     }

      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));    
  
    }else  if (isset($_GET['download_debitur'])) {    
        $imei           = $_POST['imei'] ;
        $kodeao         = $_POST['ao'] ;
        $cabangentry    = $_POST['cabangentry'] ;
        $query = "SELECT d.rekening, r.nama, r.alamat, SUM(a.dpokok-a.kpokok) AS bakidebet FROM debitur d 
        LEFT JOIN registernasabah r ON r.Kode=d.kode
        LEFT JOIN angsuran a ON a.Rekening=d.Rekening 
        GROUP BY d.Rekening limit 500 ";       
        $resouter = mysqli_query($connect, $query);
    
        $set = array();
          $total_records = mysqli_num_rows($resouter);
          if($total_records >= 1) {
          while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
             //$set['login'][]['status']      = true ;
            $set['data'][]=$link;
           }
         }else{
           //$set['data'][]['status']      = false ;
         }
    
          header('Content-Type: application/json; charset=utf-8');
          echo $val = str_replace('\/', '/', json_encode($set));  
  }else if (isset($_GET['download_agunan'])) {    
    $imei           = $_POST['imei'] ;
    $kodeao         = $_POST['ao'] ;
    $cabangentry    = $_POST['cabangentry'] ;
    $query = "SELECT a.rekening, r.nama, r.alamat, j.keterangan, a.nilaijaminan  FROM agunan a
    LEFT JOIN jaminan j ON j.Kode = a.Jaminan
    LEFT JOIN registernasabah r ON r.Kode = a.Kode
    ORDER BY a.ID limit 100";       
    $resouter = mysqli_query($connect, $query);

    $set = array();
      $total_records = mysqli_num_rows($resouter);
      if($total_records >= 1) {
      while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
         //$set['login'][]['status']      = true ;
        $set['data'][]=$link;
       }
     }else{
       //$set['data'][]['status']      = false ;
     }

      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));  

}else if (isset($_GET['insert_registrasi'])) {    
    $nama                  = $_POST['nama'];
    $kelamin               = $_POST['kelamin'];
    $ktp                   = $_POST['ktp'];
    $tgllahir              = $_POST['tgllahir'];
    $agama                 = $_POST['agama'];
    $pekerjaan             = $_POST['pekerjaan'];
    $alamat                = $_POST['alamat'];
    $kodya                 = $_POST['kodya'];
    $kecamatan             = $_POST['kecamatan'];
    $kelurahan             = $_POST['kelurahan'];
    $statusperkawinan      = $_POST['statusperkawinan'];
    $telepon               = $_POST['telepon'];
    $statuskewarganegaraan = $_POST['statuskewarganegaraan'];
    $plafond               = $_POST['plafond'];
    $penghasilankotor      = $_POST['penghasilankotor'];
    $jaminan               = $_POST['jaminan'];

    $target_dir            = "./upload/images";
    $image                 = $_POST['image'];

    if(!file_exists($target_dir)){
      mkdir($target_dir, 0777, true);
    }

    $target_dir = $target_dir ."/". $ktp . ".jpeg";
    file_put_contents($target_dir, base64_decode($image));

    $poto = $ktp . ".jpeg";

      mysqli_query($connect, "INSERT INTO tbl_registerbaru VALUES (NULL,'$nama','$kelamin','$ktp','$tgllahir','$agama','$pekerjaan','$alamat','$kodya','$kecamatan','$kelurahan','$statusperkawinan','$telepon','$statuskewarganegaraan','$plafond','$penghasilankotor','$jaminan','$poto')");
      $set['keterangan']='Data Berhasil Disimpan';

  
      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['edit_registrasi'])) {
    $kode                  = $_POST['kode'];    
    $nama                  = $_POST['nama'];
    $kelamin               = $_POST['kelamin'];
    $ktp                   = $_POST['ktp'];
    $tgllahir              = $_POST['tgllahir'];
    $agama                 = $_POST['agama'];
    $pekerjaan             = $_POST['pekerjaan'];
    $alamat                = $_POST['alamat'];
    $kodya                 = $_POST['kodya'];
    $kecamatan             = $_POST['kecamatan'];
    $kelurahan             = $_POST['kelurahan'];
    $statusperkawinan      = $_POST['statusperkawinan'];
    $telepon               = $_POST['telepon'];
    $statuskewarganegaraan = $_POST['statuskewarganegaraan'];
    $plafond               = $_POST['plafond'];
    $penghasilankotor      = $_POST['penghasilankotor'];
    $jaminan               = $_POST['jaminan'];
    
    //$target_dir            = "./upload/images";
    $image                 = $_POST['image'];
       
    if(!file_exists($target_dir)){
      mkdir($target_dir, 0777, true);
    }

    //unlink($target_dir);
    $target_dir = $target_dir ."/". $ktp . ".jpeg";
    file_put_contents($target_dir, base64_decode($image));

    $poto = $ktp . ".jpeg";


      mysqli_query($connect, "UPDATE tbl_registerbaru SET nama='$nama', kelamin='$kelamin', ktp='$ktp', tgllahir='$tgllahir', agama='$agama', pekerjaan='$pekerjaan', alamat='$alamat', kodya='$kodya', kecamatan='$kecamatan', kelurahan='$kelurahan', statusperkawinan='$statusperkawinan', telepon='$telepon', statuskewarganegaraan='$statuskewarganegaraan', plafond='$plafond', penghasilankotor='$penghasilankotor', jaminan='$jaminan', poto='$poto' WHERE kode='$kode'");
      
      $set['keterangan']='Data Berhasil Diupdate'; 

  
      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['delete_registrasi'])) {
      $kode                  = $_POST['kode'];
      $ktp                   = $_POST['ktp'];
      

      unlink('./upload/images/' . $ktp . ".jpeg");
      mysqli_query($connect, "DELETE from tbl_registerbaru WHERE kode='$kode'");
      
      $set['keterangan']='Data Berhasil Dihapus'; 

  
      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['insert_pengajuan'])){
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

      mysqli_query($connect,"INSERT INTO tbl_pengajuankredit VALUES (NULL,'$kodepengajuan','$nama','$alamat','$tgl_pengajuan','$sifatkredit','$jenispenggunaan','$golongandebitur','$sektorekonomi','$instansi','$wilayah','$ao','$golonganpenjamin','$plafond','$jangkawaktu','$jaminan')");

      $set['keterangan']='Data Berhasil Disimpan';

      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));

    }else if (isset($_GET['download_registerbaru'])) {    
    $imei           = $_POST['imei'] ;
    $kodeao         = $_POST['ao'] ;
    $cabangentry    = $_POST['cabangentry'] ;
    $query          = "SELECT r.kode, r.ktp, r.nama, r.kelamin, r.ktp, r.tgllahir, r.agama, r.pekerjaan, r.alamat, r.kodya, r.kecamatan, r.kelurahan, r.statusperkawinan, r.telepon, r.statuskewarganegaraan,r.plafond, r.penghasilankotor, r.jaminan, r.poto, s.karakter, s.kapasitas, 
      s.asset, s.agunan, s.kondisi FROM tbl_registerbaru r
      LEFT JOIN tbl_surveynasabahbaru s ON s.Kode=r.Kode
      WHERE r.Kode";       
    $resouter = mysqli_query($connect, $query);
  
    $set = array();
      $total_records = mysqli_num_rows($resouter);
      if($total_records >= 1) {
      while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
         //$set['login'][]['status']      = true ;
        $set['data'][]=$link;
       }
     }else{
       //$set['data'][]['status']      = false ;
     }
  
      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['download_nasabahsudahsurvey'])) {    
    $imei           = $_POST['imei'] ;
    $kodeao         = $_POST['ao'] ;
    $cabangentry    = $_POST['cabangentry'] ;
    $query          = "SELECT s.IdSurvey, r.Kode, r.Ktp, s.Poto, r.Nama, r.Kelamin, r.Telepon,
        r.Plafond, r.Jaminan, s.Karakter, s.Kapasitas, 
        s.Asset, s.Agunan, s.Kondisi FROM tbl_registerbaru r
    LEFT JOIN tbl_surveynasabahbaru s ON s.Kode=r.Kode
    WHERE s.Kode";       
    $resouter = mysqli_query($connect, $query);
  
    $set = array();
      $total_records = mysqli_num_rows($resouter);
      if($total_records >= 1) {
      while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
         //$set['login'][]['status']      = true ;
        $set['data'][]=$link;
       }
     }else{
       //$set['data'][]['status']      = false ;
     }
  
      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['insert_surveybaru'])) {
    $kode                  = $_POST['kode'];
    $ktp                   = $_POST['ktp'];    
    /*$nama                  = $_POST['nama'];
    $kelamin               = $_POST['kelamin'];
    $telepon               = $_POST['telepon'];
    $plafond               = $_POST['plafond'];
    $jaminan               = $_POST['jaminan'];
    */
    $karakter              = $_POST['karakter'];
    $kapasitas             = $_POST['kapasitas'];
    $asset                 = $_POST['asset'];
    $agunan                = $_POST['agunan'];
    $kondisi               = $_POST['kondisi'];
    
    //$target_dir            = "./upload/images";
    $image                 = $_POST['image'];
       
    if(!file_exists($target_dir)){
      mkdir($target_dir, 0777, true);
    }
    //unlink($target_dir);
    $target_dir = $target_dir ."/". $ktp . ".jpeg";
    file_put_contents($target_dir, base64_decode($image));

    $poto = $ktp . ".jpeg";

      mysqli_query($connect, "INSERT INTO tbl_surveynasabahbaru VALUES (NULL,'$kode', '$poto', '$karakter', '$kapasitas', '$asset', '$agunan', '$kondisi')");
      
      $set['keterangan']='Data Berhasil Disimpan';

  
      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['delete_surveynasabahbaru'])) {
      $IdSurvey                  = $_POST['IdSurvey'];

      mysqli_query($connect, "DELETE from tbl_surveynasabahbaru WHERE IdSurvey='$IdSurvey'");
      
      $set['keterangan']='Data Berhasil Dihapus'; 

      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['edit_surveynasabahbaru'])) {
    $IdSurvey              = $_POST['IdSurvey'];
    $Kode                  = $_POST['Kode'];
    $Ktp                   = $_POST['Ktp'];
    $Karakter              = $_POST['Karakter'];
    $Kapasitas             = $_POST['Kapasitas'];
    $Asset                 = $_POST['Asset'];
    $Agunan                = $_POST['Agunan'];
    $Kondisi               = $_POST['Kondisi'];    
    
    //$target_dir            = "./upload/images";
    $image                 = $_POST['image'];
       
    if(!file_exists($target_dir)){
      mkdir($target_dir, 0777, true);
    }

    //unlink($target_dir);
    $target_dir = $target_dir ."/". $Ktp . ".jpeg";
    file_put_contents($target_dir, base64_decode($image));

    $Poto = $Ktp . ".jpeg";


      mysqli_query($connect, "UPDATE tbl_surveynasabahbaru SET Kode='$Kode', Poto='$Poto', Karakter='$Karakter', Kapasitas='$Kapasitas', Asset='$Asset', Agunan='$Agunan', Kondisi='$Kondisi' WHERE IdSurvey='$IdSurvey'");
      
      $set['keterangan']='Data Berhasil Diupdate'; 

  
      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['jumlah_register'])) {

    $sql    = mysqli_query($connect, "SELECT * FROM tbl_registerbaru");
    $jumlah = mysqli_num_rows($sql);
    $set['data'] = $jumlah; 

      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['jumlah_survey'])) {

    $sql    = mysqli_query($connect, "SELECT * FROM tbl_surveynasabahbaru");
    $jumlah = mysqli_num_rows($sql);
    $set['data'] = $jumlah; 

      header('Content-Type: application/json; charset=utf-8');
      echo $val = str_replace('\/', '/', json_encode($set));
      
    }else if (isset($_GET['get_help'])) {

    $query    = "SELECT * FROM tbl_help ORDER BY id DESC";
    $resouter = mysqli_query($connect, $query);

    $set            = array();
    $total_records  = mysqli_num_rows($resouter);
    if($total_records >= 1) {
      while ($link = mysqli_fetch_array($resouter, MYSQLI_ASSOC)){
        $set[] = $link;
      }
    }

    header('Content-Type: application/json; charset=utf-8');
    echo $val = str_replace('\/', '/', json_encode($set)); 

  } else {
    header('Content-Type: application/json; charset=utf-8');
    echo "no method found!";
  }
   
?>