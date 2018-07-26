<?php
require_once '../db_connection/db.php';
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] == '1') {
    
    include '../general/header.php';
    include '../general/navigation_superadmin.php';
    ?>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title">
									Super Admin Dashboard
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
													Client Accounts
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
											<a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--pill m-btn--icon m-btn--air">
												<span>
													<i class="la la-file-excel-o"></i>
													<span>
														Export
													</span>
												</span>
											</a>
											<div class="m-separator m-separator--dashed d-xl-none"></div>
										</div>
									</div>
								</div>
								<!--end: Search Form -->
									
										<!--begin: Datatable -->
										<div class="super_admin_table" id="super_admin_table"></div>
										<span id="m_datatable_console" style="display: none;"class=" form-control m--margin-top-30" cols="100" rows="10" title="Console" readonly="readonly"></span>
										<!--end: Datatable -->
									</div>
								</div>
								</div>
								</div>
								
								</div>
								</div>
								</div>

<?php
    //include footer and footer content
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] == '2') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] == '3') {
    header('Location: ../user_accountant/accountant_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>