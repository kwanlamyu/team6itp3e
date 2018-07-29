<?php 
/* 
 * back-end code for editing and verifying of an accountant account details
 */
?>

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
      
        $uname = ($_POST["editaccountantid"]);
        
        $regex = '/^[-a-z0-9_~!$%^&*=+}{\'?]+(\.[-a-z0-9_~!$%^&*=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i';
        if (empty($_POST["editaccountantemail"])) {
            $emailErr = "* Email is required";
            $valid = FALSE;
        
            
        } else {
            
            $email = test_input($_POST["editaccountantemail"]);
            
            if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) || (!preg_match($regex, $email))) {
                $emailErr = "* Invalid email format";
                $valid = FALSE;
                
            } else {
                $email = ($_POST["editaccountantemail"]);
                
            }
        }
        
        if (empty($_POST["editaccountantpassword"])) {
            $pass ="";
            
        } else {
            $pass = ($_POST["editaccountantpassword"]);
            if ((strlen($pass) < 8) || !ctype_alnum($pass)) {
                $passErr = "* Password must be 8 alphanumeric long";
                $valid = FALSE;
            }
        }
        
        if (empty($_POST["editaccountantcpassword"])) {
            $cpass ="";
            
        }else {
            $cpass = ($_POST["editaccountantcpassword"]);
            if ((strlen($cpass) < 8) || !ctype_alnum($pass)) {
                $cpassErr = "* Password must be 8 alphanumeric long";
                $valid = FALSE;
                
            }
        }
        
        if (!empty($_POST["editaccountantpassword"]) && empty($_POST["editaccountantcpassword"])) {
            $cpassErr = "* Please retype your password";
            $valid = FALSE;
        } 
        
        if ($pass !== $cpass) {
            $twopassErr = "* Both password must be the same";
            $valid = FALSE;
            
        }
        
        if ($valid == TRUE) {
            
            if ($pass == ""){
                $sql = "UPDATE user SET email='$email' WHERE username='$uname'";
                
            }else{
                $hashpass = password_hash($pass,PASSWORD_DEFAULT);
                $sql = "UPDATE user SET email='$email', password='$hashpass' WHERE username='$uname'";
                
            }
            $statement = $DB_con->prepare($sql);
            
            try{
                $statement->execute();
                $successMessage = "Accountant Details Changed successfully.";
                echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/client_admin_dashboard.php'> ";

                                     
            } catch (PDOException $e) {
                $failMessage = "Error: ".$e->getMessage();
            }
        }else {
            $failMessage = "Failed to Change Accountant Details"; 
        }
    }
}
?>