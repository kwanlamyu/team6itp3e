<?php
session_start();

$DBHOST = 'localhost';
$DBNAME = 'itp-3E Accounting';
$DBUSER = 'root';
$DBPASS = '';

try{
    $DB_con = new PDO("mysql:host=$DBHOST;port=8889;dbname=$DBNAME",$DBUSER,$DBPASS);
    $DB_con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo $e->getMessage();
}
//$connection = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
//
//if (!$connection) {
//    die(mysqli_connect_error($connection));
//}
////echo 'connection successful';