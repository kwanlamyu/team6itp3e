
<?php require_once '../db_connection/db.php';?>
<?php
$vari = $_POST['generalSearch'];
$userID= $_SESSION['username'];
$stmt=$DB_con->prepare("SELECT UEN, companyName,fileNumber,accountManagers 
FROM (account.UEN AS UEN,
	account.companyName AS companyName,
	account.fileNumber AS fileNumber,
	usermanageaccount.user_username
	AS accountManagers,
	usermanageaccount.user_username
	AS accountAccountants
	FROM account
	INNER JOIN usermanageaccount
	ON account.UEN = usermanageaccount.account_UEN
	AND usermanageaccount.account_user_username = '$userID'
	AND usermanageaccount.user_role_id =3) AND (UEN LIKE '%".$vari."%' OR companyName LIKE '%".$vari."%' OR fileNumber LIKE '%".$vari."%' OR accountManagers LIKE '%".$vari."%')");
	
$stmt->execute();
 
 
$columnHeader ='';
$columnHeader = "Company UEN"."\t"."Company Name"."\t"."File Number"."\t"."Account Manager(s)"."\t";
 
 
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
header("Content-Disposition: attachment; filename=CompanyAccounts.xlsx");
header("Pragma: no-cache");
header("Expires: 0");
 
echo ucwords($columnHeader)."\n".$setData."\n";
 
?>