<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CertificationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CertificationModel.php';

$certificationModel = new CertificationModel;
$certificationDAO = new CertificationDAO();
$table = "certification";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    $hdrLocation=$homeDir."FRCCareer.php";
    if ( $rtnPage != "" ) {
//            $hdrLocation = $rtnPage;
        }

    if ( $cancel != ""){
        $_SESSION['ERRMSG_ARR'] = null;
        $_SESSION['ERRFLAG'] = null;
        if ( $loginId == "0" ){
//            $hdrLocation=$homeDir."PHP-FileIncludes/loginForm.php";
            $table="applicant";
            $section="login";
            $paramString = "careerIds=".$careerIds."&edit=apply&formAction=new";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        } else {
//            $hdrLocation=$homeDir."PHP-Jobs/Forms/ListForm.php";
            $section="career";
            $sub_section="findJobList";
            $table="career";
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        }
    }
    if ( $continue != ""){
//                    $hdrLocation=$homeDir."FRCCareer.php";
             $_SESSION['ERRMSG_ARR'] = null;
             $_SESSION['ERRFLAG'] = null;
             $table = "eeo";
             $paramString="id=0&applicantId=".$applicantId."&edit=edit&formAction=new";
             $paramString.="&prevpage=".$prevpage."&page=".$page."&nextPage=".$nextpage;
             doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
             exit();
       }
    switch ($formAction){
        case "edit":
            $certificationModel = shufflearray2object($_POST,$certificationModel);
            $stat = $certificationDAO->saveUpdate ($certificationModel,$table);
            if ( $add == "" ) {
                if ( isset($page) && $page != "" ) {
//                    $hdrLocation=$homeDir."FRCCareer.php";
                    $table = "eeo";
                    $paramString="id=0&applicantId=".$applicantId."&edit=edit&formAction=edit";
                    $paramString.="&prevpage=".$prevpage."&page=".$page."&nextpage=".$nextpage;
                }
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                exit();
                }
            break;
        case "new":
            $certificationModel = shufflearray2object($_POST,$certificationModel);
            $stat = $certificationDAO->saveUpdate ($certificationModel,$table);
            if ( $add == "" ) {
                if ( isset($page) && $page != "" ) {
//                    $hdrLocation=$homeDir."FRCCareer.php";
                    $table = "eeo";
                    $paramString="id=0&applicantId=".$applicantId."&edit=edit&formAction=new&careerIds=".$careerIds;
                    $paramString.="&prevpage=".$prevpage."&page=".$page."&nextpage=".$nextpage;
                }
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                exit();
                }
            break;
        case "delete": 
            $stat = $certificationDAO->delete ($id,$table);
            if ( $add == "" ) {
                $_SESSION['ERRMSG_ARR'] = null;
                $_SESSION['ERRFLAG'] = null;
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                exit();
                }
            break;
        }
} 
$sort = " where id = '".$id."'";
if ( isset($applicantId) && $applicantId != "" && $applicantId > 0 && $id == "" ) {
    $sort = " where applicantId = '".$applicantId."'";
}
$certificationModel =$certificationDAO->getRecord($table,$sort);
if ( $certificationModel == "" ) {
    $certificationModel = new CertificationModel();
    $certificationModel->applicantId = $applicantId;
}
$page = "certification";
$prevpage = "profile";
$nextpage = "eeo";
 
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}

$addList = "if ( $table == \"certification\" ) {
            \$sort = \" where applicantId = '\".\$applicantId.\"'\";
            \$certifications =\$certificationDAO->getRecord(\$table,\$sort);
            \$certifications = convert2array(\$certifications);
            echo \"<table width='100%' border='1' align='center' cellpadding='2' cellspacing='0'>\";
            \$cnt = 0;
            if ( count(\$certifications) > 0 ) {
                foreach( \$certifications as \$certification ) {
                    if ( \$certification ) {
                        \$bdy=\"\";
                        \$id = 0;
                        foreach ( \$certification as \$key => \$val ){
                            if ( \$key == \"name\" || \$key == \"date_certified\" ) {
                                \$hdrLabel = getLabel(\$key,\$locale);
                                \$hdr .= \"<th>\".\$hdrLabel.\"</th>\";
                                \$bdy .= \"<td align='center'>\".\$val.\"</td>\";
                                }
                            }
                        if ( \$cnt == 0 ) 
                            echo \"<tr>\".\$hdr.\"</tr>\";
                        \$cnt += 1;
                        echo \"<tr>\".\$bdy.\"</tr>\";
                    }
                }
            }
            echo \"</table>\";
        }";
?>
