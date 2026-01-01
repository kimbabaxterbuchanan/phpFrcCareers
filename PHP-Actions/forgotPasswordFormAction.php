<?php
//Start session
session_start();

require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
//Include mail details
require_once dirname(__FILE__) .'/../PHP-models/ApplicantModel.php';
require_once dirname(__FILE__) .'/../PHP-Mail/mailNotification.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/ApplicantDAO.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/ProfileDAO.php';

//$postForm = clean($_POST['postForm']);
$applicantDAO = new ApplicantDAO();
$profileDAO = new profileDAO();
$applicantModel = new ApplicantModel();

if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    if ( $forgotemail == '') {
            $errmsg_arr[] = getLabel("emailAddressMissing",$locale);
            $errflag = true;
        } else if ( ! checkEmailFormat($forgotemail) ) {
            $errmsg_arr[] = getLabel("emailAddressWrongFormat",$locale);
            $errflag = true;            
        }
    $result=$applicantDAO->getApplicantByApplicantName($forgotemail);
    if(mysql_num_rows($result) == 1 && !$errflag ) {
            $applicant = mysql_fetch_assoc($result);
            $id = $applicant['id'];
            if ( $applicant['email'] != $forgotemail ) {
                    $errmsg_arr[] = getLabel("emailAddressDoesNotMatch",$locale);
                    $errflag = true;
                }
        }
        //Check whether the query was successful or not
    if($id != "0" && !$errflag) {
            $replyMail = $replyMail;
            $replyName = $replyName;
            $mailHost = $defaultMailHost;
            $smtpAuth = $smtpAuth;
            $smtpApplicantname = $smtpApplicantname;
            $smtpPassword = $smtpPassword;
            $toMail = $forgotemail;
            $toName = $applicant['last_name'].", ".$applicant['first_name'];
            $subject = getLabel("emailForgottenPasswordSubject",$locale);
            $body = getLabel("emailForgottenPasswordBoddy",$locale);
            $altBody = getLabel("emailForgottenPasswordAltBody",$locale);
            $gPassword = generatePassword($length=6, $strength=0);
            $body .= "<br><br>".$gPassword;
            $altbody .= "\n\n".$gPassword;
            
            $result = $applicantDAO->getApplicantByApplicantName($toMail);
            echo mysql_num_rows($result)."<BR>";
            $member = mysql_fetch_assoc($result);
            $applicantDAO->updatePassword ($gPassword, $member['id']);
            
            $mailNote = new mailNotification($replyMail,$replyName,$mailHost,$fromMail,$fromName,$smtpAuth,$smtpApplicantname,$smtpPassword,$toMail,$toName,"","",$subject,$body,$altBody,$isHTML,$port);
        
            session_write_close();
            $hdrLocation = "";
            $section="career";
            $sub_section = "findJobList";
            $table="career";
            $paramString = "";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            exit();
            } else if ( !$errflag ){
                    $errmsg_arr[] = getLabel("emailAddressNotFound",$locale);
                    $errflag = true;            
                }
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG'] = "set";
    session_write_close();
}


?>