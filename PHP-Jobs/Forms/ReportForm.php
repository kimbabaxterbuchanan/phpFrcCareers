<?php
session_start();
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../RecordActions/Run'.ucfirst($table).'Action.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><?=ucfirst($table)?> List FormForm</title>
    <link href="<?=dirname(__FILE__) ?>/../PHP-css/loginModule.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/teamFRC.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/Dom_Utils.js"></script>
</head>
<body>
<h1><?=ucfirst($table)?> List Form</h1>
<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/ProcessErrorsInclude.php';
?>
<form id="ListForm" name="ListForm" method="post" action="FRCCareer.php">
<input type="hidden" name="rtnPage" id="rtnPage" value="FRCCareer.php"/>
<input type="hidden" name="id" id="id" value="<?= $id ?>" />
<input type="hidden" name="table" id="table" value="<?= $table ?>"/>
<input type="hidden" name="forward_section" id="forward_section" value="<?= $forward_section ?>" />
<input type="hidden" name="forward_sub_section" id="forward_sub_section" value="<?= forward_ ?>" />
<input type="hidden" name="section" id="section" value="<?= $section ?>" />
<input type="hidden" name="sub_section" id="sub_section" value="<?= $sub_section ?>" />
<input type="hidden" name="postForm" id="postForm" value="yes" />
<input type="hidden" name="formAction" id="formAction" value="<?= $formAction ?>" />
<input type="hidden" name="homeURL" id="homeURL" value="<?= $homeURL ?>" />
<input type="hidden" name="homeLoc" id="homeLoc" value="<?= $homeLoc ?>" />
<table width="807" border="3" align="center" cellpadding="2" cellspacing="0">
    <?php
    $buildhdr = false;
    $cnt = 0;
    if ( $report ) {
        foreach( $report as $model ) {
            if ( $model ) {
                $bdy="";
                $id = 0;
                foreach ( $model as $key => $val ){
                    if ($key != "create_date" && $key != "last_modified" ) {
                            $sort = " where locale = '".$locale."' and resource_key = '".$key."'";
                            $langModel = $langDAO->getRecord("language",$sort);
                            $hdrLabel=$key;
                            if ( $langModel )
                                $hdrLabel = $langModel->resource_value;
                        if ( $cnt == 0 && $key != "") {
                            $hdr .= "<th>".$hdrLabel."</th>";
                        }
                        $bdy .= "<td>".$val."</td>";
                    }
                }
                if ( $cnt == 0 ) {
                    echo "<tr>".$hdr."</tr>";
                }
                $cnt += 1;

                echo "<tr>".$bdy."</tr>";
            }
        }
    }
    echo "<tr><td align='center' colspan='25'><input type='submit' name='cancel' id='cancel' value='Cancel' /></td>";
    ?>
    </tr>
</table>
<br><br>
</body>
</html>