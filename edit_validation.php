<?php

require_once 'db.php';
$emailErr = $passErr = $cpassErr = $checkErr = $twopassErr = "";
$uname = $email = $pass = $cpass = $emailvalid = "";
$valid = TRUE; //this var scope ok
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateButton'])) {
//        echo "post update button <br>";
        
        
//        if (empty($_POST["accountantid"])) {
//            $unameErr = '* User name is required';
//        } 
//        else {
            $uname = ($_POST["accountantid"]);
//            echo 'Username: '.$uname.' <br>';
////            echo "else statement <br>";
//            $query = "SELECT COUNT(*) FROM user WHERE username = '".$uname."'";
////            echo "pre-query execution <br>";
//            $result = $DB_con->query($query);
//            
//            if ($result->fetchColumn() > 0) {
//                $unameErr = "* Username has already been used";
//                $valid = FALSE;
//            }
//            
//        }
        
        $regex = '/^[-a-z0-9_~!$%^&*=+}{\'?]+(\.[-a-z0-9_~!$%^&*=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i';
        if (empty($_POST["accountantemail"])) {
//            echo'$_POST["accountantemail"] is empty<br>';
            //$emailErr = "* Email is required";
            $valid = FALSE;
//            echo'if (empty($_POST["accountantemail"])): '.$valid.'<br>';
        
            
        } else {
            
            $email = test_input($_POST["accountantemail"]);
//            echo 'else statement: test_input($_POST["accountantemail"])'.$email.'<br>';
            if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) || (!preg_match($regex, $email))) {
//                echo'filter_var/regex fail<br>';
//                echo $email.'<br>';
                $emailErr = "* Invalid email format";
                $valid = FALSE;
//                echo'if (empty($_POST["accountantemail"])): '.$valid.'<br>';
            
                
            } else {
                
                $email = ($_POST["accountantemail"]);
//                echo 'email passed: '.$email.'<br>';
            
                
            }
        }
//        echo 'Email: '.$email.'<br>';
        if (empty($_POST["accountantpassword"])) {
            //$passErr = "* Password is required";
            $valid = FALSE;
        } else {
            $pass = ($_POST["accountantpassword"]);
            if ((strlen($pass) < 8) || !ctype_alnum($pass)) {
                $passErr = "* Password must be 8 alphanumeric long";
                $valid = FALSE;
            }
        }
//        echo 'Password: '.$pass.'<br>';
//        if (empty($_POST["accountantcpassword"])) {
//            $cpassErr = "* Password confirm is required";
//            $valid = FALSE;
//        } else {
//            $cpass = ($_POST["accountantcpassword"]);
//            if ((strlen($cpass) < 8) || !ctype_alnum($pass)) {
//                $cpassErr = "* Password must be 8 alphanumeric long";
//                $valid = FALSE;
//            }
//        }
//        if (strlen($cpass) > 8) {
//            if (strlen($pass) > 8) {
//                if ($pass !== $cpass) {
//                    $twopassErr = "* Both password must be the same";
//                    $valid = FALSE;
//                }
//            }
//        }
        
//        echo gettype($valid).'<br>';
//        echo $valid.'<br>';
        
        
        if ($valid == TRUE) {
//            echo 'test<br>';
//            echo 'Username: '.$uname.' <br>';
//            echo 'Email: '.$email.'<br>';
//            echo 'Password: '.$pass.'<br>';
           
            $sql = "UPDATE user SET email='$email', password='$pass' WHERE username='$uname'";
            
            $statement = $DB_con->prepare($sql);
            
//            echo $sql.'<br>';
//            echo $email.'<br>';
//            echo $uname.'<br>';
            
           
            if ($statement->execute()) {
//                echo "after sql execute <br>";
                echo "after sql execute";
                echo'
                    <body>
                        <div class="row">
                            <div class"card">
                                <div class="card-body">
                                    <h2>Success</h2><hr>
                                    <p>Accountant account successfully updated</p><br>
                                    <p><a href="edit_accountant.php">Edit another account</a></p><br>
                                    <p><a href="client_dashboard.php">Return to dashboard</a></p>
                                </div>
                            </div>
                        </div>
                    <body>
                ';
                                     
            } else {
                echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $DB_con->error . '</div>';
            }
        }
       header('Location: edit_accountant.php'); 
    }
}


?>
