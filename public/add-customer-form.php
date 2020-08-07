<?php include_once('functions.php'); ?>

<?php

if (isset($_POST['btnAdd'])) {
    $customer_kode      = $_POST['customer_kode'];
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

    if(empty($customer_kode)){
        $error['customer_kode'] = " <span class='label label-danger'>Must Insert!</span>";
    }
    if(empty($customer_nama)){
        $error['customer_nama'] = " <span class='label label-danger'>Must Insert!</span>";
    }
    if(empty($customer_email)){
        $error['customer_email'] = " <span class='label label-danger'>Must Insert!</span>";
    }
    if(empty($customer_nohp)){
        $error['customer_nohp'] = " <span class='label label-danger'>Must Insert!</span>";
    }
    if(empty($customer_alamat)){
        $error['customer_alamat'] = " <span class='label label-danger'>Must Insert!</span>";
    }

    // common image file extensions
    $allowedExts = array("gif", "jpeg", "jpg", "png");

    // get image file extension
    error_reporting(E_ERROR | E_PARSE);
    $extension = end(explode(".", $_FILES["customer_image"]["name"]));

    if($image_error > 0) {
        $error['customer_image'] = " <span class='font-12 col-red'>You're not insert images!!</span>";
    } else if(!(($image_type == "image/gif") ||
            ($image_type == "image/jpeg") ||
            ($image_type == "image/jpg") ||
            ($image_type == "image/x-png") ||
            ($image_type == "image/png") ||
            ($image_type == "image/pjpeg")) &&
        !(in_array($extension, $allowedExts))) {

        $error['customer_image'] = " <span class='font-12'>Image type must jpg, jpeg, gif, or png!</span>";
    }

    if(!empty($customer_kode) && !empty($customer_nama) && !empty($customer_email) && !empty($customer_nohp) && !empty($customer_alamat) && empty($error['customer_image'])){

        // create random image file name
        $string = '0123456789';
        $file = preg_replace("/\s+/", "_", $_FILES['customer_image']['name']);
        $function = new functions;
        $menu_image = $function->get_random_string($string, 4)."-".date("Y-m-d").".".$extension;

        // upload new image
        $upload = move_uploaded_file($_FILES['customer_image']['tmp_name'], 'upload/category/'.$menu_image);

        // insert new data to menu table
        $sql_query = "INSERT INTO tbl_cs (kode, nama, images, email, nohp, alamat) VALUES(?, ?, ?, ?, ?, ?)";

        $upload_image = $menu_image;
        $stmt = $connect->stmt_init();
        if($stmt->prepare($sql_query)) {
            // Bind your variables to replace the ?s
            $stmt->bind_param('ssssss',
                $customer_kode,
				$customer_nama,
				$upload_image,
                $customer_email,
                $customer_nohp,
                $customer_alamat
            );
            // Execute query
            $stmt->execute();
            // store result
            $result = $stmt->store_result();
            $stmt->close();
        }

        if($result) {
		        $succes =<<<EOF
					<script>
					alert('Data customer berhasil ditambahkan...');
					window.location = 'manage-customer.php';
					</script>
EOF;
				echo $succes;
        } else {
            $error['add_customer'] = "<br><div class='alert alert-danger'>Added Failed</div>";
        }
    }

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
		  <li class="active">Add Customer</li>
		</ol>
		<!--breadcrum end-->
	
		<div class="section"> 

			<form id="validationForm" method="post" enctype="multipart/form-data">
			<div class="pmd-card pmd-z-depth">
				<div class="pmd-card-body">

					<div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="lead">ADD CUSTOMER</div>
						</div>
					</div>

                    <div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_kode" class="control-label">
									Kode Customer *
								</label>
								<input type="text" name="customer_kode" id="customer_kode" class="form-control" placeholder="Kode Customer" required>
							</div>
						</div>
					</div>

					<div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_nama" class="control-label">
									Nama Customer *
								</label>
								<input type="text" name="customer_nama" id="customer_nama" class="form-control" placeholder="Nama Customer" required>
							</div>
						</div>
					</div>
					<div class="group-fields clearfix row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="regular1" class="control-label">Customer Image ( jpg / png) *</label>
								<input type="file" name="customer_image" id="customer_image" class="dropify-image" data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png gif" required />
							</div>
						</div>
					</div>
                    <div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_email" class="control-label">
									Email Customer *
								</label>
								<input type="text" name="customer_email" id="customer_email" class="form-control" placeholder="Email Customer" required>
							</div>
						</div>
					</div>
                    <div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_nohp" class="control-label">
									Telp Customer *
								</label>
								<input type="text" name="customer_nohp" id="customer_nohp" class="form-control" placeholder="Telp Customer" required>
							</div>
						</div>
					</div>
                    <div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="customer_alamat" class="control-label">
									Alamat Customer *
								</label>
								<input type="text" name="customer_alamat" id="customer_alamat" class="form-control" placeholder="Alamat Customer" required>
							</div>
						</div>
					</div>
				</div>
                

				<div class="pmd-card-actions">
					<p align="right">
					<button type="submit" class="btn pmd-ripple-effect btn-danger" name="btnAdd">Submit</button>
					</p>
				</div>
			</div> <!-- section content end -->  
			</form>
		</div>
			
	</div><!-- tab end -->

</div><!--end content area -->