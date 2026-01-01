<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/EmailDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/EmailModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$emailModel = new EmailModel;
$emailDAO = new EmailDAO();
$table = "email";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $emailModel = shufflearray2object($_POST,$emailModel);
            $stat = $emailDAO->saveUpdate ($emailModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $emailModel = shufflearray2object($_POST,$emailModel);
            $stat = $emailDAO->saveUpdate ($emailModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $emailDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 
$sort = " where id = '".$id."'";
if ( isset($role) && $role != "" ) {
    $sort = " where role = '".$role."'";
}
$emailModel =$emailDAO->getRecord($table,$sort);
if ( $emailModel == "" ) {
    $emailModel = new EmailModel();
    $emailModel->role = $role;
}
//Check whether the query was successful or not
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
$emailListRequired="xXxccMail";
?> 
