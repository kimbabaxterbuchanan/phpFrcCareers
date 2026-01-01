<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/EeoDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/EeoModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$eeoModel = new EeoModel;
$eeoDAO = new EeoDAO();
$table = "eeo";

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

$eeos =$eeoDAO->getRecord($table,$sort);

if ( $eeos ) {
    $eeos = convert2array($eeos);
}

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>
