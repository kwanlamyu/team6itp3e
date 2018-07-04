<?php

require_once 'db.php';
$unameErr = $emailErr = $passErr = $cpassErr = $checkErr = $twopassErr = "";
$uname = $email = $pass = $cpass = $emailvalid = "";
$valid = TRUE; //this var scope ok
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['createButton'])) {
//        echo "post reg button <br>";
        if (empty($_POST["accountantid"])) {
            $unameErr = '* User name is required';
        } 
        else {
            $uname = ($_POST["accountantid"]);
//            echo "else statement <br>";
            $query = "SELECT COUNT(*) FROM user WHERE username = '".$uname."'";
//            echo "pre-query execution <br>";
            $result = $DB_con->query($query);
            
            if ($result->fetchColumn() > 0) {
                $unameErr = "* Username has already been used";
                $valid = FALSE;
            }
            
        }
        
        $regex = '/^[-a-z0-9_~!$%^&*=+}{\'?]+(\.[-a-z0-9_~!$%^&*=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i';
        if (empty($_POST["email"])) {
            $emailErr = "* Email is required";
            $valid = FALSE;
        } else {
            $email = test_input($_POST["email"]);
            if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) || (!preg_match($regex, $email))) {
                $emailErr = "* Invalid email format";
                $valid = FALSE;
            } else {
                $email = ($_POST["email"]);
            }
        }
        if (empty($_POST["accountantpassword"])) {
            $passErr = "* Password is required";
            $valid = FALSE;
        } else {
            $pass = ($_POST["accountantpassword"]);
            if ((strlen($pass) < 8) || !ctype_alnum($pass)) {
                $passErr = "* Password must be 8 alphanumeric long";
                $valid = FALSE;
            }
        }
        if (empty($_POST["accountantcpassword"])) {
            $cpassErr = "* Password confirm is required";
            $valid = FALSE;
        } else {
            $cpass = ($_POST["accountantcpassword"]);
            if ((strlen($cpass) < 8) || !ctype_alnum($pass)) {
                $cpassErr = "* Password must be 8 alphanumeric long";
                $valid = FALSE;
            }
        }
        if (strlen($cpass) > 8) {
            if (strlen($pass) > 8) {
                if ($pass !== $cpass) {
                    $twopassErr = "* Both password must be the same";
                    $valid = FALSE;
                }
            }
        }
        if ($valid == TRUE) {
            if ($uname !== "") {
                $sql = $DB_con->prepare("INSERT INTO user(username, email, password, role_id)
                               VALUES ('$uname', '$email', '$pass', '3')");
            } 
            if ($sql->execute()) {
                echo "after sql execute";
                echo'
                    <h2>Success</h2><hr>
                    <p>Accountant account successfully created</p><br>
                    <p><a href="create_accountant.php">Add another account</a></p><br>
                    <p><a href="client_dashboard.php">Return to dashboard</a></p>                                
                ';
                
                
            } else {
                echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $connection->error . '</div>';
            }
        }
        header('Location: create_accountant.php'); 
    }
}


?>
<!--     Modal 
    <div class="modal fade" id="alertModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">User Successfully Created</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <h4>User Successfully Created</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>-->


