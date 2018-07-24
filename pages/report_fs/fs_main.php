
<?php
require_once '../db_connection/db.php';

include '../general/header.php';
include '../general/navigation_accountant.php';
// TODO: For testing only, requires to be changed to actual session check
$_SESSION['companyName'] = "Abc Pte. Ltd.";
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
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Upload Trial Balance
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <div>
                        <span>Select number of trial balances to upload</span>
                        <select name="numberOfTB" onchange="changeFileUploadForm()" id="tbNumber">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <span><br/>For multiple files: Please upload latest to oldest in sequence</span>
                    </div>
                    <form name='uploadForm' action="updateCategories.php" method="post" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right" onsubmit="return validateForm()">
                        <div class="col-lg-3">
                            <input class="form-control m-input" type="text" id="clientCompany" name="clientCompany" value="">
                            <span class="m-form__help">
                                Please enter company name
                            </span>
                        </div>
                        <div class="m-portlet__body" id="formForUploads">
                            <div class="form-group m-form__group">
                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                    <span>
                                        <i class="la la-thumb-tack"></i>
                                    </span>
                                </span>
                                Select files to upload:

                                <div class="m-input-icon m-input-icon--left m-input-icon--right">

                                    <input type="file" class="m-dropzone dropzone m-dropzone--success" name="trialBalances[]" id="file0" accept=".xlsx" >
                                </div>
                                <label for='yearStart0'>Financial Year Start:</label>
                                <input type='date' class='form-control' id='yearStart0' name='yearStart[]' value=''/>
                                <label for='yearEnd0'>Financial Year End:</label>
                                <input type='date' class='form-control' id='yearEnd0' name='yearEnd[]' value=''/>
                            </div>
                            <div class="m-form__actions">
                                <input type="submit" class="btn btn-accent" value="Upload File" name="submit">
                            </div>
                        </div>
                </div>
                </form>

                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
<!--end::Portlet-->
<!-- END: Subheader -->
</div>

<script>
    // reset the dropdown box and form when user presses back
    document.getElementById("tbNumber").selectedIndex = 0;
    document.forms['uploadForm'].reset();

    // validation to ensure all input are not null and are of valid input
    function validateForm() {
        var submitBtn = document.forms['uploadForm']['submit'];
        submitBtn.disabled = true;
        var clientCompany = document.forms['uploadForm']['clientCompany'].value;
        var today = new Date();
        var numberOfFiles = document.getElementById("tbNumber").value;
        var dateFlag = 0;
        var dateError = "";
        var yearsArray = new Array();
        var fileFlag = 0;
        var fileError = "";
        for (i = 0; i < numberOfFiles; i++) {
            // date check
            var startDate = document.forms['uploadForm']['yearStart' + i].value;
            var endDate = document.forms['uploadForm']['yearEnd' + i].value;
            if (startDate == "" || endDate == "") {
                dateFlag = 1;
                dateError = "Please enter a date";
                break;
            } else {
                startYear = startDate.substring(0, 4);
                startMonth = startDate.substring(5, 7);
                startDay = startDate.substring(8, 10);
                endYear = endDate.substring(0, 4);
                endMonth = endDate.substring(5, 7);
                endDay = endDate.substring(8, 10);
                var formattedStartDate = new Date(startYear, startMonth - 1, startDay);
                var formattedEndDate = new Date(endYear, endMonth - 1, endDay);
                if (formattedStartDate >= today || formattedEndDate >= today) {
                    dateFlag = 1;
                    if (formattedStartDate >= today) {
                        dateError = "Start date ";
                    } else if (formattedEndDate >= today) {
                        dateError = "End date ";
                    }
                    dateError += "Start date should not later than today.";
                    break;
                } else if (formattedStartDate > formattedEndDate) {
                    dateFlag = 1;
                    dateError = "Start date should not be later than end date";
                    break;
                } else {
                    yearsArray.push(formattedEndDate);
                }
            }
            // check files are not empty
            var fileInput = document.forms['uploadForm']['file' + i].value;
            if (fileInput == "") {
                fileFlag = 1;
                fileError = "Please select a file to upload";
                break;
            }
        }
        // check if all files' dates are in descending order
        for (i = 0; i < yearsArray.length - 1; i++) {
            if (yearsArray[i] < yearsArray[i + 1]) {
                dateFlag = 1;
                dateError = "Files should be uploading from latest date first";
                break;
            }
        }
        if (clientCompany == "" || dateFlag == 1 || fileFlag == 1) {
            if (clientCompany == "") {
                alert("Company Name must be entered");
            }
            if (dateFlag == 1) {
                alert(dateError);
            }
            if (fileFlag == 1) {
                alert(fileError);
            }
            submitBtn.disabled = false;
            return false;
        } else {
            return true;
        }
    }

    function changeFileUploadForm() {
        var selectedValue = document.getElementById("tbNumber").value;
        var currentForm = document.getElementById("formForUploads");
        currentForm.innerHTML = "";
        for (i = 0; i < selectedValue; i++) {
            currentForm.innerHTML += "<div class='form-group m-form__group'>\
                <span class='m-input-icon__icon m-input-icon__icon--right'>\
                <span><i class='la la-thumb-tack'></i></span></span>\
                Select file to upload:\
                <div class='m-input-icon m-input-icon--left m-input-icon--right'>\
                <input type='file' class='m-dropzone dropzone m-dropzone--success' name='trialBalances[]' id='file" + i + "' accept='.xlsx'>\
                </div><label for='yearStart" + i + "'>Financial Year Start:</label>\
                <input type='date' class='form-control' id='yearStart" + i + "' name='yearStart[]' value=''/>\
                <label for='yearEnd" + i + "'>Financial Year End:</label>\
                <input type='date' class='form-control' id='yearEnd" + i + "' name='yearEnd[]' value=''/></div>";
        }
        currentForm.innerHTML += "<div class='m-form__actions'>\
        <input type='submit' class='btn btn-accent' value='Upload File' name='submit'>\
        </div>";
    }
</script>

<?php include '../general/footer_content.php'; ?>
<?php include '../general/footer.php'; ?>
