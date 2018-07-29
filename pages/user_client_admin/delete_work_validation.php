<?php 
/* 
 * back-end code for deleting of a company account
 */
?>

<?php
require_once '../db_connection/db.php';
$uen= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST['deleteAccountButton'])) {
        
        $uen = ($_POST["deleteuenid"]);
        
        try {
            
            $userManageAccountSql = "DELETE FROM usermanageaccount WHERE account_UEN = '".$uen."'";
            $firstStatement = $DB_con->prepare($userManageAccountSql);
            $firstStatement->execute();
            
            $accountSql = "DELETE FROM account WHERE UEN = '".$uen."'";
            $secondStatement = $DB_con->prepare($accountSql);
            $secondStatement->execute();
            $successMessage = "Account has been Deleted successfully.";
            echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/all_work_account.php'> ";

        } catch (PDOException $e) {
            
            //echo $sql . "<br>" . $e->getMessage();
            $failMessage = "Error: ".$e->getMessage();
            
        }
    }
}
?>