<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ResumeDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ResumeModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$resumeModel = new ResumeModel;
$resumeDAO = new ResumeDAO();
$table = "resume";

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

$resumes =$resumeDAO->getRecord($table,$sort);

if ( $resumes )
    $resumes = convert2array($resumes);

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
