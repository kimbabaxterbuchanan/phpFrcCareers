<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ProfileModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        $_SESSION['ERRMSG_ARR'] = null;
        $_SESSION['ERRFLAG'] = null;
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$profileModel = new ProfileModel;
$profileDAO = new ProfileDAO();
$table = "profile";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    if ( $formAction == "edit" || $formAction == "new" ) {
        } 
    if ( !$errflag){
            switch ($formAction){
                case "edit":
                    $profileModel = shufflearray2object($_POST,$profileModel);
                    $stat = $profileDAO->saveUpdate ($profileModel,$table);
                    if ( $stat ) {
                        $_SESSION['ERRMSG_ARR'] = null;
                        $_SESSION['ERRFLAG'] = null;
                        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                    }
                    break;
                case "new":
                    $profileModel = shufflearray2object($_POST,$profileModel);
                    $stat = $profileDAO->saveUpdate ($profileModel,$table);
                    if ( $stat ) {
                        $page = "profile";
                        $prevpage = "applicant";
                        $nextpage = "certification";
                        $table = "certification";
                        $paramString="menuaction=action&applicantId=".$applicantId."&edit=edit&formAction=new";
                        $paramString.="&prevpage=".$prevpage."&page=".$page."&nextPage=".$nextpage;
                        $_SESSION['ERRMSG_ARR'] = null;
                        $_SESSION['ERRFLAG'] = null;
                        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                    }
                    break;
                case "delete":
                    $stat = $profileDAO->delete ($id,$table);
                    if ( $stat ) {
                        $_SESSION['ERRMSG_ARR'] = null;
                        $_SESSION['ERRFLAG'] = null;
                        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                    }    
                break;
                }
        }

} 
$sort = " where locale = 'All'";
$langModel = $langDAO->getRecord("language",$sort);
if ( $langModel == "" ) {
    $langModel = new LanguageModel;
    $langModel->locale = $locale;
}
$localeAry = split(",",$langModel->resource_value);

$sort = " where applicantId = '".$applicantId."'";
if ( isset($id) && $id != "" && $id > 0 ) {
    $sort = " where id = '".$id."'";
}
$profileModel = $profileDAO->getRecord($table,$sort);

if ( $profileModel == "" ) {
    $profileModel = new ProfileModel;
    $profileModel->applicantId = $applicantId;
    $formAction = "new";
}
//Check whether the query was successful or not
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>