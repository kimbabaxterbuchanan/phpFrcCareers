<?php
//Start session();
global $homeURL, $homeLoc, $homeDr, $homeDir, $hdrLocation, $paramString, $login, $loginId, $isLogedIn, $isAwarded;
global $webAdmin, $teamManager, $applicantCompanyId, $createTeamDirAry, $createWorkDirAry;
global $curDir, $companyDir, $awardDir, $awardWorkDir, $libDir, $libWorkDir, $directoryWorkHome, $directoryHome;
global $isHTML,$smtpAuth ,$smtpApplicantname,$smtpPassword ,$port,$wordWrap,$defaultMailHost,$toMail;
global $toName,$fromMail,$fromName,$replyMail,$replyName,$subject,$body,$altBody;
global $notifyApplicantId, $notifyCareerId, $notifyEmailId, $info;

if(!isset($_SESSION['HOMEDIR']) ) {
    $homeDir = dirname($_SERVER['PHP_SELF']);
    $idx = split("/",$_SERVER['PHP_SELF']);
    $homeLoc = $idx[count($idx)-1];
    $homeDr = $homeDir;
    $homeDir .= "/";
    $_SESSION['HOMEDR'] = $homeDr;
    $_SESSION['HOMEDIR'] = $homeDir;
    $_SESSION['HOMELOC'] = $homeLoc;
} else {
    $homeDir = $_SESSION['HOMEDIR'];
    $homeDr = $_SESSION['HOMEDR'];
    $homeLoc = $_SESSION['HOMELOC'];
}

$homeURL = $_SERVER['HTTP_HOST'].$homeDr;

$httpPath = "localhost".$homeDr;

$httpDir = $homeDir;

$hdrLocation = "";
$paramString = "";

$companyLogo = "itssb_banner7.jpg";

$section = "";

$sub_section = "";

$isLogedIn = "no";

$email = "";
$fullname = "";

$enc_password = false;

$width="50";
$addButton = "";
$hideButtons = "no";
$hideListLabels = "";

$adminApplicant = 0;
$adminPOC = 20;
$adminManager = 40;
$adminHR = 80;
$adminWeb = 100;

$manager="no";
if ( !isset($admin) || $admin == "" ) $admin="0";
$supervisor="no";
$approver="no";
$loginId = 0;
$login = "";
$directoryHome = "c:/resumes/";
$directoryWorkHome = "c:/resumes/";

$isHTML = true;
$smtpAuth = true;     // turn on SMTP authentication
$smtpApplicantname = "career@gmail.com";  // SMTP applicantname
$smtpPassword = "1car123"; // SMTP password
$port=587;
$wordWrap = "50";
$defaultMailHost = "mail.gmail.com";
$toMail = "career@gmail.com";
$toName = "Careers";
$fromMail = "career@gmail.com";
$fromName = "FRC Careers";
$replyMail = "career@gmail.com";
$replyName = "FRC Careers";
$ccMail = "";
$ccName = "";
$subject = "[subject]";
$body = "[body]";
$altBody = "[altBody]";

$notifyApplicantId = "";
$notifyCareerId = "";
$notifyEmailId = "";
$encrypt = "";
$info = "";
$table = "";
$extra = "";
?>