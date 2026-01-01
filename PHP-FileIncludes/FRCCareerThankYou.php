<?php
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../PHP-Jobs/RecordActions/ThankYouAction.php';
?>

<html>
    <body>
        <form id="ThankYouForm" name="ThankYouForm" method=post action="FRCCareer.php">
        <input type="hidden" name="table" id="table" value='<?php echo $table ?>'/>
        <input type="hidden" name="section" id="section" value='<?php echo  $section; ?>'/>
        <input type="hidden" name="sub_section" id="sub_section" value="<?php echo  $sub_section ?>"/>
        <input type="hidden" name="postForm" id="postForm" value="yes"/>
        <input type="hidden" name="edit" id="edit" value="<?php echo  $edit ?>"/>
        <input type="hidden" name="careerIds" id="careerIds" value="<?php echo  $careerIds ?>"/>
        <input type="hidden" name="formAction" id="formAction" value="<?php echo  $formAction ?>"/>
        <input type="hidden" name="page" id="page" value="<?php echo  $page ?>"/>
        <input type="hidden" name="prevpage" id="prevpage" value="<?php echo  $prevpage ?>"/>
        <input type="hidden" name="nextpage" id="nextpage" value="<?php echo  $nextpage ?>"/>
        <input type="hidden" name="homeURL" id="homeURL" value="<?php echo  $homeURL ?>" />
        <input type="hidden" name="homeLoc" id="homeLoc" value="<?php echo  $homeLoc ?>" />
        <h2> Thank You for your Application. </h2>
        <br>
        <br>
            <p>
            It will be kept on file and your quanlifications will be compared
            against any positions Future Research Corporation has available.
            If a match is found we will contact you via email address you supplied 
            or by phone, if available.
            
            Again Thank You
            </p>
            
            <input type="submit" name="submit" id="submit" value="Continue"/>
            </form>
    </body>
</html>