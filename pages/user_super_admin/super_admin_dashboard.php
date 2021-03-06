<?php
/* front end code of login page
 * 
 * front end code of super admin's dashboard
 */
?>
<?php
require_once '../db_connection/db.php';
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] == '1') {
    include '../general/header.php';
    include '../general/navigation_superadmin.php';
    ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title">
                        Super Admin Dashboard
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
                                        Client Accounts
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
                                                    <input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch" name="generalSearch" form="csvForm">
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
                                        <form method="post" action="../user_super_admin/super_admin_dashboard_export.php" id="csvForm">
											<input type="submit" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" name="export" value="Export Table"/>
							
											
										</form> 
                                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Search Form -->

                            <!--begin: Datatable -->
                            <div class="super_admin_table" id="super_admin_table"></div>
                            <span id="m_datatable_console" style="display: none;"class=" form-control m--margin-top-30" cols="100" rows="10" title="Console" readonly="readonly"></span>
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
                        <h4 class="modal-title">Edit Details</h4>
                    </div>
                    <div class="modal-body">
                        <form id="edit" name="edit" action="../user_super_admin/super_admin_dashboard.php" method="POST">
                            <?php include('../user_super_admin/edit_client_validation.php'); ?>
                            <?php if (!empty($successMessage)) { ?>
                                <div class="alert alert-success" role="alert"><?php echo $successMessage; ?></div>
                            <?php } ?>

                            <div class="form-group" style="display: none;">
                                <label for="editclientid">Username</label>
                                <input type="text" class="form-control" id="editclientid" name="editclientid">                            
                            </div>

                            <div class="form-group">
                                <label for="editclientemail">Email</label>
                                <input type="email" class="form-control" id="editclientemail" name="editclientemail">
                                <span class="error" style="color: red;"><?php echo $emailErr; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="editclientpassword">Password</label>
                                <input type="password" class="form-control" id="editclientpassword" name="editclientpassword" placeholder="Password">
                                <span class="error" style="color: red;"><?php echo $passErr; ?></span>
                            </div>

                            <div class="form-group">
                                <label for="editclientcpassword">Confirm Password</label>
                                <input type="password" class="form-control" id="editclientcpassword" name="editclientcpassword" placeholder="Retype Password">
                                <span class="error" style="color: red;"><?php echo $cpassErr; ?></span>
                                <span class="error" style="color: red;"><?php echo $twopassErr; ?></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="updateClientButton" id="updateClientButton" class="btn btn-primary"><i class="fas fa-check"></i> Update Detail </button>
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
                        <h4 class="modal-title">Delete User</h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this user</p>
                        <form id="delete" name="delete" action="../user_super_admin/super_admin_dashboard.php" method="POST">
                            <?php include('../user_super_admin/delete_client_validation.php'); ?>
                            <div class="form-group">
                                <label for="deleteclientid">Username</label>
                                <input type="text" class="form-control" id="viewid" name="viewid" disabled>                               
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="deleteclientid">Username</label>     
                                <input type="text" class="form-control" id="deleteclientid" name="deleteclientid">                            
                            </div>

                            <div class="form-group">
                                <label for="deleteaccountantemail">Email</label>
                                <input type="email" class="form-control" id="viewemail" name="viewemail" disabled>                               
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="deleteclientemail">Email</label>
                                <input type="email" class="form-control" id="deleteclientemail" name="deleteclientemail">
                            </div>

                            <div class="form-group">
                                <button type="submit" name="deleteClientButton" id="deleteClientButton" class="btn btn-danger">
                                    <i class='fa fa-trash' aria-hidden='true'></i>Delete User
                                </button>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                         <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    </div>
    
    <script>

        function updateEdit(username , email) {
            document.getElementById('editclientid').value = username;
            document.getElementById('editclientemail').value = email;
        }
        
        function updateDelete(username,email) {
            document.getElementById('deleteclientid').value = username;
            document.getElementById('viewid').value = username;
            document.getElementById('deleteclientemail').value = email;
            document.getElementById('viewemail').value = email;

        }

    </script>

    <?php
    //include footer and footer content
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] == '2') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
    
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] == '3') {
    header('Location: ../user_accountant/accountant_dashboard.php');
    
} else {
    header('Location: ../user_login/login.php');
    
}
?>