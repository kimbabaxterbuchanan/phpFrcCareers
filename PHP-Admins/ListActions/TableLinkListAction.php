<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/TableLinkDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/TableLinkModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$tableLinkModel = new TableLinkModel;
$tableLinkDAO = new TableLinkDAO();
$table = "tableLink";
$sort = "";
$tableLinks =$tableLinkDAO->getRecord($table,$sort);
if ( $tableLinks )
    $tableLinks = convert2array($tableLinks);

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
