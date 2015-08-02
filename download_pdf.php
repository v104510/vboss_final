<?php
ini_set("error_reporting", false);
ini_set("display_errors", false);

$file = $_REQUEST["file_name"];
$file_path = $_SERVER['DOCUMENT_ROOT'].'/vboss/PDF/'.$file;

header('Content-type: application/pdf');
header("Content-Disposition: inline; filename='".$file."'");
readfile($file_path);
