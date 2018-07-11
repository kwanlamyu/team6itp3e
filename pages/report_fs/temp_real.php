<?php
//include 'header.php';
// PHPWord depedency
require_once __DIR__ . '\..\..\vendor\autoload.php';
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
    )
        )
);

$nestedListStyle = 'nestedlevel';
$phpWord->addNumberingStyle(
        $nestedListStyle, array(
    'type' => 'multilevel',
    'levels' => array(
        array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
        array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2)
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

//Create Paragraph style
$paragraphStyle = 'justifiedParagraph';
$phpWord->addParagraphStyle($paragraphStyle, array('align' => 'both', 'spaceAfter' => 100));
$section = $phpWord->addSection();

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
$noOfDirectors = $_POST["noOfDirectors"];
// This should be an array since there can be multiple directors
$directorName1 = $_POST["directorName1"];
$directorName1ApptDate = $_POST["directorName1ApptDate"];
$director1Share = $_POST['director1Share'];
$todayDate = $_POST["todayDate"];
$firstBalanceDate = $_POST["firstBalanceDate"];
$secondBalanceDate = $_POST["secondBalanceDate"];
$thirdBalanceDate = $_POST["thirdBalanceDate"];
$companyPA = $_POST["companyPA"];
$companyAddress = $_POST["companyAddress"];
$frsDate = $_POST['frsDate'];
$currency = $_POST['currency'];

echo $companyName . "<br/>";

// =============================================================================
// PHOEBE
// =============================================================================
// change from string to array
$yearsArray = implode(" ", $yearsString);
// split the string by "," to get the years
$years = explode(",", $yearsArray);

$getHiddenData = $_POST['passData'];

//echo "<b>Original Data: </b>" . $getHiddenData . "<hr>";
// Convert String to array, then delete away the "*"
$categoryDataArray = explode("*", $getHiddenData);

// Deleting first array item
$removedFirstItem = array_shift($categoryDataArray);

$fullArray = array();
$innerArray = array();
$tempArray = array();
$yearArray = array();

for ($i = 0; $i < count($categoryDataArray); $i++) {
    // Removed unwanted ","
    $categoryDataArray[$i] = trim($categoryDataArray[$i], ",");

    // Split string into array
    $individualNote = explode(",", $categoryDataArray[$i]);

    // Display Category
//    echo "<b>Category: </b>" . $individualNote[0] . "<br><br>";
//    echo "<b>Total number of items in array: </b>" . count($individualNote) . "<br><br>";\
    // Display the accounts
    for ($j = 1; $j < count($individualNote); $j++) {

        $getFirstCharacter = substr($individualNote[$j], 1, 1);
        $withoutFirstCharacter = substr($individualNote[$j], 2);

        // Split the value by '#'
        // $accountValueArray[0] = account
        // $accountValueArray[1] = value
        $accountValueArray = explode("#", $withoutFirstCharacter);

        // check if $innerArray is empty
        if (count($innerArray) == 0) {

            for ($y = 0; $y < $numberOfSheets; $y++) {
                if ($getFirstCharacter == $y) {
                    $yearArray[$years[$y]] = $accountValueArray[1];
                }
            }

            array_push($tempArray, $accountValueArray[1]);
            $innerArray[$accountValueArray[0]] = $yearArray;
            $fullArray[$individualNote[0]] = $innerArray;

            unset($tempArray);
            $tempArray = array();
        } else {

            // check with the fullArray to see if the value is inside, if inside, add, not inside add one more entry
            foreach (array_keys($innerArray) as $inner) {

                // account string inside the array already -> need to append more value inside only
                if (strpos($inner, $accountValueArray[0]) !== false) {

                    for ($u = 0; $u < $numberOfSheets; $u++) {
                        if ($getFirstCharacter == $u) {
                            $yearArray[$years[$u]] = $accountValueArray[1];
                        }
                    }

                    // add on the value, do something here
                    array_push($tempArray, $accountValueArray[1]);
                    $innerArray[$accountValueArray[0]] = $yearArray;
                    $fullArray[$individualNote[0]] = $innerArray;
                } else {

                    for ($e = 0; $e < $numberOfSheets; $e++) {
                        if ($getFirstCharacter == $e) {
                            if (gettype($accountValueArray[1] == "String")) {
                                $tempArray[$years[$e]] = (float) $accountValueArray[1];
                            }
                        }
                    }

                    // create a new entry
                    $innerArray[$accountValueArray[0]] = $tempArray;
                    $fullArray[$individualNote[0]] = $innerArray;
                }

                unset($tempArray);
                $tempArray = array();
            }
        }
    }

    unset($yearArray);
    $yearArray = array();
    unset($innerArray);
    $innerArray = array();
}

$accountArray = array();
$valueArray = array();
$categoryArray = array();

for ($aa = 0; $aa < $numberOfSheets; $aa++) {
    // Seperate the data into different category
    for ($ab = 0; $ab < count($data[$aa]); $ab++) {
        array_push($categoryArray, $data[$aa][$ab][2]);
        array_push($accountArray, $aa . $data[$aa][$ab][0]);
        array_push($valueArray, $data[$aa][$ab][1]);
    }
}

$incomeTaxPayable = array();
for ($i = 0; $i < count($accountArray); $i++) {
    if (stripos($accountArray[$i], "Income tax payable") !== false) {
        // ceil is to round up value
        array_push($incomeTaxPayable, ceil($valueArray[$i]));
    }
}

$incomeTaxExpenses = array();
for ($i = 0; $i < count($accountArray); $i++) {
    if (stripos($accountArray[$i], "Income tax expense") !== false) {
        // ceil is to round up value
        array_push($incomeTaxExpenses, ceil($valueArray[$i]));
    }
}

$borrowings = array();
for ($i = 0; $i < count($accountArray); $i++) {
    if (stripos($accountArray[$i], "Borrowing") !== false) {
        // round is to round down value
        array_push($borrowings, round($valueArray[$i]));
    }
}

$shareCapital = array();
// 0 = 2016 , 1 = 2015 , 2 = 2014 , etc ...
for ($aa = 0; $aa < $numberOfSheets; $aa++) {
    for ($ab = 0; $ab < count($data[$aa]); $ab++) {
        if (strcasecmp($data[$aa][$ab][2], "Share Capital") == 0) {
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
        if (strcasecmp($data[$aa][$ab][2], "Plant and Equipment") == 0) {
            // ---- Cost----
            if (strcasecmp($data[$aa][$ab][0], "Office Equipment at Cost") == 0) {
                $tempOfficeEquipment[$aa] = $data[$aa][$ab][1];
            }

            if (strcasecmp($data[$aa][$ab][0], "Computer & servers - cost") == 0) {
                $tempComputer[$aa] = $data[$aa][$ab][1];
            }

            if (strcasecmp($data[$aa][$ab][0], "Softwares at Cost") == 0) {
                $tempSoftware[$aa] = $data[$aa][$ab][1];
            }

            // ---- Accumulated depreciation ----
            if (strcasecmp($data[$aa][$ab][0], "Office Equipment Accum Dep") == 0) {
                $depOfficeEquipment[$aa] = $data[$aa][$ab][1];
            }

            if (strcasecmp($data[$aa][$ab][0], "Softwares Accum Dep") == 0) {
                $depSoftware[$aa] = $data[$aa][$ab][1];
            }

            if (strcasecmp($data[$aa][$ab][0], "Computer and servers - acc dep") == 0) {
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

    if ($key === "Profit Before Income Tax") {
        $profitBeforeIncomeTaxArray = $value;
    }

    if ($key === "Trade and other receivables") {
        $tradeReceivablesArray = $value;
    }

    if ($key === "Income Taxes") {
        $incomeTaxArray = $value;

        $incomeTax = array();

        $string = "no";
        for ($i = 0; $i < count($incomeTaxArray); $i++) {
            // "income tax paid" exist in income tax array
            if (stripos(array_keys($incomeTaxArray)[$i], 'income tax paid') !== false) {
                $string = "exist";
            }
        }

        if ($string == "no") {
            array_push($incomeTax, 0);
            $incomeTaxArray["Income tax paid"] = $incomeTax;
        }
    }

    if ($key === "Trade and other payables") {
        $tradePayableArray = $value;
    }

    
    
    if ($key === "Borrowings") {
        print_r($borrowingArray);
        $borrowingArray = $value;

        $proceeds = array();
        $repayment = array();
        $current = array();
        $nonCurrent = array();

        $string1 = "no";
        $string2 = "no";
        $string3 = "no";
        $string4 = "no";

        for ($i = 0; $i < count($borrowingArray); $i++) {
            if (stripos(array_keys($borrowingArray)[$i], 'proceeds from borrowing') !== false) {
                $string1 = "proceedExist";
            }

            if (stripos(array_keys($borrowingArray)[$i], 'repayment of borrowings') !== false) {
                $string2 = "repaymentExist";
            }

            if (stripos(array_keys($borrowingArray)[$i], 'current') !== false) {
                $string3 = "currentExist";
            }

            if (stripos(array_keys($borrowingArray)[$i], 'non current') !== false) {
                $string4 = "nonCurrentExist";
            }
        }

        if ($string1 == "no") {
            array_push($proceeds, 0);
            $borrowingArray["Proceeds from borrowings"] = $proceeds;
        }

        if ($string2 == "no") {
            array_push($repayment, 0);
            $borrowingArray["Repayment of borrowings"] = $repayment;
        }
        if ($string3 == "no") {
            array_push($current, 0);
            $borrowingArray["Current"] = $current;
        }
        if ($string4 == "no") {
            array_push($nonCurrent, 0);
            $borrowingArray["Non-current"] = $nonCurrent;
        }
        echo "<hr>";
        print_r($borrowingArray);
    }
    
    

    if ($key === "Share Capital") {
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
    array_push($displayedCategory, "Profit before income tax");
}

if (!empty($incomeTaxArray)) {
    array_push($displayedCategory, "Income Taxes");
}

if (!empty($tradeReceivablesArray)) {
    array_push($displayedCategory, "Trade and other receivables");
}

if (!empty($tradePayableArray)) {
    array_push($displayedCategory, "Trade and other payables");
}

if (!empty($borrowingArray)) {
    array_push($displayedCategory, "Borrowings");
}

if (in_array("Share Capital", $categoryArray)) {
    array_push($displayedCategory, "Share Capital");
}

if (in_array("Plant and Equipment", $categoryArray)) {
    array_push($displayedCategory, "Plant and Equipment");
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

// Phoebe Calculation
if (in_array("Plant and Equipment", $categoryArray)) {

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
}

// =============================================================================
// KOKHOE
// =============================================================================
// open txt file that contains all known administrative expenses category
$assetsArray = fopen("classification/Assets.txt", "r") or die("Unable to open file!");
$assetsString = "";
while (!feof($assetsArray)) {
    $assetsString .= fgetc($assetsArray);
}
fclose($assetsArray);
$assetsArray = explode(",", $assetsString);
for ($i = 0; $i < count($assetsArray); $i++) {
    $assetsArray[$i] = trim($assetsArray[$i]);
}

// open txt file that contains all known capital category
$capitalArray = fopen("classification/Capital.txt", "r") or die("Unable to open file!");
$capitalString = "";
while (!feof($capitalArray)) {
    $capitalString .= fgetc($capitalArray);
}
fclose($capitalArray);
$capitalArray = explode(",", $capitalString);
for ($i = 0; $i < count($capitalArray); $i++) {
    $capitalArray[$i] = trim($capitalArray[$i]);
}

// open txt file that contains all known liabilities category
$liabilitiesArray = fopen("classification/Current Liabilities.txt", "r") or die("Unable to open file!");
$liabilitiesString = "";
while (!feof($liabilitiesArray)) {
    $liabilitiesString .= fgetc($liabilitiesArray);
}
fclose($liabilitiesArray);
$liabilitiesArray = explode(",", $liabilitiesString);
for ($i = 0; $i < count($liabilitiesArray); $i++) {
    $liabilitiesArray[$i] = trim($liabilitiesArray[$i]);
}

// open txt file that contains all known non-current liabilities category
$nonCurrentLiabilitiesArray = fopen("classification/Non-current Liabilities.txt", "r") or die("Unable to open file!");
$nonCurrentLiabilitiesString = "";
while (!feof($nonCurrentLiabilitiesArray)) {
    $nonCurrentLiabilitiesString .= fgetc($nonCurrentLiabilitiesArray);
}
fclose($nonCurrentLiabilitiesArray);
$nonCurrentLiabilitiesArray = explode(",", $nonCurrentLiabilitiesString);
for ($i = 0; $i < count($nonCurrentLiabilitiesArray); $i++) {
    $nonCurrentLiabilitiesArray[$i] = trim($nonCurrentLiabilitiesArray[$i]);
}

// open txt file that contains all known liabilities that have current and non-current category
$bothLiabilitiesArray = fopen("classification/Both Liabilities.txt", "r") or die("Unable to open file!");
$bothLiabilitiesString = "";
while (!feof($bothLiabilitiesArray)) {
    $bothLiabilitiesString .= fgetc($bothLiabilitiesArray);
}
fclose($bothLiabilitiesArray);
$bothLiabilitiesArray = explode(",", $bothLiabilitiesString);
for ($i = 0; $i < count($bothLiabilitiesArray); $i++) {
    $bothLiabilitiesArray[$i] = trim($bothLiabilitiesArray[$i]);
}

// open txt file that contains all known current assets category
$currentAssetsArray = fopen("classification/Current Assets.txt", "r") or die("Unable to open file!");
$currentAssetsString = "";
while (!feof($currentAssetsArray)) {
    $currentAssetsString .= fgetc($currentAssetsArray);
}
fclose($currentAssetsArray);
$currentAssetsArray = explode(",", $currentAssetsString);
for ($i = 0; $i < count($currentAssetsArray); $i++) {
    $currentAssetsArray[$i] = trim($currentAssetsArray[$i]);
}

// open txt file that contains all known liabilities category
$tradeLiabilitiesArray = fopen("classification/Trade and other payables.txt", "r") or die("Unable to open file!");
$tradeLiabilitiesString = "";
while (!feof($tradeLiabilitiesArray)) {
    $tradeLiabilitiesString .= fgetc($tradeLiabilitiesArray);
}
fclose($tradeLiabilitiesArray);
$tradeLiabilitiesArray = explode(",", $tradeLiabilitiesString);
for ($i = 0; $i < count($tradeLiabilitiesArray); $i++) {
    $tradeLiabilitiesArray[$i] = trim($tradeLiabilitiesArray[$i]);
}

// open txt file that contains all known administrative expenses category
$incomeArray = fopen("classification/Income.txt", "r") or die("Unable to open file!");
$incomeString = "";
while (!feof($incomeArray)) {
    $incomeString .= fgetc($incomeArray);
}
fclose($incomeArray);
$incomeArray = explode(",", $incomeString);
for ($i = 0; $i < count($incomeArray); $i++) {
    $incomeArray[$i] = trim($incomeArray[$i]);
}

// open txt file that contains all known administrative expenses category
$expensesArray = fopen("classification/Expenses.txt", "r") or die("Unable to open file!");
$expensesString = "";
while (!feof($expensesArray)) {
    $expensesString .= fgetc($expensesArray);
}
fclose($expensesArray);
$expensesArray = explode(",", $expensesString);
for ($i = 0; $i < count($expensesArray); $i++) {
    $expensesArray[$i] = trim($expensesArray[$i]);
}

// open txt file that contains all known adjustments account
$adjustmentsArray = fopen("classification/Adjustments.txt", "r") or die("Unable to open file!");
$adjustmentsString = "";
while (!feof($adjustmentsArray)) {
    $adjustmentsString .= fgetc($adjustmentsArray);
}
fclose($adjustmentsArray);
$adjustmentsArray = explode(",", $adjustmentsString);
for ($i = 0; $i < count($adjustmentsArray); $i++) {
    $adjustmentsArray[$i] = trim($adjustmentsArray[$i]);
}

// open txt file that contains all known trade gain
$tradeGainArray = fopen("classification/Exchange Gain - Trade.txt", "r") or die("Unable to open file!");
$tradeGainString = "";
while (!feof($tradeGainArray)) {
    $tradeGainString .= fgetc($tradeGainArray);
}
fclose($tradeGainArray);
$tradeGainArray = explode(",", $tradeGainString);
for ($i = 0; $i < count($tradeGainArray); $i++) {
    $tradeGainArray[$i] = trim($tradeGainArray[$i]);
}

// open txt file that contains all known non-trade gain
$nonTradeGainArray = fopen("classification/Exchange Gain - Non Trade.txt", "r") or die("Unable to open file!");
$nonTradeGainString = "";
while (!feof($nonTradeGainArray)) {
    $nonTradeGainString .= fgetc($nonTradeGainArray);
}
fclose($nonTradeGainArray);
$nonTradeGainArray = explode(",", $nonTradeGainString);
for ($i = 0; $i < count($nonTradeGainArray); $i++) {
    $nonTradeGainArray[$i] = trim($nonTradeGainArray[$i]);
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
$defaultNoteNumber = 4;
// P&L
echo "<hr/>";
$tempIncomeCategories = array();
for ($i = 0; $i < count($incomeAmount); $i++) {
    for ($x = 0; $x < count($incomeAmount[$i]); $x++) {
        if (!in_array($incomeAmount[$i][$x][0], $tempIncomeCategories)) {
            array_push($tempIncomeCategories, $incomeAmount[$i][$x][0]);
        }
    }
}
$monthIdentifier = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
$revenueFinal = array();

$formatedDate = array();
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
    $dateStart = date_create("$currentYear-1-1");
    $dateEnd = date_create("$currentYear-$numberedMonth-$numberOfDaysInMonth");
    $dateArray = array();
    array_push($dateArray, $dateStart);
    array_push($dateArray, $dateEnd);
    array_push($formatedDate, $dateArray);
}

$firstDateArray = explode("-", $firstBalanceDate);
$firstDateMonth = $firstDateArray[1];
$firstDateString = $firstDateArray[2] . " " . $monthIdentifier[$firstDateMonth - 1] . " " . $firstDateArray[0];

$yearEndArray = explode("-", $yearEnd);
$yearEndMonth = $yearEndArray[1];
$yearEndString = $yearEndArray[2] . " " . $monthIdentifier[$yearEndMonth - 1] . " " . $yearEndArray[0];

$section->addText(strtoupper($companyName), $fontStyleBlack);
$section->addText("STATEMENT OF COMPREHENSIVE INCOME<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack);
$section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

// create P&L Table
$table = $section->addTable();
// top row which only shows date
$table->addRow();
// check number of unused columns.
// max columns - number of years + 1 column for Notes
// merge the number of unused columns for the first cell.
for ($i = 0; $i < ($maxColumns - ($numberOfSheets + 1)); $i++) {
    $firstCellValue += $cellValue;
}
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
    $tempValue += $incomeTaxValues[$i];
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
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
$section->addText("STATEMENT OF FINANCIAL POSITION<w:br/>AS AT " . strtoupper($yearEndString), $fontStyleBlack);
$section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
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
for ($x = 0; $x < 2; $x++) {
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
    $totalValue += $nonCurrentCalculated[$x][1];
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
for ($i = 0; $i < count($totalLiabilities); $i++){
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
// Equity statement
$table->addRow();
$table->addCell($firstCellValue)->addText("Total Equity", $fontStyleBlack);
$table->addCell($cellValue);

for ($i = 0; $i < count($capitalAmount); $i++) {
    $tempValue = 0;
    for ($x = 0; $x < count($capitalAmount); $x++) {
        $tempValue += $capitalAmount[$i][$x][1];
    }
    $tempValue = round($tempValue);
    $cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
    if ($tempValue == 0) {
        $cell->addText("-", $fontstyleName, $centerAlignment);
    } else {
        $cell->addText(number_format($tempValue), $fontstyleName, $centerAlignment);
    }
}

$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
$section->addText("STATEMENT OF CHANGES IN EQUITY<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack);
$section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
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
    $cell->addText("Balance as at " . $years[$i]);
}
$cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
$cell->addText(number_format($shareCapitalFromTB[0]), $fontstyleName, $centerAlignment);
$cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
$cell->addText(number_format(round($calculatedRetainedProfits[0])), $fontstyleName, $centerAlignment);
$cell = $table->addCell($cellValue, array('borderBottomSize' => 18, 'borderBottomColor' => '#000000'));
$cell->addText(number_format(round($shareCapitalFromTB[0] + $calculatedRetainedProfits[0])), $fontstyleName, $centerAlignment);

// Cash flow statements
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
$section->addText("STATEMENT OF CASH FLOWS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack);
$section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
$cashFlowFirstCell = $firstCellValue + $cellValue;
$table = $section->addTable();
$table->addRow();
$table->addCell($cashFlowFirstCell);
for ($i = 0; $i < count($formatedDate); $i++) {
    $cell = $table->addCell($cellValue);
    $dateStart = $formatedDate[$i][0];
    $dateEnd = $formatedDate[$i][1];
    if ($i == (count($formatedDate) - 1)) {
        if (isset($firstBalanceDate)) {
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
  if (stripos($key, "current") !== false){
    continue;
  } else {
    $table->addRow();
    $table->addCell($cashFlowFirstCell)->addText($key, $fontstyleName, $noSpace);
    for ($i = 0; $i < count($years); $i++){
      $cell = $table->addCell($cellValue);
      $tempValue = 0;
      if (isset($borrowingArray[$key][$years[$i]])){
        $tempValue += $borrowingArray[$key][$years[$i]];
      }
      if ($tempValue == 0){
        $tempValue = "-";
      } else if ($tempValue > 0){
        $tempValue = number_format($tempValue);
      } else {
        $tempValue = "(" . number_format(abs($tempValue)) . ")";
      }
      $cell->addText($tempValue,$fontstyleName,$centerAlignment);
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
    foreach ($borrowingArray as $key => $value){
      if (stripos($key, "current") !== false){
        continue;
      } else {
        if (isset($borrowingArray[$key][$years[$i]])){
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
    $tempValue += $netCashInvestment[$i];
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

$table->addRow();
$table->addCell($cashFlowFirstCell)->addText("Cash and cash equivalents at end of financial year/period", $fontStyleBlack, $noSpace);
for ($i = 0; $i < count($bankArray); $i++) {
    $cell = $table->addCell($cellValue, $cellBottomBorder);
    $tempValue = $bankArray[$i];
    if ($tempValue > 0) {
        $tempValue = number_format($tempValue);
    } else if ($tempValue == 0) {
        $tempValue = "-";
    } else {
        $tempValue = "(" . number_format(abs($tempValue)) . ")";
    }
    $cell->addText($tempValue, $fontstyleName, $centerAlignment);
}

// End of 4 STATEMENTS
// Start of Appendix
// Appendix 1

$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack, $centerAlignment);
$section->addText("DETAILED INCOME STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack, $centerAlignment);
$section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
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

$borderTopAndLeft = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000');
$borderTopAndRight = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000');
$borderTop = array('borderTopSize' => 1, 'borderTopColor' => '#000000');
$borderLeft = array('borderLeftSize' => 1, 'borderLeftColor' => '#000000');
$borderRight = array('borderRightSize' => 1, 'borderRightColor' => '#000000');
$borderBottomAndLeft = array('borderBottomSize' => 1, 'borderBottomColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000');
$borderBottomAndRight = array('borderBottomSize' => 1, 'borderBottomColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000');
$allBorders = array('borderTopSize' => 1, 'borderTopColor' => '#000000', 'borderLeftSize' => 1, 'borderLeftColor' => '#000000', 'borderRightSize' => 1, 'borderRightColor' => '#000000', 'borderBottomSize' => 1, 'borderBottomColor' => '#000000');

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
            if (count($tempExpenseArray[$j]) > 1){
              if ($i == 0){
                $cell = $table->addCell($cellValue,$borderBottomAndLeft);
              } else if ($i == (count($tempExpenseArray[$j]) - 1)){
                $cell = $table->addCell($cellValue,$borderBottomAndRight);
              } else {
                $cell = $table->addCell($cellValue,$cellBottomBorder);
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
$section->addText(strtoupper($companyName), $fontStyleBlack, $centerAlignment);
$section->addText("DETAILED INCOME STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack, $centerAlignment);
$section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
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

$table->addRow();
$table->addCell($appendixFirstCell)->addText("Administrative expenses", $fontstyleBottomUnderline);
for ($i = 0; $i < count($finalAdminAccountAmount); $i++) {
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

for ($i = 0; $i < count($finalDistriAccountAmount); $i++) {
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

for ($i = 0; $i < count($finalFinanceAccountAmount); $i++) {
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

$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
$section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper($yearEndString), $fontStyleBlack);
$section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);

// create notes table
$table1 = $section->addTable();
// top row which only shows date
$table1->addRow();

// check number of unused columns.
// max columns - number of years + 1 column for Notes
// merge the number of unused columns for the first cell.
for ($i = 0; $i < ($maxColumnsNotes - ($numberOfSheets + 1)); $i++) {
    $firstCellValueNotes += $cellValueNotes;
}

// Displaying the heading 
$table1->addCell($firstCellValueNotes);
$cellNotes = $table1->addCell($cellValueNotes);

// Display normally
foreach ($fullArray as $key1 => $value1) { // [ Bank Balances] => Array of values
    if ($key1 !== "Profit Before Income Tax") {
        if ($key1 !== "Trade and other receivables") {
            if ($key1 !== "Share Capital") {
                if ($key1 !== "Income Taxes") {
                    if ($key1 !== "Trade and other payables") {
                        if ($key1 !== "Borrowings") {
                            // Display the category heading
                            $table1->addRow();
                            $table1->addCell($firstCellValueNotes)->addText(strtoupper($key1));

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
                                $table1->addCell($firstCellValueNotes)->addText(ucwords($key2));

                                print_r($value2);

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
    $table1->addRow();
    $table1->addCell($firstCellValue)->addText("PROFIT BEFORE INCOME TAX");

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


    foreach ($profitBeforeIncomeTaxArray as $key1 => $value1) { //  [Depreciation of plant and equipment] => Array ( [December 2016] => 3014 )
        // Display the category heading - ucwords($key2)
        $table1->addRow();
        $table1->addCell($firstCellValue)->addText($key1);

        count($profitBeforeIncomeTaxArray);

        foreach ($value1 as $key2 => $value2) { // [December 2016] => 3014
            // if don't need dash, just print everything out
            if ($numberOfSheets == count($value1)) {
                $cellNotes = $table1->addCell($cellValue);
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
                    $cellNotes = $table1->addCell($cellValue);
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

    $taxExpenseKey = ['Current income tax expenses', 'Current year tax expense'];
    $provisionKey = ['Under provision in prior year'];

    // Display the category heading
    $table1->addRow();
    $table1->addCell($firstCellValue)->addText("INCOME TAXES");
    $table1->addRow();
    $table1->addCell($firstCellValue)->addText("(a) Income tax expense");

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
                        }
                        // if not the same, then see which position it is
                        else {
                            for ($h = 0; $h < count($years); $h++) {
                                $cellNotes = $table1->addCell($cellValue);
                                if ($key == $taxExpenseKey[$i]) {
                                    if ($k == $years[$h]) {
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
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
            $table1->addCell($firstCellValue)->addText($provisionKey[$i]);

            foreach ($incomeTaxArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
                if ($provisionKey[$i] === $key) {
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
                                if ($key == $provisionKey[$i]) {
                                    if ($k == $years[$h]) {
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
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

    for ($i = 0; $i < count($incomeTaxExpenses); $i++) {
        $cellNotes = $table1->addCell($cellValue, $topAndBottom);
        if ($incomeTaxExpenses[$i] < 0) {
            $cellNotes->addText("(" . number_format(abs($incomeTaxExpenses[$i])) . ")", $fontstyleName, $centerAlignment);
        } else {
            $cellNotes->addText(number_format($incomeTaxExpenses[$i]), $fontstyleName, $centerAlignment);
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

    print_r($incomeTaxArray);

    foreach ($incomeTaxArray as $key => $value) {
        if ($key != "Current income tax expenses") {
            if ($key != "Under provision in prior year") {
                if ($key != "Income tax paid") {
                    if ($key != "Current year tax expense") {
                        $table1->addRow();
                        $table1->addCell($firstCellValue)->addText("- " . trim($key));

                        foreach ($value as $k => $v) {
                            // if don't need dash, just print everything out
                            if ($numberOfSheets == count($value)) {
                                $cellNotes = $table1->addCell($cellValue);
                                $cellNotes->addText(ceil($v), $fontstyleName, $centerAlignment);
                                echo ceil($v) . " ";
                            }
                            // if not the same, then see which position it is
                            else {
                                for ($h = 0; $h < count($years); $h++) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    if ($k == $years[$h]) {
                                        $cellNotes->addText("(" . number_format(ceil($v)) . ")", $fontstyleName, $centerAlignment);
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

    for ($i = 0; $i < count($incomeTaxExpenses); $i++) {
        $cellNotes = $table1->addCell($cellValue, $topAndBottom);
        if ($incomeTaxExpenses[$i] < 0) {
            $cellNotes->addText("(" . number_format(abs($incomeTaxExpenses[$i])) . ")", $fontstyleName, $centerAlignment);
        } else {
            $cellNotes->addText(number_format($incomeTaxExpenses[$i]), $fontstyleName, $centerAlignment);
        }
    }

    $table1->addRow();
    $table1->addCell($firstCellValue);
    $table1->addRow();
    $table1->addCell($firstCellValue)->addText("(b) Movement in current income tax liabilities:");

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

    if (in_array("Income tax paid", array_keys($incomeTaxArray))) {
        $table1->addRow();
        $table1->addCell($firstCellValue)->addText("Income tax paid");

        foreach ($incomeTaxArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
            foreach ($value as $k => $v) { // [December 2015] => 54684.19
                // if don't need dash, just print everything out
                if ($numberOfSheets == count($value)) {
                    $cellNotes = $table1->addCell($cellValue);
                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
                }
                // if not the same, then see which position it is
                else {
                    for ($h = 0; $h < count($years); $h++) {
                        if ($key == "Income tax paid") {
                            $cellNotes = $table1->addCell($cellValue);
                            if ($k == $years[$h]) {
                                if ($v < 0) {
                                    $cellNotes->addText("(" . number_format(ceil($v)) . ")", $fontstyleName, $centerAlignment);
                                } else {
                                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
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
                        }
                        // if not the same, then see which position it is
                        else {
                            for ($h = 0; $h < count($years); $h++) {
                                if ($key == $taxExpenseKey[$i]) {
                                    $cellNotes = $table1->addCell($cellValue);
                                    if ($k == $years[$h]) {
                                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
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
            $table1->addCell($firstCellValue)->addText($provisionKey[$i]);
        }

        foreach ($incomeTaxArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
            if ($provisionKey[$i] === $key) {
                foreach ($value as $k => $v) { // [December 2015] => 54684.19
                    // if don't need dash, just print everything out
                    if ($numberOfSheets == count($value)) {
                        $cellNotes = $table1->addCell($cellValue);
                        $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
                    }
                    // if not the same, then see which position it is
                    else {
                        for ($h = 0; $h < count($years); $h++) {
                            if ($key == $provisionKey[$i]) {
                                $cellNotes = $table1->addCell($cellValue);
                                if ($k == $years[$h]) {
                                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
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

    for ($i = 0; $i < count($incomeTaxPayable); $i++) {
        $cellNotes = $table1->addCell($cellValue, $topAndBottom);

        if ($incomeTaxPayable[$i] < 0) {
            $cellNotes->addText("(" . number_format(abs($incomeTaxPayable[$i])) . ")", $fontstyleName, $centerAlignment);
        } else {
            $cellNotes->addText(number_format($incomeTaxPayable[$i]), $fontstyleName, $centerAlignment);
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
    $table1->addCell($firstCellValue)->addText("TRADE AND OTHER RECEIVABLES");

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

    $tradeReceivables = ["Trade receivables"];
    $temp = array();

    // Check if there's trade receivables available
    for ($i = 0; $i < count($tradeReceivables); $i++) {
        if (array_key_exists($tradeReceivables[$i], $tradeReceivablesArray)) {
            array_push($temp, $tradeReceivables[$i]);
        }
    }
    foreach ($tradeReceivablesArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
        foreach ($value as $k => $v) { // [December 2015] => 54684.19
            if (in_array($key, $temp)) {
                $table1->addRow();
                $table1->addCell($firstCellValue)->addText($key);

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
        if (stripos($key, "Trade receivable") === false) {
            $table1->addRow();
            $table1->addCell($firstCellValue)->addText($key);
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

    foreach ($totalArray as $key => $value) {
        foreach ($totalReceivablesArray as $keyReceivables => $valueReceivables) {
            if ($key == $keyReceivables) {
                $finalReceivables = $value + $valueReceivables;
                if ($finalReceivables == 0) {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                } else if ($finalReceivables < 0) {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    $cellNotes->addText("(" . number_format(ceil($finalReceivables)) . ")", $fontstyleName, $centerAlignment);
                } else {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    $cellNotes->addText(number_format(ceil($finalReceivables)), $fontstyleName, $centerAlignment);
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
    $table1->addCell($firstCellValue)->addText("TRADE AND OTHER PAYABLES");

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

    $tradePayable = ["Trade payables"];
    $temp = array();

    // Check if there's trade payables available
    for ($i = 0; $i < count($tradePayable); $i++) {
        if (array_key_exists($tradePayable[$i], $tradePayableArray)) {
            array_push($temp, $tradePayable[$i]);
        }
    }
    foreach ($tradePayableArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
        foreach ($value as $k => $v) { // [December 2015] => 54684.19
            if (in_array($key, $temp)) {
                $table1->addRow();
                $table1->addCell($firstCellValue)->addText($key);

                // if don't need dash, just print everything out
                if ($numberOfSheets == count($value)) {
                    $cellNotes = $table1->addCell($cellValue);
                    $cellNotes->addText(ceil($v), $fontstyleName, $centerAlignment);
                }
                // if not the same, then see which position it is
                else {
                    for ($h = 0; $h < count($years); $h++) {
                        $cellNotes = $table1->addCell($cellValue);

                        if ($k == $years[$h]) {
                            $cellNotes->addText(ceil($v), $fontstyleName, $centerAlignment);

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

                $table1->addRow();
                $table1->addCell($firstCellValue);
            }
        }
    }

    $table1->addRow();
    $table1->addCell($firstCellValue)->addText("Other payables", $fontstyleBottomUnderline);

    foreach ($tradePayableArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
        if (stripos($key, "Trade payable") === false) {
            $table1->addRow();
            $table1->addCell($firstCellValue)->addText($key);
        }

        foreach ($value as $k => $v) { // [December 2015] => 54684.19
            if (!in_array($key, $temp)) {

                // if don't need dash, just print everything out
                if ($numberOfSheets == count($value)) {
                    $cellNotes = $table1->addCell($cellValue);
                    $cellNotes->addText(ceil($v), $fontstyleName, $centerAlignment);
                }
                // if not the same, then see which position it is
                else {
                    for ($h = 0; $h < count($years); $h++) {
                        $cellNotes = $table1->addCell($cellValue);
                        if ($k == $years[$h]) {
                            $cellNotes->addText(ceil($v), $fontstyleName, $centerAlignment);

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
            $cellNotes->addText("(" . ceil($value) . ")", $fontstyleName, $centerAlignment);
        } else if ($value == 0) {
            $cellNotes->addText("-", $fontstyleName, $centerAlignment);
        } else {
            $cellNotes->addText(ceil($value), $fontstyleName, $centerAlignment);
        }
    }

    $table1->addRow();
    $table1->addCell($firstCellValue);

    $table1->addRow();
    $table1->addCell($firstCellValue);

    foreach ($totalArray as $key => $value) {
        foreach ($totalPayablesArray as $keyPayables => $valuePayables) {
            if ($key == $keyPayables) {
                $finalPayables = $value + $valuePayables;

                if ($finalPayables == 0) {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                } else if ($finalPayables < 0) {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    $cellNotes->addText("(" . ceil($finalPayables) . ")", $fontstyleName, $centerAlignment);
                } else {
                    $cellNotes = $table1->addCell($cellValue, $topAndBottom);
                    $cellNotes->addText(ceil($finalPayables), $fontstyleName, $centerAlignment);
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

    $table1->addRow();
    $table1->addCell($firstCellValue)->addText("BORROWINGS");

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
    $currentNonCurrent = ["Current", "Non-current"];
    $tempCurrent = array();
    $temp = array();

    $table1->addRow();
    $table1->addCell($firstCellValue)->addText("As at beginning of financial year");

    for ($i = 1; $i < count($borrowings); $i++) {
        $cellNotes = $table1->addCell($cellValue);

        if ($borrowings[$i] < 0) {
            $cellNotes->addText("(" . number_format(abs($borrowings[$i])) . ")", $fontstyleName, $centerAlignment);
        } else {
            $cellNotes->addText(number_format(round($borrowings[$i])), $fontstyleName, $centerAlignment);
        }
    }

    // check if there's current or non-current available, if available store inside temp array
    for ($i = 0; $i < count($currentNonCurrent); $i++) {
        if (array_key_exists($currentNonCurrent[$i], $borrowingArray)) {
            array_push($tempCurrent, $currentNonCurrent[$i]);
        }
    }

    foreach ($borrowingArray as $key => $value) { // [OCBC Bank] => Array ( [December 2015] => 54684.19 )
        if ($key != "Current") {
            if ($key != "Non-current") {
                if (stripos($key, "Repayment of borrowing") !== false) {
                    $table1->addRow();
                    $table1->addCell($firstCellValue)->addText("(Less) " . $key);
                } else {
                    $table1->addRow();
                    $table1->addCell($firstCellValue)->addText($key);
                }

                foreach ($value as $k => $v) { // [December 2015] => 54684.19
                    // Value is negative
                    if ($v < 0) {
                        // if don't need dash, just print everything out
                        if ($numberOfSheets == count($value)) {
                            $cellNotes = $table1->addCell($cellValue);
                            $cellNotes->addText("(" . number_format(ceil($v)) . ")", $fontstyleName, $centerAlignment);
                        }
                        // if not the same, then see which position it is
                        else {
                            for ($h = 0; $h < count($years); $h++) {
                                $cellNotes = $table1->addCell($cellValue);
                                if ($k == $years[$h]) {
                                    $cellNotes->addText("(" . number_format(ceil($v)) . ")", $fontstyleName, $centerAlignment);
                                } else {
                                    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                                }
                            }
                        }
                        // Value is positive
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
                        }
                        // if not the same, then see which position it is
                        else {
                            for ($h = 0; $h < count($years); $h++) {
                                $cellNotes = $table1->addCell($cellValue);
                                if ($k == $years[$h]) {
                                    $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
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

    for ($i = 0; $i < count($borrowings); $i++) {
        $cellNotes = $table1->addCell($cellValue, $topAndBottom);
        if ($borrowings[$i] < 0) {
            $cellNotes->addText("(" . number_format(abs($borrowings[$i])) . ")", $fontstyleName, $centerAlignment);
        } else {
            $cellNotes->addText(number_format(round($borrowings[$i])), $fontstyleName, $centerAlignment);
        }
    }

    $table1->addRow();
    $table1->addCell($firstCellValue);

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
                    $table1->addCell($firstCellValue)->addText("(Less) " . $key);

                    // if don't need dash, just print everything out
                    if ($numberOfSheets == count($value)) {
                        $cellNotes = $table1->addCell($cellValue);
                        $cellNotes->addText(ceil($v), $fontstyleName, $centerAlignment);
                    }
                    // if not the same, then see which position it is
                    else {
                        for ($h = 0; $h < count($years); $h++) {
                            $cellNotes = $table1->addCell($cellValue);

                            if ($k == $years[$h]) {
                                $cellNotes->addText(number_format(ceil($v)), $fontstyleName, $centerAlignment);
                            } else {
                                $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                            }
                        }
                    }
                } else if ($v == 0) {
                    $table1->addRow();
                    $table1->addCell($firstCellValue)->addText($key);

                    for ($h = 0; $h < count($years); $h++) {
                        $cellNotes = $table1->addCell($cellValue);
                        if ($k == $years[$h]) {
                            $cellNotes->addText("-", $fontstyleName, $centerAlignment);
                        }
                    }
                } else {
                    $table1->addRow();
                    $table1->addCell($firstCellValue)->addText($key);

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

        for ($i = 0; $i < count($borrowings); $i++) {
            $cellNotes = $table1->addCell($cellValue, $topAndBottom);

            if ($borrowings[$i] < 0) {
                $cellNotes->addText("(" . number_format(abs($borrowings[$i])) . ")", $fontstyleName, $centerAlignment);
            } else {
                $cellNotes->addText(number_format(round($borrowings[$i])), $fontstyleName, $centerAlignment);
            }
        }
    }

    $table1->addRow();
    $table1->addCell($firstCellValue);
}

if (in_array("Share Capital", $categoryArray)) {

    array_push($displayedCategory, "Share Capital");

    $section = $phpWord->addSection();
    $table2 = $section->addTable();

    $table2->addRow();
    $table2->addCell($firstCellValue)->addText("SHARE CAPITAL");

    // Create another row 
    $table2->addRow();
    $table2->addCell($firstCellValue);

    $cellNotes = $table2->addCell($cellValue);
    $cellNotes->addText("Number of ordinary shares", $fontstyleName, $centerAlignment, $fontstyleBottomUnderline);
    $cellNotes = $table2->addCell($cellValue);
    $cellNotes->addText("$", $fontstyleName, $centerAlignment, $fontstyleBottomUnderline);

    $cellNotes = $table2->addCell($cellValue);
    $cellNotes->addText("Number of ordinary shares", $fontstyleName, $centerAlignment, $fontstyleBottomUnderline);
    $cellNotes = $table2->addCell($cellValue);
    $cellNotes->addText("$", $fontstyleName, $centerAlignment, $fontstyleBottomUnderline);

    $table2->addRow();
    $table2->addCell($firstCellValue)->addText("Issued and fully paid:");

    $table2->addRow();
    $table2->addCell($firstCellValue)->addText("At beginning of financial year");

    foreach ($shareCapital as $k => $v) {
        // Start from 1 because second year will be sheet 1 in TB
        for ($i = 1; $i < count($shareCapital); $i++) {
            if ($i == $k && $shareCapital[$i] < 0) {
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("(" . number_format(abs($shareCapitalArray[$i])) . ")", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText("(" . number_format(abs($shareCapitalArray[$i])) . ")", $fontstyleName, $centerAlignment);
            } else if ($i == $k && $shareCapital[$i] > 0) {
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText(number_format($shareCapital[$i]), $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue);
                $cellNotes->addText(number_format($shareCapital[$i]), $fontstyleName, $centerAlignment);
            }
        }
    }

    $cellNotes = $table2->addCell($cellValue);
    $cellNotes->addText(number_format($shareCapital[1]), $fontstyleName, $centerAlignment);
    $cellNotes = $table2->addCell($cellValue);
    $cellNotes->addText(number_format($shareCapital[1]), $fontstyleName, $centerAlignment);

    $table2->addRow();
    $table2->addCell($firstCellValue)->addText("Issuance of ordinary shares");

    $issuanceOfOrdinaryShares = $shareCapital[0] - $shareCapital[1];
    for ($i = 0; $i < count($shareCapital); $i++) {
        $cellNotes = $table2->addCell($cellValue);
        if ($issuanceOfOrdinaryShares < 0) {
            $cellNotes->addText("-", $fontstyleName, $centerAlignment);
        } else {
            $cellNotes->addText(number_format($issuanceOfOrdinaryShares), $fontstyleName, $centerAlignment);
        }
    }

    $cellNotes = $table2->addCell($cellValue);
    $cellNotes->addText("-", $fontstyleName, $centerAlignment);
    $cellNotes = $table2->addCell($cellValue);
    $cellNotes->addText("-", $fontstyleName, $centerAlignment);

    $table2->addRow();
    $table2->addCell($firstCellValue)->addText("At end of financial year/period");

    foreach ($shareCapital as $k => $v) {
        for ($i = 0; $i < count($shareCapital); $i++) {

            if ($i == $k && $shareCapital[$i] < 0) {
                $cellNotes = $table2->addCell($cellValue, $topAndBottom);
                $cellNotes->addText("(" . number_format(abs($shareCapitalArray[$i])) . ")", $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue, $topAndBottom);
                $cellNotes->addText("(" . number_format(abs($shareCapitalArray[$i])) . ")", $fontstyleName, $centerAlignment);
            } else if ($i == $k && $shareCapital[$i] > 0) {
                $cellNotes = $table2->addCell($cellValue, $topAndBottom);
                $cellNotes->addText(number_format(round($shareCapital[$i])), $fontstyleName, $centerAlignment);
                $cellNotes = $table2->addCell($cellValue, $topAndBottom);
                $cellNotes->addText(number_format(round($shareCapital[$i])), $fontstyleName, $centerAlignment);
            }
        }
    }

    $table2->addRow();
    $table2->addCell($firstCellValue);

    $table2->addRow();
    $table2->addCell($cellValue * 5, array('gridSpan' => 5))->addText("All issued ordinary shares are fully paid. The newly issued shares rank pari passu in all respects with the previously issued shares. "
            . "There is no par value for the ordinary share. The holder of the ordinary share is entitled to receive dividends as end when declared by the Company.", $paragraphStyle);
}

if (in_array("Plant and Equipment", $categoryArray)) {

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
    $table2->addCell($firstCellValue)->addText("PLANT AND EQUIPMENT");

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

//==============================================================================
// YOKYEE START HERE
//==============================================================================
// Creating the new document
// Temporary shifted to top
// $phpWord = new \PhpOffice\PhpWord\PhpWord();
?>

<?php
// //Default font style
// $phpWord->setDefaultFontName('Arial');
// $phpWord->setDefaultFontSize(11);
//
// //Create font style
// $fontStyleBigBlack = 'ArialBlack14';
// $fontStyleBlack = 'ArialBlack11';
// $fontstyleName = 'Arial11';
// $fontstyleUnderline = 'Arial11Underline';
// $phpWord->addFontStyle($fontStyleBigBlack, array('name' => 'Arial', 'size' => 14, 'bold' => true)
// );
// $phpWord->addFontStyle($fontStyleBlack, array('name' => 'Arial', 'size' => 11, 'bold' => true)
// );
// $phpWord->addFontStyle($fontstyleName, array('name' => 'Arial', 'size' => 11, 'bold' => false)
// );
//
// //Create listing style
// $listingStyle = 'multilevel';
// $phpWord->addNumberingStyle(
//         $listingStyle, array(
//     'type' => 'multilevel',
//     'levels' => array(
//         array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
//         array('format' => 'lowerRoman', 'text' => '(%2)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerLetter', 'text' => '%3)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerLetter', 'text' => '(%4)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerLetter', 'text' => '(%5)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerLetter', 'text' => '(%6)', 'left' => 360, 'hanging' => 360, 'tabPos' => 720),
//     )
//         )
// );
//
// $nestedListStyle = 'nestedlevel';
// $phpWord->addNumberingStyle(
//         $nestedListStyle, array(
//     'type' => 'multilevel',
//     'levels' => array(
//         array('format' => 'decimal', 'text' => '%1.', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
//         array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360),
//         array('format' => 'decimal', 'text' => '%1.%2', 'left' => 360, 'hanging' => 360, 'tabPos' => 360, 'start' => 2)
//     )
//         )
// );
//
// $romanListingStyle = 'romanlevel';
// $phpWord->addNumberingStyle(
//         $romanListingStyle, array(
//     'type' => 'multilevel',
//     'levels' => array(
//         array('format' => 'lowerRoman', 'text' => '(%1)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerRoman', 'text' => '(%2)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerRoman', 'text' => '(%3)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerRoman', 'text' => '(%4)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerRoman', 'text' => '(%5)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerRoman', 'text' => '(%6)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
//         array('format' => 'lowerRoman', 'text' => '(%7)', 'left' => 1000, 'hanging' => 360, 'tabPos' => 720),
//     )
//         )
// );
//
// //Create Paragraph style
// $paragraphStyle = 'justifiedParagraph';
// $phpWord->addParagraphStyle($paragraphStyle, array('align' => 'both', 'spaceAfter' => 100));
?>

<body>
<?php
$section = $phpWord->addSection();

$section->addListItem("2.2", 2, $fontstyleName, $nestedListStyle);
$section->addListItem("2.2", 2, $fontstyleName, $nestedListStyle);
$section->addListItem("2.2", 2, $fontstyleName, $nestedListStyle);
?>
    <h1>Cover Page</h1><!-- Temporary-->
    <div name="coverPage">
        <b><?php echo strtoupper($companyName); ?></b>
        <br/>
        <p><b><?php echo "(Company registration number: " . $companyregID . ")"; ?></p></b>
    <b><p>UNAUDITED FINANCIAL STATEMENTS</p></b>
    <b><?php echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))); ?></b>

<?php
$section = $phpWord->addSection();
//$section->addTextBreak([8], [$fontstyleName], [null]);
$section->addText('<w:br/><w:br/><w:br/><w:br/><w:br/><w:br/><w:br/><w:br/><w:br/>', $fontstyleName);
$section->addText(strtoupper($companyName) .
        "<w:br/>(Company registration number: " . $companyregID . ")", $fontStyleBigBlack);
$section->addText("UNAUDITED FINANCIAL STATEMENTS", $fontStyleBigBlack);
$section->addText("FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBigBlack);
?>

</div>

<br>
<hr> <!-- Temporary-->
<h1> Page 1</h1><!-- Temporary-->
<div name="firstPage">
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    if ($noOfDirectors > 1) {
        echo "DIRECTORS'STATEMENTS";
        echo "<br>";
        echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd)));
        $section->addText("DIRECTORS' STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
        $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    } else {
        echo "DIRECTOR'S STATEMENTS";
        echo "<br>";
        echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd)));
        $section->addText("DIRECTOR'S STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
        $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    }
    ?></b>
    <hr>
    <br>
    <br>
    <textarea>The <?php
        if ($noOfDirectors > 1) {
            echo "directors";
            $section->addText("The directors present this statement to the member together with the unaudited financial statements of " . strtoupper($companyName)
                    . " (“the Company”) for the financial year ended " . date('d F Y', strtotime($yearEnd)) . ".", $fontstyleName, $paragraphStyle);
        } else {
            echo "director";
            $section->addText("The director present this statement to the member together with the unaudited financial statements of " . strtoupper($companyName)
                    . " (“the Company”) for the financial year ended " . date('d F Y', strtotime($yearEnd)) . ".", $fontstyleName, $paragraphStyle);
        }
    ?> present this statement to the member together with the unaudited financial statements of
        <?php echo strtoupper($companyName) ?> (“the Company”) for the financial year ended <?php echo date('d F Y', strtotime($yearEnd)) . "."; ?></textarea>
    <br>
    <ol>

        <li>OPINION OF THE <?php
        if ($noOfDirectors > 1) {
            echo "DIRECTORS";
            $section->addListItem("OPINION OF THE DIRECTORS", 0, $fontstyleName, $listingStyle);
        } else {
            echo "DIRECTOR";
            $section->addListItem("OPINION OF THE DIRECTOR", 0, $fontstyleName, $listingStyle);
        }
        ?></li>
        <ol type="i">
            <br>
            <li>the accompanying financial statements of the Company are drawn up so as to give a true and fair view of the
                financial position of the Company as at <?php echo date('d F Y', strtotime($yearEnd)); ?> and the financial performance, changes in equity and
                cash flows of the Company for the financial year covered by the financial statements; and

<?php
$section->addListItem("the accompanying financial statements of the Company are drawn up so as to give a true and fair view of the financial position of the Company as at "
        . date('d F Y', strtotime($yearEnd)) . " and the financial performance, changes in equity and cash flows of the Company for the financial year covered by the financial statements; and"
        , 0, $fontstyleName, $romanListingStyle);
?>

            </li>
            <br>
            <li>at the date of this statement there are reasonable grounds to believe that the Company will be able to pay its debts as and when they fall due.

<?php
$section->addListItem("at the date of this statement there are reasonable grounds to believe that the Company will be able to pay its debts as and when they fall due."
        , 0, $fontstyleName, $romanListingStyle);
?>

            </li>
            <br>
        </ol>
        <li><?php
if ($noOfDirectors > 1) {
    echo "DIRECTORS";
    $section->addListItem("DIRECTORS", 0, $fontstyleName, $listingStyle);
} else {
    echo "DIRECTOR";
    $section->addListItem("DIRECTOR", 0, $fontstyleName, $listingStyle);
}
?></li>
        <br>
        <p>
            The <?php
            if ($noOfDirectors > 1) {
                echo "directors";
                $section->addText("The directors of the Company in office at the date of this statement are as follows:", $fontstyleName, $paragraphStyle);
            } else {
                echo "director";
                $section->addText("The director of the Company in office at the date of this statement are as follows:", $fontstyleName, $paragraphStyle);
            }
            ?> of the Company in office at the date of this statement are as follows:
        </p>
        <br>
        <br>
        <p>
<?php
if ($directorName1ApptDate != null) {
    echo $directorName1 . " appointed on " . date('d F Y', strtotime($directorName1ApptDate));
    $section->addText($directorName1 . "   appointed on " . date('d F Y', strtotime($directorName1ApptDate)), $fontstyleName, $paragraphStyle);
} else {
    echo $directorName1;
    $section->addText($directName1);
}
?>
        </p>
        <br>
        <br>
        <li>ARRANGEMENTS TO ENABLE <?php
            if ($noOfDirectors > 1) {
                echo "DIRECTORS";
                $section->addListItem("ARRANGEMENTS TO ENABLE DIRECTORS TO ACQUIRE SHARES AND DEBENTURES", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            } else {
                echo "DIRECTOR";
                $section->addListItem("ARRANGEMENTS TO ENABLE DIRECTOR TO ACQUIRE SHARES AND DEBENTURES", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            }
?>  TO ACQUIRE SHARES AND DEBENTURES</li>
        <br>
        <p>Neither at the end of nor at any time during the financial year was the Company a party to any arrangement whose object was to enable the <?php
            if ($noOfDirectors > 1) {
                echo "directors";
                $section->addText("Neither at the end of nor at any time during the financial year was the Company a party to any arrangement whose object was to enable the directors of the Company to acquire benefits by means of the acquisition of shares in, or debentures of, the Company or any other body corporate."
                        , $fontstyleName);
            } else {
                echo "director";
                $section->addText("Neither at the end of nor at any time during the financial year was the Company a party to any arrangement whose object was to enable the director of the Company to acquire benefits by means of the acquisition of shares in, or debentures of, the Company or any other body corporate."
                        , $fontstyleName);
            }
            ?> of the Company to acquire benefits by means of the acquisition of shares in, or debentures of, the Company or any other body corporate.
        </p>
        <li><?php
            if ($noOfDirectors > 1) {
                echo "DIRECTORS'";
                $section->addListItem("DIRECTORS' INTERESTS IN SHARES OR DEBENTURES", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            } else {
                echo "DIRECTOR'S";
                $section->addListItem("DIRECTOR'S INTERESTS IN SHARES OR DEBENTURES", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            }
            ?> INTERESTS IN SHARES OR DEBENTURES</li>
        <br>
        <p>According to the register of <?php
            if ($noOfDirectors > 1) {
                echo "directors'";
                $section->addText("According to the register of directors’ shareholdings, none of the directors holding office at the end of the financial year had any interest in the shares or debentures of the Company or its related corporations, except as follows: "
                        , $fontstyleName);
            } else {
                echo "director's";
                $section->addText("According to the register of director’s shareholdings, none of the director holding office at the end of the financial year had any interest in the shares or debentures of the Company or its related corporations, except as follows: "
                        , $fontstyleName);
            }
            ?> shareholdings, none of the
            <?php
            if ($noOfDirectors > 1) {
                echo "directors'";
            } else {
                echo "director's";
            }
            ?> holding office at the end of the
            financial year had any interest in the shares or debentures of the Company or its related corporations, <?php
            if ($director1Share != " ") {
                echo "except as follows:";
            }
            ?> </p>
            <?php
            $section->addText('<w:br/>', $fontstyleName);
            ?>
        <br>
        <br>
        <p><u>The Company</u>
            <br>
<?php
echo $directorName1;
$textrun = $section->addTextRun();
$textrun->addText(htmlspecialchars("The Company"), array('underline' => 'single'));
$section->addText('<w:br/>' . $directorName1, $fontstyleName);
?>
        </p>
    </ol>
    <br>
    <br>

</div>
<h1> Page 2</h1><!-- Temporary-->
<div name="secondPage">
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    if ($noOfDirectors > 1) {
        echo "DIRECTORS'STATEMENTS";
        echo "<br>";
        echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
        $section->addText("DIRECTORS' STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
        $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    } else {
        echo "DIRECTOR'S STATEMENTS";
        echo "<br>";
        echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
        $section->addText("DIRECTOR'S STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
        $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    }
    ?></b>
    <hr>
    <br>
    <br>
    <ol start="5">
        <li><?php
        if ($noOfDirectors > 1) {
            echo "DIRECTORS'";
            $section->addListItem("DIRECTORS' CONTRACTUAL BENEFITS", 0, $fontstyleName, $listingStyle, $paragraphStyle);
        } else {
            echo "DIRECTOR'S";
            $section->addListItem("DIRECTORS' CONTRACTUAL BENEFITS", 0, $fontstyleName, $listingStyle, $paragraphStyle);
        }
    ?> CONTRACTUAL BENEFITS</li>
        <br>
        <p>Since the end of the previous financial period, no director has received or become entitled to receive a benefit which is required to be disclosed
            under the Singapore Companies Act, by reason of a contract made by the Company or a related corporation with the directors or with a firm of which
            he is a member, or with a Company in which he has a substantial financial interest, except as disclosed in the financial statements.
<?php
$section->addText("Since the end of the previous financial period, no director has received or become entitled to receive a benefit which is required to be disclosed under the Singapore Companies Act, by reason of a contract made by the Company or a related corporation with the directors or with a firm of which he is a member, or with a Company in which he has a substantial financial interest, except as disclosed in the financial statements."
        , $fontstyleName, $paragraphStyle);
$section->addTextBreak(1);
?>
        </p>
        <br>
        <li>OPTIONS GRANTED
            <?php
            $section->addListItem("OPTIONS GRANTED", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            ?>
        </li>
        <br>
        <p>No options were granted during the financial year to subscribe for unissued shares of the Company.
            <?php
            $section->addText("No options were granted during the financial year to subscribe for unissued shares of the Company."
                    , $fontstyleName, $paragraphStyle);
            $section->addTextBreak(1);
            ?>
        </p>
        <br>
        <li>OPTIONS EXERCISED
            <?php
            $section->addListItem("OPTIONS EXERCISED", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            ?>
        </li>
        <br>
        <p>No shares were issued during the financial year by virtue of the exercise of options to take up unissued shares of the Company.
            <?php
            $section->addText("No shares were issued during the financial year by virtue of the exercise of options to take up unissued shares of the Company."
                    , $fontstyleName, $paragraphStyle);
            $section->addTextBreak(1);
            ?>
        </p>
        <br>
        <li>OPTIONS OUTSTANDING
            <?php
            $section->addListItem("OPTIONS OUTSTANDING", 0, $fontstyleName, $listingStyle, $paragraphStyle);
            ?>
        </li>
        <br>
        <p>There were no unissued shares of the Company under option at the end of the financial year.
            <?php
            $section->addText("There were no unissued shares of the Company under option at the end of the financial year."
                    , $fontstyleName, $paragraphStyle);
            $section->addTextBreak(1);
            ?>
        </p>
        <br>
    </ol>
    <p><?php
            if ($noOfDirectors >= 2) {
                echo "On behalf of the directors";
                $section->addText("On behalf of the directors"
                        , $fontstyleName, $paragraphStyle);
            }
            ?></p>
    <br>
    <br>
    <p>
        <?php
        echo $directorName1;
        $section->addTextBreak(1);
//$section->addLine(['weight' => 0.5, 'width' => 100, 'height' => 0]); //Need to add line here
        $section->addText($directorName1 . "<w:br/>Director"
                , $fontstyleName, $paragraphStyle);
        ?>
        <br>
        Director
    </p>
    <br>
    <p>
<?php
echo "Singapore, " . (date('F d Y', strtotime($todayDate)));
$section->addText("Singapore, " . (date('F d Y', strtotime($todayDate)))
        , $fontstyleName, $paragraphStyle);
?>
    </p>
</div>
<h1> Page 3</h1>
<div name="thirdPage">
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "STATEMENT OF COMPREHENSIVE INCOME";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("STATEMENT OF COMPREHENSIVE INCOME<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <p>Revenue</p>
    <p>Less: Cost of Sales</p>
    <p><b>Gross Profit</b></p>
    <p>Other income</p>
    <p>Expenses<br>
        -Administrative<br>
        -Distribution and marketing<br>
        -Finance<br>
    </p>
    <p><b>Profit before income tax</b></p>
    <p>Income tax expense</p>
    <p><b>Net profit and total comprehensive income for the year/period</b></p>
    <br>
    <br>
    <p><i>The accompanying accounting policies and explanatory notes form an integral part of the financial statements.</i></p>
</div>
<h1> Page 4</h1>
<div name="fourthPage">
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "STATEMENT OF FINANCIAL POSITION";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("STATEMENT OF FINANCIAL POSITION<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <p><b>ASSETS</b><br>
        <b>Current Assets</b><br>
        Bank balances<br>
        Trade and other receivables<br>
    </p>
    <p><b>Non-current assets</b><br>
        Plant and equipment<br>
    </p>
    <p><b>Total assets</b></p>
    <p><b>LIABILITIES</b><br>
        <b>Current liabilities</b><br>
        Trade and other payables<br>
        Current income tax liabilities<br>
        Borrowings<br>
    </p>
    <p><b>Total liabilities</b></p>
    <p><b>Non-current liabilities</b><br>
        Borrowings<br>
    </p>
    <p><b>Total liabilities</b></p>
    <p><b>NET ASSETS</b></p>
    <p><b>EQUITY</b><br>
        Share capital<br>
        Retained profits
    </p>
    <p><b>Total equity</b></p>
    <br>
    <br>
    <p><i>The accompanying accounting policies and explanatory notes form an integral part of the financial statements.</i></p>
</div>
<h1> Page 5</h1>
<div name="fifthPage">
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "STATEMENT OF CHANGES IN EQUITY";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("STATEMENT OF CHANGES IN EQUITY<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <p><?php echo "Balance as at " . date('F d Y', strtotime($firstBalanceDate)); ?></p>
    <p>Total comprehensive income  for the  financial period</p>
    <p><?php echo "Balance as at " . date('F d Y', strtotime($secondBalanceDate)); ?></p>
    <p>Issuance of ordinary shares</p>
    <p>Total comprehensive income  for the  financial year</p>
    <p><?php echo "Balance as at " . date('F d Y', strtotime($thirdBalanceDate)); ?></p>
    <br>
    <br>
    <p><i>The accompanying accounting policies and explanatory notes form an integral part of the financial statements.</i></p>
</div>
<h1> Page 6</h1>
<div name="sixthPage">
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "STATEMENT OF CASH FLOWS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("STATEMENT OF CASH FLOWS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <p><b>Cash flows from operating activities:</b><br>
        Profit  before income tax<br>
        Adjustment for:<br>
        &emsp;Depreciation<br>
        &emsp;Interest on bank borrowings<br>
    </p>
    <p>Change in working capital:<br>
        &emsp;Trade and other receivables<br>
        &emsp;Trade and other payables
    </p>
    <p>Cash generated from  operations</p>
    <p>Income tax paid</p>
    <p><b>Net cash generated from  operating activities</b></p>
    <br>
    <p><b>Cash flows from investing activities</b><br>
        Additions to plant  and equipment
    </p>
    <p><b>Net cash used in  investing activities</b><br>
        Proceeds from issuance of ordinary shares<br>
        (Advances)/repayment  from a shareholder<br>
        Proceeds from borrowings<br>
        Repayments of borrowings<br>
        Interest paid<br>
    </p>
    <p><b>Net cash (used in)/generated  from financing activities</b></p>
    <p>Net increase  in cash and cash equivalents<br>
        Cash and cash equivalents at beginning of the financial year/period
    </p>
    <p><b>Cash and cash equivalents at end of the financial year/period</b></p>
    <br>
    <br>
    <p><i>The accompanying accounting policies and explanatory notes form an integral part of the financial statements.</i></p>
</div>
<h1>Page 7</h1>
<div name="seventhPage">
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <p>These notes form an integral part of and should be read in conjunction with the accompanying financial statements.
<?php
$section->addText("These notes form an integral part of and should be read in conjunction with the accompanying financial statements."
        , $fontstyleName, $paragraphStyle);
$section->addTextBreak(1);
?>
    </p>
    <br>
    <p>
    <ol>
        <li>GENERAL INFORMATION
<?php
$section->addListItem(htmlspecialchars('GENERAL INFORMATION'), 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>The Company is incorporated and domiciled in Singapore.
            <?php
            $section->addText("The Company is incorporated and domiciled in Singapore."
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>
        <p>The Company’s principal activities are those to carry-on the businesses of
            <?php
            echo $companyPA;
            $section->addText("The Company’s principal activities are those to carry-on the businesses of " . $companyPA
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>
        <p>The Company’s registered office is at
            <?php
            echo $companyAddress;
            $section->addText("The Company’s registered office is at " . $companyAddress
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>
        <p>The financial statements of the Company for the financial year ended <?php echo date('F d Y', strtotime($yearEnd)) ?>
            were authorised for issue in accordance with a resolution of the directors on the date of Statement by Directors.
            <?php
            $section->addText("The financial statements of the Company for the financial year ended " . date('F d Y', strtotime($yearEnd)) . " were authorised for issue in accordance with a resolution of the directors on the date of Statement by Directors."
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>

        <li>BASIS OF PREPARATION AND SUMMARY OF SIGNIFICANT ACCOUNTING POLICIES
            <?php
            $section->addListItem(htmlspecialchars('BASIS OF PREPARATION AND SUMMARY OF SIGNIFICANT ACCOUNTING POLICIES'), 0, $fontstyleName, $nestedListStyle);
            ?>
        </li>
        <br>
        <ol type='i'>
            <li>Basis of preparation
<?php
$section->addListItem(htmlspecialchars('Basis of preparation'), 1, $fontstyleName, $nestedListStyle);
?>
            </li>
            <br>
            <ol type='a'>
                <li>Basis of accounting
<?php
$section->addListItem("Basis of accounting", 2, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <p>The financial statements are prepared in accordance with Singapore Financial Reporting Standards (“FRS”).
                    The financial statements have been prepared under the historical cost convention, except as disclosed in the accounting policies below.
<?php
$section->addText("The financial statements are prepared in accordance with Singapore Financial Reporting Standards (“FRS”). The financial statements have been prepared under the historical cost convention, except as disclosed in the accounting policies below."
        , $fontstyleName, $paragraphStyle);
?>
                </p>
                <p>The preparation of these financial statements in conformity with FRS requires management to exercise its judgement in the process of applying the
                    Company’s accounting policies. It also requires the use of certain critical accounting estimates and assumptions. The areas involving a higher degree of
                    judgement or complexity,or areas where assumptions and estimates are significant to the financial statements, are disclosed in Note 3
<?php
$section->addText("The preparation of these financial statements in conformity with FRS requires management to exercise its judgement in the process of applying the Company’s accounting policies. It also requires the use of certain critical accounting estimates and assumptions. The areas involving a higher degree of judgement or complexity,or areas where assumptions and estimates are significant to the financial statements, are disclosed in Note 3"
        , $fontstyleName, $paragraphStyle);
?>
                </p>

                <li>Adoption of new and revised Singapore Financial Reporting Standards
                    <?php
                    $section->addListItem("Adoption of new and revised Singapore Financial Reporting Standards", 2, $fontstyleName, $listingStyle);
                    ?>
                </li>
                <br>
                <p>On <?php echo date('F d Y', strtotime($frsDate)); ?> the Company adopted the new or amended FRS and Interpretations to FRS (“INT FRS”) that are mandatory for application for the financial year.
                    The adoption of these new or amended FRS and INT FRS did not result insubstantial changes of the Company’s accounting policies and had no material effect on the
                    amounts reported for the current or prior financial period.
<?php
$section->addText("On " . date('F d Y', strtotime($frsDate)) . " the Company adopted the new or amended FRS and Interpretations to FRS (“INT FRS”) that are mandatory for application for the financial year. The adoption of these new or amended FRS and INT FRS did not result insubstantial changes of the Company’s accounting policies and had no material effect on the amounts reported for the current or prior financial period."
        , $fontstyleName, $paragraphStyle);
?>
                </p>
            </ol>
        </ol>
    </ol>
</p>
<br>
<br>
</div>
<h1> Page 8</h1>
<div name='eigthPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <p>
    <ol start='2'>
        <ol type='i' start='2'>
            <li>Summary of significant accounting policies
<?php
$section->addListItem(htmlspecialchars('Summary of significant accounting policies'), 1, $fontstyleName, $nestedListStyle);
?>
            </li>
            <br>
            <ol type='a'>
                <li>Revenue recognition
<?php
$section->addListItem("Revenue recognition", 3, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <p>Sales comprise the fair value of the consideration received or receivable for the rendering of services in the
                    ordinary course of the Company’s activities. Sales are presented net of goods and services tax, rebates and discounts.
<?php
$section->addText("Sales comprise the fair value of the consideration received or receivable for the rendering of services in the ordinary course of the Company’s activities. Sales are presented net of goods and services tax, rebates and discounts."
        , $fontstyleName, $paragraphStyle);
?>
                </p>
                <p>The Company recognises revenue when the amount of revenue and related cost can be reliably measured, when it is probable that the
                    collectability of the related receivables is reasonably assured and when the specific criteria for each of the Company’s activities are met.
                    <?php
                    $section->addText("The Company recognises revenue when the amount of revenue and related cost can be reliably measured, when it is probable that the collectability of the related receivables is reasonably assured and when the specific criteria for each of the Company’s activities are met."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>
                <ol type='i'> <!-- need to change to dynamic-->
                    <li>Service income
                    <?php
                    $section->addListItem("Service income", 1, $fontstyleName, $romanListingStyle);
                    ?>
                    </li>
                    <br>
                    <p>Service income is recognised when services are rendered.
                        <?php
                        $section->addText("Service income is recognised when services are rendered."
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>
                    <li>Sale of goods
                        <?php
                        $section->addListItem("Sale of goods", 1, $fontstyleName, $romanListingStyle);
                        ?>
                    </li>
                    <br>
                    <p>Revenue from these sales is recognised when a Company has delivered the products to the customer,
                        the customer has accepted the products and collectability of the related receivables is reasonably assured.
<?php
$section->addText("Revenue from these sales is recognised when a Company has delivered the products to the customer,the customer has accepted the products and collectability of the related receivables is reasonably assured."
        , $fontstyleName, $paragraphStyle);
?>
                    </p>
                </ol>
                <li>Employee compensation
                        <?php
                        $section->addListItem("Employee compensation", 3, $fontstyleName, $listingStyle);
                        ?>
                </li>
                <br>
                <p>Employee benefits are recognised as an expense, unless the cost qualifies to be capitalised as an asset.
                    <?php
                    $section->addText("Employee benefits are recognised as an expense, unless the cost qualifies to be capitalised as an asset."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>
                <ol type='i'>
                    <li>Defined contribution plans
                    <?php
                    $section->addListItem("Defined contribution plans", 2, $fontstyleName, $romanListingStyle);
                    ?>
                    </li>
                    <br>
                    <p>Defined contribution plans are post-employment benefit plans under which the Company pays fixed contributions into separate entities such as the
                        Central Provident Fund on a mandatory, contractual or voluntary basis. The Company has no further payment obligations once the contributions have been paid.
<?php
$section->addText("Defined contribution plans are post-employment benefit plans under which the Company pays fixed contributions into separate entities such as the Central Provident Fund on a mandatory, contractual or voluntary basis. The Company has no further payment obligations once the contributions have been paid."
        , $fontstyleName, $paragraphStyle);
?>
                    </p>
                    <li>Employee leave entitlement
                        <?php
                        $section->addListItem("Employee leave entitlement", 2, $fontstyleName, $romanListingStyle);
                        ?>
                    </li>
                    <br>
                    <p>Employee entitlements to annual leave are recognised when they accrue to employees. A provision is made for the estimated liability for annual leave as a result of
                        services rendered by employees up to the balance sheet date.
<?php
$section->addText("Employee entitlements to annual leave are recognised when they accrue to employees. A provision is made for the estimated liability for annual leave as a result of services rendered by employees up to the balance sheet date."
        , $fontstyleName, $paragraphStyle);
?>
                    </p>
                </ol>
                <li>Operating lease payments
                        <?php
                        $section->addListItem("Operating lease payments", 3, $fontstyleName, $listingStyle);
                        ?>
                </li>
                <br>
                <p>Payments made under operating leases (net of any incentives received from the lessor) are recognized in profit or loss on a straight-line basis over the period of lease.
                    <?php
                    $section->addText("Payments made under operating leases (net of any incentives received from the lessor) are recognized in profit or loss on a straight-line basis over the period of lease.", $fontstyleName, $paragraphStyle);
                    ?>
                </p>

                <p>Contingent rents are recognised as an expense in profit or loss when incurred.
                    <?php
                    $section->addText("Contingent rents are recognised as an expense in profit or loss when incurred.", $fontstyleName, $paragraphStyle);
                    ?>
                </p>
            </ol>
        </ol>
    </ol>
</p>
<br>
<br>
</div>
<h1> Page 9</h1>
<div name='ninthPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='2'>
        <ol type='i' start='2'>
            <li>Summary of significant accounting policies (Cont’d)
<?php
$section->addText("2.2 Summary of significant accounting policies (Cont’d)", $fontstyleName, $paragraphStyle);
?>
            </li>
            <br>
            <ol type='a' start='4'>
                <li>Borrowing costs
<?php
$section->addListItem("Borrowing costs", 3, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <p>Borrowing costs are recognised in profit or loss using the effective interest method
                    <?php
                    $section->addText("Borrowing costs are recognised in profit or loss using the effective interest method", $fontstyleName, $paragraphStyle);
                    ?>
                </p>

                <li>Income taxes
                    <?php
                    $section->addListItem("Income taxes", 3, $fontstyleName, $listingStyle);
                    ?>
                </li>
                <br>
                <p>Current income tax for current and prior periods is recognised at the amount expected to be paid to or recovered from the tax authorities,
                    using the tax rates and tax laws that have been enacted or substantively enacted by the balance sheet date
<?php
$section->addText("Current income tax for current and prior periods is recognised at the amount expected to be paid to or recovered from the tax authorities,using the tax rates and tax laws that have been enacted or substantively enacted by the balance sheet date"
        , $fontstyleName, $paragraphStyle);
?>
                </p>
                <p>Deferred income tax is recognised for all temporary differences arising between the tax bases of assets and liabilities and their carrying
                    amounts in the financial statements except when the deferred income tax arises from the initial recognition of an asset or liability that
                    affects neither accounting nor taxable profit or loss at the time of the transaction.
<?php
$section->addText("Deferred income tax is recognised for all temporary differences arising between the tax bases of assets and liabilities and their carrying amounts in the financial statements except when the deferred income tax arises from the initial recognition of an asset or liability that affects neither accounting nor taxable profit or loss at the time of the transaction."
        , $fontstyleName, $paragraphStyle);
?>
                </p>
                <p>A deferred income tax asset is recognised to the extent that it is probable that future taxable profit will be available against which the
                    deductible temporary differences and tax losses can be utilised.
                    <?php
                    $section->addText("A deferred income tax asset is recognised to the extent that it is probable that future taxable profit will be available against which the deductible temporary differences and tax losses can be utilised."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>
                <p>Deferred income tax is measured:
                    <?php
                    $section->addText("Deferred income tax is measured:", $fontstyleName, $paragraphStyle);
                    ?>
                </p>

                <ol type='i'>
                    <li>at the tax rates that are expected to apply when the related deferred income tax asset is realised or the deferred income
                        tax liability is settled, based on tax rates and tax laws that have been enacted or substantively enacted by the balance sheet date; and
<?php
$section->addListItem("at the tax rates that are expected to apply when the related deferred income tax asset is realised or the deferred income tax liability is settled, based on tax rates and tax laws that have been enacted or substantively enacted by the balance sheet date; and"
        , 3, $fontstyleName, $romanListingStyle);
?>
                    </li>
                    <br>
                    <li>based on the tax consequence that will follow from the manner in which the Company expects, at the balance sheet date, to recover or settle
                        the carrying amounts of its assets and liabilities.
<?php
$section->addListItem("based on the tax consequence that will follow from the manner in which the Company expects, at the balance sheet date, to recover or settle the carrying amounts of its assets and liabilities."
        , 3, $fontstyleName, $romanListingStyle);
?>
                    </li>
                    <br>
                </ol>
                <p>Current and deferred income taxes are recognised as income or expense in profit or loss.
<?php
$section->addText("Current and deferred income taxes are recognised as income or expense in profit or loss.", $fontstyleName, $paragraphStyle);
?>
                </p>
                <!-- only applicable if inventory is in balance sheet-->
                <li>Inventories
                    <?php
                    $section->addListItem("Inventories", 3, $fontstyleName, $listingStyle);
                    ?>
                </li>
                <br>
                <p>Inventories are carried at the lower of cost and net realisable value. Cost is determined using the first-in, first-out method. Net realisable value
                    is the estimated selling price in the ordinary course of business, less applicable variable selling expenses.
<?php
$section->addText("Inventories are carried at the lower of cost and net realisable value. Cost is determined using the first-in, first-out method. Net realisable value is the estimated selling price in the ordinary course of business, less applicable variable selling expenses."
        , $fontstyleName, $paragraphStyle);
?>
                </p>
            </ol>
        </ol>
    </ol>
    <br>
    <br>
</div>
<h1> Page 10</h1>
<div name='tenthPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='2'>
        <ol type='i' start='2'>
            <li>Summary of significant accounting policies (Cont’d)
<?php
$section->addText("2.2 Summary of significant accounting policies (Cont’d)", $fontstyleName);
?>
            </li>
            <br>
            <ol type='a' start='7'>
                <li>Plant and equipment
<?php
$section->addListItem("Plant and equipment", 3, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <ol type='i'>
                    <li>Measurement
<?php
$section->addListItem("Measurement", 4, $fontstyleName, $romanListingStyle);
?>
                    </li>
                    <br>
                    <p>Plant and equipment are initially recognised at cost and subsequently carried at cost less accumulated depreciation and accumulated impairment losses
                        <?php
                        $section->addText("Plant and equipment are initially recognised at cost and subsequently carried at cost less accumulated depreciation and accumulated impairment losses"
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>
                    <p>The cost of an item of plant and equipment initially recognised includes its purchase price and any cost that is directly attributable to bringing the
                        asset to the location and condition necessary for it to be capable of operating in the manner intended by management.
                        <?php
                        $section->addText("The cost of an item of plant and equipment initially recognised includes its purchase price and any cost that is directly attributable to bringing the asset to the location and condition necessary for it to be capable of operating in the manner intended by management."
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>

                    <li>Depreciation
                        <?php
                        $section->addListItem("Depreciation", 4, $fontstyleName, $romanListingStyle);
                        ?>
                    </li>
                    <br>
                    <p>Depreciation on plant and equipment is calculated using the straight-line method to allocate their depreciable amounts over their estimated useful lives as follows:
                        <?php
                        $section->addText("Depreciation on plant and equipment is calculated using the straight-line method to allocate their depreciable amounts over their estimated useful lives as follows:"
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>

                    <!-- need to create table by form generation-->
                    <p>&emsp;Computer and softwares <br>
                        &emsp;Office equipment<br>
                    </p>

                    <p>The residual values, estimated useful lives and depreciation method of plant and equipment are reviewed, and adjusted as appropriate, at the end of each reporting period.
                        The effects of any revision are recognised in profit or loss when the changes arise.
<?php
$section->addText("The residual values, estimated useful lives and depreciation method of plant and equipment are reviewed, and adjusted as appropriate, at the end of each reporting period.The effects of any revision are recognised in profit or loss when the changes arise."
        , $fontstyleName, $paragraphStyle);
?>
                    </p>
                    <p>Fully depreciated plant and equipment still in use are retained in the financial statements.
                        <?php
                        $section->addText("Fully depreciated plant and equipment still in use are retained in the financial statements."
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>

                    <li>Subsequent expenditure
                        <?php
                        $section->addListItem("Subsequent expenditure", 4, $fontstyleName, $romanListingStyle);
                        ?>
                    </li>
                    <br>
                    <p>Subsequent expenditure relating to plant and equipment that has already been recognised is added to the carrying amount of the asset only when it is probable that future
                        economic benefits associated with the item will flow to the Company and the cost of the item can be measured reliably. All other repair and maintenance expenses are recognised in profit or loss when incurred.
<?php
$section->addText("Subsequent expenditure relating to plant and equipment that has already been recognised is added to the carrying amount of the asset only when it is probable that future economic benefits associated with the item will flow to the Company and the cost of the item can be measured reliably. All other repair and maintenance expenses are recognised in profit or loss when incurred.", $fontstyleName, $paragraphStyle);
?>
                    </p>

                    <li>Disposal
                        <?php
                        $section->addListItem("Disposal", 4, $fontstyleName, $romanListingStyle);
                        ?>
                    </li>
                    <br>
                    <p>On disposal of an item of plant and equipment, the difference between the disposal proceeds and its carrying amount is recognised in profit or loss.
                        <?php
                        $section->addText("On disposal of an item of plant and equipment, the difference between the disposal proceeds and its carrying amount is recognised in profit or loss"
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>
                </ol>
            </ol>
        </ol>
    </ol>
    <br>
    <br>
</div>
<h1> Page 11</h1>
<div name='eleventhPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='2'>
        <ol type='i' start='2'>
            <li>Summary of significant accounting policies (Cont’d)
<?php
$section->addText("2.2 Summary of significant accounting policies (Cont’d)", $fontstyleName, $paragraphStyle);
?>
            </li>
            <br>
            <ol type='a' start='8'>
                <li>Impairment of non-financial assets
<?php
$section->addListItem("Impairment of non-financial assets", 3, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <p>Non-financial assets are tested for impairment whenever there is any objective evidence or indication that these assets may be impaired.
                    <?php
                    $section->addText("Non-financial assets are tested for impairment whenever there is any objective evidence or indication that these assets may be impaired."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>
                <p>For the purpose of impairment testing, the recoverable amount (i.e. the higher of the fair value less cost to sell and the value-in-use) is determined on an
                    individual asset basis unless the asset does not generate cash flows that are largely independent of those from other assets. If this is the case, the
                    recoverable amount is determined for the CGU to which the asset belongs.
<?php
$section->addText("For the purpose of impairment testing, the recoverable amount (i.e. the higher of the fair value less cost to sell and the value-in-use) is determined on an individual asset basis unless the asset does not generate cash flows that are largely independent of those from other assets. If this is the case, the recoverable amount is determined for the CGU to which the asset belongs."
        , $fontstyleName, $paragraphStyle);
?>
                </p>
                <p>If the recoverable amount of the asset (or CGU) is estimated to be less than its carrying amount, the carrying amount of the asset (or CGU) is reduced to
                    its recoverable amount.
                    <?php
                    $section->addText("If the recoverable amount of the asset (or CGU) is estimated to be less than its carrying amount, the carrying amount of the asset (or CGU) is reduced to its recoverable amount."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>
                <p>The difference between the carrying amount and recoverable amount is recognised as an impairment loss in profit or loss.
                    <?php
                    $section->addText("The difference between the carrying amount and recoverable amount is recognised as an impairment loss in profit or loss."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>
                <p>An impairment loss for an asset is reversed only if, there has been a change in the estimates used to determine the asset’s recoverable amount since the last
                    impairment loss was recognised. The carrying amount of this asset is increased to its revised recoverable amount, provided that this amount does not exceed
                    the carrying amount that would have been determined (net of any accumulated amortisation or depreciation) had no impairment loss been recognised for the asset in prior years.
<?php
$section->addText("An impairment loss for an asset is reversed only if, there has been a change in the estimates used to determine the asset’s recoverable amount since the last impairment loss was recognised. The carrying amount of this asset is increased to its revised recoverable amount, provided that this amount does not exceed the carrying amount that would have been determined (net of any accumulated amortisation or depreciation) had no impairment loss been recognised for the asset in prior years."
        , $fontstyleName, $paragraphStyle);
?>
                </p>
                <p>A reversal of impairment loss for an asset is recognised in profit or loss.
                    <?php
                    $section->addText("A reversal of impairment loss for an asset is recognised in profit or loss."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>

                <li>Financial assets
                    <?php
                    $section->addListItem("Financial assets", 3, $fontstyleName, $listingStyle);
                    ?>
                </li>
                <br>
                <ol type='i'>
                    <li>Classification
<?php
$section->addListItem("Classification", 5, $fontstyleName, $romanListingStyle);
?>
                    </li>
                    <br>
                    <p>The classification of financial assets depends on the purpose for which the assets were acquired. Management determines the classification of its financial
                        assets at initial recognition.
<?php
$section->addText("The classification of financial assets depends on the purpose for which the assets were acquired. Management determines the classification of its financial assets at initial recognition."
        , $fontstyleName);
?>
                    </p>
                    <p>Loans and receivables
                        <?php
                        $section->addText("Loans and receivables", $fontstyleName);
                        ?>
                    </p>
                    <p>Loans and receivables are non-derivative financial assets with fixed or determinable payments that are not quoted in an active market. They are presented as current assets,
                        except for those maturing later than 12 months after the end of financial reporting date which are presented as non-current assets. Loans and receivables are presented as
                        “trade receivables” and “cash and bank balances” on the statement of financial position.
<?php
$section->addText("Loans and receivables are non-derivative financial assets with fixed or determinable payments that are not quoted in an active market. They are presented as current assets,except for those maturing later than 12 months after the end of financial reporting date which are presented as non-current assets. Loans and receivables are presented as “trade receivables” and “cash and bank balances” on the statement of financial position."
        , $fontstyleName);
?>
                    </p>
                </ol>

            </ol>
        </ol>
    </ol>
    <br>
    <br>
</div>
<h1> Page 12</h1>
<div name='twelvePage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='2'>
        <ol type='i' start='2'>
            <li>Summary of significant accounting policies (Cont’d)
<?php
$section->addText("2.2 Summary of significant accounting policies (Cont’d)", $fontstyleName, $paragraphStyle);
?>
            </li>
            <br>
            <ol type='a' start='8'>
                <li>Financial assets (Cont’d)
<?php
//need to repeat order
$section->addText("Financial assets (Cont’d)", $fontstyleName);
//$section->addListItem("Financial assets (Cont’d)", 3, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <ol type='i' start='2'>
                    <li>Recognition and derecognition
<?php
$section->addListItem("Recognition and derecognition", 5, $fontstyleName, $romanListingStyle);
?>
                    </li>
                    <br>
                    <p>Regular way purchases and sales of financial assets are recognised on trade-date - the date on which the Company commits to purchase or sell the asset.
                        <?php
                        $section->addText("Regular way purchases and sales of financial assets are recognised on trade-date - the date on which the Company commits to purchase or sell the asset."
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>
                    <p>Financial assets are derecognised when the rights to receive cash flows from the financial assets have expired or have been transferred and the Company has
                        transferred substantially all risks and rewards of ownership. On disposal of a financial asset, the difference between the carrying amount and the sale
                        proceeds is recognised in the profit or loss.
<?php
$section->addText("Financial assets are derecognised when the rights to receive cash flows from the financial assets have expired or have been transferred and the Company has transferred substantially all risks and rewards of ownership. On disposal of a financial asset, the difference between the carrying amount and the sale proceeds is recognised in the profit or loss."
        , $fontstyleName, $paragraphStyle);
?>
                    </p>

                    <li>Initial measurement
                        <?php
                        $section->addListItem("Initial measurement", 5, $fontstyleName, $romanListingStyle);
                        ?>
                    </li>
                    <br>
                    <p>Financial assets are initially recognised at fair value plus transaction costs.
                        <?php
                        $section->addText("Financial assets are initially recognised at fair value plus transaction costs."
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>

                    <li>Subsequent measurement
                        <?php
                        $section->addListItem("Subsequent measurement", 5, $fontstyleName, $romanListingStyle);
                        ?>
                    </li>
                    <p>Loans and receivables and financial assets are subsequently carried at amortised cost using the effective interest method.
                        <?php
                        $section->addText("Loans and receivables and financial assets are subsequently carried at amortised cost using the effective interest method."
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>

                    <li>Impairment
                        <?php
                        $section->addListItem("Impairment", 5, $fontstyleName, $romanListingStyle);
                        ?>
                    </li>
                    <p>The Company assesses at each end of financial reporting date whether there is objective evidence that a financial asset or a group of financial assets is impaired
                        and recognises an allowance for impairment when such evidence exists.
                        <?php
                        $section->addText("The Company assesses at each end of financial reporting date whether there is objective evidence that a financial asset or a group of financial assets is impaired and recognises an allowance for impairment when such evidence exists."
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>
                    <p>Loans and receivables
                        <?php
                        $section->addText("Loans and receivables", $fontstyleName, $paragraphStyle);
                        ?>
                    </p>
                    <p>Significant financial difficulties of the debtor, probability that the debtor will enter bankruptcy, and default or significant delay in payments are objective
                        evidence that these financial assets are impaired.
                        <?php
                        $section->addText("Significant financial difficulties of the debtor, probability that the debtor will enter bankruptcy, and default or significant delay in payments are objective evidence that these financial assets are impaired."
                                , $fontstyleName, $paragraphStyle);
                        ?>
                    </p>
                    <p>The carrying amount of these assets is reduced through the use of an impairment allowance account, which is calculated as the difference between the carrying amount
                        and the present value of estimated future cash flows, discounted at the original effective interest rate. When the asset becomes uncollectible, it is written off
                        against the allowance account. Subsequent recoveries of amounts previously written off are recognised against the same line item in the income statement.
<?php
$section->addText("The carrying amount of these assets is reduced through the use of an impairment allowance account, which is calculated as the difference between the carrying amount and the present value of estimated future cash flows, discounted at the original effective interest rate. When the asset becomes uncollectible, it is written off against the allowance account. Subsequent recoveries of amounts previously written off are recognised against the same line item in the income statement."
        , $fontstyleName, $paragraphStyle);
?>
                    </p>
                    <p>The allowance for impairment loss account is reduced through the profit or loss in a subsequent period when the amount of impairment loss decreases and the related
                        decrease can be objectively measured. The carrying amount of the asset previously impaired is increased to the extent that the new carrying amount does not exceed
                        the amortised cost, had no impairment been recognised in prior periods.
<?php
$section->addText("The allowance for impairment loss account is reduced through the profit or loss in a subsequent period when the amount of impairment loss decreases and the related decrease can be objectively measured. The carrying amount of the asset previously impaired is increased to the extent that the new carrying amount does not exceed the amortised cost, had no impairment been recognised in prior periods."
        , $fontstyleName, $paragraphStyle);
?>
                    </p>
                </ol>
            </ol>
        </ol>
    </ol>
    <br>
    <br>
</div>
<h1> Page 13</h1>
<div name='thirteenPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='2'>
        <ol type='i' start='2'>
            <li>Summary of significant accounting policies (Cont’d)
<?php
$section->addText("2.2 Summary of significant accounting policies (Cont’d)", $fontstyleName, $paragraphStyle);
?>
            </li>
            <br>
            <ol type='a' start='10'>
                <li>Trade and other payables
<?php
$section->addListItem("Trade and other payables", 3, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <p>Trade and other payables represent liabilities for goods and services provided to the Company prior to the end of financial year which are unpaid. They are classified
                    as current liabilities if payment is due within one year or less (or in the normal operating cycle of the business if longer). Otherwise, they are presented as non-current
                    liabilities.
<?php
$section->addText("Trade and other payables represent liabilities for goods and services provided to the Company prior to the end of financial year which are unpaid. They are classified as current liabilities if payment is due within one year or less (or in the normal operating cycle of the business if longer). Otherwise, they are presented as non-current liabilities."
        , $fontstyleName);
?>

                </p>
                <!-- check if borrowing is in balance sheet-->
                <li>Borrowings
<?php
$section->addListItem("Borrowings", 3, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <p>Borrowings are presented as current liabilities unless the Company has an unconditional right to defer settlement for at least 12 months after the balance sheet date, in
                    which case they are presented as non-current liabilities.
<?php
$section->addText("Borrowings are presented as current liabilities unless the Company has an unconditional right to defer settlement for at least 12 months after the balance sheet date, in which case they are presented as non-current liabilities."
        , $fontstyleName, $paragraphStyle);
?>
                </p>
                <p>Borrowings are initially recognised at fair value (net of transaction costs) and subsequently carried at amortised cost. Any difference between the proceeds (net of transaction costs)
                    and the redemption value is recognised in profit or loss over the period of the borrowings using the effective interest method.
                    <?php
                    $section->addText("Borrowings are initially recognised at fair value (net of transaction costs) and subsequently carried at amortised cost. Any difference between the proceeds (net of transaction costs)and the redemption value is recognised in profit or loss over the period of the borrowings using the effective interest method."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>

                <li>Cash and cash equivalents
                    <?php
                    $section->addListItem("Cash and cash equivalents", 3, $fontstyleName, $listingStyle);
                    ?>
                </li>
                <br>
                <p>For the purpose presentation in the statement of cash flows, cash and cash equivalents include deposits with financial institutions which are subject to an insignificant risk of change
                    in value.
<?php
$section->addText("For the purpose presentation in the statement of cash flows, cash and cash equivalents include deposits with financial institutions which are subject to an insignificant risk of change"
        , $fontstyleName, $paragraphStyle);
?>
                </p>

                <li>Cash and cash equivalents
                    <?php
                    $section->addListItem("Cash and cash equivalents", 3, $fontstyleName, $listingStyle);
                    ?>
                </li>
                <br>
                <p>Dividends to the Company’s shareholders are recognized when the dividends are approved for payment.
                    <?php
                    $section->addText("Dividends to the Company’s shareholders are recognized when the dividends are approved for payment."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>

                <li>Currency translation
                    <?php
                    $section->addListItem("Currency translation", 3, $fontstyleName, $listingStyle);
                    ?>
                </li>
                <br>
                <ol type='i'>
                    <li>Functional and presentation currency
<?php
$section->addListItem("Functional and presentation currency", 6, $fontstyleName, $romanListingStyle);
?>
                    </li>
                    <br>
                    <p>Items included in the financial statements of the Company are measured using the currency of the primary economic environment in which the Company operates (‘the functional currency’).
                        The financial statements are presented in Singapore Dollar, which is the Company’s functional and presentation currency
<?php
$section->addText("Items included in the financial statements of the Company are measured using the currency of the primary economic environment in which the Company operates (‘the functional currency’).The financial statements are presented in Singapore Dollar, which is the Company’s functional and presentation currency"
        , $fontstyleName, $paragraphStyle);
?>
                    </p>
                </ol>
            </ol>
        </ol>
    </ol>
    <br>
    <br>
</div>
<h1> Page 14</h1>
<div name='fourteenPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='3'>
        <ol type='i' start='2'>
            <li>Summary of significant accounting policies (Cont’d)
<?php
$section->addText("2.2 Summary of significant accounting policies (Cont’d)", $fontstyleName, $paragraphStyle);
?>
            </li>
            <br>
            <ol type='a' start='14'>
                <li>Currency translation (Cont’d)
<?php
$section->addText("Currency translation (Cont’d)", $fontstyleName);
//$section->addListItem("Currency translation (Cont’d)", 2, $fontstyleName, $listingStyle, $paragraphStyle);
?>
                </li>
                <br>
                <ol type='i' start='2'>
                    <li>Transactions and balances
<?php
$section->addListItem("Transactions and balances", 6, $fontstyleName, $romanListingStyle);
?>
                    </li>
                    <br>
                    <p>Transactions in a currency other than the functional currency (“foreign currency”) are translated into the functional currency using the exchange rates at the dates of the transactions.
                        Currency translation differences from the settlement of such transactions and from the translation of monetary assets and liabilities denominated in foreign currencies at the closing rates
                        at the end of financial reporting date are recognised in the profit or loss, unless they arise from borrowings in foreign currencies, other currency instruments designated and qualifying as
                        net investment hedges and net investment in foreign operations. Those currency translation differences are recognised in the currency translation reserve in the financial statements and
                        transferred to profit or loss as part of the gain or loss on disposal of the foreign operation.
<?php
$section->addText("Transactions in a currency other than the functional currency (“foreign currency”) are translated into the functional currency using the exchange rates at the dates of the transactions.Currency translation differences from the settlement of such transactions and from the translation of monetary assets and liabilities denominated in foreign currencies at the closing rates at the end of financial reporting date are recognised in the profit or loss, unless they arise from borrowings in foreign currencies, other currency instruments designated and qualifying as net investment hedges and net investment in foreign operations. Those currency translation differences are recognised in the currency translation reserve in the financial statements and transferred to profit or loss as part of the gain or loss on disposal of the foreign operation."
        , $fontstyleName, $paragraphStyle);
?>

                    </p>
                </ol>

                <li>Share capital
<?php
$section->addListItem("Share capital ", 3, $fontstyleName, $listingStyle);
?>
                </li>
                <br>
                <p>Ordinary shares are classified as equity. Incremental costs directly attributable to the issuance of new ordinary shares are deducted against the share capital account.
                    <?php
                    $section->addText("Ordinary shares are classified as equity. Incremental costs directly attributable to the issuance of new ordinary shares are deducted against the share capital account."
                            , $fontstyleName, $paragraphStyle);
                    ?>
                </p>
            </ol>
        </ol>
        <li>CRITICAL ACCOUNTING ESTIMATES, ASSUMPTIONS AND JUDGEMENTS
<?php
$section->addListItem("CRITICAL ACCOUNTING ESTIMATES, ASSUMPTIONS AND JUDGEMENTS", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>Estimates, assumptions and judgements are continually evaluated and are based on historical experience and other factors, including expectations of future events that are believed to be reasonable under the circumstances.
            <?php
            $section->addText("Estimates, assumptions and judgements are continually evaluated and are based on historical experience and other factors, including expectations of future events that are believed to be reasonable under the circumstances."
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>

        <ol type='a'>
            <li>Critical accounting estimates and assumptions
<?php
$section->addListItem("Critical accounting estimates and assumptions", 5, $fontstyleName, $listingStyle);
?>
            </li>
            <br>
            <p>During the financial year, the management did not make any critical estimates and assumptions that had a significant effect on the amounts recognised in the financial statements
                <?php
                $section->addText("During the financial year, the management did not make any critical estimates and assumptions that had a significant effect on the amounts recognised in the financial statements"
                        , $fontstyleName, $paragraphStyle);
                ?>
            </p>

            <li>Critical judgements in applying the Company’s accounting policies
                <?php
                $section->addListItem("Critical judgements in applying the Company’s accounting policies", 5, $fontstyleName, $listingStyle);
                ?>
            </li>
            <br>
            <p>In the process of applying the Company’s accounting policies, the directors are of the opinion that there is no application of critical judgement on the amounts recognised in the financial statements.
                <?php
                $section->addText("In the process of applying the Company’s accounting policies, the directors are of the opinion that there is no application of critical judgement on the amounts recognised in the financial statements."
                        , $fontstyleName, $paragraphStyle);
                ?>
            </p>
        </ol>
    </ol>
    <br>
    <br>
</div>
<h1> Page 15</h1>
<div name='fifteenPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='4'>
        <li>OTHER INCOME
<?php
$section->addListItem("OTHER INCOME", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>Realised exchange gain - trade</p>
        <p>Unrealised exchange gain</p>

        <li>PROFIT BEFORE INCOME TAX
<?php
$section->addListItem("PROFIT BEFORE INCOME TAX", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>This is determined after charging: <br>
            Depreciation of plant and equipment (Note 11)<br>
            Employee’s compensation (Note 7)<br>
            Realised exchange loss - trade</p>

        <li>FINANCE EXPENSE
<?php
$section->addListItem("FINANCE EXPENSE", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>Interest expense on bank borrowings</p>

        <li>EMPLOYEE COMPENSATION
<?php
$section->addListItem("EMPLOYEE COMPENSATION", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>Director’s remuneration <br>
            Salaries <br>
            Other benefits</p>
    </ol>
    <br>
    <br>
</div>
<h1> Page 16</h1>
<div name='sixteenPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='8'>
        <li>INCOME TAXES
<?php
$section->addListItem("INCOME TAXES", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <ol type='a'>
            <li>Income tax expense</li><br>
            <p>Tax expense attributable to profit is made up of:<br>
                Current income tax expenses<br>
                Under provision in prior year</p>
            <p>The tax expense on profit differs from the amount that would arise using the Singapore standard rate of income tax as follows:</p>
            <p>Profit  before income tax</p>

            <p>Tax calculated at tax rate of 17% (2015: 17%)<br>
                Effects of:<br>
                - expenses not deductible for tax purposes<br>
                - income not subject to tax <br>
                - deferred tax liabilities not recognised <br>
                - Capital and PIC enhanced allowances <br>
                - tax exemption <br>
                - CIT rebate <br>
                - under provision in prior year</p>
            <p>Tax expense</p>

            <li>Movement in current income tax liabilities:</li><br>
            <p>Beginning of financial year <br>
                Income tax paid<br>
                Current year tax expense<br>
                Under provision in prior year<br>
                End of financial year</p>
        </ol>
    </ol>
    <br>
    <br>
</div>
<h1> Page 17</h1>
<div name='seventeenPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='9'>
        <li>TRADE AND OTHER RECEIVABLES
<?php
$section->addListItem("TRADE AND OTHER RECEIVABLES", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>Trade receivables</p>
        <p>Deposits <br>
            Prepayments <br>
            Amount owing from a shareholder</p>
        <p>The amount owing from a shareholder is unsecured, non-trade, interest free and repayable on demand.</p>

        <li>PLANT AND EQUIPMENT
<?php
$section->addListItem("PLANT AND EQUIPMENT ", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p><b>Cost:</b><br>
            As at <?php echo date('F d Y', strtotime($firstBalanceDate)) ?><br>
            Additions<br>
            As at <?php echo date('F d Y', strtotime($secondBalanceDate)) ?><br>
            Additions<br>
            As at <?php echo date('F d Y', strtotime($thirdBalanceDate)) ?><br>
        </p>
        <p><b>Accumulated depreciation:</b><br>
            As at <?php echo date('F d Y', strtotime($firstBalanceDate)) ?><br>
            Charge for the financial period<br>
            As at <?php echo date('F d Y', strtotime($secondBalanceDate)) ?><br>
            Charge for the financial year<br>
            As at <?php echo date('F d Y', strtotime($thirdBalanceDate)) ?><br>
        </p>
        <p><b>Net book value:</b><br>
            As at <?php echo date('F d Y', strtotime($thirdBalanceDate)) ?><br>
            As at <?php echo date('F d Y', strtotime($secondBalanceDate)) ?><br>
        </p>
    </ol>
    <br>
    <br>
</div>
<h1> Page 18</h1>
<div name='eighteenPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='11'>
        <li>TRADE AND OTHER PAYABLES
<?php
$section->addListItem("TRADE AND OTHER PAYABLES ", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>Trade payables</p>
        <p><u>Other payables</u><br>
            GST payables<br>
            Accruals<br>
            Amount owing to a shareholder</p>

        <li>BORROWINGS
<?php
$section->addListItem("BORROWINGS ", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>As at beginning of financial year</p>
        <p>Proceeds from borrowings<br>
            Less: Repayment of borrowings</p>
        <p>As at end of financial year</p>
        <p>Current<br>
            Non-current</p>

        <li>SHARE CAPITAL
<?php
$section->addListItem("SHARE CAPITAL ", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>Issued and fully paid:<br>
            At beginning of financial year<br>
            Issuance of ordinary shares</p>
        <p>At end of financial  year/period</p>
        <p>All issued ordinary shares are fully paid. The newly issued shares rank pari passu in all respects with the previously issued shares. There is no par value for the ordinary share. The holder of the ordinary share
            is entitled to receive dividends as and when declared by the Company.</p>
    </ol>
    <br>
    <br>
</div>
<h1> Page 19</h1>
<div name='nineteenPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='14'>
        <li>FINANCIAL RISK MANAGEMENT
<?php
$section->addListItem("FINANCIAL RISK MANAGEMENT ", 0, $fontstyleName, $nestedListStyle);
?>
        </li>
        <br>
        <p>The Company’s activities expose it to a variety of financial risks. The Company’s overall business strategies, tolerance risk and general risk management philosophy are determined by directors in accordance with
            prevailing economic and operating conditions.
<?php
$section->addText("The Company’s activities expose it to a variety of financial risks. The Company’s overall business strategies, tolerance risk and general risk management philosophy are determined by directors in accordance with prevailing economic and operating conditions."
        , $fontstyleName, $paragraphStyle);
?>
        </p>

        <p><u>Currency risk</u>
            <?php
            $textrun = $section->addTextRun();
            $textrun->addText(htmlspecialchars("Currency risk"), array('underline' => 'single'));
            ?>
        </p>
        <p>The Company’s exposure to foreign exchange risk is minimal as transactions are predominantly denominated in <?php echo $currency; ?>, being the functional currency of the Company.
            <?php
            $section->addText("The Company’s exposure to foreign exchange risk is minimal as transactions are predominantly denominated in " . $currency . ", being the functional currency of the Company."
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>

        <p><u>Interest rate risk</u>
            <?php
            $textrun = $section->addTextRun();
            $textrun->addText(htmlspecialchars("Interest rate risk"), array('underline' => 'single'));
            ?>
        </p>
        <p>Cash flow interest rate risk is the risk that the future cash flows of a financial instrument will fluctuate because of changes in market interest rates. Fair value interest rate risk is the risk that the fair
            value of a financial instrument will fluctuate due to changes in market interest rates. As the Company has no significant interest bearing assets or liabilities, the Company’s income and operating cash flows
            are substantially independent of changes in market interest rates.
<?php
$section->addText("Cash flow interest rate risk is the risk that the future cash flows of a financial instrument will fluctuate because of changes in market interest rates. Fair value interest rate risk is the risk that the fair value of a financial instrument will fluctuate due to changes in market interest rates. As the Company has no significant interest bearing assets or liabilities, the Company’s income and operating cash flows are substantially independent of changes in market interest rates."
        , $fontstyleName, $paragraphStyle);
?>
        </p>

        <p><u>Liquidity risk</u>
            <?php
            $textrun = $section->addTextRun();
            $textrun->addText(htmlspecialchars("Liquidity risk"), array('underline' => 'single'));
            ?>
        </p>
        <p>Prudent liquidity management implies maintaining sufficient cash and the availability of funding through an adequate amount of committed credit facilities. The Company maintains sufficient cash balances to
            provide flexibility in meeting its day to day funding requirements. Cash and cash equivalents are placed with credit worthy institutions.
            <?php
            $section->addText("Prudent liquidity management implies maintaining sufficient cash and the availability of funding through an adequate amount of committed credit facilities. The Company maintains sufficient cash balances to provide flexibility in meeting its day to day funding requirements. Cash and cash equivalents are placed with credit worthy institutions."
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>
        <p>The Company’s financial liabilities are due less than 1 year based on the remaining period from the reporting date to the contractual maturity date.  Balances due within 12 months equal their carrying balances
            as the impact of discounting is not significant.
            <?php
            $section->addText("The Company’s financial liabilities are due less than 1 year based on the remaining period from the reporting date to the contractual maturity date.  Balances due within 12 months equal their carrying balances as the impact of discounting is not significant."
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>

        <p><u>Fair value measurements</u>
            <?php
            $textrun = $section->addTextRun();
            $textrun->addText(htmlspecialchars("Fair value measurements"), array('underline' => 'single'));
            ?>
        </p>
        <p>The Company does not have any financial instruments as at end of the financial year which are measured at fair value. The carrying values of other receivables and other payables are assumed to approximate
            their fair values.
            <?php
            $section->addText("The Company does not have any financial instruments as at end of the financial year which are measured at fair value. The carrying values of other receivables and other payables are assumed to approximate their fair values."
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>

        <p><u>Credit risk</u>
            <?php
            $textrun = $section->addTextRun();
            $textrun->addText(htmlspecialchars("Credit risk"), array('underline' => 'single'));
            ?>
        </p>
        <p>Credit risk is the risk that companies and other parties will be unable to meet their obligations to the Company resulting in financial loss to the Company. The Company manages such risks by dealing with a
            diverse of credit-worthy counterparties to mitigate any significant concentration of credit risk. Credit policy includes assessing and evaluation of existing and new customers' credit reliability and monitoring
            of receivable collections. The Company places its cash and cash equivalents with creditworthy institutions.
<?php
$section->addText("Credit risk is the risk that companies and other parties will be unable to meet their obligations to the Company resulting in financial loss to the Company. The Company manages such risks by dealing with a diverse of credit-worthy counterparties to mitigate any significant concentration of credit risk. Credit policy includes assessing and evaluation of existing and new customers' credit reliability and monitoring of receivable collections. The Company places its cash and cash equivalents with creditworthy institutions."
        , $fontstyleName, $paragraphStyle);
?>
        </p>
    </ol>
    <br>
    <br>
</div>
<h1> Page 20</h1>
<div name='twentyPage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='14'>
        <li>FINANCIAL RISK MANAGEMENT (CONT’D)
<?php
$section->addListItem("FINANCIAL RISK MANAGEMENT (CONT’D)", 0, $fontstyleName, $listingStyle, $paragraphStyle);
?>
        </li>
        <br>
        <p><u>Credit risk (Cont’d)</u>
            <?php
            $textrun = $section->addTextRun();
            $textrun->addText(htmlspecialchars("Credit risk (Cont’d)"), array('underline' => 'single'));
            ?>
        </p>
        <p>The maximum exposure to credit risk in the event that the counterparties fail to perform the obligations as at the end of the financial period in relation to each class of financial assets is the carrying
            amount of these assets in the statement of financial position.
            <?php
            $section->addText("The maximum exposure to credit risk in the event that the counterparties fail to perform the obligations as at the end of the financial period in relation to each class of financial assets is the carrying amount of these assets in the statement of financial position."
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>
        <p>The credit risk for receivables based on the information provided to key management is as follows:
            <?php
            $section->addText("The credit risk for receivables based on the information provided to key management is as follows:"
                    , $fontstyleName, $paragraphStyle);
            ?>
        </p>

        <ol type='i'>
            <li>Financial assets that are neither past due nor impaired
<?php
$section->addListItem("Financial assets that are neither past due nor impaired", 1, $fontstyleName, $listingStyle, $paragraphStyle);
?>
            </li>
            <br>
            <p>Bank deposits that are neither past due nor impaired are mainly deposits with banks with high credit-ratings assigned by international credit-rating agencies. Other receivables that are neither past due
                nor impaired are substantially companies with a good collection track record with the Company.
<?php
$section->addText("Bank deposits that are neither past due nor impaired are mainly deposits with banks with high credit-ratings assigned by international credit-rating agencies. Other receivables that are neither past due nor impaired are substantially companies with a good collection track record with the Company."
        , $fontstyleName, $paragraphStyle);
?>
            </p>

            <li>Financial assets that are past due and/or impaired
                <?php
                $section->addListItem("Financial assets that are past due and/or impaired", 1, $fontstyleName, $listingStyle, $paragraphStyle);
                ?>
            </li>
            <br>
            <p>There is no other class of financial assets that is past due and/or impaired.
                <?php
                $section->addText("There is no other class of financial assets that is past due and/or impaired."
                        , $fontstyleName, $paragraphStyle);
                ?>
            </p>
            <br>
        </ol>

        <p><u>Capital risk</u>
<?php
$textrun = $section->addTextRun();
$textrun->addText(htmlspecialchars("Capital risk"), array('underline' => 'single'));
?>
        </p>
        <p>The Company’s objectives when managing capital are:
            <?php
            $section->addText("The Company’s objectives when managing capital are:", $fontstyleName, $paragraphStyle);
            ?>
        </p>

        <!-- need to add in phpWords unordered list-->
        <ul>
            <li>to safeguard the Company’s ability to continue as a going concern, so that it can continue to provide returns for shareholders and benefits for other stakeholders, and</li>
            <li>to provide an adequate return to shareholders by pricing products and services commensurately with the level of risk.</li>
        </ul>

        <p>The capital structure of the Company consists primarily of equity, comprising issued share capital.
<?php
$section->addText("The capital structure of the Company consists primarily of equity, comprising issued share capital."
        , $fontstyleName);
?>
        </p>
        <p>The Company manages its capital structure and makes adjustment to it in light of changes in economic conditions. It may maintain or adjust its capital structure through the payment of dividends, return of capital
            or issue of new shares.
            <?php
            $section->addText("The Company manages its capital structure and makes adjustment to it in light of changes in economic conditions. It may maintain or adjust its capital structure through the payment of dividends, return of capital or issue of new shares."
                    , $fontstyleName);
            ?>
        </p>

        <li>RELATED PARTY TRANSACTIONS
            <?php
            $section->addListItem("RELATED PARTY TRANSACTIONS ", 0, $fontstyleName, $nestedListStyle);
            ?>
        </li>
        <br>
        <p>Related parties comprise mainly of companies which are controlled or significantly influenced by the Company’s key management personnel and their close family members.
            <?php
            $section->addText("Related parties comprise mainly of companies which are controlled or significantly influenced by the Company’s key management personnel and their close family members."
                    , $fontstyleName);
            ?>
        </p>
        <p>Key management personnel of the Company are those persons having the authority and responsibility for planning, directing and controlling activities of the Company.  The directors and executive officers of the
            Company are considered as key management personnel of the Company.
            <?php
            $section->addText("Key management personnel of the Company are those persons having the authority and responsibility for planning, directing and controlling activities of the Company.  The directors and executive officers of the Company are considered as key management personnel of the Company."
                    , $fontstyleName);
            ?>
        </p>
    </ol>
    <br>
    <br>
</div>
<h1> Page 21</h1>
<div name='twentyonePage'>
    <b><?php echo strtoupper($companyName); ?></b>
    <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
    <b><?php
    echo "NOTES TO THE FINANCIAL STATEMENTS";
    echo "<br>";
    echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
    $section->addText("NOTES TO THE FINANCIAL STATEMENTS<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
    $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
    ?></b>
    <hr>
    <br>
    <br>
    <ol start='15'>
        <li>RELATED PARTY TRANSACTIONS (CONT’D)
<?php
$section->addListItem("RELATED PARTY TRANSACTIONS (CONT’D)", 0, $fontstyleName, $listingStyle, $paragraphStyle);
?>
        </li>
        <br>
        <p>The inter-company balances are unsecured and interest-free, unless stated otherwise, and are subject to the normal credit terms of the respective parties and are
            repayable on demand.
<?php
$section->addText("The inter-company balances are unsecured and interest-free, unless stated otherwise, and are subject to the normal credit terms of the respective parties and are repayable on demand."
        , $fontstyleName, $paragraphStyle);
?>
        </p>

        <p><u>Key management personnel compensation</u>
            <?php
            $textrun = $section->addTextRun();
            $textrun->addText(htmlspecialchars("Key management personnel compensation"), array('underline' => 'single'));
            ?>
        </p>
        <p>Director’s remuneration
            <?php
            $section->addText("Director’s remuneration", $fontstyleName);
            ?>
        </p>

        <li>NEW OR REVISED ACCOUNTING STANDARDS AND INTERPRETATIONS
            <?php
            $section->addListItem("NEW OR REVISED ACCOUNTING STANDARDS AND INTERPRETATIONS", 0, $fontstyleName, $nestedListStyle);
            ?>
        </li>
        <br>
        <p>Certain new standards, amendments and interpretations to existing standards have been published and are mandatory for the Company’s accounting periods beginning on
            or after 1 January 2017  or later periods and which the Company has not early adopted.
<?php
$section->addText("Certain new standards, amendments and interpretations to existing standards have been published and are mandatory for the Company’s accounting periods beginning on or after 1 January 2017  or later periods and which the Company has not early adopted."
        , $fontstyleName);
?>
        </p>
        <p>The management anticipates that the adoption of the new amendments to FRS in the future periods will not have a material impact on the financial statements of the
            Company and of the Company in the period of their initial adoption.
            <?php
            $section->addText("The management anticipates that the adoption of the new amendments to FRS in the future periods will not have a material impact on the financial statements of the Company and of the Company in the period of their initial adoption."
                    , $fontstyleName);
            ?>
        </p>

        <li>COMPARATIVE FIGURES
            <?php
            $section->addListItem("COMPARATIVE FIGURES ", 0, $fontstyleName, $nestedListStyle);
            ?>
        </li>
        <br>
        <p>The management anticipates that the adoption of the new amendments to FRS in the future periods will not have a material impact on the financial statements of the
            Company and of the Company in the period of their initial adoption.
<?php
$section->addText("The management anticipates that the adoption of the new amendments to FRS in the future periods will not have a material impact on the financial statements of the Company and of the Company in the period of their initial adoption."
        , $fontstyleName, $paragraphStyle);
?>
        </p>

        <li>COMPARATIVE FIGURES
            <?php
            $section->addListItem("COMPARATIVE FIGURES ", 0, $fontstyleName, $nestedListStyle);
            ?>
        </li>
        <br>
        <p>The financial statements cover the financial period since incorporation on 1 July 2014 to 31 December 2015. This being the first set of financial statements,
            there are no comparative.
<?php
$section->addText("The financial statements cover the financial period since incorporation on 1 July 2014 to 31 December 2015. This being the first set of financial statements,there are no comparative."
        , $fontstyleName, $paragraphStyle);
?>
        </p>
    </ol>
    <br>
    <br>
    <p>-------------------------------- End of unaudited financial statements --------------------------------
<?php
$section->addText("End of unaudited financial statements", $fontstyleName, $paragraphStyle);
?>
    </p>
</div>
<h1> Page 22</h1>
<div name='twentytwoPage'>
    <center><b><?php echo strtoupper($companyName); ?></b>
        <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
        <b><?php
        echo "DETAILED INCOME STATEMENT";
        echo "<br>";
        echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
        $section->addText("DETAILED INCOME STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
        $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
        ?></b>
        <hr>
        <br>
        <br></center>
    <p>Revenue</p>
    <p>Less: Cost of sales<br>
        <b>Gross profit</b></p>
    <p><u>Add: Other income:</u><br>
        Exchange gain - trade<br>
        Exchange gain - non-trade</p>
    <p><u>Less: Expenses</u>
        Administrative expenses (Appendix II)<br>
        Distribution and marketing expenses (Appendix II)<br>
        Finance expense (Appendix II)</p>
    <p><b>Profit before income  tax</b></p>
    <br>
    <br>
    <p><center>Does not form part of the unaudited financial statements </center></p>
</div>
<h1> Page 23</h1>
<div name='twentythreePage'>
    <center><b><?php echo strtoupper($companyName); ?></b>
        <br/>
<?php
$section = $phpWord->addSection();
$section->addText(strtoupper($companyName), $fontStyleBlack);
?>
        <b><?php
        echo "DETAILED INCOME STATEMENT";
        echo "<br>";
        echo "FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('F d Y', strtotime($yearEnd)));
        $section->addText("DETAILED INCOME STATEMENT<w:br/>FOR THE FINANCIAL YEAR ENDED " . strtoupper(date('d F Y', strtotime($yearEnd))), $fontStyleBlack);
        $section->addLine(['weight' => 0.5, 'width' => 460, 'height' => 0]);
        ?></b>
        <hr>
        <br>
        <br></center>
    <p><u>Administrative expenses</u><br>
        Accounting fee<br>
        Administrative expenses<br>
        Bank charges<br>
        Compilation fee<br>
        Depreciation<br>
        Director’s remuneration<br>
        Director’s remuneration<br>
        Employment pass<br>
        Exchange loss - trade<br>
        Freight charges<br>
        Insurance<br>
        Internet expenses<br>
        Late penalty<br>
        Nominee director fee<br>
        Office supplies<br>
        Postage and courier<br>
        Professional fee<br>
        Printing and stationery<br>
        Rental<br>
        Salaries<br>
        Secretarial fee<br>
        Skill development levy & SINDA<br>
        Taxation fee
    </p>
    <p><u>Distribution and marketing expenses</u><br>
        Travelling expenses<br>
        Transportation<br>
        Telephone expenses<br></p>
    <p><u>Finance expenses</u><br>
        Interest on bank borrowings</p>
</div>

</body>

<?php
//include 'footer.php';
// Saving the document as OOXML file
$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('preview.docx');

//header("Location: " . URL . "download.php"); /* Redirect browser */
//ob_end_flush();
?>
