<?php 
/* 
 * back-end code for tagging accountants to company accounts
 */
?>


<?php
require_once '../db_connection/db.php';
$uname = $selectuen = $selected= $selectCollaborators="";
$valid = TRUE; //this var scope ok
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['manageWorkButton'])) {

        if (empty($_POST["select_uen"])) {

            $valid = FALSE;

        } else{

            $selectuen =($_POST["select_uen"]);

        }

        if (empty($_POST["select_Collaborator"])) {
            $selected = "";

        } else{

            $selectCollaborators = implode(',', $_POST['select_Collaborator']);
        }



        $userID = $_SESSION["username"];

        if ($valid == TRUE) {
            try{
                $seperatedCollaborators = explode(',', $selectCollaborators);
                $collaboratorsql = "INSERT INTO userManageAccount(account_UEN, account_user_username, user_username, user_role_id) VALUES ";
                for ($i = 0; $i < count($seperatedCollaborators); $i++){
                    //prepare statement to insert into DB company name and UEN to
                    if ($i > 0){
                      $collaboratorsql .= " , ";
                    }
                    $collaboratorsql .= "('".$selectuen."','".$userID."','".$seperatedCollaborators[$i]."','3')";
                }
                $collaboratorsql .= ";";
                $insertsql = $DB_con->prepare($collaboratorsql);
                $insertsql->execute();

                echo '<div class="alert alert-success" role="alert">'
                        . '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>'
                        . ' Account Manager(s) successfully added'
                    . '</div>';
                echo '<span class="text-success"><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Redirecting please wait</span>';
                echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/client_admin_dashboard.php'> ";
            }catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
?>
