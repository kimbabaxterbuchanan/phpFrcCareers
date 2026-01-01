<?php
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
$fileAry = explode("/",$_SERVER["PHP_SELF"]); 
$file = $homeDir.$fileAry[count($fileAry)-1];
?>
<html>
    <head>
        <meta HTTP-EQUIV="REFRESH" content="0; url=FRCCareerBody.php?section=career&sub_section=careerList&table=career">
        <link href="../PHP-css/frc-career.css" rel="stylesheet" type="text/css">
        <script language="javascript" type="text/javascript">
            function submitForm() {
                document.forms['homePage'].submit();
            }
        </script>
    </head>
    <body>
    </body>
</html>