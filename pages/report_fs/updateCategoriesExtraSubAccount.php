<?php
require_once '../db_connection/db.php';

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

            $companyName = $_SESSION['companyName'];
            $clientName = $_POST['clientCompany'];
            $fileArray = $_POST['fileArray'];
            $dateStart = $_POST['dateStart'];
            $dateEnd = $_POST['dateEnd'];
            $clientUEN = $_POST['clientUEN'];

            $originalValue = $_POST['originalValue'];
            $inputCategory = $_POST['category'];
            $accountValue = $_POST['accountValue'];

            $query = $DB_con->prepare("SELECT * FROM account_category WHERE company_name =:companyName AND client_company = :clientName");
            $query->bindParam(':companyName', $companyName);
            $query->bindParam(':clientName', $clientName);
            $query->execute();

            $result = $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetchAll();

            $accountArrayDB = array();
            for ($i = 0; $i < count($result); $i++) {
                array_push($accountArrayDB, $result[$i]['account']);
            }

            $tempStoreArray = array();
            $categoryTempArray = array();
            $temp = array();

            //store acc category that haven't store into the Sub category database
            $tempAccArray = array();

            for ($i = 0; $i < count($originalValue); $i++) {
                if ($originalValue[$i] != $inputCategory[$i]) {
                    if ($originalValue[$i] == "") {
                        for ($j = 0; $j < count($result); $j++) {
                            if ($inputCategory[$i] == $result[$j]['account']) {
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
                            if ($inputCategory[$i] == $result[$j]['account']) {
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
                                $categoryTempArray[$result[$j]['account']] = $temp;
                            }
                        }
                    }

                    $tempArray = array();
                    // For those category not added into Sub
                    for ($j = 0; $j < count($result); $j++) {
                        if (!in_array($inputCategory[$i], $accountArrayDB)) {
                            array_push($tempArray, $accountValue[$i]);
                            $categoryTempArray[$inputCategory[$i]] = $tempArray;
                            array_push($tempAccArray, $inputCategory[$i]);
                            break;
                        }
                    }
                }
                unset($tempStoreArray);
                $tempStoreArray = array();
            }

            if (!empty($categoryTempArray)) {
                foreach ($categoryTempArray as $category => $array) {
                    if (in_array($category, $accountArrayDB)) {
                        $implode = implode(",", $array);

                        $update = "UPDATE account_category SET account_names= '" . $implode . "' WHERE account= '" . $category . "' AND company_name = '" . $_SESSION['companyName'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
                        $stmt = $DB_con->prepare($update);
                        $stmt->execute();
                    } else {
                        $implode = implode(",", $array);

                        $insert = "INSERT INTO account_category (company_name, client_company, account, account_names)
                            VALUES ('" . $_SESSION['companyName'] . "', '" . $_POST['clientCompany'] . "', '" . $category . "' ,'" . $implode . "')";
                        // use exec() because no results are returned
                        $DB_con->exec($insert);
                    }
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
                                <form method="post" name="updateCategoryForm" action="updateCategoriesSub.php" onsubmit="return check()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                    <?php
                                    $query = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
                                    $query->bindParam(':companyName', $_SESSION['companyName']);
                                    $query->bindParam(':clientName', $_POST['clientCompany']);
                                    $query->execute();

                                    $result = $query->setFetchMode(PDO::FETCH_ASSOC);
                                    $result = $query->fetchAll();

                                    $subAccountArrayDB = array();
                                    for ($i = 0; $i < count($result); $i++) {
                                        array_push($subAccountArrayDB, $result[$i]['sub_account']);
                                    }

                                    echo "Please choose which Sub Category it belongs to! <br><br>";

                                    for ($i = 0; $i < count($tempAccArray); $i++) {
                                        echo "<b>Current Sub Account: </b>" . $tempAccArray[$i] . "<Br>";
                                        echo "<select name='sub[]'>";
                                        for ($j = 0; $j < count($subAccountArrayDB); $j++) {
                                            echo "<option value='" . $subAccountArrayDB[$j] . "'>" . $subAccountArrayDB[$j] . "</option>";
                                        }
                                        echo "</select>";
                                        echo "<hr>";
                                    }

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
    }
} else {
    header("Location: ../user_login/login.php");
}
?>

<?php include '../general/footer_content.php'; ?>
<?php include '../general/footer.php'; ?>