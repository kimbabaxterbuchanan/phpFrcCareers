<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ResumeDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ResumeModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        $_SESSION['ERRMSG_ARR'] = null;
        $_SESSION['ERRFLAG'] = null;
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

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
    $resumeModel = shufflearray2object($_POST,$resumeModel);
    $fext = strtolower(substr(strrchr($_FILES["file_name"]["name"],"."),1));
    // check if allowed extension
    if (!array_key_exists($fext, $allowed_ext)) {
        $errmsg_arr[] = "Not allowed file type.";
        $errflag = true;
    }
    if (!$errflag ) {
        if ( $_FILES["file_name"]["error"] > 0) {
            $errmsg_arr[] = "Error: " . $_FILES["file_name"]["error"];
            $errflag = true;
        } else {
            $uploadFile = $directoryHome.$_FILES["file_name"]["name"];
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
                $stat = $resumeDAO->saveUpdate ($resumeModel,$table);
                if ( $stat ) {
                    $_SESSION['ERRMSG_ARR'] = null;
                    $_SESSION['ERRFLAG'] = null;
                    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
                break;
            case "new":
                $stat = $resumeDAO->saveUpdate ($resumeModel,$table);
                if ( $stat ) {
                    $_SESSION['ERRMSG_ARR'] = null;
                    $_SESSION['ERRFLAG'] = null;
                    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
                break;
            case "delete":
                $stat = $resumeDAO->delete ($id,$table);
                if ( $stat ) {
                    $_SESSION['ERRMSG_ARR'] = null;
                    $_SESSION['ERRFLAG'] = null;
                    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
                break;
        }
    }
}
$sort = " where applicantId = '".$applicantId."'";
if ( isset($id) && $id != "" && $id > 0  ) {
    $sort = " where id = '".$id."'";
}
$resumeModel =$resumeDAO->getRecord($table,$sort);
if ( $resumeModel == "" ) {
    $resumeModel = new ResumeModel();
    $resumeModel->applicantId = $applicantId;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
$encrypt = "enctype='multipart/form-data'";
$file_type = "file";
$fileKey = "file_name";
$helpMsg = getLabel("uploadResumeMsg",$locale);
?>