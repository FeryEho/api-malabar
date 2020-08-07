<?php include_once('sql-query.php'); ?>

<?php

    if(isset($_POST['submit'])) {

        $sql_query = "SELECT * FROM tbl_config WHERE id = '1'";
        $result = mysqli_query($connect, $sql_query);
        $row =  mysqli_fetch_assoc($result);

        $data = array(
            'currency_id' => $_POST['currency_id'],
            'tax' => $_POST['tax']
        );

        $update_setting = Update('tbl_config', $data, "WHERE id = '1'");

        if ($update_setting > 0) {
            //$_SESSION['msg'] = "";
                $succes =<<<EOF
                    <script>
                    alert('Settings Updated Successfully...');
                    window.location = 'settings.php';
                    </script>
EOF;
                echo $succes;
            exit;
        }
    } 

    if(isset($_POST['submit_settings'])) {

        $sql_query = "SELECT * FROM tbl_config WHERE id = '1'";
        $result = mysqli_query($connect, $sql_query);
        $row =  mysqli_fetch_assoc($result);

        $data = array(
            'app_fcm_key' => $_POST['app_fcm_key'],
            'onesignal_app_id' => $_POST['onesignal_app_id'],
            'onesignal_rest_api_key' => $_POST['onesignal_rest_api_key'],
            'protocol_type' => $_POST['protocol_type']
        );

        $update_setting = Update('tbl_config', $data, "WHERE id = '1'");

        if ($update_setting > 0) {
            //$_SESSION['msg'] = "";
                $succes =<<<EOF
                    <script>
                    alert('Settings Updated Successfully...');
                    window.location = 'settings.php';
                    </script>
EOF;
                echo $succes;
            exit;
        }
    }


    $sql_query_config = "SELECT * FROM tbl_config where id = '1'";
    $config_result = mysqli_query($connect, $sql_query_config);
    $config_row = mysqli_fetch_assoc($config_result); 

?>

<!--content area start-->
<div id="content" class="pmd-content content-area dashboard">

    <!--tab start-->
    <div class="container-fluid full-width-container">
        <h1></h1>
            
        <!--breadcrum start-->
        <ol class="breadcrumb text-left">
          <li><a href="dashboard.php">Dashboard</a></li>
          <li class="active">Settings</li>
        </ol>
        <!--breadcrum end-->
    
        <div class="section"> 

            <br>
            <form id="validationForm" method="post" enctype="multipart/form-data">
            <div class="pmd-card pmd-z-depth">
                <div class="pmd-card-body">

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="lead">NOTIFICATION</div>
                        </div>
                    </div>

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group pmd-textfield">
                                <label for="app_fcm_key" class="control-label">
                                    FCM Server Key
                                </label>
                                <input type="text" name="app_fcm_key" id="app_fcm_key" class="form-control" value="<?php echo $config_row['app_fcm_key']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group pmd-textfield">
                                <label for="app_fcm_key" class="control-label">
                                    OneSignal APP ID
                                </label>
                                <input type="text" name="onesignal_app_id" id="onesignal_app_id" class="form-control" value="<?php echo $config_row['onesignal_app_id']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group pmd-textfield">
                                <label for="app_fcm_key" class="control-label">
                                    OneSignal Rest API Key
                                </label>
                                <input type="text" name="onesignal_rest_api_key" id="onesignal_rest_api_key" class="form-control" value="<?php echo $config_row['onesignal_rest_api_key']; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="group-fields clearfix row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group pmd-textfield">                    
                                <label>Protocol Type</label>
                                <select class="select-with-search form-control pmd-select2" name="protocol_type" id="protocol_type">
                                    <?php if ($config_row['protocol_type'] == 'http://') { ?>
                                        <option value="http://" selected="selected">HTTP</option>
                                        <option value="https://">HTTPS</option>
                                    <?php } else { ?>
                                        <option value="http://">HTTP</option>
                                        <option value="https://" selected="selected">HTTPS</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>                   

                <div class="pmd-card-actions">
                    <p align="right">
                    <button type="submit" class="btn pmd-ripple-effect btn-danger" name="submit_settings">Update</button>
                    </p>
                </div>                    

                </div>


            </div>
            </form>            


                                <div tabindex="-1" class="modal fade" id="currency-dialog" style="display: none;" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header pmd-modal-bordered">
                                                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                                                <h2 class="pmd-card-title-text">Add Currency</h2>
                                            </div>
                                            <form id="validationForm" method="post">            
                                            <div class="modal-body">
                                                    <div class="form-group pmd-textfield">
                                                        <label class="control-label">Currency Code</label>
                                                        <input type="text" name="currency_code" id="currency_code" class="form-control" placeholder="USD" required>
                                                    </div>

                                                    <div class="form-group pmd-textfield">
                                                        <label class="control-label">Currency Name</label>
                                                        <input type="text" name="currency_name" id="currency_name" class="form-control" placeholder="US Dollar" required>
                                                    </div>
                                            </div>
                                            <div class="pmd-modal-action">
                                                <div align="right">
                                                <button data-dismiss="modal" class="btn pmd-ripple-effect btn-default" type="button">Cancel</button>
                                                <button class="btn pmd-ripple-effect btn-danger" type="submit" name="submit_currency">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>













        </div>
            
    </div>

</div>



