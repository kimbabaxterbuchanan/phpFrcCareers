<?php
        //Start session
        require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
        global $isLogedIn, $isAwarded, $awardDir, $webAdmin, $teamManager;
        global $curDir, $companyDir, $workDir;
        $isLogedIn = "no";
        $isAwarded="";
        $awardDir="";
        $webAdmin="";
        $teamManager="";
        $curDir="";
        $companyDir="";
        $workDir="";

        setcookie("fm_root_atual", "",time() - 3600, "/");
        setcookie("expanded_dir_list", "", time() - 3600, "/");
        setcookie("resolveIDs", 0, time() - 3600, "/");

        //Unset the variables stored in session
        session_unset();
        session_destroy();
        $hdrLocation = "";
        $section="career";
        $sub_section = "findJobList";
        $table="career";
        $paramString = "";
        doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
        exit();
?>
