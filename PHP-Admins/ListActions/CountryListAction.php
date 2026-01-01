<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CountryDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CountryModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$countryModel = new CountryModel;
$countryDAO = new CountryDAO();
$table = "country";
$sort = "";
$countrys =$countryDAO->getRecord($table,$sort);
if ( $countrys )
    $countrys = convert2array($countrys);

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
?>
