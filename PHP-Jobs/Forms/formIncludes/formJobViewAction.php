<?php
switch ($confModel->jobhtmltag){
    case "nodisplay":
        break;
    case "input":
        if ( $confModel->jobhtmltype == 'hidden' ) {
            echo "<td><input type='hidden' id='".$key."'. name='".$key."' value='".$val."'></td>";
        }
        break;
    Default:
        if ( $confModel->jobhtmltype != 'password' && $confModel->jobhtmltype != 'hidden' ) {
            echo "<td nowrap valign='top'>".$hdrLabel.":  </td>";
			echo "<td valign='top'>".$prefix.$val."</td></tr>";
        }
    }
    ?>
