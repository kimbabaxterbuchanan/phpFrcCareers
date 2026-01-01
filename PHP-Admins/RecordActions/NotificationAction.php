<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/NotificationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/NotificationModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$notificationModel = new NotificationModel;
$notificationDAO = new NotificationDAO();
$table = "notification";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $notificationModel = shufflearray2object($_POST,$notificationModel);
            $stat = $notificationDAO->saveUpdate ($notificationModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $notificationModel = shufflearray2object($_POST,$notificationModel);
            $stat = $notificationDAO->saveUpdate ($notificationModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $notificationDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 
$sort = " where id = '".$id."'";
$notificationModel =$notificationDAO->getRecord($table,$sort);
if ( $notificationModel == "" ) {
    $notificationModel = new NotificationModel;
    $notificationModel->applicantId = $applicantId;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
