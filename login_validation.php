<?php
require_once 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $DB_con->prepare("SELECT username, role_id, password FROM user WHERE username = '".$username."' AND password = '".$password."'");
$query->execute();
$data = $query->fetchAll();

echo "hello world";
echo "<br>";
foreach ($data as $userData) {
//    echo $userData['username'];
//    echo "<br>";
//    echo $userData['password'];
//}
//$query = "SELECT * FROM user WHERE username = '".$username."'";
//$query = "select count(1) from user";
//$result = mysqli_query($connection, $query);
//$row = mysql_fetch_array($result);
//
//echo'after fetch array';
//$total = $row[0];
//echo "total rows: " .$total;
//echo $row['username'];
//if (mysqli_num_rows($result) > 0) {
//    // output data of each row
//    while($row = mysqli_fetch_assoc($result)) {
//        echo "Username: " . $row["username"]. " - Email: " . $row["email"]. " - Password: " . $row["password"]." - Role ID: " . $row["role_id"];
//    }
//} else {
//    echo "0 results";
//}
    if (($userData['username']==$username)) {
        echo'login sucessful';
        echo'<br>';
        if($userData['role_id']=='1'){
            echo'Welcome Super Admin';
        }
        elseif($userData['role_id']=='2'){
            echo'Welcome Client Admin';
        }
        elseif($userData['role_id']=='3'){
            echo'Welcome Standard User';
        }
        else{
            echo'User type not found';
        }

    }
//elseif (($row['username']==$username) && ($row['password']!=$password)) {
//    
//    echo '<div class="alert alert-danger mtmd" role="alert">Password invalid!</div>';
//    
//}
    else {
    
    echo '<div class="alert alert-danger mtmd" role="alert">Account invalid!</div>';
    
    }
}
?>