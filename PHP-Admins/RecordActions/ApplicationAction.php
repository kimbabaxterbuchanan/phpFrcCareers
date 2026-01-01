<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicationModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicantDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicantModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ProfileModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CertificationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CertificationModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/EeoDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/EeoModel.php';

    $hdrLocation = "";
    $paramString = "menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$applicationModel = new ApplicationModel;
$applicationDAO = new ApplicationDAO();
$table = "application";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $applicationModel = shufflearray2object($_POST,$applicationModel);
            $stat = $applicationDAO->saveUpdate ($applicationModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $applicationModel = shufflearray2object($_POST,$applicationModel);
            $stat = $applicationDAO->saveUpdate ($applicationModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $applicationDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 

$sort = "";
if ($formAction != "" && $formAction != "list") {
	$sort = " where id = '".$id."'";
	if ( isset($applicantId) && $applicantId != "" && $applicantId > 0 ) {
		$sort = " where applicantId = '".$applicantId."'";
	}
}

$applicationModel =$applicationDAO->getRecord($table,$sort);
if ( $applicationModel == "" ) {
    $applicationModel = new ApplicationModel;
    $applicationModel->applicantId = $applicantId;
}

$applicantModel = new ApplicantModel;
$applicantDAO = new ApplicantDAO();
$table = "applicant";
$sort = " where id = '".$applicantId."'";
$applicantModel = $applicantDAO->getRecord($table,$sort);

$profileModel = new ProfileModel;
$profileDAO = new ProfileDAO();
$table = "profile";
		$sort = " where applicantId = '".$applicantId."'";
$profileModel = $applicantDAO->getRecord($table,$sort);

$certificationModel = new CertificationModel;
$certificationDAO = new CertificationDAO();
$table = "certification";
		$sort = " where applicantId = '".$applicantId."'";
$certificationModel = $certificationDAO->getRecord($table,$sort);

$eeoModel = new EeoModel;
$eeoDAO = new EeoDAO();
$table = "eeo";
		$sort = " where applicantId = '".$applicantId."'";
$eeoModel = $eeoDAO->getRecord($table,$sort);

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
