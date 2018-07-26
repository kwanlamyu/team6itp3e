<?php
session_start();
//check for username and role_id
if (isset($_SESSION['username']) && ($_SESSION['role_id'] == '2' || $_SESSION['role_id'] == '3')) {
    include '../general/header.php';
    require_once '../db_connection/db.php';
    if ($_SESSION['role_id'] == '2') {
        include '../general/navigation_clientadmin.php';
    } elseif ($_SESSION['role_id'] == '3') {
        include '../general/navigation_accountant.php';
    }
    ?>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
	<!-- BEGIN: Subheader -->
					<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title">
									Client Admin Dashboard
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
													Accountant Accounts
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
										<div class="m_datatable" id="api_events"></div>
										<textarea id="m_datatable_console" class="form-control m--margin-top-30" cols="100" rows="10" title="Console" readonly="readonly"></textarea>
										<!--end: Datatable -->
									</div>
								</div>
								</div>
								</div>
								
								</div>
								</div>
								</div>

<script language='javascript'>
/*
    function filterTable() {
        var input = document.getElementById("m_quicksearch_input");
        var filter = input.value.toUpperCase();
        var table = document.getElementById("accountantTable");
        var tr = table.getElementsByTagName("tr");

        for (var i = 1; i < tr.length; i++) {
            var tds = tr[i].getElementsByTagName("td");
            var firstCol = tds[0].textContent.toUpperCase();
            var secondCol = tds[1].textContent.toUpperCase();
            if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }

    }
	*/
</script>

<?php
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '1') {
    header('Location: ../user_super_admin/userdashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>