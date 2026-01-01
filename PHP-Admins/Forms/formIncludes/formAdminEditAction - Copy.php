<?php
switch ($confModel->adminhtmltag){
    case "nodisplay":
        break;
    case "textarea":
        if ( $fileKey == $key ) {
            $hdLabel = getLabel("current",$locale);
            echo "<td nowrap valign='top'>".$hdLabel." ".$hdrLabel."</td>";
            if ( $val != "" ) {
                $hdrLabel = getLabel("current",$locale);
                echo "<td><a href='download.php?f=".$val."'>".$directoryHome.$val."</a>&nbsp;&nbsp;<a href='delete.php?f=".$val."&id=".$id."'>".$hdrLabel."</a></td></tr><tr>";
            } else {
                echo "<td>&nbsp;</td></tr><tr>";
            }
        }
        $img = "";
        $limg = "";
        eval($confModel->phpCode);
        echo "<td nowrap valign='top'>".$hdrLabel."</td>";
        echo "<td>".$limg."<textarea id='".$key."' name='".$key."' ".$confModel->adminhtmltype." >".$val."</textarea>".$img."</td>";
        break;
    case "list":
        if ( $fileKey == $key ) {
            $hdLabel = getLabel("current",$locale);
            echo "<td nowrap valign='top'>".$hdLabel." ".$hdrLabel."</td>";
            if ( $val != "" ) {
                $hdLabel = getLabel("delete",$locale);
                echo "<td><a href='download.php?f=".$val."'>".$directoryHome.$val."</a>&nbsp;&nbsp;<a href='delete.php?f=".$val."&id=".$id."'>".$hdLabel."/a></td></tr><tr>";
            } else {
                echo "<td>&nbsp;</td></tr><tr>";
            }
        }
        echo "<td nowrap valign='top'>".$hdrLabel."</td>";
        eval($phpcode);
        break;
    case "select":
        $multi = "";
        $dbId = "";
        if ( $fileKey == $key ) {
            $hdLabel = getLabel("current",$locale);
            echo "<td nowrap valign='top'>".$hdLabel." ".$hdrLabel."</td>";
            if ( $val != "" ) {
                $hdLabel = getLabel("delete",$locale);
                echo "<td><a href='download.php?f=".$val."'>".$directoryHome.$val."</a>&nbsp;&nbsp;<a href='delete.php?f=".$val."&id=".$id."'>".$hdLabel."</a></td></tr><tr>";
            } else {
                echo "<td>&nbsp;</td></tr><tr>";
            }
        }
        echo "<td nowrap valign='top'>".$hdrLabel."</td>";
        switch ($confModel->selvaltype){
            case "array":
                $tmp = $confModel->conf_value;
                $optList = $$tmp;
                break;
            case "var":
                $optList = eval($confModel->conf_value);
                break;
            case "sql":
                $optList = getSqlOptList($confModel->conf_value,$confModel->adminhtmltype);
                break;
            case "dbFunctions":
                if ( ! strpos($confModel->adminhtmltype,"multi") === false )
                $multi="[]";

                if ( ! strpos($confModel->conf_value,"XxXtableXxX") === false ) {
                    if ( strpos($confModel->conf_key,"link") === false ) {
                        $confModel->conf_value = str_replace("XxXtableXxX",$primarytable,$confModel->conf_value);
                    } else {
                        $confModel->conf_value = str_replace("XxXtableXxX",$linktable,$confModel->conf_value);
                    }
                }
                $optList = getDbFunctions($confModel->conf_value);
                break;
            case "dbFunctionsWithId":
                if ( ! strpos($confModel->adminhtmltype,"multi") === false )
                $multi="[]";

                if ( ! strpos($confModel->conf_value,"XxXtableXxX") === false ) {
                    if ( strpos($confModel->conf_key,"link") === false ) {
                        $confModel->conf_value = str_replace("XxXtableXxX",$primarytable,$confModel->conf_value);
                    } else {
                        $confModel->conf_value = str_replace("XxXtableXxX",$linktable,$confModel->conf_value);
                    }
                }
                $optList = getDbFunctionsWithId($confModel->conf_value);
                break;
            Default:
                $optList = split(",",$confModel->conf_value);

            }
            if ( $confModel->jscript != "" ) {
                $confModel->jscript = str_replace('$key',$key,$confModel->jscript);
                $confModel->jscript = str_replace('"',"'",$confModel->jscript);
            }
            if ( $confModel->jobhtmltype == "pre" && $confModel->phpCode != "" ) {
                $confCode = $confModel->phpCode;
                eval ($confCode);
            }
            echo "<td ><select id='".$key.$multi."' name='".$key.$multi."' ".$confModel->adminhtmltype." onchange=\"javascript:".$confModel->jscript.";\" >";
            if ( $key == 'emailid' )
                echo "<option value=''></option>";
            for ( $i = 0; $i < count($optList); $i += 1 ) {
                $select = "";
                $valAry = split("_",$optList[$i]);
                if ( ! strpos($valAry[0],'-') === false ) $valAry[0] = str_replace('-','_',$valAry[0]);
                if ( ! strpos($valAry[1],'-') === false ) $valAry[1] = str_replace('-','_',$valAry[1]);
                if ( is_array($dataCheck) && $multi != "") {
                    if ( $dataCheck[$i] == $i ) {
                        $select = "selected";
                    }
                } else {
                    if ( $val == $valAry[0] ) $select = "selected";
                }
                echo "<option value='".$valAry[0]."' ".$select." >".$valAry[1]."</option>";
            }
            echo "</select></td>";
            if ( $confModel->jobhtmltype == "post" && $confModel->phpCode != "" ) {
                $confCode = $confModel->phpCode;
                eval ($confCode);
            }
            echo $optSelect;
            echo $optTxt;
            break;
    case "label":
        if ( $fileKey == $key ) {
            $hdLabel = getLabel("current",$locale);
            echo "<td nowrap valign='top'>".$hdLabel." ".$hdrLabel."</td>";
            if ( $val != "" ) {
                $hdLabel = getLabel("delete",$locale);
                echo "<td><a href='download.php?f=".$val."'>".$directoryHome.$val."</a>&nbsp;&nbsp;<a href='delete.php?f=".$val."&id=".$id."'>".$hdLabel."</a></td></tr><tr>";
            } else {
                echo "<td>&nbsp;</td></tr><tr>";
            }
        }
        echo "<td nowrap valign='top'>".$hdrLabel."</td>";
        echo "<td valign='top'><label>".$val."</label></td>";
        break;
    Default:
        $v = $val;
        if ( $enc_password && $key == $enc_key ) {
            $type = "password";
            $v = "";
        }
        switch ($confModel->adminhtmltype) {
            case "hidden":
                echo "<input type='hidden' id='".$key."' name='".$key."' value='".$v."'/>";
                break;
            case "checkbox":
                if ( $fileKey == $key ) {
                    $hdLabel = getLabel("current",$locale);
                    echo "<td nowrap valign='top'>".$hdLabel." ".$hdrLabel."</td>";
                    if ( $val != "" ) {
                        $hdLabel = getLabel("delete",$locale);
                        echo "<td><a href='download.php?f=".$val."'>".$directoryHome.$val."</a>&nbsp;&nbsp;<a href='delete.php?f=".$val."&id=".$id."'>".$hdLabel."</a></td></tr><tr>";
                    } else {
                        echo "<td>&nbsp;</td></tr><tr>";
                    }
                }
                echo "<td nowrap valign='top'>".$hdrLabel."</td>";
                if ( $confModel->conf_value == "" || strpos($confModel->conf_value,",") === false ) {
                    if ( $confModel->phpCode != "" ) {
                        $confCode = $confModel->phpCode;
                        eval ($confCode);
                    }
                    echo "<td><input type='checkbox' name=checkbox_".$val." id=checkbox_".$val." value='".$val."' ".$checked."/></td>";
                } else {
                    $confAry = split(",",$confModel->conf_value);
                    echo "<td>";
                    foreach ( $confAry as $conf ) {
                        $valAry = split("_",$conf);
                        if ( $confModel->phpCode != "" ) {
                            $confCode = $confModel->phpCode;
                            eval ($confCode);
                        }
                        echo $valAry[1].": <input type='checkbox' name=".$key." id=".$key." value='".$valAry[0]."' ".$checked."/>&nbsp;&nbsp;";
                    }
                    echo "</td>";
                }
                break;
            Default:
                $img = "";
                $limg = "";
                eval($confModel->phpCode);
                if ( $fileKey == $key ) {
                    $hdLabel = getLabel("current",$locale);
                    echo "<td nowrap valign='top'>".$hdLabel." ".$hdrLabel."</td>";
                    if ( $val != "" ) {
                        $hdLabel = getLabel("delete",$locale);
                        echo "<td><a href='download.php?f=".$val."'>".$directoryHome.$val."</a>&nbsp;&nbsp;<a href='delete.php?f=".$val."&id=".$id."'>".$hdLabel."</a></td></tr><tr>";
                    } else {
                        echo "<td>&nbsp;</td></tr><tr>";
                    }
                }
                echo "<td nowrap valign='top'>".$hdrLabel."</td>";
                echo "<td>$limg<input type=".$confModel->adminhtmltype." id='".$key."' name='".$key."' value='$v'/>".$img."</td>";
            }
        }
        if ( $enc_password && $key == $enc_key ) {
            echo "<input type='hidden' id='org_".$key."' name='org_".$key."' value='".$val."'/>";
            echo "<input type='hidden' id='org_c".$key."' name='org_c".$key."' value='".$val."'/>";
            $hdrLabel = getLabel("confirm_".$key,$locale);
            echo "<tr>";
            echo "<td>".$hdrLabel."</td>";
            echo "<td><input type='".$type."' id='".$confirm_password."' name='".$confirm_password."' value=''/></td>";
            echo "</tr>";
        }
        ?>
