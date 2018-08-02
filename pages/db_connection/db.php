<?php
session_start();

$DBHOST = 'localhost';
$DBNAME = 'ecomplyc_itp';
$DBUSER = 'root';
$DBPASS = '';

try{
   $DB_con = new PDO("mysql:host=$DBHOST;port=3306;dbname=$DBNAME",$DBUSER,$DBPASS);
   $DB_con ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
   echo $e->getMessage();
}
?>
