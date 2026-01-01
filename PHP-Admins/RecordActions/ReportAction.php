<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ReportDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ReportModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$reportModel = new ReportModel;
$reportDAO = new ReportDAO();
$table = "report";
$dataCheck = array();
$optType = "";
$optVar = "";
$selSelect = "";
$selFrom = "";
$selWhere = "";
$selOrder = "";
if ( ! isset($postForm) || $postForm == "" ) {
    $sort = " where id = '".$id."'";
    if ( isset($name) && $name != "" ) {
        $sort = " where name = '".$name."'";
    }
    $reportModel =$reportDAO->getRecord($table,$sort);
    if ( ! $reportModel ) {
        $reportModel = new ReportModel();
        $reportModel->name = $name;
    } else {
        $reportModel->reportsql = urldecode($reportModel->reportsql);
    }
}
if ( isset($postForm) && $postForm != "" ) {
    //Sanitize the POST values
    $sort = " where id = '".$id."'";
    if ( isset($name) && $name != "" ) {
        $sort = " where name = '".$name."'";
    }
    $reportModel = $reportDAO->getRecord($table,$sort);
    if ( ! $reportModel ) $reportModel = new ReportModel;
    switch ($formAction){
        case "edit":
            $reportModel = shufflearray2object($_POST,$reportModel);
            $reportModel->reportsql = urlencode($reportModel->reportsql);
            $stat = $reportDAO->saveUpdate ($reportModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
        case "new":
            $reportModel = shufflearray2object($_POST,$reportModel);
            $reportModel->reportsql = urlencode($reportModel->reportsql);
            $stat = $reportDAO->saveUpdate ($reportModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
        case "delete":
            $stat = $reportDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
    }

}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>