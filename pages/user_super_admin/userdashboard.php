<?php
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] === '1') {
    require_once '../db_connection/db.php';
    include '../general/header.php';
    include '../general/navigation_superadmin.php';
    ?>

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
                                                $select = $DB_con->prepare("SELECT * FROM account");
                                                $select->execute();

                                                while ($result = $select->fetch(PDO::FETCH_ASSOC)) {
                                                    if (!empty($result)) {
                                                        echo "<tr>";
                                                        echo "<td scope=\"row\">" . $result['UEN'] . "</td>";
                                                        echo "<td scope=\"row\">" . $result['companyName'] . "</td>";
                                                        echo "<td><button type=\"button\" class=\"btn btn-danger\">Delete</button></td>";
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
    <?php
    //include footer and footer content
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '2') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '3') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>