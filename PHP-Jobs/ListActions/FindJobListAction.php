<?php
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/CareerDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/CareerModel.php';
require_once dirname(__FILE__) .'/../../PHP-models/DateModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/ApplicationDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/ApplicationModel.php';
require_once dirname(__FILE__) .'/../../PHP-DAOs/StateDAO.php';
require_once dirname(__FILE__) .'/../../PHP-models/StateModel.php';
require_once dirname(__FILE__) .'/../../PHP-Mail/mailNotification.php';

$dateModel = new DateModel;

$applicationModel = new ApplicationModel;
$applicationDAO = new ApplicationDAO();

$stateModel = new StateModel;
$stateDAO = new StateDAO();

$sort = " order by name";
$states = $stateDAO->getRecord('state',$sort);
$states = convert2array($states);

$careerModel = new CareerModel;
$careerDAO = new CareerDAO();

$table = "career";
$sort = " where status = 'yes'";
$careers =$careerDAO->getRecord($table,$sort);
$careers = convert2array($careers);

$sql = "select distinct classification from career order by classification";
$cats = $careerDAO->executeQry($sql);
$cats = convert2array($cats);

$ary = array();
$jobmsg_arr = array();
$jobmsg_waiting = false;
$idx = 0;

if ( isset($postForm) && $postForm != "" ) {

    $jobLst = "";
    $comma = "";
    $jobList = "";
    if ( ! isset($loginAction) || $loginAction == "" ) {
        $careerIds = "";
        foreach($_POST as $key => $val){
            if (strpos($key,"_".$val) ){
                $jobLst .= $val.",";
                $careerIds .= $comma.$val;
                $jobList .= $comma."'".$val."'";
                $comma = ",";
            }
        }
    } else {
        $careerAry = split(",",$careerIds);
        $careerIds = "";
        for ( $d = 0; $d < count($careerAry); $d += 1 ) {
            if ( $careerAry[$d] != "" ) {
                $jobLst .= $careerAry[$d].",";
                $careerIds .= $comma.$careerAry[$d];
                $jobList .= $comma."'".$careerAry[$d]."'";
                $comma = ",";
            }
        }
    }
    if ( ! isset($submitSearch) || $submitSearch == "" ) {
        if ( $jobList == "" ) {
            $errmsg_arr[] = "No Jobs selected.. Please select one...";
            $errflag = true;
        }
        if ( !$errflag ) {
            if ( $loginId == "0" ){
                $hdrLocation=$homeDir."PHP-FileIncludes/loginForm.php";
                $table="applicant";
                $paramString = "careerIds=".$careerIds."&edit=apply&formAction=new";
                doUrl($hdrLocation, $paramString, $section, $sub_section,$table);
            } else {
                $jobAry = array();
                if ( $jobList != "" ) {
                    $sort = " where applicantId = '".$loginId."' and careerId in (".$jobList.")";
                    $applications =$applicationDAO->getRecord("application",$sort);
                    $fndJobAry = "";
                    $comma = "";
                    if ( $applications ) {
                        $jobmsg_arr[$idx] = "Thank you for Re-Applying for ";
                        $applications = convert2array($applications);
                        foreach( $applications as $model ) {
                            if ( $model ) {
                                $obj = new StdClass();
                                foreach ( $model as $key => $val ) {
                                    if ( $key == "careerId") {
                                        $sort = " where id = '".$val."'";
                                        $careerModel =$careerDAO->getRecord("career",$sort);
                                        $jobmsg_arr[$idx] .= $careerModel->req_number.$comma;
                                        $jobmsg_waiting = true;
                                        $fndJobList .= "#".$val."&";
                                        $comma = ",";
                                    }
                                }
                            }
                        }
                        if ( ! $jobmsg_waiting ) {
                            $jobmsg_arr[$idx] = "";
                        } else {
                            $idx = 1;
                        }
                    }
                    $jobAry = split(",",$jobLst);
                }
                $comma = "";
                for ( $i = 0; $i < count($jobAry); $i += 1 ) {
                    $val = $jobAry[$i];
                    if ( $val != "" ) {
                        $sort = " where careerId = '".$val."' and applicantId = '".$loginId."'";
                        $applicationModel = $applicationDAO->getRecord("application",$sort);
                        if ( ! $applicationModel ) {
                            $applicationModel = new ApplicationModel;
                            $applicationModel->applicantId = $loginId;
                            $applicationModel->careerId = $val;
                            if ( !isset($jobmsg_arr[$idx]) || $jobmsg_arr[$idx] == "" )
                            $jobmsg_arr[$idx] = "Thank you for Applying for ";
                        }
                        $rtn = $applicationDAO->saveUpdate($applicationModel,"application");
                        if ( $rtn ) {
                            $notifyApplicantId = $loginId;
                            $notifyCareerId = $val;

                            $stat = false;
                            $sort = " where id = '".$val."'";
                            $careerModel = $careerDAO->getRecord("career",$sort);

                            if ( $careerModel && $careerModel->emailid != "" )
                                $stat = buildEmail($careerModel->emailid, $careerModel->toMail, $careerModel->toName, $careerModel->req_number);
                            if ( ! $stat ) {
                                $replyMail = $replyMail;
                                $replyName = $replyName;
                                $mailHost = $defaultMailHost;
                                $smtpAuth = $smtpAuth;
                                $smtpApplicantname = $smtpApplicantname;
                                $smtpPassword = $smtpPassword;
                                $toMail = $toMail;
                                $toName = $toName;
                                $fromMail = $email;
                                $fromName = $fullName;
                                $ccMail = $ccMail;
                                $ccName = $ccName;
                                $replyMail = $email;
                                $replyName = $fullName;
                                $subject = "Application Submitted Notification";
                                $body = "$fullName has submitted an application for Job ".$careerModel->req_number;
                                $altBody = "$fullName has submitted an application for Job ".$careerModel->req_number;
                                $stat = new mailNotification($replyMail,$replyName,$mailHost,$fromMail,$fromName,$smtpAuth,$smtpApplicantname,$smtpPassword,$toMail,$toName,$ccMail,$ccName,$subject,$body,$altBody,$isHTML,$port);
                            }
                            if ( isset($jobmsg_arr[$idx]) || $jobmsg_arr[$idx] != "" )
                            $jobmsg_arr[$idx] .= $careerModel->req_number.$comma;
                            $comma = ",";
                            $jobmsg_waiting = true;
                        }
                    }

                }
            }
        }
    } else {
        $sort = " where status = 'yes' ";
        $condition = " and ";
        if ( $search != "") {
            $sort .= $condition."( qualifications like '%".$search."%' or duties like '%".$search."%' or title like '%".$search."%' )";
            $condition = " and ";
        }
        if ( $searchdays != "") {
            $dateModel->day = $searchdays;
            $dateModel->dopr = "-";
            $dateModel->timeOrDate = "date";
            $dateModel = rtnDate($dateModel);
            $sort .= $condition." str_to_date(open_date,'%m/%d/%Y') between '".$dateModel->create_date."' and '".date("Y-m-d")."'";
            $condition = " and ";
        }
        if ( $searchclass != "") {
            $sort .= $condition." classification = '".$searchclass."'";
            $condition = " and ";
        }
        if ( $searchstates != "") {
            $sort .= $condition." state = '".$searchstates."'";
            $condition = " and ";
        }
        $careers =$careerDAO->getRecord($table,$sort);
        if ( $careers ) {
            $careers = convert2array($careers);
        }
    }
}
$sort = " where applicantId = '".$loginId."'";
$applications =$applicationDAO->getRecord("application",$sort);
$fndJobAry = "";
$fndJobList = "";
if ( $applications ) {
    $applications = convert2array($applications);
    foreach( $applications as $model ) {
        if ( $model ) {
            $obj = new StdClass();
            foreach ( $model as $key => $val ) {
                if ( $key == "careerId") {
                    $fndJobList .= "#".$val."&";
                }
            }
        }
    }
}
if ( $careers ) {
    $cnt = 0;
    foreach( $careers as $model ) {
        if ( $model ) {
            $obj = new StdClass();
            foreach ( $model as $key => $val ){
                switch ($key){
                    case "id":
                        $obj->$key = $val;
                        break;
                    case "req_number":
                        $obj->$key = $val;
                        break;
                    case "title":
                        $obj->$key = $val;
                        break;
                    case "employment_status":
                        $obj->$key = $val;
                        break;
                    case "open_date":
                        $obj->$key = $val;
                        break;
                }
            }
            $ary[$cnt] = $obj;
            $cnt += 1;
        }
    }
    $careers = $ary;
}
$daysrch = array();
$daysrch[] = "1";
$daysrch[] = "7";
$daysrch[] = "15";
$daysrch[] = "30";

