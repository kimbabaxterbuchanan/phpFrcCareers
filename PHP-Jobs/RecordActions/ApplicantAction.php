<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicantDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicantModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicationModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ProfileModel.php';
$applicationModel = new ApplicationModel;
$applicationDAO = new ApplicationDAO();
$profileModel = new ProfileModel;
$profileDAO = new ProfileDAO();

$table="applicant";

if ( $edit == "apply"){
    if ( $loginId != "0" ){
            $sort = " where applicantId = '".$loginId."' and careerId in (".$careerIds.")";
            $applications =$applicationDAO->getRecord("application",$sort);
            $fndJobAry = "";
            $comma = "";
            if ( $applications ) {
                    $applications = convert2array($applications);
                    foreach( $applications as $model ) {
                            if ( $model ) {
                                    $obj = new StdClass();
                                    foreach ( $model as $key => $val ) {
                                            if ( $key == "careerId") {
                                                    $fndJobList .= "#".$val."&";
                                                    $comma = ",";
                                                }
                                        }
                                }
                        }
                }
            $jobAry = split(",",$jobLst);
            for ( $i = 0; $i < count($jobAry); $i += 1 ) {
                    $val = $jobAry[$i];
                    if ( $val != "" && strstr($fndJobList,"#".$val."&") === false ) {
                            $applicationModel->applicantId = $loginId;
                            $applicationModel->careerId = $val;
                            $applicationDAO->saveUpdate($applicationModel,"application");
                        }

                }
            $hdrLocation = $homeDir."FRCCareer.php";
            $table="career";
            $paramString = "";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            exit();
        }
}

$applicantModel = new ApplicantModel;
$applicantDAO = new ApplicantDAO();
$table = "applicant";

//page
// contact
// profile
// resume
// certifications
// eeo

if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    $hdrLocation=$homeDir."FRCCareer.php";
    if ( $rtnPage != "" ) {
//            $hdrLocation = $rtnPage;
        }

    if ( $cancel != ""){
            $_SESSION['ERRMSG_ARR'] = null;
            $_SESSION['ERRFLAG'] = null;
            $section="career";
            $sub_section="findJobList";
            $table="career";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        }
    if ( $formAction == "edit" || $formAction == "new" ) {
            if ( $email == "" ) {
                    $errmsg_arr[] = 'Email is missing';
                    $errflag = true;
                }
            if($password != '' && $cpassword != '' ) {
                    $errflag = checkPassword($password,$errmsg_arr);
                    $errmsg_arr = $_SESSION['ERRMSG_ARR'];

                    if ( !$errflag ) {
                            if( strcmp($password, $cpassword) != 0 ) {
                                    $errmsg_arr[] = 'Passwords do not match';
                                    $errflag = true;
                                } else {
                                    $password = md5($password);
                                }
                        }
            } else  if($password != '' && $cpassword == '' ) {
                    $errmsg_arr[] = 'Confirm Password is missing';
                    $errflag = true;
            } else  if($password == '' && $cpassword != '' ) {
                    $errmsg_arr[] = 'Password is missing';
                    $errflag = true;
            } else  if($password == '' && $cpassword == '' && $org_password == '' && $org_cpassword == '' ) {
                    $errmsg_arr[] = 'Password and Confirm Password are missing';
                    $errflag = true;
            } else {
                    $password = $org_password;
            }
        }
    if ( !$errflag){
            switch ($formAction){
                case "edit":
                    $applicantModel = shufflearray2object($_POST,$applicantModel);
                    $applicantModel->password = $password;
                    $stat = $applicantDAO->saveUpdate ($applicantModel,$table);
                    if ( !isset($_SESSION['SESS_MEMBER_ID']))
                    {
                        $_SESSION['SESS_MEMBER_ID'] = $applicantModel->id;
                        $_SESSION['SESS_FIRST_NAME'] = $applicantModel->first_name;
                        $_SESSION['SESS_LAST_NAME'] = $applicantModel->last_name;
                        $_SESSION['SESS_MIDDLE_INITIAL'] = $applicantModel->middle_initial;
                        $_SESSION['EMAIL'] = $applicantModel->email;
                        $_SESSION['LOGIN'] = $applicantModel->email;
                    }
                    $sort = " where applicantId = '".$applicantModel->id."'";
                    $profileModel = $profileDAO->getRecord("profile",$sort);
                    $_SESSION['ADMIN'] = $profileModel->super_applicant;
                    $_SESSION['LOCALE'] = $profileModel->locale;
                if ( isset($page) && $page != "" ) {
//                    $hdrLocation=$homeDir."FRCCareer.php";
                    $table = "profile";
                    $paramString="id=0&applicantId=".$applicantModel->id."&edit=edit&formAction=edit";
                    $paramString.="&prevpage=".$prevpage."&page=".$page."&nextpage=".$table;
                }
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                break;
                case "new":
                $applicantModel = shufflearray2object($_POST,$applicantModel);
                $applicantModel->password = $password;
                $stat = $applicantDAO->saveUpdate ($applicantModel,$table);
                if ( isset($page) && $page != "" ) {
//                    $hdrLocation=$homeDir."FRCCareer.php";
                    $sort = " where email = '".$applicantModel->email."'";
                    $applicantModel =$applicantDAO->getRecord($table,$sort);
                    $table = "profile";
                    $paramString="id=0&applicantId=".$applicantModel->id."&edit=edit&formAction=new&careerIds=".$careerIds;
                    $paramString.="&prevpage=".$prevpage."&page=".$page."&nextpage=".$table;
                }
                if ( !isset($_SESSION['SESS_MEMBER_ID']))
                {
                    $_SESSION['SESS_MEMBER_ID'] = $applicantModel->id;
                    $_SESSION['SESS_FIRST_NAME'] = $applicantModel->first_name;
                    $_SESSION['SESS_LAST_NAME'] = $applicantModel->last_name;
                    $_SESSION['SESS_MIDDLE_INITIAL'] = $applicantModel->middle_initial;
                    $_SESSION['EMAIL'] = $applicantModel->email;
                    $_SESSION['LOGIN'] = $applicantModel->email;
                }
                $applicationModel->applicantId = $applicantModel->id;
                $applicationModel->careerId = $careerIds;
                $applicationDAO->saveUpdate($applicationModel,"application");
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                break;
                case "delete":
                $stat = $applicantDAO->delete ($id,$table);
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$nextpage);
                break;
                }
        }
}
$sort = " where id = '".$id."'";
if ( isset($email) && $email != "" && $email > 0 && $id == "") {
    $sort = " where email = '".$email."'";
}
$applicantModel =$applicantDAO->getRecord($table,$sort);
if ( $applicantModel == "" ) {
    $applicantModel = new ApplicantModel();
    $applicantModel->email = $email;
}

if ( ! isset($page) ) {
    $page="applicant";
    $prevpage="";
    $nextpage="profile";
}
$enc_password = true;
$enc_key = "password";
$confirm_password = "cpassword";

$page = "applicant";
$prevpage = "none";
$nextpage = "profile";


//Check whether the query was successful or not
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG'] = $errflag;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}

?>