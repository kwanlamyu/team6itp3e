
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
								<form action="updateCategories.php" method="post" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
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

											<input type="file" class="m-dropzone dropzone m-dropzone--success" name="trialBalances[]" id="m-dropzone-three" accept=".xlsx" >
											</div>
											<label for='yearEnd'>Financial Year Start:</label>
											<input type='date' class='form-control' id='yearStart' name='yearStart[]' value=''/>
											<label for='yearEnd'>Financial Year End:</label>
											<input type='date' class='form-control' id='yearEnd' name='yearEnd[]' value=''/>
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
		function changeFileUploadForm(){
			var selectedValue = document.getElementById("tbNumber").value;
			var currentForm = document.getElementById("formForUploads");
			currentForm.innerHTML = "";
			for (i = 0; i < selectedValue; i++){
				currentForm.innerHTML += "<div class='form-group m-form__group'>\
				<span class='m-input-icon__icon m-input-icon__icon--right'>\
				<span><i class='la la-thumb-tack'></i></span></span>\
				Select file to upload:\
				<div class='m-input-icon m-input-icon--left m-input-icon--right'>\
				<input type='file' class='m-dropzone dropzone m-dropzone--success' name='trialBalances[]' id='m-dropzone-three' accept='.xlsx'>\
				</div><label for='yearEnd'>Financial Year Start:</label>\
				<input type='date' class='form-control' id='yearStart' name='yearStart[]' value=''/>\
				<label for='yearEnd'>Financial Year End:</label>\
				<input type='date' class='form-control' id='yearEnd' name='yearEnd[]' value=''/></div>";
			}
			currentForm.innerHTML += "<div class='m-form__actions'>\
			<input type='submit' class='btn btn-accent' value='Upload File' name='submit'>\
			</div>";
		}
		</script>

	<?php include '../general/footer_content.php';?>
	<?php include '../general/footer.php';?>
