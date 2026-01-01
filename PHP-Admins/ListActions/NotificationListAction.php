<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/NotificationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/NotificationModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$notificationModel = new NotificationModel;
$notificationDAO = new NotificationDAO();
$table = "notification";
$sort = "";
$notifications =$notificationDAO->getRecord($table,$sort);
if ( $notifications )
    $notifications = convert2array($notifications);
    
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
