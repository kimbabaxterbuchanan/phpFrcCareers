<?php
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../PHP-Actions/LoadFileAction.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo ucfirst($table)?> Form</title>
        <link href="<?php echo dirname(__FILE__) ?>/../PHP-css/loginModule.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/teamFRC.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/Dom_Utils.js"></script>
    </head>
    <body>
        <h1> <?php echo ucfirst($table)?> Form</h1>
        <?php
        require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/ProcessErrorsInclude.php';
        $model = $table."Model";
        ?>
        <form id="ActionForm" name="ActionForm" method="post" action="PHP-FileIncludes/LoadFileForm.php"  <?php echo $encrypt?> >
        <input type="hidden" name="id" id="id" value="<?php echo  $$model->id ?>" />
        <input type="hidden" name="table" id="table" value="<?php echo  $table ?>"/>
        <input type="hidden" name="section" id="section" value="<?php echo  $section ?>"/>
        <input type="hidden" name="sub_section" id="sub_section" value="<?php echo  $sub_section ?>"/>
        <input type="hidden" name="postForm" id="postForm" value="yes"/>
        <input type="hidden" name="edit" id="edit" value="<?php echo  $edit ?>"/>
        <input type="hidden" name="formAction" id="formAction" value="<?php echo  $formAction ?>"/>
        <input type="hidden" name="homeURL" id="homeURL" value="<?php echo  $homeURL ?>" />
        <input type="hidden" name="homeLoc" id="homeLoc" value="<?php echo  $homeLoc ?>" />
        <table width="500" border="0" align="center" cellpadding="2" cellspacing="0">
            <tr>
                <td>
                    <?php $hdrLabel = getLabel("file",$locale); ?>
                    <?php echo $hdrLabel?>:
                </td>
                <td>
                    <input type="file" id="file_name"  name="file_name" />
                </td>
            </tr>
            <tr>
                <td>
                    <?php $hdrLabel = getLabel("parserFileType",$locale); ?>
                    <?php echo $hdrLabel?>:
                </td>
                <td>
                    <select name="parserType" id="parserType">
                        <option value="text" selected>Text</option>
                        <option value="xml">XML</option>
                    </select>
                </td>
            </tr>
            <tr>
                <?php $hdrLabel = getLabel("cancel",$locale); ?>
                <td><input type="submit" name="cancel" id="cancel" value="<?php echo $hdrLabel?>" /></td>
                <?php if ( $edit != "view" ) { ?>
                    <?php if (  $edit != "delete" ) {?>
                        <?php $hdrLabel = getLabel("save",$locale); ?>
                        <td><input type="submit" name="save" id="save" value="<?php echo $hdrLabel?>" /></td>
                <?php } else { ?>
                <?php $hdrLabel = getLabel("delete",$locale); ?>
                        <td><input type="submit" name="delete" id="delete" value="<?php echo $hdrLabel?>" /></td>
                <?php } ?>
            <?php } ?>
            </tr>
        </table>
    </body>
</html>