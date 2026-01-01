<?php
session_start();
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../RecordActions/Run'.ucfirst($table).'Action.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><?php echo ucfirst($table)?> List FormForm</title>
    <link href="<?php echo dirname(__FILE__) ?>/../PHP-css/loginModule.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/teamFRC.js"></script>
    <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/Dom_Utils.js"></script>
</head>
<body>
<h1><?php echo ucfirst($table)?> List Form</h1>
<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/ProcessErrorsInclude.php';
?>
<form id="ListForm" name="ListForm" method="post" action="FRCCareer.php">
<input type="hidden" name="rtnPage" id="rtnPage" value="FRCCareer.php"/>
<input type="hidden" name="id" id="id" value="<?php echo  $id ?>" />
<input type="hidden" name="table" id="table" value="<?php echo  $table ?>"/>
<input type="hidden" name="forward_section" id="forward_section" value="<?php echo  $forward_section ?>" />
<input type="hidden" name="forward_sub_section" id="forward_sub_section" value="<?php echo  forward_ ?>" />
<input type="hidden" name="section" id="section" value="<?php echo  $section ?>" />
<input type="hidden" name="sub_section" id="sub_section" value="<?php echo  $sub_section ?>" />
<input type="hidden" name="postForm" id="postForm" value="yes" />
<input type="hidden" name="formAction" id="formAction" value="<?php echo  $formAction ?>" />
<input type="hidden" name="homeURL" id="homeURL" value="<?php echo  $homeURL ?>" />
<input type="hidden" name="homeLoc" id="homeLoc" value="<?php echo  $homeLoc ?>" />
<div style="height:500; width:750; overflow:auto;">
<table width="80%" border="3" align="center" cellpadding="0" cellspacing="0">
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
                        $hdrLabel = getLabel($key,$locale);
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
    $hdrLabel = getLabel("cancel",$locale);
    echo "<tr><td align='center' colspan='25'><input type='submit' name='cancel' id='cancel' value='".$hdrLabel."' /></td>";
    ?>
    </tr>
</table>
</div>
<br><br>
</body>
</html>