$paysearches = array();
$paysearches[] = "0_25000xXx0 to $25,000";
$paysearches[] = "25001_50000xXx$25,000 to $50,000";
$paysearches[] = "50001_75000xXx$50,000 to $75,000";
$paysearches[] = "75001_999999999xXxmore than $75,000";

$searchInfo = "\$sort = \" where conf_type = 'list' and conf_table = '\".\$table.\"' and conf_key = 'search'\";";
$searchInfo .= "\$confModel = \$confDAO->getRecord(\"configuration\",\$sort);";
$searchInfo .= "\$hdrLabel = getLabel('searchText',\$locale);";

$searchInfo .= "echo \"<tr><td colspan='6' align='left'> \".\$hdrLabel.\": <input type='text' size='40' id='search' name='search' value='\".\$search.\"'/>\";";
$searchInfo .= "echo \" <input type='submit' id='submitSearch' name='submitSearch' value='Search'/>\";";
$searchInfo .= "echo \"</td></tr>\";";

$searchInfo .= "\$hdrLabel = getLabel('searchDaysText',\$locale);";

$searchInfo .= "echo \"<tr><td colspan='6' align='left'> \".\$hdrLabel.\":\";";
$searchInfo .= "echo \"<select name='searchdays' id='searchdays'>\";";
$searchInfo .= "echo \"<option value=''>Any</option>\";";
$searchInfo .= "for ( \$i = 0; \$i < count(\$daysrch); \$i += 1 ) { ";
$searchInfo .= "\$select = \"\"; if ( \$searchdays == \$daysrch[\$i] ) \$select = \"selected\";";
$searchInfo .= "echo \"<option value='\".\$daysrch[\$i].\"' \".\$select.\">\".\$daysrch[\$i].\"</option>\";";
$searchInfo .= " }";
$searchInfo .= "echo \"</select>\";";

