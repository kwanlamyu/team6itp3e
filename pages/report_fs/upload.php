
<?php
require_once '../db_connection/db.php';
if (isset($_SESSION['username']) || isset($_SESSION['role_id']) || isset($_SESSION['company'])){
    if ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3){
      header("Location: ../user_login/login.php");
    } else {
include '../general/header.php';
include '../general/navigation_clientadmin.php';
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
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">

                <!--begin::Error Msg-->
                <?php
                $monthIdentifier = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                $query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name = :companyName AND client_company = :clientName");
                $query->bindParam(':companyName', $companyName);
                $query->bindParam(':clientName', $clientName);
                $companyName = $_SESSION['companyName'];
                $clientName = $_POST['clientCompany'];
                $clientUEN = $_POST['clientUEN'];
                $query->execute();
                $result = $query->setFetchMode(PDO::FETCH_ASSOC);
                $result = $query->fetchAll();
                $accountAndCategory = array();
                for ($i = 0; $i < count($result); $i++) {
                    $mainAccountName = $result[$i]['main_account'];
                    $individualAccountArray = explode(",", $result[$i]['account_names']);
                    $individualAccountNames = array();
                    $accountAndCategory[$mainAccountName] = array();
                    for ($x = 0; $x < count($individualAccountArray); $x++) {
                        array_push($individualAccountNames, trim($individualAccountArray[$x]));
                    }
                    if (strcasecmp($mainAccountName, "expenses") === 0) {
                        $expenseArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "assets") === 0) {
                        $assetsArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Capital") === 0) {
                        $capitalsArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Current Liabilities") === 0) {
                        $liabilitiesArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Non-current Liabilities") === 0) {
                        $nonCurrentLiabilitiesArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Both Liabilities") === 0) {
                        $bothLiabilitiesArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Non-current Assets") === 0) {
                        $nonCurrentAssetsArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Income") === 0) {
                        $incomeArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Administrative Expenses") === 0) {
                        $adminExpenseArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Distribution and Marketing Expenses") === 0) {
                        $distriMarketingExpenseArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Tax Payable") === 0) {
                        $taxPayableArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Exchange Gain - Trade") === 0) {
                        $exchangesTradeArray = $individualAccountNames;
                    } else if (strcasecmp($mainAccountName, "Exchange Gain - Non-trade") === 0) {
                        $exchangesNonTradeArray = $individualAccountNames;
                    }
                    $accountAndCategory[$mainAccountName] = $individualAccountNames;
                }
                $query = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name = :companyName AND client_company = :clientName");
                $query->bindParam(':companyName', $companyName);
                $query->bindParam(':clientName', $clientName);
                $companyName = $_SESSION['companyName'];
                $clientName = $_POST['clientCompany'];
                $query->execute();
                $result = $query->setFetchMode(PDO::FETCH_ASSOC);
                $result = $query->fetchAll();
                $subCategories = array();
                for ($i = 0; $i < count($result); $i++) {
                    $subName = $result[$i]['sub_account'];
                    $subCategories[$subName] = explode(",", $result[$i]['account_names']);
                }

                //install composer first
                //https://phpspreadsheet.readthedocs.io/en/develop/#learn-by-documentation
                //https://github.com/PHPOffice/PhpSpreadsheet
                // to change the path for autoload accordingly
                //require_once 'C:\Users\weeko\vendor\autoload.php';

                require_once __DIR__ . '\..\..\vendor\autoload.php';

                use PhpOffice\PhpSpreadsheet\Spreadsheet;

