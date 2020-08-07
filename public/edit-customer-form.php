<?php include_once('functions.php'); ?>

<?php
    if (isset($_GET['kode'])) {
        $ID = $_GET['kode'];
    } else {
        $ID = "";
    }
    
    // create array variable to store category data
    $customer_data = array();

    $sql_query = "SELECT images
                    FROM tbl_cs
                    WHERE kode = ?";

    $stmt_customer = $connect->stmt_init();
    if ($stmt_customer->prepare($sql_query)) {
        // Bind your variables to replace the ?s
        $stmt_customer->bind_param('s', $ID);
        // Execute query
        $stmt_customer->execute();
        // store result
        $stmt_customer->store_result();
        $stmt_customer->bind_result($previous_customer_image);
        $stmt_customer->fetch();
        $stmt_customer->close();
    }


    if (isset($_POST['btnEdit'])) {
        $customer_nama      = $_POST['customer_nama'];
        $customer_email     = $_POST['customer_email'];
        $customer_nohp      = $_POST['customer_nohp'];
        $customer_alamat    = $_POST['customer_alamat'];

        // get image info
        $menu_image = $_FILES['customer_image']['name'];
        $image_error = $_FILES['customer_image']['error'];
        $image_type = $_FILES['customer_image']['type'];

        // create array variable to handle error
        $error = array();

        if (empty($customer_nama)) {
            $error['customer_nama'] = " <span class='label label-danger'>Must Insert!</span>";
        }

        // common image file extensions
        $allowedExts = array("gif", "jpeg", "jpg", "png");

        // get image file extension
        error_reporting(E_ERROR | E_PARSE);
        $extension = end(explode(".", $_FILES["customer_image"]["name"]));

        if (!empty($menu_image)) {
            if (!(($image_type == "image/gif") ||
                    ($image_type == "image/jpeg") ||
                    ($image_type == "image/jpg") ||
                    ($image_type == "image/x-png") ||
                    ($image_type == "image/png") ||
                    ($image_type == "image/pjpeg")) &&
                !(in_array($extension, $allowedExts))
            ) {

                $error['customer_image'] = " <span class='label label-danger'>Image type must jpg, jpeg, gif, or png!</span>";
            }
        }

        if (!empty($customer_nama) && empty($error['customer_image'])) {

            if (!empty($menu_image)) {

                // create random image file name
                $string = '0123456789';
                $file = preg_replace("/\s+/", "_", $_FILES['customer_image']['name']);
                $function = new functions;
                $customer_image = $function->get_random_string($string, 4) . "-" . date("Y-m-d") . "." . $extension;

                // delete previous image
                $delete = unlink('upload/category/' . "$previous_customer_image");

                // upload new image
                $upload = move_uploaded_file($_FILES['customer_image']['tmp_name'], 'upload/category/' . $customer_image);

                $sql_query = "UPDATE tbl_cs
                                SET nama = ?, images = ?, email = ?, nohp = ?, alamat = ?
                                WHERE kode = ?";

                $upload_image = $customer_image;  
                $stmt = $connect->stmt_init();
                if ($stmt->prepare($sql_query)) {
                    // Bind your variables to replace the ?s
                    $stmt->bind_param('ssssss',
                        $customer_nama,
                        $upload_image,
                        $customer_email,
                        $customer_nohp,
                        $customer_alamat,
                        $ID);
                    // Execute query
                    $stmt->execute();
                    // store result
                    $update_result = $stmt->store_result();
                    $stmt->close();
                }
            } else {

                $sql_query = "UPDATE tbl_cs
                                SET nama = ?, email = ?, nohp = ?, alamat = ?
                                WHERE kode = ?";

                $stmt = $connect->stmt_init();
                if ($stmt->prepare($sql_query)) {
                    // Bind your variables to replace the ?s
                    $stmt->bind_param('sssss',
                        $customer_nama,
                        $customer_email,
                        $customer_nohp,
                        $customer_alamat,
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
					alert('Update customer berhasil...');
					window.location = 'manage-customer.php';
                    </script>
EOF;
				echo $succes;
            } else {
                $error['update_customer'] = "<br><div class='alert alert-danger'>Update Failed</div>";
            }

        }
    }
    

    // create array variable to store previous data
    $data = array();

    $sql_query = "SELECT Nama,Images,Email,NoHP,Alamat FROM tbl_cs WHERE kode = ?";

    $stmt = $connect->stmt_init();
    if ($stmt->prepare($sql_query)) {
        // Bind your variables to replace the ?s
        $stmt->bind_param('s', $ID);
        // Execute query
        $stmt->execute();
        // store result
        $stmt->store_result();
        $stmt->bind_result(
            $data['Nama'],
            $data['Images'],
            $data['Email'],
            $data['NoHP'],
            $data['Alamat']
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
		  <li class="active">Edit Customer</li>
		</ol>
	
		<div class="section"> 
        	
			<form id="validationForm" method="post" enctype="multipart/form-data">
			<div class="pmd-card pmd-z-depth">
				<div class="pmd-card-body">

					<div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="lead">EDIT CUSTOMER</div>
						</div>
					</div>
                    
					<div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_nama" class="control-label">
                                Nama Customer
								</label>
								<input type="text" name="customer_nama" id="customer_nama" class="form-control" value="<?php echo  $data['Nama']; ?>" required>
							</div>
						</div>
					</div>
					<div class="group-fields clearfix row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group pmd-textfield">
								<!-- <label for="regular1" class="control-label">
									Category Image
								</label> -->
								<input type="file" name="customer_image" id="customer_image" class="dropify-image" data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="upload/category/<?php echo $data['Images']; ?>" data-show-remove="false" />
							</div>
						</div>
					</div>
                    <div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_email" class="control-label">
                                E mail Customer
								</label>
								<input type="text" name="customer_email" id="customer_email" class="form-control" value="<?php echo $data['Email']; ?>" required>
							</div>
						</div>
					</div>
                    <div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_nohp" class="control-label">
                                Telp Customer
								</label>
								<input type="text" name="customer_nohp" id="customer_nohp" class="form-control" value="<?php echo $data['NoHP']; ?>" required>
							</div>
						</div>
					</div>
                    <div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_alamat" class="control-label">
                                Alamat Customer
								</label>
								<input type="text" name="customer_alamat" id="customer_alamat" class="form-control" value="<?php echo $data['Alamat']; ?>" required>
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