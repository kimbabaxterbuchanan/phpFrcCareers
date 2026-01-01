<?php
//Start session
session_start();

require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
//Include database connection details
require_once dirname(__FILE__) .'/../PHP-DAOs/ApplicantDAO.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../PHP-models/ProfileModel.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/ApplicationDAO.php';
require_once dirname(__FILE__) .'/../PHP-models/ApplicationModel.php';

$applicationModel = new ApplicationModel;
$applicationDAO = new ApplicationDAO();

$applicantDAO = new ApplicantDAO();
$profileDAO = new ProfileDAO();
$profileModel = new ProfileModel;

if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
        
        //Input Validations
    if($email == '') {
            $errmsg_arr[] = getLabel("applicantIdMissing",$locale);
            $errflag = true;
        }
    if($password == '') {
            $errmsg_arr[] = getLabel("passwordMissing",$locale);
            $errflag = true;
        }
        
        //If there are input validations, redirect back to the login form
    if($errflag) {
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            $_SESSION['ERRFLAG']= "set";
            session_write_close();
        }
        
        //Create query
    $result = $applicantDAO->getApplicantByLoginPassword($email,$password);
        
        //Check whether the query was successful or not
    if($result && !$errflag) {
            if(mysql_num_rows($result) == 1) {
                //Login Successful
                    session_regenerate_id();
                    $member = mysql_fetch_assoc($result);
                    $_SESSION['SESS_MEMBER_ID'] = $member['id'];
                    $_SESSION['SESS_FIRST_NAME'] = $member['first_name'];
                    $_SESSION['SESS_LAST_NAME'] = $member['last_name'];
                    $_SESSION['SESS_MIDDLE_INITIAL'] = $member['middle_initial'];
                    $_SESSION['EMAIL'] = $member['email'];
                    $_SESSION['LOGIN'] = $member['email'];

                    $sort = " where applicantId = '".$member['id']."'";
                    $profileModel = $profileDAO->getRecord("profile",$sort);
                    $_SESSION['ADMIN'] = $profileModel->super_applicant;
                    $_SESSION['LOCALE'] = $profileModel->locale;

                    session_write_close();
                    if ( $edit != "apply" ) {
                        $hdrLocation = "";
                        $section="career";
                        $sub_section = "findJobList";
                        $table="applicant";
                        $paramString = "careerIds=".$careerIds."&edit=".$edit."&formAction=".$formAction;
                    } else {
                        if ( strpos($careerIds,",") === false ) {
                            $careerIds .=",";
                        }
                        $hdrLocation = "";
                        $section="career";
                        $sub_section = "findJobList";
                        $table="career";
                        if ( strpos($careerIds,",") === false )
                            $careerIds .= ",";
                        $paramString = "careerIds=".$careerIds."&edit=apply&formAction=new&postForm=yes&loginAction=yes";
                    }
                    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                    exit();
                }else {
                //Login failed
                    $errmsg_arr[]=getLabel("loginFailed",$locale);
                    $errflag = true;
                    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
                    $_SESSION['ERRFLAG'] = "set";
                    session_write_close();
                }
        }
}
?>