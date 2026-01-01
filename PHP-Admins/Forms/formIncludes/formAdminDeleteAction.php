<?php
switch ($confModel->adminhtmltag){
    case "nodisplay":
        break;
    Default;
        if ( $key == "id") {
            echo "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"".$val."\" />";
        } else if ( $confModel->adminhtmltype != 'password' && $confModel->adminhtmltype != 'hidden' ) {
            echo "<td nowrap valign='top'>".$hdrLabel."</td>";
            echo "<td valign='top'><label>".$prefix.$val."</label></td>";
        }
    }
    ?>
