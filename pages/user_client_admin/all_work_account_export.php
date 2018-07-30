
<?php require_once '../db_connection/db.php';?>
<?php

$vari = $_POST['generalSearch'];
$userID= $_SESSION['username'];
$exportquery = "CREATE VIEW work_clients AS
            SELECT
            account.UEN AS UEN,
            account.companyName AS companyName,
            account.user_username AS accountManagers,
            usermanageaccount.user_username AS accountAccountants
            FROM account
            INNER JOIN usermanageaccount
            ON account.UEN = usermanageaccount.account_UEN
            AND usermanageaccount.account_user_username = '".$userID."'
            AND usermanageaccount.user_role_id =3;";


$stmt=$DB_con->prepare($exportquery);

$stmt->execute();


$columnHeader ='';
$columnHeader = "Company UEN"."\t"."Company Name"."\t"."Account Manager(s)"."\t";

$query = "SELECT UEN,companyName,accountAccountants
FROM work_clients
WHERE
UEN LIKE '%".$vari."%'
OR companyName LIKE '%".$vari."%'
OR accountAccountants LIKE '%".$vari."%'";
$stmt = $DB_con->prepare($query);
$stmt->execute();

$setData='';

while($rec =$stmt->FETCH(PDO::FETCH_ASSOC))
{
  $rowData = '';
  foreach($rec as $value)
  {
    $value = '"' . $value . '"' . "\t";
    $rowData .= $value;
  }
  $setData .= trim($rowData)."\n";
}

echo ucwords($columnHeader)."\n".$setData."\n";
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=CompanyAccounts.xls");
header("Pragma: no-cache");
header("Expires: 0");

$dropquery = "DROP VIEW work_clients";
$dropstmt=$DB_con->prepare($dropquery);
$dropstmt->execute();

?>
