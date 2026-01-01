<?php
//Start session
session_start();
$mosConfig_locale_debug = 0;
$mosConfig_locale_use_gettext = 0;

require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/globalVars.php';
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/functions.php';
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/filemanagerfunctions.php';
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/config.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/LanguageDAO.php';
require_once dirname(__FILE__) .'/../PHP-models/LanguageModel.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/ConfigurationDAO.php';
require_once dirname(__FILE__) .'/../PHP-models/ConfigurationModel.php';

$encrypt = "";
foreach ($_REQUEST as $key => $val) {
   $$key=htmldecode($val);
}
foreach ($_GET as $key => $val) {
   if ( !isset($$key) || trim($$key) == "")
         $$key=htmldecode($val);
}
foreach ($_POST as $key => $val) {
   if ( !isset($$key) || trim($$key) == "")
         $$key=htmldecode($val);
}

if ( $section == "" ) {
    $section = $_GET['section'];
}

if ( $section != "" ) {
    $_SESSION['SECTION'] = $section;
    } else if ( isset($_SESSION['SECTION']) && $_SESSION['SECTION'] != "" ) {
            $section = $_SESSION['SECTION'];
        }

if ( $sub_section == "" ) {
    $sub_section = $_GET['sub_section'];
}

$type="record";
$action="cancel";
if ( strpos($sub_section,'ListAction') ) {
    $type="list";
}
if(isset($_SESSION['SESS_FIRST_NAME']) && (trim($_SESSION['SESS_FIRST_NAME']) != '')) {
    $fullName=ucfirst($_SESSION['SESS_FIRST_NAME'])." ";
}

if(isset($_SESSION['SESS_MIDDLE_INITIAL']) && (trim($_SESSION['SESS_MIDDLE_INITIAL']) != '')) {
    $fullName.=ucfirst($_SESSION['SESS_MIDDLE_INITIAL'])." ";
}

if(isset($_SESSION['SESS_LAST_NAME']) && (trim($_SESSION['SESS_LAST_NAME']) != '')) {
    $fullName.=ucfirst($_SESSION['SESS_LAST_NAME']);
}

if(isset($_SESSION['EMAILFLAG']) && (trim($_SESSION['EMAILFLAG']) == 'yes')) {
    $emailflag=$_SESSION['EMAILFLAG'];
}

if(isset($_SESSION['EMAIL']) && (trim($_SESSION['EMAIL']) != '')) {
    $email=$_SESSION['EMAIL'];
}

if(isset($_SESSION['SUPERVISOR']) && (trim($_SESSION['SUPERVISOR']) != '')) {
    $supervisor=$_SESSION['SUPERVISOR'];
}

if(isset($_SESSION['MANAGER']) && (trim($_SESSION['MANAGER']) != '')) {
    $manager=$_SESSION['MANAGER'];
}

if(isset($_SESSION['LOGIN']) && (trim($_SESSION['LOGIN']) != '')) {
    $login=$_SESSION['LOGIN'];
}

if(isset($_SESSION['APPROVER']) && (trim($_SESSION['APPROVER']) == 'yes')) {
    $approver=$_SESSION['APPROVER'];
}

if(isset($_SESSION['ADMIN']) && (trim($_SESSION['ADMIN']) != "")) {
    $admin=$_SESSION['ADMIN'];
}
//Check whether the session variable SESS_MEMBER_ID is present or not
if(isset($section) && (!isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) == '')) ) {
    if ( isset($section) && $section == "" ) {
            header("location: ".$homeURL);
            exit();
        }
} else {
    if(isset($_SESSION['SESS_MEMBER_ID']) || (trim($_SESSION['SESS_MEMBER_ID']) != '')) {
            $isLogedIn = "yes";
            $loginId = $_SESSION['SESS_MEMBER_ID'];
        }
}
if ( !isset($_SESSION['LOCALE']) || trim($_SESSION['LOCALE']) == '' ) {
    $locale = "BASE";
    $_SESSION['LOCALE']=$locale;
    $chnglocale = $locale;
} else if ( trim($_SESSION['LOCALE']) != $chnglocale && $chnglocale != "" ) {
    $_SESSION['LOCALE']=$chnglocale;
    $locale = $chnglocale;
} else  {
    $locale=$_SESSION['LOCALE'];
    $chnglocale = $locale;
}

//if ( !isset($locale) || $locale == "" ) {
//    $locale = "BASE";
//    $_SESSION['LOCALE']=$locale;
//}
$langModel = new LanguageModel;
$langDAO = new LanguageDAO();
$confModel = new ConfigurationModel;
$confDAO = new ConfigurationDAO();

if ( $table == "resume")
{
     $encrypt = "enctype='multipart/form-data'";
}

?>