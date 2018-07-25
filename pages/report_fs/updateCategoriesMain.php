<?php
require_once '../db_connection/db.php';

$mainCategory = $_POST['main'];
$subCategory = $_POST['subAccount'];

$companyName = $_SESSION['companyName'];
$clientName = $_POST['clientCompany'];
$fileArray = $_POST['fileArray'];
$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];

$query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name =:companyName AND client_company = :clientName");
$query->bindParam(':companyName', $_SESSION['companyName']);
$query->bindParam(':clientName', $_POST['clientCompany']);
$query->execute();

$result = $query->setFetchMode(PDO::FETCH_ASSOC);
$result = $query->fetchAll();

for ($i = 0; $i < count($result); $i++) {
    for ($j = 0; $j < count($mainCategory); $j++) {
        if ($result[$i]['main_account'] == $mainCategory[$j]) {
            $accountNames = $result[$i]['account_names'] . "," . $subCategory[$j];

            $update = "UPDATE main_category SET account_names= '" . $accountNames . "' WHERE main_account = '" . $mainCategory[$j] . "' AND company_name = '" . $_SESSION['companyName'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
            $stmt = $DB_con->prepare($update);
            $stmt->execute();
        }
    }
}



?>