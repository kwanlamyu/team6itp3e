<?php
require_once '../db_connection/db.php';
$uname = $email = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteButton'])) {
        
        $uname = ($_POST["deleteaccountantid"]);

        try {
            
        $sql = "DELETE FROM user WHERE username='$uname' AND role_id=3";
        $statement = $DB_con->prepare($sql);
        $statement->execute();
        $successEdit = "Accountant Deleted successfully.";
        echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/client_admin_dashboard.php'> ";
        
        
        } catch (PDOException $e) {
            
            echo $sql . "<br>" . $e->getMessage();
            $failEdit = "Failed to Change Accountant Details";
            
        }
    }
}
?>