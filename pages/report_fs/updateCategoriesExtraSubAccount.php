<?php
require_once '../db_connection/db.php';

if (isset($_SESSION['username']) || isset($_SESSION['role_id']) || isset($_SESSION['company'])) {
    if ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3) {
        header('Location: ../user_super_admin/user_admin_dashboard.php');
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

            $companyName = $_SESSION['company'];
            $clientName = $_POST['clientCompany'];
            $fileArray = $_POST['fileArray'];
            $dateStart = $_POST['dateStart'];
            $dateEnd = $_POST['dateEnd'];
            $clientUEN = $_POST['clientUEN'];

            $originalValue = $_POST['originalValue'];
            $inputCategory = $_POST['category'];
            $accountValue = $_POST['accountValue'];

            $query = $DB_con->prepare("SELECT * FROM account_category WHERE company_name =:company AND client_company = :clientName");
            $query->bindParam(':company', $_SESSION['company']);
            $query->bindParam(':clientName', $_POST['clientCompany']);
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

                        $update = "UPDATE account_category SET account_names= '" . $implode . "' WHERE account= '" . $category . "' AND company_name = '" . $_SESSION['company'] . "' AND client_company = '" . $_POST['clientCompany'] . "'";
                        $stmt = $DB_con->prepare($update);
                        $stmt->execute();
                    } else {
                        $implode = implode(",", $array);

                        $insert = "INSERT INTO account_category (company_name, client_company, account, account_names)
                            VALUES ('" . $_SESSION['company'] . "', '" . $_POST['clientCompany'] . "', '" . $category . "' ,'" . $implode . "')";
                        // use exec() because no results are returned
                        $DB_con->exec($insert);
                    }
                }
            } else {
                ?>
				<div class="m-portlet__body"> 
                <form method="post" id = "categoryForm" name="myForm" action="upload.php">
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
				</div>

                <script>
                    document.getElementById('categoryForm').submit();
                </script>
            <?php } ?>

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
                                                Update Main Categories
                                            </h3>
                                        </div>
                                    </div>
									
                                </div>
								<div class="m-portlet__body"> 
                                <form method="post" name="updateCategoryForm" action="upload.php" onsubmit="return check()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                    <?php
                                    $query = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
                                    $query->bindParam(':companyName', $_SESSION['company']);
                                    $query->bindParam(':clientName', $_POST['clientCompany']);
                                    $query->execute();

                                    $result = $query->setFetchMode(PDO::FETCH_ASSOC);
                                    $result = $query->fetchAll();

                                    $subAccountArrayDB = array();
                                    for ($i = 0; $i < count($result); $i++) {
                                        array_push($subAccountArrayDB, $result[$i]['sub_account']);
                                    }

                                    echo "Please choose which Sub Account Category it belongs to! <br><br>";

                                    $tempAccArray = array_unique($tempAccArray);

                                    for ($i = 0; $i < count($tempAccArray); $i++) {
                                        echo "<b>Current Detailed Account: </b>" . $tempAccArray[$i] . "<br>";

                                        $startDataList = "<input list='category" . $i . "' value='' class='form-control' name='sub[]'/>";
                                        $bodyDataList = "<datalist id='category" . $i . "' style='overflow-y:scroll; height:20px;'>";

                                        for ($j = 0; $j < count($subAccountArrayDB); $j++) {
                                            $bodyDataList .= "<option value='" . $subAccountArrayDB[$j] . "'>";
                                        }

                                        echo "<label>Choose a category:" . $startDataList . "</label><div>" . $bodyDataList . "</datalist></div>";

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

                                    <input type="hidden" name="key" value="yes"/>
									<br>

                                    <input type="submit" value="Submit" name="submit" class="btn btn-success">
                                </form>
								</div>
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

<script>
    function submit() {
//        document.getElementById('submit').submit();

        document.myForm.submit();

    }
</script>