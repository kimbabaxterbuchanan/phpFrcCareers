<?php
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
?>
<html>
    <head>
        <link href="../PHP-css/frc-career.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <?php switch ($section){
                case "config":
                switch ($menuaction){
                case "list":
                    $url = "/../PHP-Admins/Forms/ListForm.php";
                    require_once dirname(__FILE__) . $url;
                    break; // Empty Frame
                 case "action":
                    $url = "/../PHP-Admins/Forms/ActionForm.php";
                    require_once dirname(__FILE__) . $url;
                    break; // Empty Frame
                 case "report":
                    $url = "/../PHP-Admins/reportMaker/reportForm.php";
                    require_once dirname(__FILE__) . $url;
                    break; // Empty Frame
                 case "application":
        				$url = "/../PHP-Admins/Forms/ApplicationForm.php";
                    require_once dirname(__FILE__) . $url;
                    break; // Empty Frame
        		 case "applicationlist":
        			$menuaction="list";
        			$formAction="list";
        			$url = "/../PHP-Admins/Forms/ApplicationForm.php";
        			require_once dirname(__FILE__) . $url;
        			break; // Empty Frame
        Default:?>
                <table width="726" border="0" align="center" cellpadding="0" cellspacing="0">
                    <?php if ( $admin >= $adminHR ){ ?>
                    <tr>
                        <th colspan="2">
                            <?php $hdrLabel = getLabel("careerInformation",$locale); ?>
                            <?php echo $hdrLabel?>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listCareers",$locale); ?>

                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=careerList&menuaction=list&table=career"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            <?php $hdrLabel = getLabel("listRequirements",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=requirementList&menuaction=list&table=requirement"><?php echo $hdrLabel?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listApplications",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=applicationList&menuaction=applicationlist&table=application"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <th colspan="2">
                            <?php $hdrLabel = getLabel("applicantInformation",$locale); ?>
                            <?php echo $hdrLabel?>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listApplicants",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=applicantList&menuaction=list&table=applicant"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            <?php $hdrLabel = getLabel("listApplicantProfiles",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=profileList&menuaction=list&table=profile"><?php echo $hdrLabel?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listApplicantCertifications",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=certificationList&menuaction=list&table=certification"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            <?php $hdrLabel = getLabel("listApplicantEEOs",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=eeoList&menuaction=list&table=eeo"><?php echo $hdrLabel?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listApplicantResumes",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=resumeList&menuaction=list&table=resume"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <th colspan="2">
                            <?php $hdrLabel = getLabel("configurationInformation",$locale); ?>
                            <?php echo $hdrLabel?>
                        </th>
                    </tr>
                    <?php } ?>
                    <?php if ( $admin >= $adminWeb ){ ?>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listFormForwards",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=forwarderList&menuaction=list&table=forwarder"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            <?php $hdrLabel = getLabel("listTableLinks",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=tableLinkList&menuaction=list&table=tableLink"><?php echo $hdrLabel?></a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listConfigurations",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=configurationList&menuaction=list&table=configuration"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            <?php $hdrLabel = getLabel("listLanguages",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=languageList&menuaction=list&table=language"><?php echo $hdrLabel?></a>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if ( $admin >= $adminHR ){ ?>
                     <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listValues",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=sellistsqlList&menuaction=list&table=sellistsql"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            &nbsp;
                            <!--a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=stateList">List States</a>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=countryList">List Countries</a-->
                        </td>
                    </tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr>
                        <th colspan="2">
                            <?php $hdrLabel = getLabel("reportsInformation",$locale); ?>
                            <?php echo $hdrLabel?>
                        </th>
                    </tr>
                    <?php } ?>
                    <?php if ( $admin > 0 ){ ?>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listReports",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=reportList&menuaction=list&table=report"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                            &nbsp;
                        </td>
                    </tr>
                    <?php } ?>
                    <?php if ( $admin > 0 ){ ?>
                    <tr>
                        <td>
                            <?php $hdrLabel = getLabel("listEmails",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=emailList&menuaction=list&table=email"><?php echo $hdrLabel?></a>
                        </td>
                        <td>
                        <?php if ( $admin == $adminWeb ){ ?>
                            <?php $hdrLabel = getLabel("listNotifications",$locale); ?>
                            <a href="<?php echo  $homeDir ?>FRCCareer.php?section=config&sub_section=notificationList&menuaction=list&table=notification"><?php echo $hdrLabel?></a>
                        <?php } else { ?>
                            &nbsp;
                        <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </table>
                <?php } ?>
                <?php break; // Empty Frame
                default:
                    $param = "";
                    $sep = "?";
                    foreach($_REQUEST as $key => $val ) {
//                        if ( $key == "section") break;
                        $param .= $sep.$key."=".$val;
                        $sep = "&";
                    }
                    $url = "/FRCCareer".ucfirst($section).".php";
                    require_once dirname(__FILE__) . $url;
                  ?>

                <?php } ?>
   </body>
</html>