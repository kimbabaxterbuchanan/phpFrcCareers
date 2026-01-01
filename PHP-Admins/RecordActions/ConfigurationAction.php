<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ConfigurationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ConfigurationModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$configurationModel = new ConfigurationModel;
$configurationDAO = new ConfigurationDAO();
$table = "configuration";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $configurationModel = shufflearray2object($_POST,$configurationModel);
            $stat = $configurationDAO->saveUpdate ($configurationModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $configurationModel = shufflearray2object($_POST,$configurationModel);
            $stat = $configurationDAO->saveUpdate ($configurationModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $configurationDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 
$sort = " where id = '".$id."'";
$configurationModel =$configurationDAO->getRecord($table,$sort);
if ( $configurationModel == "" ) {
    $configurationModel = new ConfigurationModel;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
