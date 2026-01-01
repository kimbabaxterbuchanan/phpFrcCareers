<?php
session_start();
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../PHP-Actions/forgotPasswordFormAction.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="<?php echo dirname(__FILE__) ?>/../PHP-css/loginModule.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php $hdrLabel = getLabel("forgottenPasswordForm",$locale); ?>
        <h1><?php echo $hdrLabel?></h1>
        <?php
        require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/ProcessErrorsInclude.php';
        ?>
        <form id="fogottenPasswordForm" name="fogottenPasswordForm" method="post" action="PHP-FileIncludes/forgotPasswordForm.php">
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


            <table width="300" border="0" align="center" cellpadding="2" cellspacing="0">
            
                <tr>
                    <?php $hdrLabel = getLabel("emailAddress",$locale); ?>
                    <th><?php echo $hdrLabel?></th>
                    <td><input size="40" name="forgotemail" type="text" class="textfield" id="forgotemail" value="" /></td>
                </tr>
                <tr>
                    <?php $hdrLabel = getLabel("getPassword",$locale); ?>
                    <td><input type="submit" name="forgotten" id="forgotten" value="<?php echo $hdrLabel?>" /></td>
                </tr>
                
            </table>
        </form>
    </body>
</html>
