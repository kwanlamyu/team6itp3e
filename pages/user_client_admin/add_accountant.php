<?php
require_once '../db_connection/db.php';
//check for username and role_id
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
                        Add Accountant
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
                                        Add Accountant Account
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="createAccountant" name="createAccountant" action="add_accountant.php" method="POST">

                            <?php include('create_accountant_validation.php'); ?>

                            <?php if (!empty($successMessage)) { ?>
                                <span class="alert alert-success" ><?php echo $successMessage; ?></span>
                            <?php } ?>

                            <?php if (!empty($failMessage)) { ?>
                                <span class="alert alert-danger" ><?php echo $failMessage; ?></span>
                            <?php } ?>


                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Accountant Name:
                                    </label>
                                    <div class="col-lg-3">
                                        <input type="text" class="form-control" id="accountantid" name="accountantid" placeholder="Enter a username" <?php
                                        if (!empty($_POST['accountantid'])) {
                                            echo "value=\"" . $_POST["accountantid"] . "\"";
                                        }
                                        ?>>
                                        <span class="error"><?php echo $unameErr; ?></span>






                                    </div>
                                    <label class="col-lg-2 col-form-label">
                                        Email:
                                    </label>
                                    <div class="col-lg-3">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter Accountant's email" <?php
                                        if (!empty($_POST['email'])) {
                                            echo "value=\"" . $_POST["email"] . "\"";
                                        }
                                        ?>>
                                        <span class="error"><?php echo $emailErr; ?></span>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <label class="col-lg-2 col-form-label">
                                        Password:
                                    </label>
                                    <div class="col-lg-3">
                                        <input type="password" class="form-control" id="accountantpassword" name="accountantpassword" placeholder="Password">
                                        <span class="error"><?php echo $passErr; ?></span>
                                        <span class="error"><?php echo $twopassErr; ?></span>

                                    </div>
                                    <label class="col-lg-2 col-form-label">
                                        Confirm Password:
                                    </label>
                                    <div class="col-lg-3">
                                        <input type="password" class="form-control" id="accountantcpassword" name="accountantcpassword" placeholder="Confirm Password">
                                        <span class="error"><?php echo $cpassErr; ?></span>
                                        <span class="error"><?php echo $twopassErr; ?></span>
                                    </div>
                                </div>



                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <button type="submit" name="createButton" id="createButton" class="btn btn-success">
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