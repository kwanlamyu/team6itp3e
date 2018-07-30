<?php
require_once '../db_connection/db.php';
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
      echo "<span>Your download should be starting soon...<br/>";
      echo "<input type='submit' name='submit' value='Download' id='submit'/>";
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
