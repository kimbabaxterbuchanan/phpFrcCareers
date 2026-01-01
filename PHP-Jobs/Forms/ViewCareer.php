<?php
session_start();
echo dirname(__FILE__)."<BR>";
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../RecordActions/ViewCareerAction.php';
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
    <body bgcolor="#D7D7D7">
        <?php
        require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/ProcessErrorsInclude.php';
        ?>
        <?php echo "<center><h2>".ucfirst($table)." Information</h2></center><BR/>"?>
        <form id="ActionForm" name="ActionForm" method="post" action="FRCCareer.php" <?php echo $encrypt?> >
        <input type="hidden" name="table" id="table" value="<?php echo  $table ?>"/>
        <input type="hidden" name="section" id="section" value="<?php echo  $section ?>"/>
        <input type="hidden" name="sub_section" id="sub_section" value="<?php echo  $sub_section ?>"/>
        <input type="hidden" name="postForm" id="postForm" value="yes"/>
        <input type="hidden" name="edit" id="edit" value="<?php echo  $edit ?>"/>
        <input type="hidden" name="careerIds" id="careerIds" value="<?php echo  $careerIds ?>"/>
        <input type="hidden" name="formAction" id="formAction" value="<?php echo  $formAction ?>"/>
        <input type="hidden" name="page" id="page" value="<?php echo  $page ?>"/>
        <input type="hidden" name="prevpage" id="prevpage" value="<?php echo  $prevpage ?>"/>
        <input type="hidden" name="nextpage" id="nextpage" value="<?php echo  $nextpage ?>"/>
        <input type="hidden" name="homeURL" id="homeURL" value="<?php echo  $homeURL ?>" />
        <input type="hidden" name="homeLoc" id="homeLoc" value="<?php echo  $homeLoc ?>" />
        <?php
        echo "<table width=\"80%\" bgcolor=\"#D7D7D7\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\">";
        echo "<tr><td colspan=\"3\">".$helpMsg."</td></tr>";
        if ( $edit == "apply") $edit="edit";
        $model = $table."Model";
        $cnt = -1;
        $msgcnt = 1;
        $even = true;
        if ( $$model ) {
            $msg = "msg".$msgcnt;
            $sort = " where conf_type = 'record' and conf_table = '".$table."' and conf_key = '".$msg."'";
            $confModel = $confDAO->getRecord("configuration",$sort);
            if ( $confModel ) {
                $hdrMsg = getMsg($table."_record_".$msg,$locale);
                if ( $hdrMsg != "" && $confModel->jobhtmltag == "label")
                    echo "<tr><td colspan='3'>".$hdrMsg."</td></tr>";
            }
            $msgcnt++;
            foreach ($$model as $key => $val ){
                    $msg="msg_".$key;
                    $sort = " where conf_type = 'record' and conf_table = '".$table."' and conf_key = '".$msg."'";
                    $confModel = $confDAO->getRecord("configuration",$sort);
                    if ( $confModel ) {
                        $hdrMsg = getMsg($table."_record_".$msg,$locale);
                        if ( $hdrMsg != "" && $confModel->jobhtmltag == "label")
                            echo "<tr><td colspan='3'>".$hdrMsg."</td></tr>";
                    }
                    $sort = " where conf_type = 'record' and conf_table = '".$table."' and conf_key = '".$key."'";
                    $confModel = $confDAO->getRecord("configuration",$sort);
                    if ( ! $confModel )
                        $confModel = new ConfigurationModel;

                    $prefix = "";
                    if ( $confModel->conf_value == "currency" )
                        $prefix = "$";

                    $hdrLabel = getLabel($key,$locale);

                    echo "<tr>";
                    require dirname(__FILE__) .'/formIncludes/formJobViewAction.php';
                    echo "</tr>";
                    }
                }
                echo "</table>";
                eval($addList);
                $msg = "msg".$msgcnt;
                $sort = " where conf_type = 'record' and conf_table = '".$table."' and conf_key = '".$msg."'";
                $confModel = $confDAO->getRecord("configuration",$sort);
                if ( $confModel ) {
                    $hdrMsg = getMsg($table."_record_".$msg,$locale);
                    if ( $hdrMsg != "" && $confModel->jobhtmltag == "label" )
                        echo "<center>".$hdrMsg."</center>";
                }
                ?>
            </form>
    </body>
</html>