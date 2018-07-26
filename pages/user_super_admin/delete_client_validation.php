<?php
require_once '../db_connection/db.php';
$uname = $email = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteClientButton'])) {
        $uname = ($_POST["deleteclientid"]);
        try {

        $sql = "DELETE FROM user WHERE username='".$uname."'";
        echo $sql;
        $statement = $DB_con->prepare($sql);
        $statement->execute();
        $successEdit = "Client Deleted successfully.";
        echo "<meta http-equiv='refresh' content='3;url=../user_super_admin/super_admin_dashboard.php'> ";


        } catch (PDOException $e) {

            echo $sql . "<br>" . $e->getMessage();
            $failEdit = "Failed to Delete Client Details";

        }
    }
}
?>
