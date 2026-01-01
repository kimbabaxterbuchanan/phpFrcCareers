<?php
//Start session
session_start();

require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
//Include database connection details
require_once dirname(__FILE__) .'/../PHP-models/LoadFileModel.php';

$model = new LoadFileModel;
if ( isset($postForm) && $postForm != "" ) {
//Sanitize the POST values
    $hdrLocation=$homeDir."PHP-Admins/Forms/ListForm.php";
    if ( $rtnPage != "" ) {
            $hdrLocation = $rtnPage;
        }

    if ( $cancel != ""){
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        }
    if ( $parserType == "text" ) {
            require_once dirname(__FILE__) .'/../PHP-Parsers/txtParser.php';
            $parser = new txtParser();
        } else {
            require_once dirname(__FILE__) .'/../PHP-Parsers/xmlParser.php';
            $parser = new xmlParser();
        }
    if ($_FILES["file_name"]["error"] > 0) {
            $hdLabel = getLabel("error",$locale);
            $errmsg_arr[] = $hdLabel.": " . $_FILES["file_name"]["error"];
            $errflag = true;
        } else {
            $uploadFile = dirname(__FILE__) ."/../PHP-Parsers/".$_FILES["file_name"]["name"];
            $fres = copy($_FILES['file_name']['tmp_name'], $uploadFile);
            if ( $fres ) {
                   $parser->loadFile($uploadFile,$table);
                    doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
                } else {
                    $hdLabel = getLabel("fileUploadError",$locale);
                    $errmsg_arr[] = $hdLabel;
                    $errflag = true;
                }
        }
} 
if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
        //            header("location: applicantForm.php?id=".$id);
        //            exit();
}
$encrypt = "enctype='multipart/form-data'";

?>