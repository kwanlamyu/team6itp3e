<?php include '../general/header.php';?>
<?php include '../general/navigation_accountant.php';?>


<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// KOKHOE
$data = $_POST['data'];
$numberOfSheets = $_POST['numberOfYears'];
$years = $_POST['years'];
$companyName = $_POST['companyName'];

// YOKYEE - Declare all variables for form
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

$tempDirectorArray = $_POST['tempDirectorArray'];
$tempDateArray = $_POST['tempDateArray'];
$tempShareArray = $_POST['tempShareArray'];

$directorName = explode(",", $tempDirectorArray);
$directorAppointedDate = explode(",", $tempDateArray);
$directorShare = explode(",", $tempShareArray);

echo "Director Name:";
print_r($tempDirectorArray);
echo "<br/>";
echo "Appointed Date:";
print_r($directorAppointedDate);
echo "<br/>";
echo "Director Share:";
print_r($directorShare);

$accountArray = array();
$valueArray = array();
$categoryArray = array();

for ($aa = 0; $aa < $numberOfSheets; $aa++) {
    // Loop Category
    for ($ab = 0; $ab < count($data[$aa]); $ab++) {
        array_push($categoryArray, $data[$aa][$ab][2]);
        array_push($accountArray, $aa . $data[$aa][$ab][0]);
        array_push($valueArray, $data[$aa][$ab][1]);
    }
}

$uniqueCategoryArray = array("Other Income", "Profit Before Income Tax", "Finance Expense", "Employee Compensation", "Income Taxes", "Trade and other payables", "Borrowings", "Trade and other receivables");
$tempUniqueCategoryArray = array_unique($categoryArray);
foreach ($tempUniqueCategoryArray as $insert) {
    array_push($uniqueCategoryArray, $insert);
}
?>


<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
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

        <p id="data">Hello World!</p>
        <p id="test"></p>

   </div>
							</div>
							</div>
							</div>
							<!--end::Portlet-->
					</div>
					<!-- END: Subheader -->
    </div>
<script type="text/javascript">
    var accountArray = <?php echo json_encode($accountArray); ?>;
    var accountArrayCount = <?php echo count($accountArray); ?>;
    var valueArray = <?php echo json_encode($valueArray); ?>;
    var categoryArrayCount = <?php echo count($uniqueCategoryArray); ?>;
    var categoryArray = <?php echo json_encode($uniqueCategoryArray); ?>;
    var dateArray = <?php echo json_encode($years); ?>;
    var dateArrayCount = <?php echo count($years); ?>;

    // KOKHOE
    var data = <?php echo json_encode($data); ?>;
    var numberOfSheets = <?php echo $numberOfSheets; ?>;
    var years = <?php echo json_encode($years); ?>;
    var yearsCount = <?php echo count($years); ?>;
    var companyName = "<?php echo $companyName; ?>";

    // YOKYEE
    var companyregID = "<?php echo $companyregID; ?>";
    var yearEnd = "<?php echo $yearEnd; ?>";
    var noOfDirectors = "<?php echo $noOfDirectors; ?>";
    var directorName1 = "<?php echo $directorName1; ?>";
    var directorName1ApptDate = "<?php echo $directorName1ApptDate; ?>";
    var director1Share = "<?php echo $director1Share; ?>";
    var todayDate = "<?php echo $todayDate; ?>";
    var firstBalanceDate = "<?php echo $firstBalanceDate; ?>";
    var secondBalanceDate = "<?php echo $secondBalanceDate; ?>";
    var thirdBalanceDate = "<?php echo $thirdBalanceDate; ?>";
    var companyPA = "<?php echo $companyPA; ?>";
    var companyAddress = "<?php echo $companyAddress; ?>";
    var frsDate = "<?php echo $frsDate; ?>";
    var currency = "<?php echo $currency; ?>";

    var counter = 0;
    var storeCategory = [];
    var storeAccount = [];
    var count = 0;
    var incomeTaxArray = ["Income tax expense", "Movement in current income tax liabilities"];
    var incomeTaxKeyWords = ["Current income tax expenses / Current year tax expense", "Under provision in prior year", "Tax calculated at tax rate of 17%(2015: 17%)",
        "- expenses not deductible for tax purposes", "- income not subject to tax", "- deferred tax liabilities nto recognised", "- capital and PIC enhanced allowances",
        "- utilisation of tax losses in prior year", "- tax exemption", "- CIT rebate", "- under provision in prior year", "Income tax paid"];
    var borrowingsKeywords = ["As at beginning of financial year", "Proceeds from borrowings", "Repayment of borrowings", "As at end of financial year", "Current", "Non-current"];
