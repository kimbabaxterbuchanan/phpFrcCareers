<?php
session_start();
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
?>
<?php require_once dirname(__FILE__) .'/../ListActions/'.$sub_section.'Action.php';
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
    <body bgcolor="#D7D7D7">
        <?php
        require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/ProcessErrorsInclude.php';
        ?>
        <form id="ListForm" name="ListForm" method="post" action="FRCCareer.php">
        <!--input type="hidden" name="rtnPage" id="rtnPage" value="FRCCareer.php"/-->
        <input type="hidden" name="id" id="id" value="<?php echo  $id ?>" />
        <input type="hidden" name="table" id="table" value="<?php echo  $table ?>"/>
        <input type="hidden" name="section" id="section" value="<?php echo  $section ?>" />
        <input type="hidden" name="sub_section" id="sub_section" value="<?php echo  $sub_section ?>" />
        <input type="hidden" name="postForm" id="postForm" value="yes" />
        <input type="hidden" name="edit" id="edit" value="<?php echo  $edit ?>" />
        <input type="hidden" name="formAction" id="formAction" value="<?php echo  $formAction ?>" />
        <input type="hidden" name="homeURL" id="homeURL" value="<?php echo  $homeURL ?>" />
        <input type="hidden" name="homeLoc" id="homeLoc" value="<?php echo  $homeLoc ?>" />
        <table bgcolor="#D7D7D7" id="listformTable" width="726" valign="top" border="1" align="left" cellpadding="0" cellspacing="0">
            <?php eval($searchInfo); ?>
            <?php
            $models = $table."s";
            $buildhdr = false;
            $cnt = 0;
            $fndId = false;
            if ( $$models ) {
                $sort = " where conf_type = 'list' and conf_table = '".$table."' and conf_key = 'msg1'";
                $confModel = $confDAO->getRecord("configuration",$sort);
                if ( confModel ) {
                    $hdrMsg = getMsg($table."_list_msg1",$locale);
                    if ( $hdrMsg != "" && $confModel->jobhtmltag == "label" )
                        echo "<tr><td colspan='9'>".$hdrMsg."</td></tr>";
                }
                $sort = " where conf_type = 'list' and conf_table = '".$table."' and conf_key = 'msg2'";
                $confModel = $confDAO->getRecord("configuration",$sort);
                if ( confModel ) {
                    $hdrMsg = getMsg($table."_list_msg2",$locale);
                    if ( $hdrMsg != "" && $confModel->jobhtmltag == "label" )
                        echo "<tr><td colspan='9'>".$hdrMsg."</td></tr>";
                }
                foreach( $$models as $model ) {
                    if ( $model ) {
                        $bdy="";
                        $id = 0;
                        foreach ( $model as $key => $val ){
                            if ( $model->id > 0 )
                                $fndId = true;
                            $pre=$key;
                            if ( $table == "career" && $key == "id") $pre = "select";
                            $sort = " where conf_type = 'list' and conf_table = '".$table."' and conf_key = '".$key."'";
                            $confModel = $confDAO->getRecord("configuration",$sort);
                            $hdrLabel = getLabel($pre,$locale);
                            if ( $hdrLabel != "Select" )
                            $hdr .= "<th>".$hdrLabel."</th>";
                            if ( $id == 0 && $key == "id" )
                                $id = $val;
                            switch ($confModel->jobhtmltag){
                                case "nodisplay":
                                    break;
                                case "a":
                                        $bdy .= "<td><a href='FRCCareer.php?section=action&sub_section=".$sub_section."&table=".$confModel->jobhtmltype."&edit=view&formAction=view&id=".$id."'>".$val."</a></td>";
                                    break;
                                case "label":
                                    $bdy .= "<td align='center'>".$val."</td>";
                                    break;
                                case "input":
                                    switch ($confModel->jobhtmltype) {
                                        case "hidden":
                                            $bdy .= "<td><input type='hidden' name=".$key." id=".$key." value='".$val."'/></td>";
                                            break;
                                        case "checkbox":
                                            if ( $confModel->phpCode != "" ) {
                                                $confCode = $confModel->phpCode;
                                                eval ($confCode);
                                            }
                                            $bdy .= "<input type='hidden' name=checkbox_".$val." id=checkbox_".$val." value='".$val."' ".$checked."/>";
                                            break;
                                        Default:
                                            $bdy .= "<td><input type='text' name=".$key." id=".$key." value='".$val."'/></td>";
                                        }
                                    break;
                                Default:
                                    $bdy .= "<td align='center'>".$val."</td>";
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
            ?>
        </table>
        </form>
    </body>
</html>