<?php include 'functions.php'; ?>

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
      $sql_query = "SELECT NoTelepon, Nama, Password from register WHERE NoTelepon ORDER BY Nama DESC";
    } else {
      $sql_query = "SELECT NoTelepon, Nama, Password from register WHERE Nama LIKE ? ORDER BY Nama DESC";
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
          $data['NoTelepon'],
          //$data['Poto'],
          $data['Nama'],
          //$data['Telepon'],
          //$data['Plafond'],
         // $data['Jaminan'],
          $data['Password']
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
      $sql_query = "SELECT NoTelepon, Nama, Password from register WHERE NoTelepon ORDER BY Nama DESC LIMIT ?, ?";
    } else {
      $sql_query = "SELECT NoTelepon, Nama, Password from register WHERE Nama LIKE ? ORDER BY Nama DESC LIMIT ?, ?";
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
        $data['NoTelepon'],
          //$data['Poto'],
          $data['Nama'],
          //$data['Telepon'],
          //$data['Plafond'],
          //$data['Jaminan'],
          $data['Password']
          
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
      <li class="active">Manage Help</li>
    </ol><!--breadcrum end-->
  
    <div class="section"> 

      <form id="validationForm" method="get">
      <div class="pmd-card pmd-z-depth">
        <div class="pmd-card-body">

          <div class="group-fields clearfix row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <div class="lead">MANAGE HELP</div>
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
                  <th>Title</th>
                  <th width="15%">ACTION</th>
                </tr>
              </thead>

            </table>
            <p align="center">Maaf, Data Tidak Ditemukan!</p>

          </div>
        </div>
      </div> <!-- section content end -->  
      <?php $function->doPages($offset, 'manage-nasabah-sudah-survey.php', '', $total_records, $keyword); ?>
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
      <li class="active">Data Nasabah Sudah Survey</li>
    </ol><!--breadcrum end-->
  
    <div class="section"> 

      <form id="validationForm" method="get">
      <div class="pmd-card pmd-z-depth">
        <div class="pmd-card-body">

          <div class="group-fields clearfix row">
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
              <div class="lead">DATA NASABAH SUDAH SURVEY</div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right">
              <div class="form-group pmd-textfield">
                <input type="text" name="keyword" class="form-control" placeholder="Search Nama...">
              </div>
            </div>
          </div>

          <div class="table-responsive"> 
            <table cellspacing="0" cellpadding="0" class="table pmd-table table-hover" id="table-propeller">
              <thead>
                <tr>
                  <th>NO TELEPON</th>
                  
                  <th>NAMA</th>
                 
                  <th>PASSWORD</th>
                
                  <th width="15%">ACTION</th>
                </tr>
              </thead>

              <?php 
                while ($stmt_paging->fetch()) { ?>

              <tbody>
                <tr>
                  <td><?php echo $data['NoTelepon'];?></td>
                  
                  <td><?php echo $data['Nama'];?></td>
                 
                  <td><?php echo $data['Password'];?></td>
                  
                   <td>
                    <!--
                      <a href="nasabah-sudah-survey-detail.php?NoTelepon=<?php echo $data['NoTelepon'];?>">
                          <i class="material-icons">open_in_new</i>
                      </a>
                    -->
                      <a href="edit-nasabah-sudah-survey.php?NoTelepon=<?php echo $data['NoTelepon'];?>">
                          <i class="material-icons">mode_edit</i>
                      </a>
                                          
                      <a href="delete-nasabah-sudah-survey.php?NoTelepon=<?php echo $data['NoTelepon'];?>" onclick="return confirm('Apa anda yakin akan menghapus data ini?')" >
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
      <?php $function->doPages($offset, 'manage-aktivasi.php', '', $total_records, $keyword); ?>
      </form>
    </div>
      
  </div><!-- tab end -->

</div><!--end content area-->

<?php } ?>