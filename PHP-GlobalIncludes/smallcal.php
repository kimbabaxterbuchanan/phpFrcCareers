
<? 
////////////////////////////////////////////////////////////////////// 
// Pop-Up Calendar by: Burrito // 
// // 
// 03-22-2005 // 
// // 
// PHP Replacement For JS Calendars // 
// // 
////////////////////////////////////////////////////////////////////// 

// set date for month...default is today...Burrito 
if($_GET['dateon'] == "" && !isset($_GET['yr'])){ 
    $datetime = date("m/d/Y", time()); 
    $mo = date("n", time()); 
    $yr = date("Y", time()); 
    $da = date("d", time()); 
    }else if(!isset($_GET['yr'])){ 
            $datetime = date("m/d/Y", strtotime($_GET['dateon'])); 
            $mo = date("n", strtotime($_GET['dateon'])); 
            $yr = date("Y", strtotime($_GET['dateon'])); 
            $da = date("d", strtotime($_GET['dateon'])); 
        
        }else{ 
            $datetime = date("m/d/Y", strtotime($_GET['mo']."/01/".$_GET['yr'])); 
            $mo = $_GET['mo']; 
            $yr = $_GET['yr']; 
            $da = ""; 
        } 
        // find last day of the month for given month/year...burrito 
$dim = date("t", strtotime($datetime)); 



?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 

