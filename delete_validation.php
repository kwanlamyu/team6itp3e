<?php

require_once 'db.php';
$uname = $email = $pass = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['deleteButton'])) {

//        echo "post update button <br>";

        $uname = ($_POST["accountantid"]);
//        echo 'Username: ' . $uname . ' <br>';

        $email = ($_POST["accountantemail"]);
//        echo 'Email: ' . $email . '<br>';

        $pass = ($_POST["accountantpassword"]);
//        echo 'Password: ' . $pass . '<br>';

//        $sql = "DELETE FROM user WHERE username='$uname' AND role_id=3";

//        $statement = $DB_con->prepare($sql);

//        echo $sql.'<br>';
//        echo $email.'<br>';
//        echo $uname.'<br>';

        try {
            
        $sql = "DELETE FROM user WHERE username='$uname' AND role_id=3";
        $statement = $DB_con->prepare($sql);
        $statement->execute();
        
        echo'
            <body>
                <div class="row">
                    <div class"card">
                        <div class="card-body">
                            <h2>Success</h2><hr>
                            <p>Accountant account successfully deleted</p><br>
                            <p><a href="delete_accountant.php">Delete another account</a></p><br>
                            <p><a href="client_dashboard.php">Return to dashboard</a></p>
                        </div>
                    </div>
                </div>
            <body>
        ';
        
        
        } catch (PDOException $e) {
            
            echo $sql . "<br>" . $e->getMessage();
            
        }



//        if ($statement->execute()) {
////                echo "after sql execute <br>";
//            echo "account successfully deleted";
//        } else {
//            echo '<div class="alert alert-warning mmbsm" role="alert">Error: ' . $sql . '<br>' . $DB_con->error . '</div>';
//        }

        header('Location: delete_accountant.php');
    }
}
?>
