<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/RequirementDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/RequirementModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$requirementModel = new RequirementModel;
$requirementDAO = new RequirementDAO();
$table = "requirement";
$sort = "";
$requirements =$requirementDAO->getRecord($table,$sort);
if ( $requirements )
    $requirements = convert2array($requirements);

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
