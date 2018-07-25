<?php
require_once '../db_connection/db.php';
if (isset($_SESSION['username']) || isset($_SESSION['role_id']) || isset($_SESSION['company'])){
    if ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3){
      header("Location: ../user_login/login.php");
    } else {
include '../general/header.php';
include '../general/navigation_accountant.php';
require_once __DIR__ . '\..\..\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

// use PhpOffice\PhpSpreadsheet\Reader\Csv;
// can change to read csv file as well
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
// only read data
$reader->setReadDataOnly(true);

// -----------------------------------------------------------------------------
$query = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
$query->bindParam(':companyName', $_SESSION['companyName']);
$query->bindParam(':clientName', $_POST['clientCompany']);
$query->execute();

$result = $query->setFetchMode(PDO::FETCH_ASSOC);
$result = $query->fetchAll();

$mainQuery = $DB_con->prepare("SELECT * FROM main_category WHERE company_name =:companyName AND client_company = :clientName");
$mainQuery->bindParam(':companyName', $_SESSION['companyName']);
$mainQuery->bindParam(':clientName', $_POST['clientCompany']);
$mainQuery->execute();

$mainResult = $mainQuery->setFetchMode(PDO::FETCH_ASSOC);
$mainResult = $mainQuery->fetchAll();

$mainAccountArrayDB = array();
for ($i = 0; $i < count($mainResult); $i++) {
    array_push($mainAccountArrayDB, $mainResult[$i]['main_account']);
}

$subAccountArrayDB = array();
for ($i = 0; $i < count($result); $i++) {
    array_push($subAccountArrayDB, $result[$i]['sub_account']);
}

$companyName = $_SESSION['companyName'];
$clientName = $_POST['clientCompany'];
$fileArray = $_POST['fileArray'];
$dateStart = $_POST['dateStart'];
$dateEnd = $_POST['dateEnd'];
$clientUEN = $_POST['clientUEN'];

$originalValue = $_POST['originalValue'];
$inputCategory = $_POST['category'];
$accountValue = $_POST['accountValue'];

$tempStoreArray = array();
$categoryTempArray = array();
$temp = array();

//store sub category that haven't store into the Main category database
$tempSubArray = array();

for ($i = 0; $i < count($originalValue); $i++) {
    if ($originalValue[$i] != $inputCategory[$i]) {
        if ($originalValue[$i] == "") {
            for ($j = 0; $j < count($result); $j++) {
                if ($inputCategory[$i] == $result[$j]['sub_account']) {
                    if (!empty($categoryTempArray)) {
                        if (in_array($inputCategory[$i], array_keys($categoryTempArray))) {
                            foreach ($categoryTempArray as $key => $array) {
                                if ($key == $inputCategory[$i]) {
                                    array_push($array, $accountValue[$i]);
                                    $categoryTempArray[$inputCategory[$i]] = $array;
                                }
                            }
                        } else {
                            array_push($tempStoreArray, $result[$j]['account_names']);
                            array_push($tempStoreArray, $accountValue[$i]);
                            $categoryTempArray[$inputCategory[$i]] = $tempStoreArray;
                        }
                    } else {
                        array_push($tempStoreArray, $result[$j]['account_names']);
                        array_push($tempStoreArray, $accountValue[$i]);
                        $categoryTempArray[$inputCategory[$i]] = $tempStoreArray;
                    }
                }
            }
        } else {
            for ($j = 0; $j < count($result); $j++) {
                if ($inputCategory[$i] == $result[$j]['sub_account']) {
                    if (!empty($categoryTempArray)) {
                        if (in_array($inputCategory[$i], array_keys($categoryTempArray))) {
                            foreach ($categoryTempArray as $key => $array) {
                                if ($key == $inputCategory[$i]) {
                                    array_push($array, $accountValue[$i]);
                                    $categoryTempArray[$key] = $array;
                                }
                            }
                        } else {
                            array_push($tempStoreArray, $result[$j]['account_names']);
                            array_push($tempStoreArray, $accountValue[$i]);
                            $categoryTempArray[$inputCategory[$i]] = $tempStoreArray;
                        }
                    } else {
                        array_push($tempStoreArray, $result[$j]['account_names']);
                        array_push($tempStoreArray, $accountValue[$i]);
                        $categoryTempArray[$inputCategory[$i]] = $tempStoreArray;
                    }
                }

                if (strpos($result[$j]['account_names'], $accountValue[$i]) !== false) {
                    $foundAccount = $result[$j]['account_names'];
                    $replacedString = str_replace($accountValue[$i], '', $result[$j]['account_names']);
                    array_push($temp, trim($replacedString));
                    $categoryTempArray[$result[$j]['sub_account']] = $temp;
                }
            }
        }

        // For those category not added into Main
        for ($j = 0; $j < count($result); $j++) {
            if (!in_array($inputCategory[$i], $subAccountArrayDB)) {
                array_push($tempSubArray, $inputCategory[$i]);
                break;
            }
        }
    }
    unset($tempStoreArray);
    $tempStoreArray = array();
}

if (!empty($categoryTempArray)) {
    foreach ($categoryTempArray as $category => $array) {
        $uniqueArray = array_unique($array);
        $implode = implode(",", $uniqueArray);

        $update = "UPDATE sub_category SET account_names= '" . $implode . "' WHERE sub_account= '" . $category . "' AND company_name = '" . $_SESSION['companyName'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
        $stmt = $DB_con->prepare($update);
        $stmt->execute();
    }
} else {
//    header('Location: updateCategoriesMain.php');
}
?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">
                    Financial Statement
                </h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="#" class="m-nav__link m-nav__link--icon">
                            <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Generate Report
                            </span>
                        </a>
                    </li>
                    <li class="m-nav__separator">
                        -
                    </li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">
                                Financial Statement
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--begin::Portlet-->
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Update Main Categories
                                </h3>
                            </div>
                        </div>
                    </div>
                    <form method="post" name="updateCategoryForm" action="updateCategoriesMain.php" onsubmit="return check()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                        <?php
                        // change this line please omg
                        echo "Please choose which Main Category it belongs to! <br><br>";

                        for ($i = 0; $i < count($tempSubArray); $i++) {
                            echo "<b>Current Sub Account: </b>" . $tempSubArray[$i] . "<Br>";
                            echo "<select name='main[]'>";
                            for ($j = 0; $j < count($mainAccountArrayDB); $j++) {
                                echo "<option value='" . $mainAccountArrayDB[$j] . "'>" . $mainAccountArrayDB[$j] . "</option>";
                            }
                            echo "</select>";
                            echo "<hr>";
                        }

                        foreach ($tempSubArray as $v) {
                            echo "<input type='hidden' name='subAccount[]' value='" . $v . "'/>";
                        }

                        foreach ($dateStart as $value) {
                            echo "<input type='hidden' name='dateStart[]' value='" . $value . "'/>";
                        }

                        foreach ($dateEnd as $value) {
                            echo "<input type='hidden' name='dateEnd[]' value='" . $value . "'/>";
                        }

                        foreach ($fileArray as $value) {
                            echo "<input type='hidden' name='fileArray[]' value='" . $value . "'/>";
                        }
                        ?>

                        <input type="hidden" name="clientCompany" value="<?php echo $clientName; ?>"/>
                        <input type="hidden" name="companyName" value="<?php echo $companyName; ?>"/>
                        <input type="hidden" name="clientUEN" value="<?php echo $clientUEN; ?>"/>

                        <input type="submit" value="Submit" name="submit" class="btn btn-brand">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Portlet-->
</div>
<!-- END: Subheader -->
<?php
}
} else {
header("Location: ../user_login/login.php");
}
 ?>

<?php include '../general/footer_content.php'; ?>
<?php include '../general/footer.php'; ?>

<script type="text/javascript">

    function check() {

        var allAccountCount = <?php echo count($allAccounts); ?>;

        for (i = 0; i < allAccountCount; i++) {
            if (document.getElementById('category' + i).value === "") {
                alert('Please fill in all fields.');
                return false;
            }
        }

        return true;
    }

</script>
