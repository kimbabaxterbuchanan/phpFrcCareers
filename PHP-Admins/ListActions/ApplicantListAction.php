<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicantDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicantModel.php';

if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        if ( $careerId != "" )
            $sub_section="careerList";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
}

$applicantModel = new ApplicantModel;
$applicantDAO = new ApplicantDAO();
$table = "applicant";

$sort="";
if ( isset($applicantId) && $applicantId != "" )
    $sort = " where id = '".$applicantId."'";

if ( $admin != $adminWeb ) {
    if ( $sort == "" ) {
        $sort = " where id in (select applicantId from profile where super_applicant <= ".$admin.") or id not in (select applicantId from profile)";
    } else {
        $sort .= " and id in (select applicantId from profile where super_applicant <= ".$admin.") or id not in (select applicantId from profile)";
    }
}

$applicants =$applicantDAO->getRecord($table,$sort);
$ary = array();

if ( $sub_section == "" ) 
    $sub_section = "applicantList";

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
if ( isset($careerId) && $careerId != "" ) {
    require_once dirname(__FILE__) .'/../../PHP-DAOs/CareerDAO.php';
    require_once dirname(__FILE__) .'/../../PHP-models/CareerModel.php';
    require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicationDAO.php';
    require_once dirname(__FILE__) .'/../../PHP-models/ApplicationModel.php';

    $applicationModel = new ApplicationModel;
    $applicationDAO = new ApplicationDAO();

    $careerModel = new CareerModel;
    $careerDAO = new CareerDAO();
    $sort = " where id = '".$careerId."'";
    $careerModel = $careerDAO->getRecord('career',$sort);
    $req_number = $careerModel->req_number;

    $sort = " where careerId = '".$careerId."'";
    $applications = $applicationDAO->getRecord('application',$sort);
    $applications = convert2array($applications);
    $applicants = array();
    for ( $i = 0; $i < count($applications); $i += 1 ) {
        $applicantId = $applications[$i]->applicantId;
        $sort = " where id = '".$applicantId."'";
        $applicant = $applicantDAO->getRecord($table,$sort);
        if ( $applicant )
            $applicants[] = $applicant;
    }
    $hidecreate = true;
}
    $hdLabel0 = getLabel("contact",$locale);
    $hdLabel1 = getLabel("profile",$locale);
    $hdLabel2 = getLabel("certification",$locale);
    $hdLabel3 = getLabel("eeo",$locale);
    $hdLabel4 = getLabel("resume",$locale);
    $phdr = "<table align='center' width='100%' border='0'><tr><td width='".$width."'>".$hdLabel0."</td><td width='".$width."'>".$hdLabel1."</td><td width='".$width."'>".$hdLabel2."</td><td width='".$width."'>".$hdLabel3."</td><td width='".$width."'>".$hdLabel4."</td></tr></table>";
    $profile="profile";
    $certification = "certification";
    $eeo = "eeo";
    $resume = "resume";


if ( $applicants ) {
    $applicants = convert2array($applicants);
}


?>