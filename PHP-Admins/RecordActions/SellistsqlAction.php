<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/SellistsqlDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/SellistsqlModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$sellistsqlModel = new SellistsqlModel;
$sellistsqlDAO = new SellistsqlDAO();
$table = "sellistsql";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $sellistsqlModel = shufflearray2object($_POST,$sellistsqlModel);
            if ( $sellist == "" )
                $sellistsqlModel->sellist = $code."_".$name;
            $stat = $sellistsqlDAO->saveUpdate ($sellistsqlModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $sellistsqlModel = shufflearray2object($_POST,$sellistsqlModel);
            if ( $sellist == "" )
                $sellistsqlModel->sellist = $code."_".$name;
            $stat = $sellistsqlDAO->saveUpdate ($sellistsqlModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $sellistsqlDAO->delete ($id,$table);
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
$sellistsqlModel =$sellistsqlDAO->getRecord($table,$sort);
if ( $sellistsqlModel == "" ) {
    $sellistsqlModel = new sellistsqlModel();
    $sellistsqlModel->code = $code;
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
