<?php
// use this when live
// define('URL', 'https://3ecomply.com/');



define('URL', '');
ob_start();



//include 'header.php';
// PHPWord depedency
require_once __DIR__ . '\..\..\vendor\autoload.php';
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
            //require_once 'C:\xampp\htdocs\phpWordsItp\vendor\autoload.php';
            $phpWord = new \PhpOffice\PhpWord\PhpWord();
            //Default font style
            $phpWord->setDefaultFontName('Arial');
            $phpWord->setDefaultFontSize(11);

            //Create font style
            $fontStyleBigBlack = 'ArialBlack14';
            $fontStyleBlack = 'ArialBlack11';
            $fontstyleName = 'Arial11';
            $fontstyleUnderline = 'Arial11Underline';
            $fontstyleBottomUnderline = 'TableUnderline';
            $fontStyleItalic = 'Arial11Italic';

            $phpWord->addFontStyle($fontStyleBigBlack, array('name' => 'Arial', 'size' => 14, 'bold' => true)
            );
            $phpWord->addFontStyle($fontStyleBlack, array('name' => 'Arial', 'size' => 11, 'bold' => true)
            );
            $phpWord->addFontStyle($fontstyleName, array('name' => 'Arial', 'size' => 11, 'bold' => false)
            );
            $phpWord->addFontStyle($fontstyleBottomUnderline, array('name' => 'Arial', 'size' => 11, 'bold' => false, 'underline' => 'single')
            );
            $phpWord->addFontStyle($fontStyleItalic, array('name' => 'Arial', 'size' => 11, 'bold' => false, 'italic' => true));


            $centerAlignment = array('align' => 'center', 'spaceAfter' => 0);
            $noSpace = array('spaceAfter' => 0);
            $cellBottomBorder = array('borderBottomSize' => '1', 'borderBottomColor' => '000000');
            $cellThickBottomBorder = array('borderBottomSize' => '18', 'borderBottomColor' => '000000');
            $cellTopBorder = array('borderTopSize' => '1', 'borderBottomColor' => '000000');
            $topAndBottom = array('borderTopSize' => '1', 'borderTopColor' => '#000000', 'borderBottomSize' => '18', 'borderBottomColor' => '#000000');
            $cellTopAndBottomNormal = array('borderTopSize' => '1', 'borderTopColor' => '#000000', 'borderBottomSize' => '1', 'borderBottomColor' => '#000000');
            $borderTopAndLeft = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000');
            $borderTopAndRight = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000');
            $borderTop = array('borderTopSize' => 1, 'borderTopColor' => '#000000');
            $borderLeft = array('borderLeftSize' => 1, 'borderLeftColor' => '#000000');
            $borderRight = array('borderRightSize' => 1, 'borderRightColor' => '#000000');
            $borderBottomAndLeft = array('borderBottomSize' => 1, 'borderBottomColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000');
            $borderBottomAndRight = array('borderBottomSize' => 1, 'borderBottomColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000');
            $allBorders = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000', 'borderBottomSize' => 1, 'borderBottomColor' => '#000000');

