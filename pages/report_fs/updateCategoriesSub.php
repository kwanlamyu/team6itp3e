<?php
require_once '../db_connection/db.php';
include '../general/header.php';
include '../general/navigation_accountant.php';
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
                                $fileArray = array();
                                $target_dir = "../../pages/report_fs/uploads/";
                                $errorFlag = 0;
                                $fileExist = 0;
                                $fileUpload = 0;
                                $fileTypeMismatch = 0;
                                for ($i = 0; $i < count($_FILES["trialBalances"]["name"]); $i++) {
                                    $target_file = $target_dir . basename($_FILES["trialBalances"]["name"][$i]);
                                    $uploadOk = 1;
                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                                    // Check if file already exists
                                    if (file_exists($target_file)) {
                                        unlink($target_file);
                                        $fileExist = 1;
                                    }

                                    if ($imageFileType != "csv" && $imageFileType != "xlsx") {
                                        $fileTypeMismatch = 1;
                                        $uploadOk = 0;
                                    }
                                    // Check if $uploadOk is set to 0 by an error
                                    if ($uploadOk == 0) {
                                        $errorFlag = 1;
                                        // if everything is ok, try to upload file
                                    } else {
                                        if (move_uploaded_file($_FILES["trialBalances"]["tmp_name"][$i], $target_file)) {
                                            $fileUpload = 0;
                                            array_push($fileArray, $target_file);
                                        } else {
                                            $fileUpload = 1;
                                        }
                                    }
                                }
                                
                                if ($fileTypeMismatch == 1) {
                                    echo '<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
				<div class="m-alert__icon">
					<i class="flaticon-exclamation-1"></i>
					<span></span>
				</div>
				<div class="m-alert__text">
					Sorry, only spreadsheets are allowed.
				</div>
				<div class="m-alert__close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				</div>
			</div>';
                                }
                                
                                if ($fileExist == 1) {
                                    echo ' <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show " role="alert">
				<div class="m-alert__icon">
					<i class="flaticon-exclamation-1"></i>
					<span></span>
				</div>
				<div class="m-alert__text">
					Existing file deleted.
				</div>
				<div class="m-alert__close">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				</div>
			</div>';
                                }
                                
                                if ($fileUpload == 0) {
                                    echo '<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
						<div class="m-alert__icon">
							<i class="flaticon-exclamation-1"></i>
							<span></span>
						</div>
						<div class="m-alert__text">
							The files have been uploaded.
						</div>
						<div class="m-alert__close">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
						</div>
					</div>';
                                } else {
                                    echo '<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
		<div class="m-alert__icon">
			<i class="flaticon-exclamation-1"></i>
			<span></span>
		</div>
		<div class="m-alert__text">
			Sorry, there was an error uploading your file.
		</div>
		<div class="m-alert__close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>';
                                }
                                
                                if ($errorFlag == 1) {
                                    echo "Sorry, your file was not uploaded.";
                                } else {
                                    for ($i = 0; $i < count($fileArray); $i++) {
                                        $target_file = $fileArray[$i];
                                        $spreadsheet = $reader->load($target_file);
                                        $numberOfSheets = $spreadsheet->getSheetCount();
                                        if ($numberOfSheets > 1) {
                                            die("Please upload only 1 sheet per trial balance.<br/><a href='fs_main.php'>Upload again</a>");
                                        }
                                        // implementation only allows 1 sheet in file
                                        $activeSheet = 0;
                                        $sheetData = $spreadsheet->getSheet($activeSheet)->toArray();
                                        $accountColumn = false;
                                        $accountColFound = 0;
                                        $headingRow = false;
                                        for ($x = 0; $x < count($sheetData); $x++) {
                                            for ($j = 0; $j < count($sheetData[$x]); $j++) {
                                                $currentData = $sheetData[$x][$j];
                                                if (stripos($currentData, "account") !== false) {
                                                    $accountColumn = $j;
                                                    break;
                                                }
                                            }
                                            if (strcasecmp(gettype($accountColumn), "boolean") !== 0) {
                                                $accountColFound = 1;
                                                $headingRow = $x + 1;
                                                break;
                                            }
                                        }
                                        if ($accountColFound == 0) {
                                            die("Please ensure headings are included in the file.(Account, Debit, Credit)");
                                        } else {
                                            $allAccounts = array();
                                            for ($x = $headingRow; $x < count($sheetData); $x++) {
                                                $currentData = trim($sheetData[$x][$accountColumn]);
                                                if (empty($currentData) || in_array($currentData, $allAccounts)) {
                                                    continue;
                                                } else {
                                                    if (stripos($currentData, "Total:") !== false) {
                                                        continue;
                                                    } else {
                                                        array_push($allAccounts, $currentData);
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                             
                                if (isset($allAccounts)) {
                                    try {
                                        $query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name = :companyName AND client_company = :clientName");
                                        $query->bindParam(':companyName', $companyName);
                                        $query->bindParam(':clientName', $clientName);
                                        $companyName = $_SESSION['company'];
                                        $clientName = $_POST['clientCompany'];

                                        $query->execute();
                                        $result = $query->setFetchMode(PDO::FETCH_ASSOC);
                                        $result = $query->fetchAll();

                                        $subQuery = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name = :companyName AND client_company = :clientName");
                                        $subQuery->bindParam(':companyName', $companyName);
                                        $subQuery->bindParam(':clientName', $clientName);
                                        $companyName = $_SESSION['company'];
                                        $clientName = $_POST['clientCompany'];

                                        $subQuery->execute();
                                        $subResult = $subQuery->setFetchMode(PDO::FETCH_ASSOC);
                                        $subResult = $subQuery->fetchAll();

                                        $accountQuery = $DB_con->prepare("SELECT * FROM account_category WHERE company_name = :companyName AND client_company = :clientName");
                                        $accountQuery->bindParam(':companyName', $companyName);
                                        $accountQuery->bindParam(':clientName', $clientName);
                                        $companyName = $_SESSION['company'];
                                        $clientName = $_POST['clientCompany'];

                                        $accountQuery->execute();
                                        $accountResult = $accountQuery->setFetchMode(PDO::FETCH_ASSOC);
                                        $accountResult = $accountQuery->fetchAll();

                                        if (count($result) === 0) {
                                            // insert default data here
                                            // Main category -------------------------------------------------------
                                            $query = $DB_con->prepare("INSERT INTO main_category (company_name, client_company, main_account, account_names) VALUES (:company_name, :client_company, :main_account, :account_names)");
                                            $query->bindParam(':company_name', $companyName);
                                            $query->bindParam(':client_company', $clientName);
                                            $query->bindParam(':main_account', $mainAccount);
                                            $query->bindParam(':account_names', $accountNames);

                                            // insert adjustments
                                            $mainAccount = "Adjustments";
                                            $accountNames = "Depreciation,Interest on bank borrowings";
                                            $query->execute();

                                            // insert administrative expenses
                                            $mainAccount = "Administrative Expenses";
                                            $accountNames = "Accounting Fee,Administrative Expenses";
                                            $query->execute();

                                            // insert assets
                                            $mainAccount = "Assets";
                                            $accountNames = "Bank Balances,Deposits,Trade Receivables,Plant and Equipment,Prepayments,Amount owing from a Shareholder";
                                            $query->execute();

                                            $mainAccount = "Both Liabilities";
                                            $accountNames = "Borrowings";
                                            $query->execute();

                                            $mainAccount = "Capital";
                                            $accountNames = "Share Capital,Retained Profits,Accumulated Losses";
                                            $query->execute();

                                            $mainAccount = "Current Assets";
                                            $accountNames = "Bank Balance,Trade Receivables,Deposits,Prepayments,Amount owing from a Shareholder";
                                            $query->execute();

                                            $mainAccount = "Current Liabilities";
                                            $accountNames = "Trade and other payables,Current Income Tax Liabilities";
                                            $query->execute();

                                            $mainAccount = "Distribution and Marketing Expenses";
                                            $accountNames = "Telephone Expenses,Transport Expenses,Travel Expenses";
                                            $query->execute();

                                            $mainAccount = "Expenses";
                                            $accountNames = "Administrative Expenses,Distribution and Marketing Expenses,Income Tax Expense,Finance Expenses";
                                            $query->execute();

                                            $mainAccount = "Income";
                                            $accountNames = "Revenue,Other Income,Exchange Gain - Trade,Exchange Gain - Non-trade";
                                            $query->execute();

                                            $mainAccount = "Non-current Assets";
                                            $accountNames = "Plant and Equipment";
                                            $query->execute();

                                            $mainAccount = "Non-current Liabilities";
                                            $accountNames = "";
                                            $query->execute();

                                            $mainAccount = "Tax Payable";
                                            $accountNames = "Income Tax Payables,Current Income Tax Liabilities";
                                            $query->execute();

                                            $mainAccount = "Trade and other payables";
                                            $accountNames = "Accruals,GST Payables,Amount owing to a Shareholder,Trade Payables";
                                            $query->execute();

                                            $mainAccount = "Exchange Gain - Non-trade";
                                            $accountNames = "Unrealised exchange difference,Exchange Gain - Non-trade";
                                            $query->execute();

                                            $mainAccount = "Exchange Gain - Trade";
                                            $accountNames = "Exchange Gain - Trade,Exchange difference";
                                            $query->execute();

                                            // Sub category ---------------------------------------------------------
                                            $query = $DB_con->prepare("INSERT INTO sub_category (company_name, client_company, sub_account, account_names) VALUES (:company_name, :client_company, :sub_account, :account_names)");
                                            $query->bindParam(':company_name', $companyName);
                                            $query->bindParam(':client_company', $clientName);
                                            $query->bindParam(':sub_account', $subAccount);
                                            $query->bindParam(':account_names', $accountNames);

                                            $subAccount = "Accruals";
                                            $accountNames = "Accruals";
                                            $query->execute();

                                            $subAccount = "Administrative Expenses";
                                            $accountNames = "Accounting fee,Administrative expenses,Business entertainment,Bank Charges,Compilation fee,Depreciation,Entertainment,Freight paid,Director Remuneration,Insurance,Internet expenses,Late Fees Paid,Nominee Director Services,Office Supplies,Postage and courier,Professional Fee,Printing and stationery,Rent,Secretarial services,Staff Salaries,Staff cost - employment pass,Secretarial  fee,Taxation services,Skill Development Levy,Wages & Salaries";
                                            $query->execute();

                                            $subAccount = "Amount owing from a Shareholder";
                                            $accountNames = "Amount owing to/(from) SH";
                                            $query->execute();

                                            $subAccount = "Bank Balances";
                                            $accountNames = "OCBC Bank,OCBC - USD,OCBC - USD Exchange";
                                            $query->execute();

                                            $subAccount = "Borrowings";
                                            $accountNames = "Borrowings";
                                            $query->execute();

                                            $subAccount = "Cost of Sales";
                                            $accountNames = "Purchases";
                                            $query->execute();

                                            $subAccount = "Current Income Tax Liabilities";
                                            $accountNames = "Income tax payable";
                                            $query->execute();

                                            $subAccount = "Deposits";
                                            $accountNames = "Hoiio deposit,Deposits Paid";
                                            $query->execute();

                                            $subAccount = "Distribution and Marketing Expenses";
                                            $accountNames = "Telephone,Transport - Taxi fare,Travelling";
                                            $query->execute();

                                            $subAccount = "Finance Expenses";
                                            $accountNames = "Interest on bank borrowings";
                                            $query->execute();

                                            $subAccount = "GST Payables";
                                            $accountNames = "GST control";
                                            $query->execute();

                                            $subAccount = "Income Tax Expense";
                                            $accountNames = "Income tax expense,Income Tax Payables,Income tax expenses";
                                            $query->execute();

                                            // $subAccount = "Other Income";
                                            // $accountNames = "Unrealised exchange difference";
                                            // $query->execute();

                                            $subAccount = "Plant and Equipment";
                                            $accountNames = "Office Equipment at Cost,Office Equipment Accum Dep'n,Softwares at Cost,Softwares Accum Dep'n,Computer & servers - cost,Computer and servers - acc dep";
                                            $query->execute();

                                            $subAccount = "Prepayments";
                                            $accountNames = "Prepayments";
                                            $query->execute();

                                            $subAccount = "Retained Profits";
                                            $accountNames = "Retained Earnings";
                                            $query->execute();

                                            $subAccount = "Revenue";
                                            $accountNames = "Sales";
                                            $query->execute();

                                            $subAccount = "Share Capital";
                                            $accountNames = "Paid Up Capital";
                                            $query->execute();

                                            $subAccount = "Trade Payables";
                                            $accountNames = "Trade Payables - USD,Trade Payables - USD Exchange";
                                            $query->execute();

                                            $subAccount = "Trade Receivables";
                                            $accountNames = "Trade Receivables - USD,Trade Receivables - USD Exchan";
                                            $query->execute();

                                            $subAccount = "Amount owing to a Shareholder";
                                            $accountNames = "Amount owing to directors";
                                            $query->execute();

                                            $subAccount = "Telephone Expenses";
                                            $accountNames = "Telephone charges,Telephone";
                                            $query->execute();

                                            $subAccount = "Exchanges";
                                            $accountNames = "Unrealised exchange difference,Unrealised exch - Non trade,Exchange difference,Unrealised exchange difference";
                                            $query->execute();
                                        }

                                        if (count($accountResult) === 0) {
                                            // Account Category ---------------------------------------------------
                                            $query = $DB_con->prepare("INSERT INTO account_category (company_name, client_company, account, account_names) VALUES (:company_name, :client_company, :account, :account_names)");
                                            $query->bindParam(':company_name', $companyName);
                                            $query->bindParam(':client_company', $clientName);
                                            $query->bindParam(':account', $account);
                                            $query->bindParam(':account_names', $accountNames);

                                            $account = "Accounting fee";
                                            $accountNames = "Accounting fee,Bookkeeping fee";
                                            $query->execute();

                                            $account = "Administrative expense";
                                            $accountNames = "Administrative expense";
                                            $query->execute();

                                            $account = "Bank charges";
                                            $accountNames = "Bank charges";
                                            $query->execute();

                                            $account = "Compilation fee";
                                            $accountNames = "Compilation fee";
                                            $query->execute();

                                            $account = "Depreciation";
                                            $accountNames = "Depreciation";
                                            $query->execute();

                                            $account = "Director's remuneration";
                                            $accountNames = "Director's remuneration,Director remuneration";
                                            $query->execute();

                                            $account = "Entertainment";
                                            $accountNames = "Entertainment,Business Entertainment";
                                            $query->execute();

                                            $account = "Employment pass";
                                            $accountNames = "Employment pass,Staff cost - employment pass";
                                            $query->execute();

                                            $account = "Exchange loss - trade";
                                            $accountNames = "Exchange loss - trade,Exchange difference,Unrealised exch - Non trade";
                                            $query->execute();

                                            $account = "Freight charges";
                                            $accountNames = "Freight charges,Freight paid";
                                            $query->execute();

                                            $account = "Insurance";
                                            $accountNames = "Insurance,Medical Expenses";
                                            $query->execute();

                                            $account = "Internet expenses";
                                            $accountNames = "Internet expenses";
                                            $query->execute();

                                            $account = "Late penalty";
                                            $accountNames = "Late Fees Paid,Late penalty";
                                            $query->execute();

                                            $account = "Nominee director fee";
                                            $accountNames = "Nominee director fee,Nominee Director Services";
                                            $query->execute();

                                            $account = "Office supplies";
                                            $accountNames = "Office Supplies";
                                            $query->execute();

                                            $account = "Postage and courier";
                                            $accountNames = "Postage and courier";
                                            $query->execute();

                                            $account = "Professional fee";
                                            $accountNames = "Professional fee";
                                            $query->execute();

                                            $account = "Printing and stationery";
                                            $accountNames = "Printing and stationery";
                                            $query->execute();

                                            $account = "Rental";
                                            $accountNames = "Rental,Rent";
                                            $query->execute();

                                            $account = "Salaries";
                                            $accountNames = "Staff Salaries,Wages & Salaries";
                                            $query->execute();

                                            $account = "Secretarial fee";
                                            $accountNames = "Secretarial fee,Secretarial services";
                                            $query->execute();

                                            $account = "Skill development levy & SINDA";
                                            $accountNames = "Skill Development Levy,Skill development levy & SINDA";
                                            $query->execute();

                                            $account = "Taxation fee";
                                            $accountNames = "Taxation fee,Taxation services";
                                            $query->execute();

                                            $account = "Travelling expenses";
                                            $accountNames = "Travelling expenses,Travelling";
                                            $query->execute();

                                            $account = "Transportation";
                                            $accountNames = "Transportation,Transport - Taxi fare";
                                            $query->execute();

                                            $account = "Telephone expenses";
                                            $accountNames = "Telephone expenses,Telephone,Telephone charges";
                                            $query->execute();

                                            $account = "Interest on bank borrowings";
                                            $accountNames = "Interest on bank borrowings";
                                            $query->execute();
                                        }
                                        
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
                                                echo "<b>Account name: </b> $allAccounts[$i] <br/>";
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

                                    $dateStart = $_POST['yearStart'];
                                    $dateEnd = $_POST['yearEnd'];
                                    
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
