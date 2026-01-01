<?php
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
//Include database connection details
require_once dirname(__FILE__) .'/../PHP-DAOs/ApplicantDAO.php';
require_once dirname(__FILE__) .'/../PHP-models/ApplicantModel.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../PHP-models/ProfileModel.php';
$applicantDAO = new ApplicantDAO();
$applicantModel = new ApplicantModel;

$profileDAO = new ProfileDAO();
$profileModel = new ProfileModel;

$qry = "select u.email, u.first_name, u.last_name, u.middle_initial from applicant u, profile p where u.id = p.applicantId and p.super_applicant > '0' order by u.last_name, u.first_name";
$applicants = $applicantDAO->executeQry($qry);
//$applicants = convert2array($applicants);
?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 

<html> 
    <head> 
        <title>View Text</title>
    </head> 
    
    <body>
    <div id="viewText"></div>
        <input type=button onclick="javascript: window.close();" value='Close'/>
    </body> 
        <script>
            var obj = document.getElementById("viewText");
            obj.innerHTML = "<?php echo $_GET['changeText']?>";
        </script>
</html> 
