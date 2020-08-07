<?php include('session.php'); ?>
<?php 
  if (isset($_GET['Kode'])) {
    $ID = $_GET['Kode'];
  } else {
    $ID = "";
  }
      
  $error = array();
  $data = array();
    
  $sql_query = "SELECT * FROM tbl_registerbaru WHERE Kode = ?";

  
  $stmt = $connect->stmt_init();
  if ($stmt->prepare($sql_query)) {
     
    $stmt->bind_param('s', $ID);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result(
      $data['Kode'],
          $data['Nama'],
          $data['Kelamin'],
          $data['KTP'],
          $data['TglLahir'],
          $data['Agama'],
          $data['Pekerjaan'],
          $data['Alamat'],
          $data['Kodya'],
          $data['Kecamatan'],
          $data['Kelurahan'],
          $data['StatusPerkawinan'],
          $data['Telepon'],
          $data['StatusKewargaNegaraan'],
          $data['Plafond'],
          $data['PenghasilanKotor'],
          $data['Jaminan'],
          $data['Poto']
    );
    $stmt->fetch();
    $stmt->close();
  }

  $order_list = explode(',', $data['Kode']);
      
?>

<!--
<?php

$setting_qry    = "SELECT * FROM tbl_config where Kode = '1'";
$setting_result = mysqli_query($connect, $setting_qry);
$settings_row   = mysqli_fetch_assoc($setting_result);

$onesignal_app_id = $settings_row['onesignal_app_id']; 
$onesignal_rest_api_key = $settings_row['onesignal_rest_api_key'];
$protocol_type = $settings_row['protocol_type'];

define("ONESIGNAL_APP_ID", $onesignal_app_id);
define("ONESIGNAL_REST_KEY", $onesignal_rest_api_key); 

?>


<?php 
  
  include_once('sql-query.php');

  $userId   = $data['Imei'];
  $buyerName  = $data['Fullname'];
  $buyerCode  = $data['CIF'];

  if (isset($_POST['submit_aktivasi'])) {

        $content = array(                                              
                         "en" => "Aplikasi anda dengan imei: $userId sudah aktif, silakan melakukan pengecekan aktivasi."                                                 
             );
             
    $big_image = $protocol_type.$_SERVER['SERVER_NAME'].dirname($_SERVER['REQUEST_URI']).'/upload/notification/'.$data['image'];


        $fields = array(
                        'app_id' => ONESIGNAL_APP_ID,
                        'included_segments' => array('All'),   
            'data' => array("foo" => "bar","cat_id"=> "0","cat_name"=>$buyerName, "external_link"=>"marstech.co.id"),
                        'headings'=> array("en" => "Hi $buyerName,"),
            'contents' => $content,
            'big_picture' => ""   
                        );

    $fields = json_encode($fields);
    print("\nJSON sent:\n");
    print($fields);
        
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                   'Authorization: Basic '.ONESIGNAL_REST_KEY));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  

        $response = curl_exec($ch);
        curl_close($ch);    
 
    $data = array(
      'Status'  => 1
    );  

    $hasil = Update('tbl_username_mbanking', $data, "WHERE id = '".$_GET['id']."'");

    if ($hasil > 0) {
      //$_SESSION['msg'] = "";
        $succes =<<<EOF
        <script>
        alert('Aplikasi berhasil di aktifkan.');
        window.history.go(-1);
        </script>
EOF;
      echo $succes;
      exit;
    }

  }


  if (isset($_POST['cancel_aktivasi'])) {

        $content = array(                                              
                         "en" => "Aplikasi anda dengan imei: $userId Kami non aktifkan silakan cek di aktivasi."                                                 
                         );

        $fields = array(
            'app_id' => ONESIGNAL_APP_ID,
            'included_segments' => array('All'),   
            'data' => array("foo" => "bar","cat_id"=> "0","cat_name"=>$buyerName, "external_link"=>"marstech.co.id"),
            'headings'=> array("en" => "Hi $buyerName,"),
            'contents' => $content,
            'big_picture' => ""   
                        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                                                   'Authorization: Basic '.ONESIGNAL_REST_KEY));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);    
 
    $data = array(
      'Status'  => 2
    );  

    $hasil = Update('tbl_appaktivasi', $data, "WHERE id = '".$_GET['id']."'");

    if ($hasil > 0) {
        $succes =<<<EOF
        <script>
        alert('Aplikasi berhasil di nonaktifkan.');
        window.history.go(-1);
        </script>
EOF;
      echo $succes;
      exit;
    }

  }

?>

-->

