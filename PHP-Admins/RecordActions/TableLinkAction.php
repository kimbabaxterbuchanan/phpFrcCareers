<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/TableLinkDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/TableLinkModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$tableLinkModel = new TableLinkModel;
$tableLinkDAO = new TableLinkDAO();
$table = "tableLink";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $sort = " where id = '".$id."'";
            $tableLinkModel = $tableLinkDAO->getRecord($table,$sort);
            if ( ! $tableLinkModel )
                $tableLinkModel = new TableLinkModel;
            $tableLinkModel = shufflearray2object($_POST,$tableLinkModel);
            $stat = $tableLinkDAO->saveUpdate ($tableLinkModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $tableLinkModel = shufflearray2object($_POST,$tableLinkModel);
            $stat = $tableLinkDAO->saveUpdate ($tableLinkModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $tableLinkDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

}

$sort = " where id = '0'";
if ( ! isset($postForm ) ) {
    $sort = " where id = '".$id."'";
    if ( isset($primarytable) && $primarytable != "" ) {
        $sort = " where primarytable = '".$primarytable."'";
    }
}
$tableLinkModel =$tableLinkDAO->getRecord($table,$sort);
if ( ! $tableLinkModel ) {
    $tableLinkModel = new TableLinkModel;
    $tableLinkModel->id = $id;
    $tableLinkModel->primarytable = $primarytable;
    $tableLinkModel->primaryfield = $primaryfield;
    $tableLinkModel->linktable = $linktable;
    $tableLinkModel->linkfield = $linkfield;
}
$tableLinkModel = shufflearray2object($_POST,$tableLinkModel);

if ( $primarytable == "" && $tableLinkModel->primarytable != "" ) {
    $primarytable = $tableLinkModel->primarytable;
}
if ( $linktable == "" && $tableLinkModel->linktable != "" ) {
    $linktable = $tableLinkModel->linktable;
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
