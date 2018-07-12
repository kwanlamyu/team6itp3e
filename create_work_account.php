<?php include 'header.php'; ?>
<body>
    <div>
        <h1>
            Create Work Account
        </h1>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form id="createWorkAccount" name="createWorkAccount" action="create_work_validation.php" method="POST">
                    

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
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>