<?php
//check for username and role_id
//if(isset($_SESSION['username']) && $_SESSION['role_id']==='2'){
include '../general/header.php';
require_once '../db_connection/db.php';
include '../general/navigation_clientadmin.php';
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
            if (isset($_GET['deleteWorkAccount'])) {
                $accountants = $_GET['deleteWorkAccount'];
//                echo'after post statement';
//                $userID = $_SESSION["username"];
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
                    <th>Delete Details</th>
                    </thead>
                    <?php // echo'after table head'; ?>

                    <tbody>
                        <?php
                        $userID = "jerome";
//                          echo'after table body';
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
                        $sql = $DB_con->prepare($query);
//                            echo'statement prepared';
                        echo $query;
                        $sql->execute();
                        $users = $sql->fetchAll();
//                            echo'statement executed';
//                            echo count($users);
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
                                . "<td>"
                                . "<button type='button' name='deleteButton' id='deleteButton' class='btn btn-danger delete_data' data-toggle='modal' data-target='#deleteModal' onclick='deleteAccount(" . $counter . ")'>"
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
                <h4 class="modal-title">Delete Account</h4>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to delete this user</p>
                <form id="editAccountant" name="deleteAccountant" action="../user_client_admin/delete_work_account.php" method="POST">
<?php include('../user_client_admin/delete_work_validation.php'); ?>
                    <div class="form-group">
                        <label for="viewid">UEN/ACRA No.</label>
                        <input type="text" class="form-control" id="viewid" name="viewid" disabled>                               
                    </div>

                    <div class="form-group" style="display: none;">
                        <label for="uenid">UEN/ACRA No.</label>     
                        <input type="text" class="form-control" id="uenid" name="uenid">                            
                    </div>

                    <div class="form-group">
                        <label for="viewcompany">Company Name</label>
                        <input type="text" class="form-control" id="viewcompany" name="viewcompany" disabled>                               
                    </div>

                    <div class="form-group">
                        <label for="filenumber">File No.</label>
                        <input type="text" class="form-control" id="filenumber" name="filenumber" disabled>                               
                    </div>

                    <div class="form-group">
                        <button type="submit" name="deleteAccountButton" id="deleteButton" class="btn btn-danger">
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

    function deleteAccount(x) {
        var uen = document.getElementById("account_uen" + x).innerHTML;
        document.getElementById('viewid').value = uen;
        document.getElementById('uenid').value = uen;
        var company = document.getElementById("account_companyName" + x).innerHTML;
        document.getElementById('viewcompany').value = company;
        var filenumber = document.getElementById("account_fileNumber" + x).innerHTML;
        document.getElementById('filenumber').value = filenumber;

    }

</script>



<?php
include '../general/footer_content.php';
include '../general/footer.php';
//}//end of session and role_id checking
//    elseif(isset($_SESSION['username']) && $_SESSION['role_id']==='1'){
//        header('Location: ../user_super_admin/userdashboard.php');
//    }
//    elseif(isset($_SESSION['username']) && $_SESSION['role_id']==='3'){
//        header('Location: ../user_client_admin/client_admin_dashboard.php');
//    }
//    else{
//        header('Location: ../user_login/login.php');
//    }
?>