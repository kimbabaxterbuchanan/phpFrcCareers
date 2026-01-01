<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CareerDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CareerModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicationModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$applicationModel = new ApplicationModel;
$applicationDAO = new ApplicationDAO();

$careerModel = new CareerModel;
$careerDAO = new CareerDAO();
$table = "career";
$sort = "";
$careers =$careerDAO->getRecord($table,$sort);

if ( $careers ) {
    $careers = convert2array($careers);
}
$width="150";
$hdLabel0 = getLabel("career",$locale);
$hdLabel1 = getLabel("requirement",$locale);
$hdLabel2 = getLabel("applications",$locale);
$phdr = "<table width='100%' border='0'><tr><td width='".$width."'>".$hdLabel0."</td><td width='".$width."'>".$hdLabel1."</td><td width='".$width."'>".$hdLabel2."</td></tr></table>";
$requirement="requirement";
$width="100";

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>
