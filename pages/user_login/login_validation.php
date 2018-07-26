<?php
require_once '../db_connection/db.php';
$unameErr = $passErr = $loginErr = "";
$uname = $pass = "";
$valid = TRUE;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['m_login_signin_submit'])) {

        if (empty($_POST["username"])) {
            $unameErr = "* User name is required";
//            echo "username: ".$unameErr;
//            echo '<div class="alert alert-danger mtmd" role="alert">User name is required</div>';
            $valid = FALSE;
        } else {
            $uname = $_POST['username'];

//            echo "username: ".$uname."<br>";
        }

        if (empty($_POST["password"])) {
            $passErr = "* Password is required";
//            echo "username: ".$passErr;
//            echo '<div class="alert alert-danger mtmd" role="alert">Password is required</div>';
            $valid = FALSE;
        } else {
            $pass = $_POST['password'];
//            echo "password: ".$pass."<br>";
        }

//        echo "valid: " . $valid . "<br>";
        if ($valid == TRUE) {
            $sql = "SELECT username, role_id, password, companyName FROM user WHERE username = '" . $uname . "'";
//            echo "sql: ".$sql."<br>";
            $query = $DB_con->prepare($sql);
            $query->execute();
//            echo '$query->execute()<br>';


            $data = $query->fetchAll();
            if(count($data) == 0){
                $unameErr = "Account invalid";
                $passErr = "Password invalid";
            }

//            echo '$data = $query->fetchAll()<br>';
            //echo "hello world";
            //echo "<br>";
//            echo "before foreach loop<br>";
            foreach ($data as $userData) {
//                echo "enter foreach loop<br>";
                $uname = $userData['username'];
                $hash = $userData['password'];
                $role_id = $userData['role_id'];
                $companyName = $userData['companyName'];
//                echo $hash;
                if (password_verify($pass, $hash)) {
                    $_SESSION['username']=$uname;
                    $_SESSION['role_id']=$role_id;
                    $_SESSION['company']=$companyName;
//                    echo "password verified";
                    if ($role_id == '1') {
//                        echo"Welcome Super Admin";
                        //redirect to Super Admin Dash
                        echo "<meta http-equiv='refresh' content='3;url=../user_super_admin/super_admin_dashboard.php'> ";
                        echo '<span class="text-success "><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Welcome '.$uname.' please wait</span>';
//                        header('Location: ../user_super_admin/super_admin_dashboard.php');
                    } elseif ($role_id == '2') {
//                        echo"Welcome Client Admin";
                        //redirect to Client Admin Dash
                        echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/client_admin_dashboard.php'> ";
                        echo '<span class="text-success "><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Welcome '.$uname.' please wait</span>';
//                        header('Location: ../user_client_admin/client_admin_dashboard.php');
                    } elseif ($role_id == '3') {
//                        echo"Welcome Standard User";
                        //redirect to Accountant Dash
                        echo "<meta http-equiv='refresh' content='3;url=../user_accountant/accountant_dashboard.php'> ";
                        echo '<span class="text-success "><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Welcome '.$uname.' please wait</span>';
//                        header('Location: ../user_client_admin/client_admin_dashboard.php');
                    } else {
                        echo"User type not found";
                        //Display error message to contact System Admin
                    }
                } else {
                    $passErr = "Password invalid";
                }
            }
        }
    }
}
?>
