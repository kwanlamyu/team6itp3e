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
                <?php
                if (isset($_GET['createWorkButton'])) {
                    $accountants = $_GET['createWorkButton'];
//                $userID = $_SESSION["username"];
                    $userID = "Jerome";
//                echo'after post statement';
                }
                ?>
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>               
                <form id="manageWorkAccount" name="manageWorkAccount" action="../user_client_admin/manage_work_account.php" method="POST">
                    <?php include('../user_client_admin/manage_work_validation.php'); ?>
                    <div class="form-group">
                        <label for="select_uen">Account UEN</label>
                        <select  class="form-control" id="select_uen" name="select_uen">
                            <option>--- Select UEN ---</option>
                            <?php
                            //get UENs
                            $uensql = $DB_con->prepare("SELECT UEN FROM account WHERE 1");
//                            echo'statement prepared';
                            $uensql->execute();
                            $uenNum = $uensql->fetchAll();

                            if (count($uenNum) == 0) {
                                //selection blank
                                echo '<option> </option>';
                            } else {
                                //select UENs
//                                
                                $counter = 0;
                                foreach ($uenNum as $row) {
//                                    echo'rows echoed';

                                    echo "<option value='" . $row['UEN'] . "'>" . $row['UEN'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="select_accountant">Account Manager</label>
                        <div class="table-responsive table-scroll">
                            <table class="table table-hover table-room">
                                <thead>
                                <th>Accountant</th>
                                <th>Select</th>
                                </thead>

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
                                            . "<td id='accountant_username" . $counter . "'>{$row['username']}</td>"
                                            . "<td id='select_users'>"
                                            . "<input type='checkbox' name='select_Collaborator[]' id='select_Collaborator' value='" . $row['username'] . "'>"
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

                    <button type="submit" name="manageWorkButton" id="manageWorkButton" class="btn btn-primary col-lg-12" > Save </button>

                </form>
                <hr>
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
            </div>
        </div>
    </div>

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