//------------------------------------------------------------------------------------------

    // Creation of form
    var formElement = "<form id='form' name='passDataForm' method='post' action='temp_real.php'>\n\
                    <b>Category:</b> <input type='text' name='category' value='" + categoryArray[counter] + "' id='categoryLooper'><br>\n\
                    ";

    formElement += "<br><br>\n\
                    <b>TB Accounts:</b>\n\
                    <br>";

    for (var i = 0; i < accountArrayCount; i++) {
        formElement += "<input type='checkbox' id='" + i + "' name='account' value=' " + accountArray[i] + "#" + valueArray[i] + " '> " + accountArray[i].substring(1) + " " + valueArray[i] + "<br><br>";
    }

    formElement += "<p id='helpingWords'><b>Helping Keys:</b><br></p>\n\
                    <p id='inputField'> Manual Accounts: <input type='text' id='mAccount0'> \n\
                    Values: <input type='text' id='mValue0'>";

//    formElement += "<select id='dropdownYear'>";

    for (var t = 0; t < yearsCount; t++) {
//        formElement += "<option value='" + years[t] + "'>" + years[t] + "</option>";
        formElement += "<input type='radio' name='0' id='date0" + t + "' value='" + years[t] + "'>" + years[t];
    }

//    formElement += "</select>";

    formElement += "<br><br></p>\n\
                    <button type='button' id='addManualBtn'>Add Manual Input Boxes</button><br><br>\n\
                    <button type='button' id='skipBtn'>Skip</button>\n\
                    <button type='button' id='nextBtn'>Next & Submit</button>\n\
                    <button type='submit' id='submitBtn'>Submit</button>\n\
                    <input type='hidden' name='passData' value='" + storeCategory + "' id='passData'/>\n\
                    <input type='hidden' name='years[]' value='" + years + "'/>\n\
                    <input type='hidden' name='numberOfYears' value='" + numberOfSheets + "'/>\n\
                    <input type='hidden' name='companyName' value='" + companyName + "'/>\n\
                    <input type='hidden' name='companyregID' value='" + companyregID + "'/>\n\
                    <input type='hidden' name='yearEnd' value='" + yearEnd + "'/>\n\
                    <input type='hidden' name='noOfDirectors' value='" + noOfDirectors + "'/>\n\
                    <input type='hidden' name='directorName1' value='" + directorName1 + "'/>\n\
                    <input type='hidden' name='directorName1ApptDate' value='" + directorName1ApptDate + "'/>\n\
                    <input type='hidden' name='director1Share' value='" + director1Share + "'/>\n\
                    <input type='hidden' name='todayDate' value='" + todayDate + "'/>\n\
                    <input type='hidden' name='firstBalanceDate' value='" + firstBalanceDate + "'/>\n\
                    <input type='hidden' name='secondBalanceDate' value='" + secondBalanceDate + "'/>\n\
                    <input type='hidden' name='thirdBalanceDate' value='" + thirdBalanceDate + "'/>\n\
                    <input type='hidden' name='companyPA' value='" + companyPA + "'/>\n\
                    <input type='hidden' name='companyAddress' value='" + companyAddress + "'/>\n\
                    <input type='hidden' name='frsDate' value='" + frsDate + "'/>\n\
                    <input type='hidden' name='currency' value='" + currency + "'/>";

    for (var r = 0; r < data.length; r++) {
        for (var w = 0; w < data[r].length; w++) {
            for (var q = 0; q < data[r][w].length; q++) {
                formElement += "<input type='hidden' name='data[" + r + "][" + w + "][" + q + "]' value='" + data[r][w][q] + "' id='formData'/>";
            }

        }
    }

    formElement += "</form><div id='results'> </div>";

    document.getElementById("data").innerHTML = formElement;

//------------------------------------------------------------------------------------------


