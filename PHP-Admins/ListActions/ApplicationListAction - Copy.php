<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicationModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$applicationModel = new ApplicationModel;
$applicationDAO = new ApplicationDAO();
$table = "application";
$sort = "";
$applications =$applicationDAO->getRecord($table,$sort);

if ( $applications ) {
    $applications = convert2array($applications);
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>
