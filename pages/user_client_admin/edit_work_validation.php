<?php 
/* 
 * back-end code for editng and verification of changes to a company account
 */
?>

<?php
require_once '../db_connection/db.php';
$edituen = $editedCollaborators = $userID= $roleID= $updateCollaborator="";
$valid = TRUE; //this var scope ok
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateAccountButton'])) {

        if (empty($_POST["edituenid"])) {
            $valid = FALSE;
            $failMessage = "Empty UEN";
            
        } else{
            $edituen =($_POST["edituenid"]);
            
        }

        if (empty($_POST["edit_Collaborator"])) {
//            $valid = FALSE;
//            $failMessage = "Empty UEN";
        } else{
            $editedCollaborators = implode(',', $_POST['edit_Collaborator']);
            $emptyWorkList = FALSE;
        }
        
        $userID = $_SESSION["username"];
        $roleID = $_SESSION["role_id"];

        if ($valid == TRUE) {

            try {

                $deleteAccountSql = "DELETE FROM usermanageaccount WHERE account_UEN = '".$edituen."'";
                $firstStatement = $DB_con->prepare($deleteAccountSql);
                $firstStatement->execute();
                
                $seperatedCollaborators = explode(',', $editedCollaborators);
                /* insert multiple collaborators into DB */ 
                foreach ($seperatedCollaborators as $collaborator ){
                    //prepare statement to insert into DB company name and UEN to
                    $withCollaborator = "INSERT INTO userManageAccount(account_UEN, account_user_username, user_username, user_role_id)
                                       VALUES ('".$edituen."', '".$userID."', '".$collaborator."', '3')";
                    $updateSql = $DB_con->prepare($withCollaborator);

                    $updateSql->execute();

                }
                
                $successMessage = "Account has been edited successfully.";
                echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/all_work_account.php'> ";
            } catch (PDOException $e) {
//                echo $e->getMessage();
                $failMessage = "Error: ".$e->getMessage();
            }
        }
    }
}
?>
