<?php
// // /*
 // // * Jerome local DB
 // // */
session_start();

$DBHOST = 'localhost';
$DBNAME = 'ecomplyc_itp';
$DBUSER = 'root';
$DBPASS = '';

try{
     $DB_con = new PDO("mysql:host=$DBHOST;port=8889;dbname=$DBNAME",$DBUSER,$DBPASS);
     $DB_con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}


// ?>

<?php
//
//// Phoebe local DB
////session_start();
//
// $DB_host = "localhost";
// $DB_user = "root";
// $DB_pass = "";
// $DB_name = "kokhoe";
//
// try {
//     $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
//     $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }
//?>

<?php
//
//// Phoebe local DB
////session_start();
//
//$DB_host = "localhost";
//$DB_user = "root";
//$DB_pass = "";
//$DB_name = "itp";
//
//try {
//    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}", $DB_user, $DB_pass);
//    $DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch (PDOException $e) {
//    echo $e->getMessage();
//}
?>

<?php
/*
 * joey local DB
 */
//session_start();
//
//$DBHOST = 'localhost';
//$DBNAME = 'ecomplyc_itp';
//$DBUSER = 'root';
//$DBPASS = '';
//
//try{
//   $DB_con = new PDO("mysql:host=$DBHOST;port=3306;dbname=$DBNAME",$DBUSER,$DBPASS);
//   $DB_con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//}
//catch(PDOException $e){
//   echo $e->getMessage();
//}


?>
