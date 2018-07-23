<?php
//check for username and role_id
//if (isset($_SESSION['username']) && ($_SESSION['role_id'] === '2' || $_SESSION['role_id'] === '3')) {
    include '../general/header.php';
    require_once '../db_connection/db.php';
//    if ($_SESSION['role_id'] === '2') {
        include '../general/navigation_clientadmin.php';
//    } elseif ($_SESSION['role_id'] === '3') {
//        include '../general/navigation_accountant.php';
//    }
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
        <!-- END: Subheader -->
        <!-- BEGIN: m-content -->
        <div class="m-content">
            <div class="row">
                <div class="col-xl-12">
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
                                    <div class="col-lg-9" align="left">
                                        <div class="input-group">
                                            <form method="post" action="../user_login/export.php">
                                                <input type="submit" class="btn btn-outline-success" name="export" value="CSV Export"/>
                                            </form> 
                                        </div>
                                    </div>
                                    <!--BEGIN: Search -->
                                    <div class="col-lg-3">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon2">
                                                    <i class="flaticon-search"></i>
                                                </span>
                                            </div>

                                            <input autocomplete="off" type="text" name="q" class="form-control m-input" value="" placeholder="Search..." id="m_quicksearch_input" onkeyup="filterTable()">

                                        </div>

                                    </div>
                                    <!--END: Search -->
                                </div>
                                <br>
                                <div class="m-section__content">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="accountantTable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Username
                                                    </th>
                                                    <th>
                                                        Email
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $select = $DB_con->prepare("SELECT * FROM user WHERE role_id=3;");
                                                $select->execute();

                                                while ($result = $select->fetch(PDO::FETCH_ASSOC)) {
                                                    if (!empty($result)) {
                                                        echo "<tr>";
                                                        echo "<td scope=\"row\">" . $result['username'] . "</td>";
                                                        echo "<td scope=\"row\">" . $result['email'] . "</td>";
                                                        echo "<td><a href='#' class='m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill' title='Edit details'>                            <i class='la la-edit'></i>                        </a>                        <a href='#' class='m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill' title='Delete'>                            <i class='la la-trash'></i>                        </a> </td>";
                                                        echo "</tr>";
                                                    } else {
                                                        echo "<tr> No Results Found </tr>";
                                                    }
                                                }
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
        <!-- END: m-content -->
    </div>
    <!-- END: Subheader -->
    </div>

    <script language='javascript'>
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
    </script>

    <?php 
    include '../general/footer_content.php';
    include '../general/footer.php';
//}//end of session and role_id checking
//elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '1') {
//    header('Location: ../user_super_admin/userdashboard.php');
//} else {
//    header('Location: ../user_login/login.php');
//}
?>