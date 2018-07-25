

<?php include '../general/header.php';?>
<?php include '../general/navigation_clientadmin.php';?>
<?php include '../db_connection/db.php'; ?>

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
										<!--begin: Datatable -->
										<div class="m_datatable" id="m_datatable_latest_orders"></div>
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

	<?php include '../general/footer_content.php';?>
	<?php include '../general/footer.php';?>