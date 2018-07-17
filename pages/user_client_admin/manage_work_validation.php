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
            
            $selectCollaborators =$_POST["select_Collaborator"];
            $selected="";
            
            foreach($selectCollaborators as $collaborator){
                $selected .=$selectCollaborators.",";
            }
            echo $selected."<br>";
        }
        
        
        
        //$userID = $_SESSION["username"];
        //$roleID = $_SESSION["role_id"];
        $userID = "Jerome";
        $roleID = "2";
        echo "username: ".$userID."<br>";
        echo "role ID: ".$roleID."<br>";
        echo gettype($valid).'<br>';
        
        if ($valid == TRUE) {
//            $hashpass = SHA1($pass);
//            $hashcpass = SHA1($cpass);
//            
            //prepare statement to insert into DB company name and UEN to
            $collaboratorsql = "INSERT INTO userManageAccount(account_UEN, account_user_username, user_username, user_role_id)
                               VALUES ('".$selectuen."', '".$selected."', '".$userID."', '".$roleID."')";
            $insertsql = $DB_con->prepare($collaboratorsql);
            echo $collaboratorsql;
//            if ($accountSql->execute()) {
//                echo "after sql execute";
//                echo '<div class="alert alert-success" role="alert">'
//                        . '<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close"></a>'
//                        . ' Account successfully created'
//                    . '</div>';
//                echo '<span class="text-success"><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Redirecting please wait</span>';
//                echo "<meta http-equiv='refresh' content='3;url=manage_work_account.php'> ";
//               
//                        
//            } else {
//                echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $connection->error . '</div>';
//            }
        }
        
        
        header('Location: manage_work_account.php'); 
    }
}
?>