//------------------------------------------------------------------------------------------
    var clickAdd = document.getElementById('addManualBtn');
    var c = 1;
    clickAdd.onclick = function () {
        var tempAccountArray = [];
        var tempValueArray = [];
        var tempRadioArray = [];

        count++;
        for (i = 0; i < count; i++) {
            tempAccountArray.push(document.getElementById('mValue' + i).value);
            tempValueArray.push(document.getElementById('mAccount' + i).value);

            for (r = 0; r < years.length; r++) {
                if (document.getElementById('date' + i + r).checked) {
                    tempRadioArray.push(r);
                }
            }
        }

        document.getElementById('inputField').innerHTML += "Manual Accounts: <input type='text' id='mAccount" + count + "'> \n\
                                                            Values: <input type='text' id='mValue" + count + "'> ";


        for (t = 0; t < yearsCount; t++) {
            document.getElementById('inputField').innerHTML += "<input type='radio' name='" + c + "' id='date" + (count) + t + "' value='" + years[t] + "'>" + years[t];
        }
        c++;

        document.getElementById('inputField').innerHTML += "<br><br>";

        for (i = 0; i < count; i++) {
            document.getElementById('mValue' + i).value = tempAccountArray[i];
            document.getElementById('mAccount' + i).value = tempValueArray[i];

            document.getElementById('date' + i + tempRadioArray[i]).checked = true;

        }
    }
//------------------------------------------------------------------------------------------


//------------------------------------------------------------------------------------------
    var clickSkip = document.getElementById('skipBtn');
    clickSkip.onclick = function () {
        counter++;
        document.getElementById('categoryLooper').value = categoryArray[counter];

        // Display helping keys
        if (document.getElementById('categoryLooper').value === "Income Taxes") {
            for (g = 0; g < incomeTaxArray.length; g++) {
                document.getElementById('incomeTax').innerHTML += "<input type='radio' name='subIncomeTax' id='subIncomeTax" + g + "' value='" + incomeTaxArray[g] + "'> " + incomeTaxArray[g] + "<br>";
            }

            for (e = 0; e < incomeTaxKeyWords.length; e++) {
                document.getElementById('helpingWords').innerHTML += incomeTaxKeyWords[e] + "<br>";
            }

        } else if (document.getElementById('categoryLooper').value === "Borrowings") {
            for (h = 0; h < borrowingsKeywords.length; h++) {
                document.getElementById('helpingWords').innerHTML += borrowingsKeywords[h] + "<br>";
            }

        } else {
            document.getElementById('helpingWords').innerHTML = " ";
        }

    }
//------------------------------------------------------------------------------------------


//------------------------------------------------------------------------------------------
    var clickNext = document.getElementById('nextBtn');
    clickNext.onclick = function () {

        // Trying to store with * to separate the category (package)
        storeCategory.push("*");
        storeCategory.push(document.getElementById('categoryLooper').value);

        for (q = 0; q < accountArrayCount; q++) {
            if (document.getElementById(q).checked === true) {
                storeCategory.push(document.getElementById(q).value);
            }
        }

        // For manually enter part
        var manuallyEnterCount = count + 1;
        for (w = 0; w < manuallyEnterCount; w++) {
            if (document.getElementById('mValue' + w).value !== "" && document.getElementById('mAccount' + w).value !== "") {
                for (r = 0; r < years.length; r++) {
                    if (document.getElementById('date' + w + r).checked) {
                        storeCategory.push(" " + r + document.getElementById('mAccount' + w).value + "#" + document.getElementById('mValue' + w).value);
                    }
                }
            }
        }

        document.getElementById("passData").value = storeCategory;
        document.getElementById("test").innerHTML += document.getElementById("passData").value + "<br>";
        // Reset the form - clear all checked checkbox and input field
        document.getElementById("form").reset();
        // Change the data displayed for category
        counter++;
        document.getElementById('categoryLooper').value = categoryArray[counter];

        // Display helping keys
        if (document.getElementById('categoryLooper').value === "Income Taxes") {
            for (e = 0; e < incomeTaxKeyWords.length; e++) {
                document.getElementById('helpingWords').innerHTML += incomeTaxKeyWords[e] + "<br>";
            }

        } else if (document.getElementById('categoryLooper').value === "Borrowings") {
            for (h = 0; h < borrowingsKeywords.length; h++) {
                document.getElementById('helpingWords').innerHTML += borrowingsKeywords[h] + "<br>";
            }

        } else {
            document.getElementById('helpingWords').innerHTML = " ";
        }
    }
//------------------------------------------------------------------------------------------

</script>
<?php include '../general/footer_content.php';?>
	<?php include '../general/footer.php';?>