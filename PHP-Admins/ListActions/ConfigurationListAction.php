<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ConfigurationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ConfigurationModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$configurationModel = new ConfigurationModel;
$configurationDAO = new ConfigurationDAO();
$table = "configuration";
$sort = " order by conf_table,conf_key";
if ( isset($postForm) && $postForm != "" ) {
    //Sanitize the POST values
} 
$configurations =$configurationDAO->getRecord($table,$sort);

if ( $configurations ) {
    $configurations = convert2array($configurations);
}
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}

$hdLabel = getLabel("load",$locale);
$loadFile = "<a href='".$homeDir."PHP-FileIncludes/LoadFileForm.php?table=".$table."&section=".$section."&sub_section=".$sub_section."&edit=edit&formAction=load''>".$hdLabel." ".ucfirst($table)."</a>"
?>