// use PhpOffice\PhpSpreadsheet\Reader\Csv;
                // can change to read csv file as well
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                // only read data
                $reader->setReadDataOnly(true);
                // set file to be read
                // only read active sheet, can change to read specific sheet
                // $sheetData = $spreadsheet->getActiveSheet()->toArray();
                $fileArray = $_POST['fileArray'];
                for ($i = 0; $i < count($fileArray); $i++) {
                    $target_file = $fileArray[$i];
                    $spreadsheet = $reader->load($target_file);
                    $numberOfSheets = $spreadsheet->getSheetCount();
                    if ($numberOfSheets > 1) {
                        die("Please upload only 1 sheet per trial balance.<br/><a href='javascript:history.go(-1)'>Upload again</a>");
                    }
                }

                echo "<br/>";

                $trialBalanceArray = array();
                $yearlyUndefinedRows = array();
                $endedAtArray = array();

                $yearEnded = "";

                for ($j = 0; $j < count($fileArray); $j++) {
                    $target_file = $fileArray[$j];
                    $spreadsheet = $reader->load($target_file);
                    $dataFound = 0;
                    // change of implementation, there is supposed to be only 1 sheet, therefore a 0 is set here
                    $activeSheet = 0;

                    $sheetData = $spreadsheet->getSheet($activeSheet)->toArray();
                    $trialBalanceArray[$j] = array();
                    $yearlyUndefinedRows[$j] = array();
                    // data in spreadsheet that are valid accounts will be saved into this array
                    $annualArray = array();
                    // the below can be changed to store rows of data instead of printing, for user to move accordingly
                    // data is in 2d array
                    // read row
                    $validCounter = 0;
                    $isDebit = false;
                    $accountColumn = false;
                    $debitColumn = false;
                    $creditColumn = false;
                    $categoryColumn = false;

                    // old implementation where TB includes company name and FY ended
                    for ($i = 0; $i < count($sheetData); $i++) {
                        for ($x = 0; $x < count($sheetData[$i]); $x++) {
                            $currentData = $sheetData[$i][$x];
                            if (!empty($currentData)) {
                                // if ($dataFound < 3) {
                                //     if ($dataFound == 0) {
                                //         $companyName = $currentData;
                                //         $dataFound++;
                                //     } elseif ($dataFound == 1) {
                                //         $dataFound++;
                                //     } elseif ($dataFound == 2) {
                                //         $fullDate = $currentData;
                                //         $yearEnded = substr($fullDate, -4);
                                //         array_push($endedAtArray, $fullDate);
                                //         $dataFound++;
                                //     }
                                // } else {
                                $endedAtArray = $_POST['dateEnd'];
                                if (gettype($accountColumn) == "boolean") {
                                    if (stripos($currentData, "account") !== false) {
                                        $accountColumn = $x;
                                    }
                                }
                                if (gettype($debitColumn) == "boolean") {
                                    if (stripos($currentData, "debit") !== false) {
                                        $debitColumn = $x;
                                    }
                                } elseif (gettype($creditColumn) == "boolean") {
                                    if (stripos($currentData, "credit") !== false) {
                                        $creditColumn = $x;
                                    }
                                }
                                // }
                            }
                        }
                        if (is_numeric($accountColumn) && is_numeric($debitColumn) && is_numeric($creditColumn)) {
                            $categoryColumn = $creditColumn + 1;
                            break;
                        }
                    }
                    // for ($i = 0; $i < count($sheetData); $i++){
                    // 	$accountName = $sheetData[$i][$accountColumn];
                    // 	if (stripos($accountName, "total:") !== false){
                    // 		break;
                    // 	}
                    // 	$catFound = 0;
                    // 	for ($x = 0; $x < count($adminExpenseArray); $x++){
                    // 		if (stripos($accountName, $adminExpenseArray[$x]) !== false || stripos($adminExpenseArray[$x], $accountName) !== false){
                    // 			$sheetData[$i][$categoryColumn] = "Administrative Expenses";
                    // 			$catFound = 1;
                    // 			break;
                    // 		}
                    // 	}
                    // 	if ($catFound == 0){
                    // 		for ($x = 0; $x < count($distriMarketingExpenseArray); $x++){
                    // 			if (stripos($accountName,$distriMarketingExpenseArray[$x]) !== false || stripos($distriMarketingExpenseArray[$x], $accountName) !== false){
                    // 				$sheetData[$i][$categoryColumn] = "Distribution and Marketing Expenses";
                    // 				$catFound = 1;
                    // 				break;
                    // 			}
                    // 		}
                    // 	}
                    // 	if ($catFound == 0){
                    // 		for ($x = 0; $x < count($taxPayableArray); $x++){
                    // 			if (stripos($accountName, $taxPayableArray[$x]) !== false || stripos($taxPayableArray[$x], $accountName) !== false){
                    // 				$sheetData[$i][$categoryColumn] = "Current Income Tax Liabilities";
                    // 				$catFound = 1;
                    // 				break;
                    // 			}
                    // 		}
                    // 	}
                    // 	if ($catFound == 0){
                    // 		for ($x = 0; $x < count($incomeArray); $x++){
                    // 			if (stripos($accountName,$incomeArray[$x]) !== false || stripos($incomeArray[$x], $accountName) !== false){
                    // 				$sheetData[$i][$categoryColumn] = "Distribution and Marketing Expenses";
                    // 				$catFound = 1;
                    // 				break;
                    // 			}
                    // 		}
                    // 	}
                    // }
                    for ($i = 0; $i < count($sheetData); $i++) {
                        $accountName = $sheetData[$i][$accountColumn];
                        $catFound = 0;
                        foreach ($subCategories as $key => $value) {
                            foreach ($value as $k => $v) {
                                if (strcasecmp($v, $accountName) === 0) {
                                    $sheetData[$i][$categoryColumn] = $key;
                                    $catFound = 1;
                                    break;
                                }
                            }
                            if ($catFound == 1) {
                                break;
                            }
                        }
                    }

                    for ($i = 0; $i < count($sheetData); $i++) {
                        if (stripos($sheetData[$i][$categoryColumn], "Exchange") !== false) {
                            $accountName = $sheetData[$i][$accountColumn];
                            $identifiedTrade = 0;
                            if (!empty($sheetData[$i][$creditColumn])) {
                                foreach ($exchangesTradeArray as $key => $value) {
                                    if (strcasecmp($accountName, $value) === 0) {
                                        $sheetData[$i][$categoryColumn] = "Exchange Gain - Trade";
                                        $identifiedTrade = 1;
                                        break;
                                    }
                                }
                                if ($identifiedTrade == 0) {
                                    foreach ($exchangesNonTradeArray as $key => $value) {
                                        if (strcasecmp($accountName, $value) === 0) {
                                            $sheetData[$i][$categoryColumn] = "Exchange Gain - Non-trade";
                                            break;
                                        }
                                    }
                                }
                            } else if (!empty($sheetData[$i][$debitColumn])) {
                                $sheetData[$i][$categoryColumn] = "Administrative Expenses";
                            }
                        }
                    }

                    $modifiedCategoryArray = array();
                    $undefinedRows = array();
                    $rowCounter = 0;
                    for ($i = 0; $i < count($sheetData); $i++) {
                        $accountValue = $sheetData[$i][$accountColumn];

                        if (stripos($accountValue, "total:") !== false) {
                            break;
                        } else {
                            $amount = 0;
                            $debitOrCredit = "";
                            if (is_numeric($sheetData[$i][$debitColumn])) {
                                $amount = $sheetData[$i][$debitColumn];
                                $debitOrCredit = "debit";
                            } elseif (is_numeric($sheetData[$i][$creditColumn])) {
                                $amount = $sheetData[$i][$creditColumn];
                                $debitOrCredit = "credit";
                            } else {
                                continue;
                            }
                            $tempArray = array();
                            $originalCatValue = "";
                            $categoryValue = trim($sheetData[$i][$categoryColumn]);
                            if (empty($categoryValue)) {
                                $categoryValue = "undefined";
                                array_push($undefinedRows, $rowCounter);
                            }

                            if (in_array($categoryValue, $adminExpenseArray)) {
                                $originalCatValue = $categoryValue;
                                $categoryValue = "Administrative Expenses";
                            } elseif (in_array($categoryValue, $distriMarketingExpenseArray)) {
                                $originalCatValue = $categoryValue;
                                $categoryValue = "Distribution and Marketing Expenses";
                            } elseif (in_array($categoryValue, $taxPayableArray)) {
                                $originalCatValue = $categoryValue;
                                $categoryValue = "Current Income Tax Liabilities";
                            }
                            array_push($tempArray, $accountValue);
                            array_push($tempArray, $amount);
                            array_push($tempArray, $categoryValue);
                            array_push($tempArray, $debitOrCredit);
                            array_push($annualArray, $tempArray);
                            if (!empty($originalCatValue)) {
                                array_push($modifiedCategoryArray, $originalCatValue . "," . $categoryValue);
                            }
                        }
                        $rowCounter++;
                    }
                    array_push($trialBalanceArray[$j], $yearEnded);
                    array_push($trialBalanceArray[$j], $annualArray);

                    array_push($yearlyUndefinedRows[$j], $yearEnded);
                    array_push($yearlyUndefinedRows[$j], $undefinedRows);
                }
                // end loop here
                //begin::Company Name
                echo '<!--begin::Portlet--> <div class="m-portlet m-portlet--full-height">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">' . $companyName . '</h3>
											</div>
										</div>
									</div><div class="m-portlet__body">';

                //begin::Accordion
                for ($x = 0; $x < count($endedAtArray); $x++) {
                    $tempDateParts = explode("-", $endedAtArray[$x]);
                    $tempDateString = $monthIdentifier[$tempDateParts[1] - 1] . " " . $tempDateParts[0];
                    $endedAtArray[$x] = $tempDateString;
                }
                for ($i = 0; $i < count($trialBalanceArray); $i++) {
                    echo '<div class="m-accordion m-accordion--default m-accordion--toggle-arrow" id="m_accordion_' . $i . '" role="tablist">
											<div class="m-accordion__item m-accordion__item--info">

												<div class="m-accordion__item-head collapsed" srole="tab" id="m_accordion_' . $i . '_item_1_head" data-toggle="collapse" href="#m_accordion_' . $i . '_item_1_body" aria-expanded="  false">
													<span class="m-accordion__item-icon">
														<i class="fa flaticon-user-ok"></i>
													</span>
													<span class="m-accordion__item-title">';
                    echo $endedAtArray[$i];

                    echo '</span>
													<span class="m-accordion__item-mode"></span>
												</div>

												<div class="m-accordion__item-body collapse" id="m_accordion_' . $i . '_item_1_body" class=" " role="tabpanel" aria-labelledby="m_accordion_' . $i . '_item_1_head" data-parent="#m_accordion_' . $i . '">
													<div class="m-accordion__item-content">';

                    $yearlyArray = $trialBalanceArray[$i][1];
                    for ($x = 0; $x < count($yearlyUndefinedRows[$i][1]); $x++) {
                        $contextPrinted = false;

                        $rows = $yearlyArray[$yearlyUndefinedRows[$i][1][$x]];
                        $currentRowCounter = $yearlyUndefinedRows[$i][1][$x];
                        echo "<hr/>";
                        if (($currentRowCounter + 2) > count($yearlyArray)) {
                            for ($k = $currentRowCounter - 2; $k < $currentRowCounter; $k++) {
                                $previousRow = $yearlyArray[$k];
                                for ($j = 0; $j < count($previousRow); $j++) {
                                    echo $previousRow[$j] . " ";
                                }
                                echo "<br/>";
                            }
                            $contextPrinted = true;
                        }
                        for ($j = 0; $j < count($rows); $j++) {
                            if ($j != 2) {
                                echo($rows[$j] . " ");
                            } else {
                                echo "<select id='catUpdate" . $i . $x . "'>";
                                echo "<option value=''> </option>";
                                if (strcasecmp($rows[3], "debit") == 0) {
                                    echo "<option disabled>---Assets---</option>";
                                    for ($k = 0; $k < count($assetsArray); $k++) {
                                        echo "<option value='" . $assetsArray[$k] . "'>" . $assetsArray[$k] . "</options>";
                                    }
                                    echo "<option disabled>---Expenses---</option>";
                                    for ($k = 0; $k < count($expenseArray); $k++) {
                                        echo "<option value='" . $expenseArray[$k] . "'>" . $expenseArray[$k] . "</options>";
                                    }
                                } else {
                                    echo "<option disabled>---Assets(Liabilities)---</option>";
                                    for ($k = 0; $k < count($nonCurrentAssetsArray); $k++) {
                                        echo "<option value='" . $nonCurrentAssetsArray[$k] . "'>" . $nonCurrentAssetsArray[$k] . "</options>";
                                    }
                                    echo "<option disabled>---Liabilities---</option>";
                                    for ($k = 0; $k < count($liabilitiesArray); $k++) {
                                        echo "<option value='" . $liabilitiesArray[$k] . "'>" . $liabilitiesArray[$k] . "</options>";
                                    }
                                    echo "<option disabled>---Income---</option>";
                                    for ($k = 0; $k < count($incomeArray); $k++) {
                                        echo "<option value='" . $incomeArray[$k] . "'>" . $incomeArray[$k] . "</options>";
                                    }
                                    echo "<option disabled>---Capital---</option>";
                                    for ($k = 0; $k < count($capitalsArray); $k++) {
                                        echo "<option value='" . $capitalsArray[$k] . "'>" . $capitalsArray[$k] . "</options>";
                                    }
                                }
                                echo "</select>&#9;";
                            }
                        }

                        echo "<br/>";
                        if ($contextPrinted == false) {
                            for ($k = $currentRowCounter + 1; $k < $currentRowCounter + 3; $k++) {
                                $nextRow = $yearlyArray[$k];
                                for ($j = 0; $j < count($nextRow); $j++) {
                                    echo $nextRow[$j];
                                }
                                echo "<br/>";
                            }
                        }
                    }
                    echo'</div>
												</div>
											</div>
										</div>';
                    //end::Accordion
                }

