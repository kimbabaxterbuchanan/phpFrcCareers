<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CareerDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CareerModel.php';
require_once dirname(__FILE__) .'/../../PHP-Mail/mailNotification.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$careerModel = new CareerModel;
$careerDAO = new CareerDAO();
$table = "career";
if ( isset($postForm) && $postForm != "" ) {
    //Sanitize the POST values
    $hdrLocation="";
    if ( $cancel != ""){
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }
    switch ($formAction){
        case "edit":
            $careerModel = shufflearray2object($_POST,$careerModel);
            $stat = $careerDAO->saveUpdate ($careerModel,$table);
            if ( $stat && $add == "" ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
        case "new":
            $careerModel = shufflearray2object($_POST,$careerModel);
            $stat = $careerDAO->saveUpdate ($careerModel,$table);
            if ( $stat && $add == "" ) {
                $qry = "select u.id, u.first_name, u.middle_initial, u.last_name, u.email from applicant u, profile p where u.id = p.applicantId and p.job_notification = 'yes'";
                $rMdl = $careerDAO->executeQry($qry);
                $rMdl = convert2array($rMdl);
                $replyMail = $replyMail;
                $replyName = $replyName;
                $mailHost = $defaultMailHost;
                $smtpAuth = $smtpAuth;
                $smtpApplicantname = $smtpApplicantname;
                $smtpPassword = $smtpPassword;
                $fromMail = $email;
                $fromName = $fullName;
                $ccMail = $ccMail;
                $ccName = $ccName;
                $replyMail = $email;
                $replyName = $fullName;
                $subject = getLabel("emailCareerSubject",$locale);
                $subject = "Future Research has added a new position";

                $sort = " where req_number = '".$req_number."'";
                $careerModel =$careerDAO->getRecord($table,$sort);
                $notifyCareerId = $careerModel->id;

                foreach ( $rMdl as $model ) {
                    $notifyApplicantId = $model->id;
                    $toMail = $model->email;
                    $toName = $model->last_name.", ".$model->first_name." ".$model->middle_initial;
                    $body = getLabel("emailCareerBody",$locale);
                    $body = str_replace("XxXhomeURLXxX",$homeURL,$body);
                    $body = str_replace("XxXreqNumberXxX",urlencode($careerModel->req_number),$body);
                    $altBody = getLabel("emailCareerAltBody",$locale);
                    $altBody = str_replace("XxXhomeURLXxX",$homeURL,$altBody);
                    $altBody = str_replace("XxXreqNumberXxX",urlencode($careerModel->req_number),$altBody);
                    $stat = new mailNotification($replyMail,$replyName,$mailHost,$fromMail,$fromName,$smtpAuth,$smtpApplicantname,$smtpPassword,$toMail,$toName,$ccMail,$ccName,$subject,$body,$altBody,$isHTML,$port);
                }
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
        case "delete":
            $stat = $careerDAO->delete ($id,$table);
            if ( $stat && $add == "" ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
    }

} 
$sort = " where req_number = '".$req_number."'";
if ( isset($id) && $id != "" && $id > 0 ) {
    $sort = " where id = '".$id."'";
}
$careerModel =$careerDAO->getRecord($table,$sort);
if ( $careerModel == "" ) {
    $careerModel = new CareerModel;
    $careerModel->req_number = $req_number;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>
