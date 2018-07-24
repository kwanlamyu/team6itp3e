<?php
require_once '../db_connection/db.php';
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
                // means not in the main category yet 
                else {
                    // auto add in to the main ?? 
//                    array_push($tempSubArray, $inputCategory[$i]);
                }
            }
//        } else {
//            for ($j = 0; $j < count($result); $j++) {
//                if (in_array($inputCategory[$i], $categoryTempArray)) {
//                    foreach ($categoryTempArray as $key => $array) {
//                        // for updating the new rows
//                        if ($key == $result[$j]['sub_account']) {
//                            if (!empty($tempStoreArray)) {
//                                for ($k = 0; $k < count($tempStoreArray); $k++) {
//                                    if (strpos($tempStoreArray[$k], $result[$j]['account_names']) !== false) {
//                                        array_push($array, $accountValue[$i]);
//                                        $categoryTempArray[$key] = $array;
//                                    } else {
//                                        array_push($array, $result[$j]['account_names']);
//                                        array_push($array, $accountValue[$i]);
//                                        $categoryTempArray[$key] = $array;
//                                    }
//                                }
//                            } else {
//                                array_push($array, $result[$j]['account_names']);
//                                array_push($array, $accountValue[$i]);
//                                $categoryTempArray[$key] = $array;
//                            }
//                        }
//                        // means not in the main category yet 
//                        else {
//                        // array_push($tempSubArray, $inputCategory[$i]);
//                        }
//                    }
//                }
//                // just create a new entry 
//                else {
//                    // for updating the new rows
//                    if ($inputCategory[$i] == $result[$j]['sub_account']) {
//                        if (!empty($tempStoreArray)) {
//                            for ($k = 0; $k < count($tempStoreArray); $k++) {
//                                if (strpos($tempStoreArray[$k], $result[$j]['account_names']) !== false) {
//                                    array_push($tempStoreArray, $accountValue[$i]);
//                                    $categoryTempArray[$inputCategory[$i]] = $tempStoreArray;
//                                } else {
//                                    array_push($tempStoreArray, $result[$j]['account_names']);
//                                    array_push($tempStoreArray, $accountValue[$i]);
//                                    $categoryTempArray[$inputCategory[$i]] = $tempStoreArray;
//                                }
//                            }
//                        } else {
//                            array_push($tempStoreArray, $result[$j]['account_names']);
//                            array_push($tempStoreArray, $accountValue[$i]);
//                            $categoryTempArray[$inputCategory[$i]] = $tempStoreArray;
//                        }
//                    }
//                    // means not in the main category yet 
//                    else {
////                        array_push($tempSubArray, $inputCategory[$i]);
//                    }
//                }
            // for updating the current rows, delete away the existing one
//                if (strpos($result[$j]['account_names'], $accountValue[$i]) !== false) {
//                    $foundAccount = $result[$j]['account_names'];
//                    $replacedString = str_replace($accountValue[$i], '', $result[$j]['account_names']);
//                    array_push($temp, $replacedString);
//                    $categoryTempArray[$result[$j]['sub_account']] = $temp;
//                }
        }
    }
         unset($tempStoreArray);
            $tempStoreArray = array();
}
//}

if (!empty($categoryTempArray)) {
    foreach ($categoryTempArray as $category => $array) {
        $uniqueArray = array_unique($array);
        $implode = implode(",", $uniqueArray);

        $update = "UPDATE sub_category SET account_names= '" . $implode . "' WHERE sub_account= '" . $category . "' AND company_name = '" . $_SESSION['companyName'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
        $stmt = $DB_con->prepare($update);
        $stmt->execute();
    }
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


                    <?php
//                    echo "<hr> Haven't add into Main de category <hr>";
//                    print_r($tempSubArray);
                    echo "<hr> Category <hr>";
                    print_r($categoryTempArray);
                    echo "<hr> account <hr>";
                    print_r($accountValue);
                    echo "<hr> original category <hr>";
                    print_r($originalValue);
                    echo "<hr> input category value <hr>";
                    print_r($inputCategory);
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Portlet-->
</div>
<!-- END: Subheader -->


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