<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/StateDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/StateModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$stateModel = new StateModel;
$stateDAO = new StateDAO();
$table = "state";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $stateModel = shufflearray2object($_POST,$stateModel);
            if ( $sellist == "" )
                $stateModel->sellist = $code."_".$name;
            $stat = $stateDAO->saveUpdate ($stateModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $stateModel = shufflearray2object($_POST,$stateModel);
            if ( $sellist == "" )
                $stateModel->sellis = $code."_".$name;
            $stat = $stateDAO->saveUpdate ($stateModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $stateDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 

$sort = " where id = '".$id."'";
if ( isset($code) && $code != "" && $code > 0 ) {
    $sort = " where scode = '".$code."'";
}
$stateModel =$stateDAO->getRecord($table,$sort);
if ( $stateModel == "" ) {
    $stateModel = new StateModel();
    $stateModel->code = $code;
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
