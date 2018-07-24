<?php
session_start();
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] == '2') {
    include '../general/header.php';
    require_once '../db_connection/db.php';
    include '../general/navigation_clientadmin.php';
    ?>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
                <form id="createWorkAccount" name="createWorkAccount" action="../user_client_admin/create_work_account.php" method="POST">
                    <?php include'../user_client_admin/create_work_validation.php' ?>

                    <div class="form-group">
                        <label for="companyname">Company Name</label>
                        <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name">
                        <span class="error"><?php echo $companynameErr; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="uennumber">UEN/ACRA Number</label>
                        <input type="text" class="form-control" id="uennumber" name="uennumber" placeholder="UEN Number">
                        <span class="error"><?php echo $uennumberErr; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="filenumber">File Number</label>
                        <input type="text" class="form-control" id="filenumber" name="filenumber" placeholder="File Number">
                        <span class="error"><?php echo $filenumberErr; ?></span>
                    </div>

                    <button type="submit" name="createWorkButton" id="createWorkButton" class="btn btn-primary col-lg-12" ><span class="fa fa-handshake-o fa-fw" aria-hidden="true"></span> Create Account </button>
                    <?php // include('manage_work_account.php'); ?>

                </form>
                <hr>
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
            </div>
        </div>
    </div>




    <?php
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '1') {
    header('Location: ../user_super_admin/userdashboard.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '3') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>