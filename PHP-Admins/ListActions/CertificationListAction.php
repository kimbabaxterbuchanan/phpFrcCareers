<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CertificationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CertificationModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$certificationModel = new CertificationModel;
$certificationDAO = new CertificationDAO();
$table = "certification";

$sort="";
if ( isset($applicantId) && $applicantId != "" )
    $sort = " where applicantId = '".$applicantId."'";

if ( $admin != $adminWeb ) {
    if ( $sort == "" ) {
        $sort = " where applicantId in (select applicantId from profile where super_applicant <= ".$admin.")";
    } else {
        $sort .= " and applicantId in (select applicantId from profile where super_applicant <= ".$admin.")";
    }
}

$certifications =$certificationDAO->getRecord($table,$sort);
if ( $certifications )
    $certifications = convert2array($certifications);

//$homeURL = $homeDir."PHP-FileIncludes/FRCCareerBody.php";
//$sub_section = "applicantList";
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
