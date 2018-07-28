<?php
require_once '../db_connection/db.php';
if (isset($_SESSION['username']) || isset($_SESSION['role_id']) || isset($_SESSION['company'])){
    if ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3){
      header('Location: ../user_super_admin/userdashboard.php');
    } else {
    include "../general/header.php";
    if ($_SESSION['role_id'] == 2){
      include '../general/navigation_clientadmin.php';
    } else {
      include '../general/navigation_accountant.php';
    }
    
    $query = $DB_con->prepare("SELECT * FROM usermanageaccount WHERE user_username=:userName");
    $username = $_SESSION['username'];
    $query->bindParam(':userName', $username);
    $query->execute();
    $result = $query->setFetchMode(PDO::FETCH_ASSOC);
    $result = $query->fetchAll();

    $allUEN = array();
    for ($i = 0; $i < count($result); $i++){
      array_push($allUEN, $result[$i]['account_UEN']);
    }
    if (count($allUEN) != 0){
        $uenQuery = "SELECT * FROM account WHERE UEN = '";
        for ($i = 0; $i < count($allUEN); $i++){
          if ($i > 0){
            $uenQuery .= " OR UEN ='";
          }
          $uenQuery .= $allUEN[$i] . "'";
          if ($i == count($allUEN) - 1){
            $uenQuery .= ";";
          }
        }
        $uenQuery = $DB_con->prepare($uenQuery);
        $uenQuery->execute();
        $uenResult = $uenQuery->setFetchMode(PDO::FETCH_ASSOC);
        $uenResult = $uenQuery->fetchAll();
    }
    ?>
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title">
                        Financial Statement
                    </h3>
                </div>
            </div>
        </div>
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
                                        Select Client
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div>
						<div class="m-portlet__body">
							<div class="m-section">
                          <?php
                          if (count($allUEN) != 0){
                          ?>
                            <form name='companyUEN' method='post' action='fs_main.php' enctype="multipart/form-data" class="m-form m-form--fit m-form--label-align-right">
                            <select id='companyValue' onchange='setUEN()' name="companyValue" class="form-control">
                              <?php
                              for ($i = 0; $i < count($uenResult); $i++){
                                ?>
                                <option value='<?php echo $uenResult[$i]['companyName'];?>'><?php echo $uenResult[$i]['companyName'];?></option>
                                <?php
                                if ($i == 0){
                                  ?>
                                  <div class="col-lg-3">
                                  <?php
                                  echo "<input type='hidden' name='companyName' id='companyName' value='" . $uenResult[$i]['companyName'] . "'/>";
                                  echo "<input type='hidden' name='uenNumber' id='uenNumber' value='" . $uenResult[$i]['UEN'] . "'/>";
                                }
                              }
                              ?>
                            </div>
                              <input class="btn btn-success" type="submit" name="submit" id="submit"></input>
                            </form>
                            <?php
                          } else {
                            ?>
							
                            <span class="m-section__sub">You have not been assigned a client.</span>
							
                            <?php
                          }
                          ?>
						  </div>
							</div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
	  </div>
      <?php
      if (count($allUEN) != 0){
        ?>
        <script>

        function setUEN(){
          var allCompany = <?php echo json_encode($uenResult);?>;
          var companyValue = document.getElementById("companyValue").value;
          for (i = 0; i < allCompany.length; i++){
            if (allCompany[i]['companyName'] == companyValue){
              document.getElementById("companyName").value = allCompany[i]['companyName'];
              document.getElementById("uenNumber").value = allCompany[i]['UEN'];
            }
          }
        }

        </script>
        <?php
      }
  }
} else {
  header("Location: ../user_login/login.php");
}
include '../general/footer_content.php';
include "../general/footer.php";
?>