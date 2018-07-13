<?php
require_once '../db_connection/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $DB_con->prepare("SELECT username, role_id, password FROM user WHERE username = '".$username."' AND password = '".$password."'");
$query->execute();
$data = $query->fetchAll();

//echo "hello world";
//echo "<br>";
foreach ($data as $userData) {

    if (($userData['username']==$username)) {
        echo'login sucessful';
        echo'<br>';
        if($userData['role_id']=='1'){
            echo'Welcome Super Admin';
            //redirect to Super Admin Dash
            header('Location: ../user_super_admin/userdashboard.php');
        }
        elseif($userData['role_id']=='2'){
            echo'Welcome Client Admin';
            //redirect to Client Admin Dash
            header('Location: ../user_client_admin/client_admin_dashboard.php');
        }
        elseif($userData['role_id']=='3'){
            echo'Welcome Standard User';
            //redirect to Accountant Dash
            header('Location: ../user_client_admin/client_admin_dashboard.php');
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