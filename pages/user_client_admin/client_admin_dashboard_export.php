<?php
require_once '../db_connection/db.php';
define('URL', '');
ob_start();
require_once __DIR__ . '\..\..\vendor\autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

//query for data
$vari = $_POST['generalSearch'];
$userID= $_SESSION['username'];
$exportquery = "SELECT username, email FROM user WHERE role_id=3 AND companyName ='".$_SESSION['company']."' AND (username LIKE '%".$vari."%' OR email LIKE '%".$vari."%')";
$stmt=$DB_con->prepare($exportquery);
$stmt->execute();
$rows = array();
while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
  $rows[] = array_values($result);
}
array_unshift($rows , ['Username','Email']);

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
header('Content-Disposition: attachment; filename="All Accountants.xlsx"');

$writer->save('All Accountants.xlsx');
$writer->save("php://output");
header("Location: " . URL . "download_export_client_dash.php"); /* Redirect browser */
ob_end_flush();
?>
