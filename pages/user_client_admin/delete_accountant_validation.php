<?php 
/* 
 * back-end code to verify deleting of a accountant account
 */
?>

<?php
require_once '../db_connection/db.php';
$uname = $email = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteButton'])) {
        $uname = ($_POST["deleteaccountantid"]);
        try {

        $sql = "DELETE FROM user WHERE username='$uname' AND role_id=3 AND companyName = '" . $_SESSION['company'] . "'";
        $statement = $DB_con->prepare($sql);
        $statement->execute();
        $successMessage = "Accountant deleted successfully.";
        echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/client_admin_dashboard.php'> ";


        } catch (PDOException $e) {

            //echo $sql . "<br>" . $e->getMessage();
            $failMessage = "Error: ".$e->getMessage();

        }
    }
}
?>
