<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ReportDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ReportModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$reportModel = new ReportModel;
$reportDAO = new ReportDAO();
$table = "report";
$sort = "";
$reports =$reportDAO->getRecord($table,$sort);

if ( $reports ) {
    $reports = convert2array($reports);
}

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>
