<?php include_once('functions.php'); ?>

<?php
    if (isset($_GET['No'])) {
        $ID = $_GET['No'];
    } else {
        $ID = "";
    }
    
    // create array variable to store category data
    $apps_data = array();


    if (isset($_POST['btnEdit'])) {
        $No                   = $_POST['No'];
        $KodePengajuan                   = $_POST['KodePengajuan'];
        $Nama                = $_POST['Nama'];
        $Alamat                    = $_POST['Alamat']; 
        $Tgl_Pengajuan               = $_POST['Tgl_Pengajuan'];
        $SifatKredit                  = $_POST['SifatKredit'];
        $JenisPenggunaan              = $_POST['JenisPenggunaan'];
        $GolonganDebitur                 = $_POST['GolonganDebitur'];
        $SektorEkonomi                  = $_POST['SektorEkonomi'];
        $Instansi              = $_POST['Instansi'];
        $Wilayah              = $_POST['Wilayah'];
        $AO       = $_POST['AO']; 
        $GolonganPenjamin                = $_POST['GolonganPenjamin'];
        $Plafond  = $_POST['Plafond'];
        $JangkaWaktu                = $_POST['JangkaWaktu'];
        $Jaminan                = $_POST['Jaminan'];

        // create array variable to handle error
        $error = array();

        if (empty($No)) {
            $error['No'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($KodePengajuan)) {
            $error['KodePengajuan'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($Nama)) {
            $error['Nama'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        
        if (empty($Alamat)) {
            $error['Alamat'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        
        if (empty($Tgl_Pengajuan)) {
            $error['Tgl_Pengajuan'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($SifatKredit)) {
            $error['SifatKredit'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($JenisPenggunaan)) {
            $error['JenisPenggunaan'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($GolonganDebitur)) {
            $error['GolonganDebitur'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($SektorEkonomi)) {
            $error['SektorEkonomi'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        
        if (empty($Instansi)) {
            $error['Instansi'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Wilayah)) {
            $error['Wilayah'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($AO)) {
            $error['AO'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($GolonganPenjamin)) {
            $error['GolonganPenjamin'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Plafond)) {
            $error['Plafond'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($JangkaWaktu)) {
            $error['JangkaWaktu'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Jaminan)) {
            $error['Jaminan'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (!empty($KodePengajuan) && !empty($No)) {

                $sql_query = "UPDATE tbl_pengajuankredit SET KodePengajuan = ?, Nama = ?,  Alamat = ?, Tgl_Pengajuan = ?, SifatKredit = ?, JenisPenggunaan = ?, GolonganDebitur = ?, SektorEkonomi = ?, Instansi = ?, Wilayah = ?, AO = ?, GolonganPenjamin = ?, Plafond = ?, JangkaWaktu = ?, Jaminan = ? WHERE No = ?";

                $stmt = $connect->stmt_init();
                if ($stmt->prepare($sql_query)) {
                    // Bind your variables to replace the ?s
                    $stmt->bind_param('ssssssssssssssss',
                        //$Kode,
                        $KodePengajuan,
                        $Nama,
                        $Alamat,
                        $Tgl_Pengajuan,
                        $SifatKredit,
                        $JenisPenggunaan,
                        $GolonganDebitur,
                        $SektorEkonomi,
                        $Instansi,
                        $Wilayah,
                        $AO,
                        $GolonganPenjamin,
                        $Plafond,
                        $JangkaWaktu,
                        $Jaminan,
                        $ID);
                    // Execute query
                    $stmt->execute();
                    // store result
                    $update_result = $stmt->store_result();
                    $stmt->close();
                }
            }

            // check update result
            if ($update_result) {
                $succes =<<<EOF
          <script>
          alert('Update data berhasil...');
          window.location = 'manage-pengajuan-kredit.php';
                    </script>
EOF;
        echo $succes;
            } else {
                $error['update_customer'] = "<br><div class='alert alert-danger'>Update Failed</div>";
            }

        }    

    // create array variable to store previous data
    $data = array();

    $sql_query = "SELECT * FROM tbl_pengajuankredit WHERE No = ?";

    $stmt = $connect->stmt_init();
    if ($stmt->prepare($sql_query)) {
        // Bind your variables to replace the ?s
        $stmt->bind_param('s', $ID);
        // Execute query
        $stmt->execute();
        // store result
        $stmt->store_result();
        $stmt->bind_result(
          $data['No'],
          $data['KodePengajuan'],
          $data['Nama'],
          $data['Alamat'],
          $data['Tgl_Pengajuan'],
          $data['SifatKredit'],
          $data['JenisPenggunaan'],
          $data['GolonganDebitur'],
          $data['SektorEkonomi'],
          $data['Instansi'],
          $data['Wilayah'],
          $data['AO'],
          $data['GolonganPenjamin'],
          $data['Plafond'],
          $data['JangkaWaktu'],
          $data['Jaminan']
        );
        $stmt->fetch();
        $stmt->close();
    } 

?>

<div id="content" class="pmd-content content-area dashboard">
  <div class="container-fluid full-width-container">
    <h1></h1>
     
    <ol class="breadcrumb text-left">
      <li><a href="dashboard.php">Dashboard</a></li>
      <li class="active">Edit Aplikasi</li>
    </ol>
  
    <div class="section"> 
          
      <form id="validationForm" method="post" enctype="multipart/form-data">
      <div class="pmd-card pmd-z-depth">
        <div class="pmd-card-body">

          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="lead">EDIT DATA NASABAH BARU</div>
            </div>
          </div>

                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="No" class="control-label">
                                NO
                </label>
                <input type="text" name="No" id="No" class="form-control" value="<?php echo  $data['No']; ?>" required>
              </div>
            </div>
          </div>
                    
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="KodePengajuan" class="control-label">
                                KODE PENGAJUAN
                </label>
                <input type="text" name="KodePengajuan" id="KodePengajuan" class="form-control" value="<?php echo  $data['KodePengajuan']; ?>" required>
              </div>
            </div>
          </div>
                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Nama" class="control-label">
                                NAMA
                </label>
                <input type="text" name="Nama" id="Nama" class="form-control" value="<?php echo $data['Nama']; ?>" required>
              </div>
            </div>
          </div>
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Alamat" class="control-label">
                                ALAMAT
                </label>
                <input type="text" name="Alamat" id="Alamat" class="form-control" value="<?php echo $data['Alamat']; ?>" required>
              </div>
            </div>
          </div>
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Tgl_Pengajuan" class="control-label">
                                TANGGAL PENGAJUAN
                </label>
                <input type="text" name="Tgl_Pengajuan" id="Tgl_Pengajuan" class="form-control" value="<?php echo $data['Tgl_Pengajuan']; ?>" required>
              </div>
            </div>
          </div>
                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="SifatKredit" class="control-label">
                                SIFAT KREDIT
                </label>
                <input type="text" name="SifatKredit" id="SifatKredit" class="form-control" value="<?php echo $data['SifatKredit']; ?>" required>
              </div>
            </div>
          </div>
                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="JenisPenggunaan" class="control-label">
                                JENIS PENGGUNAAN
                </label>
                <input type="text" name="JenisPenggunaan" id="JenisPenggunaan" class="form-control" value="<?php echo $data['JenisPenggunaan']; ?>" required>
              </div>
            </div>
          </div>
                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="GolonganDebitur" class="control-label">
                                GOLONGAN DEBITUR
                </label>
                <input type="text" name="GolonganDebitur" id="GolonganDebitur" class="form-control" value="<?php echo $data['GolonganDebitur']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="SektorEkonomi" class="control-label">
                                SEKTOR EKONOMI
                </label>
                <input type="text" name="SektorEkonomi" id="SektorEkonomi" class="form-control" value="<?php echo $data['SektorEkonomi']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Instansi" class="control-label">
                                INSTANSI
                </label>
                <input type="text" name="Instansi" id="Instansi" class="form-control" value="<?php echo $data['Instansi']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Wilayah" class="control-label">
                                WILAYAH
                </label>
                <input type="text" name="Wilayah" id="Wilayah" class="form-control" value="<?php echo $data['Wilayah']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="AO" class="control-label">
                                AO
                </label>
                <input type="text" name="AO" id="AO" class="form-control" value="<?php echo $data['AO']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="GolonganPenjamin" class="control-label">
                                GOLONGAN PENJAMIN
                </label>
                <input type="text" name="GolonganPenjamin" id="GolonganPenjamin" class="form-control" value="<?php echo $data['GolonganPenjamin']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Plafond" class="control-label">
                                PLAFOND
                </label>
                <input type="text" name="Plafond" id="Plafond" class="form-control" value="<?php echo $data['Plafond']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="JangkaWaktu" class="control-label">
                                JANGKA WAKTU
                </label>
                <input type="text" name="JangkaWaktu" id="JangkaWaktu" class="form-control" value="<?php echo $data['JangkaWaktu']; ?>" required>
              </div>
            </div>
          </div>
       

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Jaminan" class="control-label">
                                JAMINAN
                </label>
                <input type="text" name="Jaminan" id="Jaminan" class="form-control" value="<?php echo $data['Jaminan']; ?>" required>
              </div>
            </div>
          </div>
        </div>
        
                <?php $ID; ?>
        <div class="pmd-card-actions">
          <p align="right">
          <button type="submit" class="btn pmd-ripple-effect btn-danger" name="btnEdit">Update</button>
          </p>
        </div>
      </div>
      </form>
    </div>
      
  </div>

</div>