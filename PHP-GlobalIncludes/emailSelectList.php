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

$qry = "select u.email, u.first_name, u.last_name, u.middle_initial from applicant u, profile p where u.id = p.applicantId order by u.last_name, u.first_name";
$applicants = $applicantDAO->executeQry($qry);
//$applicants = convert2array($applicants);
?> 

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 

<html> 
    <head> 
        <title>Select Email from List</title>
        <script>
            function showselection() {
                document.forms[0].selec.value = document.selection.createRange().text;
            }
            function clearParent(){
                opener.document.<?php echo $_GET['fn'].".".$_GET['mail'];?>.value = "";
                opener.document.<?php echo $_GET['fn'].".".$_GET['name'];?>.value = "";
            }
            function updateParent(obj){
                var selIdx = obj.selectedIndex;
                var val = obj.options[selIdx].value;
                var txt = obj.options[selIdx].text;
                var addPost = "";
                if ( opener.document.<?php echo $_GET['fn'].".".$_GET['mail'];?>.value != "" )
                    addPost = "; ";
                opener.document.<?php echo $_GET['fn'].".".$_GET['mail'];?>.value += addPost+val;
                opener.document.<?php echo $_GET['fn'].".".$_GET['name'];?>.value += addPost+txt;
            } 
        </script> 
    </head> 
    
    <body>
        <select name="emailList" id="emailList" size=10 onchange="updateParent(this)">
            <option value=""></option>
            <?php foreach ($applicants as $applicant) {
                echo "<option value='".$applicant->email."'>".$applicant->last_name.", ".$applicant->first_name." ".$applicant->middle_initial."</option>";
                  } ?>
        </select>
        <br>
        <input type=button onclick="showselection();" value='select'/>&nbsp;&nbsp;&nbsp;
        <input type=button onclick="clearParent();" value='Reset'/>&nbsp;&nbsp;&nbsp;
        <input type=button onclick="javascript: window.close();" value='Close'/>
    </body> 
</html> 
