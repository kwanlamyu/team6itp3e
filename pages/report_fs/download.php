<?php
if (isset($_POST['filename']) && isset($_POST['valid'])){
  if ($_POST['valid'] == 1){
    $dir = "Files Generated/";
    $fileOriginal = $_POST['filename'];
    $filename = $fileOriginal . ".docx";
    $txtFile = $dir . $fileOriginal . " Values Mismatch.txt";
    $file = $dir . $filename;
    if (file_exists($file)) {
        $file_names = array($file,$txtFile);
        $archive_file_name = $fileOriginal . ".zip";
        $zip = new ZipArchive();
        if ($zip->open($dir . $archive_file_name, (ZipArchive::CREATE | ZipArchive::OVERWRITE))!==TRUE) {
          exit("cannot open <$archive_file_name>\n");
        }
        foreach($file_names as $files){
          $zip->addFile($files);
        }
        $zip->close();
          $basename = basename($dir . $archive_file_name);
          $length = sprintf("%u", filesize($dir . $archive_file_name));
          header('Content-Description: File Transfer');
          header('Content-Type: application/zip');
          header("Content-Transfer-Encoding: Binary");
          header('Content-Disposition: attachment; filename="'. $basename .'"');
          header('Expires: 0');
          header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
          header('Pragma: public');
          set_time_limit(0);
          readfile($dir . $archive_file_name);
          exit;
    }
  }
} else {
  header("Location: fs_index.php");
}
?>
