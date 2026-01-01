<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/EeoDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/EeoModel.php';

$eeoModel = new EeoModel;
$eeoDAO = new EeoDAO();
$table = "eeo";

if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    $hdrLocation=$homeDir."FRCCareer.php";
    if ( $rtnPage != "" ) {
//            $hdrLocation = $rtnPage;
        }

    if ( $cancel != ""){
        $_SESSION['ERRMSG_ARR'] = null;
        $_SESSION['ERRFLAG'] = null;
        if ( $loginId == "0" ){
//            $hdrLocation=$homeDir."FRCCareer.php";
            $table="applicant";
            $section="login";
            $paramString = "careerIds=".$careerIds."&edit=apply&formAction=new";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        } else {
//            $hdrLocation=$homeDir."FRCCareer.php";
            $section="career";
            $sub_section="findJobList";
            $table="career";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        }
    }
    switch ($formAction){
        case "edit":
            $eeoModel = shufflearray2object($_POST,$eeoModel);
            $stat = $eeoDAO->saveUpdate ($eeoModel,$table);
                if ( isset($page) && $page != "" ) {
//                    $hdrLocation=$homeDir."PHP-Jobs/Forms/ActionForm.php";
                    $table = "resume";
                    $paramString="id=0&applicantId=".$applicantId."&edit=edit&formAction=edit";
                    $paramString.="&prevpage=".$prevpage."&page=".$page."&nextPage=".$nextpage;
                }
            $_SESSION['ERRMSG_ARR'] = null;
            $_SESSION['ERRFLAG'] = null;
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            break;
        case "new":
            $eeoModel = shufflearray2object($_POST,$eeoModel);
            $stat = $eeoDAO->saveUpdate ($eeoModel,$table);
                if ( isset($page) && $page != "" ) {
//                    $hdrLocation=$homeDir."PHP-Jobs/Forms/ActionForm.php";
                    $table = "resume";
                    $paramString="id=0&applicantId=".$applicantId."&edit=edit&formAction=new&careerIds=".$careerIds;
                    $paramString.="&prevpage=".$prevpage."&page=".$page."&nextPage=".$nextpage;
                }
            $_SESSION['ERRMSG_ARR'] = null;
            $_SESSION['ERRFLAG'] = null;
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            break;
        case "delete": 
            $stat = $eeoDAO->delete ($id,$table);
            $_SESSION['ERRMSG_ARR'] = null;
            $_SESSION['ERRFLAG'] = null;
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            break;
        }
} 
$sort = " where id = '".$id."'";
if ( isset($applicantId) && $applicantId != "" && $applicantId > 0 ) {
    $sort = " where applicantId = '".$applicantId."'";
}
$eeoModel =$eeoDAO->getRecord($table,$sort);
if ( $eeoModel == "" ) {
    $eeoModel = new EeoModel();
    $eeoModel->applicantId = $applicantId;
}
 
$page = "eeo";
$prevpage = "certification";
$nextpage = "resume";
 
//Check whether the query was successful or not
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}

?> 
