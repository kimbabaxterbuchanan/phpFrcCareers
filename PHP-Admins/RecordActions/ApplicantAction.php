<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicantDAO.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CertificationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/EeoDAO.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ResumeDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicantModel.php';
require_once dirname(__FILE__) .'/../../PHP-models/ProfileModel.php';
require_once dirname(__FILE__) .'/../../PHP-models/CertificationModel.php';
require_once dirname(__FILE__) .'/../../PHP-models/EeoModel.php';
require_once dirname(__FILE__) .'/../../PHP-models/ResumeModel.php';

    $hdrLocation = "";
    $paramString = "menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$applicantModel = new ApplicantModel;
$applicantDAO = new ApplicantDAO();
$profileDAO = new ProfileDAO();
$profileModel = new ProfileModel;
$certificationDAO = new CertificationDAO();
$certificationModel = new CertificationModel;
$eeoDAO = new EeoDAO();
$eeoModel = new EeoModel;
$resumeDAO = new ResumeDAO();
$resmueModel = new ResumeModel;
$table = "applicant";

if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
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
                    if ( $stat ) {
                       $_SESSION['ERRMSG_ARR'] = null;
                        $_SESSION['ERRFLAG'] = null;
                        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                    }
                    break;
                case "new":
                    $applicantModel = shufflearray2object($_POST,$applicantModel);
                    $applicantModel->password =$password;
                    $stat = $applicantDAO->saveUpdate ($applicantModel,$table);
                    if ( $stat ) {
                        $hdrLocation="";
                        $page = "applicant";
                        $prevpage = "";
                        $nextpage = "profile";
                        $sort = " where email = '".$applicantModel->email."'";
                        $applicantModel =$applicantDAO->getRecord($table,$sort);
                        $table = "profile";
                        $paramString="menuaction=action&applicantId=".$applicantModel->id."&edit=edit&formAction=new";
                        $_SESSION['ERRMSG_ARR'] = null;
                        $_SESSION['ERRFLAG'] = null;
                       doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                    }
                    break;
                case "delete":
                    $sort = " where applicantId = '".$id."'";
                    $resumeModel =$resumeDAO->getRecord("resume",$sort);
                    if ( $resumeModel != "" ) {
                        $resumeFile = $directoryHome.$resumeModel->file_name;
                        unlink($resumeFile);
                        $stat = $resumeDAO->delete ($resumeModel->id,"resume");
                    }
                    $eeoModel =$eeoDAO->getRecord("eeo",$sort);
                    if ( $eeoModel != "" )
                        $stat = $eeoDAO->delete ($eeoModel->id,"eeo");
                    $certificationModel =$certificationDAO->getRecord("certification",$sort);
                    if ( $certificationModel != "" )
                        $stat = $certificationDAO->delete ($certificationModel->id,"certification");

                    $profileModel =$profileDAO->getRecord("profile",$sort);
                    if ( $profileModel != "" )
                        $stat = $profileDAO->delete ($profileModel->id,"profile");

                    $stat = $applicantDAO->delete ($id,$table);
                    if ( $stat ) {
                        $_SESSION['ERRMSG_ARR'] = null;
                        $_SESSION['ERRFLAG'] = null;
                        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                    }
                    break;
                }
        }

}

if ( $formAction != "new" )
{
    $sort = " where email = '".$email."'";
    if ( isset($id) && $id != "" && $id > 0 ) {
        $sort = " where id = '".$id."'";
    }
    $applicantModel =$applicantDAO->getRecord($table,$sort);
    if ( $applicantModel == "" ) {
        $applicantModel = new ApplicantModel();
        $applicantModel->email = $email;
    }
}
$enc_password = true;
$enc_key = "password";
$confirm_password = "cpassword";

//Check whether the query was successful or not
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>