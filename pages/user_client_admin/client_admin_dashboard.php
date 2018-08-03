<?php 
/* 
 * front end code for client admin dashboard to display accountants the client admin
 */
?>
<?php
require_once '../db_connection/db.php';
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] == '2') {
    include '../general/header.php';
    //client admin navigation
    include '../general/navigation_clientadmin.php';

    ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title">
                        Client Admin Dashboard
                    </h3>


                </div>
            </div>
        </div>


        <div class="m-content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="m-portlet m-portlet--mobile ">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Accountant Accounts
                                    </h3>
                                </div>
                            </div>
                            <div class="m-portlet__head-tools">

                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin: Search Form -->
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="form-group m-form__group row align-items-center">
                                            <div class="col-md-4">
                                                <div class="m-input-icon m-input-icon--left">
                                                    <input type="text" class="form-control m-input" placeholder="Search..." name="generalSearch" id="generalSearch" form="csvForm">
                                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                                                        <span>
                                                            <i class="la la-search"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
									<form method="post" action="../user_client_admin/client_admin_dashboard_export.php" id="csvForm">
											<input type="submit" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" name="export" value="Export Table"/>
							
											
											<!-- <i class="la la-file-excel-o"></i> -->
											
										</form> 
                                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Search Form -->
                            
                            <!--begin: Datatable -->
                            <div class="client_dash_table" id="client_dash_table"></div>
                            <textarea id="m_datatable_console_client" class="form-control m--margin-top-30" style="display: none;"cols="100" rows="10" title="Console" readonly="readonly"></textarea>
                            <!--end: Datatable -->
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                        <h4 class="modal-title">Edit Details</h4>
                    </div>
                    <div class="modal-body">
                        <form id="edit" name="edit" action="../user_client_admin/client_admin_dashboard.php" method="POST">
                            <?php include('../user_client_admin/edit_accountant_validation.php'); ?>
                            <?php if (!empty($successMessage)) { ?>
                                <div class="alert alert-success" role="alert"><?php echo $successMessage; ?></div>
                            <?php } ?>

                            <div class="form-group" style="display: none;">
                                <label for="editaccountantid">Username</label>
                                <input type="text" class="form-control" id="editaccountantid" name="editaccountantid">
                            </div>

                            <div class="form-group">
                                <label for="editaccountantemail">Email</label>
                                <input type="email" class="form-control" id="editaccountantemail" name="editaccountantemail">
                                <span class="error" style="color: red;"><?php echo $emailErr; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="accountantpassword">Password</label>
                                <input type="password" class="form-control" id="editaccountantpassword" name="editaccountantpassword" placeholder="Password">
                                <span class="error" style="color: red;"><?php echo $passErr; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="editaccountantcpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="editaccountantcpassword" name="editaccountantcpassword" placeholder="Retype Password">
                                <span class="error" style="color: red;"><?php echo $cpassErr; ?></span>
                                <span class="error" style="color: red;"><?php echo $twopassErr; ?></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="updateButton" id="updateButton" class="btn btn-primary"><i class="fas fa-check"></i> Update Detail </button>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                        <h4 class="modal-title">Delete User</h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this user</p>
                        <form id="delete" name="delete" action="../user_client_admin/client_admin_dashboard.php" method="POST">
                            <?php include('../user_client_admin/delete_accountant_validation.php'); ?>
                            <?php if (!empty($successMessage)) { ?>
                                <div class="alert alert-success" role="alert"><?php echo $successMessage; ?></div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="deleteaccountantid">Username</label>
                                <input type="text" class="form-control" id="viewid" name="viewid" disabled>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="deleteaccountantid">Username</label>
                                <input type="text" class="form-control" id="deleteaccountantid" name="deleteaccountantid">
                            </div>

                            <div class="form-group">
                                <label for="deleteaccountantemail">Email</label>
                                <input type="email" class="form-control" id="viewemail" name="viewemail" disabled>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="deleteaccountantemail">Email</label>
                                <input type="email" class="form-control" id="deleteaccountantemail" name="deleteaccountantemail">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="deleteButton" id="deleteButton" class="btn btn-danger">
                                    <i class='fa fa-trash' aria-hidden='true'></i>Delete User
                                </button>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="submit" name="deleteButton" id="deleteButton" class="btn btn-danger">Delete User</button>-->
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    <script>

	

        function updateEdit(username,email) {
//            $('#editModal').modal('toggle');
//            $('#editModal').modal('show');
//            var username = document.getElementById("accountant_username" + x).innerHTML;
            document.getElementById('editaccountantid').value = username;
//            var email = document.getElementById("accountant_email" + x).innerHTML;
            document.getElementById('editaccountantemail').value = email;

        }

        function updateDelete(username,email) {
//            var username = document.getElementById("accountant_username" + x).innerHTML;
            document.getElementById('deleteaccountantid').value = username;
            document.getElementById('viewid').value = username;
//            var email = document.getElementById("accountant_email" + x).innerHTML;
            document.getElementById('deleteaccountantemail').value = email;
            document.getElementById('viewemail').value = email;

        }

    </script>
    <?php
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] == '1') {
    header('Location: ../user_super_admin/super_admin_dashboard.php');
}elseif (isset($_SESSION['username']) && $_SESSION['role_id'] == '3') {
    header('Location: ../user_accountant/accountant_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>
