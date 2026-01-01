<?php
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
            $hdrLocation = $homeDir."PHP-FileIncludes/loginForm.php";
            $table="applicant";
            $paramString = "careerIds=".$careerIds."&edit=".$edit."&formAction=".$formAction;
            doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
exit();
?>