<?php
/*
 * front-end code for tagging accoutnant(s) to a company account
 */
?>


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
                    <h3 class="m-subheader__title">
                        Tag Accountants To Client
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
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Tag Accountants
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--BEGIN: Table-->
                        <?php
                        if (isset($_GET['createWorkButton'])) {
                            $accountants = $_GET['createWorkButton'];
                        }
                        ?>
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="manageWorkAccount" name="manageWorkAccount" action="../user_client_admin/manage_work_account.php" method="POST">
                            <?php include('../user_client_admin/manage_work_validation.php'); ?>
                            <?php if (!empty($successMessage)) { ?>
                                <br>
                                <div align="center"><div class="alert alert-success col-lg-5" role="alert"><?php echo $successMessage; ?></div></div>
                            <?php } ?>
                            <?php if (!empty($errorMessage)) { ?>
                                <br>
                                <div align="center"><div class="alert alert-danger col-lg-5" role="alert"><?php echo $errorMessage; ?></div></div>
                          <?php } ?>

                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <!-- Account UEN -->
                                    <label class="col-lg-2 col-form-label" for="select_uen">Account UEN</label>
                                    <div class="col-lg-7">
                                        <select  class="form-control" id="select_uen" name="select_uen">
                                            <option value=''>--- Select UEN ---</option>
                                            <?php
                                            //get UENs
                                            $uensql = $DB_con->prepare("SELECT UEN, companyName FROM account WHERE user_username = '".$_SESSION['username']."'");
                                            $uensql->execute();
                                            $uenNum = $uensql->fetchAll();

                                            if (count($uenNum) == 0) {
                                                //selection blank
                                                echo '<option value=""> </option>';
                                            } else {
                                                //select UENs
                                                $counter = 0;
                                                foreach ($uenNum as $row) {

                                                    echo "<option value='" . $row['UEN'] . "'>" . $row['UEN'] ." - " . $row['companyName'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <!-- Account Manager -->
                                    <label class="col-lg-2 col-form-label" for="select_accountant">Account Manager</label>
                                    <div class="table-responsive table-scroll col-lg-7">
                                        <table class="table table-hover table-room">
                                            <thead>
                                            <th>Accountant</th>
                                            <th>Select</th>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $sql = $DB_con->prepare("SELECT username FROM user WHERE role_id = 3 and companyName ='".$_SESSION['company']."'");
                                                $sql->execute();
                                                $users = $sql->fetchAll();

                                                $alreadyAssignedQuery = $DB_con->prepare("SELECT user_username FROM usermanageaccount WHERE user_role_id = 3");
                                                $alreadyAssignedQuery->execute();
                                                $alreadyAssignedUser = $alreadyAssignedQuery->fetchAll();

                                                if (count($users) == 0) {
                                                    echo '<tr>'
                                                    . '<td> </td>'
                                                    . '<td> </td>'
                                                    . '</tr>';
                                                } else {
                                                    $counter = 0;
                                                    foreach ($users as $row) {
                                                      $errFlag = 0;
                                                      for ($i = 0; $i < count($alreadyAssignedUser);$i++){
                                                        if (strcasecmp($row['username'],$alreadyAssignedUser[$i]['user_username']) === 0){
                                                          $errFlag = 1;
                                                          break;
                                                        }
                                                      }
                                                      if ($errFlag == 0){
                                                        echo ""
                                                        . "<tr>"
                                                        . "<td id='accountant_username" . $counter . "'>{$row['username']}</td>"
                                                        . "<td id='select_users'>"
                                                        . "<label class='m-checkbox'><input type='checkbox' name='select_Collaborator[]' id='select_Collaborator" . $counter . "' value='" . $row['username'] . "' onClick='updateProperty(" . $counter . ")'><span></span></label>"
                                                        . "</td>"
                                                        . "</tr>\n";
                                                        $counter++;
                                                      }
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
                                            <button type="submit" name="manageWorkButton" id="manageWorkButton" class="btn btn-success" disabled>
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
                        <scfip
                        <!--END: Table-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
    </div>
    
    <script>
        
        function updateProperty(x){
            if(document.getElementById('select_Collaborator'+x).checked){
                document.getElementById("manageWorkButton").disabled = false;
            }
            else{
                document.getElementById("manageWorkButton").disabled = true;
            }          
            
        }
    

</script>

    <?php
    include '../general/footer_content.php';
    include '../general/footer.php';
}//end of session and role_id checking
elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '1') {
    header('Location: ../user_super_admin/super_admin_dashboard.php');
} elseif (isset($_SESSION['username']) && $_SESSION['role_id'] === '3') {
    header('Location: ../user_accountant/accountant_dashboard.php');
} else {
    header('Location: ../user_login/login.php');
}
?>
