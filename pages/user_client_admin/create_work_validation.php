<?php 
/* 
 * back-end code to verify registration of a new company account
 */
?>

<?php
require_once '../db_connection/db.php';
$unameErr = $companynameErr = $uennumberErr = $filenumberErr="";
$uname = $companyname = $uen = $filenumber="";
$valid = TRUE; //this var scope ok
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['createWorkButton'])) {

        if (empty($_POST["companyname"])) {
            $companynameErr = "* Company Name is required";
            $valid = FALSE;
        } else{
            $companyname =($_POST["companyname"]);
        }

        $uenregex = '/^(\d{9}[a-zA-Z \-_])|((18|19|20)\d{2}\d{6}[a-zA-z \-_])|((T|S|R)\d{2}(LP|LL|FC|PF|RF|MQ|MM|NB|CC|CS|MB|FM|GS|GA|GB|DP|CP|NR|CM|CD|MD|HS|VH|CH|MH|CL|XL|CX|RP|TU|TC|FB|FN|PA|PB|SS|MC|SM)\d{4}[a-zA-Z \-_])$/';
        if (empty($_POST["uennumber"])) {
            $uennumberErr = "* UEN/ACRA No. is required";
            $valid = FALSE;
        } else{
            $uen = ($_POST["uennumber"]);
            if (!preg_match($uenregex, $uen)){
                $uennumberErr = "* Invalid UEN/ACRA format/number";

                $valid = FALSE;

            }
            $query = "SELECT COUNT(*) FROM account WHERE UEN = '" . $uen . "'";
            $result = $DB_con->query($query);

            if ($result->fetchColumn() > 0) {
                $uennumberErr = "* UEN Exists in Database";
                $valid = FALSE;
            }

        }

        $uname = $_SESSION["username"];

        if ($valid == TRUE) {
//
            //prepare statement to insert into DB company name and UEN to
            $managesql = "INSERT INTO account(UEN, companyName, fileNumber, dateOfCreation, user_username)
                               VALUES ('$uen', '$companyname', '000000', NOW(), '$uname')";
            $accountSql = $DB_con->prepare($managesql);
            
            if ($accountSql->execute()) {
                $successMessage = "Account has been registered successfully."; 
                echo '<span class="text-success"><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Redirecting Please Wait</span>';
                echo "<meta http-equiv='refresh' content='3;url=manage_work_account.php'> ";
                $collaboratorsql = "INSERT INTO userManageAccount(account_UEN, account_user_username, user_username, user_role_id) VALUES ('$uen','$uname','$uname','2');";
                $insertsql = $DB_con->prepare($collaboratorsql);
                $insertsql->execute();
                
            } else {
                echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $DB_con->error . '</div>';
            }
        }
    }
}
?>
