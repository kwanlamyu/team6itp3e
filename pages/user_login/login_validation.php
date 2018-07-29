<?php 
/* login page validation
 * Author: Jerome Augustine Rodrigues, Singapore Institute of Technology
 * 
 * validates login page form data via POST method and redirect to dashboard 
 */
?>

<?php
require_once '../db_connection/db.php';
$unameErr = $passErr = $loginErr = "";
$uname = $pass = "";
$valid = TRUE;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['m_login_signin_submit'])) {

        if (empty($_POST["username"])) {
            $unameErr = "* User name is required";
            $valid = FALSE;
        } else {
            $uname = $_POST['username'];
        }

        if (empty($_POST["password"])) {
            $passErr = "* Password is required";
            $valid = FALSE;
        } else {
            $pass = $_POST['password'];
        }

        if ($valid == TRUE) {
            $sql = "SELECT username, role_id, password, companyName FROM user WHERE username = '" . $uname . "'";
            $query = $DB_con->prepare($sql);
            $query->execute();
            $data = $query->fetchAll();
            
            if(count($data) == 0){
                $unameErr = "Account invalid";
                $passErr = "Password invalid";
            }

            foreach ($data as $userData) {
                $uname = $userData['username'];
                $hash = $userData['password'];
                $role_id = $userData['role_id'];
                $companyName = $userData['companyName'];
                
                //password decrypting
                if (password_verify($pass, $hash)) {
                    $_SESSION['username']=$uname;
                    $_SESSION['role_id']=$role_id;
                    $_SESSION['company']=$companyName;
                    
                    //check appropriate role and re-direct to assigned dashboards
                    if ($role_id == '1') {
                        //redirect to Super Admin Dash
                        echo "<meta http-equiv='refresh' content='3;url=../user_super_admin/super_admin_dashboard.php'> ";
                        echo '<span class="text-success "><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Welcome '.$uname.' please wait</span>';

                    } elseif ($role_id == '2') {
                        //redirect to Client Admin Dash
                        echo "<meta http-equiv='refresh' content='3;url=../user_client_admin/client_admin_dashboard.php'> ";
                        echo '<span class="text-success "><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Welcome '.$uname.' please wait</span>';

                        } elseif ($role_id == '3') {
                        //redirect to Accountant Dash
                        echo "<meta http-equiv='refresh' content='3;url=../user_accountant/accountant_dashboard.php'> ";
                        echo '<span class="text-success "><span class="fa fa-pulse fa-spinner fa-spin fa-fw fa-lg" aria-hidden="true"></span> Welcome '.$uname.' please wait</span>';

                    } else {
                        echo"User type not found";
                        //Display error message to contact System Admin
                    }
                } else {
                    $passErr = "Password invalid";
                }
            }
        }
    }
}
?>
