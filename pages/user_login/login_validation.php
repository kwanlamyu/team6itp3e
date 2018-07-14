<?php
require_once '../db_connection/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $DB_con->prepare("SELECT username, role_id, password FROM user WHERE username = '".$username."' AND password = SHA1('".$password."')");
$query->execute();
$data = $query->fetchAll();

//echo "hello world";
//echo "<br>";
foreach ($data as $userData) {

    if (($userData['username']==$username)) {
//        echo'login sucessful';
//        echo'<br>';
        if($userData['role_id']=='1'){
            echo'Welcome Super Admin';
            
            //redirect to Super Admin Dash
            //header("Location: #");
            
        }
        elseif($userData['role_id']=='2'){
            echo'Welcome Client Admin';

            //redirect to Client Admin Dash
<<<<<<< HEAD
            header('Location: ../user_super_admin/userdashboard.php');
            
=======
//            echo "<meta http-equiv='refresh' content='3;url=client_admin_dashboard.php'> ";
//            echo '<span class="text-success "><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Redirecting please wait</span>';
            header('Location: ../user_client_admin/client_admin_dashboard.php');
>>>>>>> 28111d1935c6e79a038a0a090deb3207850a7a50
        }
        elseif($userData['role_id']=='3'){
            echo'Welcome Standard User';
            
            //redirect to Accountant Dash
            //header("Location: #");
            
        }
        else{
            echo'User type not found';
            //Display error message to contact System Admin
        }

    }
    elseif (($userData['username']==$username) && ($userData['password']!=$password)) {

        echo '<div class="alert alert-danger mtmd" role="alert">Password invalid!</div>';

    }
    else {
    
    echo '<div class="alert alert-danger mtmd" role="alert">Account invalid!</div>';
    
    }
}
?>