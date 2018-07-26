<?php
require_once '../db_connection/db.php';
require_once __DIR__ . '\..\..\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

if (isset($_SESSION['username']) || isset($_SESSION['role_id']) || isset($_SESSION['company'])) {
    if ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3) {
        header('Location: ../user_super_admin/userdashboard.php');
    } else {
        if (!isset($_POST['companyName'])) {
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

            $query = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
            $query->bindParam(':companyName', $_SESSION['company']);
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

                    $tempArray = array();
                    // For those category not added into Main
                    for ($j = 0; $j < count($result); $j++) {
                        if (!in_array($inputCategory[$i], $subAccountArrayDB)) {
                            array_push($tempArray, $accountValue[$i]);
                            $categoryTempArray[$inputCategory[$i]] = $tempArray;
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
                    if (in_array($category, $subAccountArrayDB)) {
                        $implode = implode(",", $array);

                        $update = "UPDATE sub_category SET account_names= '" . $implode . "' WHERE sub_account= '" . $category . "' AND company_name = '" . $_SESSION['company'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
                        $stmt = $DB_con->prepare($update);
                        $stmt->execute();
                    } else {
                        $implode = implode(",", $array);

                        $insert = "INSERT INTO sub_category (company_name, client_company, sub_account, account_names)
                VALUES ('" . $_SESSION['company'] . "', '" . $_POST['clientCompany'] . "', '" . $category . "' ,'" . $implode . "')";
                        // use exec() because no results are returned
                        $DB_con->exec($insert);
                    }
                }
            } else {
                ?>
                <form method="post" id = "categoryForm" name="myForm" action="updateCategoriesMain.php">
                    <?php
                    foreach ($tempAccArray as $v) {
                        echo "<input type='hidden' name='accAccount[]' value='" . $v . "'/>";
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

                    foreach ($accountValue as $v) {
                        echo "<input type='hidden' name='accountValue[]' value='" . $v . "'/>";
                    }
                    ?>

                    <input type="hidden" name="clientCompany" value="<?php echo $clientName; ?>"/>
                    <input type="hidden" name="companyName" value="<?php echo $companyName; ?>"/>
                    <input type="hidden" name="clientUEN" value="<?php echo $clientUEN; ?>"/>

                    <input type="hidden" name="key" value="no"/>

                    <input type="submit" value="Submit" name="s" class="btn btn-brand">
                </form>

                <script>
                    document.getElementById('categoryForm').submit();
                </script>
            <?php } ?>

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
                                <?php if (!empty($tempSubArray)) { ?>
                                    <form method="post" name="updateCategoryForm" action="updateCategoriesMain.php" onsubmit="return check()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                        <?php
                                        echo "Please choose which Main Category it belongs to! <br><br>";
                                        
                                        $tempSubArray = array_unique($tempSubArray);
                                        for ($i = 0; $i < count($tempSubArray); $i++) {
                                            echo "<b>Current Sub Account: </b>" . $tempSubArray[$i] . "<br>";
                                            
                                            $startDataList = "<input id='category" . $i . "' list='category" . $i . "' value='' class='form-control' name='main[]'/>";
                                            $bodyDataList = "<datalist id='category" . $i . "'style='overflow-y:scroll; height:10px;'>";
                                            
                                            for ($j = 0; $j < count($mainAccountArrayDB); $j++) {
                                                $bodyDataList .= "<option value='" . $mainAccountArrayDB[$j] . "'>";
                                            }
                                            
                                            echo "<label>Choose a category:" . $startDataList . "</label><div>" . $bodyDataList . "</datalist></div>";
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

                                        foreach ($accountValue as $v) {
                                            echo "<input type='hidden' name='accountValue[]' value='" . $v . "'/>";
                                        }
                                        ?>

                                        <input type="hidden" name="key" value="yes"/>
                                        
                                        <input type="hidden" name="clientCompany" value="<?php echo $clientName; ?>"/>
                                        <input type="hidden" name="companyName" value="<?php echo $companyName; ?>"/>
                                        <input type="hidden" name="clientUEN" value="<?php echo $clientUEN; ?>"/>

                                        <input type="submit" value="Submit" name="submit" class="btn btn-brand">
                                    </form>
                                <?php } else { ?>
                                    <form method="post" id = "categoryForm" name="myForm" action="updateCategoriesMain.php">
                                        <?php
                                        
                                        foreach ($dateStart as $value) {
                                            echo "<input type='hidden' name='dateStart[]' value='" . $value . "'/>";
                                        }

                                        foreach ($dateEnd as $value) {
                                            echo "<input type='hidden' name='dateEnd[]' value='" . $value . "'/>";
                                        }

                                        foreach ($fileArray as $value) {
                                            echo "<input type='hidden' name='fileArray[]' value='" . $value . "'/>";
                                        }

                                        foreach ($accountValue as $v) {
                                            echo "<input type='hidden' name='accountValue[]' value='" . $v . "'/>";
                                        }
                                        ?>

                                        <input type="hidden" name="clientCompany" value="<?php echo $clientName; ?>"/>
                                        <input type="hidden" name="companyName" value="<?php echo $companyName; ?>"/>
                                        <input type="hidden" name="clientUEN" value="<?php echo $clientUEN; ?>"/>

                                        <input type="hidden" name="key" value="no"/>

                                        <input type="submit" value="Submit" name="s" class="btn btn-brand">
                                    </form>

                                    <script>
                                        document.getElementById('categoryForm').submit();
                                    </script>
                                <?php } ?>
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
