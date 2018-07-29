<?php
/* validation of edit client info on super admin dahboard
 * 
 * Author: Jerome Augustine Rodrigues, Singapore Institute of Technology
 * 
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
    if (isset($_POST['updateClientButton'])) {

        $uname = ($_POST["editclientid"]);

        $regex = '/^[-a-z0-9_~!$%^&*=+}{\'?]+(\.[-a-z0-9_~!$%^&*=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i';
        if (empty($_POST["editclientemail"])) {
            $emailErr = "* Email is required";
            $valid = FALSE;

        } else {
            $email = test_input($_POST["editclientemail"]);
            
            if ((!filter_var($email, FILTER_VALIDATE_EMAIL)) || (!preg_match($regex, $email))) {
                $emailErr = "* Invalid email format";
                $valid = FALSE;

            } else {
                $email = ($_POST["editclientemail"]);

            }
        }
        
        if (empty($_POST["editclientpassword"])) {
            $pass ="";
        } else {
            $pass = ($_POST["editclientpassword"]);
            if ((strlen($pass) < 8) || !ctype_alnum($pass)) {
                $passErr = "* Password must be 8 alphanumeric long";
                $valid = FALSE;
                
            }
        }

        if (empty($_POST["editclientcpassword"])) {
            $cpass ="";
            
        }else {
            $cpass = ($_POST["editclientcpassword"]);
            if ((strlen($cpass) < 8) || !ctype_alnum($pass)) {
                $cpassErr = "* Password must be 8 alphanumeric long";
                $valid = FALSE;
                
            }
        }

        if (!empty($_POST["editclientpassword"]) && empty($_POST["editclientcpassword"])) {
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
                //encrypt password
                $hashpass = password_hash($pass,PASSWORD_DEFAULT);
                $sql = "UPDATE user SET email='$email', password='$hashpass' WHERE username='$uname'";
            }
            $statement = $DB_con->prepare($sql);
            
            try{
            $statement->execute();
            $successMessage = "Client Details Changed successfully.";
            echo "<meta http-equiv='refresh' content='3;url=../user_super_admin/super_admin_dashboard.php'> ";

            }catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
                
            }
        }else {
            $failMessage = "Failed to Change Client Details";
        }
    }
}
?>
