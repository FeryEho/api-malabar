<?php

    include_once('includes/config.php');
    // start session
    //session_start();  

    // if user click Login button
    if(isset($_POST['btnLogin'])) {

        // get username and password
        $username = $_POST['username'];
        $password = $_POST['password'];

        // set time for session timeout
        $currentTime = time() + 25200;
        $expired = 3600;

        // create array variable to handle error
        $error = array();

        // check whether $username is empty or not
        if(empty($username)) {
            $error['username'] = "*Username should be filled.";
        }

        // check whether $password is empty or not
        if(empty($password)) {
            $error['password'] = "*Password should be filled.";
        }

        // if username and password is not empty, check in database
        if(!empty($username) && !empty($password)) {

            // change username to lowercase
            $username = strtolower($username);

            //encript password to sha256
            $password = hash('sha256',$username.$password);

            // get data from user table
            $sql_query = "SELECT * FROM tbl_admin WHERE username = ? AND password = ?";

            $stmt = $connect->stmt_init();
            if($stmt->prepare($sql_query)) {
                // Bind your variables to replace the ?s
                $stmt->bind_param('ss', $username, $password);
                // Execute query
                $stmt->execute();
                /* store result */
                $stmt->store_result();
                $num = $stmt->num_rows;
                // Close statement object
                $stmt->close();
                if($num == 1) {
                    $_SESSION['user'] = $username;
                    $_SESSION['timeout'] = $currentTime + $expired;
                    header("location: dashboard.php");
                } else {
                    $error['failed'] = "<center><div class='alert alert-warning'>Invalid Username or Password!</div></center>";
                }
            }

        }
    }
?>

<div class="logincard2">
    <div class="pmd-card card-default pmd-z-depth dashboard">
        <div class="login-card">
            <form method="POST">  
                <div class="pmd-card-title card-header-border text-center">
                    <div class="loginlogo">
                        <img src="assets/images/logomalabar.jpg" alt="Logo">
                    </div>
                    <div class="lead">MTech. Collector</div>
                </div>
                
                <div class="pmd-card-body">
                    <?php echo isset($error['failed']) ? $error['failed'] : '';?>
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label for="inputError1" class="control-label pmd-input-group-label">Username</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">perm_identity</i></div>
                            <input type="text" name="username" class="form-control" id="exampleInputAmount" required>
                        </div>
                    </div>
                    
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label for="inputError1" class="control-label pmd-input-group-label">Password</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="material-icons md-dark pmd-sm">lock_outline</i></div>
                            <input type="password" name="password" class="form-control" id="exampleInputAmount" required>
                        </div>
                    </div>
                </div>
                <div class="pmd-card-footer card-footer-no-border card-footer-p16 text-center">
                    <div class="form-group clearfix">
                    </div>
                    <button type="submit" name="btnLogin" class="btn pmd-ripple-effect btn-danger btn-block">Login</button>
                    <br>
                    <br>
                    <span class="pmd-card-subtitle-text">PT. Marstech Global &copy; <span class="auto-update-year"></span>. All Rights Reserved.</span>
            <h3 class="pmd-card-subtitle-text"><a href="http://marstech.co.id" target="_blank">Version 0.0.1</a></h3>
                    
                </div>
                
            </form>
        </div>
        
    </div>
</div>