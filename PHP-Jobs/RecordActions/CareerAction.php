<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CareerDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CareerModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/RequirementDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/RequirementModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicationModel.php';
require_once dirname(__FILE__) .'/../../PHP-Mail/mailNotification.php';

$applicationModel = new ApplicationModel;
$applicationDAO = new ApplicationDAO();
$careerModel = new CareerModel;
$careerDAO = new CareerDAO();
$requirementModel = new RequirementModel;
$requirementDAO = new RequirementDAO();
$table = "career";
if ( isset($postForm) && $postForm != "" ) {
    //Sanitize the POST values
    $hdrLocation="";
    if ( $id == "" ) $id = $careerIds;
//    if ( $rtnPage != "" ) {
//        $hdrLocation = $rtnPage;
//    }
    if ( $cancel != ""){
        $hdrLocation = "";
        $section="career";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }
    if ( $apply != "" ) {
        if ( $loginId == "0" ){
//            $hdrLocation=$homeDir."PHP-FileIncludes/loginForm.php";
            $table="applicant";
            $paramString = "careerIds=".$id."&edit=apply&formAction=new";
            $section="login";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        } else {
            if ( strpos($careerIds,",") === false )
                $careerIds .= ",";
            $paramString = "careerIds=".$id."&edit=apply&formAction=new&postForm=yes&loginAction=yes";
            $section = "career";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        }
    }
    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
} 
$sort = " where req_number = '".$req_number."'";
if ( isset($id) && $id != "" && $id > 0 ) {
    $sort = " where id = '".$id."'";
}
$careerModel =$careerDAO->getRecord($table,$sort);
if ( $careerModel == "" ) {
    $careerModel = new CareerModel;
    $careerModel->req_number = $req_number;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG'] = "set";
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
$addList = "";
if ( $careerIds == "" ) $careerIds = $id;

if ( isset($id) && $id != "" && $id > 0 ) {
    $hideButtons = "yes";
    $sort = " select distinct type from requirement where careerId = '".$id."' order by type";
    $requirementTypes =$requirementDAO->executeQry($sort);
    if ( ! $requirementTypes ) {
        $requirementTypes = new requirementModel;
    }
    $requirementTypes = convert2array($requirementTypes);
    $addList = "echo \"<table width='700' border='0' align='center' cellpadding='2' cellspacing='0'>\";
            \$cnt = 0;
            \$hdr = \"\";
            \$hdrKey = \"\";
            if ( count(\$requirementTypes) > 0 ) {
                foreach( \$requirementTypes as \$requirementType ) {
                    if ( \$requirementType ) {
                        \$bdy=\"\";
                        echo \"<tr><th colspan=2>&nbsp;</th></tr>\";
                        foreach ( \$requirementType as \$key => \$val ){
                            if ( \$val != \"\") {
                                    \$hdrLabel = getLabel(\$val,\$locale);
                                    echo \"<tr><td align='left'><b>\".\$hdrLabel.\":</b></td><td>&nbsp;</td></tr>\";
                                    \$sort = \" where careerId = '\".\$id.\"' and type = '\".\$val.\"'\";
                                    \$requirements = \$requirementDAO->getRecord('requirement',\$sort);
                                    \$requirements = convert2array(\$requirements);
                                    foreach (\$requirements as \$requirement ) {
                                        echo \"<tr><td>&nbsp;</td><td align='left'>\".\$requirement->description.\"</td></tr>\";
                                    }
                             }
                        }
                    }
                }
            }
            \$hdrLabel = getLabel('back',\$locale);
            echo \"<tr><td>&nbsp;</td><td><input type='submit' name='cancel' id='cancel' value='\".\$hdrLabel.\"' />&nbsp;&nbsp;&nbsp;\";
            \$hdrLabel = getLabel('apply',\$locale);
            echo \"<input type='submit' name='apply' id='apply' value='\".\$hdrLabel.\"' /></td></tr>\";
            echo \"</table>\";
            \$hdrLabel = getLabel('forwardjobbody',\$locale);
            \$subject = \$hdrLabel;
            \$subject .= \"%0D%0A%0D%0Ahttp://\".\$homeURL.\"/FRCCareer.php%3Fsection%3Dview%26sub_section%3DfindJobList%26edit%3Dview%26formAction%3Dview%26req_number%3D\".\$careerModel->req_number;
            \$hdrLabel = getLabel('forwardjob',\$locale);
            echo \"<a href='mailto:?subject=Future Research Corp Job Number \".\$careerModel->req_number.\" &body=\".\$subject.\"'>\".\$hdrLabel.\"</a>\";

";
}
?>
