<?php
require_once '../db_connection/db.php';
include '../general/header.php';
include '../general/navigation_accountant.php';
require_once __DIR__ . '\..\..\vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

// use PhpOffice\PhpSpreadsheet\Reader\Csv;
// can change to read csv file as well
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
// only read data
$reader->setReadDataOnly(true);

// -----------------------------------------------------------------------------
$query = $DB_con->prepare("SELECT * FROM sub_category WHERE company_name =:companyName AND client_company = :clientName");
$query->bindParam(':companyName', $_SESSION['companyName']);
$query->bindParam(':clientName', $_POST['clientCompany']);
$query->execute();

$result = $query->setFetchMode(PDO::FETCH_ASSOC);
$result = $query->fetchAll();

$originalValue = $_POST['originalValue'];
$inputCategory = $_POST['category'];
$accountValue = $_POST['accountValue'];

for ($i = 0; $i < count($originalValue); $i++) {
    if ($originalValue[$i] != $inputCategory[$i]) {
        echo "Input Category: " . $inputCategory[$i] . "<br>";

        if ($originalValue[$i] == " ") {
            for ($j = 0; $j < count($result); $j++) {
                if ($inputCategory[$i] == $result[$j]['sub_account']) {

                    $foundAccount = $result[$j]['account_names'];
                    $foundAccount = $result[$j]['account_names'] . "," . $accountValue[$i];
                    echo "Account names: " . $foundAccount . "<br>";

//                    $update = "UPDATE sub_category SET account_names=? WHERE sub_account=?";
//                    $result = $DB_con->prepare($update);
//                    $result->execute([$foundAccount, $inputCategory[$i]]);

                    $update = "UPDATE sub_category SET account_names= '" . $foundAccount . "' WHERE sub_account= '" . $inputCategory[$i] . "'";
                    $stmt = $DB_con->prepare($update);
                    $stmt->execute();

                    // current situation is will overwrite if under the same sub_account
                    
                } else {
                    // redirect to main ?? or ??
                }
            }
        } else {
            // pull from the db, delete away the current account one -> use update 
            // pull from the db, replace the new account in -> use update
            for ($j = 0; $j < count($result); $j++) {
                if ($inputCategory[$i] == $result[$j]['sub_account']) {
                    // for updating the new rows
                    $foundAccount = $result[$j]['account_names'];
                    $foundAccount = $result[$j]['account_names'] . "," . $accountValue[$i];
                    $update = "UPDATE sub_category SET account_names= '" . $foundAccount . "' WHERE sub_account= '" . $inputCategory[$i] . "'";
                    $stmt = $DB_con->prepare($update);
                    $stmt->execute();
                }

                if (strpos($result[$j]['account_names'], $accountValue[$i]) !== false) {
                    // for updating the current rows, delete away the existing one
                    $foundAccount = $result[$j]['account_names'];
                    $replacedString = str_replace($accountValue[$i], '', $result[$j]['account_names']);
                   
                    $update = "UPDATE sub_category SET account_names= '" . $replacedString . "' WHERE sub_account= '" . $result[$j]['sub_account'] . "'";
                    $stmt = $DB_con->prepare($update);
                    $stmt->execute();
                }
            }
        }
    }
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


                    <?php
                    echo "<hr> account <hr>";
                    print_r($accountValue);
                    echo "<hr> original <hr>";
                    print_r($originalValue);
                    echo "<hr>";
                    print_r($inputCategory);
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Portlet-->
</div>
<!-- END: Subheader -->


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