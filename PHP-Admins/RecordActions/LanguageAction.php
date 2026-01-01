<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/DbDAO.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/LanguageDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/LanguageModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$dbDAO = new DbDAO();
$languageModel = new LanguageModel;
$languageDAO = new LanguageDAO();

$sql = "select distinct locale from language where locale != 'All' order by locale";
$modelList = $dbDAO->executeQry($sql);
$modelList = convert2array($modelList);

//$table = "language";
if ( isset($postForm) && $postForm != "" ) {
    //Sanitize the POST values
    switch ($formAction){
        case "edit":
            $stat2 = "";
            foreach ( $modelList as $modelLst ) {
                $sql = "select * from language where resource_key = '".$locale_org_resource_key."' and locale = '".$modelLst->locale."'";
                $languageModel = $languageDAO->executeQry($sql);
                $id = $languageModel->id;
                $languageModel = shufflearray2object($_POST,$languageModel);
                $languageModel->id = $id;
                $languageModel->locale = $modelLst->locale;
                $languageModel->resource_key = $locale_resource_key;
                $locVal = "locale_".$modelLst->locale;
                $languageModel->resource_value = $$locVal;
                $stat1 = $languageDAO->saveUpdate ($languageModel,$table);
                if ( $stat2 == "" && !$stat1 ) {
                    $stat2 = "set";
                    $stat = $stat1;
                }
            }
            if ( $stat2 == "" ) $stat = $stat1;
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
        case "new":
            $stat2 = "";
            foreach ( $modelList as $modelLst ) {
                $languageModel = shufflearray2object($_POST,$languageModel);
                $languageModel->id = "";
                $languageModel->locale = $modelLst->locale;
                $languageModel->resource_key = $locale_resource_key;
                $locVal = "locale_".$modelLst->locale;
                $languageModel->resource_value = $$locVal;
                $stat1 = $languageDAO->saveUpdate ($languageModel,$table);
                if ( $stat2 == "" && !$stat1 ) {
                    $stat2 = "set";
                    $stat = $stat1;
                }
            }
            if ( $stat2 == "" ) $stat = $stat1;
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
        case "delete":
            $stat = $languageDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            }
            break;
    }

}
$sort = " where locale = 'All'";
$langModel = $langDAO->getRecord($table,$sort);
if ( $langModel == "" ) {
    $langModel = new LanguageModel;
    $langModel->locale = $locale;
}
$localeAry = split(",",$langModel->resource_value);

$sort = " where id = '".$id."'";
$languageModel = $languageDAO->getRecord($table,$sort);
if ( $languageModel == "" ) {
    $languageModel = new LanguageModel;
    $languageModel->locale = $locale;
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
$phpcode = "";
if ($formAction == 'new' || $formAction == 'edit')  {
    $phpcode .= "\$rv = split(\"XxX\",\$confModel->adminhtmltype);";
    $phpcode .= "\$rkey = \"\";";
    $phpcode .= "\$rval = \"\";";
    $phpcode .= "if ( \$formAction != 'new' ) {";
    $phpcode .= "\$sql = \"select * from language where id = '\".\$id.\"'\";";
    $phpcode .= "\$tmpModel = \$dbDAO->executeQry(\$sql);";
    $phpcode .= "\$rkey = \$tmpModel->resource_key;";
    $phpcode .= "}";
    $phpcode .= "echo \"<input type='hidden' id='locale_org_resource_key' name='locale_org_resource_key' value='\".\$rkey.\"'>\";";
    $phpcode .= "echo \"<td valign='top'><label> Key </label><input type='text' size='45' id='locale_resource_key' name='locale_resource_key' value='\".\$rkey.\"'></td></tr>\";";
    $phpcode .= "foreach ( \$modelList as \$modelLst ) {";
    $phpcode .= "if ( \$formAction != 'new' ) {";
    $phpcode .= "\$sql = \"select * from language where resource_key = '\".\$rkey.\"' and locale = '\".\$modelLst->locale.\"'\";";
    $phpcode .= "\$tmpModel = \$dbDAO->executeQry(\$sql);";
    $phpcode .= "\$rval =  \$tmpModel->resource_value;";
    $phpcode .= "}";
    $phpcode .= "echo \"<tr><td valign='top'><label>\".\$modelLst->locale.\"</label></td><td> <textarea cols='50' rows='5' id='locale_\".\$modelLst->locale.\"' name='locale_\".\$modelLst->locale.\"'>\".\$rval.\"</textarea></td></tr>\";";
    $phpcode .= "}";
} else if ($formAction == 'view' ) {
    $phpcode .= "\$rv = split(\"XxX\",\$confModel->adminhtmltype);";
    $phpcode .= "\$rkey = \"\";";
    $phpcode .= "\$rval = \"\";";
    $phpcode .= "if ( \$formAction != 'new' ) {";
    $phpcode .= "\$sql = \"select * from language where id = '\".\$id.\"'\";";
    $phpcode .= "\$tmpModel = \$dbDAO->executeQry(\$sql);";
    $phpcode .= "\$rkey = \$tmpModel->resource_key;";
    $phpcode .= "}";
    $phpcode .= "echo \"<input type='hidden' id='locale_org_resource_key' name='locale_org_resource_key' value='\".\$rkey.\"'>\";";
    $phpcode .= "echo \"<td><label>Key</label>&nbsp&nbsp;&nbsp;\".\$rkey.\"</td></tr>\";";
    $phpcode .= "foreach ( \$modelList as \$modelLst ) {";
    $phpcode .= "if ( \$formAction != 'new' ) {";
    $phpcode .= "\$sql = \"select * from language where resource_key = '\".\$rkey.\"' and locale = '\".\$modelLst->locale.\"'\";";
    $phpcode .= "\$tmpModel = \$dbDAO->executeQry(\$sql);";
    $phpcode .= "\$rval =  \$tmpModel->resource_value;";
    $phpcode .= "}";
    $phpcode .= "echo \"<tr><td valign='top'><label>\".\$modelLst->locale.\"</label></td><td>\".\$rval.\"</td></tr>\";";
    $phpcode .= "}";
} else {
    $phpcode .= "echo \"<td>\".\$val.\"</td></tr>\";";
    $phpcode .= "echo \"<tr><td valign='top'><label>\".\$languageModel->resource_key.\"</label></td><td>\".\$languageModel->resource_value.\"</td></tr>\";";
}
?>
