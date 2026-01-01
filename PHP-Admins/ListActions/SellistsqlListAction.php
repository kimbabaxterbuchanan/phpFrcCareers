<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/SellistsqlDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/SellistsqlModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$sellistsqlModel = new SellistsqlModel;
$sellistsqlDAO = new SellistsqlDAO();
$table = "sellistsql";
$sort = "";
$sellistsqls =$sellistsqlDAO->getRecord($table,$sort);
if ( $sellistsqls )
    $sellistsqls = convert2array($sellistsqls);

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
