<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ResumeDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ResumeModel.php';

$allowed_ext = array (

    // archives
  'zip' => 'application/zip',

    // documents
  'pdf' => 'application/pdf',
  'doc' => 'application/msword',
  'docx' => 'application/msword',
  'txt' => 'application/text',
  'rtf' => 'application/rtf'
);

$resumeModel = new ResumeModel;
$resumeDAO = new ResumeDAO();
$table = "resume";

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
            exit;
        } else {
//            $hdrLocation=$homeDir."PHP-Jobs/Forms/ListForm.php";
            $section="career";
            $sub_section="findJobList";
            $table="career";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            exit;
        }
    }
    $resumeModel = shufflearray2object($_POST,$resumeModel);
    $fext = strtolower(substr(strrchr($_FILES["file_name"]["name"],"."),1));
    // check if allowed extension
    if (!array_key_exists($fext, $allowed_ext)) {
        $errmsg_arr[] = $_FILES["file_name"]["name"];
        $errmsg_arr[] = $fext;
        $errmsg_arr[] = getLabel('notAllowed',$locale);
        $errflag = true;
    }
    if ( !$errflag ) {
        if ($_FILES["file_name"]["error"] > 0) {
            $errmsg_arr[] = "Error: " . $_FILES["file_name"]["error"];
            $errflag = true;
        } else {
            $uploadFile = "c:/resumes/".$_FILES["file_name"]["name"];
            $fres = copy($_FILES['file_name']['tmp_name'], $uploadFile);
            if ( $fres ) {
                $resumeModel->applicantId = $applicantId;
                $resumeModel->description = $description;
                $resumeModel->orig_file_name = $_FILES["file_name"]["name"];
                $resumeModel->attachment_type = $_FILES["file_name"]["type"];
                $resumeModel->file_name = $_FILES["file_name"]["name"];
                $resumeModel->file_size = ($_FILES["file_name"]["size"] / 1024);
            } else {
                $errmsg_arr[] = "Error: FileUpload failed try again..";
                $errflag = true;
            }
        }
        switch ($formAction){
            case "edit":
                $resumeModel = shufflearray2object($_POST,$resumeModel);
                $stat = $resumeDAO->saveUpdate ($resumeModel,$table);
                $sort = " where applicantId = '".$resumeModel->applicantId."'";
                $resumeModel = $resumeDAO->getRecord($table,$sort);
                $id = $resumeModel->id;
                $section = "thankYou";
                if ( isset($page) && $page != "" && ! $isLogedIn ) {
//                    $hdrLocation=$homeDir."PHP-fileIncludes/loginForm.php";
                    $table="applicant";
                    $section="login";
                    $paramString="";
                }
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                break;
            case "new":
                $resumeModel = shufflearray2object($_POST,$resumeModel);
                $stat = $resumeDAO->saveUpdate ($resumeModel,$table);
                $sort = " where applicantId = '".$resumeModel->applicantId."'";
                $resumeModel = $resumeDAO->getRecord($table,$sort);
                $id = $resumeModel->id;
                $section = "thankYou";
                if ( isset($page) && $page != "" && ! $isLogedIn ) {
//                    $hdrLocation=$homeDir."PHP-fileIncludes/loginForm.php";
                   $table="applicant";
                   $section="login";
                   $paramString="id=".$id."&applicantId=".$resumeModel->applicantId."&edit=edit&formAction=new&careerIds=".$careerIds;
                }
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                break;
            case "delete":
                $stat = $resumeDAO->delete ($id,$table);
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                $section="career";
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                break;
        }
    }
}

$sort = " where id = '".$id."'";
if ( isset($applicantId) && $applicantId != "" && $applicantId > 0 ) {
    $sort = " where applicantId = '".$applicantId."'";
}
$resumeModel =$resumeDAO->getRecord($table,$sort);
if ( $resumeModel == "" ) {
    $resumeModel = new ResumeModel();
    $resumeModel->applicantId = $applicantId;
}

$page = "resume";
$prevpage = "eeo";
$nextpage = "none";

if($errflag) {
    $_SESSION['ERRFLAG'] = "yes";
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
    $table = "resume";
    $paramString="id=0&applicantId=".$applicantId."&edit=edit&formAction=new&careerIds=".$careerIds;
    $paramString.="&prevpage=".$prevpage."&page=".$page."&nextPage=".$nextpage;
    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
}
$encrypt = "enctype='multipart/form-data'";
$file_type = "file";
$fileKey = "file_name";
$helpMsg = getLabel('uploadResumeMsg',$locale);
$hideButtons = "yes";
$hdrLabel = getLabel('finish',$locale);
$addbtn = " echo \"<tr><td><input type='submit' name='cancel' id='cancel' value='".$hdrLabel."' /></td>\";";
$hdrLabel = getLabel('save',$locale);
$addbtn .= " echo \"<td><input type='submit' name='save' id='save' value='".$hdrLabel."' /></td></tr>\";";

?>