<?php
//if (isset($_GET['file'])) {
$file = $_GET['file'];

/*if (file_exists($file) && is_readable($file)) {
 header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment; filename=\"$file\"");
header('Content-Length:'.filesize($file));
 readfile($file);
 }
 
*/
if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    //set_time_limit(0);
	//ob_clean();
	//flush();
	ob_end_clean();
	readfile($file);
	
    exit;
}