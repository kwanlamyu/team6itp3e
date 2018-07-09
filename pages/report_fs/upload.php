
<?php include '../general/header.php';?>
<?php include '../general/navigation_superadmin.php';?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">
        <?php
        $target_dir = "../../pages/report_fs/uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($target_file)) {
            unlink($target_file);
            echo ' <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
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
										</div>
			';
        }

        if ($imageFileType != "csv" && $imageFileType != "xlsx") {
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
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo 
				'<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
											<div class="m-alert__icon">
												<i class="flaticon-exclamation-1"></i>
												<span></span>
											</div>
											<div class="m-alert__text">
												The file ' . basename($_FILES["fileToUpload"]["name"]) . ' has been uploaded."
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
        }

        // open txt file that contains all known administrative expenses category
        $expenseCategories = fopen("../../pages/report_fs/classification/Expenses.txt", "r") or die("Unable to open file!");
        $expenseString = "";
        while (!feof($expenseCategories)) {
            $expenseString .= fgetc($expenseCategories);
        }
        fclose($expenseCategories);
        $expenseArray = explode(",", $expenseString);
        for ($i = 0; $i < count($expenseArray); $i++) {
            $expenseArray[$i] = trim($expenseArray[$i]);
        }

        $assetsCategories = fopen("../../pages/report_fs/classification/Assets.txt", "r") or die("Unable to open file!");
        $assetsString = "";
        while (!feof($assetsCategories)) {
            $assetsString .= fgetc($assetsCategories);
        }
        fclose($assetsCategories);
        $assetsArray = explode(",", $assetsString);
        for ($i = 0; $i < count($assetsArray); $i++) {
            $assetsArray[$i] = trim($assetsArray[$i]);
        }

        $capitalsCategories = fopen("../../pages/report_fs/classification/Capital.txt", "r") or die("Unable to open file!");
        $capitalsString = "";
        while (!feof($capitalsCategories)) {
            $capitalsString .= fgetc($capitalsCategories);
        }
        fclose($capitalsCategories);
        $capitalsArray = explode(",", $capitalsString);
        for ($i = 0; $i < count($capitalsArray); $i++) {
            $capitalsArray[$i] = trim($capitalsArray[$i]);
        }

        $liabilitiesCategories = fopen("classification/Current Liabilities.txt", "r") or die("Unable to open file!");
        $liabilitiesString = "";
        while (!feof($liabilitiesCategories)) {
            $liabilitiesString .= fgetc($liabilitiesCategories);
        }
        fclose($liabilitiesCategories);
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

        $nonCurrentAssetsCategories = fopen("../../pages/report_fs/classification/Non-current Assets.txt", "r") or die("Unable to open file!");
        $nonCurrentAssetsString = "";
        while (!feof($nonCurrentAssetsCategories)) {
            $nonCurrentAssetsString .= fgetc($nonCurrentAssetsCategories);
        }
        fclose($nonCurrentAssetsCategories);
        $nonCurrentAssetsArray = explode(",", $nonCurrentAssetsString);
        for ($i = 0; $i < count($nonCurrentAssetsArray); $i++) {
            $nonCurrentAssetsArray[$i] = trim($nonCurrentAssetsArray[$i]);
        }

        $incomeCategories = fopen("../../pages/report_fs/classification/Income.txt", "r") or die("Unable to open file!");
        $incomeString = "";
        while (!feof($incomeCategories)) {
            $incomeString .= fgetc($incomeCategories);
        }
        fclose($incomeCategories);
        $incomeArray = explode(",", $incomeString);
        for ($i = 0; $i < count($incomeArray); $i++) {
            $incomeArray[$i] = trim($incomeArray[$i]);
        }

        // set array for months
        $monthIdentifier = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        // open txt file that contains all known administrative expenses category
        $adminExpenseCategories = fopen("../../pages/report_fs/classification/Administrative Expenses.txt", "r") or die("Unable to open file!");
        $adminExpenseString = "";
        while (!feof($adminExpenseCategories)) {
            $adminExpenseString .= fgetc($adminExpenseCategories);
        }
        fclose($adminExpenseCategories);
        $adminExpenseArray = explode(",", $adminExpenseString);
        for ($i = 0; $i < count($adminExpenseArray); $i++) {
            $adminExpenseArray[$i] = trim($adminExpenseArray[$i]);
        }

        // open txt file that contains all known administrative expenses category
        $distriMarketingExpenseCategories = fopen("../../pages/report_fs/classification/Distribution and Marketing Expenses.txt", "r") or die("Unable to open file!");
        $distriMarketingExpenseString = "";
        while (!feof($distriMarketingExpenseCategories)) {
            $distriMarketingExpenseString .= fgetc($distriMarketingExpenseCategories);
        }
        fclose($distriMarketingExpenseCategories);
        $distriMarketingExpenseArray = explode(",", $distriMarketingExpenseString);
        for ($i = 0; $i < count($distriMarketingExpenseArray); $i++) {
            $distriMarketingExpenseArray[$i] = trim($distriMarketingExpenseArray[$i]);
        }

        // open txt file that contains all known income tax category
        $taxPayableCategories = fopen("../../pages/report_fs/classification/Tax Payable.txt", "r") or die("Unable to open file!");
        $taxPayableString = "";
        while (!feof($taxPayableCategories)) {
            $taxPayableString .= fgetc($taxPayableCategories);
        }
        fclose($taxPayableCategories);
        $taxPayableArray = explode(",", $taxPayableString);
        for ($i = 0; $i < count($taxPayableArray); $i++) {
            $taxPayableArray[$i] = trim($taxPayableArray[$i]);
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
        $spreadsheet = $reader->load($target_file);

        // only read active sheet, can change to read specific sheet
        // $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $numberOfSheets = $spreadsheet->getSheetCount();

        echo "<br/>";

        $trialBalanceArray = array();
        $yearlyUndefinedRows = array();
        $endedAtArray = array();

        $companyName =  "";
        $yearEnded = "";

        for ($activeSheet = 0; $activeSheet < $numberOfSheets; $activeSheet++){
          $dataFound = 0;

          $sheetData = $spreadsheet->getSheet($activeSheet)->toArray();
          $trialBalanceArray[$activeSheet] = array();
          $yearlyUndefinedRows[$activeSheet] = array();
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

          for ($i = 0; $i < count($sheetData); $i++) {
            for ($x = 0; $x < count($sheetData[$i]); $x++) {
              $currentData = $sheetData[$i][$x];
              if (!empty($currentData)){
                if ($dataFound < 3){
                  if ($dataFound == 0){
                    $companyName = $currentData;
                    $dataFound++;
                  } else if ($dataFound == 1){
                    $dataFound++;
                  } else if ($dataFound == 2){
                    $fullDate = $currentData;
                    $yearEnded = substr($fullDate, -4);
                    array_push($endedAtArray, $fullDate);
                    $dataFound++;
                  }
                } else {
                  if (gettype($accountColumn) == "boolean"){
                    if (stripos($currentData,"account") !== false){
                      $accountColumn = $x;
                    }
                  }
                  if (gettype($debitColumn) == "boolean"){
                    if (stripos($currentData,"debit") !== false){
                      $debitColumn = $x;
                    }
                  } else if (gettype($creditColumn) == "boolean"){
                    if (stripos($currentData,"credit") !== false){
                      $creditColumn = $x;
                    }
                  }
                }
              }
            }
            if (is_numeric($accountColumn) && is_numeric($debitColumn) && is_numeric($creditColumn)){
              $categoryColumn = $creditColumn + 1;
              break;
            }

          }

          $modifiedCategoryArray = array();

          $undefinedRows = array();
          $rowCounter = 0;
          for ($i = 0; $i < $sheetData; $i++){

            $accountValue = $sheetData[$i][$accountColumn];

            if (stripos($accountValue,"total:") !== false){
              break;
            } else {
              $amount = 0;
              $debitOrCredit = "";
              if (is_numeric($sheetData[$i][$debitColumn])){
                $amount = $sheetData[$i][$debitColumn];
                $debitOrCredit = "debit";
              } else if (is_numeric($sheetData[$i][$creditColumn])){
                $amount = $sheetData[$i][$creditColumn];
                $debitOrCredit = "credit";
              } else {
                continue;
              }
              $tempArray = array();
              $originalCatValue = "";
              $categoryValue = trim($sheetData[$i][$categoryColumn]);
              if (empty($categoryValue)){
                $categoryValue = "undefined";
                array_push($undefinedRows, $rowCounter);
              }
              if (in_array($categoryValue,$adminExpenseArray)){
                $originalCatValue = $categoryValue;
                $categoryValue = "Administrative Expenses";
              } else if (in_array($categoryValue, $distriMarketingExpenseArray)){
                $originalCatValue = $categoryValue;
                $categoryValue = "Distribution and Marketing Expenses";
              } else if (in_array($categoryValue, $taxPayableArray)){
                $originalCatValue = $categoryValue;
                $categoryValue = "Current Income Tax Liabilities";
              }
              array_push($tempArray,$accountValue);
              array_push($tempArray,$amount);
              array_push($tempArray,$categoryValue);
              array_push($tempArray,$debitOrCredit);
              array_push($annualArray,$tempArray);
              if (!empty($originalCatValue)){
                array_push($modifiedCategoryArray,$originalCatValue . "," . $categoryValue);
              }
            }
            $rowCounter++;
          }
          array_push($trialBalanceArray[$activeSheet],$yearEnded);
          array_push($trialBalanceArray[$activeSheet],$annualArray);

          array_push($yearlyUndefinedRows[$activeSheet],$yearEnded);
          array_push($yearlyUndefinedRows[$activeSheet],$undefinedRows);
        }

        echo $companyName  . "<br/>";
        for ($i = 0; $i < count($trialBalanceArray); $i++){
          echo "<hr/>";
          echo $endedAtArray[$i] . "<br/>";
          $yearlyArray = $trialBalanceArray[$i][1];
          for ($x = 0; $x < count($yearlyUndefinedRows[$i][1]);$x++){
            $contextPrinted = false;
            echo "<hr/>";
            $rows = $yearlyArray[$yearlyUndefinedRows[$i][1][$x]];
            $currentRowCounter = $yearlyUndefinedRows[$i][1][$x];
            if (($currentRowCounter + 2) > count($yearlyArray)){
              for ($k = $currentRowCounter - 2; $k < $currentRowCounter; $k++){
                $previousRow = $yearlyArray[$k];
                for ($j = 0; $j < count($previousRow); $j++){
                  echo $previousRow[$j] . " ";
                }
                echo "<br/>";
              }
              $contextPrinted = true;
            }
            for ($j = 0; $j < count($rows); $j++){
              if ($j != 2){
                echo ($rows[$j] . " ");
              } else {
                echo "<select id='catUpdate" . $i . $x . "'>";
                echo "<option value=''> </option>";
                if (strcasecmp($rows[3], "debit") == 0){
                  echo "<option disabled>---Assets---</option>";
                  for ($k = 0; $k < count($assetsArray); $k++){
                    echo "<option value='" . $assetsArray[$k] . "'>" . $assetsArray[$k] ."</options>";
                  }
                  echo "<option disabled>---Expenses---</option>";
                  for ($k = 0; $k < count($expenseArray); $k++){
                    echo "<option value='" . $expenseArray[$k] . "'>" . $expenseArray[$k] ."</options>";
                  }
                } else {
                  echo "<option disabled>---Assets(Liabilities)---</option>";
                  for ($k = 0; $k < count($nonCurrentAssetsArray); $k++){
                    echo "<option value='" . $nonCurrentAssetsArray[$k] . "'>" . $nonCurrentAssetsArray[$k] ."</options>";
                  }
                  echo "<option disabled>---Liabilities---</option>";
                  for ($k = 0; $k < count($liabilitiesArray); $k++){
                    echo "<option value='" . $liabilitiesArray[$k] . "'>" . $liabilitiesArray[$k] ."</options>";
                  }
                  echo "<option disabled>---Income---</option>";
                  for ($k = 0; $k < count($incomeArray); $k++){
                    echo "<option value='" . $incomeArray[$k] . "'>" . $incomeArray[$k] ."</options>";
                  }
                  echo "<option disabled>---Capital---</option>";
                  for ($k = 0; $k < count($capitalsArray); $k++){
                    echo "<option value='" . $capitalsArray[$k] . "'>" . $capitalsArray[$k] ."</options>";
                  }
                }
                echo "</select>&#9;";
              }
            }

            echo "<br/>";
            if ($contextPrinted == false){
              for ($k = $currentRowCounter + 1; $k < $currentRowCounter + 3; $k++){
                $nextRow = $yearlyArray[$k];
                for ($j = 0; $j < count($nextRow); $j++){
                  echo $nextRow[$j];
                }
                echo "<br/>";
              }
            }
          }
        }
        if (count($modifiedCategoryArray) > 0){
          echo "The following categories were replaced:<br/>";
          for ($i = 0; $i < count($modifiedCategoryArray);$i++){
            $tempStr = explode(",", $modifiedCategoryArray[$i]);
            echo $tempStr[0] . " --> " . $tempStr[1] . "<br/>";
          }
        }


        ?>

        <form action="next_page.php" method="post" onsubmit="updateCategory()">
          <!-- Yoo yee's required data here -->
          <div class="form-group">
              <label for="companyName">Company Name: </label>
              <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Enter Company Name" value="<?php echo $companyName?>"/>
          </div>

          <div class="form-group">
              <label for="companyregID">Company Registration Number: </label>
              <input type="text" class="form-control" id="companyregID" name="companyregID" placeholder="Enter Company Registration Number"/>
          </div>

          <?php
          $month = substr($endedAtArray[0], 0, -5);
          $monthInNumber = 0;
          for ($i = 0; $i < count($monthIdentifier); $i++){
            if (stripos($monthIdentifier[$i],trim($month)) !== false){
              $monthInNumber = $i + 1;
            }
          }
          $yearEnded = substr($endedAtArray[0], -4);
          $numberOfDaysInMonth = cal_days_in_month(CAL_GREGORIAN, $monthInNumber, $yearEnded);
          $date = date_create("$yearEnded-$monthInNumber-$numberOfDaysInMonth");

          ?>
          <hr/>
          <div class="form-group">
              <label for="yearEnd">Year Ended In: </label>
              <input type="date" class="form-control" id="yearEnd" name="yearEnd" value="<?php echo date_format($date,"Y-m-d");?>"/>
          </div>

          <div class="form-group">
              <label for="noOfDirectors">No. of Directors: </label>
              <select name="noOfDirectors" id="noOfDirectors" onchange="addDirectorField(this.value)" required="true">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
              </select>
          </div>

          <div class="form-group">
              <label for="directorName1">Director Name #1: </label>
              <input type="text" class="form-control" id="directorName1" name="directorName1" placeholder="Enter Director Name"/>
              <label for="directorName1">Date of Appointment: </label>
              <input type="date" class="form-control" id="directorName1ApptDate" name="directorName1ApptDate"/>
              <label for="directorName1">Director #1 Share: </label>
              <input type="text" class="form-control" id="director1Share" name="director1Share" placeholder="Enter Director's share"/>

          </div>

          <div class="form-group">
              <label for="todayDate">Today Date: </label>
              <input type="date" class="form-control" id="todayDate" name="todayDate" value=""/>
          </div>

          <div class="form-group">
              <label for="firstBalanceDate">First Balance Date: </label>
              <input type="date" class="form-control" id="firstBalanceDate" name="firstBalanceDate"/>
          </div>

          <div class="form-group">
              <label for="secondBalanceDate">Second Balance Date: </label>
              <input type="date" class="form-control" id="secondBalanceDate" name="secondBalanceDate"/>
          </div>

          <div class="form-group">
              <label for="thirdBalanceDate">Third Balance Date: </label>
              <input type="date" class="form-control" id="thirdBalanceDate" name="thirdBalanceDate"/>
          </div>

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
              <label for="firstDate">First Date: </label>
              <input type="date" class="form-control" id="firstDate" name="firstDate"/>
          </div>

          <div class="form-group">
              <label for="secondDate">Second Date:: </label>
              <input type="date" class="form-control" id="secondDate" name="secondDate"/>
          </div>

          <div class="form-group">
              <label for="thirdDate">Third Date:: </label>
              <input type="date" class="form-control" id="thirdDate" name="thirdDate"/>
          </div>

          <div class="form-group">
              <label for="currency">Currency: </label>
              <input type="text" class="form-control" id="currency" name="currency" placeholder='E.g. Singapore Dollar'/>
          </div>

          <!-- yok yee required data end -->
            <?php
            echo "<input type='hidden' name='companyName' value='" . $companyName . "'/>";
            echo "<input type='hidden' name='numberOfYears' value='" . $numberOfSheets . "'/>";
            for ($i = 0; $i < count($trialBalanceArray); $i++) {
              echo "<input type='hidden' name='years[]' value='" . $endedAtArray[$i] . "'/>";
              $yearArray = $trialBalanceArray[$i][1];
                for ($x = 0; $x < count($yearArray); $x++) {
                  $allRows = $yearArray[$x];
                  for ($j = 0; $j < count($allRows);$j++){
                    echo "<input type='hidden' name='data[" . $i . "][$x][]' value='" . $allRows[$j] . "' id='formData" . $i . $x . $j . "'/>";
                  }

                }
            }
            ?>
            <input type="submit" value="Submit">
        </form>


<script type="text/javascript">
    function updateCategory() {
      var numberOfYears = <?php echo count($trialBalanceArray);?>;
      var undefinedArray = <?php echo json_encode($yearlyUndefinedRows);?>;
      for (var j = 0; j < numberOfYears; j++){
        var undefinedCounter = undefinedArray[j][1].length;
        for (var i = 0; i < undefinedCounter; i++) {
            var selectOption = document.getElementById("catUpdate" + j + i);
            // alert(document.getElementById("catUpdate"+undefinedRows[i]).value);
            document.getElementById("formData"+ j + undefinedArray[j][1][i] + "2").value = selectOption.options[selectOption.selectedIndex].text;
        }
      }
    }
</script>
</div>
</div>
<?php include '../general/footer_content.php';?>
	<?php include '../general/footer.php';?>
