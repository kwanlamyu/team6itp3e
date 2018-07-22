<?php include '../general/header.php';?>
<?php require_once '../db_connection/db.php';?>
<?php include '../general/navigation_clientadmin.php';?>

<div class="row">
        <div class="card">
            <div class="card-body">
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
                <form id="createWorkAccount" name="createWorkAccount" action="../user_client_admin/create_work_account.php" method="POST">
                    <?php include'../user_client_admin/create_work_validation.php'?>

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

    
        
    
<?php include '../general/footer_content.php';?>
<?php include '../general/footer.php';?>