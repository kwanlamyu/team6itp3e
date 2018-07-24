<?php
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] === '2') {
    include '../general/header.php';
    require_once '../db_connection/db.php';
    include '../general/navigation_clientadmin.php';
    ?>

    <div class="row">
        <div class="card">
            <div class="card-body">
                <!--                //retrieve table of accountants
                                //format table with edit button at side
                                //when button is clicked, modal or redirect to page with accountant's info
                                //can only edit email. should client-admin be able to change password?-->

                <?php
                if (isset($_GET['editWorkAccount'])) {
                    $accountants = $_GET['editWorkAccount'];
//                echo'after post statement';
                }
                ?>
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
                <div class="table-responsive table-scroll">
                    <table class="table table-hover table-room">
                        <thead>
                        <th>UEN/ACRA No.</th>
                        <th>Company Name</th>
                        <th>File Number</th>
                        <th>Account Manager(s)</th>
                        <th>Edit Details</th>
                        </thead>
                        <?php // echo'after table head';?>

                        <tbody>
                            <?php
                            //$userID = $_SESSION["username"];
                            $userID = 'jerome';
                            $query = "SELECT "
                                    . "account.UEN AS UEN, "
                                    . "account.companyName AS companyName, "
                                    . "account.fileNumber AS fileNumber, "
                                    . "usermanageaccount.user_username AS accountManagers "
                                    . "FROM "
                                    . "account "
                                    . "INNER JOIN "
                                    . "usermanageaccount "
                                    . "ON "
                                    . "account.UEN = usermanageaccount.account_UEN  "
                                    . "AND usermanageaccount.account_user_username = '$userID'";
                            //$query= "SELECT * FROM userManageAccount WHERE account_user_username = '".$userID."'";
                            $sql = $DB_con->prepare($query);
//                            echo'statement prepared';
                            $sql->execute();
                            $users = $sql->fetchAll();
//                            echo'statement executed';
                            if (count($users) == 0) {
                                echo '';
                                echo '<tr>'
                                . '<td>Nil</td>'
                                . '<td>Nil</td>'
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
                                    . "<td id='account_uen" . $counter . "'>{$row['UEN']}</td>"
                                    . "<td id='account_companyName" . $counter . "'>{$row['companyName']}</td>"
                                    . "<td id='account_fileNumber" . $counter . "'>{$row['fileNumber']}</td>"
                                    . "<td id='account_accountManagers" . $counter . "'>{$row['accountManagers']}</td>"
                                    . "<td id='edit'>"
                                    . "<button type='button' name='editAccountButton' id='editButton' class='btn btn-success edit_data'data-toggle='modal' data-target='#editModal' onclick='updateUEN(" . $counter . ")'>"
                                    . "<i class='far fa-edit'></i> Edit "
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
    <div class="modal fade" id="editModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4 class="modal-title">Edit Details</h4>
                </div>
                <div class="modal-body">
                    <form id="editAccountant" name="editAccountant" action="edit_work_validation.php" method="POST">
                        <?php include('../user_client_admin/edit_work_validation.php'); ?>

                        <div class="form-group">
                            <label for="uenid">UEN/ACRA No.</label>
                            <input type="text" class="form-control" id="viewid" name="viewid" disabled>                               
                        </div>

                        <div class="form-group" style="display: none;">
                            <!--<label for="uenid">Username</label>-->
                            <input type="text" class="form-control" id="uenid" name="uenid">                            
                        </div>

                        <div class="form-group">
                            <label for="edit_account">Account Manager</label>
                            <div class="table-responsive table-scroll">
                                <table class="table table-hover table-room">
                                    <thead>
                                    <th>Accountant</th>
                                    <th>Select</th>
                                    </thead>
                                    <?php // echo'after table head';?>

                                    <tbody>
                                        <?php
//                            echo'after table body';
                                        $sql = $DB_con->prepare("SELECT username FROM user WHERE role_id = 3");
//                            echo'statement prepared';
                                        $sql->execute();
                                        $users = $sql->fetchAll();
//                            echo'statement executed';
                                        if (count($users) == 0) {
                                            echo '<tr>'
                                            . '<td> </td>'
                                            . '<td> </td>'
                                            . '</tr>';
                                        } else {
//                                echo'else condition reached';
                                            $counter = 0;
                                            foreach ($users as $row) {
//                                    echo'rows echoed';
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

    <!--  Modal Script-->
    <script>

        function updateUEN(x) {
            var uen = document.getElementById("account_uen" + x).innerHTML;
            document.getElementById('uenid').value = uen;
            document.getElementById('viewid').value = uen;


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