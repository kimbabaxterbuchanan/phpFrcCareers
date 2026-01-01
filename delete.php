<?php
require_once dirname(__FILE__) .'/PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/PHP-DAOs/ResumeDAO.php';
$resumeDAO = new ResumeDAO();
$downloadloadFile = $directoryHome.$f;

$stat = $resumeDAO->delete($id, 'resume');
if ( $stat )
    unlink($downloadloadFile);

?>
<script>
    history.go(-1);
</script>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>
