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

            $query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name =:companyName AND client_company = :clientName");
            $query->bindParam(':companyName', $_SESSION['company']);
            $query->bindParam(':clientName', $_POST['clientCompany']);
            $query->execute();

            $result = $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetchAll();

            if ($_POST['key'] == "yes") {
                $mainCategory = $_POST['main'];
                $subCategory = $_POST['subAccount'];

                $companyName = $_SESSION['companyName'];
                $clientName = $_POST['clientCompany'];
                $fileArray = $_POST['fileArray'];
                $dateStart = $_POST['dateStart'];
                $dateEnd = $_POST['dateEnd'];
                $allAccounts = $_POST['accountValue'];
                $clientUEN = $_POST['clientUEN'];

                $mainAccountArrayDB = array();
                for ($i = 0; $i < count($result); $i++) {
                    array_push($mainAccountArrayDB, $result[$i]['main_account']);
                }

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
                        }
                        unset($tempAccountNameArray);
                        $tempAccountNameArray = array();
                    }
                }

                if (!empty($tempArray)) {
                    foreach ($tempArray as $category => $array) {
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
            } else if ($_POST['key'] == "no") {
                $companyName = $_SESSION['company'];
                $clientName = $_POST['clientCompany'];
                $fileArray = $_POST['fileArray'];
                $dateStart = $_POST['dateStart'];
                $dateEnd = $_POST['dateEnd'];
                $allAccounts = $_POST['accountValue'];
                $clientUEN = $_POST['clientUEN'];
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

                                <form method="post" name="mainCategory" action="updateCategoriesAccount.php" onsubmit="return check()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                    <?php
                                    $query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name =:companyName AND client_company = :clientName");
                                    $query->bindParam(':companyName', $_SESSION['company']);
                                    $query->bindParam(':clientName', $_POST['clientCompany']);
                                    $query->execute();

                                    $result = $query->setFetchMode(PDO::FETCH_ASSOC);
                                    $result = $query->fetchAll();

                                    $subQuery = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
                                    $subQuery->bindParam(':companyName', $_SESSION['company']);
                                    $subQuery->bindParam(':clientName', $_POST['clientCompany']);
                                    $subQuery->execute();

                                    $subResult = $subQuery->setFetchMode(PDO::FETCH_ASSOC);
                                    $subResult = $subQuery->fetchAll();

                                    $originalValue = array();
                                    $accountValue = array();

                                    $matchedSubArray = array();

                                    for ($i = 0; $i < count($allAccounts); $i++) {
                                        for ($j = 0; $j < count($subResult); $j++) {
                                            // check TB with sub account's account name 
                                            // if same, store the sub account into an array 
                                            // then proceed as per normal 

                                            $inTB = $subResult[$j]['account_names'];
                                            $inTB = explode(",", $inTB);

                                            for ($k = 0; $k < count($inTB); $k++) {
                                                if (strcasecmp($allAccounts[$i], $inTB[$k]) === 0) {
                                                    array_push($matchedSubArray, $subResult[$j]['sub_account']);
                                                    // use $matchSubArray to check with 
                                                }
                                            }
                                        }
                                    }
                                    
                                    $matchedSubArray = array_unique($matchedSubArray);
                                    $matched = array();
                                    foreach ($matchedSubArray as $value) {
                                        array_push($matched, $value);
                                    }
                                    
                                    for ($k = 0; $k < count($matched); $k++) {
                                        for ($i = 0; $i < count($subResult); $i++) {
                                            if (strcasecmp($subResult[$i]['sub_account'], $matched[$k]) === 0) {
                                                echo "<b>Account name: </b> " . $matched[$k] . "<br/>";
                                                echo "<b>Matching account category: </b>";
                                                echo "<div>";

                                                $startDataList = "<input list='category" . $i . "' value='' class='form-control' name='category[]'/>";
                                                $bodyDataList = "<datalist id='category" . $i . "'>";

                                                $setCat = 0;
                                                for ($a = 0; $a < count($result); $a++) {
                                                    $underThisAccount = $result[$a]['account_names'];
                                                    $underThisAccount = explode(",", $underThisAccount);

                                                    $foundSubCat = 0;
                                                    if ($setCat == 0) {
                                                        for ($b = 0; $b < count($underThisAccount); $b++) {
                                                            if (strcasecmp($underThisAccount[$b], $subResult[$i]['sub_account']) === 0) {
                                                                array_push($originalValue, $result[$a]['main_account']);
                                                                array_push($accountValue, $subResult[$i]['sub_account']);

                                                                $foundSubCat = 1;
                                                                $startDataList = "<input list='category" . $i . "' value='" . $result[$a]['main_account'] . "' class='form-control' name='category[]'/>";
                                                                break;
                                                            }
                                                        }
                                                    }

                                                    if ($foundSubCat == 1) {
                                                        $setCat = 1;
                                                    }

                                                    $bodyDataList .= "<option value='" . $result[$a]['main_account'] . "'>";
                                                }

                                                if ($setCat == 0) {
                                                    array_push($originalValue, "");
                                                    array_push($accountValue, $subResult[$i]['sub_account']);
                                                }

                                                echo "<label>Choose a category:" . $startDataList . "</label>" . $bodyDataList . "</datalist>";
                                                echo "</div>";
                                            }
                                        }
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

                                    foreach ($originalValue as $value) {
                                        echo "<input type='hidden' name='originalValue[]' value='" . $value . "'/>";
                                    }

                                    foreach ($accountValue as $v) {
                                        echo "<input type='hidden' name='accountValue[]' value='" . $v . "'/>";
                                    }

                                    foreach ($allAccounts as $v) {
                                        echo "<input type='hidden' name='allAccounts[]' value='" . $v . "'/>";
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
            <?php
        }
    }
} else {
    header("Location: ../user_login/login.php");
}
?>