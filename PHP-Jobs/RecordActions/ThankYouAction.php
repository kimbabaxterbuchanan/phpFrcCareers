<?php
//Start session
session_start();
if ( isset($postForm) && $postForm != "" ) {
    $table = "career";
    $hdrLocation = $homeDir."FRCCareer.php";
    $sub_section="FindJobList";
    $section="career";
    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
} 
?>
