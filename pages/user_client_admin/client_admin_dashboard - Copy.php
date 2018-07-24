<?php
require_once '../db_connection/db.php';
//check for username and role_id
if (isset($_SESSION['username']) && ($_SESSION['role_id'] == '2' || $_SESSION['role_id'] == '3')) {
    include '../general/header.php';    
    if ($_SESSION['role_id'] == '2') {
        include '../general/navigation_clientadmin.php';
    } elseif ($_SESSION['role_id'] == '3') {
        include '../general/navigation_accountant.php';
    }
    ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Financial Statement
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Generate Report
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Financial Statement
                                </span>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>


        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">

                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5>User Management</h5><hr>
                                <button id="createAccountant" type="button" onClick="location.href = 'create_accountant.php';" name="createAccountant"  class="btn btn-success"><i class="fas fa-user-plus"></i> Create User </button>
                                <button id="editAccountant" type="button" onClick="location.href = 'edit_accountant.php';" name="editAccountant"  class="btn btn-warning"><i class="fas fa-user-edit"></i> Edit User Details </button>
                                <button id="deleteAccountant" type="button" onClick="location.href = 'delete_accountant.php';" name="deleteAccountant"  class="btn btn-danger"><i class="fas fa-user-minus"></i> Delete User </button>

                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <h5>Account Management</h5><hr>
                                <button id="createWorkAccount" type="button" onClick="location.href = 'create_work_account.php';" name="createWorkAccount"  class="btn btn-success"><i class="fas fa-plus"></i> Add Account </button>
                                <button id="editWorkAccount" type="button" onClick="location.href = 'edit_work_account.php';" name="editWorkAccount"  class="btn btn-warning"><i class="fas fa-edit"></i> Edit Account </button>
                                <button id="deleteWorkAccount" type="button" onClick="location.href = 'delete_work_account.php';" name="deleteWorkAccount"  class="btn btn-danger"><i class="fas fa-minus"></i> Delete Account </button>

                            </div>
                        </div>
                    </div>



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
    header('Location: ../user_super_admin/userdashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>