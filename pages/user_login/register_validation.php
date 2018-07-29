<?php 
/* registration page validation
 * 
 * Author: Jerome Augustine Rodrigues, Singapore Institute of Technology
 * 
 * function to verify user  registration information and check if user exists in DB
 */
?>

<?php

require_once '../db_connection/db.php';
$unameErr = $companynameErr = $emailErr = $passErr = $cpassErr = $checkErr = $twopassErr = "";
$uname = $companyname = $email = $pass = $cpass = $emailvalid = "";
$valid = TRUE; //this var scope ok
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['m_login_signup_submit'])) {
        if (empty($_POST["fullname"])) {
            $unameErr = '* User name is required';
            
        } else {
            $uname = ($_POST["fullname"]);
            $query = "SELECT COUNT(*) FROM user WHERE username = '".$uname."'";
            $result = $DB_con->query($query);
            
            if ($result->fetchColumn() > 0) {
                $unameErr = "* Username has already been used";
                $valid = FALSE;
            }
        }
        
        if (empty($_POST["companyname"])) {
            $companynameErr = "* Company Name is required";
            $valid = FALSE;
        } else{
            $companyname =($_POST["companyname"]);
        }
        
        //email regex
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
        if (empty($_POST["regpassword"])) {
            $passErr = "* Password is required";
            
            $valid = FALSE;
        } else {
            $pass = ($_POST["regpassword"]);
            if ((strlen($pass) < 8) || !ctype_alnum($pass)) {
                $passErr = "* Password must be 8 alphanumeric long";
                
                $valid = FALSE;
            }
            
        }
        if (empty($_POST["regcpassword"])) {
            $cpassErr = "* Password confirm is required";
            
            $valid = FALSE;
        } else {
            $cpass = ($_POST["regcpassword"]);
            if ((strlen($cpass) < 8) || !ctype_alnum($pass)) {
                $cpassErr = "* Password must be 8 alphanumeric long";
                
                $valid = FALSE;
            }
            
        }
        if ($pass !== $cpass) {
            $twopassErr = "* Both password must be the same";
            
            $valid = FALSE;
        }
        
        if ($valid == TRUE) {
            //encrypt password
            $hashpass = password_hash($pass,PASSWORD_DEFAULT);
            $hashcpass = password_hash($cpass,PASSWORD_DEFAULT);
            $query = "INSERT INTO user(username, email, password, role_id, companyName) VALUES ('$uname', '$email', '$hashpass', '2', '$companyname')";
            $sql = $DB_con->prepare($query);
            
            try{
                $sql->execute(); 
                echo "<meta http-equiv='refresh' content='3;url=../user_login/login.php'> ";
                echo '<span class="text-success "><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Registration succesful! redirecting to login please wait</span>';
                
            }  catch (Exception $e){
                echo 'Message: ' .$e->getMessage();
                
            }   
        }
    }
}
?>

