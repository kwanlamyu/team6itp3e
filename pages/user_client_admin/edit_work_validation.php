<?php
require_once '../db_connection/db.php';
$edituen = $editedCollaborators = $userID= $roleID= $updateCollaborator="";
$valid = TRUE; //this var scope ok
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updateAccountButton'])) {
        echo "post reg button <br>";

        if (empty($_POST["edituenid"])) {
            $valid = FALSE;
        } else{
            $edituen =($_POST["edituenid"]);
        }

        if (empty($_POST["edit_Collaborator"])) {
            $valid = FALSE;
        } else{
            $editedCollaborators = implode(',', $_POST['edit_Collaborator']);
        }

        $userID = $_SESSION["username"];
        $roleID = $_SESSION["role_id"];
//        $userID = "Jerome";
//        $roleID = "3";
        echo "username: ".$userID."<br>";
        echo "role ID: ".$roleID."<br>";
        echo gettype($valid).'<br>';

        if ($valid == TRUE) {

            try {

                $deleteAccountSql = "DELETE FROM usermanageaccount WHERE account_UEN = '".$edituen."'";
                $firstStatement = $DB_con->prepare($deleteAccountSql);
                $firstStatement->execute();


                $seperatedCollaborators = explode(',', $editedCollaborators);
                foreach ($seperatedCollaborators as $collaborator ){
                    //prepare statement to insert into DB company name and UEN to
                    $updateCollaborator = "INSERT INTO userManageAccount(account_UEN, account_user_username, user_username, user_role_id)
                                       VALUES ('".$edituen."', '".$userID."', '".$collaborator."', '3')";
                    $updateSql = $DB_con->prepare($updateCollaborator);

                    echo $updateCollaborator . "<br>";

                    $updateSql->execute();
                }
                
//                $collaboratorsql = "INSERT INTO userManageAccount(account_UEN, account_user_username, user_username, user_role_id) VALUES ";
//                for ($i = 0; $i < count($seperatedCollaborators); $i++){
//                    //prepare statement to insert into DB company name and UEN to
//                    if ($i > 0){
//                      $collaboratorsql .= " , ";
//                    }
//                    $collaboratorsql .= "('".$selectuen."','".$userID."','".$seperatedCollaborators[$i]."','3')";
//                }
//                $collaboratorsql .= ";";
//                $insertsql = $DB_con->prepare($collaboratorsql);
//                $insertsql->execute();
                
                echo '<div class="alert alert-success" role="alert">'
                        . '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>'
                        . ' Account Manager(s) successfully changed'
                    . '</div>';
                echo '<span class="text-success"><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Redirecting please wait</span>';
                echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/all_work_account.php'> ";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

//            } else {
//                echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $collaboratorsql . '<br>' . $DB_con->error . '</div>';
//            }
        }


//        header('Location: manage_work_account.php');
    }
}
?>
