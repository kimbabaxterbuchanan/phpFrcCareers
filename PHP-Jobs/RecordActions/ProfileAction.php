<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ProfileModel.php';

$profileModel = new ProfileModel;
$profileDAO = new ProfileDAO();
$table = "profile";
if ( isset($postForm) && $postForm != "" ) {
    //Sanitize the POST values
    $hdrLocation=$homeDir."FRCCareer.php";
    if ( $rtnPage != "" ) {
//        $hdrLocation = $rtnPage;
    }

    if ( $cancel != ""){
        $_SESSION['ERRMSG_ARR'] = null;
        $_SESSION['ERRFLAG'] = null;
        if ( $loginId == "0" ){
//            $hdrLocation=$homeDir."PHP-FileIncludes/loginForm.php";
            $table="applicant";
            $section="login";
            $paramString = "careerIds=".$careerIds."&edit=apply&formAction=new";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        } else {
 //           $hdrLocation=$homeDir."PHP-Jobs/Forms/ListForm.php";
            $section="career";
            $sub_section="findJobList";
            $table="career";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        }
    }
    if ( $formAction == "edit" || $formAction == "new" ) {

    }
    if ( !$errflag){
        switch ($formAction){
            case "edit":
                $profileModel = shufflearray2object($_POST,$profileModel);
                $stat = $profileDAO->saveUpdate ($profileModel,$table);
                if ( isset($page) && $page != "" ) {
//                    $hdrLocation=$homeDir."FRCCareer.php";
                    $table = "certification";
                    $paramString="id=0&applicantId=".$applicantId."&edit=edit&formAction=edit";
                    $paramString.="&prevpage=".$prevpage."&page=".$page."&nextpage=".$nextpage;
                }
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                break;
                case "new":
                    $profileModel = shufflearray2object($_POST,$profileModel);
                    $stat = $profileDAO->saveUpdate ($profileModel,$table);
                    if ( isset($page) && $page != "" ) {
//                        $hdrLocation=$homeDir."FRCCareer.php";
                        $table = "certification";
                        $paramString="id=0&applicantId=".$applicantId."&edit=edit&formAction=new&careerIds=".$careerIds;
                        $paramString.="&prevpage=".$prevpage."&page=".$page."&nextpage=".$nextpage;
                    } else {
                        $hdrLocation=$homeDir."FRCCareer.php";
                        $table="applicant";
                        $paramString = "section=login";
                        $paramString="";
                    }
                    $_SESSION['ERRMSG_ARR'] = null;
                    $_SESSION['ERRFLAG'] = null;
                    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                    break;
                    case "delete":
                        $stat = $profileDAO->delete ($id,$table);
                        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
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

            $sort = " where id = '".$id."'";
            if ( isset($applicantId) && $applicantId != "" && $applicantId > 0 ) {
                $sort = " where applicantId = '".$applicantId."'";
            }
            $profileModel = $profileDAO->getRecord($table,$sort);
            if ( $profileModel == "" ) {
                $profileModel = new ProfileModel;
                $formAction = "new";
                $profileModel->applicantId = $applicantId;
            }
            
            $page = "profile";
            $prevpage = "applicant";
            $nextpage = "certification";

            //Check whether the query was successful or not
            if($errflag) {
                $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                session_write_close();
                //            header("location: applicantForm.php?id=".$id);
                //            exit();
            }
            ?>