<!--content area start-->
<div id="content" class="pmd-content content-area dashboard">

  <!--tab start-->
  <div class="container-fluid full-width-container">
  
    <h1 class="section-title" id="services"></h1>
      
    <!--breadcrum start-->
    <ol class="breadcrumb text-left">
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="manage-nasabah-baru.php">Data Nasabah Baru</a></li>
      <li class="active">Data Detail</li>
    </ol><!--breadcrum end-->
  
    <div class="section"> 
      
      <div class="pmd-card pmd-z-depth">
        <div class="pmd-card-body">

          <div class="group-fields clearfix row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <div class="lead">DATA DETAIL NASABAH BARU</div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 right">
              <div align="right">
                
                <?php if ($data['status'] == '0' || $data['status'] == '2') { ?> 
                <form id="validationForm" method="post">
                  <input type="submit" name="cancel_aktivasi" class="btn pmd-ripple-effect btn-default" value="CANCEL" onclick="cancelClicked(event)"/>

                  <input type="submit" name="submit_aktivasi" class="btn pmd-ripple-effect btn-danger" value="PROCESS" onclick="processClicked(event)" />
                </form>
                <?php } else if ($data['status'] == '1') { ?> 
                <form id="validationForm" method="post">
                  <input type="submit" name="cancel_aktivasi" class="btn pmd-ripple-effect btn-default" value="CANCEL" onclick="cancelClicked(event)"/>
                </form>
                <?php } else if ($data['status'] == '2') { ?>
                  <input type="submit" name="cancel_aktivasi" class="btn pmd-ripple-effect btn-default" value="CANCELED" disabled/>
                <?php } ?>
              </div>
            </div>
          </div>

          <div class="table-responsive"> 
            <table cellspacing="0" cellpadding="0" class="table pmd-table table-hover" id="table-propeller">
              <tbody>

                <tr>
                  <td>KODE</td>
                  <td>:</td>
                  <td><?php echo $data['Kode']; ?></td>
                </tr>

                <tr>
                  <td width="15%">NAMA</td>
                  <td width="1%">:</td>
                  <td><?php echo $data['Nama']; ?></td>
                </tr>

                <tr>
                  <td width="15%">KELAMIN</td>
                  <td width="1%">:</td>
                  <td><?php echo $data['Kelamin']; ?></td>
                </tr>

                <tr>
                  <td>KTP</td>
                  <td>:</td>
                  <td><?php echo $data['KTP']; ?></td>
                </tr>

                <tr>
                  <td>TANGGAL LAHIR</td>
                  <td>:</td>
                  <td><?php echo $data['TglLahir']; ?></td>
                </tr>

                <tr>
                  <td>AGAMA</td>
                  <td>:</td>
                  <td><?php echo $data['Agama']; ?></td>
                </tr>

                <tr>
                  <td>PEKERJAAN</td>
                  <td>:</td>
                  <td><?php echo $data['Pekerjaan']; ?></td>
                </tr>

                <tr>
                  <td width="15%">ALAMAT</td>
                  <td width="1%">:</td>
                  <td><?php echo $data['Alamat']; ?></td>
                </tr>

                <tr>
                  <td width="15%">KODYA </td>
                  <td width="1%">:</td>
                  <td><?php echo $data['Kodya']; ?></td>
                </tr>

                <tr>
                  <td>KECAMATAN</td>
                  <td>:</td>
                  <td><?php echo $data['Kecamatan']; ?></td>
                </tr>

                <tr>
                  <td>KELURAHAN</td>
                  <td>:</td>
                  <td><?php echo $data['Kelurahan']; ?></td>
                </tr>

                <tr>
                  <td>STATUS PERKAWINAN</td>
                  <td>:</td>
                  <td><?php echo $data['StatusPerkawinan']; ?></td>
                </tr>

                <tr>
                  <td>TELEPOM</td>
                  <td>:</td>
                  <td><?php echo $data['Telepon']; ?></td>
                </tr>

                <tr>
                  <td width="15%">STATUS KEWARGANEGARAAN</td>
                  <td width="1%">:</td>
                  <td><?php echo $data['StatusKewargaNegaraan']; ?></td>
                </tr>

                <tr>
                  <td>PLAFOND</td>
                  <td>:</td>
                  <td><?php echo $data['Plafond']; ?></td>
                </tr>

                <tr>
                  <td width="15%">PENGHASILAN KOTOR </td>
                  <td width="1%">:</td>
                  <td><?php echo $data['PenghasilanKotor']; ?></td>
                </tr>

                <tr>
                  <td>JAMINAN</td>
                  <td>:</td>
                  <td><?php echo $data['Jaminan']; ?></td>
                </tr>

                <tr>
                  <td>POTO</td>
                  <td>:</td>
                  <td><?php echo $data['Poto']; ?></td>
                </tr>

              </tbody>
            </table>

          </div>
        </div>
      </div> <!-- section content end -->
    </div>
      
  </div><!-- tab end -->

</div><!--end content area-->

<script>
  function processClicked(e) {
      if(!confirm("Klik oke untuk melakukan aktivasi aplikasi."))e.preventDefault();
  }
</script>

<script>
  function cancelClicked(e) {
      if(!confirm("Apakah anda akan meng non aktifkan <?php echo $data['Fullname']; ?>"))e.preventDefault();
  }
</script>