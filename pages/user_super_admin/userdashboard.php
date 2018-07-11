<?php include '../general/header.php';?>
<?php include '../general/navigation_superadmin.php';?>
<?php include '../db_connection/conn.php';?>

<div class="m-grid__item m-grid__item--fluid m-wrapper" > <!-- style="background: url(../../assets/app/media/img/bg/repeatbg.png); background-repeat: repeat;" -->
<div class="m-subheader ">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title">
									Dashboard
								</h3>
							</div>
							</div>
						</div>
						<div class="m-content">
							<div class="row">
							<div class="col-lg-12">
	
								<!--begin::Portlet-->
						<div class="m-portlet">
							<div class="m-portlet__head">
								<div class="m-portlet__head-caption">
									<div class="m-portlet__head-title">
										<h3 class="m-portlet__head-text">
											Client Accounts
										</h3>
									</div>
								</div>
							</div>
							<div class="m-portlet__body">
								<!--begin::Section-->
								<div class="m-section">
								<div class="row">
								<div class="col-lg-6" align="left">
									<div>
										<form method="post" action="../user_login/export.php">
											<input type="submit" class="btn btn-outline-success" name="export" value="CSV Export"/>
										</form> 
									</div>
									</div>
								<!--BEGIN: Search -->
									<div class="col-lg-6 m-stack__item m-stack__item--middle m-dropdown m-dropdown--arrow m-dropdown--large m-dropdown--mobile-full-width m-dropdown--align-right m-dropdown--skin-light m-header-search m-header-search--expandable m-header-search--skin-light" id="m_quicksearch" m-quicksearch-mode="default">
										
										<form class="m-header-search__form">
											<div class="m-header-search__wrapper">
												<span class="m-header-search__icon-search" id="m_quicksearch_search">
													<i class="flaticon-search"></i>
												</span>
												<span class="m-header-search__input-wrapper">
													<input autocomplete="off" type="text" name="q" class="m-header-search__input" value="" placeholder="Search..." id="m_quicksearch_input" onkeyup="filterTable()">
												</span>
												<span class="m-header-search__icon-close" id="m_quicksearch_close">
													<i class="la la-remove"></i>
												</span>
												<span class="m-header-search__icon-cancel" id="m_quicksearch_cancel">
													<i class="la la-remove"></i>
												</span>
											</div>
										</form>
										
									</div>
									<!--END: Search -->
							
								
									
							</div>
							<br>
							<div class="m-section__content">
								<div class="table-responsive">
									<table class="table table-bordered" id="userTable">
										<thead>
											<tr>
												<th>
													Serial Number
												</th>
												<th>
													Company Name
												</th>
												<th>
													Action
												</th>
											</tr>
										</thead>
										<tbody>
										<?php
											$sql = "SELECT * FROM account";
											$result = $conn->query($sql);
											if ($result->num_rows > 0) {
												while($row = $result->fetch_assoc()) {
													echo "<tr>";
													echo "<td scope=\"row\">".$row["UEN"]."</td>";
													echo "<td>".$row["companyName"]."</td>";
													echo "<td>";
													echo "<button type=\"button\" class=\"btn btn-danger\">Delete</button>";
													echo "</td>";
													echo "</tr>";
												}
											} else {
												echo "<tr> No Results Found </tr>";
											}
											$conn->close();
										?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<!--end::Section-->
					</div>
					<!--end::Form-->
				</div>
				<!--end::Portlet-->
							</div>
							</div>
</div>
</div>
</div>
<script language='javascript'>
	function filterTable() {
    var input = document.getElementById("m_quicksearch_input");
    var filter = input.value.toUpperCase();
    var table = document.getElementById("userTable");
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
</script>
		<?php include '../general/footer_content.php';?>
	<?php include '../general/footer.php';?>