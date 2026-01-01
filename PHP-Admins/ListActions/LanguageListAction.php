<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/LanguageDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/LanguageModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$languageModel = new LanguageModel;
$languageDAO = new LanguageDAO();
$table = "language";
$sort = " order by locale,resource_key";

$languages =$languageDAO->getRecord($table,$sort);

if ( $languages ) {
    $languages = convert2array($languages);
}

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
$hdLabel = getLabel("load",$locale);
$loadFile = "<a href='".$homeDir."PHP-FileIncludes/LoadFileForm.php?section=".$section."&sub_section=".$sub_section."&table=".$table."&edit=edit&formAction=load''>".$hdLabel." ".ucfirst($table)."</a>"
?>
