
<?php require_once '../db_connection/db.php';?>
<?php
$vari = $_POST['generalSearch'];
$userID= $_SESSION['username'];
$exportquery = "CREATE VIEW work_clients AS
            SELECT 
            account.UEN AS UEN,
            account.companyName AS companyName,
            usermanageaccount.user_username AS accountManagers,
            usermanageaccount.user_username AS accountAccountants
            FROM account
            INNER JOIN usermanageaccount
            ON account.UEN = usermanageaccount.account_UEN
            AND usermanageaccount.account_user_username = '".$userID."'
            AND usermanageaccount.user_role_id =3;

            SELECT UEN,companyName,accountManagers 
            FROM work_clients 
            WHERE (
            UEN LIKE '%".$vari."%'
            OR companyName LIKE '%".$vari."%'
            OR accountManagers LIKE '%".$vari."%')";

$stmt=$DB_con->prepare($exportquery);
	
$stmt->execute();
 
 
$columnHeader ='';
$columnHeader = "Company UEN"."\t"."Company Name"."\t"."Account Manager(s)"."\t";
 
 
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
 
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=CompanyAccounts.xls");
header("Pragma: no-cache");
header("Expires: 0");
 
echo ucwords($columnHeader)."\n".$setData."\n";
 
?>