<?php
require_once '../db_connection/db.php';
define('URL', '');
ob_start();
require_once __DIR__ . '\..\..\vendor\autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//query for data
$vari = $_POST['generalSearch'];
$exportquery = "SELECT username, companyName, email FROM user WHERE role_id=2 AND (username LIKE '%".$vari."%' OR companyName LIKE '%".$vari."%' OR email LIKE '%".$vari."%')";
$stmt=$DB_con->prepare($exportquery);
$stmt->execute();

while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $rows[] = array_values($result);
}
array_unshift($rows , ['Client Username','Company Name','Email']);

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
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Client Accounts.xlsx"');

$writer->save('Client Accounts.xlsx');
$writer->save("php://output");
header("Location: " . URL . "download_export_super_dash.php"); /* Redirect browser */
ob_end_flush();
?>
