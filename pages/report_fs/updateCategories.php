
<?php
session_start();
include '../general/header.php';
include '../general/navigation_accountant.php';
require_once '../db_connection/db.php';
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
                Update Categories
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
            // echo "Sorry, your file was not uploaded.";
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
        // loop end here
        try {
          $query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name = :companyName AND client_company = :clientName");
          $query->bindParam(':companyName', $companyName);
          $query->bindParam(':clientName', $clientName);
          $companyName = $_SESSION['companyName'];
          $clientName = $_POST['clientCompany'];
          $query->execute();
          $result = $query->setFetchMode(PDO::FETCH_ASSOC);
          $result = $query->fetchAll();
          if (count($result) === 0){
            // insert default data here
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
            $accountNames = "Accounting Fee,Administrative Expenses,Bank Charges,Compilation Fee,Depreciation,Entertainment,Freight Charges,Internet Expenses,Late Penalty,Nominee Director Fee,Office Supplies,Postage and Courier,Professional Fee,Secretarial Fee,Taxation Fee,Salaries,Skill Development Levy & SINDA";
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
            $accountNames = "Trade Payables,GST Payables,Accruals,Amount owing to a Shareholder,Current Income Tax Liabilities";
            $query->execute();

            $mainAccount = "Distribution and Marketing Expenses";
            $accountNames = "Telephone Expenses,Transport Expenses,Travel Expenses";
            $query->execute();

            $mainAccount = "Exchange Gain - Non Trade";
            $accountNames = "Unrealised exchange difference,Exchange Gain - Non-trade";
            $query->execute();

            $mainAccount = "Exchange Gain - Trade";
            $accountNames = "Exchange Gain - Trade,Exchange difference";
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
          }
          $query = $DB_con->prepare("SELECT * FROM main_category WHERE company_name = :companyName AND client_company = :clientName");
          $query->bindParam(':companyName', $companyName);
          $query->bindParam(':clientName', $clientName);
          $companyName = $_SESSION['companyName'];
          $clientName = $_POST['clientCompany'];
          $query->execute();
          $result = $query->setFetchMode(PDO::FETCH_ASSOC);
          $result = $query->fetchAll();
          echo "<span>Company: " . $companyName . "</span><br/>";
          echo "<span>Client: " . $clientName . "</span><br/>";
          // TODO: change to editable
          for ($i = 0; $i < count($result); $i++){
            echo "<span>Category: ";
            echo $result[$i]['main_account'] . "<br/>";
            echo "<span>Accounts under " . $result[$i]['main_account'] . ": " . $result[$i]['account_names'] . "</span>";
          }
        } catch (PDOException $e) {
            echo 'Error: ' .$e->getMessage();
        }

        ?>
        <form action="upload.php" method="post" onsubmit="updateCategory()" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
          <?php
          foreach ($fileArray as $value){
            echo "<input type='hidden' name='fileArray[]' value='" . $value . "'/>";
          }
          ?>
          <input type="hidden" name="clientCompany" value="<?php echo $clientName;?>"/>
          <input type="submit" value="Submit" class="btn btn-brand">
        </form>
        <?php
          }
        ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!--end::Portlet-->
</div>
<!-- END: Subheader -->


<?php include '../general/footer_content.php';?>
<?php include '../general/footer.php';?>
