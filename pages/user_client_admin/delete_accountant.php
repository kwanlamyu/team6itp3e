<?php
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] === '2') {
    include '../general/header.php';
    include '../general/navigation_clientadmin.php';
    include '../db_connection/db.php';
    require_once '../db_connection/db.php';
    ?>


    <div class="row">
        <div class="card">
            <div class="card-body">
                <!--            //retrieve table of accountants
                                //format table with delete button at side
                                //when button is clicked, modal popup to ask for confirmation
                                //on confirmation then delete row
                -->                


                <?php
                if (isset($_GET['deleteAccountant'])) {
                    $accountants = $_GET['deleteAccountant'];
//                echo'after post statement';
                }
                ?>
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
                <div class="table-responsive table-scroll">
                    <table class="table table-hover table-room">
                        <thead>
                        <th>User</th>
                        <th>Email</th>
                        <th>Delete Details</th>
                        </thead>
                        <?php // echo'after table head';?>

                        <tbody>
                            <?php
//                            echo'after table body';
                            $sql = $DB_con->prepare("SELECT * FROM user WHERE role_id = 3");
//                            echo'statement prepared';
                            $sql->execute();
                            $users = $sql->fetchAll();
//                            echo'statement executed';
                            if (count($users) == 0) {
                                echo '<tr>'
                                . '<td>Nil</td>'
                                . '<td>Nil</td>'
                                . '<td>Nil</td>'
                                . '</tr>';
                            } else {
//                                echo'else condition reached';
                                $counter = 0;
                                foreach ($users as $row) {
//                                    echo'rows echoed';
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
                <hr>
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
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
                    <!--<button type="submit" name="deleteButton" id="deleteButton" class="btn btn-danger">Delete User</button>-->
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
    header('Location: ../user_super_admin/userdashboard.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '3') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>