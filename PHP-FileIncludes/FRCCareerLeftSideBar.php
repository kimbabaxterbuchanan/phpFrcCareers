<?php
session_start();
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';

$norm_bgcolor = "BA1303";
$sel_bgcolor = "801303";
$bgcolor= "BA1303";
?>
<script language="JavaScript" type="text/javascript" src="../PHP-jsScript/Dom_Utils.js"></script>
<!--#7E130D-->
<table align="left" id="leftSidebarTable" name="leftSidebarTable" width="100%" valign="top" border="0"  cellpadding="0" cellspacing="0">
        <!-- tr>
            <td nowrap cellpadding="0" cellspacing="0"><a  style="text-decoration: none;" href="BenefitsSummary.php" target="_Parent" onmouseover='msOver("BENover");' onmouseout='msOut("BENup");' onmousedown='btnSelect("BENup");' ><img src="PHP-Images/SubButtBENup.jpg" name=btnBEN alt="Benefits Summary" border=0 hspace="0"></a></td>
        </tr -->
        <?php if ( $isLogedIn == "yes" ) { ?>
        <?php $hdrLabel = getLabel("logout",$locale); ?>
        <tr>
            <td nowrap cellpadding="0" cellspacing="0"><a  style="text-decoration: none;" href="PHP-Actions/logOutAction.php" onmouseover='msOver("Logoutover");' onmouseout='msOut("Logoutup");' onmousedown='btnSelect("Logoutselect");' ><img src="PHP-Images/SubButtLogoutup.jpg" name=btnLogout alt="Logout" border=0 hspace="0"></a></td>
        </tr>
        <?php $hdrLabel = getLabel("applicantUpdate",$locale); ?>
        <tr>
            <td nowrap cellpadding="0" cellspacing="0"><a  style="text-decoration: none;" href="FRCCareer.php?section=action&sub_section=<?php echo $sub_section?>&table=applicant&edit=edit&formAction=edit&id=<?php echo $loginId?>" onmouseover='msOver("Updateover");' onmouseout='msOut("Updateup");' onmousedown='btnSelect("Updateselect");' ><img src="PHP-Images/SubButtUpdateup.jpg" name=btnUpdate alt="Update Application" border=0 hspace="0"></a></td>
        </tr>
        <?php } else { ?>
        <?php $hdrLabel = getLabel("login",$locale); ?>
        <tr>
            <td nowrap cellpadding="0" cellspacing="0"><div id="sidebarDiv"><a  style="text-decoration: none;" href="FRCCareer.php?section=login" onmouseover='msOver("Loginover");' onmouseout='msOut("Loginup");' onmousedown='btnSelect("Loginselect");' ><img src="PHP-Images/SubButtLoginup.jpg" name=btnLogin alt="Login" border=0 hspace="0"></a></div></td>
        </tr>
        <?php } ?>
        <tr>
            <td nowrap cellpadding="0" cellspacing="0"><div id="sidebarDiv"><a  style="text-decoration: none;" href="FRCCareer.php?section=career&sub_section=FindJobList&table=career" onmouseover='msOver("Homeover");' onmouseout='msOut("Homeup");' onmousedown='btnSelect("Homeselect");' ><img src="PHP-Images/SubButtHomeup.jpg" name=btnHome alt="Home" border=0 hspace="0"></a></div></td>
        </tr>
        <?php if ( $admin > 0 ) { ?>
        <?php $hdrLabel = getLabel("dbFunctions",$locale); ?>
        <tr>
            <td nowrap cellpadding="0" cellspacing="0"><a  style="text-decoration: none;" href="FRCCareer.php?section=config"  onmouseover='msOver("Configover");' onmouseout='msOut("Configup");' onmousedown='btnSelect("Configselect");' ><img src="PHP-Images/SubButtConfigup.jpg" name=btnConfig alt="Config" border=0 hspace="0"></a></td>
        </tr>
        <?php } ?>
    <tr>
        <td nowrap cellpadding="0" cellspacing="0">&nbsp;</td>
    </tr>
</table>