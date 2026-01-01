<?php
ob_start();

require_once dirname(__FILE__) .'/PHP-GlobalIncludes/auth.php';

if ( $section == null ) {
    $section = "career";
    $subsection = "FindJobList";
    $table="career";
}
switch ($section){
    case "career":
        $btn = "Homeselect";
        break;
    case "search":
        $btn = "Searchselect";
        break;
    case "contactUs":
        $btn = "3c";
        break;
    case "aboutUs":
        $btn = "4c";
        break;
    case "login":
        $btn = "Loginselect";
        break;
    case "config":
        $btn = "Configselect";
        break;
    case "action":
        $btn = "Updateselect";
        break;
    Default:
        $btn = "Homeselect";
    }
    ?>
<html>
    <head>
        <?php $hdrLabel = getLabel('frcCareerOpportunities',$locale); ?>

        <title><?php echo $hdrLabel?> </title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="PHP-css/frc-career.css" rel="stylesheet" type="text/css">
        <script language="JavaScript" type="text/javascript" src="PHP-jsScript/teamFRC.js"></script>
        <script language="JavaScript" type="text/javascript" src="PHP-jsScript/Dom_Utils.js"></script>
    </head>
    <body onload="btnHomeup=loadImage('Homeup');btnHomeover=loadImage('Homeover');btnHomeselect=loadImage('Homeselect');
                  btnLoginup=loadImage('Loginup');btnLoginover=loadImage('Loginover');btnLoginselect=loadImage('Loginselect');
                  btnLogoutup=loadImage('Logoutup');btnLogoutover=loadImage('Logoutover');btnLogoutselect=loadImage('Logoutselect');
                  btnUpdateup=loadImage('Updateup');btnUpdateover=loadImage('Updateover');btnUpdateselect=loadImage('Updateselect');
                  btnConfigup=loadImage('Configup');btnConfigover=loadImage('Configover');btnConfigselect=loadImage('Configselect');
                  getBtnVal();">

          <form name="FRCCareer" id="FRCCareer" method="post"   <?php echo $encrypt?> >
            <input name="btnVal" id="btnVal" type="hidden" value="<?php echo $btn?>"/>
            <table width="1026" height="526" border="0" align="center"  cellpadding="0" cellspacing="0" >
                <tr>
                    <td width="200" valign="top" align="left"><?php require_once dirname(__FILE__) .'/PHP-FileIncludes/FRCCareerLeftSideBar.php'; ?></td>
                    <td width="826" valign="top" align="left"><?php require_once dirname(__FILE__) .'/PHP-FileIncludes/FRCCareerBody.php'; ?></td>
                </tr>
            </table>
          </form>
    </body>
</html>
<?php ob_Flush(); ?>