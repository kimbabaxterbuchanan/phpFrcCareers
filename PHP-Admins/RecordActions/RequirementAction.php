<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/RequirementDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/RequirementModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$requirementModel = new RequirementModel;
$requirementDAO = new RequirementDAO();
$table = "requirement";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $requirementModel = shufflearray2object($_POST,$requirementModel);
            $stat = $requirementDAO->saveUpdate ($requirementModel,$table);
            if ( $stat && $add == "") {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $requirementModel = shufflearray2object($_POST,$requirementModel);
            $stat = $requirementDAO->saveUpdate ($requirementModel,$table);
            if ( $stat && $add == "" ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $requirementDAO->delete ($id,$table);
            if ( $stat && $add == "" ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 
$sort = " where careerId = '".$careerId."' order by type, description";
if ( isset($id) && $id != "" && $id > 0 ) {
    $sort = " where id = '".$id."'";
}
$requirementModel =$requirementDAO->getRecord($table,$sort);
if ( $requirementModel == "" ) {
    $requirementModel = new RequirementModel;
    $requirementModel->careerId = $careerId;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
if ( isset($id) && $id != "" && $id > 0 ) {
} else {
    $requirements = $requirementModel;
    $requirements = convert2array($requirements);
    $requirementModel = new RequirementModel();
    $requirementModel->careerId = $careerId;
    $addButton = 'yes';
    $addList = "echo \"<table width='100%' border='1' align='center' cellpadding='2' cellspacing='0'>\";
            echo \"<tr><th>Requirement</th><th>Description</th></tr>\";
            if ( count(\$requirements) > 0 ) {
                foreach( \$requirements as \$requirement ) {
                    if ( \$requirement ) {
                        echo \"<tr><td>\".\$requirement->type.\"</td>\";
                        echo \"<td align='center'>\".\$requirement->description.\"</td></tr>\";
                    }
                }
            }
           echo \"</table>\";";
}
?>