<html> 
    <head> 
        <title>Calendar</title> 
        <style> 
            .parent 
            { 
                border: 1px #2b2c33 solid; 
            } 
            .prow 
            { 
                border-bottom: 1px #2b2c33 solid; border-right: 1px #2b2c33 solid; 
            } 
            .headRow 
            { 
                font-family:tahoma; font-size:9.5pt; color:#506749; font-weight:bold; 
            } 
            .row 
            { 
                font-family:tahoma; font-size:9pt; color:#506749 
            } 
            td.cell 
            { 
                font-family:tahoma; font-size:9pt; color:#506749 
            } 
            select,input 
            { 
                font-family:tahoma; font-size:9pt; color:#506749; background-color:#e4ddc0; border: 1px #273536 solid; 
            } 
            td.days 
            { 
                font-family:tahoma; font-size:9pt; color:#000000; background-color:#c3c3c3; 
                border-bottom: 1px #2b2c33 solid; border-right: 1px #2b2c33 solid; overflow:auto 
            } 
            td.nodays 
            { 
                font-family:tahoma; font-size:9pt; color:#909090; background-color:#dfdfdf; 
                border-bottom: 1px #2b2c33 solid; border-right: 1px #2b2c33 solid; overflow:auto 
            } 
            td.tday 
            { 
                font-family:tahoma; font-size:9pt; color:#000000; background-color:#919191; 
                border: 1px #2b2c33 solid; overflow:auto 
            } 
            .gr 
            { 
                color:#374248 
            } 
            td.full 
            { 
                font-family:tahoma; font-size:9pt; color:#000000; background-color:#C99797; 
                border-bottom: 1px #2b2c33 solid; border-right: 1px #2b2c33 solid; 
            } 
        </style> 
        <script> 
            function updateParent(what,when,yrwhen){ 
                var month = (when ? when : "<?php echo $mo;?>"); 
                    var year = (yrwhen ? yrwhen : "<?php echo $yr;?>"); 
                        opener.document.<?php echo $_GET['fn'].".".$_GET['where'];?>.value = month+"/"+what+"/"+year; 
                        window.close(); 
                    } 
        </script> 
    </head> 
    
    <body> 
        
        <table width="99%" cellspacing="0" align="center" class="parent" height="95%"> 
        <tr> 
            <td colspan="7" align="center" class="prow" height="10"> 
                <form action="PHP-GlobalIncludes/smallcal.php"> 
                    <select name="mo"> 
                        <option value="1" <?php echo ($mo == "1" ? "selected=\"selected\"" : ""); ?>>January</option> 
                        <option value="2" <?php echo ($mo == "2" ? "selected=\"selected\"" : ""); ?>>February</option> 
                        <option value="3" <?php echo ($mo == "3" ? "selected=\"selected\"" : ""); ?>>March</option> 
                        <option value="4" <?php echo ($mo == "4" ? "selected=\"selected\"" : ""); ?>>April</option> 
                        <option value="5" <?php echo ($mo == "5" ? "selected=\"selected\"" : ""); ?>>May</option> 
                        <option value="6" <?php echo ($mo == "6" ? "selected=\"selected\"" : ""); ?>>June</option> 
                        <option value="7" <?php echo ($mo == "7" ? "selected=\"selected\"" : ""); ?>>July</option> 
                        <option value="8" <?php echo ($mo == "8" ? "selected=\"selected\"" : ""); ?>>August</option> 
                        <option value="9" <?php echo ($mo == "9" ? "selected=\"selected\"" : ""); ?>>September</option> 
                        <option value="10" <?php echo ($mo == "10" ? "selected=\"selected\"" : ""); ?>>October</option> 
                        <option value="11" <?php echo ($mo == "11" ? "selected=\"selected\"" : ""); ?>>November</option> 
                        <option value="12" <?php echo ($mo == "12" ? "selected=\"selected\"" : ""); ?>>December</option> 
                    </select> 
                    <select name="yr"> 
                        <?for($a=2002;$a<2021;$a++){ 
                            echo "<option value=\"".$a."\"".($yr == $a ? "selected=\"selected\"" : "").">".$a."</option>"; 
                        }?> 
                    </select> 
                    <input type="submit" value="go"> 
                    <input type="hidden" name="dateon"> 
                    <input type="hidden" name="where" value="<?php echo $_GET['where'];?>"> 
                    <input type="hidden" name="fn" value="<?php echo $_GET['fn'];?>"> 
            </form></td> 
        </tr> 
        <tr> 
            <td colspan="7" align="center" class="prow" height="10"> 
                <span class="headRow"><?php echo date("F",strtotime($datetime))." ".date("Y",strtotime($datetime));?></span> 
            </td> 
        </tr> 
        <tr> 
            <td width="14%" align="center" class="prow" height="10"><span class="row">Su</span></td> 
            <td width="14%" align="center" class="prow" height="10"><span class="row">Mo</span></td> 
            <td width="14%" align="center" class="prow" height="10"><span class="row">Tu</span></td> 
            <td width="14%" align="center" class="prow" height="10"><span class="row">We</span></td> 
            <td width="14%" align="center" class="prow" height="10"><span class="row">Th</span></td> 
            <td width="14%" align="center" class="prow" height="10"><span class="row">Fr</span></td> 
            <td width="14%" align="center" class="prow" height="10"><span class="row">Sa</span></td> 
        </tr> 
        <tr> 
        <? 
        // get the first day of the month...burrito 
        $firstofmonth = date("m/1/Y", strtotime($datetime)); 
        // get first day of the month by day of week in string format...burrito 
        $dow = date("D", strtotime($firstofmonth)); 
        // make a number representation of the first day of the month by day of week...burrito 
        switch($dow){ 
        case "Sun": 
        $dowi = 1; 
        break; 
        case "Mon": 
        $dowi = 2; 
        break; 
        case "Tue": 
        $dowi = 3; 
        break; 
        case "Wed": 
        $dowi = 4; 
        break; 
        case "Thu": 
        $dowi = 5; 
        break; 
        case "Fri": 
        $dowi = 6; 
        break; 
        case "Sat": 
        $dowi = 7; 
        break; 
        } 
        $dw = $dowi - 1; 
        // pad the calendar for empty days at the beginning of the month...burrito 
        // get last few days of previous month...burrito 
        $lastdays = date("t", strtotime($mo."/01/".$yr." -1 month")); 
        $lastdays = $lastdays - $dw +1; 
        $lastmo = ($mo !== "1" ? $mo - 1 : 12); 
        $lastyr = ($mo !== "1" ? $yr : $yr - 1); 
        for($i=1;$i<$dowi;$i++){ 
            echo "<td width=\"14%\" class=\"nodays\" align=\"center\" style=\"cursor:hand\" onClick=\"updateParent('".$lastdays."','".$lastmo."','".$lastyr."')\">".$lastdays."</td>"; 
            $lastdays++; 
        } 
        
        // loop the days and add day of month...burrito 
        $rn = 1; 
        for($j=1;$j<$dim+1;$j++){ 
            if($j == $da){ 
                    $cl = "tday"; 
                }else{ 
                    $cl = "days"; 
                } 
        
        
            echo "<td id=\"i".$j."\" width=\"14%\" class=\"".$cl."\" style=\"cursor:hand\" onMouseOver=\"this.style.backgroundColor='#FFFFFF'\" onMouseOut=\"this.style.backgroundColor=''\" align=\"center\" onClick=\"updateParent('".$j."')\"><b>".$j."</b></td>"; 
            $dw++; 
                // find out if need to start a new row for next week...burrito 
            if($dw == "7"){ 
                    $rn++; 
                    echo "</tr>"; 
                    $dw = 0; 
                } 
        
        } 
        
        
        
        // pad the calendar for days after the last day of the month...burrito 
        $topad = 7 - $dw; 
        $enddays = 1; 
        if($topad < 7){ 
            $nextmo = ($mo !== "12" ? $mo + 1 : 1); 
            $nextyr = ($mo !== "12" ? $yr : $yr + 1); 
            for($k=1;$k<$topad+1;$k++){ 
                    echo "<td width=\"14%\" class=\"nodays\" align=\"center\" style=\"cursor:hand\" onClick=\"updateParent('".$enddays."','".$nextmo."','".$nextyr."')\">".$enddays."</td>"; 
                    $enddays++; 
                } 
        } 
        echo "</tr></table>"; 
        ?> 
    </body> 
</html> 
