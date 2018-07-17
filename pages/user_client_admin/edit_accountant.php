<?php include '../general/header.php';?>
<?php include '../general/navigation_clientadmin.php';?>
<?php include '../db_connection/db.php';?>

<div class="row">
    <div class="card">
        <div class="card-body">
            <!--                //retrieve table of accountants
                            //format table with edit button at side
                            //when button is clicked, modal or redirect to page with accountant's info
                            //can only edit email. should client-admin be able to change password?-->

            <?php
            if (isset($_GET['editAccountant'])) {
                $accountants = $_GET['editAccountant'];
//                echo'after post statement';
            }
            ?>
            <p><a href="client_admin_dashboard.php">Return to dashboard</a></p>
            <div class="table-responsive table-scroll">
                <table class="table table-hover table-room">
                    <thead>
                    <th>User</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Edit Details</th>
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
                                    . "<td>Accountant</td>"
                                    . "<td id='edit'>"
                                        . "<button type='button' name='editButton' id='editButton' class='btn btn-success edit_data'data-toggle='modal' data-target='#editModal' onclick='updateUsername(" . $counter . ")'>"
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
            <p><a href="client_admin_dashboard.php">Return to dashboard</a></p>
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
                <form id="editAccountant" name="editAccountant" action="edit_accountant.php" method="POST">
                    <?php include('edit_accountant_validation.php'); ?>
                    
                    <div class="form-group" style="display: none;">
                        <label for="accountantid">Username</label>
                        <input type="text" class="form-control" id="accountantid" name="accountantid">                            
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="accountantemail" name="accountantemail">
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="accountantpassword">Password</label>
                        <input type="password" class="form-control" id="accountantpassword" name="accountantpassword" placeholder="Password">
                        <span class="error"><?php echo $passErr; ?></span>
                    </div>
                    
                    <div class="form-group">
                            <label for="accountantcpassword">Confirm Password</label>
                            <input type="password" class="form-control" id="accountantcpassword" name="accountantcpassword" placeholder="Retype Password">
                            <span class="error"><?php echo $cpassErr; ?></span>
                            <span class="error"><?php echo $twopassErr; ?></span>
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

<!--  Modal Script-->
<script>

    function updateUsername(x) {
        var username = document.getElementById("accountant_username" + x).innerHTML;
        document.getElementById('accountantid').value = username;
        var email = document.getElementById("accountant_email" + x).innerHTML;
        document.getElementById('accountantemail').value = email;

    }

</script>
<?php include '../general/footer_content.php'; ?>
<?php include '../general/footer.php'; ?>