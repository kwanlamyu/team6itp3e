
<?php
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
            $companyName = $_SESSION['company'];
            $clientCompany = $_POST['companyName'];
            $clientUEN = $_POST['uenNumber'];
            ?>

            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                <!-- BEGIN: Subheader -->
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
                                                Upload Trial Balance
                                            </h3>
                                        </div>
                                    </div>
                                </div>
								<div class="m-portlet__body">
                                <!--begin::Form-->
                                    <span><label>Select number of trial balances to upload</label></span>
                                    <select name="numberOfTB" onchange="changeFileUploadForm()" id="tbNumber" class="form-control col-lg-1">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>

                                    <span><br/>*For multiple files: Please upload latest to oldest in sequence</span>
                                <br>
                                <form name='uploadForm' action="updateCategoriesSub.php" method="post" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right" onsubmit="return validateForm()">
                                    <div class="col-lg-3">
                                        <input class="form-control m-input" type="hidden" id="clientCompany" name="clientCompany" value="<?php echo $clientCompany; ?>">
                                        <input class="form-control m-input" type="hidden" id="clientUEN" name="clientUEN" value="<?php echo $clientUEN; ?>">
                                        <!-- <span class="m-form__help">
                                            Please enter company name
                                        </span> -->
                                    </div>
                                    <div id="formForUploads">
                                        <br><div><label class="col-lg-3 col-form-label"><i class="la la-thumb-tack"></i>  Select file to upload: </label>
                                          <br>
											<label class="btn btn-secondary" style="height: 100px;">
  <div class="col-lg-9">
                                                <input type="file" name="trialBalances[]" id="file0" accept=".xlsx">

                                            </div>
											</label>
                    </div>
                    <br>
                    <div class="row">
                                            <label class="col-lg-2 col-form-label" for='yearStart0'>Financial Year Start:</label>
                                            <div class="col-lg-4">
                                            <input type='date' class='form-control' id='yearStart0' name='yearStart[]' value=''/>
                                          </div>
                                            <label class="col-lg-2 col-form-label" for='yearEnd0'>Financial Year End:</label>
                                            <div class="col-lg-4">
                                            <input type='date' class='form-control' id='yearEnd0' name='yearEnd[]' value=''/>
                                          </div>
                                        </div>
                                        <div class="m-form__actions" align="center">
                                            <input type="submit" class="btn btn-success" value="Upload File" name="submit" id='m_alert'>
                                        </div>

                            </div>
                            </form>
							</div>
                            <!--end::Form-->
                        </div>
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
                            //alert("Company Name must be entered");
							swal("Error", "Company Name must be entered", "error");
                        }
                        if (dateFlag == 1) {
							swal("Error", dateError, "error");
                            //alert(dateError);
                        }
                        if (fileFlag == 1) {
							swal("Error", fileError, "error");
                            //alert(fileError);
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
                        currentForm.innerHTML += "<br><div><label class='col-lg-3 col-form-label'><i class='la la-thumb-tack'></i>  Select file to upload: </label><br><label class='btn btn-secondary' style='height: 100px;'><div class='col-lg-9'><input type='file' name='trialBalances[]' id='file" + i + "' accept='.xlsx'></div></label></div><br><div class='row'><label class='col-lg-2 col-form-label' for='yearStart" + i + "'>Financial Year Start:</label><div class='col-lg-4'><input type='date' class='form-control' id='yearStart" + i + "' name='yearStart[]' value=''/></div><label class='col-lg-2 col-form-label' for='yearEnd" + i + "'>Financial Year End:</label><div class='col-lg-4'><input type='date' class='form-control' id='yearEnd" + i + "' name='yearEnd[]' value=''/></div></div><br>";
                    }
                    currentForm.innerHTML += "<div class='m-form__actions' align='center'><input type='submit' class='btn btn-success' value='Upload File' name='submit' id='m_alert'></div>";
                }



            </script>
            <?php
        }
    }
} else {
    header("Location: ../user_login/login.php");
}
?>
<?php include '../general/footer_content.php'; ?>
<?php include '../general/footer.php'; ?>
