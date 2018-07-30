<?php 
/* 
 * front end code for creating of work accounts aka clients of the client admin company
 */
?>

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
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="createWorkAccount" name="createWorkAccount" action="create_work_account.php" method="POST">
                            <?php include('create_work_validation.php'); ?>
                            <?php if (!empty($successMessage)) { ?>
                                <div class="alert alert-success" role="alert"><?php echo $successMessage; ?></div>
                            <?php } ?>

                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <!-- Company Name -->
                                    <label class="col-lg-2 col-form-label" for="companyname">Company Name</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="companyname" name="companyname" placeholder="Company Name">
                                        <span class="error" style="color: red;"><?php echo $companynameErr; ?></span>
                                    </div>
                                    <!-- UEN/ACRA Number -->
                                    <label class="col-lg-2 col-form-label" for="uennumber">UEN/ACRA Number</label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="uennumber" name="uennumber" placeholder="UEN Number">
                                        <span class="error" style="color: red;"><?php echo $uennumberErr; ?></span>
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







    <?php
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '1') {
    header('Location: ../user_super_admin/super_admin_dashboard.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '3') {
    header('Location: ../user_accountant/accountant_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>
