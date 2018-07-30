
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
$columnHeader = "<table border='1'><tr><th align='left'>Company UEN</th><th align='left'>Company Name</th><th align='left'>Account Manager(s)</th></tr>";

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
  $rowData = "<tr>";
  foreach($rec as $value)
  {
    $rowData .= "<td align='left'>" . $value . "</td>";
  }
  $rowData .= "</tr>";
}

echo $columnHeader;
$rowData .= "</table>";

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Type: application/force-download");
header("Content-Type: application/octet-stream");
header("Content-Type: application/download");;
header("Content-Disposition: attachment;filename=CompanyAccounts.xlsx");
header("Content-Transfer-Encoding: binary ");

echo $rowData;

$dropquery = "DROP VIEW work_clients";
$dropstmt=$DB_con->prepare($dropquery);
$dropstmt->execute();

?>