$searchInfo .= "\$hdrLabel = getLabel('searchClassText',\$locale);";
$searchInfo .= "echo \" \".\$hdrLabel.\":\";";
$searchInfo .= "echo \"<select name='searchclass' id='searchclass'>\";";
$searchInfo .= "echo \" <option value='' selected >Any</option>\";";
$searchInfo .= "foreach ( \$cats as \$cat ) { ";
$searchInfo .= "\$select = \"\"; if ( \$searchclass == \$cat->classification ) \$select = \"selected\";";
$searchInfo .= "echo \" <option value='\$cat->classification' \".\$select.\">\$cat->classification</option>\";";
$searchInfo .= " }";
$searchInfo .= "echo \"</select>\";";

$searchInfo .= "\$hdrLabel = getLabel('searchStateText',\$locale);";
$searchInfo .= "echo \" \".\$hdrLabel.\":\";";
$searchInfo .= "echo \"<select name='searchstates' id='searchstates'>\";";
$searchInfo .= "echo \" <option value='' \".\$selected.\">Any</option>\";";
$searchInfo .= "foreach ( \$states as \$state ) { ";
$searchInfo .= "\$selected = \"\"; if ( \$searchstates == \$state->code ) \$selected = \"selected\";";
$searchInfo .= "echo \" <option value='\$state->code' \".\$selected.\">\$state->name</option>\";";
$searchInfo .= " }";
$searchInfo .= "echo \"</select>\";";

$searchInfo .= "echo \"</td></tr>\";";
$searchInfo .= "echo \"<tr><td colspan='6' align='left'><hr></td></tr>\";";


if($errflag) {
    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
    session_write_close();
    //            header("location: applicantForm.php?id=".$id);
    //            exit();
}
?>