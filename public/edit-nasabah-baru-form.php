<?php include_once('functions.php'); ?>

<?php
    if (isset($_GET['Id'])) {
        $ID = $_GET['Id'];
    } else {
        $ID = "";
    }
    
    // create array variable to store category data
    $apps_data = array();


    if (isset($_POST['btnEdit'])) {
        $Id                   = $_POST['Id'];
        $Nama                 = $_POST['Nama'];
        $NoTelepon            = $_POST['NoTelepon'];
        $JenisKelamin         = $_POST['JenisKelamin'];
        $TempatLahir          = $_POST['TempatLahir']; 
        $TglLahir             = $_POST['TglLahir'];
        $Agama                = $_POST['Agama'];
        $StatusPerkawinan     = $_POST['StatusPerkawinan'];
        $Pendidikan           = $_POST['Pendidikan'];
        $Penghasilan          = $_POST['Penghasilan'];
        $Kelurahan            = $_POST['Kelurahan'];
        $Alamat               = $_POST['Alamat'];
        $RtRw                 = $_POST['RtRw']; 
        $Kota                 = $_POST['Kota'];
        $Kecamatan            = $_POST['Kecamatan'];
        $Kelurahan            = $_POST['Kelurahan'];
        $KTP                  = $_POST['KTP'];
        $NPWP                 = $_POST['NPWP '];
        $Email                = $_POST['Email'];
        $Pasangan             = $_POST['Pasangan'];
        $IbuKandung           = $_POST['IbuKandung'];
        $AhliWaris            = $_POST['AhliWaris'];
        $TempatLahirAhliWaris = $_POST['TempatLahirAhliWaris'];
        $TglLahirAhliWaris    = $_POST['TglLahirAhliWaris'];
        $HubunganAhliWaris    = $_POST['HubunganAhliWaris'];
        $PhotoKTP             = $_POST['PhotoKTP'];
        $PhotoNasabah         = $_POST['PhotoNasabah']; 
        $TanggalPermohonan    = $_POST['TanggalPermohonan'];

        // create array variable to handle error
        $error = array();

        if (empty($Id)) {
            $error['Id'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($Nama)) {
            $error['Nama'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($JenisKelamin)) {
            $error['JenisKelamin'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        
        if (empty($KTP)) {
            $error['KTP'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        
        if (empty($TglLahir)) {
            $error['TglLahir'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Agama)) {
            $error['Agama'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Pekerjaan)) {
            $error['Pekerjaan'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Alamat)) {
            $error['Alamat'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($Kodya)) {
            $error['Kodya'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        
        if (empty($Kecamatan)) {
            $error['Kecamatan'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Kelurahan)) {
            $error['Kelurahan'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($StatusPerkawinan)) {
            $error['StatusPerkawinan'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Telepon)) {
            $error['Telepon'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($StatusKewarganegaraan)) {
            $error['StatusKewarganegaraan'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        
        if (empty($Plafond)) {
            $error['Plafond'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($PenghasilanKotor)) {
            $error['PenghasilanKotor'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Jaminan)) {
            $error['Jaminan'] = " <span class='label label-danger'>Must Insert!</span>";
        }
        if (empty($Poto)) {
            $error['Poto'] = " <span class='label label-danger'>Must Insert!</span>";
        }


        if (!empty($Nama) && !empty($Id)) {

                $sql_query = "UPDATE datanasabah SET Nama = ?, NoTelepon = ?, JenisKelamin = ?,  TempatLahir = ?, TglLahir = ?, Agama = ?, StatusPerkawinan = ?, Pendidikan = ?, Pekerjaan = ?, Penghasilan = ?, Alamat = ?, RtRw = ?, Kota = ?, Kecamatan = ?, Kelurahan = ?, KTP = ?, NPWP = ?, Email = ?, Pasangan = ?, IbuKandung = ?, AhliWaris = ?, TempatLahirAhliWaris = ?, TglLahirAhliWaris = ?, HubunganAhliWaris = ?, PhotoKTP = ?, PhotoNasabah = ?, TanggalPermohonan = ? WHERE Id = ?";
                
                $stmt = $connect->stmt_init();
                if ($stmt->prepare($sql_query)) {
                    // Bind your variables to replace the ?s
                    $stmt->bind_param('ssssssssssssssssssssssssssss',
                        //$Kode,
                        $Nama,
                        $NoTelepon,
                        $JenisKelamin,
                        $TempatLahir,
                        $TglLahir,
                        $Agama,
                        $StatusPerkawinan,
                        $Pendidikan,
                        $Pekerjaan,
                        $Penghasilan,
                        $Alamat,
                        $RtRw,
                        $Kota,
                        $Kecamatan,
                        $Kelurahan,
                        $KTP,
                        $NPWP,
                        $Email,
                        $Pasangan,
                        $IbuKandung,
                        $AhliWaris,
                        $TempatLahirAhliWaris,
                        $TglLahirAhliWaris,
                        $HubunganAhliWaris,
                        $PhotoKTP,
                        $PhotoNasabah,
                        $TanggalPermohonan,
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
          window.location = 'manage-nasabah-baru.php';
                    </script>
EOF;
        echo $succes;
            } else {
                $error['update_customer'] = "<br><div class='alert alert-danger'>Update Failed</div>";
            }

        }    

    // create array variable to store previous data
    $data = array();

    $sql_query = "SELECT * FROM datanasabah WHERE Id = ?";

    $stmt = $connect->stmt_init();
    if ($stmt->prepare($sql_query)) {
        // Bind your variables to replace the ?s
        $stmt->bind_param('s', $ID);
        // Execute query
        $stmt->execute();
        // store result
        $stmt->store_result();
        $stmt->bind_result(
          $data['Id'],
          $data['Nama'],
          $data['NoTelepon'],
          $data['JenisKelamin'],
          $data['TempatLahir'],
          $data['TglLahir'],
          $data['Agama'],
          $data['StatusPerkawinan'],
          $data['Pendidikan'],
          $data['Pekerjaan'],
          $data['Penghasilan'],
          $data['Alamat'],
          $data['RtRw'],
          $data['Kota'],
          $data['Kecamatan'],
          $data['Kelurahan'],
          $data['KTP'],
          $data['NPWP'],
          $data['Email'],
          $data['Pasangan'],
          $data['IbuKandung'],
          $data['AhliWaris'],
          $data['TempatLahirAhliWaris'],
          $data['TglLahirAhliWaris'],
          $data['HubunganAhliWaris'],
          $data['PhotoKTP'],
          $data['PhotoNasabah'],
          $data['TanggalPermohonan']
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
              <div class="lead">EDIT DATA ANGGOTA</div>
            </div>
          </div>

                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Id" class="control-label">
                                ID
                </label>
                <input disabled type="text" name="Id" id="Id" class="form-control" value="<?php echo  $data['Id']; ?>" required>
              </div>
            </div>
          </div>
                    
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Nama" class="control-label">
                                NAMA
                </label>
                <input type="text" name="Nama" id="Nama" class="form-control" value="<?php echo  $data['Nama']; ?>" required>
              </div>
            </div>
          </div>
                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="NoTelepon" class="control-label">
                                NO TELEPON
                </label>
                <input type="text" name="NoTelepon" id="NoTelepon" class="form-control" value="<?php echo $data['NoTelepon']; ?>" required>
              </div>
            </div>
          </div>
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="JenisKelamin" class="control-label">
                                JENIS KELAMIN
                </label>
                <input type="text" name="JenisKelamin" id="JenisKelamin" class="form-control" value="<?php echo $data['JenisKelamin']; ?>" required>
              </div>
            </div>
          </div>
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="TempatLahir" class="control-label">
                                TEMPAT LAHIR
                </label>
                <input type="text" name="TempatLahir" id="TempatLahir" class="form-control" value="<?php echo $data['TempatLahir']; ?>" required>
              </div>
            </div>
          </div>
                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="TglLahir" class="control-label">
                                TANGGAL LAHIR
                </label>
                <input type="text" name="TglLahir" id="TglLahir" class="form-control" value="<?php echo $data['TglLahir']; ?>" required>
              </div>
            </div>
          </div>
                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Agama" class="control-label">
                                AGAMA
                </label>
                <input type="text" name="Agama" id="Agama" class="form-control" value="<?php echo $data['Agama']; ?>" required>
              </div>
            </div>
          </div>
                    <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="StatusPerkawinan" class="control-label">
                                STATUS PERKAWINAN
                </label>
                <input type="text" name="StatusPerkawinan" id="StatusPerkawinan" class="form-control" value="<?php echo $data['StatusPerkawinan']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Pendidikan" class="control-label">
                                PENDIDIKAN
                </label>
                <input type="text" name="Pendidikan" id="Pendidikan" class="form-control" value="<?php echo $data['Pendidikan']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Pekerjaan" class="control-label">
                                PEKERJAAN
                </label>
                <input type="text" name="Pekerjaan" id="Pekerjaan" class="form-control" value="<?php echo $data['Pekerjaan']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Penghasilan" class="control-label">
                                PENGHASILAN
                </label>
                <input type="text" name="Penghasilan" id="Penghasilan" class="form-control" value="<?php echo $data['Penghasilan']; ?>" required>
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
                <label for="RtRw" class="control-label">
                                RT/RW
                </label>
                <input type="text" name="RtRw" id="RtRw" class="form-control" value="<?php echo $data['RtRw']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Kota" class="control-label">
                                KOTA/KABUPATEN
                </label>
                <input type="text" name="Kota" id="Kota" class="form-control" value="<?php echo $data['Kota']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Kecamatan" class="control-label">
                                KECAMATAN
                </label>
                <input type="text" name="Kecamatan" id="Kecamatan" class="form-control" value="<?php echo $data['Kecamatan']; ?>" required>
              </div>
            </div>
          </div>
       

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Kelurahan" class="control-label">
                                KELURAHAN
                </label>
                <input type="text" name="Kelurahan" id="Kelurahan" class="form-control" value="<?php echo $data['Kelurahan']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="KTP" class="control-label">
                                KTP
                </label>
                <input type="text" name="KTP" id="KTP" class="form-control" value="<?php echo $data['KTP']; ?>" required>
              </div>
            </div>
          </div>
        

        <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="NPWP" class="control-label">
                                NPWP
                </label>
                <input type="text" name="NPWP" id="NPWP" class="form-control" value="<?php echo $data['NPWP']; ?>" required>
              </div>
            </div>
          </div>
          
         <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Email" class="control-label">
                                EMAIL
                </label>
                <input type="text" name="Email" id="Email" class="form-control" value="<?php echo $data['Email']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="Pasangan" class="control-label">
                                PASANGAN
                </label>
                <input type="text" name="Pasangan" id="Pasangan" class="form-control" value="<?php echo $data['Pasangan']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="IbuKandung" class="control-label">
                                IBU KANDUNG
                </label>
                <input type="text" name="IbuKandung" id="IbuKandung" class="form-control" value="<?php echo $data['IbuKandung']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="AhliWaris" class="control-label">
                                AHLI WARIS
                </label>
                <input type="text" name="AhliWaris" id="AhliWaris" class="form-control" value="<?php echo $data['AhliWaris']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="TempatLahirAhliWaris" class="control-label">
                                TEMPAT LAHIR AHLI WARIS
                </label>
                <input type="text" name="TempatLahirAhliWaris" id="TempatLahirAhliWaris" class="form-control" value="<?php echo $data['TempatLahirAhliWaris']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="TglLahirAhliWaris" class="control-label">
                                TANGGAL LAHIR AHLI WARIS
                </label>
                <input type="text" name="TglLahirAhliWaris" id="TglLahirAhliWaris" class="form-control" value="<?php echo $data['TglLahirAhliWaris']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="HubunganAhliWaris" class="control-label">
                                HUBUNGAN AHLIWARIS
                </label>
                <input type="text" name="HubunganAhliWaris" id="HubunganAhliWaris" class="form-control" value="<?php echo $data['HubunganAhliWaris']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="PhotoKTP" class="control-label">
                                PHOTO KTP
                </label>
                <input disabled type="text" name="PhotoKTP" id="PhotoKTP" class="form-control" value="<?php echo $data['PhotoKTP']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="PhotoNasabah" class="control-label">
                                PHOTO NASABAH
                </label>
                <input disabled type="text" name="PhotoNasabah" id="PhotoNasabah" class="form-control" value="<?php echo $data['PhotoNasabah']; ?>" required>
              </div>
            </div>
          </div>
          
          <div class="group-fields clearfix row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form-group pmd-textfield">
                <label for="TanggalPermohonan" class="control-label">
                                TANGGAL PERMOHONAN
                </label>
                <input type="text" name="TanggalPermohonan" id="TanggalPermohonan" class="form-control" value="<?php echo $data['TanggalPermohonan']; ?>" required>
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