// no longer required due to change of implementation, updating of categories is now done in updateCategories.php
                //begin::Modified
                // if (count($modifiedCategoryArray) > 0) {
                //     echo '<div class="m-accordion m-accordion--default m-accordion--toggle-arrow" id="m_accordion_m" role="tablist"><div class="m-accordion__item m-accordion__item--info">
                //
				// 								<div class="m-accordion__item-head collapsed" srole="tab" id="m_accordion_m_item_1_head" data-toggle="collapse" href="#m_accordion_m_item_1_body" aria-expanded="  false">
                // 									<span class="m-accordion__item-icon">
                // 										<i class="fa flaticon-user-ok"></i>
                // 									</span>
                // 									<span class="m-accordion__item-title">Replaced Categories</span>
                // 									<span class="m-accordion__item-mode"></span>
                // 								</div>
                // 								<div class="m-accordion__item-body collapse" id="m_accordion_m_item_1_body" class=" " role="tabpanel" aria-labelledby="m_accordion_5_item_1_head" data-parent="#m_accordion_m">
                // 									<div class="m-accordion__item-content"><p>';
                //     echo '<table class="table table-bordered m-table m-table--border-success">
                // 							<thead>
                // 								<tr>
                // 									<th>
                // 										#
                // 									</th>
                // 									<th>
                // 										Previous Name
                // 									</th>
                // 									<th>
                // 										Replaced Name
                // 									</th>
                // 								</tr>
                // 							</thead>
                // 							<tbody>';
                //     for ($i = 0; $i < count($modifiedCategoryArray);$i++) {
                //         $tempStr = explode(",", $modifiedCategoryArray[$i]);
                //         echo '<tr>';
                //         echo '<th scope="row">'.$i.'</th>';
                //         echo '<td>'.$tempStr[0].'</td>';
                //         echo '<td>'.$tempStr[1].'</td>';
                //         echo '</tr>';
                //     }
                //     echo '</tbody>
                // 						</table>';
                //     /* Old Code for Reference
                //       for ($i = 0; $i < count($modifiedCategoryArray);$i++){
                //         $tempStr = explode(",", $modifiedCategoryArray[$i]);
                //         echo $tempStr[0] . ' --> ' . $tempStr[1] . '<br>';
                //       }
                //       */
                //     echo '
                // 										</p>
                // 									</div>
                // 								</div>
                //
				// 							</div>
                // 							</div>';
                // }
                ?>

                <br>
                <form name='detailsForm' action="next_page.php" method="post" onsubmit="return validateForm()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">


                    <div class="m-portlet__body">
                        <!-- Yok yee's required data here -->
                        <div class="form-group m-form__group row">
                            <!-- <label for="companyName" class="col-lg-2 col-form-label">
                                    Company Name
                            </label> -->
                            <!-- <div class="col-lg-3">
                                    <input class="form-control m-input" type="text" id="companyName" name="companyName" value="<?php echo $companyName ?>">
                                    <span class="m-form__help">
                                            Please enter company name
                                    </span>
                            </div> -->
                            <!-- <label for="companyregID"class="col-lg-2 col-form-label">
                                Company Registration No.
                            </label> -->
                            <div class="col-lg-3">
                                <input class="form-control m-input" type="hidden" id="companyregID" name="companyregID" value="<?php echo $clientUEN?>">;
                                <!-- <span class="m-form__help">
                                    Please enter company registration number
                                </span> -->
                            </div>
                        </div>
                    </div>

