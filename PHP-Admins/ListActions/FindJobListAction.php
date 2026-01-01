<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CareerDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CareerModel.php';
    if ( $cancel != ""){
        $hdrLocation="";
        $section="config";
        $sub_section="";
        $table="";
        $paramString="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$careerModel = new CareerModel;
$careerDAO = new CareerDAO();
$table = "career";
$sort = "";
$careers =$careerDAO->getRecord($table,$sort);

if ( $careers ) {
    $careers = convert2array($careers);
}

if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
$checkbox = "<td><input type='checkbox' name=".$val.$model->$key." id=".$key.$model->$key." value='".$val."'/></td>";
$applyNoJob = "<a href='FRCCareer.php?section=homePage&sub_section=findJobList&menuaction=action&table=applicant&edit=edit&formType=new'>Submit Resume Without Applying for a Specific Job</a>";
?>
