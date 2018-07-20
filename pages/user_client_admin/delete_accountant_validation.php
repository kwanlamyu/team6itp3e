<?php
require_once '../db_connection/db.php';
$uname = $email = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteButton'])) {
//        echo "post update button <br>";
        $uname = ($_POST["accountantid"]);
//        echo 'Username: ' . $uname . ' <br>';
        $email = ($_POST["accountantemail"]);
//        echo 'Email: ' . $email . '<br>';
//        $pass = ($_POST["accountantpassword"]);
//        echo 'Password: ' . $pass . '<br>';
//        $sql = "DELETE FROM user WHERE username='$uname' AND role_id=3";
//        $statement = $DB_con->prepare($sql);
//        echo $sql.'<br>';
//        echo $email.'<br>';
//        echo $uname.'<br>';
        try {
            
        $sql = "DELETE FROM user WHERE username='$uname' AND role_id=3";
        $statement = $DB_con->prepare($sql);
        $statement->execute();
//        header('Location: ../user_management/delete_accountant.php');
        echo '<div class="alert alert-success" role="alert">'
                        . '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>'
                        . ' User successfully deleted'
                    . '</div>';
                echo '<span class="text-success"><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Redirecting Please Wait</span>';
                echo "<meta http-equiv='refresh' content='3;url=delete_accountant.php'> ";
//        echo'
//            <body>
//                <div class="row">
//                    <div class"card">
//                        <div class="card-body">
//                            <h2>Success</h2><hr>
//                            <p>Accountant account successfully deleted</p><br>
//                            <p><a href="delete_accountant.php">Delete another account</a></p><br>
//                            <p><a href="../client_admin_dashboard.php">Return to dashboard</a></p>
//                        </div>
//                    </div>
//                </div>
//            <body>
//        ';
        
        
        } catch (PDOException $e) {
            
            echo $sql . "<br>" . $e->getMessage();
            
        }
//        if ($statement->execute()) {
////                echo "after sql execute <br>";
//            echo "account successfully deleted";
//        } else {
//            echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $DB_con->error . '</div>';
//        }
        header('Location: delete_accountant.php');
    }
}
?>