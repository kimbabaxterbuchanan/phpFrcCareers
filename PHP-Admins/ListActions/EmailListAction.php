<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/EmailDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/EmailModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$emailModel = new EmailModel;
$emailDAO = new EmailDAO();
$table = "email";
$sort = " order by subject";
$emails =$emailDAO->getRecord($table,$sort);

if ( $emails) {
    $emails = convert2array($emails);
}

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>
