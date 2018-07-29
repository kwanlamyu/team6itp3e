
<?php require_once '../db_connection/db.php';?>
<?php
$vari = $_POST['generalSearch'];
$stmt=$DB_con->prepare("SELECT username, companyName, email FROM user WHERE role_id=2 AND (username LIKE '%".$vari."%' OR companyName LIKE '%".$vari."%' OR email LIKE '%".$vari."%')");
$stmt->execute();
 
 
$columnHeader ='';
$columnHeader = "Username"."\t"."Company Name"."\t"."Email"."\t";
 
 
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
header("Content-Disposition: attachment; filename=Companies.xls");
header("Pragma: no-cache");
header("Expires: 0");
 
echo ucwords($columnHeader)."\n".$setData."\n";
 
?>