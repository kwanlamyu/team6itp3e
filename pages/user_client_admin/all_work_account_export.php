<?php
require_once '../db_connection/db.php';
// use this when live
// define('URL', 'https://3ecomply.com/');
define('URL', '');
ob_start();
require_once __DIR__ . '\..\..\vendor\autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//query for data
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

$query = "SELECT UEN,companyName,accountAccountants
FROM work_clients
WHERE
UEN LIKE '%".$vari."%'
OR companyName LIKE '%".$vari."%'
OR accountAccountants LIKE '%".$vari."%'";
$stmt = $DB_con->prepare($query);
$stmt->execute();
$rows = array();
$uniqueCompanies = array();
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $rows[] = array_values($result);
}

array_unshift($rows , ['Company UEN','Company Name','Accountant']);
//echo json_encode($rows);

$dropquery = "DROP VIEW work_clients";
$dropstmt=$DB_con->prepare($dropquery);
$dropstmt->execute();


//export to xlsx
$spreadsheet = new Spreadsheet();
$arrayData = $rows;
$spreadsheet->getActiveSheet()
    ->fromArray(
        $arrayData,  // The data to set
        NULL,        // Array values with this value will not be set
        'A1'         // Top left coordinate of the worksheet range where
                     //    we want to set these values (default is A1)
    );

$writer = new Xlsx($spreadsheet);

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
$writer->save('Company Accounts.xlsx');
$writer->save("php://output");
header("Location: " . URL . "download_export.php"); /* Redirect browser */
ob_end_flush();
?>
