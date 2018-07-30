<?php

$dir = "files generated/";
$filename = $_GET['filename'] . ".docx";
$file = $dir . $filename;
if (file_exists($file)) {
    $basename = basename($file);
    $length = sprintf("%u", filesize($file));
    header('Content-Description: File Transfer');
    header('Content-Type: application/docx');
    header('Content-Disposition: attachment; filename="' . $basename . '"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . $length);
    set_time_limit(0);
    readfile($file);
    exit;
}
?>