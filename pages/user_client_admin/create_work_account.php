<?php
//check for username and role_id
require_once '../db_connection/db.php';
if (isset($_SESSION['username']) && $_SESSION['role_id'] == '2') {
    include '../general/header.php';
    include '../general/navigation_clientadmin.php';
    ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title">
                        Add Client
                    </h3>
                </div>
            </div>
        </div>

        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Add Company Account
                                    </h3>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="createWorkAccount" name="createWorkAccount" action="create_work_account.php" method="POST">
                            <?php include('create_work_validation.php'); ?>

                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <!-- Company Name -->
                                    <label class="col-lg-2 col-form-label" for="companyname">Company Name</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name">
                                        <span class="error"><?php echo $companynameErr; ?></span>
                                    </div>
                                    <!-- UEN/ACRA Number -->
                                    <label class="col-lg-2 col-form-label" for="uennumber">UEN/ACRA Number</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="uennumber" name="uennumber" placeholder="UEN Number">
                                        <span class="error"><?php echo $uennumberErr; ?></span>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <!-- File Number -->
                                    <label class="col-lg-2 col-form-label" for="filenumber">File Number</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="filenumber" name="filenumber" placeholder="File Number">
                                        <span class="error"><?php echo $filenumberErr; ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <button type="submit" name="createWorkButton" id="createWorkButton" class="btn btn-success">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-danger">
                                                Clear
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
	<!-- END: Subheader -->
	</div>


<!--    <div class="row">
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
    </div>-->




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
