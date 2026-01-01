<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ProfileModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$profileModel = new ProfileModel;
$profileDAO = new ProfileDAO();
$table = "profile";

$sort="";
if ( isset($applicantId) && $applicantId != "" )
    $sort = " where applicantId = '".$applicantId."'";

if ( $admin != $adminWeb ) {
    if ( $sort == "" ) {
        $sort = " where super_applicant <= ".$admin;
    } else {
        $sort .= " and super_applicant <= ".$admin;
    }
}

$profiles =$profileDAO->getRecord($table,$sort);

if ( $profiles ) {
    $profiles = convert2array($profiles);
}

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>
