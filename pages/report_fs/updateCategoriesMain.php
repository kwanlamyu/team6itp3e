<?php

require_once '../db_connection/db.php';
if (isset($_SESSION['username']) || isset($_SESSION['role_id']) || isset($_SESSION['company'])){
    if ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3){
      header('Location: ../user_super_admin/userdashboard.php');
    } else {
      if (!isset($_POST['companyName'])){
        header("Location: fs_index.php");
      } else {
$mainCategory = $_POST['main'];
$subCategory = $_POST['subAccount'];

$companyName = $_SESSION['companyName'];
$clientName = $_POST['clientCompany'];
$fileArray = $_POST['fileArray'];
$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];
$clientUEN = $_POST['clientUEN'];

$query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name =:companyName AND client_company = :clientName");
$query->bindParam(':companyName', $_SESSION['companyName']);
$query->bindParam(':clientName', $_POST['clientCompany']);
$query->execute();

$result = $query->setFetchMode(PDO::FETCH_ASSOC);
$result = $query->fetchAll();

$tempAccountNameArray = array();
$tempArray = array();

for ($i = 0; $i < count($result); $i++) {
    for ($j = 0; $j < count($mainCategory); $j++) {
        if ($result[$i]['main_account'] == $mainCategory[$j]) {

            if (empty($tempArray)) {
                array_push($tempAccountNameArray, $result[$i]['account_names']);
                array_push($tempAccountNameArray, $subCategory[$j]);
                $tempArray[$mainCategory[$j]] = $tempAccountNameArray;
            } else {
                if (in_array($mainCategory[$j], array_keys($tempArray))) {
                    foreach ($tempArray as $key => $array) {
                        if ($key == $mainCategory[$j]) {
                            array_push($array, $subCategory[$j]);
                            $tempArray[$mainCategory[$j]] = $array;
                        }
                    }
                } else {
                    array_push($tempAccountNameArray, $result[$i]['account_names']);
                    array_push($tempAccountNameArray, $subCategory[$j]);
                    $tempArray[$mainCategory[$j]] = $tempAccountNameArray;
                }
            }


//            $update = "UPDATE main_category SET account_names= '" . $accountNames . "' WHERE main_account = '" . $mainCategory[$j] . "' AND company_name = '" . $_SESSION['companyName'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
//            $stmt = $DB_con->prepare($update);
//            $stmt->execute();
        }
        unset($tempAccountNameArray);
        $tempAccountNameArray = array();
    }
}

if (!empty($tempArray)) {
    foreach ($tempArray as $category => $array) {
//        $uniqueArray = array_unique($array);
        $implode = implode(",", $array);

        $update = "UPDATE main_category SET account_names= '" . $implode . "' WHERE main_account = '" . $category . "' AND company_name = '" . $_SESSION['companyName'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
        $stmt = $DB_con->prepare($update);
        $stmt->execute();
    }
} else {
//    header('Location: updateCategoriesMain.php');
}

}
}
} else {
header("Location: ../user_login/login.php");
}

print_r($tempArray);
?>
