<?php 
include 'db.php'; 
include 'header.php'; ?>
<body>
    <div>
        <h1>
            Manage Account
        </h1>
    </div>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset($_GET['createWorkButton'])) {
                $accountants = $_GET['createWorkButton'];
//                $userID = $_SESSION["userId"];
                $userID = "Jerome";
//                echo'after post statement';
                }
                ?>
                <p><a href="client_dashboard.php">Return to dashboard</a></p>               
                <form id="manageWorkAccount" name="manageWorkAccount" action="manage_work_validation.php" method="POST">
                    
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
                                foreach($uenNum as $row) {
//                                    echo'rows echoed';
                                    
                                    echo "<option value='". $row['UEN'] ."'>" .$row['UEN'] ."</option>";
                                    
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
                                                . "<td id='accountant_username" . $counter . "'>{$row['username']}</td>"
                                                . "<td id='select_users'>"
                                                    . "<input type='checkbox' name='select_Collaborator[]' id='select_Collaborator' value='". $row['username'] ."'>"
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
                <p><a href="client_dashboard.php">Return to dashboard</a></p>
            </div>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>