<?php
if (isset($_SESSION['username']) || isset($_SESSION['role_id']) || isset($_SESSION['company'])){
    if ($_SESSION['role_id'] != 2 && $_SESSION['role_id'] != 3){
      header("Location: ../user_login/login.php");
    } else {
$file = 'preview.docx';
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/docx');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
} else {
  echo "<script>alert('NOPE')</script>";
}
}
} else {
header("Location: ../user_login/login.php");
}
?>
