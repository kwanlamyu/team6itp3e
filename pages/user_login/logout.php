
<?php
/* logut function
 * Author: Jerome Augustine Rodrigues, Singapore Institute of Technology
 * 
 * function to load current session and destroy cookies saved.
 */
session_start();

session_destroy();
header('Location: ../user_login/login.php');
exit;