<?php
$month = substr($endedAtArray[0], 0, -5);
$monthInNumber = 0;

for ($i = 0; $i < count($monthIdentifier); $i++) {
    if (stripos($monthIdentifier[$i], trim($month)) !== false) {
        $monthInNumber = $i + 1;
    }
}

$yearEnded = substr($endedAtArray[0], -4);
$numberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthInNumber, $yearEnded);
$date = date_create("$yearEnded-$monthInNumber-$numberOfDaysInMonth");

$previousyearEnded = substr($endedAtArray[0], -4);
$previousnumberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthInNumber, $previousyearEnded);
$previousyearEnded = $previousyearEnded - 1;
$previousdate = date_create("$previousyearEnded-$monthInNumber-$previousnumberOfDaysInMonth");

$today = date("Y-m-d");
$separatedDate = explode("-", $today);
$todayObject = date_create("$separatedDate[0]-$separatedDate[1]-$separatedDate[2]");
?>

                    <hr/>
                    <div class="form-group">
                        <!-- <label for="yearEnd">Financial Year Ended: </label> -->
                        <input type="hidden" class="form-control" id="yearEnd" name="yearEnd" value="<?php echo date_format($date, "Y-m-d"); ?>"/>
                    </div>

                    <button onclick="addDirectorFunction()" type='button' id='addDirector'>Add Director</button>

                    <div class="form-group" id='directorFields'>
                        <label for="directorName0">Director Name: </label>
                        <input type ="text" id="directorName0" />
                        <input type="hidden" id="tempDirectorArray" name="tempDirectorArray" value="" />

                        <label for="directorName0">Appointed Date:</label>
                        <input type ="date" id="directorNameApptDate0" />
                        <input type="hidden" id="tempDateArray" name="tempDateArray" value="" />

                        <label for="directorShare0">Director's Start Share:</label>
                        <input type ="number" id="directorStartShare0" />
                        <input type="hidden" id="tempStartShareArray" name="tempStartShareArray" value="" />

                        <label for="directorShare0">Director's End Share:</label>
                        <input type ="number" id="directorEndShare0" />
                        <input type="hidden" id="tempEndShareArray" name="tempEndShareArray" value="" />
                        <br>
                    </div>

                    <!-- <div class="form-group"> -->
                    <!-- <label for="todayDate">Today Date: </label> -->
                    <input type="hidden" class="form-control" id="todayDate" name="todayDate" value="<?php echo date("Y-m-d"); ?>"/>
                    <!-- </div> -->

                    <!-- <div class="form-group">
                        <label for="firstBalanceDate">First Balance Date: </label>
                        <input type="date" class="form-control" id="firstBalanceDate" name="firstBalanceDate"/>
                    </div> -->

                    <!-- <div class="form-group"> -->
                    <!-- <label for="secondBalanceDate">Previous financial year ended date: </label> -->
                    <input type="hidden" class="form-control" id="secondBalanceDate" name="secondBalanceDate" value="<?php echo date_format($previousdate, "Y-m-d"); ?>"/>
                    <!-- </div> -->

                    <!-- <div class="form-group"> -->
                    <!-- <label for="thirdBalanceDate">Financial year ended date: </label> -->
                    <input type="hidden" class="form-control" id="thirdBalanceDate" name="thirdBalanceDate" value="<?php echo date_format($date, "Y-m-d"); ?>"/>
                    <!-- </div> -->

                    <div class="form-group">
                        <label for="companyPA">Company's principal activities: </label>
                        <input type="textarea" class="form-control" id="companyPA" name="companyPA"/>
                    </div>

                    <div class="form-group">
                        <label for="companyAddress">Company's address: </label>
                        <input type="text" class="form-control" id="companyAddress" name="companyAddress"/>
                    </div>

                    <div class="form-group">
                        <label for="frsDate">Date Company Adopted FRS: </label>
                        <input type="date" class="form-control" id="frsDate" name="frsDate"/>
                    </div>

                    <div class="form-group">
                        <label for="currency">Currency: </label>
                        <input type="text" class="form-control" id="currency" name="currency" placeholder='E.g. Singapore Dollar' value="Singapore Dollar"/>
                    </div>

                    <!-- yok yee required data end -->
