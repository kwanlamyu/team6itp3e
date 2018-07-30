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
      array_push($result[$i]['account_UEN'],$uenNumber);
    }
    $query = $DB_con->prepare("SELECT * FROM account WHERE UEN IN (:uenNumber)");
    $uenNumber = implode(",",$uenNumber);
    $query->bindParam(':uenNumber',$uenNumber);
    $query->execute();
    $result = $query->setFetchMode(PDO::FETCH_ASSOC);
    $result = $query->fetchAll();

    $valid = 0;
    for ($i = 0; $i < count($result); $i++){
      if (strcasecmp($result[$i]['companyName'],$_SESSION['company']) === 0){
        $valid = 1;
      }
    }

    if ($valid == 1){
      $dir = "files generated/";
      $filename = $_GET['filename'] . ".docx";
      $file = $dir . $filename;
      if (file_exists($file)) {
          $basename = basename($file);
          $length = sprintf("%u", filesize($file));
          header('Content-Description: File Transfer');
          header('Content-Type: application/docx');
          header('Content-Disposition: attachment; filename="'. $basename .'"');
          header('Content-Transfer-Encoding: binary');
          header('Expires: 0');
          header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          header('Pragma: public');
          header('Content-Length: '.$length);

          set_time_limit(0);
          readfile($file);
          exit;
      }
    } else {
      header("Location: fs_index.php");
    }
} else {
  header("Location: fs_index.php");
}
?>
