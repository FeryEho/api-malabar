<?php
    
    include 'functions.php';
    include 'sql-query.php';

    if (isset($_GET['Kode'])) {

        $sql = 'SELECT * FROM daftarbank WHERE Kode=\''.$_GET['Kode'].'\'';
        $img_rss = mysqli_query($connect, $sql);
        $img_rss_row = mysqli_fetch_assoc($img_rss);

        if ($img_rss_row['image'] != "") {
            unlink('upload/imagebank/'.$img_rss_row['image']);
        }

        Delete('daftarbank','Kode='.$_GET['Kode'].'');

        header("location: manage-notification.php");
        exit;

    }

?>

<?php
    $setting_query = "SELECT * FROM tbl_config where Kode = '1'";
    $setting_result = mysqli_query($connect, $setting_query);
    $setting_row = mysqli_fetch_assoc($setting_result);
?>

    <?php 
        // create object of functions class
        $function = new functions;
        
        // create array variable to store data from database
        $data = array();
        
        if(isset($_GET['keyword'])) {   
            // check value of keyword variable
            $keyword = $function->sanitize($_GET['keyword']);
            $bind_keyword = "%".$keyword."%";
        } else {
            $keyword = "";
            $bind_keyword = $keyword;
        }
            
        if (empty($keyword)) {
            $sql_query = "SELECT Kode, NamaBank, NoRekening, image, NamaPemilikRekening FROM daftarbank ORDER BY Kode DESC";
        } else {
            $sql_query = "SELECT Kode, NamaBank, NoRekening, image, NamaPemilikRekening FROM daftarbank WHERE NamaBank LIKE ? ORDER BY Kode DESC";
        }
        
        
        $stmt = $connect->stmt_init();
        if ($stmt->prepare($sql_query)) {   
            // Bind your variables to replace the ?s
            if (!empty($keyword)) {
                $stmt->bind_param('s', $bind_keyword);
            }
            // Execute query
            $stmt->execute();
            // store result 
            $stmt->store_result();
            $stmt->bind_result( 
                    $data['Kode'],
                    $data['NamaBank'],
                    $data['NoRekening'],
                    $data['image'],
                    $data['NamaPemilikRekening']
                    );
            // get total records
            $total_records = $stmt->num_rows;
        }
            
        // check page parameter
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
                        
        // number of data that will be display per page     
        $offset = 10;
                        
        //lets calculate the LIMIT for SQL, and save it $from
        if ($page) {
            $from   = ($page * $offset) - $offset;
        } else {
            //if nothing was given in page request, lets load the first page
            $from = 0;  
        }   
        
        if (empty($keyword)) {
            $sql_query = "SELECT Kode, NamaBank, NoRekening, image, NamaPemilikRekening FROM daftarbank ORDER BY Kode DESC LIMIT ?, ?";
        } else {
            $sql_query = "SELECT Kode, NamaBank, NoRekening, image, NamaPemilikRekening FROM daftarbank WHERE NamaBank LIKE ? ORDER BY Kode DESC LIMIT ?, ?";
        }
        
        $stmt_paging = $connect->stmt_init();
        if ($stmt_paging ->prepare($sql_query)) {
            // Bind your variables to replace the ?s
            if (empty($keyword)) {
                $stmt_paging ->bind_param('ss', $from, $offset);
            } else {
                $stmt_paging ->bind_param('sss', $bind_keyword, $from, $offset);
            }
            // Execute query
            $stmt_paging ->execute();
            // store result 
            $stmt_paging ->store_result();
            $stmt_paging->bind_result(
                $data['Kode'],
                $data['NamaBank'],
                $data['NoRekening'],
                $data['image'],
                $data['NamaPemilikRekening']
            );
            // for paging purpose
            $total_records_paging = $total_records; 
        }

        // if no data on database show "No Reservation is Available"
        if ($total_records_paging == 0) {
    
    ?>

<!--content area start-->
<div id="content" class="pmd-content content-area dashboard">

	<!--tab start-->
	<div class="container-fluid full-width-container">
	
		<h1 class="section-title" id="services"></h1>
			
		<!--breadcrum start-->
		<ol class="breadcrumb text-left">
		  <li><a href="dashboard.php">Dashboard</a></li>
		  <li class="active">Manage Notification</li>
		</ol><!--breadcrum end-->
	
		<div class="section"> 

			<form id="validationForm" method="get">
			<div class="pmd-card pmd-z-depth">
				<div class="pmd-card-body">

					<div class="group-fields clearfix row">
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<div class="lead">MANAGE NOTIFICATION</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
							<div class="form-group pmd-textfield">
								<input type="text" name="keyword" class="form-control" placeholder="Search...">
							</div>
						</div>
					</div>

					<div class="table-responsive"> 
						<table cellspacing="0" cellpadding="0" class="table pmd-table table-hover" id="table-propeller">
							<thead>
								<tr>
									<th>Nama Bank</th>
									<th>Image</th>
									<th>No Rekening</th>
									<th>Nama Pemilik Bank</th>
									<th width="15%">Action</th>
								</tr>
							</thead>

						</table>
						<p align="center">Whoops, No Data Found!</p>

					</div>
				</div>
			</div> <!-- section content end -->  
			<?php $function->doPages($offset, 'manage-notification.php', '', $total_records, $keyword); ?>
			</form>
		</div>
			
	</div><!-- tab end -->

</div><!--end content area-->

<?php } else { $row_number = $from + 1; ?>

<!--content area start-->
<div id="content" class="pmd-content content-area dashboard">

	<!--tab start-->
	<div class="container-fluid full-width-container">
	
		<h1 class="section-title" id="services"></h1>
			
		<!--breadcrum start-->
		<ol class="breadcrumb text-left">
		  <li><a href="dashboard.php">Dashboard</a></li>
		  <li class="active">Manage Notification</li>
		</ol><!--breadcrum end-->
	
		<div class="section"> 

			<form id="validationForm" method="get">
			<div class="pmd-card pmd-z-depth">
				<div class="pmd-card-body">

					<div class="group-fields clearfix row">
						<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
							<div class="lead">MANAGE NOTIFICATION</div>
						</div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
							<div class="form-group pmd-textfield">
								<input type="text" name="keyword" class="form-control" placeholder="Search...">
							</div>
						</div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if(isset($_SESSION['msg'])) { ?>
                                <div role="alert" class="alert alert-warning alert-dismissible">
                                    <?php echo $_SESSION['msg']; ?>
                                </div>
                            <?php unset($_SESSION['msg']); }?>
                        </div>

					</div>

					<div class="table-responsive"> 
						<table cellspacing="0" cellpadding="0" class="table pmd-table table-hover" id="table-propeller">
							<thead>
								<tr>
									<th>Nama Bank</th>
                                    <th>Image</th>
                                    <th>No Rekening</th>
                                    <th>Nama Pemilik Bank</th>
									<th width="15%">Action</th>
								</tr>
							</thead>

							<?php 
								while ($stmt_paging->fetch()) { ?>

							<tbody>
								<tr>
									<td><?php echo $data['NamaBank'];?></td>
									<td><img src="upload/imagebank/<?php echo $data['image']; ?>" width="72px" height="48px"/></td>
									<td><?php echo $data['NoRekening'];?></td>
                                    <td>
                                        <?php
                                            if ($data['NamaPemilikRekening'] == '') {           
                                        ?>
                                            no_url
                                        <?php } else { ?>
                                        <?php
                                            $value = $data['NamaPemilikRekening'];
                                            if (strlen($value) > 50)
                                                $value = substr($value, 0, 47) . '...';
                                                echo $value;
                                        ?>
                                        <?php } ?>
                                    </td>
									<td>
                                        <a href="#">
                                            <i class="material-icons">notifications_active</i>
                                        </a>

									    <a href="edit-notification.php?Kode=<?php echo $data['Kode'];?>">
									        <i class="material-icons">mode_edit</i>
									    </a>
									                        
									    <a href="manage-notification.php?Kode=<?php echo $data['Kode'];?>" onclick="return confirm('Apa Kamu Yakin Ingin Menghapus File Ini?')" >
									       <i class="material-icons">delete</i>
									    </a>
									</td>									
								</tr>
							</tbody>

							<?php } ?>

						</table>

					</div>
				</div>
			</div> <!-- section content end -->  
			<?php $function->doPages($offset, 'manage-notification.php', '', $total_records, $keyword); ?>
			</form>
		</div>
			
	</div><!-- tab end -->

</div><!--end content area-->

<?php } ?>