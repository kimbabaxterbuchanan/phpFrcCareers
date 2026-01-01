<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ForwarderDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ForwarderModel.php';

    if ( $cancel != ""){
        $hdrLocation = "";
        $section="config";
        $sub_section="";
        $table="";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
    }

$forwarderModel = new ForwarderModel;
$forwarderDAO = new ForwarderDAO();
$table = "forwarder";
$sort = "";
$forwarders = $forwarderDAO->getRecord($table,$sort);

if ( $forwarders ) {
    $forwarders = convert2array($forwarders);
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
