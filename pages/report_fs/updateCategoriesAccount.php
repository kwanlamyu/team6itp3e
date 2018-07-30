<?php
require_once '../db_connection/db.php';
require_once __DIR__ . '\..\..\vendor\autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
if (isset($_SESSION['username']) || isset($_SESSION['role_id']) || isset($_SESSION['company'])) {
    if ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3) {
        header('Location: ../user_super_admin/userdashboard.php');
    } else {
        if (!isset($_POST['clientCompany'])) {
            header("Location: fs_index.php");
        } else {
            include '../general/header.php';
            if ($_SESSION['role_id'] == 2) {
                include '../general/navigation_clientadmin.php';
            } else {
                include '../general/navigation_accountant.php';
            }
            // use PhpOffice\PhpSpreadsheet\Reader\Csv;
            // can change to read csv file as well
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            // only read data
            $reader->setReadDataOnly(true);
            $inputCategory = $_POST['category'];
            $originalValue = $_POST['originalValue'];
            $accountValue = $_POST['accountValue'];
            $allAccounts = $_POST['allAccounts'];
            $companyName = $_SESSION['companyName'];
            $clientName = $_POST['clientCompany'];
            $fileArray = $_POST['fileArray'];
            $dateStart = $_POST['dateStart'];
            $dateEnd = $_POST['dateEnd'];
            $clientUEN = $_POST['clientUEN'];
            $mainQuery = $DB_con->prepare("SELECT * FROM main_category WHERE company_name =:companyName AND client_company = :clientName");
            $mainQuery->bindParam(':companyName', $_SESSION['company']);
            $mainQuery->bindParam(':clientName', $_POST['clientCompany']);
            $mainQuery->execute();
            $result = $mainQuery->setFetchMode(PDO::FETCH_ASSOC);
            $result = $mainQuery->fetchAll();
            $mainAccountArrayDB = array();
            for ($i = 0; $i < count($result); $i++) {
                array_push($mainAccountArrayDB, $result[$i]['main_account']);
            }
            $tempStoreArray = array();
            $categoryTempArray = array();
            $temp = array();
            //store sub category that haven't store into the Main category database
            $tempSubArray = array();
            for ($i = 0; $i < count($originalValue); $i++) {
                if ($originalValue[$i] != $inputCategory[$i]) {
                    if ($originalValue[$i] == "") {
                        for ($j = 0; $j < count($result); $j++) {
                            if ($inputCategory[$i] == $result[$j]['main_account']) {
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
                            if ($inputCategory[$i] == $result[$j]['main_account']) {
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
                                $categoryTempArray[$result[$j]['main_account']] = $temp;
                            }
                        }
                    }
                    // For those category not added into Main
                    for ($j = 0; $j < count($result); $j++) {
                        if (!in_array($inputCategory[$i], $mainAccountArrayDB)) {
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
                    if (in_array($category, $mainAccountArrayDB)) {
                        $implode = implode(",", $array);
                        $update = "UPDATE main_category SET account_names= '" . $implode . "' WHERE main_account = '" . $category . "' AND company_name = '" . $_SESSION['company'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
                        $stmt = $DB_con->prepare($update);
                        $stmt->execute();
                    } else {
                        $implode = implode(",", $array);
                        $insert = "INSERT INTO main_category (company_name, client_company, sub_account, account_names)
                        VALUES ('" . $_SESSION['company'] . "', '" . $_POST['clientCompany'] . "', '" . $category . "' ,'" . $implode . "')";
                        // use exec() because no results are returned
                        $DB_con->exec($insert);
                    }
                }
            }
            ?>
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <div class="m-subheader ">
                    <div class="d-flex align-items-center">
                        <div class="mr-auto">
                            <h3 class="m-subheader__title">
                                Financial Statement
                            </h3>

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
                                                Update Categories
                                            </h3>
                                        </div>
                                    </div>
                                </div>


								<div class="m-portlet__body">
                                <?php
                                if (isset($allAccounts)) {
                                    try {
                                        echo "<span>Company: " . $_SESSION['company'] . "</span><br/>";
                                        echo "<span>Client: " . $clientName . "</span><br/> <hr/>";
                                        $accountQuery = $DB_con->prepare("SELECT * FROM account_category WHERE company_name =:companyName AND client_company = :clientName");
                                        $accountQuery->bindParam(':companyName', $_SESSION['company']);
                                        $accountQuery->bindParam(':clientName', $clientName);
                                        $accountQuery->execute();
                                        $result = $accountQuery->setFetchMode(PDO::FETCH_ASSOC);
                                        $result = $accountQuery->fetchAll();
                                        $subQuery = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
                                        $subQuery->bindParam(':companyName', $_SESSION['company']);
                                        $subQuery->bindParam(':clientName', $_POST['clientCompany']);
                                        $subQuery->execute();
                                        $subResult = $subQuery->setFetchMode(PDO::FETCH_ASSOC);
                                        $subResult = $subQuery->fetchAll();
                                        $originalValue = array();
                                        $accountValue = array();
                                        ?>

                                        <form method="post" name="updateCategoryForm" action="updateCategoriesExtraSubAccount.php" onsubmit="return check()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                            <?php
                                            $underAdminExpense = array();
                                            $underDistriExpense = array();
                                            $underFinanceExpense = array();
                                            for ($k = 0; $k < count($subResult); $k++) {
                                                if (stripos($subResult[$k]['sub_account'], "Administrative Expense") !== false) {
                                                    $underAdminExpense = $subResult[$k]['account_names'];
                                                }
                                                if (stripos($subResult[$k]['sub_account'], "Distribution and Marketing Expense") !== false) {
                                                    $underDistriExpense = $subResult[$k]['account_names'];
                                                }
                                                if (stripos($subResult[$k]['sub_account'], "Finance Expense") !== false) {
                                                    $underFinanceExpense = $subResult[$k]['account_names'];
                                                }
                                            }
                                            $underAdminExpense = explode(",", $underAdminExpense);
                                            $underDistriExpense = explode(",", $underDistriExpense);
                                            $underFinanceExpense = explode(",", $underFinanceExpense);
                                            for ($i = 0; $i < count($allAccounts); $i++) {
                                                $validAccount = 0;
                                                for ($k = 0; $k < count($underAdminExpense); $k++) {
                                                    if (stripos($allAccounts[$i], $underAdminExpense[$k]) !== false) {
                                                        $validAccount = 1;
                                                        break;
                                                    }
                                                }
                                                if ($validAccount == 0) {
                                                    for ($k = 0; $k < count($underDistriExpense); $k++) {
                                                        if (stripos($allAccounts[$i], $underDistriExpense[$k]) !== false) {
                                                            $validAccount = 1;
                                                            break;
                                                        }
                                                    }
                                                }
                                                if ($validAccount == 0) {
                                                    for ($k = 0; $k < count($underFinanceExpense); $k++) {
                                                        if (stripos($allAccounts[$i], $underFinanceExpense[$k]) !== false) {
                                                            $validAccount = 1;
                                                            break;
                                                        }
                                                    }
                                                }
                                                if ($validAccount == 1) {
                                                    echo "<br><b>Account name: </b> $allAccounts[$i] <br/>";
                                                    echo "<div>";
                                                    $startDataList = "<input list='category" . $i . "' value='' class='form-control' name='category[]'/>";
                                                    $bodyDataList = "<datalist id='category" . $i . "'style='overflow-y:scroll; height:10px;'>";
                                                    $setCat = 0;
                                                    for ($x = 0; $x < count($result); $x++) {
                                                        $underThisAccount = $result[$x]['account_names'];
                                                        $underThisAccount = explode(",", $underThisAccount);
                                                        $subCatResult = "";
                                                        $foundSubCat = 0;
                                                        if ($setCat == 0) {
                                                            for ($j = 0; $j < count($underThisAccount); $j++) {
                                                                if (strcasecmp($underThisAccount[$j], $allAccounts[$i]) === 0) {
                                                                    array_push($originalValue, $result[$x]['account']);
                                                                    array_push($accountValue, $allAccounts[$i]);
                                                                    $foundSubCat = 1;
                                                                    $startDataList = "<input list='category" . $i . "' value='" . $result[$x]['account'] . "' class='form-control' name='category[]'/>";
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        if ($foundSubCat == 1) {
                                                            $setCat = 1;
                                                        }
                                                        $bodyDataList .= "<option value='" . $result[$x]['account'] . "'>";
                                                    }
                                                    if ($setCat == 0) {
                                                        array_push($originalValue, "");
                                                        array_push($accountValue, $allAccounts[$i]);
                                                    }
                                                    echo "<label>Choose a category:" . $startDataList . "</label><div>" . $bodyDataList . "</datalist></div>";
                                                    echo "</div>";
                                                }
                                            }
                                        } catch (PDOException $e) {
                                            echo 'Error: ' . $e->getMessage();
                                        }
                                    } else {
                                        die("Unable to find the accounts in your file, please ensure the column headings (Account, Debit, Credit) are present.");
                                    }
                                    foreach ($fileArray as $value) {
                                        echo "<input type='hidden' name='fileArray[]' value='" . $value . "'/>";
                                    }
                                    foreach ($dateStart as $value) {
                                        echo "<input type='hidden' name='dateStart[]' value='" . $value . "'/>";
                                    }
                                    foreach ($dateEnd as $value) {
                                        echo "<input type='hidden' name='dateEnd[]' value='" . $value . "'/>";
                                    }
                                    foreach ($accountValue as $v) {
                                        echo "<input type='hidden' name='accountValue[]' value='" . $v . "'/>";
                                    }
                                    foreach ($originalValue as $value) {
                                        echo "<input type='hidden' name='originalValue[]' value='" . $value . "'/>";
                                    }
                                    ?>

                                    <input type="hidden" name="clientCompany" value="yes"/>

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
            </div>
            </div>
            <!--end::Portlet-->
            <?php
        }
    }
} else {
    header("Location: ../user_login/login.php");
}
?>

<?php include '../general/footer_content.php';    ?>
<?php include '../general/footer.php';  ?>

<script type="text/javascript">

    function check() {
      var inputs = document.getElementsByTagName("input");
      for (i = 0; i < inputs.length; i++){
        if (inputs[i].getAttribute("name") == "category[]"){
          if (inputs[i].value.trim().length == 0){
            alert("Please fill in all fields");
            return false;
          }
        } else {
          continue;
        }
      }
      return true;
      // return true;
    }

</script>
