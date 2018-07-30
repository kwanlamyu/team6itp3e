<?php
require_once '../db_connection/db.php';
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] == '3') {
    include '../general/header.php';
    include '../general/navigation_accountant.php';
    ?>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title">
									Accountant Dashboard
								</h3>
								
								
							</div>
							</div>
						</div>
						
						<div class="m-content">
						<div class="row">
							<div class="col-xl-12">
								<div class="m-portlet m-portlet--mobile ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-caption">
											<div class="m-portlet__head-title">
												<h3 class="m-portlet__head-text">
													Company Accounts
												</h3>
											</div>
										</div>
										<div class="m-portlet__head-tools">
											
										</div>
									</div>
									<div class="m-portlet__body">
									<!--begin: Search Form -->
								<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
									<div class="row align-items-center">
										<div class="col-xl-8 order-2 order-xl-1">
											<div class="form-group m-form__group row align-items-center">
												<div class="col-md-4">
													<div class="m-input-icon m-input-icon--left">
														<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
														<span class="m-input-icon__icon m-input-icon__icon--left">
															<span>
																<i class="la la-search"></i>
															</span>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-xl-4 order-1 order-xl-2 m--align-right">
										
											<div class="m-separator m-separator--dashed d-xl-none"></div>
										</div>
									</div>
								</div>
								<!--end: Search Form -->
									
										<!--begin: Datatable -->
										<div class="accountant_dash" id="accountant_dash"></div>
										<textarea id="m_datatable_console_accountant" class="form-control m--margin-top-30" style="display: none;"cols="100" rows="10" title="Console" readonly="readonly"></textarea>
										<!--end: Datatable -->
									</div>
								</div>
								</div>
								</div>
								
								</div>
								</div>
								</div>
<?php
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '1') {
    header('Location: ../user_super_admin/super_admin_dahsboard.php');
}elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '2') {
    header('Location: ../user_client_admin/client_admin_dahsboard.php');
}
 else {
    header('Location: ../user_login/login.php');
}
?>