
<?php include '../general/header.php';?>
<?php include '../general/navigation_superadmin.php';?>

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
								<form action="upload.php" method="post" enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
									<div class="m-portlet__body">
												
										<div class="form-group m-form__group">
										<span class="m-input-icon__icon m-input-icon__icon--right">
													<span>
														<i class="la la-thumb-tack"></i>
													</span>
												</span>
										Select files to upload:
										
											<div class="m-input-icon m-input-icon--left m-input-icon--right">
												<input type="file" class="btn btn-metal" name="fileToUpload" id="fileToUpload" accept=".xlsx">
												
											</div>
										</div>
										<div class="m-form__actions">
											<input type="submit" class="btn btn-accent" value="Upload File" name="submit">
										</div>
									</div>
								</form>
								<!--end::Form-->
							</div>
							</div>
							</div>
							</div>
							<!--end::Portlet-->
					</div>
					<!-- END: Subheader -->
    </div>

	<?php include '../general/footer_content.php';?>
	<?php include '../general/footer.php';?>