<?php
switch ($confModel->adminhtmltag){
    case "nodisplay":
        break;
    Default:
        if ( $confModel->adminhtmltype != 'password' && $confModel->adminhtmltype != 'hidden' ) {
            echo "<td nowrap valign='top'>".$hdrLabel.":&nbsp;&nbsp;</td>";
            echo "<td valign='top'><label>".$prefix.$val."</label></td>";
        }
    }
    ?>
