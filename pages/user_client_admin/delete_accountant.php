<?php
/*
 * front-end code to verify deleting of a accountant account
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
                    <!--begin::Portlet-->
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Delete Accountant Account
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--BEGIN: Table-->
                        <?php
                        if (isset($_GET['deleteAccountant'])) {
                            $accountants = $_GET['deleteAccountant'];
                        }
                        ?>

                        <div class="table-responsive table-scroll">
                            <table class="table table-hover table-room">
                                <thead>
                                <th>User</th>
                                <th>Email</th>
                                <th>Delete Details</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = $DB_con->prepare("SELECT * FROM user WHERE role_id = 3 AND companyName = '" . $_SESSION['company'] . "';");
                                    $sql->execute();
                                    $users = $sql->fetchAll();
                                    if (count($users) == 0) {
                                        echo '<tr>'
                                        . '<td>Nil</td>'
                                        . '<td>Nil</td>'
                                        . '<td>Nil</td>'
                                        . '</tr>';
                                    } else {
                                        $counter = 0;
                                        foreach ($users as $row) {
                                            echo ""
                                            . "<tr>"
                                            . "<td id='accountant_username" . $counter . "'>{$row['username']}</td>"
                                            . "<td id='accountant_email" . $counter . "'>{$row['email']}</td>"
                                            . "<td>"
                                            . "<button type='button' name='deleteButton' id='deleteButton' class='btn btn-danger delete_data' data-toggle='modal' data-target='#deleteModal' onclick='updateUsername(" . $counter . ")'>"
                                            . "<i class='fa fa-trash' aria-hidden='true'></i> Delete "
                                            . "</button>"
                                            . "</td>"
                                            . "</tr>\n";
                                            $counter++;
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!--END: Table-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="deleteModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4 class="modal-title">Delete User</h4>
                </div>
                <div class="modal-body">
                    <p> Are you sure you want to delete this user</p>
                    <form id="editAccountant" name="deleteAccountant" action="../user_client_admin/delete_accountant.php" method="POST">
                        <?php include('../user_client_admin/delete_accountant_validation.php'); ?>
                        <div class="form-group">
                            <label for="accountantid">Username</label>
                            <input type="text" class="form-control" id="viewid" name="viewid" disabled>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label for="accountantid">Username</label>
                            <input type="text" class="form-control" id="accountantid" name="accountantid">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="viewemail" name="viewemail" disabled>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="accountantemail" name="accountantemail">
                        </div>

                        <div class="form-group" style="display: none;">
                            <label for="accountantpassword">Password</label>
                            <input type="password" class="form-control" id="accountantpassword" name="accountantpassword" placeholder="Password">
                            <!--<span class="error"><?php echo $passErr; ?></span>-->
                        </div>

                        <div class="form-group">
                            <button type="submit" name="deleteButton" id="deleteButton" class="btn btn-danger">
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

    <!--  Modal Script-->
    <script>

        function updateUsername(x) {
            var username = document.getElementById("accountant_username" + x).innerHTML;
            document.getElementById('accountantid').value = username;
            document.getElementById('viewid').value = username;
            var email = document.getElementById("accountant_email" + x).innerHTML;
            document.getElementById('accountantemail').value = email;
            document.getElementById('viewemail').value = email;

        }

    </script>



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
