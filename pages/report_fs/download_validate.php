
<?php
require_once '../db_connection/db.php';
include '../general/header.php'; ?>

<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--signin m-login--2 m-login-2--skin-2" id="m_login" style="background-image: url(../../assets/app/media/img/bg/login.jpg);">
            <div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
                <div class="m-login__container">

<?php
if (isset($_GET['filename'])){
    $queryManage = $DB_con->prepare("SELECT * FROM usermanageaccount WHERE user_username = :username");
    $queryManage->bindParam(':username', $_SESSION['username']);
    $queryManage->execute();
    $result = $queryManage->setFetchMode(PDO::FETCH_ASSOC);
    $result = $queryManage->fetchAll();
    $uenNumber = array();
    for ($i = 0; $i < count($result); $i++){
      array_push($uenNumber,$result[$i]['account_UEN']);
    }
    $query = $DB_con->prepare("SELECT * FROM account WHERE UEN IN (:uenNumber)");
    $uenNumber = implode(",",$uenNumber);
    $query->bindParam(':uenNumber',$uenNumber);
    $query->execute();
    $result = $query->setFetchMode(PDO::FETCH_ASSOC);
    $result = $query->fetchAll();
    $valid = 0;

    for ($i = 0; $i < count($result); $i++){
      if (strcasecmp($result[$i]['companyName'],$_GET['filename']) === 0){
        $valid = 1;
      }
    }

    if ($valid == 1){
      echo "<form action='download.php' name='validateDownload' method='post'>";
      $filename = $_GET['filename'];
      echo "<input type='hidden' name='filename' value='" . $filename . "'/>";
      echo "<input type='hidden' name='valid' value='1'/>";
      echo "<h2>Your download should be starting soon...</h2><br/>";
      echo "<div align='center'><input class='btn btn-success' type='submit' name='submit' value='Download' id='submit'/></div>";
      echo "</form>";
      echo "<script>submitBtn = document.getElementById('submit');
      submitBtn.click();
      submitBtn.disabled = 'disabled';
      setTimeout(submitBtn.disabled = false, 3000);
      </script>";
    } else {
      header("Location: fs_index.php");
    }
} else {
  header("Location: fs_index.php");
}

?>
</div>
        </div>
    </div>
<?php include '../general/footer.php'; ?>
