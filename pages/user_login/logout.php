
<?php
/* logut function
 * Author: Jerome Augustine Rodrigues, Singapore Institute of Technology
 * 
 * function to load current session and destroy cookies saved.
 */
session_start();
session_destroy();
echo "<meta http-equiv='refresh' content='3;url=../user_login/login.php'>";
//header("Location: ../user_login/login.php");

exit;