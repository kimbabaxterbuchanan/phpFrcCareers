<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/EeoDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/EeoModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        $_SESSION['ERRMSG_ARR'] = null;
        $_SESSION['ERRFLAG'] = null;
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$eeoModel = new EeoModel;
$eeoDAO = new EeoDAO();
$table = "eeo";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $eeoModel = shufflearray2object($_POST,$eeoModel);
            $stat = $eeoDAO->saveUpdate ($eeoModel,$table);
            if ( $stat ) {
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $eeoModel = shufflearray2object($_POST,$eeoModel);
            $stat = $eeoDAO->saveUpdate ($eeoModel,$table);
            if ( $stat ) {
                $page = "eeo";
                $prevpage = "certification";
                $nextpage = "resume";
                $table = "resume";
                $paramString="menuaction=action&applicantId=".$applicantId."&edit=edit&formAction=new";
                $paramString.="&prevpage=".$prevpage."&page=".$page."&nextPage=".$nextpage;
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $eeoDAO->delete ($id,$table);
            if ( $stat ) {
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 

$sort = " where applicantId = '".$applicantId."'";
if ( isset($id) && $id != "" && $id > 0 ) {
    $sort = " where id = '".$id."'";
}
$eeoModel =$eeoDAO->getRecord($table,$sort);
if ( ! $eeoModel ) {
    $eeoModel = new EeoModel();
    $eeoModel->applicantId = $applicantId;
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
