
<<<<<<< HEAD
=======
<?php

>>>>>>> 28111d1935c6e79a038a0a090deb3207850a7a50
require_once '../db_connection/db.php';
$unameErr = $emailErr = $passErr = $cpassErr = $checkErr = $twopassErr = $companynameErr = $uennumberErr = "";
$uname = $email = $pass = $cpass = $emailvalid = $companyname = $uen ="";
$valid = TRUE; //this var scope ok
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['registerButton'])) {
//        echo "post reg button <br>";
        if (empty($_POST["reguserid"])) {
            $unameErr = '* User name is required';
            
        } else {
            $uname = ($_POST["reguserid"]);
//            echo "else statement <br>";
            $query = "SELECT COUNT(*) FROM user WHERE username = '".$uname."'";
//            echo "pre-query execution <br>";
            $result = $DB_con->query($query);
            
            if ($result->fetchColumn() > 0) {
                $unameErr = "* Username has already been used";
                $valid = FALSE;
            }
//            elseif($result->fetchColumn() == 0) {
//                echo "no rows found <br>";
//                
//            }
        }
<<<<<<< HEAD
        $regex = '/^[-a-z0-9~!$%^&*=+}{\'?]+(\.[-a-z0-9~!$%^&*=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i';
=======
        echo"Fullname: ".$uname."<br>";
        $regex = '/^[-a-z0-9_~!$%^&*=+}{\'?]+(\.[-a-z0-9_~!$%^&*=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i';
>>>>>>> 28111d1935c6e79a038a0a090deb3207850a7a50
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
        if (strlen($cpass) > 8) {
            if (strlen($pass) > 8) {
                if ($pass !== $cpass) {
                    $twopassErr = "* Both password must be the same";
                    $valid = FALSE;
                }
            }
        }
        
//        if (empty($_POST["companyname"])) {
//            $companynameErr = "* Company Name is required";
//            $valid = FALSE;
//        } else{
//            $companyname =($_POST["companyname"]);
//        }
//        
//        $companyregex = '/^(\d{9}[a-zA-Z \-_])|^((18|19|20)\d{2}\d{6}[a-zA-z \-_])|^((T|S|R)\d{2}(LP|LL|FC|PF|RF|MQ|MM|NB|CC|CS|MB|FM|GS|GA|GB|DP|CP|NR|CM|CD|MD|HS|VH|CH|MH|CL|XL|CX|RP|TU|TC|FB|FN|PA|PB|SS|MC|SM)\d{4}[a-zA-Z \-_])$/';
//        if (empty($_POST["uennumber"])) {
//            $uennumberErr = "* UEN/ACRA No. is required";
//            $valid = FALSE;
//        } else{
//            $companyuen = ($_POST["uennumber"]);
//            if (!preg_match($companyregex, $companyuen)){
//                $emailErr = "* Invalid UEN/ACRA format/number";
//                $valid = FALSE;
//            }
//        }
        
        
        if ($valid == TRUE) {
            echo"after valid == TRUE<br>";
            $hashpass = SHA1($pass);
            $hashcpass = SHA1($cpass);
            $query = "INSERT INTO user(username, email, password, role_id) VALUES ('$uname', '$email', '$hashpass', '2')";
            echo $query."<br>";
            $sql = $DB_con->prepare($query);
            echo 'statement prepared -> $DB_con->prepare($query)<br>';
            
<<<<<<< HEAD
                $userSql = $DB_con->prepare("INSERT INTO user(username, email, password, role_id)
                               VALUES ('$uname', '$email', '$pass', '2')");
                
            } 
            if ($userSql->execute()) {
                //prepare statement to insert into DB company name and UEN to
//                $accountSql = $DB_con->prepare("INSERT INTO account(UEN, companyName, fileNumber, dateOfCreation, user_username)
//                               VALUES ('$uen', '$companyname', '000000', NOW(), '$uname')");
                
                ////echo "after sql execute";
=======
            try{
                $sql->execute(); 
                echo "after sql execute";
                header('Location: ../user_login/index.php'); 
                
            }  catch (Exception $e){
                echo 'Message: ' .$e->getMessage();
            }
>>>>>>> 28111d1935c6e79a038a0a090deb3207850a7a50
                //send email to registering party
                //redirect to choosing a plan
                //after choose plan redirect to login page
                //
                //
//                if ($uname != "") {
////                        $subject = "Email Verification";
////                        $headers = "MIME-Version: 1.0 \r\n";
////                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
////
////                        $message = '<html><body>';
////                        $message .='<div style="font-family: Arial;">';
////                        $message .= "You have registered an account at Quiz Me! recently. Click <a href='http://localhost/Assignment-Iffah/verifyuser.php?studentID=$uname&studentEmail=$email'>HERE</a> to verify your account.";
////                        $message .='</div>';
////                        $message .='</body></html>';
////
////                        mail($email, $subject, $message, $headers);
////                        echo '<div class="alert alert-success mbsm" role="alert">Successful registration! You may now login.</div>';
//                        include("phpmailer/index.php");
//
//                        $mail->Subject = 'Quiz Me! Verify your email.';
//
//                        $mail->Body = "You have registered an account at Quiz Me! recently. Click
//                                    <a href='http://172.27.52.33/Group21/verifyemail.php?studentID=$uname&studentEmail=$email'>HERE</a>
//                                    to verify your account.<br><br>";
//
//                        if (!$mail->send()) {
//                            echo 'Message could not be sent.';
//                            echo 'Mailer Error: ' . $mail->ErrorInfo;
//                        } else {
//                            echo 'Message has been sent';
//                        }
////                        <a href='http://localhost/Group21/verifyemail.php?studentID=$uname&studentEmail=$email'>HERE</a>
//                    
//                } 
                        
            
        }
        
        
        header('Location: ../user_login/index.php'); 

    }
}
?>

