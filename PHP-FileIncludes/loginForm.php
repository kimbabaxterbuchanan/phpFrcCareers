<?php
session_start();
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../PHP-Actions/loginFormAction.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title>Job List</title>
        <link href="<?php echo dirname(__FILE__) ?>/../PHP-css/loginModule.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/teamFRC.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/Dom_Utils.js"></script>
        <script language="JavaScript" type="text/javascript">
            function submitJobSelect() {
                var obj1 = new getObj("table");
                obj1.value="applicant";
                var obj2 = new getObj("edit");
                obj2.value="apply";
                var obj3 = new getObj("formAction");
                obj3.value="jobs";
                document.ListForm.submit();
            }
        </script>
</head>
    <body>
        <h1><center><strong>Career Site Log-In</strong></center></h1>
        <?php
        require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/ProcessErrorsInclude.php';
        ?>
        <form id="loginForm" name="loginForm" method="post" action="FRCCareer.php">
            <input type="hidden" name="rtnPage" id="rtnPage" value="FRCCareer.php"/>
            <input type="hidden" name="rtnAction" id="rtnPage" value="<?php echo  $rtnAction ?>"/>
            <input type="hidden" name="id" id="id" value="<?php echo  $id ?>" />
            <input type="hidden" name="table" id="table" value="<?php echo  $table ?>"/>
            <input type="hidden" name="section" id="section" value="<?php echo  $section ?>" />
            <input type="hidden" name="sub_section" id="sub_section" value="<?php echo  $sub_section ?>" />
            <input type="hidden" name="postForm" id="postForm" value="yes" />
            <input type="hidden" name="edit" id="edit" value="<?php echo  $edit ?>" />
            <input type="hidden" name="careerIds" id="careerIds" value="<?php echo  $careerIds ?>" />
            <input type="hidden" name="formAction" id="formAction" value="<?php echo  $formAction ?>" />
            <input type="hidden" name="homeURL" id="homeURL" value="<?php echo  $homeURL ?>" />
            <input type="hidden" name="homeLoc" id="homeLoc" value="<?php echo  $homeLoc ?>" />
            <table width="100%" border="0" align="left" valign="top" cellpadding="2" cellspacing="0">
                    <tr>
                    <?php $hdrLabel = getLabel("registerAndSubmitResume",$locale); ?>
                        <td align="right">&nbsp;</td><td align="right"><a href="../PHP-Jobs/Forms/ActionForm.php?section=<?php echo $section?>&sub_section=<?php echo $sub_section?>&table=applicant&edit=edit&formAction=new&careerIds=<?php echo $careerIds?>"><?php echo $hdrLabel?></a></td>
                    </tr>
                     <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                   <tr>
                    <?php $hdrLabel = getLabel("loginApplicantId",$locale); ?>
                        <td align="right"><?php echo $hdrLabel?>: </td><td><input name="email" id="email" type="text" size="45" /></td>
                    </tr>
                    <tr>
                    <?php $hdrLabel = getLabel("loginPassword",$locale); ?>
                        <td align="right"><?php echo $hdrLabel?>:  </td><td><input name="password" id="password" type="password" size="45" /></td>
                    </tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
                    <tr>
                    <?php $hdrLabel = getLabel("submit",$locale); ?>
                            <td align="right"><input type="submit" name="Submit" value="<?php echo $hdrLabel?>" /></td>
                    <?php $hdrLabel = getLabel("clear",$locale); ?>
                            <td align="left"><input name="Clear" type="reset" id="Clear" value="<?php echo $hdrLabel?>" /></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                    <?php $hdrLabel = getLabel("loginForgotPassword",$locale); ?>
                        <a style="color:#000000" href="http://www.gmail.com/FRCCareers/PHP-FileINcludes/FRCCareerBody.php?section=ForgotPassword"><?php echo $hdrLabel?></a>
                        </td>
                    </tr>
            </table>
        </form>
    </body>
</html>