<?php
echo "<input type='hidden' name='companyName' value='" . $clientName . "'/>";
echo "<input type='hidden' name='numberOfYears' value='" . count($fileArray) . "'/>";
for ($i = 0; $i < count($trialBalanceArray); $i++) {
    echo "<input type='hidden' name='years[]' value='" . $endedAtArray[$i] . "'/>";
    $yearArray = $trialBalanceArray[$i][1];
    for ($x = 0; $x < count($yearArray); $x++) {
        $allRows = $yearArray[$x];
        for ($j = 0; $j < count($allRows); $j++) {
            echo "<input type='hidden' name='data[" . $i . "][$x][]' value='" . $allRows[$j] . "' id='formData" . $i . $x . $j . "'/>";
        }
    }
}
?>
                    <input name="submit" type="submit" value="Submit" class="btn btn-brand">
                </form>


                <script type="text/javascript">

                    function updateCategory() {
                        var numberOfYears = <?php echo count($trialBalanceArray); ?>;
                        var undefinedArray = <?php echo json_encode($yearlyUndefinedRows); ?>;
                        for (var j = 0; j < numberOfYears; j++) {
                            var undefinedCounter = undefinedArray[j][1].length;
                            for (var i = 0; i < undefinedCounter; i++) {
                                var selectOption = document.getElementById("catUpdate" + j + i);
                                // alert(document.getElementById("catUpdate"+undefinedRows[i]).value);
                                document.getElementById("formData" + j + undefinedArray[j][1][i] + "2").value = selectOption.options[selectOption.selectedIndex].text;
                            }
                        }
                        // after update of category, update directors
                        updateDirectors();
                    }

                    var count = 1;
                    var tempDirectorArray = [];
                    var tempDateArray = [];
                    var tempStartShareArray = [];
                    var tempEndShareArray = [];

                    function validateForm() {
                        var submitBtn = document.forms['detailsForm']['submit'];
                        submitBtn.disabled = true;
                        updateCategory();
                        // tempDirectorArray, tempDateArray, tempStartShareArray,tempEndShareArray are taken from updateDirectors()
                        var today = new Date();
                        var companyUEN = document.forms['detailsForm']["companyregID"].value;
                        var companyPrincipalActivities = document.forms['detailsForm']['companyPA'].value;
                        var companyAdd = document.forms['detailsForm']['companyAddress'].value;
                        var adoptedFrs = document.forms['detailsForm']['frsDate'].value;
                        var currency = document.forms['detailsForm']['currency'].value;
                        var directorFlag = 0;
                        var directorError = "";
                        for (i = 0; i < count; i++) {
                            if (tempDirectorArray[i] == "" || tempDateArray[i] == "" || tempStartShareArray[i] == "" || tempEndShareArray[i] == "") {
                                directorFlag = 1;
                                directorError = "All inputs required for directors";
                                break;
                            } else {
                                if (tempStartShareArray[i] <= 0) {
                                    directorFlag = 1;
                                    directorError = "Start share cannot be 0 or less";
                                    break;
                                }
                                appointYear = tempDateArray[i].substring(0, 4);
                                appointMonth = tempDateArray[i].substring(5, 7);
                                appointDay = tempDateArray[i].substring(8, 10);
                                var appointDate = new Date(appointYear, appointMonth - 1, appointDay);
                                if (appointDate > today) {
                                    directorFlag = 1;
                                    directorError = "Director cannot be appointed later than today";
                                    break;
                                }
                            }
                        }
                        frsFlag = 0;
                        frsError = "";
                        if (adoptedFrs == "") {
                            frsFlag = 1;
                            frsError = "FRS date must be entered";
                        } else {
                            frsYear = adoptedFrs.substring(0, 4);
                            frsMonth = adoptedFrs.substring(5, 7);
                            frsDay = adoptedFrs.substring(8, 10);
                            var formattedAdoptedDate = new Date(frsYear, frsMonth - 1, frsDay);
                            if (formattedAdoptedDate > today) {
                                frsFlag = 1;
                                frsError = "Date FRS adopted should not be later than today";
                            }
                        }
                        if (companyUEN == "" || directorFlag == 1 || companyPrincipalActivities == "" || companyAdd == "" || frsFlag == 1 || currency == "") {
                            if (companyUEN == "") {
                                alert("Company UEN must be entered");
                            }
                            if (directorFlag == 1) {
                                alert(directorError);
                            }
                            if (companyPrincipalActivities == "") {
                                alert("Company Principal Activities must be entered");
                            }
                            if (companyAdd == "") {
                                alert("Company address must be entered");
                            }
                            if (frsFlag == 1) {
                                alert(frsError);
                            }
                            if (currency == "") {
                                alert("Currency must be entered");
                            }
                            submitBtn.disabled = false;
                            return false;
                        } else {
                            return true;
                        }
                    }

                    function addDirectorFunction() {

                        addDirectorFields();

                        document.getElementById('directorFields').innerHTML += "Director Name: <input type='text' id='directorName" + count + "'> \n\
                                                                                            Appointed Date: <input type='date' id='directorNameApptDate" + count + "'> \n\
                                                                                            Director's Start Share: <input type='number' id='directorStartShare" + count + "'>\n\
                                                                                            Director's End Share: <input type='number' id='directorEndShare" + count + "'> \n\</br> ";

                        for (i = 0; i < count; i++) {
                            document.getElementById('directorName' + i).value = tempDirectorArray[i];
                            document.getElementById('directorNameApptDate' + i).value = tempDateArray[i];
                            document.getElementById('directorStartShare' + i).value = tempStartShareArray[i];
                            document.getElementById('directorEndShare' + i).value = tempEndShareArray[i];
                        }
                        count++;

                    }

                    function addDirectorFields() {
                        for (i = 0; i < count; i++) {
                            tempDirectorArray[i] = document.getElementById('directorName' + i).value;
                            tempDateArray[i] = document.getElementById('directorNameApptDate' + i).value;
                            tempStartShareArray[i] = document.getElementById('directorStartShare' + i).value;
                            tempEndShareArray[i] = document.getElementById('directorEndShare' + i).value;
                        }
                    }

                    function updateDirectors() {
                        tempDirectorArray = [];
                        tempDateArray = [];
                        tempStartShareArray = [];
                        tempEndShareArray = [];

                        for (i = 0; i < count; i++) {
                            tempDirectorName = document.getElementById('directorName' + i).value;
                            tempDirectorDate = document.getElementById('directorNameApptDate' + i).value;
                            tempDirectorStartShare = document.getElementById('directorStartShare' + i).value;
                            tempDirectorEndShare = document.getElementById('directorEndShare' + i).value;

                            // if(tempDirectorName != ""){
                            tempDirectorArray.push(tempDirectorName);
                            tempDateArray.push(tempDirectorDate);
                            tempStartShareArray.push(tempDirectorStartShare);
                            tempEndShareArray.push(tempDirectorEndShare);
                            // }

                        }
                        document.getElementById('tempDirectorArray').value = tempDirectorArray;
                        document.getElementById('tempDateArray').value = tempDateArray;
                        document.getElementById('tempStartShareArray').value = tempStartShareArray;
                        document.getElementById('tempEndShareArray').value = tempEndShareArray;

                    }
                </script>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

<?php
}
} else {
header("Location: ../user_login/login.php");
}
 ?>
<?php include '../general/footer_content.php'; ?>
<?php include '../general/footer.php'; ?>
