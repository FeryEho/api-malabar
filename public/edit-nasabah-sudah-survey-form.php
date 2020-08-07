<?php include_once('functions.php'); ?>

<?php
    if (isset($_GET['NoTelepon'])) {
        $ID = $_GET['NoTelepon'];
    } else {
        $ID = "";
    }
    
    // create array variable to store category data
    $apps_data = array();


    if (isset($_POST['btnEdit'])) {
        $NoTelepon                   = $_POST['NoTelepon'];
        $Nama                        = $_POST['Nama]'];
        $Password                    = $_POST['Password']; 
      

        // create array variable to handle error
        $error = array();

        if (empty($NoTelepon)) {
            $error['NoTelepon'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($Nama)) {
            $error['Nama'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (empty($Password)) {
            $error['Password'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        if (!empty($Nama) && !empty($NoTelepon)) {

                $sql_query = "UPDATE register SET Nama = ?, Password = ? WHERE NoTelepon = ?";

                $stmt = $connect->stmt_init();
                if ($stmt->prepare($sql_query)) {
                    // Bind your variables to replace the ?s
                    $stmt->bind_param('sss',
                        //$Kode,
                        $Nama,
                        $Password,
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
          window.location = 'manage-nasabah-sudah-survey.php';
                    </script>
EOF;
        echo $succes;
            } else {
                $error['update_customer'] = "<br><div class='alert alert-danger'>Update Failed</div>";
            }

        }    

    // create array variable to store previous data
    $data = array();

    $sql_query = "SELECT * FROM register WHERE NoTelepon = ?";

    $stmt = $connect->stmt_init();
    if ($stmt->prepare($sql_query)) {
        // Bind your variables to replace the ?s
        $stmt->bind_param('s', $ID);
        // Execute query
        $stmt->execute();
        // store result
        $stmt->store_result();
        $stmt->bind_result(
          $data['NoTelepon'],
          $data['Nama'],
          $data['Password']
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
                <label for="NoTelepon" class="control-label">
                                NO TELEPON
                </label>
                <input type="text" name="NoTelepon" id="NoTelepon" class="form-control" value="<?php echo  $data['NoTelepon']; ?>" required>
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
                <label for="Password" class="control-label">
                                PASSWORD
                </label>
                <input type="text" name="Password" id="Password" class="form-control" value="<?php echo $data['Password']; ?>" required>
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