<?php
session_start();
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../ListActions/'.$sub_section.'Action.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/DbDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ProfileModel.php';
$dbDao = new DbDAO();
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
        <table width="726" border="3" align="left" cellpadding="0" cellspacing="0">
            <?php if ( ! $hidecreate ) { ?>
            <tr>
                <td colspan="9">
                    <?php if ( $reports != "" ) {
                            $hdrLabel = getLabel("create",$locale); ?>
                            <a href='FRCCareer.php?section=<?php echo $section?>&sub_section=<?php echo $sub_section?>&menuaction=report&table=<?php echo $table?>&edit=new&formAction=new&database=<?php echo DB_DATABASE?>'><?php echo $hdrLabel?> <?=ucfirst($table)?></a>
                    <?php } else {
                            $hdrLabel = getLabel("create",$locale); ?>
                            <a href="FRCCareer.php?section=<?php echo $section?>&sub_section=<?php echo $sub_section?>&menuaction=action&table=<?php echo $table?>&edit=edit&formAction=new"><?php echo $hdrLabel?> <?php echo ucfirst($table)?></a>
                    <?php } ?>
                    &nbsp;&nbsp;
                    <?php echo $loadFile?>
                </td>
            </tr>
            <?php } ?>
            <tr><td colspan="9">&nbsp;</td></tr>
            <?php
            $models = $table."s";
            $buildhdr = false;
            $cnt = 0;
            if ( $$models ) {
                $sort = " where conf_type = 'list' and conf_table = '".$table."' and conf_key = 'admin_msg1'";
                $confModel = $confDAO->getRecord("configuration",$sort);
                if ( confModel ) {
                    $hdrMsg = getMsg($table."_list_admin_msg1",$locale);
                    if ( $hdrMsg != "" && $confModel->adminhtmltag == "label" )
                        echo "<tr><td colspan='9'>".$hdrMsg."</td></tr>";
                }
                $sort = " where conf_type = 'list' and conf_table = '".$table."' and conf_key = 'admin_msg2'";
                $confModel = $confDAO->getRecord("configuration",$sort);
                if ( confModel ) {
                    $hdrMsg = getMsg($table."_list_admin_msg2",$locale);
                    if ( $hdrMsg != "" && $confModel->adminhtmltag == "label" )
                        echo "<tr><td colspan='9'>".$hdrMsg."</td></tr>";
                }
                foreach( $$models as $model ) {
                    if ( $model ) {
                        $bdy="";
                        $id = 0;
                        foreach ( $model as $key => $val ){
                            $sort = " where conf_type = 'list' and conf_table = '".$table."' and conf_key = '".$key."'";
                            $confModel = $confDAO->getRecord("configuration",$sort);
                            if ( $confModel->adminhtmltag != "nodisplay") {
                                if ( $key == 'applicantId' ){
                                    $sort = " where id = '".$val."'";
                                    $applicantModel = $confDAO->getRecord('applicant', $sort);
                                    $val = $applicantModel->last_name.", ".$applicantModel->first_name." ".$applicantModel->middle_initial;
                                }
                                if ( $key == 'careerId' ){
                                    $sort = " where id = '".$val."'";
                                    $careerModel = $confDAO->getRecord('career', $sort);
                                    $val = $careerModel->req_number;
                                }
                                $hdrLabel = getLabel($key,$locale);
                                $hdrLabel=$key;
                                if ( $key == "id")
                                    $id = $val;
                                if ( $cnt == 0 ) {
                                    $hdr .= "<th>".$hdrLabel."</th>";
                                }
                                if ( $key == "resource_value" )
                                {
                                     $bdy .= "<td width='250' style='WORD-BREAK:BREAK-ALL;'>".$val."</td>";
                                } else {
                                     $bdy .= "<td>".$val."</td>";
                                }
                            }
                        }
                        if ( $cnt == 0 ) {
                            $hdr .= "<th>&nbsp;</th><th nowrap>&nbsp;".$phdr."</th><th>&nbsp;</th>";
                            echo "<tr>".$hdr."</tr>";
                        }
                        $cnt += 1;
                        $bdy .= "<td>";
                        if ( $reports != "" ) {
                            $hdrLabel = getLabel("run",$locale);
                            $bdy .= "<a href='FRCCareer.php?id=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=report&table=".$table."&edit=run&formAction=view&btnSubmit=Run'>".$hdrLabel."</a>";
                        } else {
                            $hdrLabel = getLabel("view",$locale);
                            $bdy .= "<a href='FRCCareer.php?id=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=action&table=".$table."&edit=view&formAction=view'>".$hdrLabel."</a>";
                        }
                        $bdy .= "</td>";
                        $bdy .= "<td><table align='center' width='100%' border='0'>";
                        $bdy .= "<tr>";
                        $hdrLabel = getLabel("edit",$locale);
                        $bdy .= "<td align='center'><a href='FRCCareer.php?id=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=action&table=".$table."&edit=edit&formAction=edit'>".$hdrLabel."</a></td>";
                        if ( $profile != "" )
                            $bdy .= "<td align='center' width='".$width."'><a href='FRCCareer.php?id=0&applicantId=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=action&table=".$profile."&edit=edit&formAction=edit'>".$hdrLabel."</a></td>";
                        if ( $certification != "" )
                            $bdy .= "<td align='center' width='".$width."'><a href='FRCCareer.php?id=0&applicantId=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=action&table=".$certification."&edit=edit&formAction=edit'>".$hdrLabel."</a></td>";
                        if ( $eeo != "" )
                            $bdy .= "<td align='center' width='".$width."'><a href='FRCCareer.php?id=0&applicantId=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=action&table=".$eeo."&edit=edit&formAction=edit'>".$hdrLabel."</a></td>";
                        if ( $resume != "" )
                            $bdy .= "<td align='center' width='".$width."'><a href='FRCCareer.php?id=0&applicantId=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=action&table=".$resume."&edit=edit&formAction=edit'>".$hdrLabel."</a></td>";
                        if ( $requirement != "" ) {
                            $bdy .= "<td align='center' width='".$width."'><a href='FRCCareer.php?id=0&careerId=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=action&table=".$requirement."&edit=edit&formAction=edit'>".$hdrLabel."</a></td>";
                            $sort = " where careerId = '".$id."'";
                            $applications = $applicationDAO->getRecord('application',$sort);
                            $counter = 0;
                            if ( $applications ) {
                                $counter = count($applications);
                            }
                            $bdy .= "<td align='center' width='".$width."'><a href='FRCCareer.php?id=0&careerId=".$id."&section=".$section."&sub_section=applicantList&menuaction=list&table=applicant&edit=Applications&formAction=list'>".$counter."</a></td>";
                        }
                        $bdy .= "</tr></table></td>";
                        $hdrLabel = getLabel("delete",$locale);
                        $bdy .= "<td><a href='FRCCareer.php?id=".$id."&section=".$section."&sub_section=".$sub_section."&menuaction=action&table=".$table."&edit=delete&formAction=delete'>".$hdrLabel."</a></td>";
                        echo "<tr>".$bdy."</tr>";
                    }
                }
            }
                $sort = " where conf_type = 'list' and conf_table = '".$table."' and conf_key = 'admin_msg3'";
                $confModel = $confDAO->getRecord("configuration",$sort);
                if ( confModel ) {
                    $hdrMsg = getMsg($table."_list_admin_msg3",$locale);
                    if ( $hdrMsg != "" && $confModel->adminhtmltag == "label" )
                        echo "<tr><td colspan='9'>".$hdrMsg."</td></tr>";
                }
            ?>
            <tr>
                <?php $hdrLabel = getLabel("cancel",$locale);
                    echo "<td colspan='10' align='center'><input type='submit' name='cancel' id='cancel' value='".$hdrLabel."' /></td>";
                ?>
            </tr>
        </table>
            <?php
                $sort = " where conf_type = 'list' and conf_table = '".$table."' and conf_key = 'admin_msg4'";
                $confModel = $confDAO->getRecord("configuration",$sort);
                if ( confModel ) {
                    $hdrMsg = getMsg($table."_list_admin_msg4",$locale);
                    if ( $hdrMsg != "" && $confModel->adminhtmltag == "label" )
                        echo "<center>".$hdrMsg."</center>";
                }
            ?>
        <br><br>
            </div>
        </form>
    </body>
</html>