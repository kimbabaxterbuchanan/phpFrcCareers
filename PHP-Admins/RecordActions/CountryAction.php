<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CountryDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CountryModel.php';

    $hdrLocation="";
    $paramString="menuaction=list";
    if ( $cancel != ""){
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$countryModel = new CountryModel;
$countryDAO = new CountryDAO();
$table = "country";
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    switch ($formAction){
        case "edit":
            $countryModel = shufflearray2object($_POST,$countryModel);
            if ( $sellist == "" )
                $countryModel->sellist = $code."_".$name;
            $stat = $countryDAO->saveUpdate ($countryModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "new":
            $countryModel = shufflearray2object($_POST,$countryModel);
            if ( $sellist == "" )
                $countryModel->sellist = $code."_".$name;
            $stat = $countryDAO->saveUpdate ($countryModel,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        case "delete": 
            $stat = $countryDAO->delete ($id,$table);
            if ( $stat ) {
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                }
            break;
        }

} 

$sort = " where id = '".$id."'";
if ( isset($code) && $code != "" && $code > 0 ) {
    $sort = " where scode = '".$code."'";
}
$countryModel =$countryDAO->getRecord($table,$sort);
if ( $countryModel == "" ) {
    $countryModel = new CountryModel();
    $countryModel->code = $code;
}

//Check whether the query was successful or not
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    $_SESSION['ERRFLAG']= "set";
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}

?> 