//Create listing style
            $listingStyle = 'multilevel';
            $phpWord->addNumberingStyle(
                    $listingStyle, array(
                'type' => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'lowerRoman', 'text' => '(%2)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerLetter', 'text' => '%3)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerLetter', 'text' => '(%4)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerLetter', 'text' => '(%5)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerLetter', 'text' => '(%6)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerLetter', 'text' => '(%7)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720, 'start' => 14),
                    array('format' => 'lowerLetter', 'text' => '(%8)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720, 'start' => 9)
                )
                    )
            );

            $nestedListStyle = 'nestedlevel';
            $phpWord->addNumberingStyle(
                    $nestedListStyle, array(
                'type' => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 1),
                    array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
                    array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
                    array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
                    array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
                    array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
                    array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
                    array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2),
                )
                    )
            );

            $romanListingStyle = 'romanlevel';
            $phpWord->addNumberingStyle(
                    $romanListingStyle, array(
                'type' => 'multilevel',
                'levels' => array(
                    array('format' => 'lowerRoman', 'text' => '(%1)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerRoman', 'text' => '(%2)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerRoman', 'text' => '(%3)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerRoman', 'text' => '(%4)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerRoman', 'text' => '(%5)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerRoman', 'text' => '(%6)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
                    array('format' => 'lowerRoman', 'text' => '(%7)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
                )
                    )
            );

// Phoebe's style
            $phpWord->addFontStyle('myOwnStyle', array('color' => 'FF0000'));
            $phpWord->addParagraphStyle('P-Style', array('spaceAfter' => 95));
            $phpWord->addNumberingStyle(
                    'multilevel', array(
                'type' => 'multilevel',
                'levels' => array(
                    array('format' => 'decimal', 'text' => '%8.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'upperLetter', 'text' => '%9.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                ),
                    )
            );
            $predefinedMultilevel = array('listType' => \PhpOffice\PhpWord\Style\ListItem::TYPE_NUMBER_NESTED);

//Create Paragraph style
            $paragraphStyle = 'justifiedParagraph';
            $phpWord->addParagraphStyle($paragraphStyle, array('align' => 'both', 'spaceAfter' => 100));

// =============================================================================
// KOKHOE
// =============================================================================
            $data = $_POST['data'];
            $numberOfSheets = $_POST['numberOfYears'];
            $years = $_POST['years'];
            $yearsString = $_POST['years']; // Phoebe usage only
            $companyName = $_POST['companyName'];

// =============================================================================
// YOKYEE
// =============================================================================
// Declare all variables for form
            $companyregID = $_POST["companyregID"];
            $yearEnd = $_POST["yearEnd"];
            $tempDirectorArray = $_POST['tempDirectorArray'];
            $tempDateArray = $_POST['tempDateArray'];
            $tempStartShareArray = $_POST['tempStartShareArray'];
            $tempEndShareArray = $_POST['tempEndShareArray'];
            $todayDate = $_POST["todayDate"];
// $firstBalanceDate = $_POST["firstBalanceDate"];
// $secondBalanceDate = $_POST["secondBalanceDate"];
// $thirdBalanceDate = $_POST["thirdBalanceDate"];
            $companyPA = $_POST["companyPA"];
            $companyAddress = $_POST["companyAddress"];
            $frsDate = $_POST['frsDate'];
            $currency = $_POST['currency'];

            $directorName = explode(",", $tempDirectorArray);
            $directorAppointedDate = explode(",", $tempDateArray);
            $directorStartShare = explode(",", $tempStartShareArray);
            $directorEndShare = explode(",", $tempEndShareArray);
            $noOfDirectors = count($directorName);

// =============================================================================
// PHOEBE
// =============================================================================
// change from string to array
            $yearsArray = implode(" ", $yearsString);
// split the string by "," to get the years
            $years = explode(",", $yearsArray);

            $getHiddenData = $_POST['passData'];

//echo "<b>Original Data: </b>" . $getHiddenData . "<hr>";
// Convert String to array, then delete away the "*" // convert all to small caps
            $categoryDataArray = explode("*", strtolower($getHiddenData));

// Deleting first array item
            $removedFirstItem = array_shift($categoryDataArray);

            $arrayValue = array();
            $arrayAccount = array();
            $fullArray = array();

// Loop the category
            for ($i = 0; $i < count($categoryDataArray); $i++) {
                // Removed unwanted ","
                $categoryDataArray[$i] = trim($categoryDataArray[$i], ",");

                // Split string into array
                $individualNote = explode(",", $categoryDataArray[$i]);

                // $individualNote[1] is category name
                // Display the accounts for that particular category
                for ($j = 1; $j < count($individualNote); $j++) {

                    // use this to recognise the year
                    $getFirstCharacter = substr($individualNote[$j], 1, 1);

                    // this is the rest of the value [account#value]
                    $withoutFirstCharacter = substr($individualNote[$j], 2);

                    // Split the value by '#'
                    // $accountValueArray[0] = account
                    // $accountValueArray[1] = value
                    $accountValueArray = explode("#", $withoutFirstCharacter);

                    if (empty($arrayAccount)) {
                        for ($k = 0; $k < count($years); $k++) {
                            if ($getFirstCharacter == $k) {
                                $arrayValue[$years[$k]] = (float) $accountValueArray[1];
                            }
                        }

                        $arrayAccount[$accountValueArray[0]] = $arrayValue;
                        $fullArray[$individualNote[0]] = $arrayAccount;

                        unset($arrayValue);
                        $arrayValue = array();
                    } else {
                        if (in_array($accountValueArray[0], array_keys($arrayAccount))) {
                            foreach ($fullArray as $key => $array) {
                                foreach ($array as $account => $v) {
                                    if ($account == $accountValueArray[0]) {

                                        for ($k = 0; $k < count($years); $k++) {
                                            if ($getFirstCharacter == $k) {
                                                $v[$years[$k]] = (float) $accountValueArray[1];
                                            }
                                        }

                                        $arrayAccount[$accountValueArray[0]] = $v;
                                        $fullArray[$individualNote[0]] = $arrayAccount;
                                    }
                                }
                            }
                        } else {
                            for ($k = 0; $k < count($years); $k++) {
                                if ($getFirstCharacter == $k) {
                                    $arrayValue[$years[$k]] = (float) $accountValueArray[1];
                                }
                            }

                            $arrayAccount[$accountValueArray[0]] = $arrayValue;
                            $fullArray[$individualNote[0]] = $arrayAccount;

                            unset($arrayValue);
                            $arrayValue = array();
                        }
                    }
                }
                unset($arrayAccount);
                $arrayAccount = array();
            }

            $accountArray = array();
            $valueArray = array();
            $categoryArray = array();

            for ($aa = 0; $aa < $numberOfSheets; $aa++) {
                // Seperate the data into different category
                for ($ab = 0; $ab < count($data[$aa]); $ab++) {
                    array_push($categoryArray, strtolower($data[$aa][$ab][2]));
                    array_push($accountArray, strtolower($aa . $data[$aa][$ab][0]));
                    array_push($valueArray, $data[$aa][$ab][1]);
                }
            }

            $incomeTaxPayable = array();
            for ($i = 0; $i < count($accountArray); $i++) {
                if (stripos($accountArray[$i], "income tax payable") !== false) {
                    // ceil is to round up value
                    array_push($incomeTaxPayable, ceil($valueArray[$i]));
                }
            }

            $incomeTaxExpenses = array();
            for ($i = 0; $i < count($accountArray); $i++) {
                if (stripos($accountArray[$i], "income tax expense") !== false) {
                    // ceil is to round up value
                    array_push($incomeTaxExpenses, ceil($valueArray[$i]));
                }
            }

            $borrowings = array();
            for ($i = 0; $i < count($accountArray); $i++) {
                if (stripos($accountArray[$i], "borrowing") !== false) {
                    // round is to round down value
                    array_push($borrowings, round($valueArray[$i]));
                }
            }

            $shareCapital = array();
// 0 = 2016 , 1 = 2015 , 2 = 2014 , etc ...
            for ($aa = 0; $aa < $numberOfSheets; $aa++) {
                for ($ab = 0; $ab < count($data[$aa]); $ab++) {
                    if (strcasecmp($data[$aa][$ab][2], "share capital") == 0) {
                        $shareCapital[$aa] = $data[$aa][$ab][1];
                    }
                }
            }

// ---- Cost----
            $tempSoftware = array();
            $tempComputer = array();
            $tempOfficeEquipment = array();

// ---- Accumulated depreciation ----
            $depSoftware = array();
            $depComputer = array();
            $depOfficeEquipment = array();

// 0 = 2016 , 1 = 2015 , 2 = 2014 , etc ...
            for ($aa = 0; $aa < $numberOfSheets; $aa++) {
                for ($ab = 0; $ab < count($data[$aa]); $ab++) {
                    if (strcasecmp($data[$aa][$ab][2], "plant and equipment") == 0) {
                        // ---- Cost----
                        if (strcasecmp($data[$aa][$ab][0], "office equipment at cost") == 0) {
                            $tempOfficeEquipment[$aa] = $data[$aa][$ab][1];
                        }

                        if (strcasecmp($data[$aa][$ab][0], "computer & servers - cost") == 0) {
                            $tempComputer[$aa] = $data[$aa][$ab][1];
                        }

                        if (strcasecmp($data[$aa][$ab][0], "softwares at cost") == 0) {
                            $tempSoftware[$aa] = $data[$aa][$ab][1];
                        }

                        // ---- Accumulated depreciation ----
                        if (strcasecmp($data[$aa][$ab][0], "office equipment accum dep") == 0) {
                            $depOfficeEquipment[$aa] = $data[$aa][$ab][1];
                        }

                        if (strcasecmp($data[$aa][$ab][0], "softwares accum dep") == 0) {
                            $depSoftware[$aa] = $data[$aa][$ab][1];
                        }

                        if (strcasecmp($data[$aa][$ab][0], "computer and servers - acc dep") == 0) {
                            $depComputer[$aa] = $data[$aa][$ab][1];
                        }
                    }
                }
            }

            $profitBeforeIncomeTaxArray = array();
            $incomeTaxArray = array();
            $tradeReceivablesArray = array();
            $tradePayableArray = array();
            $borrowingArray = array();
            $shareCapitalArray = array();

// Storing those specially display de
            foreach ($fullArray as $key => $value) {

                if ($key === "profit before income tax") {
                    $profitBeforeIncomeTaxArray = $value;
                }

                if ($key === "trade and other receivables") {
                    $tradeReceivablesArray = $value;
                }

                if ($key === "income taxes") {
                    $incomeTaxArray = $value;

                    $incomeTax = array();

                    $string = "no";
                    for ($i = 0; $i < count($incomeTaxArray); $i++) {
                        // "income tax paid" exist in income tax array
                        if (stripos(array_keys($incomeTaxArray)[$i], 'income') !== false) {
                            if (stripos(array_keys($incomeTaxArray)[$i], 'tax') !== false) {
                                if (stripos(array_keys($incomeTaxArray)[$i], 'paid') !== false) {
                                    $string = "exist";
                                }
                            }
                        }
                    }

                    if ($string == "no") {
                        array_push($incomeTax, 0);
                        $incomeTaxArray["Income tax paid"] = $incomeTax;
                    }
                }

                if ($key === "trade and other payables") {
                    $tradePayableArray = $value;
                }

                if ($key === "borrowings") {
                    $borrowingArray = $value;

                    $proceeds = array();
                    $repayment = array();
                    $current = array();
                    $nonCurrent = array();

                    $countProceeds = 0;
                    $countRepayment = 0;
                    $string3 = "no";
                    $countNonCurrent = 0;

                    for ($i = 0; $i < count($borrowingArray); $i++) {
                        if (stripos(array_keys($borrowingArray)[$i], 'proceed') !== false) {
                            if (stripos(array_keys($borrowingArray)[$i], 'borrowing') !== false) {
                                $countProceeds++;
                            }
                        }

                        if (stripos(array_keys($borrowingArray)[$i], 'repayment') !== false) {
                            if (stripos(array_keys($borrowingArray)[$i], 'borrowing') !== false) {
                                $countRepayment++;
                            }
                        }

                        if (stripos(array_keys($borrowingArray)[$i], 'current') !== false) {
                            $string3 = "currentExist";
                        }

                        if (stripos(array_keys($borrowingArray)[$i], 'non-current') !== false) {
                            $countNonCurrent++;
                        } else if (stripos(array_keys($borrowingArray)[$i], 'non current') !== false) {
                            $countNonCurrent++;
                        }
                    }

                    if ($countProceeds != 1) {
                        array_push($proceeds, 0);
                        $borrowingArray["Proceeds from borrowings"] = $proceeds;
                    }

                    if ($countRepayment != 1) {
                        array_push($repayment, 0);
                        $borrowingArray["Repayment of borrowings"] = $repayment;
                    }

                    if ($string3 == "no") {
                        array_push($current, 0);
                        $borrowingArray["Current"] = $current;
                    }

                    if ($countNonCurrent != 1) {
                        array_push($nonCurrent, 0);
                        $borrowingArray["Non-current"] = $nonCurrent;
                    }
                }

                if ($key === "share capital") {
                    $shareCapitalArray = $value;
                }
            }

// For storing all of the heading
            $displayedCategory = array();
            $displayNormally = array();
            $defaultArray = ['Other income', 'Profit before income tax', 'Finance expense', 'Employee Compensation',
                'Income taxes', 'Trade and other receivables', 'Plant and equipment', 'Trade and other payables', 'Borrowings', 'Share capital'];

            foreach ($fullArray as $key1 => $value1) {
                if ($key1 !== "Profit Before Income Tax") {
                    if ($key1 !== "Trade and other receivables") {
                        if ($key1 !== "Share Capital") {
                            if ($key1 !== "Income Taxes") {
                                if ($key1 !== "Trade and other payables") {
                                    if ($key1 !== "Borrowings") {
                                        array_push($displayNormally, $key1);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (!empty($profitBeforeIncomeTaxArray)) {
                array_push($displayedCategory, "profit before income tax");
            }

            if (!empty($incomeTaxArray)) {
                array_push($displayedCategory, "income taxes");
            }

            if (!empty($tradeReceivablesArray)) {
                array_push($displayedCategory, "trade and other receivables");
            }

            if (!empty($tradePayableArray)) {
                array_push($displayedCategory, "trade and other payables");
            }

            if (!empty($borrowingArray)) {
                array_push($displayedCategory, "borrowings");
            }

            if (in_array("share capital", $categoryArray)) {
                array_push($displayedCategory, "share capital");
            }

            if (in_array("plant and equipment", $categoryArray)) {
                array_push($displayedCategory, "plant and equipment");
            }

            $sequenceCategory = array();
            for ($i = 0; $i < count($defaultArray); $i++) {
                for ($j = 0; $j < count($displayedCategory); $j++) {
                    if (strcasecmp($displayedCategory[$j], $defaultArray[$i]) === 0) {
                        if (!in_array($displayedCategory[$j], $sequenceCategory)) {
                            array_push($sequenceCategory, $displayedCategory[$j]);
                        }
                    }
                }
            }

            for ($k = 0; $k < count($defaultArray); $k++) {
                for ($l = 0; $l < count($displayNormally); $l++) {
                    if (!in_array($displayNormally[$l], $sequenceCategory)) {
                        array_push($sequenceCategory, $displayNormally[$l]);
                    }
                }
            }
                $arrayAddition = array();

// Phoebe Calculation
            if (in_array("plant and equipment", $categoryArray)) {

                array_push($displayedCategory, "plant and equipment");

                // ---- Cost ----
                $tempComputerAndSoftwares = 0;
                $tempComputerAndSoftwaresArray = array();

                $counter = 0;
                foreach ($tempSoftware as $keyS => $valueS) { //  [0] => 33024.29 [1] => 7607.43
                    if ($counter == $keyS) {
                        $tempComputerAndSoftwares += $valueS;
                    }

                    foreach ($tempComputer as $keyC => $valueC) { //  [0] => 33024.29 [1] => 7607.43
                        if ($counter == $keyC) {
                            $tempComputerAndSoftwares += $valueC;
                        }
                    }
                    array_push($tempComputerAndSoftwaresArray, round($tempComputerAndSoftwares));
                    $tempComputerAndSoftwares = 0;
                    $counter ++;
                }

                // ---- Accumulated depreciation ----
                $depComputerAndSoftware = 0;
                $depComputerAndSoftwareArray = array();

                $depCounter = 0;
                foreach ($depSoftware as $keyS => $valueS) { //  [0] => 33024.29 [1] => 7607.43
                    if ($depCounter == $keyS) {
                        $depComputerAndSoftware += $valueS;
                    }

                    foreach ($depComputer as $keyC => $valueC) { //  [0] => 33024.29 [1] => 7607.43
                        if ($depCounter == $keyC) {
                            $depComputerAndSoftware += $valueC;
                        }
                    }
                    array_push($depComputerAndSoftwareArray, round($depComputerAndSoftware));
                    $depComputerAndSoftware = 0;
                    $depCounter ++;
                }


                for ($i = count($years) - 1; $i >= 0; $i--) {

                    $additionComputerAndSoftwares = 0;
                    $additionOfficeEquipment = 0;

                    if (!empty($tempOfficeEquipment) && !empty($tempComputerAndSoftwaresArray)) {

                        if ($i == (count($years) - 1)) {
                            $additionComputerAndSoftwares = round($tempComputerAndSoftwaresArray[$i]) - 0;
                            $additionOfficeEquipment = round($tempOfficeEquipment[$i]) - 0;
                            $totalAddition = $additionComputerAndSoftwares + $additionOfficeEquipment;
                        } else if ($i == 0) { // the last row
                            $additionComputerAndSoftwares = round($tempComputerAndSoftwaresArray[$i]) - round($tempComputerAndSoftwaresArray[$i + 1]);
                            $additionOfficeEquipment = round($tempOfficeEquipment[$i]) - round($tempOfficeEquipment[$i + 1]);
                            $totalAddition = $additionComputerAndSoftwares + $additionOfficeEquipment;
                        } else {
                            $additionComputerAndSoftwares = round($tempComputerAndSoftwaresArray[$i - 1]) - round($tempComputerAndSoftwaresArray[$i]);
                            $additionOfficeEquipment = round($tempOfficeEquipment[$i - 1]) - round($tempOfficeEquipment[$i]);
                            $totalAddition = $additionComputerAndSoftwares + $additionOfficeEquipment;
                        }

                        array_push($arrayAddition, $totalAddition);
                    }
                }

                for ($i = count($years) - 1; $i >= 0; $i--) {

                    $depChargeComputerAndSoftwares = 0;
                    $depChargeOfficeEquipment = 0;

                    if (!empty($depComputerAndSoftwareArray) && !empty($depOfficeEquipment)) {

                        if ($i == (count($years) - 1)) {
                            $depChargeComputerAndSoftwares = round($depComputerAndSoftwareArray[$i]) - 0;
                            $depChargeOfficeEquipment = round($depOfficeEquipment[$i]) - 0;
                            $totalAdditionDep = $depChargeComputerAndSoftwares + $depChargeOfficeEquipment;
                        } else if ($i == 0) { // the last row
                            $depChargeComputerAndSoftwares = round($depComputerAndSoftwareArray[$i]) - round($depComputerAndSoftwareArray[$i + 1]);
                            $depChargeOfficeEquipment = round($depOfficeEquipment[$i]) - round($depOfficeEquipment[$i + 1]);
                            $totalAdditionDep = $depChargeComputerAndSoftwares + $depChargeOfficeEquipment;
                        } else {
                            $depChargeComputerAndSoftwares = round($depComputerAndSoftwareArray[$i - 1]) - round($depComputerAndSoftwareArray[$i]);
                            $depChargeOfficeEquipment = round($depOfficeEquipment[$i - 1]) - round($depOfficeEquipment[$i]);
                            $totalAdditionDep = $depChargeComputerAndSoftwares + $depChargeOfficeEquipment;
                        }
                    }
                }

                $tempCS = 0;
                $tempOE = 0;
                $tempTotal = 0;

                for ($i = 0; $i < count($years); $i++) {
                    $tempCS = $tempComputerAndSoftwaresArray[$i] - $depComputerAndSoftwareArray[$i];
                    $tempOE = $tempOfficeEquipment[$i] - $depOfficeEquipment[$i];
                    $tempTotal = $tempCS + $tempOE;
                }
            }

// For calculating the total value
            $totalArray = array();

            for ($i = 0; $i < count($years); $i++) {
                $totalArray[$years[$i]] = 0;
                $checkArray[$years[$i]] = 0;
            }

// =============================================================================
// KOKHOE
// =============================================================================
// retrieval and sorting of data
// variable clash, client name refers to the client this FS is for
            $clientName = $companyName;
// service provider is the company name of the accountant/ client admin
            $serviceProvider = $_SESSION['company'];
// retrieve from database the categories
            $query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name = :companyName AND client_company = :clientName");
            $query->bindParam(':companyName', $serviceProvider);
            $query->bindParam(':clientName', $clientName);
// company name from session is the account/client admin's company name
// company name from post is the client's company name (The company this FS is for)

            $query->execute();
            $result = $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetchAll();
            $accountAndCategory = array();
            $assetsArray = array();
            $capitalArray = array();
            $liabilitiesArray = array();
            $nonCurrentLiabilitiesArray = array();
            $bothLiabilitiesArray = array();
            $currentAssetsArray = array();
            $tradeLiabilitiesArray = array();
            $incomeArray = array();
            $expensesArray = array();
            $tradeGainArray = array();
            $nonTradeGainArray = array();
            $adjustmentsArray = array();
            echo $clientName;
            for ($i = 0; $i < count($result); $i++) {
                $mainAccountName = $result[$i]['main_account'];
                $individualAccountArray = explode(",", $result[$i]['account_names']);
                $individualAccountNames = array();
                $accountAndCategory[$mainAccountName] = array();
                for ($x = 0; $x < count($individualAccountArray); $x++) {
                    array_push($individualAccountNames, trim($individualAccountArray[$x]));
                }
                if (strcasecmp($mainAccountName, "Assets") === 0) {
                    $assetsArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Capital") === 0) {
                    $capitalArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Current Liabilities") === 0) {
                    $liabilitiesArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Non-current Liabilities") === 0) {
                    $nonCurrentLiabilitiesArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Both Liabilities") === 0) {
                    $bothLiabilitiesArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Current Assets") === 0) {
                    $currentAssetsArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Trade and other payables") === 0) {
                    $tradeLiabilitiesArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Income") === 0) {
                    $incomeArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Expenses") === 0) {
                    $expensesArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Adjustments") === 0) {
                    $adjustmentsArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Exchange Gain - Trade") === 0) {
                    $tradeGainArray = $individualAccountNames;
                } else if (strcasecmp($mainAccountName, "Exchange Gain - Non-Trade") === 0) {
                    $nonTradeGainArray = $individualAccountNames;
                }
                $accountAndCategory[$mainAccountName] = $individualAccountNames;
            }

            $amountToShareholder = array();
            $amountFromShareholder = array();
// arrays based on classifications
            $assetsDebit = array();
            $assetsCredit = array();
            $capitalAmount = array();
            $liabilitiesAmount = array();
            $nonCurrentLiabilitiesAmount = array();
            $bothLiabilitiesAmount = array();
            $incomeAmount = array();
            $expensesAmount = array();
            $revenueAmount = array();
            $costOfSales = array();
            $incomeTaxExpense = array();
            $adminExpense = array();
            $distriExpense = array();
            $adjustmentsCashFlow = array();
            $financeExpenseArray = array();
            $tradeGain = array();
            $nonTradeGain = array();
            $adminAccount = array();
            $distriAccount = array();

            for ($i = 0; $i < $numberOfSheets; $i++) {
                $financeExpenseArray[$i] = array();
                $amountToShareholder[$i] = array();
                $amountFromShareholder[$i] = array();
                $assetsDebit[$i] = array();
                $assetsCredit[$i] = array();
                $capitalAmount[$i] = array();
                $liabilitiesAmount[$i] = array();
                $nonCurrentLiabilitiesAmount[$i] = array();
                $bothLiabilitiesAmount[$i] = array();
                $incomeAmount[$i] = array();
                $expenseAmount[$i] = array();
                $revenueAmount[$i] = array();
                $costOfSales[$i] = array();
                $incomeTaxExpense[$i] = array();
                $adminExpense[$i] = array();
                $distriExpense[$i] = array();
                $adjustmentsCashFlow[$i] = array();
                $tradeGain[$i] = array();
                $nonTradeGain[$i] = array();
                $adminAccount[$i] = array();
                $distriAccount[$i] = array();

                for ($x = 0; $x < count($data[$i]); $x++) {
                    for ($j = 0; $j < count($data[$i][$x]); $j++) {
                        $currentData = $data[$i][$x][$j];
                        if ($j == 0) {
                            for ($k = 0; $k < count($adjustmentsArray); $k++) {
                                if (stripos($currentData, $adjustmentsArray[$k]) !== false) {
                                    $adjustmentsCashFlow[$i][count($adjustmentsCashFlow[$i])] = array($currentData, $data[$i][$x][$j + 1]);
                                }
                            }
                        }
                        if ($j == 2) {
                            $amount = $data[$i][$x][$j - 1];
                            // category cross check with list in txt file
                            if (in_array($currentData, $tradeLiabilitiesArray)){
                              $currentData = "Trade and other payables";
                            }
                            if (in_array($currentData, $assetsArray)) {
                                $debitOrCredit = $data[$i][$x][$j + 1];
                                if (stripos($currentData, "amount owing from a shareholder") !== false) {
                                    $amountFromShareholder[$i][count($amountFromShareholder[$i])] = array($currentData, $amount);
                                }
                                if (strcasecmp($debitOrCredit, "debit") == 0) {
                                    $assetsDebit[$i][count($assetsDebit[$i])] = array($currentData, $amount);
                                } else {
                                    $assetsCredit[$i][count($assetsCredit[$i])] = array($currentData, $amount);
                                }
                            } else if (in_array($currentData, $capitalArray)) {
                                $capitalAmount[$i][count($capitalAmount[$i])] = array($currentData, $amount);
                            } else if (in_array($currentData, $liabilitiesArray)) {
                                if (stripos($currentData, "Amount owing to a Shareholder") !== false) {
                                    $amountToShareholder[$i][count($amountToShareholder[$i])] = array($currentData, $amount);
                                }
                                $liabilitiesAmount[$i][count($liabilitiesAmount[$i])] = array($currentData, $amount);
                            } else if (in_array($currentData, $nonCurrentLiabilitiesArray)) {
                                $nonCurrentLiabilitiesAmount[$i][count($nonCurrentLiabilitiesAmount[$i])] = array($currentData, $amount);
                            } else if (in_array($currentData, $bothLiabilitiesArray)) {
                                $bothLiabilitiesAmount[$i][count($bothLiabilitiesAmount[$i])] = array($currentData, $amount);
                            } else if (in_array($currentData, $incomeArray)) {
                                if (strcasecmp($currentData, "revenue") == 0) {
                                    $revenueAmount[$i][count($revenueAmount[$i])] = array($currentData, $amount);
                                } else {
                                    if (in_array($currentData, $tradeGainArray)) {
                                        $tradeGain[$i][count($tradeGain[$i])] = array($data[$i][$x][0], $amount);
                                    } else if (in_array($currentData, $nonTradeGain)) {
                                        $nonTradeGain[$i][count($nonTradeGain[$i])] = array($data[$i][$x][0], $amount);
                                    } else {
                                        if (in_array($data[$i][$x][0], $tradeGainArray)) {
                                            $tradeGain[$i][count($tradeGain[$i])] = array($data[$i][$x][0], $amount);
                                        } else if (in_array($data[$i][$x][0], $nonTradeGainArray)) {
                                            $nonTradeGain[$i][count($nonTradeGain[$i])] = array($data[$i][$x][0], $amount);
                                        }
                                    }
                                    $incomeAmount[$i][count($incomeAmount[$i])] = array($currentData, $amount);
                                }
                            } else if (in_array($currentData, $expensesArray) || stripos($currentData, "cost of sale") !== false) {
                                if (stripos($currentData, "cost of sale") !== false) {
                                    $costOfSales[$i][count($costOfSales[$i])] = array($currentData, $amount);
                                } else if (stripos($currentData, "income tax expense") !== false) {
                                    $incomeTaxExpense[$i][count($incomeTaxExpense[$i])] = array($currentData, $amount);
                                } else if (stripos($currentData, "Administrative Expense") !== false) {
                                    $adminAccount[$i][count($adminAccount[$i])] = array($data[$i][$x][0], $amount);
                                    $adminExpense[$i][count($adminExpense[$i])] = array($currentData, $amount);
                                } else if (stripos($currentData, "Distribution and Marketing") !== false) {
                                    $distriAccount[$i][count($distriAccount[$i])] = array($data[$i][$x][0], $amount);
                                    $distriExpense[$i][count($distriExpense[$i])] = array($currentData, $amount);
                                } else {
                                    if (stripos($currentData, "finance expense") !== false) {
                                        $financeExpenseArray[$i][count($financeExpenseArray[$i])] = array($data[$i][$x][0], $amount);
                                    }
                                    $expenseAmount[$i][count($expenseAmount[$i])] = array($currentData, $amount);
                                }
                            } else {
                                echo $currentData;
                            }
                        }
                    }
                }
            }

// start adding assets classifcations on debit column
            for ($i = 0; $i < $numberOfSheets; $i++) {
                $tempCategoryArray = array();
                $tempValueArray = array();
                for ($x = 0; $x < count($assetsDebit[$i]); $x++) {
                    if (!in_array($assetsDebit[$i][$x][0], $tempCategoryArray)) {
                        array_push($tempCategoryArray, $assetsDebit[$i][$x][0]);
                    }
                }
                for ($x = 0; $x < count($tempCategoryArray); $x++) {
                    $tempValue = 0;
                    for ($j = 0; $j < count($assetsDebit[$i]); $j++) {
                        if (strcasecmp($assetsDebit[$i][$j][0], $tempCategoryArray[$x]) == 0) {
                            $tempValue += $assetsDebit[$i][$j][1];
                        } else {
                            continue;
                        }
                    }
                    array_push($tempValueArray, $tempValue);
                }
                $consolidatedAssetsDebit[$i] = array($tempCategoryArray, $tempValueArray);
            }

// end debit column for assets
// start credit column for assets

            for ($i = 0; $i < $numberOfSheets; $i++) {
                $tempCategoryArray = array();
                $tempValueArray = array();
                for ($x = 0; $x < count($assetsCredit[$i]); $x++) {
                    if (!in_array($assetsCredit[$i][$x][0], $tempCategoryArray)) {
                        array_push($tempCategoryArray, $assetsCredit[$i][$x][0]);
                    }
                }
                for ($x = 0; $x < count($tempCategoryArray); $x++) {
                    $tempValue = 0;
                    for ($j = 0; $j < count($assetsCredit[$i]); $j++) {
                        if (strcasecmp($assetsCredit[$i][$j][0], $tempCategoryArray[$x]) == 0) {
                            $tempValue += $assetsCredit[$i][$j][1];
                        } else {
                            continue;
                        }
                    }
                    array_push($tempValueArray, $tempValue);
                }
                $consolidatedAssetsCredit[$i] = array($tempCategoryArray, $tempValueArray);
            }
// end credit column for assets
// take the assets on debit side, deduct off the corresponding credit side
            $calculatedAssets = array();
            for ($i = 0; $i < count($consolidatedAssetsDebit); $i++) {
                $tempArray = array();
                for ($x = 0; $x < count($consolidatedAssetsDebit[$i][0]); $x++) {
                    $tempValue = $consolidatedAssetsDebit[$i][1][$x];
                    for ($j = 0; $j < count($consolidatedAssetsCredit[$i][0]); $j++) {
                        if (strcasecmp($consolidatedAssetsDebit[$i][0][$x], $consolidatedAssetsCredit[$i][0][$j]) == 0) {
                            $tempValue -= $consolidatedAssetsCredit[$i][1][$j];
                        }
                    }
                    array_push($tempArray, array($consolidatedAssetsDebit[$i][0][$x], $tempValue));
                }
                array_push($calculatedAssets, $tempArray);
            }

// number of columns for each statement, 1 column heading, 1 for notes, maximum 5 years allowed. 7 + 1 for array end point therefore 8
            $maxColumns = 7;
            $cellValue = 1750;
            $firstCellValue = 0;
// check number of unused columns.
// max columns - number of years + 1 column for Notes
// merge the number of unused columns for the first cell.
            for ($i = 0; $i < ($maxColumns - ($numberOfSheets + 1)); $i++) {
                $firstCellValue += $cellValue;
            }
            $defaultNoteNumber = 4;

            $monthIdentifier = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

            $formatedDate = array();
            $yearEndedArray = array();
            for ($i = 0; $i < $numberOfSheets; $i++) {
                $currentYear = $years[$i];
                $month = substr($currentYear, 0, -5);
                $currentYear = substr($currentYear, -4);
                $numberedMonth = 0;
                for ($x = 0; $x < count($monthIdentifier); $x++) {
                    if (stripos($monthIdentifier[$x], trim($month)) !== false) {
                        $numberedMonth = $x + 1;
                    }
                }
                $numberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $numberedMonth, $currentYear);
                // to get start month, use the numbered month which is for the end of the financial year
                // subtract 11. E.g december - 11 = january
                $startMonth = $numberedMonth;
                for ($x = 0; $x < 11; $x++) {
                    $startMonth--;
                    if ($startMonth == 0) {
                        $startMonth = 12;
                    }
                }

                $dateStart = date_create("$currentYear-$startMonth-1");
                $dateEnd = date_create("$currentYear-$numberedMonth-$numberOfDaysInMonth");
                $dateArray = array();
                array_push($dateArray, $dateStart);
                array_push($dateArray, $dateEnd);
                array_push($formatedDate, $dateArray);

                $currentDateString = $numberOfDaysInMonth . " " . $monthIdentifier[$numberedMonth - 1] . " " . $currentYear;
                array_push($yearEndedArray, $currentDateString);
            }

            if (!empty($firstBalanceDate)) {
                $firstDateArray = explode("-", $firstBalanceDate);
                $firstDateMonth = $firstDateArray[1];
                $firstDateString = $firstDateArray[2] . " " . $monthIdentifier[$firstDateMonth - 1] . " " . $firstDateArray[0];
            } else {
                $convertDate = $formatedDate[count($formatedDate) - 1][0]->format('Y-m-d H:i:s');
                $convertDate = substr($convertDate, 0, 10);
                $firstDateArray = explode("-", $convertDate);
                $firstDateMonth = $firstDateArray[1];
                $firstDateString = $firstDateArray[2] . " " . $monthIdentifier[$firstDateMonth - 1] . " " . $firstDateArray[0];
            }


            $yearEndArray = explode("-", $yearEnd);
            $yearEndMonth = $yearEndArray[1];
            $yearEndString = $yearEndArray[2] . " " . $monthIdentifier[$yearEndMonth - 1] . " " . $yearEndArray[0];

//==============================================================================
// YOKYEE START HERE
//==============================================================================
//Cover Page
            $section = $phpWord->addSection();
//$section->addTextBreak([8], [$fontstyleName], [null]);
            $section->addText('<w:br/><w:br/><w:br/><w:br/><w:br/><w:br/><w:br/><w:br/><w:br/>', $fontstyleName);
            $section->addText(strtoupper($companyName) .
                    "<w:br/>(Company registration number: " . $companyregID . ")", $fontStyleBigBlack);
            $section->addText("UNAUDITED FINANCIAL STATEMENTS", $fontStyleBigBlack);
            $section->addText("FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBigBlack);

//Page 1
            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack);

            if ($noOfDirectors > 1) {
                $header->addText("DIRECTORS' STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
                $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
            } else {
                $header->addText("DIRECTOR'S STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
                $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
            }

            if ($noOfDirectors > 1) {
                $section->addText("The directors present this statement to the member together with the unaudited financial statements of " . strtoupper($companyName)
                        . " (“the Company”) for the financial year ended " . date('d F Y', strtotime($yearEnd)) . ".", $fontstyleName, $paragraphStyle);
            } else {
                $section->addText("The director present this statement to the member together with the unaudited financial statements of " . strtoupper($companyName)
                        . " (“the Company”) for the financial year ended " . date('d F Y', strtotime($yearEnd)) . ".", $fontstyleName, $paragraphStyle);
            }

            if ($noOfDirectors > 1) {

                $section->addListItem("\tOPINION OF THE DIRECTORS", 0, $fontstyleName, $listingStyle);
            } else {

                $section->addListItem("\tOPINION OF THE DIRECTOR", 0, $fontstyleName, $listingStyle);
            }

            $section->addListItem("the accompanying financial statements of the Company are drawn up so as to give a true and fair view of the financial position of the Company as at "
                    . date('d F Y', strtotime($yearEnd)) . " and the financial performance, changes in equity and cash flows of the Company for the financial year covered by the financial statements; and"
                    , 0, $fontstyleName, $romanListingStyle);

            $section->addListItem("at the date of this statement there are reasonable grounds to believe that the Company will be able to pay its debts as and when they fall due."
                    , 0, $fontstyleName, $romanListingStyle);

            if ($noOfDirectors > 1) {
                $section->addListItem("\tDIRECTORS", 0, $fontstyleName, $listingStyle);
            } else {
                $section->addListItem("\tDIRECTOR", 0, $fontstyleName, $listingStyle);
            }

            if ($noOfDirectors > 1) {
                $section->addText("\tThe directors of the Company in office at the date of this statement are as follows:", $fontstyleName, $paragraphStyle);
            } else {
                $section->addText("\tThe director of the Company in office at the date of this statement are as follows:", $fontstyleName, $paragraphStyle);
            }

            if ($directorAppointedDate != null) {
                for ($i = 0; $i < $noOfDirectors; $i++) {
                    $section->addText("\t" . $directorName[$i] . "   appointed on " . date('d F Y', strtotime($directorAppointedDate[$i])), $fontstyleName, $paragraphStyle);
                }
            } else {
                for ($i = 0; $i < $noOfDirectors; $i++) {
                    $section->addText("\t" . $directorName[$i]);
                }
            }

            if ($noOfDirectors > 1) {
                $section->addListItem("\tARRANGEMENTS TO ENABLE DIRECTORS TO ACQUIRE SHARES AND \tDEBENTURES", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            } else {
                $section->addListItem("\tARRANGEMENTS TO ENABLE DIRECTOR TO ACQUIRE SHARES AND \tDEBENTURES", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            }

            if ($noOfDirectors > 1) {
                $section->addText("\tNeither at the end of nor at any time during the financial year was the Company a \tparty to any arrangement whose object was to enable the directors of the Company to \tacquire benefits by means of the acquisition of shares in, or debentures of, the \tCompany or any other body corporate."
                        , $fontstyleName);
            } else {
                $section->addText("\tNeither at the end of nor at any time during the financial year was the Company a \tparty to any arrangement whose object was to enable the director of the Company to \tacquire benefits by means of the acquisition of shares in, or debentures of, the \tCompany or any other body corporate."
                        , $fontstyleName);
            }

            if ($noOfDirectors > 1) {
                $section->addListItem("\tDIRECTORS' INTERESTS IN SHARES OR DEBENTURES", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            } else {
                $section->addListItem("\tDIRECTOR'S INTERESTS IN SHARES OR DEBENTURES", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            }

            if ($noOfDirectors > 1) {
                $section->addText("\tAccording to the register of directors’ shareholdings, none of the directors holding \toffice at the end of the financial year had any interest in the shares or debentures of \tthe Company or its related corporations, except as follows: "
                        , $fontstyleName);
            } else {
                $section->addText("\tAccording to the register of director’s shareholdings, none of the director holding \toffice at the end of the financial year had any interest in the shares or debentures of \tthe Company or its related corporations, except as follows: "
                        , $fontstyleName);
            }

            $table = $section->addTable();
            $table->addRow();
            $table->addCell($firstCellValue);
            $cell = $table->addCell($cellValue);
            $cell->addText("At the beginning of financial year", $fontstyleName, $centerAlignment);
            $cell = $table->addCell($cellValue);
            $cell->addText("At the end of financial year", $fontstyleName, $centerAlignment);

            $table->addRow();
            $table->addCell($firstCellValue)->addText(htmlspecialchars("The Company"), array('underline' => 'single'));

            $table->addRow();

            for ($i = 0; $i < $noOfDirectors; $i++) {

                $table->addCell()->addText($directorName[$i], $fontstyleName);
                $table->addCell()->addText($directorStartShare[$i], $fontstyleName, $centerAlignment);
                $table->addCell()->addText($directorEndShare[$i], $fontstyleName, $centerAlignment);
            }

//Page 2
            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack);

            if ($noOfDirectors > 1) {
                $header->addText("DIRECTORS' STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
                $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
            } else {
                $header->addText("DIRECTOR'S STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
                $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
            }

            if ($noOfDirectors > 1) {
                $section->addListItem("\tDIRECTORS' CONTRACTUAL BENEFITS", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            } else {
                $section->addListItem("\tDIRECTORS' CONTRACTUAL BENEFITS", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            }

            $section->addText("\tSince the end of the previous financial period, no director has received or become \tentitled to receive a benefit which is required to be disclosed under the Singapore \tCompanies Act, by reason of a contract made by the Company or a related \tcorporation with the directors or with a firm of which he is a member, or with a \tCompany in which he has a substantial financial interest, except as disclosed in the \tfinancial statements."
                    , $fontstyleName, $paragraphStyle);
            $section->addTextBreak(1);

            $section->addListItem("\tOPTIONS GRANTED", 0, $fontstyleName, $listingStyle, $paragraphStyle);

            $section->addText("\tNo options were granted during the financial year to subscribe for unissued shares of \tthe Company."
                    , $fontstyleName, $paragraphStyle);

            $section->addTextBreak(1);

            $section->addListItem("\tOPTIONS EXERCISED", 0, $fontstyleName, $listingStyle, $paragraphStyle);

            $section->addText("\tNo shares were issued during the financial year by virtue of the exercise of options to \ttake up unissued shares of the Company."
                    , $fontstyleName, $paragraphStyle);

            $section->addTextBreak(1);

            $section->addListItem("\tOPTIONS OUTSTANDING", 0, $fontstyleName, $listingStyle, $paragraphStyle);

            $section->addText("\tThere were no unissued shares of the Company under option at the end of the \tfinancial year."
                    , $fontstyleName, $paragraphStyle);

            $section->addTextBreak(1);

            if ($noOfDirectors >= 2) {
                $section->addText("On behalf of the directors"
                        , $fontstyleName, $paragraphStyle);
            }

            $section->addTextBreak(1);
            for ($i = 0; $i < $noOfDirectors; $i++) {
                $section->addText($directorName[$i] . "<w:br/>Director", $fontstyleName, $paragraphStyle);
            }

            $section->addText("Singapore, " . (date('F d Y', strtotime($todayDate)))
                    , $fontstyleName, $paragraphStyle);

// =============================================================================
// KOKHOE
// =============================================================================
// These point on is the 4 statements
// P&L
            $tempIncomeCategories = array();
            for ($i = 0; $i < count($incomeAmount); $i++) {
                for ($x = 0; $x < count($incomeAmount[$i]); $x++) {
                    if (!in_array($incomeAmount[$i][$x][0], $tempIncomeCategories)) {
                        array_push($tempIncomeCategories, $incomeAmount[$i][$x][0]);
                    }
                }
            }

            $revenueFinal = array();

            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack);
            $header->addText("STATEMENT OF COMPREHENSIVE INCOME<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack);
            $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

// create P&L Table
            $table = $section->addTable();
// top row which only shows date
            $table->addRow();
            $table->addCell($firstCellValue);
            $cell = $table->addCell($cellValue);
            $cell->addText("Notes", $fontstyleName, $centerAlignment);
            for ($i = 0; $i < count($formatedDate); $i++) {
                $cell = $table->addCell($cellValue);
                $dateStart = $formatedDate[$i][0];
                $dateEnd = $formatedDate[$i][1];
                if ($i == (count($formatedDate) - 1)) {
                    if (!empty($firstBalanceDate)) {
                        $dateStart = date_create($firstDateArray[2] . "-" . $firstDateArray[1] . "-" . $firstDateArray[0]);
                    }
                }
                $cell->addText(date_format($dateStart, "d.m.Y"), $centerAlignment);
                $cell->addText("to", $fontstyleName, $centerAlignment);
                $cell->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                $cell->addText("$", $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($firstCellValue)->addText("Revenue");
            for ($i = 0; $i < count($revenueAmount); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($revenueAmount[$i]); $x++) {
                    $tempValue += $revenueAmount[$i][$x][1];
                }
                array_push($revenueFinal, round($tempValue));
            }
            $noteNumber = 0;
            for ($i = 0; $i < count($sequenceCategory); $i++) {
                if (stripos($sequenceCategory[$i], "Revenue") !== false) {
                    $noteNumber = $i + $defaultNoteNumber;
                    break;
                }
            }

            $cell = $table->addCell($cellValue);
            if ($noteNumber != 0) {
                $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
            }

            for ($i = 0; $i < count($revenueFinal); $i++) {
                $cell = $table->addCell($cellValue);
                if ($revenueFinal == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($revenueFinal[$i]), $fontstyleName, $centerAlignment);
                }
            }
            $table->addRow();

            $countCoS = 0;
            for ($i = 0; $i < count($costOfSales); $i++) {
                for ($x = 0; $x < count($costOfSales[$i]); $x++) {
                    if (!(round($costOfSales[$i][$x][1]) == 0)) {
                        $countCoS++;
                    }
                }
            }

            $cosFinal = array();
            if ($countCoS > 0) {
                $cell = $table->addCell($firstCellValue);
                $cell->addText("Less: Cost of sales");
                $noteNumber = 0;
                for ($i = 0; $i < count($sequenceCategory); $i++) {
                    if (stripos($sequenceCategory[$i], "Cost of Sale") !== false) {
                        $noteNumber = $i + $defaultNoteNumber;
                        break;
                    }
                }
                $cell = $table->addCell($cellValue);
                if ($noteNumber != 0) {
                    $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
                }
                for ($i = 0; $i < count($costOfSales); $i++) {
                    $tempValue = 0;
                    for ($x = 0; $x < count($costOfSales[$i]); $x++) {
                        $tempValue += $costOfSales[$i][$x][1];
                    }
                    $tempValue = 0 - $tempValue;
                    array_push($cosFinal, round($tempValue));
                }
                for ($i = 0; $i < count($cosFinal); $i++) {
                    $cell = $table->addCell($cellValue, $cellBottomBorder);
                    if ($cosFinal[$i] == 0) {
                        $cell->addText("-", $fontstyleName, $centerAlignment);
                    } else {
                        $cell->addText("(" . number_format(abs($cosFinal[$i])) . ")", $fontstyleName, $centerAlignment);
                    }
                }
            }

            $table->addRow();

            $profitAmount = array();
            $grossPrint = array();
            for ($i = 0; $i < count($revenueAmount); $i++) {
                $tempValue = 0;
                $tempGross = "";
                for ($x = 0; $x < count($revenueAmount[$i]); $x++) {
                    $tempValue += $revenueAmount[$i][$x][1];
                    if (isset($cosFinal[$i])) {
                        $tempValue += $cosFinal[$i];
                    }

                    if ($tempValue < 0) {
                        if (!in_array("loss", $grossPrint)) {
                            array_push($grossPrint, "loss");
                        }
                    } else {
                        if (!in_array("profit", $grossPrint)) {
                            array_push($grossPrint, "profit");
                        }
                    }
                }
                array_push($profitAmount, round($tempValue));
            }

            $cell = $table->addCell($firstCellValue);
            if ($countCoS == 0) {
                $cell->addText("Gross Profit", $fontStyleBlack);
            } else {
                $grossString = "Gross ";
                for ($i = 0; $i < count($grossPrint); $i++) {
                    if ($i > 0) {
                        $grossString += "/ ";
                    }
                    $grossString .= $grossPrint[$i];
                }
                $cell->addText($grossString, $fontStyleBlack);
            }

// should not have note for gross profit/loss
// add a blank cell for the note column
            $table->addCell($cellValue);
            for ($i = 0; $i < count($profitAmount); $i++) {
                $cell = $table->addCell($cellValue);
                if ($profitAmount[$i] < 0) {
                    $cell->addText("(" . number_format(abs($profitAmount[$i])) . ")", $fontstyleName, $centerAlignment);
                } else if ($profitAmount[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($profitAmount[$i]), $fontstyleName, $centerAlignment);
                }
            }

            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("Other income");
            $otherIncome = array();
            for ($i = 0; $i < count($incomeAmount); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($incomeAmount[$i]); $x++) {
                    $tempValue += $incomeAmount[$i][$x][1];
                }
                array_push($otherIncome, round($tempValue));
            }

            $noteNumber = 0;
            for ($i = 0; $i < count($sequenceCategory); $i++) {
                if (stripos($sequenceCategory[$i], "Other income") !== false) {
                    $noteNumber = $i + $defaultNoteNumber;
                    break;
                }
            }

            $cell = $table->addCell($cellValue);
            if ($noteNumber != 0) {
                $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
            }

            for ($i = 0; $i < count($otherIncome); $i++) {
                $cell = $table->addCell($cellValue);
                if ($otherIncome[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($otherIncome[$i]), $fontstyleName, $centerAlignment);
                }
            }

            $table->addRow();
            $table->addCell($firstCellValue)->addText("Expenses");
            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("-Administrative");
            $totalExpenses = array();
            $calculatedAdminExpense = array();
            $noteNumber = 0;
            for ($i = 0; $i < count($sequenceCategory); $i++) {
                if (stripos($sequenceCategory[$i], "Administrative") !== false) {
                    $noteNumber = $i + $defaultNoteNumber;
                }
            }

            $cell = $table->addCell($cellValue);
            if ($noteNumber != 0) {
                $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
            }

            for ($i = 0; $i < count($adminExpense); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($adminExpense[$i]); $x++) {
                    $tempValue += $adminExpense[$i][$x][1];
                }
                $tempValue = 0 - $tempValue;
                array_push($calculatedAdminExpense, round($tempValue));
            }

            for ($i = 0; $i < count($calculatedAdminExpense); $i++) {
                $cell = $table->addCell($cellValue);
                if ($calculatedAdminExpense[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText("(" . number_format(abs($calculatedAdminExpense[$i])) . ")", $fontstyleName, $centerAlignment);
                }
                $totalExpenses[$i] = $calculatedAdminExpense[$i];
            }

            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("-Distribution and marketing");

            $calculatedDistriExpense = array();
            for ($i = 0; $i < count($distriExpense); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($distriExpense[$i]); $x++) {
                    $tempValue += $distriExpense[$i][$x][1];
                }

                $tempValue = 0 - $tempValue;
                array_push($calculatedDistriExpense, round($tempValue));
            }

            $noteNumber = 0;
            for ($i = 0; $i < count($sequenceCategory); $i++) {
                if (stripos($sequenceCategory[$i], "Distribution and marketing") !== false) {
                    $noteNumber = $i + $defaultNoteNumber;
                }
            }

            $cell = $table->addCell($cellValue);
            if ($noteNumber != 0) {
                $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
            }

            for ($i = 0; $i < count($calculatedDistriExpense); $i++) {
                $cell = $table->addCell($cellValue);
                if ($calculatedDistriExpense[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText("(" . number_format(abs($calculatedDistriExpense[$i])) . ")", $fontstyleName, $centerAlignment);
                }
                $totalExpenses[$i] += $calculatedDistriExpense[$i];
            }

            $tempExpenseCategory = array();
            for ($i = 0; $i < count($expenseAmount); $i++) {
                for ($x = 0; $x < count($expenseAmount[$i]); $x++) {
                    if (!in_array($expenseAmount[$i][$x][0], $tempExpenseCategory)) {
                        array_push($tempExpenseCategory, $expenseAmount[$i][$x][0]);
                    }
                }
            }

            $tempExpenseArray = array();
            for ($i = 0; $i < count($tempExpenseCategory); $i++) {
                $tempExpenseArray[$i] = array();
                for ($x = 0; $x < count($expenseAmount); $x++) {
                    $tempValue = 0;
                    for ($j = 0; $j < count($expenseAmount[$x]); $j++) {
                        if (strcasecmp($tempExpenseCategory[$i], $expenseAmount[$x][$j][0]) == 0) {
                            $tempValue += $expenseAmount[$x][$j][1];
                            $tempValue = 0 - $tempValue;
                            $totalExpenses[$x] += round($tempValue);
                        }
                    }
                    array_push($tempExpenseArray[$i], round($tempValue));
                }
            }

            for ($i = 0; $i < count($tempExpenseCategory); $i++) {
                $table->addRow();
                $cell = $table->addCell($firstCellValue);
                $cell->addText("-" . $tempExpenseCategory[$i]);
                $noteNumber = 0;
                for ($x = 0; $x < count($sequenceCategory); $x++) {
                    if (stripos($sequenceCategory[$x], $tempExpenseCategory[$i]) !== false) {
                        $noteNumber = $x + $defaultNoteNumber;
                    }
                }
                $cell = $table->addCell($cellValue);
                if ($noteNumber != 0) {
                    $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
                }

                for ($x = 0; $x < count($tempExpenseArray[$i]); $x++) {
                    if ($i == (count($tempExpenseCategory) - 1)) {
                        $cell = $table->addCell($cellValue, $cellBottomBorder);
                    } else {
                        $cell = $table->addCell($cellValue);
                    }

                    if ($tempExpenseArray[$i][$x] == 0) {
                        $cell->addText("-", $fontstyleName, $centerAlignment);
                    } else {
                        $cell->addText("(" . number_format(abs($tempExpenseArray[$i][$x])) . ")", $fontstyleName, $centerAlignment);
                    }
                }
            }

            $beforeIncomeTax = array();
            for ($i = 0; $i < count($profitAmount); $i++) {
                $tempValue = $profitAmount[$i];
                $tempValue += $otherIncome[$i];
                $tempValue += $totalExpenses[$i];
                array_push($beforeIncomeTax, round($tempValue));
            }

            $tempBeforeTaxCategory = array();
            for ($i = 0; $i < count($beforeIncomeTax); $i++) {
                if ($beforeIncomeTax[$i] < 0) {
                    if (!in_array("Loss", $tempBeforeTaxCategory)) {
                        array_push($tempBeforeTaxCategory, "Loss");
                    }
                } else {
                    if (!in_array("Profit", $tempBeforeTaxCategory)) {
                        array_push($tempBeforeTaxCategory, "Profit");
                    }
                }
            }

            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $beforeTaxString = "";
            for ($i = 0; $i < count($tempBeforeTaxCategory); $i++) {
                if ($i > 0) {
                    $beforeTaxString .= "/ ";
                }
                $beforeTaxString .= $tempBeforeTaxCategory[$i];
            }
            $beforeTaxString .= " before income tax";
            $cell->addText($beforeTaxString, $fontStyleBlack);
// should not have note
// add in blank column
            $table->addCell($cellValue);
            for ($i = 0; $i < count($beforeIncomeTax); $i++) {
                $cell = $table->addCell($cellValue);
                if ($beforeIncomeTax[$i] < 0) {
                    $cell->addText("(" . number_format(abs($beforeIncomeTax[$i])) . ")", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($beforeIncomeTax[$i]), $fontstyleName, $centerAlignment);
                }
            }

            $table->addRow();
            $incomeTaxValues = array();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("Income tax expense");
            $noteNumber = 0;
            for ($i = 0; $i < count($sequenceCategory); $i++) {
                if (stripos($sequenceCategory[$i], "income tax") !== false) {
                    $noteNumber = $i + $defaultNoteNumber;
                }
            }

            $cell = $table->addCell($cellValue);
            if ($noteNumber != 0) {
                $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
            }

            for ($i = 0; $i < count($incomeTaxExpense); $i++) {
                for ($x = 0; $x < count($incomeTaxExpense[$i]); $x++) {
                    $tempValue = 0 - $incomeTaxExpense[$i][$x][1];
                    array_push($incomeTaxValues, round($tempValue));
                }
            }

            for ($i = 0; $i < count($incomeTaxValues); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $cell->addText("(" . number_format(abs($incomeTaxValues[$i])) . ")", $fontstyleName, $centerAlignment);
            }

            $netPandL = array();
            for ($i = 0; $i < count($beforeIncomeTax); $i++) {
                $tempValue = $beforeIncomeTax[$i];
                if (isset($incomeTaxValues[$i])) {
                    $tempValue += $incomeTaxValues[$i];
                }
                array_push($netPandL, round($tempValue));
            }

            $netPLCategory = array();
            for ($i = 0; $i < count($netPandL); $i++) {
                if ($netPandL[$i] < 0) {
                    if (!in_array("loss", $netPLCategory)) {
                        array_push($netPLCategory, "loss");
                    }
                } else {
                    if (!in_array("profit", $netPLCategory)) {
                        array_push($netPLCategory, "profit");
                    }
                }
            }

            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $netString = "Net ";

            for ($i = 0; $i < count($netPLCategory); $i++) {
                if ($i > 0) {
                    $netString .= "/ ";
                }
                $netString .= $netPLCategory[$i];
            }
            $netString .= " and total comprehensive income for the year/period";
            $cell->addText($netString, $fontStyleBlack);

// no notes, add blank column
            $table->addCell($cellValue);
            for ($i = 0; $i < count($netPandL); $i++) {
                $cell = $table->addCell($cellValue, array('borderBottomSize' => '18', 'borderBottomColor' => '#000000'));
                if ($netPandL[$i] < 0) {
                    $cell->addText("(" . number_format(abs($netPandL[$i])) . ")", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($netPandL[$i]), $fontstyleName, $centerAlignment);
                }
            }

// BS
            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack);
            $header->addText("STATEMENT OF FINANCIAL POSITION<w:br/>AS AT " . strtoupper($yearEndString), $fontStyleBlack);
            $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

            $table = $section->addTable();
            $table->addRow();
            $table->addCell($firstCellValue);
            $table->addCell($cellValue)->addText("Notes", $fontstyleName, $centerAlignment);
            for ($i = 0; $i < count($years); $i++) {
                $stringCurrentYear = substr($years[$i], -4);
                $cell = $table->addCell($cellValue);
                $cell->addText($stringCurrentYear, $fontstyleBottomUnderline, $centerAlignment);
                $cell->addText("$", $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("ASSETS", $fontStyleBlack);
            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("Current assets", $fontStyleBlack);
            $hasBankBalance = false;
            $bankArray = array();
            $totalReceivables = array();
            $nonCurrentAssets = array();

// $i $x 0 = name of category, 1 = amount calculated for that category
            for ($i = 0; $i < count($calculatedAssets); $i++) {
                $currentAssetsValue = 0;
                $nonCurrentAssets[$i] = array();
                $tempBankValue = 0;
                for ($x = 0; $x < count($calculatedAssets[$i]); $x++) {
                    $tempValue = 0;
                    if (stripos($calculatedAssets[$i][$x][0], "Bank balance") !== false) {
                        $hasBankBalance = true;
                        $tempBankValue += round($calculatedAssets[$i][$x][1]);
                    } else {
                        if (in_array($calculatedAssets[$i][$x][0], $currentAssetsArray)) {
                            $currentAssetsValue += $calculatedAssets[$i][$x][1];
                        } else {
                            $tempValue += $calculatedAssets[$i][$x][1];
                            array_push($nonCurrentAssets[$i], array($calculatedAssets[$i][$x][0], $tempValue));
                        }
                    }
                }
                array_push($totalReceivables, round($currentAssetsValue));
                array_push($bankArray, $tempBankValue);
            }

            if ($hasBankBalance) {
                $table->addRow();
                $cell = $table->addCell($firstCellValue);
                $cell->addText("Bank balances", $fontstyleName);
                $noteNumber = 0;
                $cell = $table->addCell($cellValue);
                for ($i = 0; $i < count($sequenceCategory); $i++) {
                    if (stripos($sequenceCategory[$i], "Bank balance") !== false) {
                        $noteNumber = $i + $defaultNoteNumber;
                    }
                }
                if ($noteNumber != 0) {
                    $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
                }

                for ($x = 0; $x < count($bankArray); $x++) {
                    $cell = $table->addCell($cellValue);
                    if ($bankArray[$x] == 0) {
                        $cell->addText("-", $fontstyleName, $centerAlignment);
                    } else {
                        $cell->addText(number_format($bankArray[$x]), $fontstyleName, $centerAlignment);
                    }
                }
            }
            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("Trade and other receivables", $fontstyleName);
            $cell = $table->addCell($cellValue);
            $noteNumber = 0;
            for ($i = 0; $i < count($sequenceCategory); $i++) {
                if (stripos($sequenceCategory[$i], "trade and other receivable") !== false) {
                    $noteNumber = $i + $defaultNoteNumber;
                }
            }
            if ($noteNumber != 0) {
                $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
            }

            for ($x = 0; $x < count($totalReceivables); $x++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                if ($totalReceivables[$x] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($totalReceivables[$x]), $fontstyleName, $centerAlignment);
                }
            }
// only has bank balance and trade and other receivables to add together
            $table->addRow();
            $table->addCell($firstCellValue);
            $table->addCell($cellValue);
            $totalCurrentAssets = array();
            for ($x = 0; $x < $numberOfSheets; $x++) {
                $total = $bankArray[$x] + $totalReceivables[$x];
                array_push($totalCurrentAssets, $total);
            }
            for ($x = 0; $x < count($totalCurrentAssets); $x++) {
                $cell = $table->addCell($cellValue);
                if ($totalCurrentAssets[$x] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($totalCurrentAssets[$x]), $fontstyleName, $centerAlignment);
                }
            }
            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("Non-current assets", $fontStyleBlack);
            $nonCurrentCalculated = array();
            $tempNonCurrentArray = array();
            for ($x = 0; $x < count($nonCurrentAssets); $x++) {
                for ($j = 0; $j < count($nonCurrentAssets[$x]); $j++) {
                    if (in_array($nonCurrentAssets[$x][$j][0], $tempNonCurrentArray)) {
                        continue;
                    } else {
                        array_push($tempNonCurrentArray, $nonCurrentAssets[$x][$j][0]);
                    }
                }
                for ($j = 0; $j < count($tempNonCurrentArray); $j++) {
                    $tempValue = 0;
                    for ($k = 0; $k < count($nonCurrentAssets[$x]); $k++) {
                        if (strcasecmp($tempNonCurrentArray[$j], $nonCurrentAssets[$x][$k][0]) == 0) {
                            $tempValue += $nonCurrentAssets[$x][$k][1];
                        }
                    }
                    array_push($nonCurrentCalculated, array($tempNonCurrentArray[$j], round($tempValue)));
                }
            }

            $nonCurrentFinal = array();
            for ($j = 0; $j < count($tempNonCurrentArray); $j++) {
                $nonCurrentFinal[$j] = array();
                for ($x = 0; $x < count($nonCurrentCalculated); $x++) {
                    $tempValue = 0;
                    if (strcasecmp($nonCurrentCalculated[$x][0], $tempNonCurrentArray[$j]) == 0) {
                        $tempValue += $nonCurrentCalculated[$x][1];
                    }
                    array_push($nonCurrentFinal[$j], $tempValue);
                }
            }

            for ($i = 0; $i < count($tempNonCurrentArray); $i++) {
                $table->addRow();
                $cell = $table->addCell($firstCellValue);
                $cell->addText($tempNonCurrentArray[$i]);
                $noteNumber = 0;
                for ($x = 0; $x < count($sequenceCategory); $x++) {
                    if (stripos($sequenceCategory[$x], $tempNonCurrentArray[$i]) !== false) {
                        $noteNumber = $x + $defaultNoteNumber;
                    }
                }
                $cell = $table->addCell($cellValue);
                if ($noteNumber != 0) {
                    $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
                }

                for ($x = 0; $x < count($nonCurrentFinal[$i]); $x++) {
                    if ($i == (count($tempNonCurrentArray) - 1)) {
                        $cell = $table->addCell($cellValue, $cellBottomBorder);
                    } else {
                        $cell = $table->addCell($cellValue);
                    }

                    if ($nonCurrentFinal[$i][$x] == 0) {
                        $cell->addText("-", $fontstyleName, $centerAlignment);
                    } else {
                        $cell->addText(number_format($nonCurrentFinal[$i][$x]), $fontstyleName, $centerAlignment);
                    }
                }
            }

            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("Total assets", $fontStyleBlack);
            $table->addCell($cellValue);
            $totalAssets = array();
            for ($x = 0; $x < count($totalCurrentAssets); $x++) {
                $totalValue = $totalCurrentAssets[$x];
                for ($i = 0; $i < count($tempNonCurrentArray); $i++) {
                    if (isset($nonCurrentFinal[$i][$x])) {
                        $totalValue += $nonCurrentFinal[$i][$x];
                    }
                }
                array_push($totalAssets, $totalValue);
            }
            for ($i = 0; $i < count($totalAssets); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                if ($totalAssets[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($totalAssets[$i]), $fontstyleName, $centerAlignment);
                }
            }


            $table->addRow();
            $table->addCell($firstCellValue)->addText("LIABILITIES", $fontStyleBlack);
            $table->addRow();
            $table->addCell($firstCellValue)->addText("Current liabilities", $fontStyleBlack);

            $liabilitiesTradePayable = array();
            $otherLiabilites = array();
            for ($i = 0; $i < count($liabilitiesAmount); $i++) {
                $liabilitiesTradePayable[$i] = array();
                $otherLiabilites[$i] = array();
                for ($x = 0; $x < count($liabilitiesAmount[$i]); $x++) {
                    // check if liabilities is part of trade and other payables
                    if (!in_array($liabilitiesAmount[$i][$x][0], $tradeLiabilitiesArray)) {
                        array_push($otherLiabilites[$i], array($liabilitiesAmount[$i][$x][0], $liabilitiesAmount[$i][$x][1]));
                    } else {
                        array_push($liabilitiesTradePayable[$i], array($liabilitiesAmount[$i][$x][0], $liabilitiesAmount[$i][$x][1]));
                    }
                }
            }

            $calculatedTradePayables = array();
            for ($i = 0; $i < count($liabilitiesTradePayable); $i++) {
                $tempCategoryArray = array();
                $calculatedTradePayables[$i] = array();
                for ($x = 0; $x < count($liabilitiesTradePayable[$i]); $x++) {
                    if (in_array($liabilitiesTradePayable[$i][$x][0], $tempCategoryArray)) {
                        continue;
                    } else {
                        array_push($tempCategoryArray, $liabilitiesTradePayable[$i][$x][0]);
                    }
                }
                for ($x = 0; $x < count($tempCategoryArray); $x++) {
                    $tempValue = 0;
                    for ($j = 0; $j < count($liabilitiesTradePayable[$i]); $j++) {
                        if (strcasecmp($tempCategoryArray[$x], $liabilitiesTradePayable[$i][$j][0]) == 0) {
                            $tempValue += $liabilitiesTradePayable[$i][$j][1];
                        }
                    }
                    array_push($calculatedTradePayables[$i], array($tempCategoryArray[$x], $tempValue));
                }
            }

            $finalTradeArray = array();
            for ($i = 0; $i < count($calculatedTradePayables); $i++) {
                $tradeValue = 0;
                for ($x = 0; $x < count($calculatedTradePayables[$i]); $x++) {
                    $tradeValue += $calculatedTradePayables[$i][$x][1];
                }
                array_push($finalTradeArray, round($tradeValue));
            }

            $table->addRow();
            $table->addCell($firstCellValue)->addText("Trade and other payables");
            $cell = $table->addCell($cellValue);
            $noteNumber = 0;
            for ($i = 0; $i < count($sequenceCategory); $i++) {
                if (stripos($sequenceCategory[$i], "trade and other payable") !== false) {
                    $noteNumber = $i + $defaultNoteNumber;
                }
            }
            if ($noteNumber != 0) {
                $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
            }

            for ($i = 0; $i < count($finalTradeArray); $i++) {
                $cell = $table->addCell($cellValue);
                if ($finalTradeArray[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($finalTradeArray[$i]), $fontstyleName, $centerAlignment);
                }
            }

            $allOtherLiabilities = array();
            $tempOtherLiabilities = array();
            for ($i = 0; $i < count($otherLiabilites); $i++) {
                for ($x = 0; $x < count($otherLiabilites[$i]); $x++) {
                    if (in_array($otherLiabilites[$i][$x][0], $tempOtherLiabilities)) {
                        continue;
                    } else {
                        array_push($tempOtherLiabilities, $otherLiabilites[$i][$x][0]);
                    }
                }
            }

            for ($i = 0; $i < count($bothLiabilitiesAmount); $i++) {
                for ($x = 0; $x < count($bothLiabilitiesAmount[$i]); $x++) {
                    if (in_array($bothLiabilitiesAmount[$i][$x][0], $tempOtherLiabilities)) {
                        continue;
                    } else {
                        array_push($tempOtherLiabilities, $bothLiabilitiesAmount[$i][$x][0]);
                    }
                }
            }

            $otherLiabilitesFinal = array();
            for ($i = 0; $i < count($tempOtherLiabilities); $i++) {
                $otherLiabilitesFinal[$i] = array();
                $secondLoop = true;
                $reduceValue = 0;
                for ($x = 0; $x < count($otherLiabilites); $x++) {
                    if ($i == count($otherLiabilites[$x])) {
                        $reduceValue = count($otherLiabilites[$x]);
                        break;
                    } else {
                        $secondLoop = false;
                    }
                    $tempValue = 0;
                    for ($j = 0; $j < count($otherLiabilites[$x]); $j++) {
                        if (strcasecmp($tempOtherLiabilities[$i], $otherLiabilites[$x][$j][0]) == 0) {
                            $tempValue += $otherLiabilites[$x][$j][1];
                        }
                    }
                    array_push($otherLiabilitesFinal[$i], round($tempValue));
                }

                if ($secondLoop) {
                    $loopCounter = count($tempOtherLiabilities) - $reduceValue;
                    for ($x = 0; $x < $loopCounter; $x++) {
                        $tempValue = 0;
                        for ($j = 0; $j < count($bothLiabilitiesAmount[$x]); $j++) {
                            if (strcasecmp($tempOtherLiabilities[$i], $bothLiabilitiesAmount[$x][$j][0]) == 0) {
                                $tempValue += $bothLiabilitiesAmount[$x][$j][1];
                            }
                        }
                        array_push($otherLiabilitesFinal[$i], round($tempValue));
                    }
                }
            }

            for ($i = 0; $i < count($otherLiabilitesFinal); $i++) {
                for ($x = 0; $x < count($years); $x++) {
                    if (isset($otherLiabilitesFinal[$i][$x])) {
                        continue;
                    } else {
                        $otherLiabilitesFinal[$i][$x] = 0;
                    }
                }
            }

            for ($i = 0; $i < count($tempOtherLiabilities); $i++) {
                $table->addRow();
                $table->addCell($firstCellValue)->addText($tempOtherLiabilities[$i]);
                $cell = $table->addCell($cellValue);
                $noteNumber = 0;
                for ($x = 0; $x < count($sequenceCategory); $x++) {
                    if (stripos($sequenceCategory[$x], $tempOtherLiabilities[$i]) !== false) {
                        $noteNumber = $x + $defaultNoteNumber;
                    }
                }

                if ($noteNumber != 0) {
                    $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
                }

                if ((stripos($tempOtherLiabilities[$i], "borrowing") !== false) && (isset($borrowingArray['current']) || isset($borrowingArray['non-current']))) {
                    for ($x = 0; $x < $numberOfSheets; $x++) {
                        if ($i == (count($tempOtherLiabilities) - 1)) {
                            $cell = $table->addCell($cellValue, $cellBottomBorder);
                        } else {
                            $cell = $table->addCell($cellValue);
                        }

                        if (isset($borrowingArray['current'][$years[$x]])) {
                            $cell->addText(number_format($borrowingArray['current'][$years[$x]]), $fontstyleName, $centerAlignment);
                        } else {
                            $cell->addText("-", $fontstyleName, $centerAlignment);
                        }
                    }
                } else {
                    for ($x = 0; $x < count($otherLiabilitesFinal[$i]); $x++) {
                        if ($i == (count($tempOtherLiabilities) - 1)) {
                            $cell = $table->addCell($cellValue, $cellBottomBorder);
                        } else {
                            $cell = $table->addCell($cellValue);
                        }

                        if ($otherLiabilitesFinal[$i][$x] == 0) {
                            $cell->addText("-", $fontstyleName, $centerAlignment);
                        } else {
                            $cell->addText(number_format($otherLiabilitesFinal[$i][$x]), $fontstyleName, $centerAlignment);
                        }
                    }
                }
            }

            $table->addRow();
            $table->addCell($firstCellValue)->addText("Total liabilities", $fontStyleBlack);
            $table->addCell($cellValue);
            $totalLiabilities = array();
            for ($i = 0; $i < count($finalTradeArray); $i++) {
                $totalValue = $finalTradeArray[$i];
                for ($x = 0; $x < count($otherLiabilites[$i]); $x++) {
                    $totalValue += $otherLiabilites[$i][$x][1];
                }
                for ($x = 0; $x < count($bothLiabilitiesAmount[$i]); $x++) {
                    if (stripos($bothLiabilitiesAmount[$i][$x][0], "borrowing") !== false) {
                        if (isset($borrowingArray['current'][$years[$i]])) {
                            $totalValue += $borrowingArray['current'][$years[$i]];
                        } else {
                            $borrowingKey = false;
                            for ($j = 0; $j < count($tempOtherLiabilities); $j++) {
                                if (stripos($tempOtherLiabilities[$j], "borrowing") !== false) {
                                    $borrowingKey = $j;
                                }
                            }
                            if (strcasecmp(gettype($borrowingKey), "boolean") == 0) {
                                continue;
                            } else {
                                $totalValue += $otherLiabilitesFinal[$borrowingKey][$x];
                            }
                        }
                    }
                }
                array_push($totalLiabilities, ceil($totalValue));
            }

            for ($i = 0; $i < count($totalLiabilities); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                if ($totalLiabilities[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($totalLiabilities[$i]), $fontstyleName, $centerAlignment);
                }
            }

            $table->addRow();
            $table->addCell($firstCellValue)->addText("Non-current liabilities", $fontStyleBlack);
            $hasNonCurrentBorrowing = false;
            for ($i = 0; $i < $numberOfSheets; $i++) {
                if (isset($borrowingArray['non-current'][$years[$i]])) {
                    $hasNonCurrentBorrowing = true;
                    break;
                } else {
                    continue;
                }
            }

// may use this if have additional non-current liabilities
            $totalNonCurrentLiabilites = array();

            if ($hasNonCurrentBorrowing) {
                $table->addRow();
                $table->addCell($firstCellValue)->addText("Borrowings", $fontstyleName);
                $cell = $table->addCell($cellValue);
                $noteNumber = 0;
                for ($i = 0; $i < count($sequenceCategory); $i++) {
                    if (stripos($sequenceCategory[$i], "borrowing") !== false) {
                        $noteNumber = $i + $defaultNoteNumber;
                    }
                }

                if ($noteNumber != 0) {
                    $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
                }

                for ($i = 0; $i < $numberOfSheets; $i++) {
                    $cell = $table->addCell($cellValue, $cellBottomBorder);
                    if (isset($borrowingArray['non-current'][$years[$i]])) {
                        $cell->addText(number_format($borrowingArray['non-current'][$years[$i]]), $fontstyleName, $centerAlignment);
                        array_push($totalNonCurrentLiabilites, $borrowingArray['non-current'][$years[$i]]);
                    } else {
                        $cell->addText("-", $fontstyleName, $centerAlignment);
                        array_push($totalNonCurrentLiabilites, 0);
                    }
                }
                for ($i = 0; $i < count($totalLiabilities); $i++) {
                    if (isset($borrowingArray['non-current'][$years[$i]])) {
                        $totalLiabilities[$i] += $borrowingArray['non-current'][$years[$i]];
                    }
                }
            }

            $table->addRow();
            $table->addCell($firstCellValue);
            $table->addCell($cellValue);
            for ($i = 0; $i < $numberOfSheets; $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                if (isset($totalNonCurrentLiabilites[$i])) {
                    $cell->addText(number_format($totalNonCurrentLiabilites[$i]), $fontstyleName, $centerAlignment);
                }
            }


            $table->addRow();
            $table->addCell($firstCellValue)->addText("Total liabilities", $fontStyleBlack);
            $table->addCell($cellValue);
            for ($i = 0; $i < count($totalLiabilities); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                if ($totalLiabilities[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($totalLiabilities[$i]), $fontstyleName, $centerAlignment);
                }
            }

// change liabilities to negative since the display as positive is no longer required
            for ($i = 0; $i < count($totalLiabilities); $i++) {
                $totalLiabilities[$i] = 0 - $totalLiabilities[$i];
            }

            $table->addRow();

            $netFound = array();
            $netValue = array();
            for ($i = 0; $i < count($totalAssets); $i++) {
                $currentValue = $totalAssets[$i];
                $currentValue += $totalLiabilities[$i];
                array_push($netValue, $currentValue);
                if ($currentValue < 0) {
                    if (!in_array("LIABILITIES", $netFound)) {
                        array_push($netFound, "LIABILITIES");
                    }
                } else {
                    if (!in_array("ASSETS", $netFound)) {
                        array_push($netFound, "ASSETS");
                    }
                }
            }

            $bsNetString = "NET ";
            for ($i = 0; $i < count($netFound); $i++) {
                if ($i > 0) {
                    $bsNetString .= "/ ";
                }
                $bsNetString .= $netFound[$i];
            }
            $cell = $table->addCell($firstCellValue);
            $cell->addText($bsNetString, $fontStyleBlack);
            $table->addCell($cellValue);
            for ($i = 0; $i < count($netValue); $i++) {
                $cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
                if ($netValue[$i] < 0) {
                    $cell->addText("(" . number_format(abs($netValue[$i])) . ")", $fontstyleName, $centerAlignment);
                } else if ($netValue[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($netValue[$i]), $fontstyleName, $centerAlignment);
                }
            }
            $table->addRow();
            $cell = $table->addCell($firstCellValue);
            $cell->addText("EQUITY", $fontStyleBlack);
            $table->addCell($cellValue);
            $capitalCategories = array();
            for ($i = 0; $i < count($capitalAmount); $i++) {
                for ($x = 0; $x < count($capitalAmount[$i]); $x++) {
                    if (!in_array($capitalAmount[$i][$x][0], $capitalCategories)) {
                        array_push($capitalCategories, $capitalAmount[$i][$x][0]);
                    }
                }
            }

            $bsEquity = array("Retained Profits", "Accumulated Losses");
            $profitOrLoss = array();
            $tempCheck = array();
            for ($i = 0; $i < count($capitalCategories); $i++) {
                if (!in_array($capitalCategories[$i], $bsEquity)) {
                    $table->addRow();
                    $cell = $table->addCell($firstCellValue);
                    $cell->addText($capitalCategories[$i]);
                    $noteNumber = 0;
                    $cell = $table->addCell($cellValue);
                    for ($x = 0; $x < count($sequenceCategory); $x++) {
                        if (stripos($sequenceCategory[$x], $capitalCategories[$i]) !== false) {
                            $noteNumber = $x + $defaultNoteNumber;
                        }
                    }

                    if ($noteNumber != 0) {
                        $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
                    }

                    for ($x = 0; $x < count($capitalAmount); $x++) {
                        $cell = $table->addCell($cellValue);
                        for ($j = 0; $j < count($capitalAmount[$x]); $j++) {
                            if (strcasecmp($capitalCategories[$i], $capitalAmount[$x][$j][0]) == 0) {
                                if ($capitalAmount[$x][$j][1] == 0) {
                                    $cell->addText("-", $fontstyleName, $centerAlignment);
                                } else {
                                    $cell->addText(number_format($capitalAmount[$x][$j][1]), $fontstyleName, $centerAlignment);
                                }
                            }
                        }
                    }
                } else {
                    if (!in_array($capitalCategories[$i], $tempCheck)) {
                        array_push($tempCheck, $capitalCategories[$i]);
                    }
                    for ($x = 0; $x < count($capitalAmount); $x++) {
                        for ($j = 0; $j < count($capitalAmount[$x]); $j++) {
                            if (strcasecmp($capitalCategories[$i], $capitalAmount[$x][$j][0]) == 0) {
                                array_push($profitOrLoss, array($capitalCategories[$i], $capitalAmount[$x][$j][1]));
                            }
                        }
                    }
                }
            }

            $stringPL = "";
            for ($i = 0; $i < count($tempCheck); $i++) {
                if ($i > 0) {
                    $stringPL .= "/ ";
                }
                if (strcasecmp($tempCheck[$i], "Retained Profits") == 0) {
                    $stringPL .= $tempCheck[$i];
                } else {
                    $stringPL .= "(" . $tempCheck[$i] . ")";
                }
            }

            $table->addRow();
            $table->addCell($firstCellValue)->addText($stringPL);
            $cell = $table->addCell($cellValue);
            $noteNumber = 0;
            for ($i = 0; $i < count($sequenceCategory); $i++) {
                if (stripos($sequenceCategory[$i], "retained profit") !== false || stripos($sequenceCategory[$i], "Accumulated loss") !== false) {
                    $noteNumber = $i + $defaultNoteNumber;
                }
            }

            if ($noteNumber != 0) {
                $cell->addText($noteNumber, $fontstyleName, $centerAlignment);
            }

            $calculatedRetainedProfits = array();
            for ($i = 0; $i < count($profitOrLoss); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $profitOrLoss[$i][1];
                $tempValue += $netPandL[$i];
                if ($tempValue < 0) {
                    $cell->addText("(" . number_format(abs($tempValue)) . ")", $fontstyleName, $centerAlignment);
                } else if ($tempValue == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($tempValue), $fontstyleName, $centerAlignment);
                }
                array_push($calculatedRetainedProfits, $tempValue);
            }


            $retainedProfitsFromTB = array();
            $shareCapitalFromTB = array();
            for ($i = 0; $i < count($capitalAmount); $i++) {
                for ($x = 0; $x < count($capitalAmount[$i]); $x++) {
                    if (strcasecmp($capitalAmount[$i][$x][0], "retained profits") == 0) {
                        array_push($retainedProfitsFromTB, $capitalAmount[$i][$x][1]);
                        $capitalAmount[$i][$x][1] = $calculatedRetainedProfits[$i];
                    } else {
                        array_push($shareCapitalFromTB, $capitalAmount[$i][$x][1]);
                    }
                }
            }

            $table->addRow();
            $table->addCell($firstCellValue)->addText("Total Equity", $fontStyleBlack);
            $table->addCell($cellValue);
            $totalEquityArray = array();
            for ($i = 0; $i < count($capitalAmount); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($capitalAmount); $x++) {
                    if (isset($capitalAmount[$i][$x][1])) {
                        $tempValue += $capitalAmount[$i][$x][1];
                    }
                }
                $tempValue = round($tempValue);
                array_push($totalEquityArray, $tempValue);
                $cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
                if ($tempValue == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($tempValue), $fontstyleName, $centerAlignment);
                }
            }

// Equity statement
            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack);
            $header->addText("STATEMENT OF CHANGES IN EQUITY<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack);
            $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

            $table = $section->addTable();
            $equityFirstCell = $cellValue * ($maxColumns - 3);
            $table->addRow();
            $table->addCell($equityFirstCell);
            $cell = $table->addCell($cellValue, $cellBottomBorder);
            $cell->addText("Share capital", $fontstyleName, $centerAlignment);
            $cell = $table->addCell($cellValue, $cellBottomBorder);
            $cell->addText("Retained profits", $fontstyleName, $centerAlignment);
            $cell = $table->addCell($cellValue, $cellBottomBorder);
            $cell->addText("Total", $fontstyleName, $centerAlignment);
            $table->addRow();
            $table->addCell($equityFirstCell);
            $table->addCell($cellValue)->addText("$", $fontstyleName, $centerAlignment);
            $table->addCell($cellValue)->addText("$", $fontstyleName, $centerAlignment);
            $table->addCell($cellValue)->addText("$", $fontstyleName, $centerAlignment);
            $table->addRow();
            $cell = $table->addCell($equityFirstCell);
            $cell->addText("Balance as at " . $firstDateString);
            $issuedShareArray = array();
            for ($i = count($retainedProfitsFromTB) - 1; $i >= 0; $i--) {
                $currentShare;
                if ($i == count($retainedProfitsFromTB) - 1) {
                    $currentShare = round($shareCapitalFromTB[$i]);
                } else {
                    $currentShare = round($shareCapitalFromTB[$i + 1]);
                }
                $cell = $table->addCell($cellValue);
                $cell->addText(number_format($currentShare), $fontstyleName, $centerAlignment);
                $cell = $table->addCell($cellValue);
                $cell->addText(number_format(round($retainedProfitsFromTB[$i])), $fontstyleName, $centerAlignment);
                $cell = $table->addCell($cellValue);
                $cell->addText(number_format(round($currentShare + $retainedProfitsFromTB[$i])), $fontstyleName, $centerAlignment);
                if ($i < count($retainedProfitsFromTB) - 1) {
                    if ($shareCapitalFromTB[$i] != $currentShare) {
                        $issuanceShare = $shareCapitalFromTB[$i] - $currentShare;
                        array_push($issuedShareArray, $issuanceShare);
                        $table->addRow();
                        $cell = $table->addCell($equityFirstCell);
                        $cell->addText("Issuance of ordinary shares");
                        $cell = $table->addCell($cellValue);
                        $cell->addText(number_format($issuanceShare), $fontstyleName, $centerAlignment);
                        $cell = $table->addCell($cellValue);
                        $cell->addText("-", $fontstyleName, $centerAlignment);
                        $cell = $table->addCell($cellValue);
                        $cell->addText(number_format($issuanceShare), $fontstyleName, $centerAlignment);
                    }
                }

                $table->addRow();
                $cell = $table->addCell($equityFirstCell);
                if ($netPandL[$i] < 0) {
                    $cell->addText("Total comprehensive loss for the financial period");
                } else {
                    $cell->addText("Total comprehensive income for the financial period");
                }
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $cell->addText("-", $fontstyleName, $centerAlignment);
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $cell->addText(number_format($netPandL[$i]), $fontstyleName, $centerAlignment);
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $cell->addText(number_format($netPandL[$i]), $fontstyleName, $centerAlignment);
                $table->addRow();
                $cell = $table->addCell($equityFirstCell);
                $cell->addText("Balance as at " . $yearEndedArray[$i]);
            }
            $cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
            $cell->addText(number_format($shareCapitalFromTB[0]), $fontstyleName, $centerAlignment);
            $cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
            $cell->addText(number_format(round($calculatedRetainedProfits[0])), $fontstyleName, $centerAlignment);
            $cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
            $cell->addText(number_format(round($shareCapitalFromTB[0] + $calculatedRetainedProfits[0])), $fontstyleName, $centerAlignment);
            if (round($totalEquityArray[0]) != round($shareCapitalFromTB[0] + $calculatedRetainedProfits[0])) {
                echo '<script language="javascript">alert("Value mismatch: total equity in\nStatement of financial position\nAND\nStatement of changes in equity");</script>';
            }

            // Cash flow statements
            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack);
            $header->addText("STATEMENT OF CASH FLOWS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack);
            $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

            $cashFlowFirstCell = $firstCellValue + $cellValue;
            $table = $section->addTable();
            $table->addRow();
            $table->addCell($cashFlowFirstCell);
            for ($i = 0; $i < count($formatedDate); $i++) {
                $cell = $table->addCell($cellValue);
                $dateStart = $formatedDate[$i][0];
                $dateEnd = $formatedDate[$i][1];
                if ($i == (count($formatedDate) - 1)) {
                    if (!empty($firstBalanceDate)) {
                        $dateStart = date_create($firstDateArray[2] . "-" . $firstDateArray[1] . "-" . $firstDateArray[0]);
                    }
                }
                $cell->addText(date_format($dateStart, "d.m.Y"), $fontstyleName, $centerAlignment);
                $cell->addText("to", $fontstyleName, $centerAlignment);
                $cell->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline, $centerAlignment);
                $cell->addText("$", $fontstyleName, $centerAlignment);
            }
            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText("Cash flows from operating activities", $fontStyleBlack, $noSpace);
            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText($beforeTaxString, $fontstyleName, $noSpace);

            for ($i = 0; $i < count($beforeIncomeTax); $i++) {
                $cell = $table->addCell($cellValue);
                if ($beforeIncomeTax[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else if ($beforeIncomeTax[$i] < 0) {
                    $cell->addText("(" . number_format(abs($beforeIncomeTax[$i])) . ")", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($beforeIncomeTax[$i]), $fontstyleName, $centerAlignment);
                }
            }

            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText("Adjustments for:");
            $adjustmentAccount = array();
            $adjustmentValues = array();
            for ($i = 0; $i < count($adjustmentsCashFlow); $i++) {
                for ($x = 0; $x < count($adjustmentsCashFlow[$i]); $x++) {
                    if (!in_array($adjustmentsCashFlow[$i][$x][0], $adjustmentAccount)) {
                        array_push($adjustmentAccount, $adjustmentsCashFlow[$i][$x][0]);
                    }
                }
            }

            for ($i = 0; $i < count($adjustmentAccount); $i++) {
                $adjustmentValues[$i] = array();
                for ($x = 0; $x < count($adjustmentsCashFlow); $x++) {
                    $tempValue = 0;
                    for ($j = 0; $j < count($adjustmentsCashFlow[$x]); $j++) {
                        if (stripos($adjustmentsCashFlow[$x][$j][0], $adjustmentAccount[$i]) !== false) {
                            $tempValue += $adjustmentsCashFlow[$x][$j][1];
                        }
                    }
                    $adjustmentValues[$i][count($adjustmentValues[$i])] = $tempValue;
                }
            }

            for ($i = 0; $i < count($adjustmentAccount); $i++) {
                $table->addRow();
                $cell = $table->addCell($cashFlowFirstCell);
                $cell->addText("\t" . $adjustmentAccount[$i], $fontstyleName, $noSpace);
                for ($x = 0; $x < count($adjustmentValues[$i]); $x++) {
                    if ($i == (count($adjustmentAccount) - 1)) {
                        $cell = $table->addCell($cellValue, $cellBottomBorder);
                    } else {
                        $cell = $table->addCell($cellValue);
                    }
                    if ($adjustmentValues[$i][$x] == 0) {
                        $cell->addText("-", $fontstyleName, $centerAlignment);
                    } else if ($adjustmentValues[$i][$x] < 0) {
                        $cell->addText("(" . number_format(abs($adjustmentValues[$i][$x])) . ")", $fontstyleName, $centerAlignment);
                    } else {
                        $cell->addText(number_format($adjustmentValues[$i][$x]), $fontstyleName, $centerAlignment);
                    }
                }
            }

            $table->addRow();
            $table->addCell($cashFlowFirstCell);
            $beforeTaxAfterAdjustments = array();
            for ($i = 0; $i < count($beforeIncomeTax); $i++) {
                $tempValue = $beforeIncomeTax[$i];
                for ($x = 0; $x < count($adjustmentValues); $x++) {
                    // $x == the account, $i == the year's value
                    $tempValue += $adjustmentValues[$x][$i];
                }
                array_push($beforeTaxAfterAdjustments, $tempValue);
            }

            for ($i = 0; $i < count($beforeTaxAfterAdjustments); $i++) {
                $cell = $table->addCell($cellValue);
                if ($beforeTaxAfterAdjustments[$i] < 0) {
                    $cell->addText("(" . number_format(abs($beforeTaxAfterAdjustments[$i])) . ")", $fontstyleName, $centerAlignment);
                } else if ($beforeTaxAfterAdjustments[$i] == 0) {
                    $cell->addText("-", $fontstyleName, $centerAlignment);
                } else {
                    $cell->addText(number_format($beforeTaxAfterAdjustments[$i]), $fontstyleName, $centerAlignment);
                }
            }

            $fromShareholderArray = array();
            for ($i = 0; $i < count($amountFromShareholder); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($amountFromShareholder[$i]); $x++) {
                    $tempValue += $amountFromShareholder[$i][$x][1];
                }
                $tempValue = 0 - $tempValue;
                array_push($fromShareholderArray, $tempValue);
            }

            $toShareholderArray = array();
            for ($i = 0; $i < count($amountToShareholder); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($amountToShareholder[$i]); $x++) {
                    $tempValue += $amountToShareholder[$i][$x][1];
                }
                array_push($toShareholderArray, $tempValue);
            }

            $tradeReceivableCashFlow = array();
            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText("Change in working capital", $fontstyleName, $noSpace);
            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText("\tTrade and other receivables", $fontstyleName, $noSpace);
            for ($i = 0; $i < count($totalReceivables); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $totalReceivables[$i];
                $tempValue += $fromShareholderArray[$i];
                if ($i + 1 <= count($totalReceivables) - 1) {
                    $tempValue = $totalReceivables[$i + 1] - $tempValue;
                }
                array_push($tradeReceivableCashFlow, $tempValue);
                if ($tempValue < 0) {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                } else if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = number_format($tempValue);
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $tradePayableCashFlow = array();
            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText("\tTrade and other payables", $fontstyleName);
            for ($i = 0; $i < count($finalTradeArray); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $finalTradeArray[$i];
                if ($i + 1 <= count($finalTradeArray) - 1) {
                    $tempValue -= $finalTradeArray[$i + 1];
                    $tempValue += $toShareholderArray[$i + 1];
                }
                array_push($tradePayableCashFlow, $tempValue);
                if ($tempValue < 0) {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                } else if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = number_format($tempValue);
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $cashGenerated = array();
            for ($i = 0; $i < count($beforeTaxAfterAdjustments); $i++) {
                $tempValue = $beforeTaxAfterAdjustments[$i];
                $tempValue += $tradeReceivableCashFlow[$i];
                $tempValue += $tradePayableCashFlow[$i];
                array_push($cashGenerated, $tempValue);
            }

            $cashGeneratedString = "Cash ";
            for ($i = 0; $i < count($cashGenerated); $i++) {
                if ($cashGenerated[$i] < 0 && stripos($cashGeneratedString, "(used in)") === false) {
                    if (stripos($cashGeneratedString, "generated from") !== false) {
                        $cashGeneratedString .= "/ ";
                    }
                    $cashGeneratedString .= "(used in) ";
                } else if ($cashGenerated >= 0 && stripos($cashGeneratedString, "generated from") === false) {
                    if (stripos($cashGeneratedString, "(used in)") !== false) {
                        $cashGeneratedString .= "/ ";
                    }

                    $cashGeneratedString .= "generated from ";
                }
            }

            $cashGeneratedString .= "operations";

            $table->addRow();
            $table->addCell($cashFlowFirstCell)->addText($cashGeneratedString, $fontstyleName);

            for ($i = 0; $i < count($cashGenerated); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $cashGenerated[$i];
                if ($tempValue < 0) {
                    $tempValue = "(" . number_format(abs($cashGenerated[$i])) . ")";
                } else {
                    $tempValue = number_format(abs($cashGenerated[$i]));
                }

                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText("Income tax paid", $fontstyleName);
            $incomeTaxPaid = array();
            for ($i = 0; $i < count($years); $i++) {
                $tempValue = 0;
                if (isset($incomeTaxArray['income tax paid'][$years[$i]])) {
                    $tempValue += $incomeTaxArray['income tax paid'][$years[$i]];
                }
                array_push($incomeTaxPaid, $tempValue);
            }

            for ($i = 0; $i < count($incomeTaxPaid); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $incomeTaxPaid[$i];
                if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $netCashGenerated = array();
            for ($i = 0; $i < count($cashGenerated); $i++) {
                $tempValue = $cashGenerated[$i];
                $tempValue += $incomeTaxPaid[$i];
                array_push($netCashGenerated, $tempValue);
            }

            $netCashGeneratedString = "Net cash ";
            for ($i = 0; $i < count($netCashGenerated); $i++) {
                if ($netCashGenerated[$i] < 0) {
                    if (stripos($netCashGeneratedString, "(used in)") === false) {
                        if (stripos($netCashGeneratedString, "generated from") !== false) {
                            $netCashGeneratedString .= "/ ";
                        }
                        $netCashGeneratedString .= "(used in) ";
                    }
                } else {
                    if (stripos($netCashGeneratedString, "generated from") === false) {
                        if (stripos($netCashGeneratedString, "(used in)") !== false) {
                            $netCashGeneratedString .= "/ ";
                        }
                        $netCashGeneratedString .= "generated from ";
                    }
                }
            }
            $netCashGeneratedString .= "operating activities";

            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText($netCashGeneratedString, $fontStyleBlack);
            for ($i = 0; $i < count($netCashGenerated); $i++) {
                $tempValue = $netCashGenerated[$i];
                if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else if ($tempValue == 0) {
                    $tempValue = 0;
                } else {
                    $tempValue = "(" . number_format(abs($netCashGenerated[$i])) . ")";
                }
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $netCashInvestment = array();

            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText("Cash flows from investing activities", $fontStyleBlack, $noSpace);
            $table->addRow();
            $cell = $table->addCell($cashFlowFirstCell);
            $cell->addText("Additions to plant and equipment", $fontstyleName);
            for ($i = count($arrayAddition) - 1; $i >= 0; $i--) {
                $tempValue = 0 - $arrayAddition[$i];
                $arrayAddition[$i] = $tempValue;
            }
            for ($i = count($arrayAddition) - 1; $i >= 0; $i--) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $arrayAddition[$i];
                array_push($netCashInvestment, $tempValue);
                if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $netCashInvestString = "Net cash ";
            for ($i = 0; $i < count($netCashInvestment); $i++) {
                if ($netCashInvestment[$i] < 0) {
                    if (stripos($netCashInvestString, "used in") === false) {
                        if (stripos($netCashInvestString, "generated from") !== false) {
                            $netCashInvestString .= "/ ";
                        }
                        $netCashInvestString .= "(used in) ";
                    }
                } else {
                    if (stripos($netCashInvestString, "generated from") === false) {
                        if (stripos($netCashInvestString, "used in") !== false) {
                            $netCashInvestString .= "/ ";
                        }
                        $netCashInvestString .= "generated from ";
                    }
                }
            }

            $netCashInvestString .= "investing activities";

            $table->addRow();
            $table->addCell($cashFlowFirstCell)->addText($netCashInvestString, $fontStyleBlack);
            for ($i = 0; $i < count($netCashInvestment); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $netCashInvestment[$i];
                if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($cashFlowFirstCell)->addText("Cash flows from financing activities:", $fontStyleBlack, $noSpace);
            $fixedIssuedShare = array();
            for ($i = 0; $i < $numberOfSheets; $i++) {
                if (isset($issuedShareArray[$i])) {
                    array_push($fixedIssuedShare, $issuedShareArray[$i]);
                } else {
                    array_push($fixedIssuedShare, 0);
                }
            }

            $table->addRow();
            $table->addCell($cashFlowFirstCell)->addText("Proceeds from issuance of ordinary shares", $fontstyleName, $noSpace);
            for ($i = 0; $i < count($fixedIssuedShare); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $fixedIssuedShare[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($cashFlowFirstCell)->addText("(Advances)/repayment from a shareholder", $fontstyleName, $noSpace);
            $advanceRepaymentShareholder = array();
            for ($i = 0; $i < count($fromShareholderArray); $i++) {
                $tempValue = $fromShareholderArray[$i];
                if ($i + 1 < count($fromShareholderArray)) {
                    $tempValue += $fromShareholderArray[$i + 1];
                }
                $tempValue -= $toShareholderArray[$i];
                if ($i + 1 < count($toShareholderArray)) {
                    $tempValue -= $toShareholderArray[$i + 1];
                }
                array_push($advanceRepaymentShareholder, $tempValue);
            }

            for ($i = 0; $i < count($advanceRepaymentShareholder); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $advanceRepaymentShareholder[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            foreach ($borrowingArray as $key => $value) {
                if (stripos($key, "current") !== false) {
                    continue;
                } else {
                    $table->addRow();
                    $table->addCell($cashFlowFirstCell)->addText($key, $fontstyleName, $noSpace);
                    for ($i = 0; $i < count($years); $i++) {
                        $cell = $table->addCell($cellValue);
                        $tempValue = 0;
                        if (isset($borrowingArray[$key][$years[$i]])) {
                            $tempValue += $borrowingArray[$key][$years[$i]];
                        }
                        if ($tempValue == 0) {
                            $tempValue = "-";
                        } else if ($tempValue > 0) {
                            $tempValue = number_format($tempValue);
                        } else {
                            $tempValue = "(" . number_format(abs($tempValue)) . ")";
                        }
                        $cell->addText($tempValue, $fontstyleName, $centerAlignment);
                    }
                }
            }

// if (isset($borrowingArray['proceeds from borrowings'])) {
//     $table->addRow();
//     $table->addCell($cashFlowFirstCell)->addText("Proceeds from borrowings", $fontstyleName, $noSpace);
//     for ($i = 0; $i < count($years); $i++) {
//         $cell = $table->addCell($cellValue);
//         if (isset($borrowingArray['proceeds from borrowings'][$years[$i]])) {
//             $tempValue = $borrowingArray['proceeds from borrowings'][$years[$i]];
//             if ($tempValue > 0) {
//                 $tempValue = number_format($tempValue);
//             } else if ($tempValue == 0) {
//                 $tempValue = "-";
//             } else {
//                 $tempValue = "(" . number_format(abs($tempValue)) . ")";
//             }
//             $cell->addText($tempValue, $fontstyleName, $centerAlignment);
//         } else {
//             $cell->addText("-", $fontstyleName, $centerAlignment);
//         }
//     }
// }
//
// if (isset($borrowingArray['repayments of borrowings'])) {
//     $table->addRow();
//     $table->addCell($cashFlowFirstCell)->addText("Repayments of borrowings", $fontstyleName, $noSpace);
//     for ($i = 0; $i < count($years); $i++) {
//         $cell = $table->addCell($cellValue);
//         if (isset($borrowingArray['repayments of borrowings'][$years[$i]])) {
//             $tempValue = $borrowingArray['repayments of borrowings'][$years[$i]];
//             if ($tempValue > 0) {
//                 $tempValue = number_format($tempValue);
//             } else if ($tempValue == 0) {
//                 $tempValue = "-";
//             } else {
//                 $tempValue = "(" . number_format(abs($tempValue)) . ")";
//             }
//             $cell->addText($tempValue, $fontstyleName, $centerAlignment);
//         } else {
//             $cell->addText("-", $fontstyleName, $centerAlignment);
//         }
//     }
// }

            $calculatedFinanceExpense = array();
            for ($i = 0; $i < count($financeExpenseArray); $i++) {
                $calculatedFinanceExpense[$i] = array();
                $tempValue = 0;
                for ($x = 0; $x < count($financeExpenseArray[$i]); $x++) {
                    // retrieve all accounts that has the word interest
                    if (stripos($financeExpenseArray[$i][$x][0], "interest") !== false) {
                        $tempValue += $financeExpenseArray[$i][$x][1];
                    }
                }
                $calculatedFinanceExpense[$i][count($calculatedFinanceExpense[$i])] = array("Interest paid", $tempValue);
            }

            for ($i = 0; $i < count($financeExpenseArray); $i++) {
                $tempValue = 0;
                $tempAccountName = "";
                for ($x = 0; $x < count($financeExpenseArray[$i]); $x++) {
                    // retrieve accounts that does not have the word interest
                    $interestExist = false;
                    for ($j = 0; $j < count($calculatedFinanceExpense); $j++) {
                        for ($k = 0; $k < count($calculatedFinanceExpense[$j]); $k++) {
                            if (stripos($calculatedFinanceExpense[$j][$k][0], $financeExpenseArray[$i][$x][0]) !== false || stripos($calculatedFinanceExpense[$j][$k][0], "interest") !== false) {
                                $interestExist = true;
                                break;
                            }
                        }
                    }
                    if (!$interestExist) {
                        $tempAccountName = $financeExpenseArray[$i][$x][0];
                        $tempValue += $financeExpenseArray[$i][$x][1];
                    } else {
                        continue;
                    }
                }
                if (!empty($tempAccountName)) {
                    $calculatedFinanceExpense[$i] = array();
                    $calculatedFinanceExpense[$i][count($calculatedFinanceExpense[$i])] = array($tempAccountName, $tempValue);
                }
            }

            $financeAccounts = array();
            for ($i = 0; $i < count($calculatedFinanceExpense); $i++) {
                for ($x = 0; $x < count($calculatedFinanceExpense[$i]); $x++) {
                    if (!in_array($calculatedFinanceExpense[$i][$x][0], $financeAccounts)) {
                        array_push($financeAccounts, $calculatedFinanceExpense[$i][$x][0]);
                    }
                }
            }

            $finalFinanceArray = array();
            for ($i = 0; $i < count($financeAccounts); $i++) {
                $finalFinanceArray[$i] = array();
                for ($x = 0; $x < count($calculatedFinanceExpense); $x++) {
                    $tempValue = 0;
                    for ($j = 0; $j < count($calculatedFinanceExpense[$x]); $j++) {
                        if (strcasecmp($financeAccounts[$i], $calculatedFinanceExpense[$x][$j][0]) == 0) {
                            $tempValue += $calculatedFinanceExpense[$x][$j][1];
                        }
                    }
                    $tempValue = 0 - $tempValue;
                    array_push($finalFinanceArray[$i], $tempValue);
                }
            }

            for ($i = 0; $i < count($financeAccounts); $i++) {
                $table->addRow();
                if ($i == count($financeAccounts) - 1) {
                    $table->addCell($cashFlowFirstCell)->addText($financeAccounts[$i], $fontstyleName);
                } else {
                    $table->addCell($cashFlowFirstCell)->addText($financeAccounts[$i], $fontstyleName, $noSpace);
                }
                for ($x = 0; $x < count($finalFinanceArray[$i]); $x++) {
                    if ($i == count($financeAccounts) - 1) {
                        $cell = $table->addCell($cellValue, $cellBottomBorder);
                    } else {
                        $cell = $table->addCell($cellValue);
                    }
                    $tempValue = $finalFinanceArray[$i][$x];
                    if ($tempValue == 0) {
                        $tempValue = "-";
                    } else if ($tempValue > 0) {
                        $tempValue = number_format($tempValue);
                    } else {
                        $tempValue = "(" . number_format(abs($tempValue)) . ")";
                    }
                    $cell->addText($tempValue, $fontstyleName, $centerAlignment);
                }
            }


            $netCashFinancing = array();
            for ($i = 0; $i < count($years); $i++) {
                $tempValue = $fixedIssuedShare[$i];
                $tempValue += $advanceRepaymentShareholder[$i];
                // if (isset($borrowingArray['proceeds from borrowings'][$years[$i]])) {
                //     $tempValue += $borrowingArray['proceeds from borrowings'][$years[$i]];
                // }
                // if (isset($borrowingArray['repayments of borrowings'][$years[$i]])) {
                //     $tempValue += $borrowingArray['repayments of borrowings'][$years[$i]];
                // }
                foreach ($borrowingArray as $key => $value) {
                    if (stripos($key, "current") !== false) {
                        continue;
                    } else {
                        if (isset($borrowingArray[$key][$years[$i]])) {
                            $tempValue += $borrowingArray[$key][$years[$i]];
                        }
                    }
                }
                for ($x = 0; $x < count($finalFinanceArray); $x++) {
                    $tempValue += $finalFinanceArray[$x][$i];
                }
                array_push($netCashFinancing, round($tempValue));
            }

            $netFinanceString = "Net cash ";
            for ($i = 0; $i < count($netCashFinancing); $i++) {
                if ($netCashFinancing[$i] < 0) {
                    if (stripos($netFinanceString, "used in") === false) {
                        if (stripos($netFinanceString, "generated from") !== false) {
                            $netFinanceString .= "/ ";
                        }
                        $netFinanceString .= "(used in) ";
                    }
                } else {
                    if (stripos($netFinanceString, "generated from") === false) {
                        if (stripos($netFinanceString, "used in") !== false) {
                            $netFinanceString .= "/ ";
                        }
                        $netFinanceString .= "generated from ";
                    }
                }
            }
            $netFinanceString .= "financing activities";

            $table->addRow();
            $table->addCell($cashFlowFirstCell)->addText($netFinanceString, $fontStyleBlack);
            for ($i = 0; $i < count($netCashFinancing); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $netCashFinancing[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $netCashEquivalent = array();
            for ($i = 0; $i < count($netCashGenerated); $i++) {
                $tempValue = $netCashGenerated[$i];
                if (isset($netCashInvestment[$i])) {
                    $tempValue += $netCashInvestment[$i];
                }
                $tempValue += $netCashFinancing[$i];
                array_push($netCashEquivalent, $tempValue);
            }

            $cashEquivalentString = "Net ";
            for ($i = 0; $i < count($netCashEquivalent); $i++) {
                if ($netCashEquivalent[$i] >= 0) {
                    if (stripos($cashEquivalentString, "increase") === false) {
                        if (stripos($cashEquivalentString, "decrease") !== false) {
                            $cashEquivalentString .= "/ ";
                        }
                        $cashEquivalentString .= "increase ";
                    }
                } else {
                    if (stripos($cashEquivalentString, "decrease") === false) {
                        if (stripos($cashEquivalentString, "increase") !== false) {
                            $cashEquivalentString .= "/ ";
                        }
                        $cashEquivalentString .= "decrease ";
                    }
                }
            }

            $cashEquivalentString .= "in cash and cash equivalents";

            $table->addRow();
            $table->addCell($cashFlowFirstCell)->addText($cashEquivalentString, $fontstyleName, $noSpace);
            for ($i = 0; $i < count($netCashEquivalent); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $netCashEquivalent[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            if ($hasBankBalance) {
                $table->addRow();
                $table->addCell($cashFlowFirstCell)->addText("Cash and cash equivalents at beginning of financial year/period", $fontstyleName, $noSpace);
                for ($i = 0; $i < count($bankArray); $i++) {
                    $cell = $table->addCell($cellValue, $cellBottomBorder);
                    if ($i + 1 < count($bankArray)) {
                        $tempValue = $bankArray[$i + 1];
                        if ($tempValue > 0) {
                            $tempValue = number_format($tempValue);
                        } else if ($tempValue == 0) {
                            $tempValue = "-";
                        } else {
                            $tempValue = "(" . number_format(abs($tempValue)) . ")";
                        }
                        $cell->addText($tempValue, $fontstyleName, $centerAlignment);
                    } else {
                        $cell->addText("-", $fontstyleName, $centerAlignment);
                    }
                }
            }

            $totalCashFlow = array();
            for ($i = 0; $i < count($netCashEquivalent); $i++) {
                $tempValue = $netCashEquivalent[$i];
                if ($hasBankBalance) {
                    if ($i + 1 < count($bankArray)) {
                        $tempValue += $bankArray[$i + 1];
                    }
                }
                array_push($totalCashFlow, round($tempValue));
            }

            $table->addRow();
            $table->addCell($cashFlowFirstCell)->addText("Cash and cash equivalents at end of financial year/period", $fontStyleBlack, $noSpace);
            for ($i = 0; $i < count($totalCashFlow); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $totalCashFlow[$i];
                if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
                if ($totalCashFlow[$i] !== $bankArray[$i]) {
                    echo '<script language="javascript">alert("Value mismatch: Cash and cash equivalents at end of financial year\nAND\nBank balances");</script>';
                }
            }

// End of 4 STATEMENTS
// Page 7
            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack);
            $header->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
            $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

            $section->addText("These notes form an integral part of and should be read in conjunction with the accompanying financial statements."
                    , $fontstyleName, $paragraphStyle);
            $section->addTextBreak(1);

            $section->addListItem("\tGENERAL INFORMATION", 0, $fontstyleName, $nestedListStyle);

            $section->addText("\tThe Company is incorporated and domiciled in Singapore."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe Company’s principal activities are those to carry-on the businesses of " . $companyPA
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe Company’s registered office is at " . $companyAddress
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe financial statements of the Company for the financial year ended \t\t" . date('F d Y', strtotime($yearEnd)) . " were authorised for issue in accordance with a resolution of the \tdirectors on the date of Statement by Directors."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tBASIS OF PREPARATION AND SUMMARY OF SIGNIFICANT ACCOUNTING \tPOLICIES", 0, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tBasis of preparation", 1, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tBasis of accounting", 2, $fontstyleName, $listingStyle);

            $section->addText("\tThe financial statements are prepared in accordance with Singapore Financial \tReporting Standards (“FRS”). The financial statements have been prepared under \tthe historical cost convention, except as disclosed in the \taccounting policies below."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe preparation of these financial statements in conformity with FRS requires \tmanagement to exercise its judgement in the process of applying the Company’s \taccounting policies. It also requires the use of certain critical accounting estimates \tand assumptions. The areas involving a higher degree of judgement or complexity,or \tareas where assumptions and estimates are significant to the financial statements, \tare disclosed in Note 3"
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tAdoption of new and revised Singapore Financial Reporting Standards", 2, $fontstyleName, $listingStyle);

            $section->addText("\tOn " . date('F d Y', strtotime($frsDate)) . " the Company adopted the new or amended FRS and \tInterpretations to FRS (“INT FRS”) that are mandatory for application for the financial \tyear. The adoption of these new or amended FRS and INT FRS did not result \tinsubstantial changes of the Company’s accounting policies and had no material \teffect on the amounts reported for the current or prior financial period."
                    , $fontstyleName, $paragraphStyle);

//Page 8
            $section = $phpWord->addSection();

            $section->addListItem("\tSummary of significant accounting policies", 1, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tRevenue recognition", 3, $fontstyleName, $listingStyle);

            $section->addText("\tSales comprise the fair value of the consideration received or receivable for the \trendering of services in the ordinary course of the Company’s activities. Sales are \tpresented net of goods and services tax, rebates and discounts."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe Company recognises revenue when the amount of revenue and related cost can \tbe reliably measured, when it is probable that the collectability of the related \treceivables is reasonably assured and when the specific criteria for each of the \tCompany’s activities are met."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Service income", 1, $fontstyleName, $romanListingStyle);

            $section->addText("\tService income is recognised when services are rendered."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Sale of goods", 1, $fontstyleName, $romanListingStyle);

            $section->addText("\tRevenue from these sales is recognised when a Company has delivered the \tproducts to the customer,the customer has accepted the products and collectability of \tthe related receivables is reasonably assured."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tEmployee compensation", 3, $fontstyleName, $listingStyle);

            $section->addText("\tEmployee benefits are recognised as an expense, unless the cost qualifies to be \tcapitalised as an asset."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Defined contribution plans", 2, $fontstyleName, $romanListingStyle);

            $section->addText("\tDefined contribution plans are post-employment benefit plans under which the \tCompany pays fixed contributions into separate entities such as the Central \tProvident Fund on a mandatory, contractual or voluntary basis. The Company has no \tfurther payment obligations once the contributions have been paid."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Employee leave entitlement", 2, $fontstyleName, $romanListingStyle);

            $section->addText("\tEmployee entitlements to annual leave are recognised when they accrue to \temployees. A provision is made for the estimated liability for annual leave as a result \tof services rendered by employees up to the balance sheet date."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tOperating lease payments", 3, $fontstyleName, $listingStyle);

            $section->addText("\tPayments made under operating leases (net of any incentives received from the \tlessor) are recognized in profit or loss on a straight-line basis over the period of \tlease.", $fontstyleName, $paragraphStyle);

            $section->addText("\tContingent rents are recognised as an expense in profit or loss when incurred.", $fontstyleName, $paragraphStyle);

//Page 9
            $section = $phpWord->addSection();

            $section->addListItem("\tSummary of significant accounting policies ", 3, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tBorrowing costs", 3, $fontstyleName, $listingStyle);

            $section->addText("\tBorrowing costs are recognised in profit or loss using the effective interest method", $fontstyleName, $paragraphStyle);

            $section->addListItem("\tIncome taxes", 3, $fontstyleName, $listingStyle);

            $section->addText("\tCurrent income tax for current and prior periods is recognised at the amount \texpected to be paid to or recovered from the tax authorities,using the tax rates and \ttax laws that have been enacted or substantively enacted by the balance sheet date"
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tDeferred income tax is recognised for all temporary differences arising between the \ttax bases of assets and liabilities and their carrying amounts in the financial \tstatements except when the deferred income tax arises from the initial recognition of \tan asset or liability that affects neither accounting nor taxable profit or loss at the time \tof the transaction."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tA deferred income tax asset is recognised to the extent that it is probable that future \ttaxable profit will be available against which the deductible temporary differences and \ttax losses can be utilised."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tDeferred income tax is measured:", $fontstyleName, $paragraphStyle);

            $section->addListItem("at the tax rates that are expected to apply when the related deferred income tax asset is realised or the deferred income tax liability is settled, based on tax rates and tax laws that have been enacted or substantively enacted by the balance sheet date; and"
                    , 3, $fontstyleName, $romanListingStyle);

            $section->addListItem("based on the tax consequence that will follow from the manner in which the Company expects, at the balance sheet date, to recover or settle the carrying amounts of its assets and liabilities."
                    , 3, $fontstyleName, $romanListingStyle);

            $section->addText("\tCurrent and deferred income taxes are recognised as income or expense in profit or \tloss.", $fontstyleName, $paragraphStyle);
            ?>
            <!-- only applicable if inventory is in balance sheet-->
            <?php
            $section->addListItem("\tInventories", 3, $fontstyleName, $listingStyle);

            $section->addText("\tInventories are carried at the lower of cost and net realisable value. Cost is \tdetermined using the first-in, first-out method. Net realisable value is the estimated \tselling price in the ordinary course of business, less applicable variable selling \texpenses."
                    , $fontstyleName, $paragraphStyle);

//Page 10
            $section = $phpWord->addSection();

            $section->addListItem("\tSummary of significant accounting policies", 4, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tPlant and equipment", 3, $fontstyleName, $listingStyle);

            $section->addListItem("Measurement", 4, $fontstyleName, $romanListingStyle);

            $section->addText("\tPlant and equipment are initially recognised at cost and subsequently carried at cost \tless accumulated depreciation and accumulated impairment losses"
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe cost of an item of plant and equipment initially recognised includes its purchase \tprice and any cost that is directly attributable to bringing the asset to the location and \tcondition necessary for it to be capable of operating in the manner intended by \tmanagement."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Depreciation", 4, $fontstyleName, $romanListingStyle);

            $section->addText("\tDepreciation on plant and equipment is calculated using the straight-line method to \tallocate their depreciable amounts over their estimated useful lives as follows:"
                    , $fontstyleName, $paragraphStyle);
            ?>

            <!-- need to create table by form generation-->
            <?php
            $section->addText("\tThe residual values, estimated useful lives and depreciation method of plant and \tequipment are reviewed, and adjusted as appropriate, at the end of each reporting \tperiod.The effects of any revision are recognised in profit or loss when the changes \tarise."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tFully depreciated plant and equipment still in use are retained in the financial \tstatements."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Subsequent expenditure", 4, $fontstyleName, $romanListingStyle);

            $section->addText("\tSubsequent expenditure relating to plant and equipment that has already been \trecognised is added to the carrying amount of the asset only when it is probable that \tfuture economic benefits associated with the item will flow to the Company and the \tcost of the item can be measured reliably. All other repair and maintenance expenses \tare recognised in profit or loss when incurred.", $fontstyleName, $paragraphStyle);

            $section->addListItem("Disposal", 4, $fontstyleName, $romanListingStyle);

            $section->addText("\tOn disposal of an item of plant and equipment, the difference between the disposal \tproceeds and its carrying amount is recognised in profit or loss"
                    , $fontstyleName, $paragraphStyle);


//Page 11
            $section = $phpWord->addSection();

            $section->addListItem("\tSummary of significant accounting policies", 5, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tImpairment of non-financial assets", 3, $fontstyleName, $listingStyle);

            $section->addText("\tNon-financial assets are tested for impairment whenever there is any objective \tevidence or indication that these assets may be impaired."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tFor the purpose of impairment testing, the recoverable amount (i.e. the higher of the \tfair value less cost to sell and the value-in-use) is determined on an individual asset \tbasis unless the asset does not generate cash flows that are largely independent of \tthose from other assets. If this is the case, the recoverable amount is determined for \tthe CGU to which the asset belongs."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tIf the recoverable amount of the asset (or CGU) is estimated to be less than its \tcarrying amount, the carrying amount of the asset (or CGU) is reduced to its \trecoverable amount."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe difference between the carrying amount and recoverable amount is recognised \tas an impairment loss in profit or loss."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tAn impairment loss for an asset is reversed only if, there has been a change in the \testimates used to determine the asset’s recoverable amount since the last \timpairment loss was recognised. The carrying amount of this asset is increased to its \trevised recoverable amount, provided that this amount does not exceed the carrying \tamount that would have been determined (net of any accumulated amortisation or \tdepreciation) had no impairment loss been recognised for the asset in prior years."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tA reversal of impairment loss for an asset is recognised in profit or loss."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tFinancial assets", 3, $fontstyleName, $listingStyle);

            $section->addListItem("Classification", 5, $fontstyleName, $romanListingStyle);

            $section->addText("\tThe classification of financial assets depends on the purpose for which the assets \twere acquired. Management determines the classification of its financial assets at \tinitial recognition."
                    , $fontstyleName);

            $section->addText("\tLoans and receivables", $fontstyleName);

            $section->addText("\tLoans and receivables are non-derivative financial assets with fixed or determinable \tpayments that are not quoted in an active market. They are presented as current \tassets,except for those maturing later than 12 months after the end of financial \treporting date which are presented as non-current assets. Loans and receivables are \tpresented as “trade receivables” and “cash and bank balances” on the statement of \tfinancial position."
                    , $fontstyleName);

//Page 12
            $section = $phpWord->addSection();

            $section->addListItem("\tSummary of significant accounting policies", 6, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tFinancial assets (Cont’d)", 7, $fontstyleName, $listingStyle);

            $section->addListItem("Recognition and derecognition", 5, $fontstyleName, $romanListingStyle);

            $section->addText("\tRegular way purchases and sales of financial assets are recognised on trade-date - \tthe date on which the Company commits to purchase or sell the asset."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tFinancial assets are derecognised when the rights to receive cash flows from the \tfinancial assets have expired or have been transferred and the Company has \ttransferred substantially all risks and rewards of ownership. On disposal of a financial \tasset, the difference between the carrying amount and the sale proceeds is \trecognised in the profit or loss."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Initial measurement", 5, $fontstyleName, $romanListingStyle);

            $section->addText("\tFinancial assets are initially recognised at fair value plus transaction costs."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Subsequent measurement", 5, $fontstyleName, $romanListingStyle);

            $section->addText("\tLoans and receivables and financial assets are subsequently carried at amortised \tcost using the effective interest method."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Impairment", 5, $fontstyleName, $romanListingStyle);

            $section->addText("\tThe Company assesses at each end of financial reporting date whether there is \tobjective evidence that a financial asset or a group of financial assets is impaired and \trecognises an allowance for impairment when such evidence exists."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tLoans and receivables", $fontstyleName, $paragraphStyle);

            $section->addText("\tSignificant financial difficulties of the debtor, probability that the debtor will enter \tbankruptcy, and default or significant delay in payments are objective evidence that \tthese financial assets are impaired."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe carrying amount of these assets is reduced through the use of an impairment \tallowance account, which is calculated as the difference between the carrying \tamount and the present value of estimated future cash flows, discounted at the \toriginal effective interest rate. When the asset becomes uncollectible, it is written off \tagainst the allowance account. Subsequent recoveries of amounts previously written \toff are recognised against the same line item in the income statement."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe allowance for impairment loss account is reduced through the profit or loss in a \tsubsequent period when the amount of impairment loss decreases and the related \tdecrease can be objectively measured. The carrying amount of the asset previously \timpaired is increased to the extent that the new carrying amount does not exceed the \tamortised cost, had no impairment been recognised in prior periods."
                    , $fontstyleName, $paragraphStyle);

//Page 13
            $section = $phpWord->addSection();

            $section->addListItem("\tSummary of significant accounting policies", 7, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tTrade and other payables", 3, $fontstyleName, $listingStyle);

            $section->addText("\tTrade and other payables represent liabilities for goods and services provided to the \tCompany prior to the end of financial year which are unpaid. They are classified as \tcurrent liabilities if payment is due within one year or less (or in the normal operating \tcycle of the business if longer). Otherwise, they are presented as non-current \tliabilities."
                    , $fontstyleName);

            $section->addListItem("\tBorrowings", 3, $fontstyleName, $listingStyle);

            $section->addText("\tBorrowings are presented as current liabilities unless the Company has an \tunconditional right to defer settlement for at least 12 months after the balance sheet \tdate, in which case they are presented as non-current liabilities."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tBorrowings are initially recognised at fair value (net of transaction costs) and \tsubsequently carried at amortised cost. Any difference between the proceeds (net of \ttransaction costs)and the redemption value is recognised in profit or loss over the \tperiod of the borrowings using the effective interest method."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tCash and cash equivalents", 3, $fontstyleName, $listingStyle);

            $section->addText("\tFor the purpose presentation in the statement of cash flows, cash and cash \tequivalents include deposits with financial institutions which are subject to an \tinsignificant risk of change"
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tCash and cash equivalents", 3, $fontstyleName, $listingStyle);

            $section->addText("\tDividends to the Company’s shareholders are recognized when the dividends are \tapproved for payment."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tCurrency translation", 3, $fontstyleName, $listingStyle);

            $section->addListItem("Functional and presentation currency", 6, $fontstyleName, $romanListingStyle);

            $section->addText("\tItems included in the financial statements of the Company are measured using the \tcurrency of the primary economic environment in which the Company operates (‘the \tfunctional currency’).The financial statements are presented in Singapore Dollar, \twhich is the Company’s functional and presentation currency"
                    , $fontstyleName, $paragraphStyle);

// Page 14
            $section = $phpWord->addSection();

            $section->addListItem("\tSummary of significant accounting policies", 8, $fontstyleName, $nestedListStyle);

            $section->addListItem("\tCurrency translation (Cont’d)", 6, $fontstyleName, $listingStyle);
            $section->addListItem("Currency translation (Cont’d)", 2, $fontstyleName, $listingStyle, $paragraphStyle);

            $section->addListItem("Transactions and balances", 6, $fontstyleName, $romanListingStyle);

            $section->addText("\tTransactions in a currency other than the functional currency (“foreign currency”) are \ttranslated into the functional currency using the exchange rates at the dates of the \ttransactions.Currency translation differences from the settlement of such transactions \tand from the translation of monetary assets and liabilities denominated in foreign \tcurrencies at the closing rates at the end of financial reporting date are recognised in \tthe profit or loss, unless they arise from borrowings in foreign currencies, other \tcurrency instruments designated and qualifying as net investment hedges and net \tinvestment in foreign operations. Those currency translation differences are \trecognised in the currency translation reserve in the financial statements and \ttransferred to profit or loss as part of the gain or loss on disposal of the foreign \toperation."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tShare capital ", 3, $fontstyleName, $listingStyle);

            $section->addText("\tOrdinary shares are classified as equity. Incremental costs directly attributable to the \tissuance of new ordinary shares are deducted against the share capital account."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tCRITICAL ACCOUNTING ESTIMATES, ASSUMPTIONS AND JUDGEMENTS", 0, $fontstyleName, $nestedListStyle);

            $section->addText("\tEstimates, assumptions and judgements are continually evaluated and are based on \thistorical experience and other factors, including expectations of future events that \tare believed to be reasonable under the circumstances."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tCritical accounting estimates and assumptions", 5, $fontstyleName, $listingStyle);

            $section->addText("\tDuring the financial year, the management did not make any critical estimates and \tassumptions that had a significant effect on the amounts recognised in the financial \tstatements"
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tCritical judgements in applying the Company’s accounting policies", 5, $fontstyleName, $listingStyle);

            $section->addText("\tIn the process of applying the Company’s accounting policies, the directors are of the \topinion that there is no application of critical judgement on the amounts recognised in \tthe financial statements."
                    , $fontstyleName, $paragraphStyle);

//==============================================================================
// PHOEBE START HERE
//==============================================================================
// number of columns for each statement,
// 1 column heading, maximum 5 years allowed.
            $maxColumnsNotes = 6;
// 1 column heading, 4 column extra.
            $maxColumnsNotesException = 5;

            $cellValueNotes = 1750;
            $firstCellValueNotes = 0;

            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack);
            $header->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack);
            $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

            $table1 = $section->addTable();

// check number of unused columns.
// max columns - number of years + 1 column for Notes
// merge the number of unused columns for the first cell.
            for ($i = 0; $i < ($maxColumnsNotes - ($numberOfSheets + 1)); $i++) {
                $firstCellValueNotes += $cellValueNotes;
            }

// Display normally
            foreach ($fullArray as $key1 => $value1) { // [ Bank Balances] => Array of values
                if ($key1 !== "profit before income tax") {
                    if ($key1 !== "trade and other receivables") {
                        if ($key1 !== "share capital") {
                            if ($key1 !== "income taxes") {
                                if ($key1 !== "trade and other payables") {
                                    if ($key1 !== "borrowings") {

                                        // Display the category heading
                                        $section->addListItem(htmlspecialchars(strtoupper($key1)), 0, null, $nestedListStyle);
                                        $table1 = $section->addTable();

                                        // create notes table
                                        $table1->addRow();

//                            $table1->addListItem(htmlspecialchars(strtoupper($key1)), 0, null, $nestedListStyle);
                                        // Displaying the heading
                                        $table1->addCell($firstCellValueNotes);
                                        $cellNotes = $table1->addCell($cellValueNotes);

                                        // Create another row
                                        $table1->addRow();
                                        $table1->addCell($firstCellValueNotes);

                                        // Do the year heading
                                        for ($i = 0; $i < count($formatedDate); $i++) {
                                            $cellNotes = $table1->addCell(1750);
                                            $dateStart = $formatedDate[$i][0];
                                            $dateEnd = $formatedDate[$i][1];
                                            $cellNotes->addText(date_format($dateStart, "d.m.Y"));
                                            $cellNotes->addText("to", $fontstyleName, $centerAlignment);
                                            $cellNotes->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                                            $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                                        }

                                        array_push($displayedCategory, $key1);

                                        foreach ($value1 as $key2 => $value2) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                                            // Display the category heading
                                            $table1->addRow();
                                            $table1->addCell($firstCellValueNotes)->addText(ucwords($key2)); // ucwords($key2)

                                            foreach ($value2 as $key3 => $value3) { // [December 2015] => 54684.19
                                                // if don't need dash, just print everything out
                                                if ($numberOfSheets == count($value2)) {

                                                    $cellNotes = $table1->addCell($cellValue);
                                                    $cellNotes->addText(number_format(ceil($value3)), $fontstyleName, $centerAlignment);

                                                    for ($h = 0; $h < count($years); $h++) {
                                                        if ($key3 == $years[$h]) {
                                                            if ($totalArray[$years[$h]] == 0) {
                                                                $totalArray[$years[$h]] = $value3;
                                                            } else {
                                                                foreach ($totalArray as $totalKey => $totalValue) {
                                                                    if ($totalKey == $years[$h]) {
                                                                        $totalValue = (float) $totalValue + (float) $value3;
                                                                        $totalArray[$years[$h]] = $totalValue;
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                                // if not the same, then see which position it is
                                                else {
                                                    for ($h = 0; $h < count($years); $h++) {
                                                        $cellNotes = $table1->addCell($cellValue);
                                                        if ($key3 == $years[$h]) {
                                                            $cellNotes->addText(number_format(ceil($value3)), $fontstyleName, $centerAlignment);

                                                            if ($totalArray[$years[$h]] == 0) {
                                                                $totalArray[$years[$h]] = $value3;
                                                            } else {
                                                                foreach ($totalArray as $totalKey => $totalValue) {
                                                                    if ($totalKey == $years[$h]) {
                                                                        $totalValue = (float) $totalValue + (float) $value3;
                                                                        $totalArray[$years[$h]] = $totalValue;
                                                                    }
                                                                }
                                                            }
                                                        } else {
                                                            $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        $table1->addRow();
                                        $table1->addCell($firstCellValueNotes);

                                        foreach ($totalArray as $key => $value) {
                                            $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                                            if ($value < 0) {
                                                $cellNotes->addText("(" . number_format(ceil($value)) . ")", $fontstyleName, $centerAlignment);
                                            } else if ($value == 0) {
                                                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                            } else {
                                                $cellNotes->addText(number_format(ceil($value)), $fontstyleName, $centerAlignment);
                                            }
                                        }

                                        $table1->addRow();
                                        $table1->addCell($firstCellValueNotes);
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (!empty($profitBeforeIncomeTaxArray)) {

                // Display the category heading
                $section->addListItem(htmlspecialchars('PROFIT BEFORE INCOME TAX'), 0, null, $nestedListStyle);
                $table1 = $section->addTable();

                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Do the year heading
                for ($i = 0; $i < count($formatedDate); $i++) {
                    $cellNotes = $table1->addCell(1750);
                    $dateStart = $formatedDate[$i][0];
                    $dateEnd = $formatedDate[$i][1];
                    $cellNotes->addText(date_format($dateStart, "d.m.Y"));
                    $cellNotes->addText("to", $fontstyleName, $centerAlignment);
                    $cellNotes->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                    $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("This is determined after charging:");

                $total = count($profitBeforeIncomeTaxArray);
                $counter = 0;

                foreach ($profitBeforeIncomeTaxArray as $key1 => $value1) { //  [Depreciation of plant and equipment] => Array ( [December 2016] => 3014 )
                    // Display the category heading
                    $table1->addRow();
                    $table1->addCell($firstCellValue)->addText($key1);

                    $counter++;

                    foreach ($value1 as $key2 => $value2) { // [December 2016] => 3014
                        // if don't need dash, just print everything out
                        if ($numberOfSheets == count($value1)) {
                            if ($counter == $total) {
                                $cellNotes = $table1->addCell($cellValue, $cellThickBottomBorder);
                            } else {
                                $cellNotes = $table1->addCell($cellValue);
                            }

                            $cellNotes->addText(number_format(ceil($value2)), $fontstyleName, $centerAlignment);

                            for ($h = 0; $h < count($years); $h++) {
                                if ($key3 == $years[$h]) {
                                    if ($totalArray[$years[$h]] == 0) {
                                        $totalArray[$years[$h]] = $value2;
                                    } else {
                                        foreach ($totalArray as $totalKey => $totalValue) {
                                            if ($totalKey == $years[$h]) {
                                                $totalValue = (float) $totalValue + (float) $value2;
                                                $totalArray[$years[$h]] = $totalValue;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        // if not the same, then see which position it is
                        else {
                            for ($h = 0; $h < count($years); $h++) {
                                if ($counter == $total) {
                                    $cellNotes = $table1->addCell($cellValue, $cellThickBottomBorder);
                                } else {
                                    $cellNotes = $table1->addCell($cellValue);
                                }

                                if ($key2 == $years[$h]) {
                                    $cellNotes->addText(number_format(ceil($value2)), $fontstyleName, $centerAlignment);
                                } else {
                                    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                }
                            }
                        }
                    }
                }

                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);
            }

            if (!empty($incomeTaxArray)) {

                // For checking if the values matches
                $checkArray = array();
                $checkArray2 = array();
                $checkArray3 = array();

                for ($i = 0; $i < count($years); $i++) {
                    $checkArray[$years[$i]] = 0;
                    $checkArray2[$years[$i]] = 0;
                    $checkArray3[$years[$i]] = 0;
                }

                $taxExpenseKey = ['current income tax expenses', 'current year tax expense'];
                $provisionKey = ['under provision in prior year'];

                // Display the category heading
                $section->addListItem(htmlspecialchars('INCOME TAXES'), 0, null, 'multilevel');
                $table1 = $section->addTable();

                $table1->addRow();
                $table1->addCell($firstCellValue)->addListItem(htmlspecialchars('Income tax expense'), 1, null, $nestedListStyle);
                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Do the year heading
                for ($i = 0; $i < count($formatedDate); $i++) {
                    $cellNotes = $table1->addCell(1750);
                    $dateStart = $formatedDate[$i][0];
                    $dateEnd = $formatedDate[$i][1];
                    $cellNotes->addText(date_format($dateStart, "d.m.Y"));
                    $cellNotes->addText("to", $fontstyleName, $centerAlignment);
                    $cellNotes->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                    $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("Tax expense attributable to profit is made up of:");

                for ($i = 0; $i < count($taxExpenseKey); $i++) {
                    if (in_array($taxExpenseKey[$i], array_keys($incomeTaxArray))) {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText("Current income tax expenses");

                        foreach ($incomeTaxArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                            if ($taxExpenseKey[$i] === $key) {
                                foreach ($value as $k => $v) { // [December 2015] => 54684.19
                                    // if don't need dash, just print everything out
                                    if ($numberOfSheets == count($value)) {
                                        $cellNotes = $table1->addCell($cellValue);
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                        // for checking if the value matches with total
                                        for ($h = 0; $h < count($years); $h++) {
                                            if ($k == $years[$h]) {
                                                if ($checkArray[$years[$h]] == 0) {
                                                    $checkArray[$years[$h]] = $v;
                                                } else {
                                                    foreach ($checkArray as $totalKey => $totalValue) {
                                                        if ($totalKey == $years[$h]) {
                                                            $totalValue = (float) $totalValue + (float) $v;
                                                            $checkArray[$years[$h]] = $totalValue;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    // if not the same, then see which position it is
                                    else {
                                        for ($h = 0; $h < count($years); $h++) {
                                            $cellNotes = $table1->addCell($cellValue);
                                            if ($key == $taxExpenseKey[$i]) {
                                                if ($k == $years[$h]) {
                                                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                                    // for checking if the value matches with total
                                                    if ($checkArray[$years[$h]] == 0) {
                                                        $checkArray[$years[$h]] = $v;
                                                    } else {
                                                        foreach ($checkArray as $totalKey => $totalValue) {
                                                            if ($totalKey == $years[$h]) {
                                                                $totalValue = (float) $totalValue + (float) $v;
                                                                $checkArray[$years[$h]] = $totalValue;
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                for ($i = 0; $i < count($provisionKey); $i++) {
                    if (in_array($provisionKey[$i], array_keys($incomeTaxArray))) {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText(ucwords($provisionKey[$i]));

                        foreach ($incomeTaxArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                            if ($provisionKey[$i] === $key) {
                                foreach ($value as $k => $v) { // [December 2015] => 54684.19
                                    // if don't need dash, just print everything out
                                    if ($numberOfSheets == count($value)) {
                                        $cellNotes = $table1->addCell($cellValue);
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                        // for checking if the value matches with total
                                        for ($h = 0; $h < count($years); $h++) {
                                            if ($k == $years[$h]) {
                                                if ($checkArray[$years[$h]] == 0) {
                                                    $checkArray[$years[$h]] = $v;
                                                } else {
                                                    foreach ($checkArray as $totalKey => $totalValue) {
                                                        if ($totalKey == $years[$h]) {
                                                            $totalValue = (float) $totalValue + (float) $v;
                                                            $checkArray[$years[$h]] = $totalValue;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    // if not the same, then see which position it is
                                    else {
                                        for ($h = 0; $h < count($years); $h++) {
                                            $cellNotes = $table1->addCell($cellValue);
                                            if ($key == $provisionKey[$i]) {
                                                if ($k == $years[$h]) {
                                                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                                    // for checking if the value matches with total
                                                    if ($checkArray[$years[$h]] == 0) {
                                                        $checkArray[$years[$h]] = $v;
                                                    } else {
                                                        foreach ($checkArray as $totalKey => $totalValue) {
                                                            if ($totalKey == $years[$h]) {
                                                                $totalValue = (float) $totalValue + (float) $v;
                                                                $checkArray[$years[$h]] = $totalValue;
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);

                $array = array();
                $checkTotal = array();

                for ($i = 0; $i < count($incomeTaxExpenses); $i++) {
                    for ($j = 0; $j < count($years); $j++) {
                        $array[$years[$i]] = $incomeTaxExpenses[$i];
                    }

                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    if ($incomeTaxExpenses[$i] < 0) {
                        $cellNotes->addText("(" . number_format(abs($incomeTaxExpenses[$i])) . ")", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format($incomeTaxExpenses[$i]), $fontstyleName, $centerAlignment);
                    }
                }

                // Do checking for part (a) here
                foreach ($array as $key1 => $value1) {
                    foreach ($checkArray as $key2 => $value2) {
                        if ($key1 == $key2) {
                            if ($value1 != $value2) {
                                echo "Value mismatch: (a) Income Taxes - " . $key1 . " does not match <br>";
                            }
                        }
                    }
                }

                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);
                // Create another row
                $table1->addRow();
                $table1->addCell($cellValue * 3, array('gridSpan' => 3))->addText("The tax expense on profit differs from the amount that would arise using the Singapore standard rate of income tax as follows:");
                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Do the year heading
                for ($i = 0; $i < count($formatedDate); $i++) {
                    $cellNotes = $table1->addCell(1750);
                    $dateStart = $formatedDate[$i][0];
                    $dateEnd = $formatedDate[$i][1];
                    $cellNotes->addText(date_format($dateStart, "d.m.Y"));
                    $cellNotes->addText("to", $fontstyleName, $centerAlignment);
                    $cellNotes->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                    $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                }

                $table1->addRow();
                $cellNotes = $table1->addCell($firstCellValue);
                $beforeTaxString = "";
                for ($i = 0; $i < count($tempBeforeTaxCategory); $i++) {
                    if ($i > 0) {
                        $beforeTaxString .= " / ";
                    }
                    $beforeTaxString .= $tempBeforeTaxCategory[$i];
                }
                $beforeTaxString .= " before income tax";
                $cellNotes->addText($beforeTaxString);

                for ($i = 0; $i < count($beforeIncomeTax); $i++) {
                    $cellNotes = $table1->addCell($cellValue, $cellThickBottomBorder);
                    if ($beforeIncomeTax[$i] < 0) {
                        $cellNotes->addText("(" . number_format(abs($beforeIncomeTax[$i])) . ")", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format($beforeIncomeTax[$i]), $fontstyleName, $centerAlignment);
                    }
                }

                $tempIT = 0;

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("Tax calculated at tax rate of 17% (2015: 17%)");

                for ($i = 0; $i < count($beforeIncomeTax); $i++) {
                    $tempIT = ($beforeIncomeTax[$i] / 100) * 17;
                    $cellNotes = $table1->addCell($cellValue);
                    $cellNotes->addText(number_format(round($tempIT)), $fontstyleName, $centerAlignment);
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("Effects of:");

                foreach ($incomeTaxArray as $key => $value) {
                    if ($key != "current income tax expenses") {
                        if ($key != "under provision in prior year") {
                            if ($key != "income tax paid") {
                                if ($key != "current year tax expense") {
                                    $table1->addRow();
                                    $table1->addCell($firstCellValue)->addText("- " . trim($key));

                                    foreach ($value as $k => $v) {
                                        // if don't need dash, just print everything out
                                        if ($numberOfSheets == count($value)) {
                                            $cellNotes = $table1->addCell($cellValue);
                                            $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                            // for checking if the value matches with total
                                            for ($h = 0; $h < count($years); $h++) {
                                                if ($k == $years[$h]) {
                                                    if ($checkArray2[$years[$h]] == 0) {
                                                        $checkArray2[$years[$h]] = $v;
                                                    } else {
                                                        foreach ($checkArray2 as $totalKey => $totalValue) {
                                                            if ($totalKey == $years[$h]) {
                                                                $totalValue = (float) $totalValue + (float) $v;
                                                                $checkArray2[$years[$h]] = $totalValue;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                        // if not the same, then see which position it is
                                        else {
                                            for ($h = 0; $h < count($years); $h++) {
                                                $cellNotes = $table1->addCell($cellValue);
                                                if ($k == $years[$h]) {
                                                    $cellNotes->addText("(" . number_format(ceil($v)) . ")", $fontstyleName, $centerAlignment);

                                                    // for checking if the value matches with total
                                                    if ($checkArray2[$years[$h]] == 0) {
                                                        $checkArray2[$years[$h]] = $v;
                                                    } else {
                                                        foreach ($checkArray2 as $totalKey => $totalValue) {
                                                            if ($totalKey == $years[$h]) {
                                                                $totalValue = (float) $totalValue + (float) $v;
                                                                $checkArray2[$years[$h]] = $totalValue;
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $cellNotes->addText("- ", $fontstyleName, $centerAlignment);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("Tax expense");

                $array2 = array();
                for ($i = 0; $i < count($incomeTaxExpenses); $i++) {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    if ($incomeTaxExpenses[$i] < 0) {
                        $cellNotes->addText("(" . number_format(abs($incomeTaxExpenses[$i])) . ")", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format($incomeTaxExpenses[$i]), $fontstyleName, $centerAlignment);
                    }

                    // For checking of matching values
                    for ($j = 0; $j < count($years); $j++) {
                        $array2[$years[$i]] = $incomeTaxExpenses[$i];
                    }
                }

                // Do checking for part (a) Tax Calculated / Effect of...
                foreach ($array2 as $key1 => $value1) {
                    foreach ($checkArray2 as $key2 => $value2) {
                        if ($key1 == $key2) {
                            if ($value1 != $value2) {
                                echo "Value mismatch: (a) Tax expense - " . $key1 . " does not match <br>";
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);
                $table1->addRow();
                $table1->addCell($firstCellValue)->addListItem(htmlspecialchars('Movement in current income tax liabilities:'), 1, null, 'multilevel');

                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Do the year heading
                for ($i = 0; $i < count($formatedDate); $i++) {
                    $cellNotes = $table1->addCell(1750);
                    $dateStart = $formatedDate[$i][0];
                    $dateEnd = $formatedDate[$i][1];
                    $cellNotes->addText(date_format($dateStart, "d.m.Y"));
                    $cellNotes->addText("to", $fontstyleName, $centerAlignment);
                    $cellNotes->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                    $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("Beginning of financial year");

                // Start from 1 because need second year onwards
                for ($i = 1; $i < count($incomeTaxPayable); $i++) {
                    $cellNotes = $table1->addCell($cellValue);
                    if ($incomeTaxPayable[$i] < 0) {
                        $cellNotes->addText("(" . number_format(abs($incomeTaxPayable[$i])) . ")", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format(ceil($incomeTaxPayable[$i])), $fontstyleName, $centerAlignment);
                    }
                }

                if (in_array("income tax paid", array_keys($incomeTaxArray))) {
                    $table1->addRow();
                    $table1->addCell($firstCellValue)->addText("Income tax paid");

                    foreach ($incomeTaxArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                        if ($key == "income tax paid") {
                            foreach ($value as $k => $v) { // [December 2015] => 54684.19
                                // if don't need dash, just print everything out
                                if ($numberOfSheets == count($value)) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    $withoutFirstCharacter = substr($v, 1);
                                    $cellNotes->addText(number_format(ceil($withoutFirstCharacter)), $fontstyleName, $centerAlignment);

                                    // for checking if the value matches with total
                                    for ($h = 0; $h < count($years); $h++) {
                                        if ($k == $years[$h]) {
                                            if ($checkArray3[$years[$h]] == 0) {
                                                $checkArray3[$years[$h]] = $v;
                                            } else {
                                                foreach ($checkArray3 as $totalKey => $totalValue) {
                                                    if ($totalKey == $years[$h]) {
                                                        $totalValue = (float) $totalValue + (float) $v;
                                                        $checkArray3[$years[$h]] = $totalValue;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                // if not the same, then see which position it is
                                else {

                                    for ($h = 0; $h < count($years); $h++) {

                                        $cellNotes = $table1->addCell($cellValue);
                                        if ($k == $years[$h]) {
                                            if ($v < 0) {
                                                $withoutFirstCharacter = substr($v, 1);

                                                $cellNotes->addText("(" . number_format(ceil($withoutFirstCharacter)) . ")", $fontstyleName, $centerAlignment);
                                            } else {
                                                $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
                                            }

                                            // for checking if the value matches with total
                                            if ($checkArray3[$years[$h]] == 0) {
                                                $checkArray3[$years[$h]] = $v;
                                            } else {
                                                foreach ($checkArray3 as $totalKey => $totalValue) {
                                                    if ($totalKey == $years[$h]) {
                                                        $totalValue = (float) $totalValue + (float) $v;
                                                        $checkArray3[$years[$h]] = $totalValue;
                                                    }
                                                }
                                            }
                                        } else {
                                            $cellNotes->addText("- ", $fontstyleName, $centerAlignment);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                for ($i = 0; $i < count($taxExpenseKey); $i++) {
                    if (in_array($taxExpenseKey[$i], array_keys($incomeTaxArray))) {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText("Current year tax expense");

                        foreach ($incomeTaxArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                            if ($taxExpenseKey[$i] === $key) {
                                foreach ($value as $k => $v) { // [December 2015] => 54684.19
                                    // if don't need dash, just print everything out
                                    if ($numberOfSheets == count($value)) {
                                        $cellNotes = $table1->addCell($cellValue);
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                        // for checking if the value matches with total
                                        for ($h = 0; $h < count($years); $h++) {
                                            if ($k == $years[$h]) {
                                                if ($checkArray3[$years[$h]] == 0) {
                                                    $checkArray3[$years[$h]] = $v;
                                                } else {
                                                    foreach ($checkArray3 as $totalKey => $totalValue) {
                                                        if ($totalKey == $years[$h]) {
                                                            $totalValue = (float) $totalValue + (float) $v;
                                                            $checkArray3[$years[$h]] = $totalValue;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    // if not the same, then see which position it is
                                    else {
                                        for ($h = 0; $h < count($years); $h++) {
                                            if ($key == $taxExpenseKey[$i]) {
                                                $cellNotes = $table1->addCell($cellValue);
                                                if ($k == $years[$h]) {
                                                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                                    // for checking if the value matches with total
                                                    if ($checkArray3[$years[$h]] == 0) {
                                                        $checkArray3[$years[$h]] = $v;
                                                    } else {
                                                        foreach ($checkArray3 as $totalKey => $totalValue) {
                                                            if ($totalKey == $years[$h]) {
                                                                $totalValue = (float) $totalValue + (float) $v;
                                                                $checkArray3[$years[$h]] = $totalValue;
                                                            }
                                                        }
                                                    }
                                                } else {
                                                    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                for ($i = 0; $i < count($provisionKey); $i++) {
                    if (in_array($provisionKey[$i], array_keys($incomeTaxArray))) {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText(ucwords($provisionKey[$i]));
                    }

                    foreach ($incomeTaxArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                        if ($provisionKey[$i] === $key) {
                            foreach ($value as $k => $v) { // [December 2015] => 54684.19
                                // if don't need dash, just print everything out
                                if ($numberOfSheets == count($value)) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                    // for checking if the value matches with total
                                    for ($h = 0; $h < count($years); $h++) {
                                        if ($k == $years[$h]) {
                                            if ($checkArray3[$years[$h]] == 0) {
                                                $checkArray3[$years[$h]] = $v;
                                            } else {
                                                foreach ($checkArray3 as $totalKey => $totalValue) {
                                                    if ($totalKey == $years[$h]) {
                                                        $totalValue = (float) $totalValue + (float) $v;
                                                        $checkArray3[$years[$h]] = $totalValue;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                // if not the same, then see which position it is
                                else {
                                    for ($h = 0; $h < count($years); $h++) {
                                        if ($key == $provisionKey[$i]) {
                                            $cellNotes = $table1->addCell($cellValue);
                                            if ($k == $years[$h]) {
                                                $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                                // for checking if the value matches with total
                                                if ($checkArray3[$years[$h]] == 0) {
                                                    $checkArray3[$years[$h]] = $v;
                                                } else {
                                                    foreach ($checkArray3 as $totalKey => $totalValue) {
                                                        if ($totalKey == $years[$h]) {
                                                            $totalValue = (float) $totalValue + (float) $v;
                                                            $checkArray3[$years[$h]] = $totalValue;
                                                        }
                                                    }
                                                }
                                            } else {
                                                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("End of financial year");

                $array3 = array();
                for ($i = 0; $i < count($incomeTaxPayable); $i++) {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);

                    if ($incomeTaxPayable[$i] < 0) {
                        $cellNotes->addText("(" . number_format(abs($incomeTaxPayable[$i])) . ")", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format($incomeTaxPayable[$i]), $fontstyleName, $centerAlignment);
                    }

                    // For checking of matching values
                    for ($j = 0; $j < count($years); $j++) {
                        $array3[$years[$i]] = $incomeTaxPayable[$i];
                    }
                }

                // Do checking for part (a) Tax Calculated / Effect of...
                foreach ($array3 as $key1 => $value1) {
                    foreach ($checkArray3 as $key2 => $value2) {
                        if ($key1 == $key2) {
                            if ($value1 != $value2) {
                                echo "Value mismatch: (b) Movement in current income tax liabilities - " . $key1 . " does not match <br>";
                            }
                        }
                    }
                }

                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);
            }

            if (!empty($tradeReceivablesArray)) {

                // For calculating the total value
                $totalArray = array();

                for ($i = 0; $i < count($years); $i++) {
                    $totalArray[$years[$i]] = 0;
                }

                // For calculating trade receivables value only
                $totalReceivablesArray = array();

                for ($i = 0; $i < count($years); $i++) {
                    $totalReceivablesArray[$years[$i]] = 0;
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addListItem(htmlspecialchars('TRADE AND OTHER RECEIVABLES'), 0, null, $nestedListStyle);

                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Do the year heading
                for ($i = 0; $i < count($formatedDate); $i++) {
                    $cellNotes = $table1->addCell(1750);
                    $dateStart = $formatedDate[$i][0];
                    $dateEnd = $formatedDate[$i][1];
                    $cellNotes->addText(date_format($dateStart, "d.m.Y"));
                    $cellNotes->addText("to", $fontstyleName, $centerAlignment);
                    $cellNotes->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                    $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                }

                $tradeReceivables = ["trade receivables"];
                $temp = array();

                // Check if there's trade receivables available
                for ($i = 0; $i < count($tradeReceivables); $i++) {
                    if (array_key_exists($tradeReceivables[$i], $tradeReceivablesArray)) {
                        array_push($temp, $tradeReceivables[$i]);
                    }
                }
                foreach ($tradeReceivablesArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                    if (in_array($key, $temp)) {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText(ucwords($key));
                        foreach ($value as $k => $v) { // [December 2015] => 54684.19
                            // if don't need dash, just print everything out
                            if ($numberOfSheets == count($value)) {
                                $cellNotes = $table1->addCell($cellValue);
                                $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
                            }
                            // if not the same, then see which position it is
                            else {
                                for ($h = 0; $h < count($years); $h++) {
                                    $cellNotes = $table1->addCell($cellValue);

                                    if ($k == $years[$h]) {
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                        if ($totalReceivablesArray[$k] == 0) {
                                            $totalReceivablesArray[$k] = $v;
                                        } else {
                                            foreach ($totalReceivablesArray as $totalKey => $totalValue) {
                                                if ($totalKey == $k) {
                                                    $totalValue = (float) $totalValue + $v;
                                                    $totalReceivablesArray[$k] = $totalValue;
                                                }
                                            }
                                        }
                                    } else {
                                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                    }
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);

                foreach ($tradeReceivablesArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                    if (stripos($key, "trade receivable") === false) {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText(ucwords($key));
                    }

                    foreach ($value as $k => $v) { // [December 2015] => 54684.19
                        if (!in_array($key, $temp)) {

                            // if don't need dash, just print everything out
                            if ($numberOfSheets == count($value)) {
                                $cellNotes = $table1->addCell($cellValue);
                                $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
                            }
                            // if not the same, then see which position it is
                            else {
                                for ($h = 0; $h < count($years); $h++) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    if ($k == $years[$h]) {
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
                                        if ($totalArray[$years[$h]] == 0) {
                                            $totalArray[$years[$h]] = $v;
                                        } else {
                                            foreach ($totalArray as $totalKey => $totalValue) {

                                                if ($totalKey == $years[$h]) {
                                                    $totalValue = $v + (float) $totalValue;
                                                    $totalArray[$years[$h]] = $totalValue;
                                                }
                                            }
                                        }
                                    } else {
                                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                    }
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);

                foreach ($totalArray as $key => $value) {
                    $cellNotes = $table1->addCell($cellValue, $cellTopBorder);
                    if ($value < 0) {
                        $cellNotes->addText("(" . number_format(ceil($value)) . ")", $fontstyleName, $centerAlignment);
                    } else if ($value == 0) {
                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format(ceil($value)), $fontstyleName, $centerAlignment);
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);

                $table1->addRow();
                $table1->addCell($firstCellValue);

                $finalReceivables = array();

// For adding manually
//    foreach ($totalArray as $key => $value) {
//        foreach ($totalReceivablesArray as $keyReceivables => $valueReceivables) {
//            if ($key == $keyReceivables) {
//                $finalReceivables = (float) $value + (float) $valueReceivables;
//
//                if ($finalReceivables == 0) {
//                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
//                    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
//                } else if ($finalReceivables < 0) {
//                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
//                    $cellNotes->addText("(" . number_format(ceil($finalReceivables)) . ")", $fontstyleName, $centerAlignment);
//                } else {
//                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
//                    $cellNotes->addText(number_format(ceil($finalReceivables)), $fontstyleName, $centerAlignment);
//                }
//            }
//        }
//    }

                $array = array();
                // Getting values from financial statement
                for ($j = 0; $j < count($years); $j++) {
                    $array[$years[$j]] = $totalReceivables[$j];

                    if ($totalReceivables[$j] == 0) {
                        $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                    } else if ($totalReceivables[$j] < 0) {
                        $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                        $cellNotes->addText("(" . number_format(ceil($totalReceivables[$j])) . ")", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                        $cellNotes->addText(number_format(ceil($totalReceivables[$j])), $fontstyleName, $centerAlignment);
                    }
                }

                // Do checking for trade and other payables here
                $check = array();
                for ($i = 0; $i < count($years); $i++) {
                    $temp = (float) $totalReceivablesArray[$years[$i]] + (float) $totalArray[$years[$i]];
                    $check[$years[$i]] = $temp;
                }

                foreach ($check as $key1 => $value1) {
                    foreach ($totalReceivables as $key2 => $value2) {
                        if ($key1 == $key2) {
                            if ($value1 != $value2) {
                                echo "Value mismatch: Trade and other payables (Other payables) - " . $key1 . " does not match <br>";
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);
                $table1->addRow();
                $table1->addCell($cellValue * 5, array('gridSpan' => 5))->addText("The amount owing to a shareholder is unsecured, non-trade, interest free and repayable on demand.");
                $table1->addRow();
                $table1->addCell($firstCellValue);

                unset($totalArray);
            }

            if (!empty($tradePayableArray)) {

                // For checking if the values matches
                $checkArray = array();

                for ($i = 0; $i < count($years); $i++) {
                    $checkArray[$years[$i]] = 0;
                }

                // For calculating the total value
                $totalArray = array();

                for ($i = 0; $i < count($years); $i++) {
                    $totalArray[$years[$i]] = 0;
                }

                // For calculating trade payables value only
                $totalPayablesArray = array();

                for ($i = 0; $i < count($years); $i++) {
                    $totalPayablesArray[$years[$i]] = 0;
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addListItem(htmlspecialchars('TRADE AND OTHER PAYABLES'), 0, null, $nestedListStyle);

                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Do the year heading
                for ($i = 0; $i < count($formatedDate); $i++) {
                    $cellNotes = $table1->addCell(1750);
                    $dateStart = $formatedDate[$i][0];
                    $dateEnd = $formatedDate[$i][1];
                    $cellNotes->addText(date_format($dateStart, "d.m.Y"));
                    $cellNotes->addText("to", $fontstyleName, $centerAlignment);
                    $cellNotes->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                    $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                }

                $tradePayable = ["trade payables"];
                $temp = array();

                // Check if there's trade payables available
                for ($i = 0; $i < count($tradePayable); $i++) {
                    if (array_key_exists($tradePayable[$i], $tradePayableArray)) {
                        array_push($temp, $tradePayable[$i]);
                    }
                }

                foreach ($tradePayableArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                    if (stripos($key, "trade payable") !== false) {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText(ucwords($key));

                        foreach ($value as $k => $v) {
                            if (count($value) == $numberOfSheets) {
                                $cellNotes = $table1->addCell($cellValue);
                                $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
                            } else {
                                for ($h = 0; $h < count($years); $h++) {
                                    $cellNotes = $table1->addCell($cellValue);

                                    if ($k == $years[$h]) {
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                        // For calculating the sub total
                                        if ($totalPayablesArray[$k] == 0) {
                                            $totalPayablesArray[$k] = $v;
                                        } else {
                                            foreach ($totalPayablesArray as $totalKey => $totalValue) {
                                                if ($totalKey == $k) {
                                                    $totalValue = (float) $totalValue + $v;
                                                    $totalPayablesArray[$k] = $totalValue;
                                                }
                                            }
                                        }
                                    } else {
                                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                    }
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("Other payables", $fontstyleBottomUnderline);

                foreach ($tradePayableArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                    if (stripos($key, "trade payable") === false) {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText(ucwords($key));
                    }

                    foreach ($value as $k => $v) { // [December 2015] => 54684.19
                        if (!in_array($key, $temp)) {

                            // if don't need dash, just print everything out
                            if ($numberOfSheets == count($value)) {
                                $cellNotes = $table1->addCell($cellValue);
                                $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                // For calculating the sub total
                                for ($h = 0; $h < count($years); $h++) {
                                    if ($k == $years[$h]) {
                                        if ($totalArray[$years[$h]] == 0) {
                                            $totalArray[$years[$h]] = $v;
                                        } else {
                                            foreach ($totalArray as $totalKey => $totalValue) {
                                                if ($totalKey == $years[$h]) {
                                                    $totalValue = (float) $totalValue + (float) $v;
                                                    $totalArray[$years[$h]] = $totalValue;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            // if not the same, then see which position it is
                            else {
                                for ($h = 0; $h < count($years); $h++) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    if ($k == $years[$h]) {
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                        // For calculating the sub total
                                        if ($totalArray[$k] == 0) {
                                            $totalArray[$k] = $v;
                                        } else {
                                            foreach ($totalArray as $totalKey => $totalValue) {
                                                if ($totalKey == $k) {
                                                    $totalValue = ((float) $totalValue + (float) $v);
                                                    $totalArray[$k] = $totalValue;
                                                }
                                            }
                                        }
                                    } else {
                                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                    }
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);

                foreach ($totalArray as $key => $value) {
                    $cellNotes = $table1->addCell($cellValue, $cellTopBorder);
                    if ($value < 0) {
                        $cellNotes->addText("(" . number_format(ceil($value)) . ")", $fontstyleName, $centerAlignment);
                    } else if ($value == 0) {
                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format(ceil($value)), $fontstyleName, $centerAlignment);
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);

                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Do checking for trade and other payables here
                $array = array();
                for ($j = 0; $j < count($years); $j++) {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    $cellNotes->addText(number_format(ceil($finalTradeArray[$j])), $fontstyleName, $centerAlignment);
                    $array[$years[$j]] = $finalTradeArray[$j];
                }

                foreach ($array as $key1 => $value1) {
                    foreach ($checkArray as $key2 => $value2) {
                        if ($key1 == $key2) {
                            if ($value1 != $value2) {
                                echo "Value mismatch: Trade and other payables (Other payables) - " . $key1 . " does not match <br>";
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);
                $table1->addRow();
                $table1->addCell($cellValue * 5, array('gridSpan' => 5))->addText("The amount owing to a shareholder is unsecured, non-trade, interest free and repayable on demand.");
                $table1->addRow();
                $table1->addCell($firstCellValue);
            }

            if (!empty($borrowingArray)) {

                // For checking if the values matches
                $checkArray = array();
                $checkArray2 = array();

                for ($i = 0; $i < count($years); $i++) {
                    $checkArray[$years[$i]] = 0;
                    $checkArray2[$years[$i]] = 0;
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addListItem(htmlspecialchars('BORROWINGS'), 0, null, $nestedListStyle);

                // Create another row
                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Do the year heading
                for ($i = 0; $i < count($formatedDate); $i++) {
                    $cellNotes = $table1->addCell(1750);
                    $dateStart = $formatedDate[$i][0];
                    $dateEnd = $formatedDate[$i][1];
                    $cellNotes->addText(date_format($dateStart, "d.m.Y"));
                    $cellNotes->addText("to", $fontstyleName, $centerAlignment);
                    $cellNotes->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                    $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                }

                $count = 0;
                $currentNonCurrent = ["current", "non-current"];
                $tempCurrent = array();
                $temp = array();

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("As at beginning of financial year");

                for ($i = 1; $i < count($borrowings); $i++) {
                    $cellNotes = $table1->addCell($cellValue);

                    if (count($borrowings) == 2) {
                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                    } else {
                        if ($borrowings[$i] < 0) {
                            $cellNotes->addText("(" . number_format(abs($borrowings[$i])) . ")", $fontstyleName, $centerAlignment);
                        } else {
                            $cellNotes->addText(number_format(round($borrowings[$i])), $fontstyleName, $centerAlignment);
                        }
                    }
                }

                // check if there's current or non-current available, if available store inside temp array
                for ($i = 0; $i < count($currentNonCurrent); $i++) {
                    if (array_key_exists($currentNonCurrent[$i], $borrowingArray)) {
                        array_push($tempCurrent, $currentNonCurrent[$i]);
                    }
                }

                foreach ($borrowingArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                    if ($key != "current") {
                        if ($key != "non-current") {
                            if (stripos($key, "Repayment of borrowing") !== false) {
                                $table1->addRow();
                                $table1->addCell($firstCellValue)->addText("(Less) " . ucwords($key));
                            } else {
                                $table1->addRow();
                                $table1->addCell($firstCellValue)->addText(ucwords($key));
                            }

                            foreach ($value as $k => $v) { // [December 2015] => 54684.19
                                // Value is negative
                                if ($v < 0) {
                                    // if don't need dash, just print everything out
                                    if ($numberOfSheets == count($value)) {

                                        $withoutFirstCharacter = substr($v, 1);
                                        $cellNotes = $table1->addCell($cellValue);
                                        $cellNotes->addText("(" . number_format(ceil($withoutFirstCharacter)) . ")", $fontstyleName, $centerAlignment);

                                        // for checking if the value matches with total
                                        for ($h = 0; $h < count($years); $h++) {
                                            if ($k == $years[$h]) {
                                                if ($checkArray[$years[$h]] == 0) {
                                                    $checkArray[$years[$h]] = $v;
                                                } else {
                                                    foreach ($checkArray as $totalKey => $totalValue) {
                                                        if ($totalKey == $years[$h]) {
                                                            $totalValue = (float) $totalValue + (float) $v;
                                                            $checkArray[$years[$h]] = $totalValue;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    // if not the same, then see which position it is
                                    else {
                                        for ($h = 0; $h < count($years); $h++) {
                                            $cellNotes = $table1->addCell($cellValue);
                                            if ($k == $years[$h]) {
                                                $withoutFirstCharacter = substr($v, 1);
                                                $cellNotes->addText("(" . number_format(ceil($withoutFirstCharacter)) . ")", $fontstyleName, $centerAlignment);

                                                // for checking if the value matches with total
                                                if ($checkArray[$years[$h]] == 0) {
                                                    $checkArray[$years[$h]] = $v;
                                                } else {
                                                    foreach ($checkArray as $totalKey => $totalValue) {
                                                        if ($totalKey == $years[$h]) {
                                                            $totalValue = (float) $totalValue + (float) ceil($v);
                                                            $checkArray[$years[$h]] = $totalValue;
                                                        }
                                                    }
                                                }
                                            } else {
                                                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                            }
                                        }
                                    }
                                    // Value is zero
                                } else if ($v == 0) {
                                    for ($h = 0; $h < count($years); $h++) {
                                        $cellNotes = $table1->addCell($cellValue);
                                        if ($k == $years[$h]) {
                                            $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                        }
                                    }

                                    // Value is positive
                                } else {
                                    // if don't need dash, just print everything out
                                    if ($numberOfSheets == count($value)) {
                                        $cellNotes = $table1->addCell($cellValue);
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                        // for checking if the value matches with total
                                        for ($h = 0; $h < count($years); $h++) {
                                            if ($k == $years[$h]) {
                                                if ($checkArray[$years[$h]] == 0) {
                                                    $checkArray[$years[$h]] = $v;
                                                } else {
                                                    foreach ($checkArray as $totalKey => $totalValue) {
                                                        if ($totalKey == $years[$h]) {
                                                            $totalValue = (float) $totalValue + (float) $v;
                                                            $checkArray[$years[$h]] = $totalValue;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    // if not the same, then see which position it is
                                    else {
                                        for ($h = 0; $h < count($years); $h++) {
                                            $cellNotes = $table1->addCell($cellValue);
                                            if ($k == $years[$h]) {
                                                $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                                // for checking if the value matches with total
                                                if ($checkArray[$years[$h]] == 0) {
                                                    $checkArray[$years[$h]] = $v;
                                                } else {
                                                    foreach ($checkArray as $totalKey => $totalValue) {
                                                        if ($totalKey == $years[$h]) {
                                                            $totalValue = (float) $totalValue + (float) ceil($v);
                                                            $checkArray[$years[$h]] = $totalValue;
                                                        }
                                                    }
                                                }
                                            } else {
                                                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue)->addText("As at end of financial year");

                $array = array();
                for ($i = 0; $i < count($borrowings); $i++) {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    if ($borrowings[$i] < 0) {
                        $cellNotes->addText("(" . number_format(abs($borrowings[$i])) . ")", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format(round($borrowings[$i])), $fontstyleName, $centerAlignment);
                    }

                    for ($j = 0; $j < count($years); $j++) {
                        $array[$years[$i]] = $borrowings[$i];
                    }
                }

                // Do checking for top borrowing here
                foreach ($array as $key1 => $value1) {
                    foreach ($checkArray as $key2 => $value2) {
                        if ($key1 == $key2) {
                            if ($value1 != $value2) {
                                echo "Value mismatch: Borrowing (top) - " . $key1 . " does not match <br>";
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);

                // Displaying current / non-current starts here
                if (!empty($tempCurrent)) {

                    // Store current and non-current value in temp array
                    foreach ($borrowingArray as $key1 => $value1) {
                        foreach ($value1 as $key2 => $value2) {
                            if (in_array($key1, $tempCurrent)) {
                                $temp[$key1] = $value1;
                            }
                        }
                    }

                    // loop out current and non current in $temp
                    foreach ($temp as $key => $value) {
                        foreach ($value as $k => $v) {
                            if ($v < 0) {
                                $table1->addRow();
                                $table1->addCell($firstCellValue)->addText("(Less) " . ucwords($key));

                                // if don't need dash, just print everything out
                                if ($numberOfSheets == count($value)) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    $cellNotes->addText(ceil($v), $fontstyleName, $centerAlignment);

                                    // for checking if the value matches with total
                                    for ($h = 0; $h < count($years); $h++) {
                                        if ($k == $years[$h]) {
                                            if ($checkArray2[$years[$h]] == 0) {
                                                $checkArray2[$years[$h]] = $v;
                                            } else {
                                                foreach ($checkArray as $totalKey => $totalValue) {
                                                    if ($totalKey == $years[$h]) {
                                                        $totalValue = (float) $totalValue + (float) $v;
                                                        $checkArray2[$years[$h]] = $totalValue;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                // if not the same, then see which position it is
                                else {
                                    for ($h = 0; $h < count($years); $h++) {
                                        $cellNotes = $table1->addCell($cellValue);

                                        if ($k == $years[$h]) {
                                            $cellNotes->addText("(" . number_format(ceil($v)) . ")", $fontstyleName, $centerAlignment);

                                            // for checking if the value matches with total
                                            if ($checkArray2[$years[$h]] == 0) {
                                                $checkArray2[$years[$h]] = $v;
                                            } else {
                                                foreach ($checkArray2 as $totalKey => $totalValue) {
                                                    if ($totalKey == $years[$h]) {
                                                        $totalValue = (float) $totalValue + (float) $v;
                                                        $checkArray2[$years[$h]] = $totalValue;
                                                    }
                                                }
                                            }
                                        } else {
                                            $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                        }
                                    }
                                }
                            } else if ($v == 0) {
                                $table1->addRow();
                                $table1->addCell($firstCellValue)->addText(ucwords($key));

                                for ($h = 0; $h < count($years); $h++) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    if ($k == $years[$h]) {
                                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                    }
                                }
                            } else {
                                $table1->addRow();
                                $table1->addCell($firstCellValue)->addText(ucwords($key));

                                // if don't need dash, just print everything out
                                if ($numberOfSheets == count($value)) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                    // for checking if the value matches with total
                                    for ($h = 0; $h < count($years); $h++) {
                                        if ($k == $years[$h]) {
                                            if ($checkArray2[$years[$h]] == 0) {
                                                $checkArray2[$years[$h]] = $v;
                                            } else {
                                                foreach ($checkArray as $totalKey => $totalValue) {
                                                    if ($totalKey == $years[$h]) {
                                                        $totalValue = (float) $totalValue + (float) $v;
                                                        $checkArray2[$years[$h]] = $totalValue;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                // if not the same, then see which position it is
                                else {
                                    for ($h = 0; $h < count($years); $h++) {
                                        $cellNotes = $table1->addCell($cellValue);

                                        if ($k == $years[$h]) {
                                            $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);

                                            // for checking if the value matches with total
                                            if ($checkArray2[$years[$h]] == 0) {
                                                $checkArray2[$years[$h]] = $v;
                                            } else {
                                                foreach ($checkArray2 as $totalKey => $totalValue) {
                                                    if ($totalKey == $years[$h]) {
                                                        $totalValue = (float) $totalValue + (float) $v;
                                                        $checkArray2[$years[$h]] = $totalValue;
                                                    }
                                                }
                                            }
                                        } else {
                                            $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                        }
                                    }
                                }
                            }
                        }
                    }

                    $table1->addRow();
                    $table1->addCell($firstCellValue);

                    $array2 = array();
                    for ($i = 0; $i < count($borrowings); $i++) {
                        $cellNotes = $table1->addCell($cellValue, $topAndBottom);

                        if ($borrowings[$i] < 0) {
                            $cellNotes->addText("(" . number_format(abs($borrowings[$i])) . ")", $fontstyleName, $centerAlignment);
                        } else {
                            $cellNotes->addText(number_format(round($borrowings[$i])), $fontstyleName, $centerAlignment);
                        }

                        for ($j = 0; $j < count($years); $j++) {
                            $array2[$years[$i]] = $borrowings[$i];
                        }
                    }

                    // Do checking for top borrowing here
                    foreach ($array as $key1 => $value1) {
                        foreach ($checkArray2 as $key2 => $value2) {
                            if ($key1 == $key2) {
                                if ($value1 != $value2) {
                                    echo "Value mismatch: Borrowing (current/non-current) - " . $key1 . " does not match <br>";
                                }
                            }
                        }
                    }
                }

                $table1->addRow();
                $table1->addCell($firstCellValue);
            }

            if (in_array("share capital", $categoryArray)) {

                $beginningArray = array();

                array_push($displayedCategory, "Share Capital");

                $section = $phpWord->addSection();
                $table2 = $section->addTable();

                $table2->addRow();
                $table2->addCell($firstCellValue)->addListItem(htmlspecialchars('SHARE CAPITAL'), 0, null, $nestedListStyle);

                // Create another row
                $table2->addRow();
                $table2->addCell($firstCellValue);
                for ($i = 0; $i < count($shareCapital); $i++) {
                    $cellNotes = $table2->addCell($cellValue);
                    $cellNotes->addText("Number of ordinary shares", $fontstyleName, $centerAlignment);
                    $cellNotes = $table2->addCell($cellValue);
                    $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                }

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("Issued and fully paid:");

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("At beginning of financial year");

                // If only one year of TB inserted
                if (count($shareCapital) == 1) {
                    for ($j = 0; $j < 2; $j++) {
                        if ($shareCapital[0] < 0) {
                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText("(" . number_format($shareCapital[0]) . ")", $fontstyleName, $centerAlignment);
                        } else if ($shareCapital[0] > 0) {
                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText(number_format($shareCapital[0]), $fontstyleName, $centerAlignment);
                        }
                    }
                    array_push($beginningArray, $shareCapital[0]);
                }
                // More than 1 TB inserted
                else {
                    for ($i = 1; $i <= count($shareCapital); $i++) {
                        for ($j = 0; $j < 2; $j++) {
                            if ($i == count($shareCapital)) {
                                if ($shareCapital[$i - 1] < 0) {
                                    $cellNotes = $table2->addCell($cellValue);
                                    $cellNotes->addText("(" . number_format($shareCapital[$i - 1]) . ")", $fontstyleName, $centerAlignment);
                                } else if ($shareCapital[$i - 1] > 0) {
                                    $cellNotes = $table2->addCell($cellValue);
                                    $cellNotes->addText(number_format($shareCapital[$i - 1]), $fontstyleName, $centerAlignment);
                                }
                            } else {
                                if ($shareCapital[$i] < 0) {
                                    $cellNotes = $table2->addCell($cellValue);
                                    $cellNotes->addText("(" . number_format($shareCapital[$i]) . ")", $fontstyleName, $centerAlignment);
                                } else if ($shareCapital[$i] > 0) {
                                    $cellNotes = $table2->addCell($cellValue);
                                    $cellNotes->addText(number_format($shareCapital[$i]), $fontstyleName, $centerAlignment);
                                }
                            }
                        }

                        if ($i == count($shareCapital)) {
                            array_push($beginningArray, $shareCapital[$i - 1]);
                        } else {
                            array_push($beginningArray, $shareCapital[$i]);
                        }
                    }
                }

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("Issuance of ordinary shares");

                // If only one year of TB inserted
                if (count($shareCapital) == 1) {
                    $issuance = $shareCapital[0] - $beginningArray[0];
                    $cellNotes = $table2->addCell($cellValue);

                    if ($issuance <= 0) {
                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes->addText(number_format($issuance), $fontstyleName, $centerAlignment);
                    }
                } else {
                    for ($i = 0; $i < count($shareCapital); $i++) {
                        for ($j = 0; $j < 2; $j++) {
                            $cellNotes = $table2->addCell($cellValue);
                            $issuance = $shareCapital[$i] - $beginningArray[$i];

                            if ($issuance <= 0) {
                                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                            } else {
                                $cellNotes->addText(number_format($issuance), $fontstyleName, $centerAlignment);
                            }
                        }
                    }
                }

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("At end of financial year/period");

                // If only one year of TB inserted
                if (count($shareCapital) == 1) {
                    for ($j = 0; $j < 2; $j++) {
                        if ($shareCapital[0] < 0) {
                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText("(" . number_format($shareCapital[0]) . ")", $fontstyleName, $centerAlignment);
                        } else if ($shareCapital[0] > 0) {
                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText(number_format($shareCapital[0]), $fontstyleName, $centerAlignment);
                        }
                    }
                }
                // More than 1 TB inserted
                else {
                    for ($i = 0; $i < count($shareCapital); $i++) {
                        for ($j = 0; $j < 2; $j++) {

                            if ($shareCapital[$i] < 0) {
                                $cellNotes = $table2->addCell($cellValue, $topAndBottom);
                                $cellNotes->addText("(" . number_format($shareCapital[$i]) . ")", $fontstyleName, $centerAlignment);
                            } else if ($shareCapital[$i] > 0) {
                                $cellNotes = $table2->addCell($cellValue, $topAndBottom);
                                $cellNotes->addText(number_format($shareCapital[$i]), $fontstyleName, $centerAlignment);
                            }
                        }
                    }
                }

                $table2->addRow();
                $table2->addCell($firstCellValue);

                $table2->addRow();
                $table2->addCell($cellValue * 5, array('gridSpan' => 5))->addText("All issued ordinary shares are fully paid. The newly issued shares rank pari passu in all respects with the previously issued shares. "
                        . "There is no par value for the ordinary share. The holder of the ordinary share is entitled to receive dividends as end when declared by the Company.", $paragraphStyle);
            }

            if (in_array("plant and equipment", $categoryArray)) {

                array_push($displayedCategory, "Plant and Equipment");

                // ---- Cost ----
                $tempComputerAndSoftwares = 0;
                $tempComputerAndSoftwaresArray = array();

                $counter = 0;
                foreach ($tempSoftware as $keyS => $valueS) { //  [0] => 33024.29 [1] => 7607.43
                    if ($counter == $keyS) {
                        $tempComputerAndSoftwares += $valueS;
                    }

                    foreach ($tempComputer as $keyC => $valueC) { //  [0] => 33024.29 [1] => 7607.43
                        if ($counter == $keyC) {
                            $tempComputerAndSoftwares += $valueC;
                        }
                    }
                    array_push($tempComputerAndSoftwaresArray, round($tempComputerAndSoftwares));
                    $tempComputerAndSoftwares = 0;
                    $counter ++;
                }

                // ---- Accumulated depreciation ----
                $depComputerAndSoftware = 0;
                $depComputerAndSoftwareArray = array();

                $depCounter = 0;
                foreach ($depSoftware as $keyS => $valueS) { //  [0] => 33024.29 [1] => 7607.43
                    if ($depCounter == $keyS) {
                        $depComputerAndSoftware += $valueS;
                    }

                    foreach ($depComputer as $keyC => $valueC) { //  [0] => 33024.29 [1] => 7607.43
                        if ($depCounter == $keyC) {
                            $depComputerAndSoftware += $valueC;
                        }
                    }
                    array_push($depComputerAndSoftwareArray, round($depComputerAndSoftware));
                    $depComputerAndSoftware = 0;
                    $depCounter ++;
                }

                $arrayAddition = array();

                $section = $phpWord->addSection();
                $table2 = $section->addTable();

                $table2->addRow();
                $table2->addCell($firstCellValue)->addListItem(htmlspecialchars('PLANT AND EQUIPMENT'), 0, null, $nestedListStyle);

                // Create another row
                $table2->addRow();
                $table2->addCell($firstCellValue);
                $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                $cellNotes->addText("Computer and Softwares", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                $cellNotes->addText("Office equipment", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                $cellNotes->addText("Total", $fontstyleName, $centerAlignment);
                $table2->addRow();
                $table2->addCell($firstCellValue);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("$", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("$", $fontstyleName, $centerAlignment);

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("Cost: ", $fontStyleBlack);

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("As as 1 July 2014");
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("-", $fontstyleName, $centerAlignment);

                for ($i = count($years) - 1; $i >= 0; $i--) {

                    $additionComputerAndSoftwares = 0;
                    $additionOfficeEquipment = 0;

                    if (!empty($tempOfficeEquipment) && !empty($tempComputerAndSoftwaresArray)) {

                        if ($i == (count($years) - 1)) {
                            $additionComputerAndSoftwares = round($tempComputerAndSoftwaresArray[$i]) - 0;
                            $additionOfficeEquipment = round($tempOfficeEquipment[$i]) - 0;
                            $totalAddition = $additionComputerAndSoftwares + $additionOfficeEquipment;
                        } else if ($i == 0) { // the last row
                            $additionComputerAndSoftwares = round($tempComputerAndSoftwaresArray[$i]) - round($tempComputerAndSoftwaresArray[$i + 1]);
                            $additionOfficeEquipment = round($tempOfficeEquipment[$i]) - round($tempOfficeEquipment[$i + 1]);
                            $totalAddition = $additionComputerAndSoftwares + $additionOfficeEquipment;
                        } else {
                            $additionComputerAndSoftwares = round($tempComputerAndSoftwaresArray[$i - 1]) - round($tempComputerAndSoftwaresArray[$i]);
                            $additionOfficeEquipment = round($tempOfficeEquipment[$i - 1]) - round($tempOfficeEquipment[$i]);
                            $totalAddition = $additionComputerAndSoftwares + $additionOfficeEquipment;
                        }

                        array_push($arrayAddition, $totalAddition);

                        $table2->addRow();
                        $table2->addCell($firstCellValue)->addText("Additions");

                        $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                        $cellNotes->addText(number_format($additionComputerAndSoftwares), $fontstyleName, $centerAlignment);

                        $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                        $cellNotes->addText(number_format($additionOfficeEquipment), $fontstyleName, $centerAlignment);

                        $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                        $cellNotes->addText(number_format($totalAddition), $fontstyleName, $centerAlignment);

                        if ($i != 0) {
                            $table2->addRow();
                            $table2->addCell($firstCellValue)->addText("As at 31 " . $years[$i]);

                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText(number_format(round($tempComputerAndSoftwaresArray[$i])), $fontstyleName, $centerAlignment);

                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText(number_format(round($tempOfficeEquipment[$i])), $fontstyleName, $centerAlignment);

                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText(number_format((round($tempComputerAndSoftwaresArray[$i]) + round($tempOfficeEquipment[$i]))), $fontstyleName, $centerAlignment);
                        } else if ($i == 0) {
                            $table2->addRow();
                            $table2->addCell($firstCellValue)->addText("As at 31 " . $years[$i]);

                            $cellNotes = $table2->addCell($cellValue, $cellTopAndBottomNormal);
                            $cellNotes->addText(number_format(round($tempComputerAndSoftwaresArray[$i])), $fontstyleName, $centerAlignment);

                            $cellNotes = $table2->addCell($cellValue, $cellTopAndBottomNormal);
                            $cellNotes->addText(number_format(round($tempOfficeEquipment[$i])), $fontstyleName, $centerAlignment);

                            $cellNotes = $table2->addCell($cellValue, $cellTopAndBottomNormal);
                            $cellNotes->addText(number_format((round($tempComputerAndSoftwaresArray[$i]) + round($tempOfficeEquipment[$i]))), $fontstyleName, $centerAlignment);
                        }
                    }
                }

                $table2->addRow();
                $table2->addCell($firstCellValue);

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("Accumulated depreciation: ", $fontStyleBlack);

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("As as 1 July 2014");
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("-", $fontstyleName, $centerAlignment);

                for ($i = count($years) - 1; $i >= 0; $i--) {

                    $depChargeComputerAndSoftwares = 0;
                    $depChargeOfficeEquipment = 0;

                    if (!empty($depComputerAndSoftwareArray) && !empty($depOfficeEquipment)) {

                        if ($i == (count($years) - 1)) {
                            $depChargeComputerAndSoftwares = round($depComputerAndSoftwareArray[$i]) - 0;
                            $depChargeOfficeEquipment = round($depOfficeEquipment[$i]) - 0;
                            $totalAdditionDep = $depChargeComputerAndSoftwares + $depChargeOfficeEquipment;
                        } else if ($i == 0) { // the last row
                            $depChargeComputerAndSoftwares = round($depComputerAndSoftwareArray[$i]) - round($depComputerAndSoftwareArray[$i + 1]);
                            $depChargeOfficeEquipment = round($depOfficeEquipment[$i]) - round($depOfficeEquipment[$i + 1]);
                            $totalAdditionDep = $depChargeComputerAndSoftwares + $depChargeOfficeEquipment;
                        } else {
                            $depChargeComputerAndSoftwares = round($depComputerAndSoftwareArray[$i - 1]) - round($depComputerAndSoftwareArray[$i]);
                            $depChargeOfficeEquipment = round($depOfficeEquipment[$i - 1]) - round($depOfficeEquipment[$i]);
                            $totalAdditionDep = $depChargeComputerAndSoftwares + $depChargeOfficeEquipment;
                        }

                        $table2->addRow();
                        $table2->addCell($firstCellValue)->addText("Charge for the financial period");

                        $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                        $cellNotes->addText(number_format($depChargeComputerAndSoftwares), $fontstyleName, $centerAlignment);

                        $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                        $cellNotes->addText(number_format($depChargeOfficeEquipment), $fontstyleName, $centerAlignment);

                        $cellNotes = $table2->addCell($cellValue, $cellBottomBorder);
                        $cellNotes->addText(number_format($totalAdditionDep), $fontstyleName, $centerAlignment);

                        if ($i != 0) {
                            $table2->addRow();
                            $table2->addCell($firstCellValue)->addText("As at 31 " . $years[$i]);

                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText(number_format(round($depComputerAndSoftwareArray[$i])), $fontstyleName, $centerAlignment);

                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText(number_format(round($depOfficeEquipment[$i])), $fontstyleName, $centerAlignment);

                            $cellNotes = $table2->addCell($cellValue);
                            $cellNotes->addText(number_format((round($depComputerAndSoftwareArray[$i]) + round($depOfficeEquipment[$i]))), $fontstyleName, $centerAlignment);
                        } else if ($i == 0) {
                            $table2->addRow();
                            $table2->addCell($firstCellValue)->addText("As at 31 " . $years[$i]);

                            $cellNotes = $table2->addCell($cellValue, $cellTopAndBottomNormal);
                            $cellNotes->addText(number_format(round($depComputerAndSoftwareArray[$i])), $fontstyleName, $centerAlignment);

                            $cellNotes = $table2->addCell($cellValue, $cellTopAndBottomNormal);
                            $cellNotes->addText(number_format(round($depOfficeEquipment[$i])), $fontstyleName, $centerAlignment);

                            $cellNotes = $table2->addCell($cellValue, $cellTopAndBottomNormal);
                            $cellNotes->addText(number_format((round($depComputerAndSoftwareArray[$i]) + round($depOfficeEquipment[$i]))), $fontstyleName, $centerAlignment);
                        }
                    }
                }

                $table2->addRow();
                $table2->addCell($firstCellValue);

                $table2->addRow();
                $table2->addCell($firstCellValue)->addText("Net book value: ", $fontStyleBlack);

                $tempCS = 0;
                $tempOE = 0;
                $tempTotal = 0;

                for ($i = 0; $i < count($years); $i++) {

                    $tempCS = $tempComputerAndSoftwaresArray[$i] - $depComputerAndSoftwareArray[$i];
                    $tempOE = $tempOfficeEquipment[$i] - $depOfficeEquipment[$i];
                    $tempTotal = $tempCS + $tempOE;

                    $table2->addRow();
                    $table2->addCell($firstCellValue)->addText("As at 31 " . $years[$i]);

                    if ($tempCS > 0) {
                        $cellNotes = $table2->addCell($cellValue, $cellThickBottomBorder);
                        $cellNotes->addText(number_format($tempCS), $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes = $table2->addCell($cellValue, $cellThickBottomBorder);
                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                    }

                    if ($tempOE > 0) {
                        $cellNotes = $table2->addCell($cellValue, $cellThickBottomBorder);
                        $cellNotes->addText(number_format($tempOE), $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes = $table2->addCell($cellValue, $cellThickBottomBorder);
                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                    }

                    if ($tempTotal > 0) {
                        $cellNotes = $table2->addCell($cellValue, $cellThickBottomBorder);
                        $cellNotes->addText(number_format($tempTotal), $fontstyleName, $centerAlignment);
                    } else {
                        $cellNotes = $table2->addCell($cellValue, $cellThickBottomBorder);
                        $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                    }
                }
            }

//Page 19
            $section = $phpWord->addSection();

            $section->addListItem("\tFINANCIAL RISK MANAGEMENT ", 0, $fontstyleName, $nestedListStyle);

            $section->addText("\tThe Company’s activities expose it to a variety of financial risks. The Company’s \toverall business strategies, tolerance risk and general risk management philosophy \tare determined by directors in accordance with prevailing economic and operating \tconditions."
                    , $fontstyleName, $paragraphStyle);

            $textrun = $section->addTextRun();
            $textrun->addText("\t");
            $textrun->addText(htmlspecialchars("Currency risk"), array('underline' => 'single'));

            $section->addText("\tThe Company’s exposure to foreign exchange risk is minimal as transactions are \tpredominantly denominated in " . $currency . ", being the functional currency of the Company."
                    , $fontstyleName, $paragraphStyle);

            $textrun = $section->addTextRun();
            $textrun->addText("\t");
            $textrun->addText(htmlspecialchars("Interest rate risk"), array('underline' => 'single'));

            $section->addText("\tCash flow interest rate risk is the risk that the future cash flows of a financial \tinstrument will fluctuate because of changes in market interest rates. Fair value \tinterest rate risk is the risk that the fair value of a financial instrument will fluctuate \tdue to changes in market interest rates. As the Company has no significant interest \tbearing assets or liabilities, the Company’s income and operating cash flows are \tsubstantially independent of changes in market interest rates."
                    , $fontstyleName, $paragraphStyle);

            $textrun = $section->addTextRun();
            $textrun->addText("\t");
            $textrun->addText(htmlspecialchars("Liquidity risk"), array('underline' => 'single'));

            $section->addText("\tPrudent liquidity management implies maintaining sufficient cash and the availability \tof funding through an adequate amount of committed credit facilities. The Company \tmaintains sufficient cash balances to provide flexibility in meeting its day to day \tfunding requirements. Cash and cash equivalents are placed with credit worthy \tinstitutions."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe Company’s financial liabilities are due less than 1 year based on the remaining \tperiod from the reporting date to the contractual maturity date.  Balances due within \t12 months equal their carrying balances as the impact of discounting is not \tsignificant."
                    , $fontstyleName, $paragraphStyle);

            $textrun = $section->addTextRun();
            $textrun->addText("\t");
            $textrun->addText(htmlspecialchars("Fair value measurements"), array('underline' => 'single'));

            $section->addText("\tThe Company does not have any financial instruments as at end of the financial year \twhich are measured at fair value. The carrying values of other receivables and other \tpayables are assumed to approximate their fair values."
                    , $fontstyleName, $paragraphStyle);

            $textrun = $section->addTextRun();
            $textrun->addText("\t");
            $textrun->addText(htmlspecialchars("Credit risk"), array('underline' => 'single'));

            $section->addText("\tCredit risk is the risk that companies and other parties will be unable to meet their \tobligations to the Company resulting in financial loss to the Company. The Company \tmanages such risks by dealing with a diverse of credit-worthy counterparties to \tmitigate any significant concentration of credit risk. Credit policy includes assessing \tand evaluation of existing and new customers' credit reliability and monitoring of \treceivable collections. The Company places its cash and cash equivalents with \tcreditworthy institutions."
                    , $fontstyleName, $paragraphStyle);

            //Page 20
            $section = $phpWord->addSection();

            $textrun = $section->addTextRun();
            $textrun->addText("\t");
            $textrun->addText(htmlspecialchars("Credit risk (Cont’d)"), array('underline' => 'single'));

            $section->addText("\tThe maximum exposure to credit risk in the event that the counterparties fail to \tperform the obligations as at the end of the financial period in relation to each class \tof financial assets is the carrying amount of these assets in the statement of financial \tposition."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("\tThe credit risk for receivables based on the information provided to key management \tis as follows:"
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Financial assets that are neither past due nor impaired", 1, $fontstyleName, $listingStyle);

            $section->addText("\tBank deposits that are neither past due nor impaired are mainly deposits with banks \twith high credit-ratings assigned by international credit-rating agencies. Other \treceivables that are neither past due nor impaired are substantially companies with a \tgood collection track record with the Company."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("Financial assets that are past due and/or impaired", 1, $fontstyleName, $listingStyle);

            $section->addText("\tThere is no other class of financial assets that is past due and/or impaired."
                    , $fontstyleName, $paragraphStyle);

            $textrun = $section->addTextRun();
            $textrun->addText("\t");
            $textrun->addText(htmlspecialchars("Capital risk"), array('underline' => 'single'));

            $section->addText("\tThe Company’s objectives when managing capital are:", $fontstyleName, $paragraphStyle);

            $section->addText("\tThe capital structure of the Company consists primarily of equity, comprising issued \tshare capital."
                    , $fontstyleName);

            $section->addText("\tThe Company manages its capital structure and makes adjustment to it in light of \tchanges in economic conditions. It may maintain or adjust its capital structure \tthrough the payment of dividends, return of capital or issue of new shares."
                    , $fontstyleName);

            $section->addListItem("\tRELATED PARTY TRANSACTIONS ", 0, $fontstyleName, $nestedListStyle);

            $section->addText("\tRelated parties comprise mainly of companies which are controlled or significantly \tinfluenced by the Company’s key management personnel and their close family \tmembers."
                    , $fontstyleName);

            $section->addText("\tKey management personnel of the Company are those persons having the authority \tand responsibility for planning, directing and controlling activities of the Company.  \tThe directors and executive officers of the Company are considered as key \tmanagement personnel of the Company."
                    , $fontstyleName);

//Page 21
            $section = $phpWord->addSection();

            $section->addListItem("\tRELATED PARTY TRANSACTIONS (CONT’D)", 0, $fontstyleName, $nestedListStyle);

            $section->addText("\tThe inter-company balances are unsecured and interest-free, unless stated \totherwise, and are subject to the normal credit terms of the respective parties and \tare repayable on demand."
                    , $fontstyleName, $paragraphStyle);

            $textrun = $section->addTextRun();
            $textrun->addText("\t");
            $textrun->addText(htmlspecialchars("Key management personnel compensation"), array('underline' => 'single'));

            $section->addText("\tDirector’s remuneration", $fontstyleName);

            $section->addListItem("\tNEW OR REVISED ACCOUNTING STANDARDS AND INTERPRETATIONS", 0, $fontstyleName, $nestedListStyle);

            $section->addText("\tCertain new standards, amendments and interpretations to existing standards have \tbeen published and are mandatory for the Company’s accounting periods beginning \ton or after 1 January 2017  or later periods and which the Company has not early \tadopted."
                    , $fontstyleName);

            $section->addText("\tThe management anticipates that the adoption of the new amendments to FRS in the \tfuture periods will not have a material impact on the financial statements of the \tCompany and of the Company in the period of their initial adoption."
                    , $fontstyleName);

            $section->addListItem("\tCOMPARATIVE FIGURES ", 0, $fontstyleName, $nestedListStyle);

            $section->addText("\tThe management anticipates that the adoption of the new amendments to FRS in the \tfuture periods will not have a material impact on the financial statements of the \tCompany and of the Company in the period of their initial adoption."
                    , $fontstyleName, $paragraphStyle);

            $section->addListItem("\tCOMPARATIVE FIGURES ", 0, $fontstyleName, $nestedListStyle);

            $section->addText("\tThe financial statements cover the financial period since incorporation on 1 July 2014 \tto 31 December 2015. This being the first set of financial statements,there are no \tcomparative."
                    , $fontstyleName, $paragraphStyle);

            $section->addText("End of unaudited financial statements", $fontstyleName, $paragraphStyle);

// Start of Appendix
// Appendix 1
            $section = $phpWord->createSection();
            $header = $section->createHeader();
            $header->addText(strtoupper($companyName), $fontStyleBlack, $centerAlignment);
            $header->addText("DETAILED INCOME STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack, $centerAlignment);
            $header->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

            $table = $section->addTable();
            $table->addRow();
            $appendixFirstCell = $cellValue * ($maxColumns - count($years));
            $table->addCell($appendixFirstCell)->addText("", $fontstyleName, $noSpace);
            for ($i = 0; $i < count($formatedDate); $i++) {
                $cell = $table->addCell($cellValue);
                $dateStart = $formatedDate[$i][0];
                $dateEnd = $formatedDate[$i][1];
                if ($i == (count($formatedDate) - 1)) {
                    if (!empty($firstBalanceDate)) {
                        $dateStart = date_create($firstDateArray[2] . "-" . $firstDateArray[1] . "-" . $firstDateArray[0]);
                    }
                }
                $cell->addText(date_format($dateStart, "d.m.Y"), $centerAlignment);
                $cell->addText("to", $fontstyleName, $centerAlignment);
                $cell->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                $cell->addText("$", $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Revenue", $fontstyleName);
            for ($i = 0; $i < count($revenueFinal); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $revenueFinal[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            for ($i = 0; $i < count($cosFinal); $i++) {
                $cosFinal[$i] = 0 - $cosFinal[$i];
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Less: Cost of sales", $fontstyleName, $noSpace);
            for ($i = 0; $i < count($cosFinal); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $cosFinal[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText($grossString, $fontStyleBlack);
            for ($i = 0; $i < count($profitAmount); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $profitAmount[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell);
            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Add: Other income", $fontstyleUnderline, $noSpace);
            $finalTradeGain = array();
            for ($i = 0; $i < count($tradeGain); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($tradeGain[$i]); $x++) {
                    $tempValue += $tradeGain[$i][$x][1];
                }
                array_push($finalTradeGain, $tempValue);
            }

            $finalNonTradeGain = array();
            for ($i = 0; $i < count($nonTradeGain); $i++) {
                $tempValue = 0;
                for ($x = 0; $x < count($nonTradeGain[$i]); $x++) {
                    $tempValue += $nonTradeGain[$i][$x][1];
                }
                array_push($finalNonTradeGain, $tempValue);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Exchange gain - trade", $fontstyleName, $noSpace);
            for ($i = 0; $i < count($finalTradeGain); $i++) {
                if (count($finalTradeGain) > 1) {
                    if ($i == 0) {
                        $cell = $table->addCell($cellValue, $borderTopAndLeft);
                    } else if ($i == count($finalTradeGain) - 1) {
                        $cell = $table->addCell($cellValue, $borderTopAndRight);
                    } else {
                        $cell = $table->addCell($cellValue, $borderTop);
                    }
                } else {
                    $cell = $table->addCell($cellValue, $allBorders);
                }

                $tempValue = $finalTradeGain[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Exchange gain - non-trade", $fontstyleName, $noSpace);
            for ($i = 0; $i < count($finalNonTradeGain); $i++) {
                if (count($finalNonTradeGain) > 1) {
                    if ($i == 0) {
                        $cell = $table->addCell($cellValue, $borderBottomAndLeft);
                    } else if ($i == count($finalNonTradeGain) - 1) {
                        $cell = $table->addCell($cellValue, $borderBottomAndRight);
                    } else {
                        $cell = $table->addCell($cellValue, $cellBottomBorder);
                    }
                } else {
                    $cell = $table->addCell($cellValue, $allBorders);
                }

                $tempValue = $finalNonTradeGain[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell);
            for ($i = 0; $i < count($otherIncome); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $otherIncome[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Less: Expenses");
            $table->addRow();
            $cell = $table->addCell($appendixFirstCell);
            $textRun = $cell->createTextRun();
            $textRun->addText("Administrative expenses ", $fontstyleName, $noSpace);
            $textRun->addText("(Appendix II)", $fontStyleItalic, $noSpace);
            for ($i = 0; $i < count($calculatedAdminExpense); $i++) {
                if (count($calculatedAdminExpense) > 1) {
                    if ($i == 0) {
                        $cell = $table->addCell($cellValue, $borderTopAndLeft);
                    } else if ($i == count($calculatedAdminExpense) - 1) {
                        $cell = $table->addCell($cellValue, $borderTopAndRight);
                    } else {
                        $cell = $table->addCell($cellValue, $borderTop);
                    }
                } else {
                    $cell = $table->addCell($cellValue, $allBorders);
                }

                $tempValue = $calculatedAdminExpense[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = number_format(abs($tempValue));
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $cell = $table->addCell($appendixFirstCell);
            $textRun = $cell->createTextRun();
            $textRun->addText("Distribution and marketing expenses ", $fontstyleName, $noSpace);
            $textRun->addText("(Appendix II)", $fontStyleItalic, $noSpace);
            for ($i = 0; $i < count($calculatedDistriExpense); $i++) {
                if (count($calculatedDistriExpense) > 1) {
                    if ($i == 0) {
                        $cell = $table->addCell($cellValue, $borderLeft);
                    } else if ($i == count($calculatedDistriExpense) - 1) {
                        $cell = $table->addCell($cellValue, $borderRight);
                    } else {
                        $cell = $table->addCell($cellValue);
                    }
                }

                $tempValue = $calculatedDistriExpense[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = number_format(abs($tempValue));
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            for ($j = 0; $j < count($tempExpenseCategory); $j++) {
                $table->addRow();
                $cell = $table->addCell($appendixFirstCell);
                $textRun = $cell->createTextRun();
                $textRun->addText($tempExpenseCategory[$j] . " ", $fontstyleName, $noSpace);
                $textRun->addText("(Appendix II)", $fontStyleItalic, $noSpace);

                for ($i = 0; $i < count($tempExpenseArray[$j]); $i++) {
                    if (count($tempExpenseCategory) > 1) {
                        if ($j == count($tempExpenseCategory) - 1) {
                            if ($i == 0) {
                                $cell = $table->addCell($cellValue, $borderBottomAndLeft);
                            } else if ($i == count($tempExpenseArray[$j]) - 1) {
                                $cell = $table->addCell($cellValue, $borderBottomAndRight);
                            } else {
                                $cell = $table->addCell($cellValue, $cellBottomBorder);
                            }
                        } else {
                            if ($i == 0) {
                                $cell = $table->addCell($cellValue, $borderLeft);
                            } else if ($i == count($tempExpenseArray[$j]) - 1) {
                                $cell = $table->addCell($cellValue, $borderRight);
                            } else {
                                $cell = $table->addCell($cellValue);
                            }
                        }
                    } else {
                        if (count($tempExpenseArray[$j]) > 1) {
                            if ($i == 0) {
                                $cell = $table->addCell($cellValue, $borderBottomAndLeft);
                            } else if ($i == (count($tempExpenseArray[$j]) - 1)) {
                                $cell = $table->addCell($cellValue, $borderBottomAndRight);
                            } else {
                                $cell = $table->addCell($cellValue, $cellBottomBorder);
                            }
                        }
                    }


                    $tempValue = $tempExpenseArray[$j][$i];
                    if ($tempValue == 0) {
                        $tempValue = "-";
                    } else {
                        $tempValue = number_format(abs($tempValue));
                    }
                    $cell->addText($tempValue, $fontstyleName, $centerAlignment);
                }
            }

            $table->addRow();
            $table->addCell($appendixFirstCell);
            for ($i = 0; $i < count($totalExpenses); $i++) {
                $cell = $table->addCell($cellValue, $cellBottomBorder);
                $tempValue = $totalExpenses[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText($beforeTaxString, $fontStyleBlack);
            for ($i = 0; $i < count($beforeIncomeTax); $i++) {
                $cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
                $tempValue = $beforeIncomeTax[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

// Appendix 2
            $section = $phpWord->addSection();

            $table = $section->addTable();
            $table->addRow();
            $appendixFirstCell = $cellValue * ($maxColumns - count($years));
            $table->addCell($appendixFirstCell)->addText("", $fontstyleName, $noSpace);
            for ($i = 0; $i < count($formatedDate); $i++) {
                $cell = $table->addCell($cellValue);
                $dateStart = $formatedDate[$i][0];
                $dateEnd = $formatedDate[$i][1];
                if ($i == (count($formatedDate) - 1)) {
                    if (!empty($firstBalanceDate)) {
                        $dateStart = date_create($firstDateArray[2] . "-" . $firstDateArray[1] . "-" . $firstDateArray[0]);
                    }
                }
                $cell->addText(date_format($dateStart, "d.m.Y"), $centerAlignment);
                $cell->addText("to", $fontstyleName, $centerAlignment);
                $cell->addText(date_format($dateEnd, "d.m.Y"), $fontstyleBottomUnderline);
                $cell->addText("$", $fontstyleName, $centerAlignment);
            }


            $accountQuery = $DB_con->prepare("SELECT * FROM account_category WHERE company_name =:companyName AND client_company = :clientName");
            $accountQuery->bindParam(':companyName', $_SESSION['company']);
            $accountQuery->bindParam(':clientName', $clientName);
            $accountQuery->execute();

            $result = $accountQuery->setFetchMode(PDO::FETCH_ASSOC);
            $result = $accountQuery->fetchAll();


            $finalAdminAccountName = array();
            $finalAdminAccountAmount = array();
            for ($i = 0; $i < count($adminAccount); $i++) {
                for ($x = 0; $x < count($adminAccount[$i]); $x++) {
                    // $finalAdminAccountAmount[$x] = array();
                    $tempValue = 0;
                    $key = false;
                    for ($j = 0; $j < count($finalAdminAccountName); $j++) {
                        $currentAccount = $finalAdminAccountName[$j];
                        if (stripos($currentAccount, $adminAccount[$i][$x][0]) !== false || stripos($adminAccount[$i][$x][0], $currentAccount) !== false) {
                            $key = $j;
                            break;
                        }
                    }
                    if (!is_bool($key)) {
                        if (isset($finalAdminAccountAmount[$key][$i])) {
                            $tempValue = $finalAdminAccountAmount[$key][$i];
                        }
                        $finalAdminAccountAmount[$key][$i] = $tempValue += $adminAccount[$i][$x][1];
                    } else {
                        array_push($finalAdminAccountName, $adminAccount[$i][$x][0]);
                        if (stripos($finalAdminAccountName[$x], $adminAccount[$i][$x][0]) !== false) {
                            $tempValue += $adminAccount[$i][$x][1];
                            $finalAdminAccountAmount[$x][$i] = $tempValue;
                        } else {
                            $finalAdminAccountAmount[count($finalAdminAccountAmount)][$i] = $adminAccount[$i][$x][1];
                        }
                    }
                }
            }

            for ($i = 0; $i < count($finalAdminAccountAmount); $i++) {
                for ($x = 0; $x < count($years); $x++) {
                    if (!isset($finalAdminAccountAmount[$i][$x])) {
                        $finalAdminAccountAmount[$i][$x] = 0;
                    } else {
                        $finalAdminAccountAmount[$i][$x] = round($finalAdminAccountAmount[$i][$x]);
                    }
                }
            }

            $toSkipAdmin = array();
            $toPrintAdmin = array();
            for ($i = 0; $i < count($result); $i++){
              $holder = false;
              for ($x = 0; $x < count($finalAdminAccountName); $x++){
                if (!in_array($x,$toSkipAdmin)){
                  $individualAccountNames = explode(",",$result[$i]['account_names']);
                  if (in_array($finalAdminAccountName[$x], $individualAccountNames)){
                    $finalAdminAccountName[$x] = $result[$i]['account'];
                    array_push($toSkipAdmin,$x);
                    if (strcasecmp(gettype($holder),"boolean") === 0){
                      $holder = $x;
                      array_push($toPrintAdmin, $holder);
                    } else {
                      for ($j = 0; $j < count($finalAdminAccountAmount[$holder]); $j++){
                        $finalAdminAccountAmount[$holder][$j] += $finalAdminAccountAmount[$x][$j];
                      }
                    }

                  }
                }
              }
            }



            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Administrative expenses", $fontstyleBottomUnderline);
            for ($i = 0; $i < count($finalAdminAccountAmount); $i++) {
              if (in_array($i, $toPrintAdmin)){
                $table->addRow();
                $table->addCell($appendixFirstCell)->addText(htmlspecialchars($finalAdminAccountName[$i]), $fontstyleName, $noSpace);
                for ($x = 0; $x < count($finalAdminAccountAmount[$i]); $x++) {
                    if (count($finalAdminAccountName) > 1) {
                        if ($i == count($finalAdminAccountAmount) - 1) {
                            if ($x == count($finalAdminAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderBottomAndRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderBottomAndLeft);
                            } else {
                                $cell = $table->addCell($cellValue, $cellBottomBorder);
                            }
                        } else if ($i == 0) {
                            if ($x == count($finalAdminAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderTopAndRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderTopAndLeft);
                            } else {
                                $cell = $table->addCell($cellValue, $borderTop);
                            }
                        } else {
                            if ($x == count($finalAdminAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderLeft);
                            } else {
                                $cell = $table->addCell($cellValue);
                            }
                        }
                    } else {
                        $cell = $table->addCell($cellValue, $allBorders);
                    }

                    $tempValue = $finalAdminAccountAmount[$i][$x];
                    if ($tempValue == 0) {
                        $tempValue = "-";
                    } else if ($tempValue > 0) {
                        $tempValue = number_format($tempValue);
                    } else {
                        $tempValue = "(" . number_format(abs($tempValue)) . ")";
                    }
                    $cell->addText($tempValue, $fontstyleName, $centerAlignment);
                }
              }
            }

            for ($i = 0; $i < count($calculatedAdminExpense); $i++) {
                $calculatedAdminExpense[$i] = 0 - $calculatedAdminExpense[$i];
            }

            $table->addRow();
            $table->addCell($appendixFirstCell);
            for ($i = 0; $i < count($calculatedAdminExpense); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $calculatedAdminExpense[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $finalDistriAccountName = array();
            $finalDistriAccountAmount = array();
            for ($i = 0; $i < count($distriAccount); $i++) {
                for ($x = 0; $x < count($distriAccount[$i]); $x++) {
                    $tempValue = 0;
                    $key = false;
                    for ($j = 0; $j < count($finalDistriAccountName); $j++) {
                        $currentAccount = $finalDistriAccountName[$j];
                        if (stripos($currentAccount, $distriAccount[$i][$x][0]) !== false || stripos($distriAccount[$i][$x][0], $currentAccount) !== false) {
                            $key = $j;
                            break;
                        }
                    }
                    if (!is_bool($key)) {
                        if (isset($finalDistriAccountAmount[$key][$i])) {
                            $tempValue = $finalDistriAccountAmount[$key][$i];
                        }
                        $finalDistriAccountAmount[$key][$i] = $tempValue += $distriAccount[$i][$x][1];
                    } else {
                        array_push($finalDistriAccountName, $distriAccount[$i][$x][0]);
                        if (stripos($finalDistriAccountName[$x], $distriAccount[$i][$x][0]) !== false) {
                            $tempValue += $distriAccount[$i][$x][1];
                            $finalDistriAccountAmount[$x][$i] = $tempValue;
                        } else {
                            $finalDistriAccountAmount[count($finalDistriAccountAmount)][$i] = $distriAccount[$i][$x][1];
                        }
                    }
                }
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Distribution and marketing expenses", $fontstyleBottomUnderline, $noSpace);

            for ($i = 0; $i < count($finalDistriAccountAmount); $i++) {
                for ($x = 0; $x < count($years); $x++) {
                    if (!isset($finalDistriAccountAmount[$i][$x])) {
                        $finalDistriAccountAmount[$i][$x] = 0;
                    } else {
                        $finalDistriAccountAmount[$i][$x] = round($finalDistriAccountAmount[$i][$x]);
                    }
                }
            }

            $toSkipDistri = array();
            $toPrintDistri = array();
            for ($i = 0; $i < count($result); $i++){
              $holder = false;
              for ($x = 0; $x < count($finalDistriAccountName); $x++){
                if (!in_array($x,$toSkipDistri)){
                  $individualAccountNames = explode(",",$result[$i]['account_names']);
                  if (in_array($finalDistriAccountName[$x], $individualAccountNames)){
                    $finalDistriAccountName[$x] = $result[$i]['account'];
                    array_push($toSkipDistri,$x);
                    if (strcasecmp(gettype($holder),"boolean") === 0){
                      $holder = $x;
                      array_push($toPrintDistri, $holder);
                    } else {
                      for ($j = 0; $j < count($finalDistriAccountAmount[$holder]); $j++){
                        $finalDistriAccountAmount[$holder][$j] += $finalDistriAccountAmount[$x][$j];
                      }
                    }

                  }
                }
              }
            }

            for ($i = 0; $i < count($finalDistriAccountAmount); $i++) {
                if (in_array($i,$toPrintDistri)){
                $table->addRow();
                $table->addCell($appendixFirstCell)->addText(htmlspecialchars($finalDistriAccountName[$i]), $fontstyleName, $noSpace);
                for ($x = 0; $x < count($finalDistriAccountAmount[$i]); $x++) {
                    if (count($finalDistriAccountName) > 1) {
                        if ($i == count($finalDistriAccountAmount) - 1) {
                            if ($x == count($finalDistriAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderBottomAndRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderBottomAndLeft);
                            } else {
                                $cell = $table->addCell($cellValue, $cellBottomBorder);
                            }
                        } else if ($i == 0) {
                            if ($x == count($finalDistriAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderTopAndRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderTopAndLeft);
                            } else {
                                $cell = $table->addCell($cellValue, $borderTop);
                            }
                        } else {
                            if ($x == count($finalDistriAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderLeft);
                            } else {
                                $cell = $table->addCell($cellValue);
                            }
                        }
                    } else {
                        $cell = $table->addCell($cellValue, $allBorders);
                    }

                    $tempValue = $finalDistriAccountAmount[$i][$x];
                    if ($tempValue == 0) {
                        $tempValue = "-";
                    } else if ($tempValue > 0) {
                        $tempValue = number_format($tempValue);
                    } else {
                        $tempValue = "(" . number_format(abs($tempValue)) . ")";
                    }
                    $cell->addText($tempValue, $fontstyleName, $centerAlignment);
                }
              }
            }


            for ($i = 0; $i < count($calculatedDistriExpense); $i++) {
                $calculatedDistriExpense[$i] = 0 - $calculatedDistriExpense[$i];
            }

            $table->addRow();
            $table->addCell($appendixFirstCell);
            for ($i = 0; $i < count($calculatedDistriExpense); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $calculatedDistriExpense[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell)->addText("Finance expenses", $fontstyleBottomUnderline, $noSpace);
            $finalFinanceAccountName = array();
            $finalFinanceAccountAmount = array();
            for ($i = 0; $i < count($financeExpenseArray); $i++) {
                for ($x = 0; $x < count($financeExpenseArray[$i]); $x++) {
                    $tempValue = 0;
                    $key = false;
                    for ($j = 0; $j < count($finalFinanceAccountName); $j++) {
                        $currentAccount = $finalFinanceAccountName[$j];
                        if (stripos($currentAccount, $financeExpenseArray[$i][$x][0]) !== false || stripos($financeExpenseArray[$i][$x][0], $currentAccount) !== false) {
                            $key = $j;
                            break;
                        }
                    }
                    if (!is_bool($key)) {
                        if (isset($finalFinanceAccountAmount[$key][$i])) {
                            $tempValue = $finalFinanceAccountAmount[$key][$i];
                        }
                        $finalFinanceAccountAmount[$key][$i] = $tempValue += $financeExpenseArray[$i][$x][1];
                    } else {
                        array_push($finalFinanceAccountName, $financeExpenseArray[$i][$x][0]);
                        if (stripos($finalFinanceAccountName[$x], $financeExpenseArray[$i][$x][0]) !== false) {
                            $tempValue += $financeExpenseArray[$i][$x][1];
                            $finalFinanceAccountAmount[$x][$i] = $tempValue;
                        } else {
                            $finalFinanceAccountAmount[count($finalFinanceAccountAmount)][$i] = $financeExpenseArray[$i][$x][1];
                        }
                    }
                }
            }

            for ($i = 0; $i < count($finalFinanceAccountAmount); $i++) {
                for ($x = 0; $x < count($years); $x++) {
                    if (!isset($finalFinanceAccountAmount[$i][$x])) {
                        $finalFinanceAccountAmount[$i][$x] = 0;
                    } else {
                        $finalFinanceAccountAmount[$i][$x] = round($finalFinanceAccountAmount[$i][$x]);
                    }
                }
            }

            $toSkipFinance = array();
            $toPrintFinance = array();
            for ($i = 0; $i < count($result); $i++){
              $holder = false;
              for ($x = 0; $x < count($finalFinanceAccountName); $x++){
                if (!in_array($x,$toSkipFinance)){
                  $individualAccountNames = explode(",",$result[$i]['account_names']);
                  if (in_array($finalFinanceAccountName[$x], $individualAccountNames)){
                    $finalFinanceAccountName[$x] = $result[$i]['account'];
                    array_push($toSkipFinance,$x);
                    if (strcasecmp(gettype($holder),"boolean") === 0){
                      $holder = $x;
                      array_push($toPrintFinance, $holder);
                    } else {
                      for ($j = 0; $j < count($finalFinanceAccountAmount[$holder]); $j++){
                        $finalFinanceAccountAmount[$holder][$j] += $finalFinanceAccountAmount[$x][$j];
                      }
                    }

                  }
                }
              }
            }

            for ($i = 0; $i < count($finalFinanceAccountAmount); $i++) {
              if (in_array($i,$toPrintFinance)){
                $table->addRow();
                $table->addCell($appendixFirstCell)->addText(htmlspecialchars($finalFinanceAccountName[$i]), $fontstyleName, $noSpace);
                for ($x = 0; $x < count($finalFinanceAccountAmount[$i]); $x++) {
                    if (count($finalFinanceAccountName) > 1) {
                        if ($i == count($finalFinanceAccountAmount) - 1) {
                            if ($x == count($finalFinanceAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderBottomAndRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderBottomAndLeft);
                            } else {
                                $cell = $table->addCell($cellValue, $cellBottomBorder);
                            }
                        } else if ($i == 0) {
                            if ($x == count($finalFinanceAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderTopAndRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderTopAndLeft);
                            } else {
                                $cell = $table->addCell($cellValue, $borderTop);
                            }
                        } else {
                            if ($x == count($finalFinanceAccountAmount[$i]) - 1) {
                                $cell = $table->addCell($cellValue, $borderRight);
                            } else if ($x == 0) {
                                $cell = $table->addCell($cellValue, $borderLeft);
                            } else {
                                $cell = $table->addCell($cellValue);
                            }
                        }
                    } else {
                        $cell = $table->addCell($cellValue, $allBorders);
                    }

                    $tempValue = $finalFinanceAccountAmount[$i][$x];
                    if ($tempValue == 0) {
                        $tempValue = "-";
                    } else if ($tempValue > 0) {
                        $tempValue = number_format($tempValue);
                    } else {
                        $tempValue = "(" . number_format(abs($tempValue)) . ")";
                    }
                    $cell->addText($tempValue, $fontstyleName, $centerAlignment);
                }
              }
            }

            $finalFinanceExpense = array();
            for ($i = 0; $i < count($totalExpenses); $i++) {
                $tempValue = $totalExpenses[$i];
                $tempValue += $calculatedAdminExpense[$i];
                $tempValue += $calculatedDistriExpense[$i];
                array_push($finalFinanceExpense, $tempValue);
            }

            $table->addRow();
            $table->addCell($appendixFirstCell);
            for ($i = 0; $i < count($finalFinanceExpense); $i++) {
                $cell = $table->addCell($cellValue);
                $tempValue = $finalFinanceExpense[$i];
                if ($tempValue == 0) {
                    $tempValue = "-";
                } else if ($tempValue > 0) {
                    $tempValue = number_format($tempValue);
                } else {
                    $tempValue = "(" . number_format(abs($tempValue)) . ")";
                }
                $cell->addText($tempValue, $fontstyleName, $centerAlignment);
            }

//include 'footer.php';
// Saving the document as OOXML file
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save('preview.docx');

header("Location: " . URL . "download.php"); /* Redirect browser */
ob_end_flush();
        }
    }
} else {
    header("Location: ../user_login/login.php");
}
?>
