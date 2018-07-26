<?php
require_once '../db_connection/db.php';
$uen= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteAccountButton'])) {
//        echo "post update button <br>";
        $uen = ($_POST["deleteuenid"]);
//        echo 'Username: ' . $uname . ' <br>';
//        $email = ($_POST["accountantemail"]);
//        echo 'Email: ' . $email . '<br>';
//        $pass = ($_POST["accountantpassword"]);
//        echo 'Password: ' . $pass . '<br>';
//        $sql = "DELETE FROM user WHERE username='$uname' AND role_id=3";
//        $statement = $DB_con->prepare($sql);
//        echo $sql.'<br>';
//        echo $email.'<br>';
//        echo $uname.'<br>';
        try {
            
            $userManageAccountSql = "DELETE FROM usermanageaccount WHERE account_UEN = '".$uen."'";
            $firstStatement = $DB_con->prepare($userManageAccountSql);
            $firstStatement->execute();
            
            $accountSql = "DELETE FROM account WHERE UEN = '".$uen."'";
            $secondStatement = $DB_con->prepare($accountSql);
            $secondStatement->execute();
            $successMessage = "Account has been Deleted successfully.";
//            echo '<div class="alert alert-success" role="alert">'
//            . '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>'
//            . ' User successfully deleted'
//            . '</div>';
            //echo '<span class="text-success"><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Redirecting Please Wait</span>';
            echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/all_work_account.php'> ";

        } catch (PDOException $e) {
            
            //echo $sql . "<br>" . $e->getMessage();
            $failMessage = "Error: ".$e->getMessage();
            
        }
//        if ($statement->execute()) {
////                echo "after sql execute <br>";
//            echo "account successfully deleted";
//        } else {
//            echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $DB_con->error . '</div>';
//        }
//        header('Location: delete_accountant.php');
    }
}
?>