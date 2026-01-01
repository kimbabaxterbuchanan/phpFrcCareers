<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CertificationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CertificationModel.php';

    $hdrLocation="";
    $paramString = "menuaction=list";
    if ( $cancel != ""){
        $_SESSION['ERRMSG_ARR'] = null;
        $_SESSION['ERRFLAG'] = null;
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$certificationModel = new CertificationModel;
$certificationDAO = new CertificationDAO();
$table = "certification";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    if ( $continue != ""){
             $page = "certification";
             $prevpage = "profile";
             $nextpage = "eeo";
             $table = "eeo";
             $paramString="menuaction=action&applicantId=".$applicantId."&edit=edit&formAction=new";
             $paramString.="&prevpage=".$prevpage."&page=".$page."&nextPage=".$nextpage;
             $_SESSION['ERRMSG_ARR'] = null;
             $_SESSION['ERRFLAG'] = null;
             doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
             exit();
       }
    switch ($formAction){
        case "edit":
        $certificationModel = shufflearray2object($_POST,$certificationModel);
        $stat = $certificationDAO->saveUpdate ($certificationModel,$table);
        if ( $add == "" && $stat ) {
            $_SESSION['ERRMSG_ARR'] = null;
            $_SESSION['ERRFLAG'] = null;
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            exit();
        }
        break;
        case "new":
        $certificationModel = shufflearray2object($_POST,$certificationModel);
        $stat = $certificationDAO->saveUpdate ($certificationModel,$table);
        if ( $add == "" && $stat ) {
            $page = "certification";
            $prevpage = "profile";
            $nextpage = "eeo";
            $table = "eeo";
            $paramString="&menuaction=action&applicantId=".$applicantId."&edit=edit&formAction=new";
            $paramString.="&prevpage=".$prevpage."&page=".$page."&nextPage=".$nextpage;
            $_SESSION['ERRMSG_ARR'] = null;
            $_SESSION['ERRFLAG'] = null;
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            exit();
        }
        break;
        case "delete": 
        $stat = $certificationDAO->delete ($id,$table);
        if ( $add == "" && $stat ) {
            $_SESSION['ERRMSG_ARR'] = null;
            $_SESSION['ERRFLAG'] = null;
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            exit();
        }
        break;
        }

}
$sort = " where applicantId = '".$applicantId."'";
if ( isset($id) && $id != "" && $id > 0 ) {
    $sort = " where id = '".$id."'";
}
$certificationModel =$certificationDAO->getRecord($table,$sort);
if ( $certificationModel == "" ) {
    $certificationModel = new CertificationModel();
    $certificationModel->applicantId = $applicantId;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG'] = "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}

    $addList = "";
if ( isset($id) && $id != "" && $id > 0 ) {
} else {
    $certifications = $certificationModel;
    $certifications = convert2array($certifications);
    $certificationModel = new CertificationModel();
    $certificationModel->applicantId = $applicantId;
    $addButton = 'yes';
    $addList = "if ( $table == \"certification\" ) {
            \$sort = \" where applicantId = '\".\$applicantId.\"'\";
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
    }
?>
