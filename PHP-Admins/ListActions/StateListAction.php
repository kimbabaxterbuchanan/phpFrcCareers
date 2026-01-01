<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/StateDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/StateModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$stateModel = new StateModel;
$stateDAO = new StateDAO();
$table = "state";
$sort = "";
$states = $stateDAO->getRecord($table,$sort);
if ( $states )
    $states = convert2array($states);

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
$loadFile = "<a href='".$homeDir."PHP-FileIncludes/LoadFileForm.php?table=".$table."&section=".$section."&sub_section=".$sub_section."&edit=edit&formAction=load''>Load ".ucfirst($table)."</a>"
?>
