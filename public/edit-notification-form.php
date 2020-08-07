<?php include_once('functions.php'); ?>

    <?php

        if (isset($_GET['Kode'])) {
            $ID = $_GET['Kode'];
        } else {
            $ID = "";
        }

        $category_data = array();

        $sql_query = "SELECT image FROM daftarbank WHERE Kode = ?";

        $stmt_category = $connect->stmt_init();
        if ($stmt_category->prepare($sql_query)) {
            // Bind your variables to replace the ?s
            $stmt_category->bind_param('s', $ID);
            // Execute query
            $stmt_category->execute();
            // store result
            $stmt_category->store_result();
            $stmt_category->bind_result($previous_category_image);
            $stmt_category->fetch();
            $stmt_category->close();
        }       
            
        if (isset($_POST['btnEdit'])) {

            $NamaBank = $_POST['NamaBank'];
            $NoRekening = $_POST['NoRekening'];
            $NamaPemilikRekening = $_POST['NamaPemilikRekening'];

            $menu_image = $_FILES['category_image']['name'];
            $image_error = $_FILES['category_image']['error'];
            $image_type = $_FILES['category_image']['type'];

            // create array variable to handle error
            $error = array();

            if (empty($NamaBank)) {
                $error['NamaBank'] = " <span class='label label-danger'>Must Insert!</span>";
            }
                
            if (empty($NoRekening)) {
                $error['NoRekening'] = " <span class='label label-danger'>Must Insert!</span>";
            }

            // common image file extensions
            $allowedExts = array("gif", "jpeg", "jpg", "png");

            // get image file extension
            error_reporting(E_ERROR | E_PARSE);
            $extension = end(explode(".", $_FILES["category_image"]["name"]));

            if (!empty($menu_image)) {
                if (!(($image_type == "image/gif") ||
                        ($image_type == "image/jpeg") ||
                        ($image_type == "image/jpg") ||
                        ($image_type == "image/x-png") ||
                        ($image_type == "image/png") ||
                        ($image_type == "image/pjpeg")) &&
                    !(in_array($extension, $allowedExts))
                ) {

                    $error['category_image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
                }
            }
                
            if (!empty($NamaBank) && !empty($NoRekening) && empty($error['category_image'])) {

            if (!empty($menu_image)) {

                // create random image file name
                $string = '0123456789';
                $file = preg_replace("/\s+/", "_", $_FILES['category_image']['name']);
                $function = new functions;
                $category_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

                // delete previous image
                $delete = unlink('upload/imagebank/' . "$previous_category_image");

                // upload new image
                $upload = move_uploaded_file($_FILES['category_image']['tmp_name'], 'upload/imagebank/' . $category_image);

                $sql_query = "UPDATE daftarbank SET NamaBank = ?, NoRekening = ?, image = ?, NamaPemilikRekening = ? WHERE Kode = ?";

                $upload_image = $category_image;
                $stmt = $connect->stmt_init();
                if ($stmt->prepare($sql_query)) {
                    // Bind your variables to replace the ?s
                    $stmt->bind_param('sssss', $NamaBank, $NoRekening, $upload_image, $NamaPemilikRekening, $ID);
                    // Execute query
                    $stmt->execute();
                    // store result
                    $update_result = $stmt->store_result();
                    $stmt->close();
                }

            } else {                
                    
                $sql_query = "UPDATE daftarbank SET NamaBank = ?, NoRekening = ?, NamaPemilikRekening = ? WHERE Kode = ?";
                    
                $stmt = $connect->stmt_init();
                if($stmt->prepare($sql_query)) {    
                    // Bind your variables to replace the ?s
                    $stmt->bind_param('ssss', $NamaBank, $NoRekening, $NamaPemilikRekening, $ID);
                    // Execute query
                    $stmt->execute();
                    // store result 
                    $update_result = $stmt->store_result();
                    $stmt->close();
                }
            
            }

                // check update result
                if ($update_result) {
                    //$error['update_notification'] = "<br><div class='alert alert-info'>Push Notification Template Successfully Updated...</div>";
                    $succes =<<<EOF
                    <script>
                    alert('Push Notification Template Successfully Updated...');
                    window.location = 'manage-notification.php';
                    </script>
EOF;

                    echo $succes;
                } else {
                    $error['update_notification'] = "<br><div class='alert alert-danger'>Update Failed</div>";
                }               

            }
                
        }
            
        // create array variable to store previous data
        $data = array();
        
        $sql_query = "SELECT Kode, NamaBank, NoRekening, image, NamaPemilikRekening FROM daftarbank WHERE Kode = ?";
        
        $stmt = $connect->stmt_init();
        if($stmt->prepare($sql_query)) {    
            // Bind your variables to replace the ?s
            $stmt->bind_param('s', $ID);
            // Execute query
            $stmt->execute();
            // store result 
            $stmt->store_result();
            $stmt->bind_result($data['Kode'], 
                    $data['NamaBank'],
                    $data['NoRekening'],
                    $data['image'],
                    $data['NamaPemilikRekening']
                    );
            $stmt->fetch();
            $stmt->close();
        }
        
    ?>

<!--content area start-->
<div id="content" class="pmd-content content-area dashboard">

    <!--tab start-->
    <div class="container-fluid full-width-container">
        <h1></h1>
            
        <!--breadcrum start-->
        <ol class="breadcrumb text-left">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li class="active">Add Notification</li>
        </ol>
        <!--breadcrum end-->
    
        <div class="section"> 

            <form id="validationForm" method="post" enctype="multipart/form-data">
            <div class="pmd-card pmd-z-depth">
                <div class="pmd-card-body">

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="lead">ADD NOTIFICATION</div>
                        </div>
                    </div>

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group pmd-textfield">
                                <label for="NamaBank" class="control-label">
                                    NAMA BANK *
                                </label>
                                <input type="text" name="NamaBank" id="NamaBank" class="form-control" value="<?php echo $data['NamaBank']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group pmd-textfield">
                                <label for="NoRekening" class="control-label">
                                    NO REKENING *
                                </label>
                                <input type="text" name="NoRekening" id="NoRekening" class="form-control" value="<?php echo $data['NoRekening']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="group-fields clearfix row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group pmd-textfield">
                                <label for="regular1" class="control-label">LOGO BANK ( jpg / png) *</label>
                                <input type="file" name="category_image" id="category_image" class="dropify-image" data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="upload/imagebank/<?php echo $data['image']; ?>" data-show-remove="false"/>
                            </div>
                        </div>
                    </div>

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group pmd-textfield">
                                <label for="NamaPemilikRekening" class="control-label">
                                    NAMA PEMILIK REKENING
                                </label>
                                <input type="text" name="NamaPemilikRekening" id="NamaPemilikRekening" class="form-control" placeholder="" value="<?php echo $data['NamaPemilikRekening']; ?>">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pmd-card-actions">
                    <p align="right">
                    <button type="submit" class="btn pmd-ripple-effect btn-danger" name="btnEdit">Submit</button>
                    </p>
                </div>
            </div> <!-- section content end -->  
            </form>
        </div>
            
    </div><!-- tab end -->

</div><!--end content area -->