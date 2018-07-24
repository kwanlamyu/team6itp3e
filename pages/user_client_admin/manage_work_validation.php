<?php
require_once '../db_connection/db.php';
$uname = $selectuen = $selected= $selectCollaborators="";
$valid = TRUE; //this var scope ok
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['manageWorkButton'])) {
        echo "post reg button <br>";

        if (empty($_POST["select_uen"])) {

            $valid = FALSE;

        } else{

            $selectuen =($_POST["select_uen"]);

        }

        if (empty($_POST["select_Collaborator"])) {
            $selected = "";
            //$valid = FALSE;

        } else{

//            $selectCollaborators =$_POST["select_Collaborator"];
            $selectCollaborators = implode(',', $_POST['select_Collaborator']);
//            $selected="";
//
//            foreach($selectCollaborators as $collaborator){
//                $selected .=$selectCollaborators.",";
//            }
            echo "Manager(s): ".$selectCollaborators."<br>";
        }



        $userID = $_SESSION["username"];
//        $roleID = $_SESSION["role_id"];
//        $userID = "Jerome";
        echo "username: ".$userID."<br>";
        echo gettype($valid).'<br>';

        if ($valid == TRUE) {
//            $hashpass = SHA1($pass);
//            $hashcpass = SHA1($cpass);
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
                echo "<meta http-equiv='refresh' content='3;url=client_admin_dashboard.php'> ";
            }catch (PDOException $e) {
                echo $e->getMessage();
            }
        }


//        header('Location: manage_work_account.php');
    }
}
?>
