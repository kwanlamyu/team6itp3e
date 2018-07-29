<?php 
/* front-end code for showing all work (company) accounts
 * 
 */
?>

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
                        All Clients
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
                                        Company Accounts
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
                                        <form method="post" action="../user_client_admin/all_work_account_export.php" id="csvForm">
											<input type="submit" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air" name="export" value="Export Table"/>
											
										</form> 
                                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Search Form -->

                            <!--begin: Datatable -->
                            <div class="client_work_account" id="client_work_account"></div>
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
                        <form id="edit" name="edit" action="../user_client_admin/all_work_account.php" method="POST">
                            <?php include('../user_client_admin/edit_work_validation.php'); ?>
                            <div class="form-group">
                                <label for="edituenid">UEN/ACRA No.</label>
                                <input type="text" class="form-control" id="editviewid" name="editviewid" disabled>
                            </div>

                            <div class="form-group" style="display: none;">
                                <!--<label for="uenid">Username</label>-->
                                <input type="text" class="form-control" id="edituenid" name="edituenid">
                            </div>

                            <div class="form-group">
                                <label for="edit_account">Account Manager</label>
                                <div class="table-responsive table-scroll">
                                    <table class="table table-hover table-room">
                                        <thead>
                                        <th>Accountant</th>
                                        <th>Select</th>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $sql = $DB_con->prepare("SELECT username FROM user WHERE role_id = 3 AND companyName='" . $_SESSION['company'] . "';");
                                            $sql->execute();
                                            $users = $sql->fetchAll();
                                            if (count($users) == 0) {
                                                echo '<tr>'
                                                . '<td> </td>'
                                                . '<td> </td>'
                                                . '</tr>';
                                            } else {
                                                $counter = 0;
                                                foreach ($users as $row) {
                                                    echo ""
                                                    . "<tr>"
                                                    . "<td id='edit_account_username" . $counter . "'>{$row['username']}</td>"
                                                    . "<td id='edit_account_users'>"
                                                    . "<input type='checkbox' name='edit_Collaborator[]' id='edit_Collaborator' value='" . $row['username'] . "'>"
                                                    . "</td>"
                                                    . "</tr>\n";
                                                    $counter++;
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="updateAccountButton" id="updateAccountButton" class="btn btn-primary"><i class="fas fa-check"></i> Update Detail </button>
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
                        <h4 class="modal-title">Delete Account</h4>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this user</p>
                        <form id="delete" name="delete" action="../user_client_admin/all_work_account.php" method="POST">
                            <?php include('../user_client_admin/delete_work_validation.php'); ?>
                            <div class="form-group">
                                <label for="deleteviewid">UEN/ACRA No.</label>
                                <input type="text" class="form-control" id="deleteviewid" name="deleteviewid" disabled>
                            </div>

                            <div class="form-group" style="display: none;">
                                <label for="deleteuenid">UEN/ACRA No.</label>
                                <input type="text" class="form-control" id="deleteuenid" name="deleteuenid">
                            </div>

                            <div class="form-group">
                                <label for="deleteviewcompany">Company Name</label>
                                <input type="text" class="form-control" id="deleteviewcompany" name="deleteviewcompany" disabled>
                            </div>

                            <div class="form-group">
                                <label for="deletefilenumber">File No.</label>
                                <input type="text" class="form-control" id="deletefilenumber" name="deletefilenumber" disabled>
                            </div>

                            <div class="form-group">
                                <button type="submit" name="deleteAccountButton" id="deleteButton" class="btn btn-danger">
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

        function updateUEN(uen) {
            document.getElementById('edituenid').value = uen;
            document.getElementById('editviewid').value = uen;


        }

        function deleteAccount(uen,company,filenumber) {
            document.getElementById('deleteviewid').value = uen;
            document.getElementById('deleteuenid').value = uen;
            document.getElementById('deleteviewcompany').value = company;
            document.getElementById('deletefilenumber').value = filenumber;

        }

    </script>

    <?php
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] == '1') {
    header('Location: ../user_super_admin/super_admin_dahsboard.php');
}elseif (isset($_SESSION['username']) && $_SESSION['role_id'] == '3') {
    header('Location: ../user_accountant/accountant_dahsboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>
