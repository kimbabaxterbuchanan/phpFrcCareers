<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ForwarderDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ForwarderModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$forwarderModel = new ForwarderModel;
$forwarderDAO = new ForwarderDAO();
$table = "forwarder";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $forwarderModel = shufflearray2object($_POST,$forwarderModel);
            $stat = $forwarderDAO->saveUpdate ($forwarderModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $forwarderModel = shufflearray2object($_POST,$forwarderModel);
            $stat = $forwarderDAO->saveUpdate ($forwarderModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $forwarderDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 

$sort = " where id = '".$id."'";
//if ( isset($cur_page) && $cur_page != "") {
//    $sort = " where cur_page = '".$cur_page."'";
//}
$forwarderModel =$forwarderDAO->getRecord($table,$sort);
if ( $forwarderModel == "" ) {
    $forwarderModel = new ForwarderModel;
    $forwarderModel->page = $page;
}

//Check whether the query was successful or not
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}

?> 
