<?php
require_once '../db_connection/db.php';
ob_start();
$unameErr = $emailErr = $passErr = $cpassErr = $checkErr = $twopassErr = "";
$uname = $email = $pass = $cpass = $emailvalid = $successMessage = $failMessage = "";
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
        } else {
            $uname = ($_POST["accountantid"]);
            //            echo "else statement <br>";
            $query = "SELECT COUNT(*) FROM user WHERE username = '" . $uname . "'";
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
        if ($pass !== $cpass) {
            $twopassErr = "* Both password must be the same";
//                    echo"Password: ".$twopassErr."<br>";
            $valid = FALSE;
        }

        $companyName = $_SESSION['company'];
//        $companyName = "jerome pte ltd";

        if ($valid == TRUE) {
            
            
            if ($uname !== "") {
                $hashpass = password_hash($pass,PASSWORD_DEFAULT);
                $sql = $DB_con->prepare("INSERT INTO user(username, email, password, role_id, companyName)
                                           VALUES ('$uname', '$email', '$hashpass', '3', '$companyName')");
                
               
            }
            if ($sql->execute()) {
                
                $successMessage = "Accountant has been registered successfully."; 
                
                //header('Location: ../user_management/create_accountant.php');
                echo '<div class="alert alert-success" role="alert">'
                        . '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>'
                        . ' Accountant successfully created '
                    . '</div>';

            } else {
                
                echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $DB_con->error . '</div>';
            }
        } else {
            $failMessage = "Failed to register accountant."; 
        }
//        header('refresh:5;Location: create_accountant.php');
        ob_end_clean();
    }
}
?>
