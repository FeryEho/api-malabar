<?php

    include('public/sql-query.php');

	if (isset($_GET['id'])) {
 		$qry 	= "SELECT * FROM tbl_jenisaplikasi WHERE ID ='".$_GET['id']."'";
		$result = mysqli_query($connect, $qry);
		$row 	= mysqli_fetch_assoc($result);
 	}

	if(isset($_POST['submit'])) {

		if ($_FILES['product_image']['name'] != '') {
			unlink('upload/product/'.$_POST['old_image']);
			$product_image = time().'_'.$_FILES['product_image']['name'];
			$pic2 = $_FILES['product_image']['tmp_name'];
   			$tpath2 = 'upload/product/'.$product_image;
			copy($pic2, $tpath2);
		} else {
			$product_image = $_POST['old_image'];
		}
 
		$data = array(											 

			'Nama'  				=> $_POST['product_nama'],
			'Images' 				=> $product_image,
            'Keterangan'			=> $_POST['product_keterangan']

		);	

			$hasil = Update('tbl_jenisaplikasi', $data, "WHERE ID = '".$_POST['ID']."'");

			if ($hasil > 0) {
			//$_SESSION['msg'] = "";
		        $succes =<<<EOF
					<script>
					alert('Jenis Aplikasi Berhasil dirubah...');
					window.location = 'manage-product.php';
					</script>
EOF;
				echo $succes;
			exit;
			}

	}

 	$sql_query = "SELECT * FROM tbl_jenisaplikasi ORDER BY Nama ASC";
	$ringtone_qry_cat = mysqli_query($connect, $sql_query); 

?>

<!--content area start-->
<div id="content" class="pmd-content content-area dashboard">

	<!--tab start-->
	<div class="container-fluid full-width-container">
		<h1></h1>
			
		<!--breadcrum start-->
		<ol class="breadcrumb text-left">
		  <li><a href="dashboard.php">Dashboard</a></li>
		  <li class="active">Edit Aplikasi</li>
		</ol>
		<!--breadcrum end-->
	
		<div class="section"> 

			<form id="validationForm" method="post" enctype="multipart/form-data">
			<div class="pmd-card pmd-z-depth">
				<div class="pmd-card-body">

					<div class="group-fields clearfix row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="lead">EDIT APLIKASI</div>
						</div>
					</div>

					<div class="group-fields clearfix row">

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="product_nama" class="control-label">Nama Aplikasi *</label>
								<input type="text" name="product_nama" id="product_nama" class="form-control" placeholder="Nama Aplikasi" value="<?php echo $row['Nama'];?>" required>
							</div>
						</div>

						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="form-group pmd-textfield">
								<label for="regular1" class="control-label">Icon Aplikasi ( jpg / png ) *</label>
								<input type="file" name="product_image" id="product_image" class="dropify-image" data-max-file-size="1M" data-allowed-file-extensions="jpg jpeg png gif" data-default-file="upload/product/<?php echo $row['Images'];?>" data-show-remove="false" />
							</div>
						</div>						

						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div class="form-group pmd-textfield">
								<label class="control-label">Keterangan Aplikasi *</label>
  								<textarea required class="form-control" name="product_keterangan"><?php echo $row['Keterangan'];?></textarea>
  								<script>                             
									CKEDITOR.replace( 'product_keterangan' );
								</script>	
							</div>
						</div>

						<input type="hidden" name="old_image" value="<?php echo $row['product_image'];?>">
						<input type="hidden" name="product_id" value="<?php echo $row['product_id'];?>">

						<div class="pmd-card-actions col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<p align="right">
							<button type="submit" class="btn pmd-ripple-effect btn-danger" name="submit">UPDATE</button>
							</p>
						</div>						

						</div>

				</div>

			</div> <!-- section content end -->  
			</form>
		</div>
			
	</div><!-- tab end -->

</div><!--end content area