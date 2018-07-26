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

            $subCategory = $_POST['sub'];
            $accCategory = $_POST['accAccount'];

            $companyName = $_SESSION['companyName'];
            $clientName = $_POST['clientCompany'];
            $fileArray = $_POST['fileArray'];
            $dateStart = $_POST['dateStart'];
            $dateEnd = $_POST['dateEnd'];
            $allAccounts = $_POST['accountValue'];
            $clientUEN = $_POST['clientUEN'];

            $query = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
            $query->bindParam(':companyName', $_SESSION['companyName']);
            $query->bindParam(':clientName', $_POST['clientCompany']);
            $query->execute();

            $result = $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetchAll();

            print_r($subCategory);
            echo "<hr>";

            $subAccountArrayDB = array();
            for ($i = 0; $i < count($result); $i++) {
                array_push($subAccountArrayDB, $result[$i]['sub_account']);
            }

            $tempAccountNameArray = array();
            $tempArray = array();

            for ($i = 0; $i < count($result); $i++) {
                for ($j = 0; $j < count($subCategory); $j++) {
                    if ($result[$i]['sub_account'] == $subCategory[$j]) {

                        if (empty($tempArray)) {
                            array_push($tempAccountNameArray, $result[$i]['account_names']);
                            array_push($tempAccountNameArray, $accCategory[$j]);
                            $tempArray[$subCategory[$j]] = $tempAccountNameArray;
                        } else {
                            if (in_array($subCategory[$j], array_keys($tempArray))) {
                                foreach ($tempArray as $key => $array) {
                                    if ($key == $subCategory[$j]) {
                                        array_push($array, $accCategory[$j]);
                                        $tempArray[$subCategory[$j]] = $array;
                                    }
                                }
                            } else {
                                array_push($tempAccountNameArray, $result[$i]['account_names']);
                                array_push($tempAccountNameArray, $accCategory[$j]);
                                $tempArray[$subCategory[$j]] = $tempAccountNameArray;
                            }
                        }
                    }
                    unset($tempAccountNameArray);
                    $tempAccountNameArray = array();
                }
            }

            if (!empty($tempArray)) {
                foreach ($tempArray as $category => $array) {

                    if (in_array($category, $subAccountArrayDB)) {
                        $implode = implode(",", $array);

                        $update = "UPDATE sub_category SET account_names= '" . $implode . "' WHERE sub_account = '" . $category . "' AND company_name = '" . $_SESSION['companyName'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
                        $stmt = $DB_con->prepare($update);
                        $stmt->execute();
                    } else {
                        $implode = implode(",", $array);

                        $insert = "INSERT INTO sub_category (company_name, client_company, sub_account, account_names)
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
            $query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name =:companyName AND client_company = :clientName");
            $query->bindParam(':companyName', $_SESSION['companyName']);
            $query->bindParam(':clientName', $_POST['clientCompany']);
            $query->execute();

            $result = $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetchAll();

            $mainAccountArrayDB = array();
            for ($i = 0; $i < count($result); $i++) {
                array_push($mainAccountArrayDB, $result[$i]['main_account']);
            }

            echo "Please choose which Main Category it belongs to! <br><br>";

            for ($i = 0; $i < count($tempAccArray); $i++) {
                echo "<b>Current Sub Account: </b>" . $tempAccArray[$i] . "<Br>";
                echo "<select name='main[]'>";
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