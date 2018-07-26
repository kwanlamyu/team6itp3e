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
            $clientUEN = $_POST['clientUEN'];

            // use PhpOffice\PhpSpreadsheet\Reader\Csv;
            // can change to read csv file as well
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            // only read data
            $reader->setReadDataOnly(true);

            if ($_POST['key'] == "yes") {

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
                    ?>
                    <form method="post" id="categoryForm" action="updateCategoriesMain.php">
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

                        <input type="submit" value="Submit" name="sub" class="btn btn-brand">
                    </form>

                    <script>
                        document.getElementById('categoryForm').submit();
                    </script>
                    <?php
                }
            } else if ($_POST['key'] == "no") {
                $companyName = $_SESSION['companyName'];
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
                                                Update Sub Categories
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (isset($allAccounts)) {
                                    try {
                                        echo "<span>Company: " . $companyName . "</span><br/>";
                                        echo "<span>Client: " . $clientName . "</span><br/> <hr/>";

                                        // TODO: change to editable
                                        $query = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
                                        $query->bindParam(':companyName', $companyName);
                                        $query->bindParam(':clientName', $clientName);
                                        $query->execute();

                                        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $result = $query->fetchAll();

                                        $originalValue = array();
                                        $accountValue = array();
                                        ?>


                                        <form method="post" name="updateCategoryForm" action="updateCategoriesExtraMain.php" onsubmit="return check()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                            <?php
                                            for ($i = 0; $i < count($allAccounts); $i++) {
                                                echo "<hr/><b>Account name: </b> $allAccounts[$i] <br/>";
                                                echo "<b>Matching account category: </b>";
                                                echo "<div>";
                                                $startDataList = "<input id='category" . $i . "' list='category" . $i . "' value='' class='form-control' name='category[]'/>";
                                                $bodyDataList = "<datalist id='category" . $i . "'style='overflow-y:scroll; height:20px;'>";
                                                $setCat = 0;
                                                for ($x = 0; $x < count($result); $x++) {
                                                    $underThisAccount = $result[$x]['account_names'];
                                                    $underThisAccount = explode(",", $underThisAccount);
                                                    $subCatResult = "";
                                                    $foundSubCat = 0;

                                                    if ($setCat == 0) {
                                                        for ($j = 0; $j < count($underThisAccount); $j++) {
                                                            if (strcasecmp($underThisAccount[$j], $allAccounts[$i]) === 0) {
                                                                array_push($originalValue, $result[$x]['sub_account']);
                                                                array_push($accountValue, $allAccounts[$i]);

                                                                $foundSubCat = 1;
                                                                $startDataList = "<input list='category" . $i . "' value='" . $result[$x]['sub_account'] . "' class='form-control' name='category[]'/>";
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    if ($foundSubCat == 1) {
                                                        $setCat = 1;
                                                    }
                                                    $bodyDataList .= "<option value='" . $result[$x]['sub_account'] . "'>";
                                                }
                                                if ($setCat == 0) {
                                                    array_push($originalValue, "");
                                                    array_push($accountValue, $allAccounts[$i]);
                                                }

                                                echo "<label>Choose a category:" . $startDataList . "</label><div>" . $bodyDataList . "</datalist></div>";
                                                echo "</div>";
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
                                    ?>

                                    <input type="hidden" name="key" value="yes"/>        

                                    <input type="hidden" name="clientCompany" value="<?php echo $clientName; ?>"/>
                                    <input type="hidden" name="companyName" value="<?php echo $companyName; ?>"/>
                                    <input type="hidden" name="clientUEN" value="<?php echo $clientUEN; ?>"/>

                                    <?php
                                    foreach ($accountValue as $v) {
                                        echo "<input type='hidden' name='accountValue[]' value='" . $v . "'/>";
                                    }
                                    foreach ($originalValue as $value) {
                                        echo "<input type='hidden' name='originalValue[]' value='" . $value . "'/>";
                                    }
                                    ?>

                                    <input type="submit" value="Submit" name="submit" class="btn btn-brand">
                                </form>
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
