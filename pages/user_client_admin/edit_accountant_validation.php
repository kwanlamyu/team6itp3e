<?php
require_once '../db_connection/db.php';
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
      
        $uname = ($_POST["accountantid"]);
        
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
            //$valid = FALSE;
            $pass ="";
        } else {
            $pass = ($_POST["accountantpassword"]);
            if ((strlen($pass) < 8) || !ctype_alnum($pass)) {
                $passErr = "* Password must be 8 alphanumeric long";
                $valid = FALSE;
            }
        }
        
        if (empty($_POST["accountantcpassword"])) {
            //$passErr = "* Password is required";
            //$valid = FALSE;
            $cpass ="";
        }else {
            $cpass = ($_POST["accountantcpassword"]);
            if ((strlen($cpass) < 8) || !ctype_alnum($pass)) {
                $cpassErr = "* Password must be 8 alphanumeric long";
//                echo"C Password: ".$cpassErr."<br>";
                $valid = FALSE;
            }
//            echo"C Password: ".$cpass."<br>";
        }
        
        if (!empty($_POST["accountantpassword"]) && empty($_POST["accountantcpassword"])) {
            $cpassErr = "* Please retype your password";
//            echo"C Password: ".$cpassErr."<br>";
            $valid = FALSE;
        } 
        
        if ($pass !== $cpass) {
            $twopassErr = "* Both password must be the same";
//                    echo"Password: ".$twopassErr."<br>";
            $valid = FALSE;
        }

        
//        echo gettype($valid).'<br>';
//        echo $valid.'<br>';
        
        
        if ($valid == TRUE) {
//            echo 'test<br>';
//            echo 'Username: '.$uname.' <br>';
//            echo 'Email: '.$email.'<br>';
//            echo 'Password: '.$pass.'<br>';
            if ($pass == ""){
                $sql = "UPDATE user SET email='$email' WHERE username='$uname'";
            }else{
                $hashpass = password_hash($pass,PASSWORD_DEFAULT);
                $sql = "UPDATE user SET email='$email', password='$hashpass' WHERE username='$uname'";
            }
            
            $statement = $DB_con->prepare($sql);
            
//            echo $sql.'<br>';
//            echo $email.'<br>';
//            echo $uname.'<br>';
            
           
            if ($statement->execute()) {
//                echo "<meta http-equiv='refresh' content='3;url=edit_accountant.php'> ";
                //header('Location: edit_accountant.php'); 
//                echo'
//                    <div class="row">
//                        <div class"card">
//                            <div class="card-body">
//                                <h2>Success</h2><hr>
//                                <p>Accountant account successfully updated</p><br>
//                                <p><a href="edit_accountant.php">Edit another account</a></p><br>
//                                <p><a href="../client_admin_dashboard.php">Return to dashboard</a></p>
//                            </div>
//                        </div>
//                    </div>
//                    
//                ';
                                     
            } else {
                echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $DB_con->error . '</div>';
            }
        }
//       header('Location: edit_accountant.php'); 
    }
}
?>