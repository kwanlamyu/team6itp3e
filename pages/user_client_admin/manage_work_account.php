<?php
require_once '../db_connection/db.php';
//check for username and role_id
if (isset($_SESSION['username']) && $_SESSION['role_id'] == '2') {
    include '../general/header.php';
    include '../general/navigation_clientadmin.php';
    ?>
<div class="m-grid__item m-grid__item--fluid m-wrapper">

        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Financial Statement
                    </h3>
                    <!--                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
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
                                        </ul>-->

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
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Delete Accountant Account
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--BEGIN: Table-->
                        <?php
                        if (isset($_GET['createWorkButton'])) {
                            $accountants = $_GET['createWorkButton'];
        //                $userID = $_SESSION["username"];
                            // $userID = "Jerome";
        //                echo'after post statement';
                        }
                        ?>
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="manageWorkAccount" name="manageWorkAccount" action="../user_client_admin/manage_work_account.php" method="POST">
                            <?php include('../user_client_admin/manage_work_validation.php'); ?>

                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <!-- Account UEN -->
                                    <label class="col-lg-2 col-form-label" for="select_uen">Account UEN</label>
                                    <div class="col-lg-3">
                                        <select  class="form-control" id="select_uen" name="select_uen">
                                            <option>--- Select UEN ---</option>
                                            <?php
                                            //get UENs
                                            $uensql = $DB_con->prepare("SELECT UEN FROM account WHERE 1");
                //                            echo'statement prepared';
                                            $uensql->execute();
                                            $uenNum = $uensql->fetchAll();

                                            if (count($uenNum) == 0) {
                                                //selection blank
                                                echo '<option> </option>';
                                            } else {
                                                //select UENs
                //
                                                $counter = 0;
                                                foreach ($uenNum as $row) {
                //                                    echo'rows echoed';

                                                    echo "<option value='" . $row['UEN'] . "'>" . $row['UEN'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Account Manager -->
                                    <label class="col-lg-2 col-form-label" for="select_accountant">Account Manager</label>
                                    <div class="table-responsive table-scroll">
                                        <table class="table table-hover table-room">
                                            <thead>
                                            <th>Accountant</th>
                                            <th>Select</th>
                                            </thead>

                                            <tbody>
                                                <?php
                                                //                            echo'after table body';
                                                $sql = $DB_con->prepare("SELECT username FROM user WHERE role_id = 3");
                                                //                            echo'statement prepared';
                                                $sql->execute();
                                                $users = $sql->fetchAll();
                                                //                            echo'statement executed';
                                                if (count($users) == 0) {
                                                    echo '<tr>'
                                                    . '<td> </td>'
                                                    . '<td> </td>'
                                                    . '</tr>';
                                                } else {
                                                    //                                echo'else condition reached';
                                                    $counter = 0;
                                                    foreach ($users as $row) {
                                                        //                                    echo'rows echoed';
                                                        echo ""
                                                        . "<tr>"
                                                        . "<td id='accountant_username" . $counter . "'>{$row['username']}</td>"
                                                        . "<td id='select_users'>"
                                                        . "<input type='checkbox' name='select_Collaborator[]' id='select_Collaborator" . $counter . "' value='" . $row['username'] . "'>"
                                                        . "</td>"
                                                        . "</tr>\n";
                                                        $counter++;
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- submit button -->
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-5"></div>
                                        <div class="col-lg-7">
                                            <button type="submit" name="manageWorkButton" id="manageWorkButton" class="btn btn-success">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-danger">
                                                Clear
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <!--END: Table-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>


<!--    <div class="row">
        <div class="card">
            <div class="card-body">
                <?php
                if (isset($_GET['createWorkButton'])) {
                    $accountants = $_GET['createWorkButton'];
//                $userID = $_SESSION["username"];
                    $userID = "Jerome";
//                echo'after post statement';
                }
                ?>
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
                <form id="manageWorkAccount" name="manageWorkAccount" action="../user_client_admin/manage_work_validation.php" method="POST">
                    <?php include('../user_client_admin/manage_work_validation.php'); ?>
                    <div class="form-group">
                        <label for="select_uen">Account UEN</label>
                        <select  class="form-control" id="select_uen" name="select_uen">
                            <option>--- Select UEN ---</option>
                            <?php
                            //get UENs
                            $uensql = $DB_con->prepare("SELECT UEN FROM account WHERE 1");
//                            echo'statement prepared';
                            $uensql->execute();
                            $uenNum = $uensql->fetchAll();

                            if (count($uenNum) == 0) {
                                //selection blank
                                echo '<option> </option>';
                            } else {
                                //select UENs
//
                                $counter = 0;
                                foreach ($uenNum as $row) {
//                                    echo'rows echoed';

                                    echo "<option value='" . $row['UEN'] . "'>" . $row['UEN'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="select_accountant">Account Manager</label>
                        <div class="table-responsive table-scroll">
                            <table class="table table-hover table-room">
                                <thead>
                                <th>Accountant</th>
                                <th>Select</th>
                                </thead>

                                <tbody>
                                    <?php
                                    //                            echo'after table body';
                                    $sql = $DB_con->prepare("SELECT username FROM user WHERE role_id = 3");
                                    //                            echo'statement prepared';
                                    $sql->execute();
                                    $users = $sql->fetchAll();
                                    //                            echo'statement executed';
                                    if (count($users) == 0) {
                                        echo '<tr>'
                                        . '<td> </td>'
                                        . '<td> </td>'
                                        . '</tr>';
                                    } else {
                                        //                                echo'else condition reached';
                                        $counter = 0;
                                        foreach ($users as $row) {
                                            //                                    echo'rows echoed';
                                            echo ""
                                            . "<tr>"
                                            . "<td id='accountant_username" . $counter . "'>{$row['username']}</td>"
                                            . "<td id='select_users'>"
                                            . "<input type='checkbox' name='select_Collaborator[]' id='select_Collaborator" . $counter . "' value='" . $row['username'] . "'>"
                                            . "</td>"
                                            . "</tr>\n";
                                            $counter++;
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <button type="submit" name="manageWorkButton" id="manageWorkButton" class="btn btn-primary col-lg-12" > Save </button>

                </form>
                <hr>
                <p><a href="../user_client_admin/client_admin_dashboard.php">Return to dashboard</a></p>
            </div>
        </div>
    </div>-->

    <?php
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '1') {
    header('Location: ../user_super_admin/userdashboard.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '3') {
    header('Location: ../user_client_admin/client_admin_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>
