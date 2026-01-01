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

$applicationModel = new ApplicationModel;
$applicationDAO = new ApplicationDAO();

$careerModel = new CareerModel;
$careerDAO = new CareerDAO();
$requirementModel = new RequirementModel;
$requirementDAO = new RequirementDAO();
$table = "career";
if ( isset($postForm) && $postForm != "" ) {
    //Sanitize the POST values
    $hdrLocation=$homeDir."ListForm.php";

    if ( $id == "" ) $id = $careerIds;
    if ( $rtnPage != "" ) {
        $hdrLocation = $rtnPage;
    }
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }
    if ( $apply != "" ) {
        $careerIds = $id.",";
        if ( $loginId == "0" ){
            $hdrLocation=$homeDir."../../PHP-FileIncludes/loginForm.php";
            $table="applicant";
            $paramString = "careerIds=".$careerIds."&edit=apply&formAction=new";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        } else {
            $paramString = "careerIds=".$careerIds."&edit=apply&formAction=new&postForm=yes&loginAction=yes";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        }
    }
} 
$sort = " where req_number = '".$req_number."'";
$careerModel =$careerDAO->getRecord($table,$sort);

if ( $careerModel == "" ) {
    $careerModel = new CareerModel;
    $careerModel->req_number = $req_number;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
$addList = "";
    $hideButtons = "yes";
    $sort = " where careerId = '".$id."' order by type";
    $requirements =$requirementDAO->getRecord('requirement',$sort);
    if ( ! $requirements ) {
        $requirements = new requirementModel;
    }
    $requirements = convert2array($requirements);
    $addList = "echo \"<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0'>\";
            \$cnt = 0;
            \$hdr = \"\";
            \$hdrKey = \"\";
            if ( count(\$requirements) > 0 ) {
                foreach( \$requirements as \$requirement ) {
                    if ( \$requirement ) {
                        \$bdy=\"\";
                        \$id = 0;
                        foreach ( \$requirement as \$key => \$val ){
                            if ( \$key == \"type\" || \$key == \"description\" ) {
                                if ( \"type\" == \$key ) {
                                    \$hdrLabel = getLabel(\$val,\$locale);
                                    if ( \$hdrKey != \$val ) {
                                        echo \"<tr><td align='left' colspan='2'>&nbsp;</td></tr>\";
                                        \$hdrKey = \$val;
                                        \$cnt = 0;
                                    }
                                } else {
                                    \$hdrLabel = getLabel(\$key,\$locale);
                                    \$bdy .= \"<td>&nbsp;</td><td align='center'>\".\$val.\"</td>\";
                                }
                            }
                            if ( \"type\" == \$key && \$cnt == 0 )
                                    echo \"<tr><th>\".\$hdrLabel.\"</th></tr>\";
                            \$cnt = 0;
                        }
                        echo \"<tr>\".\$bdy.\"</tr>\";
                    }
                }
            }
            \$hdrLabel = getLabel('back',\$locale);
            echo \"<tr><td>&nbsp;</td><td><input type='submit' name='cancel' id='cancel' value='\".\$hdrLabel.\"' />&nbsp;&nbsp;&nbsp;\";
            \$hdrLabel = getLabel('apply',\$locale);
            echo \"<input type='submit' name='apply' id='apply' value='\".\$hdrLabel.\"' /></td></tr>\";
            echo \"</table>\";";
?>
