<?php
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../RecordActions/ApplicationAction.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <title><?php echo ucfirst($table)?> Form</title>
        <link href="<?php echo dirname(__FILE__) ?>/../PHP-css/loginModule.css" rel="stylesheet" type="text/css" />
        <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/teamFRC.js"></script>
        <script language="JavaScript" type="text/javascript" src="../../PHP-jsScript/Dom_Utils.js"></script>
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	color:windowtext;}
h1
	{margin:0in;
	margin-bottom:.0001pt;
	text-align:center;
	page-break-after:avoid;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";
	color:windowtext;
	font-weight:bold;}
p.MsoHeader, li.MsoHeader, div.MsoHeader
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	color:windowtext;}
p.MsoFooter, li.MsoFooter, div.MsoFooter
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	color:windowtext;}
p.MsoBodyText, li.MsoBodyText, div.MsoBodyText
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Times New Roman","serif";
	color:windowtext;
	font-style:italic;}
p.MsoPlainText, li.MsoPlainText, div.MsoPlainText
	{margin:0in;
	margin-bottom:.0001pt;
	font-size:10.0pt;
	font-family:"Courier New";
	color:windowtext;}
p
	{margin-right:0in;
	margin-left:0in;
	font-size:12.0pt;
	font-family:"Times New Roman","serif";
	color:#5E0000;}
 /* Page Definitions */
 @page Section1
	{size:8.5in 11.0in;
	margin:1.0in 1.25in 1.0in 1.25in;}
div.Section1
	{page:Section1;}
-->
</style>
    </head>
    <body>
        <?php
        require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/ProcessErrorsInclude.php';
        ?>
        <form id="ActionForm" name="ActionForm" method="post" action="FRCCareer.php"  <?php echo $encrypt?> >
            <input type="hidden" name="table" id="table" value="<?php echo  $table ?>"/>
            <input type="hidden" name="section" id="section" value="<?php echo  $section ?>"/>
            <input type="hidden" name="sub_section" id="sub_section" value="<?php echo  $sub_section ?>"/>
            <input type="hidden" name="postForm" id="postForm" value="yes"/>
            <input type="hidden" name="applicantId" id="applicantId" value="<?php echo  $applicantId ?>"/>
            <input type="hidden" name="edit" id="edit" value="<?php echo  $edit ?>"/>
            <input type="hidden" name="formAction" id="formAction" value="<?php echo  $formAction ?>"/>
            <input type="hidden" name="page" id="page" value="<?php echo  $page ?>"/>
            <input type="hidden" name="prevpage" id="prevpage" value="<?php echo  $prevpage ?>"/>
            <input type="hidden" name="nextpage" id="nextpage" value="<?php echo  $nextpage ?>"/>
            <input type="hidden" name="homeURL" id="homeURL" value="<?php echo  $homeURL ?>" />
            <input type="hidden" name="homeLoc" id="homeLoc" value="<?php echo  $homeLoc ?>" />
    <?php if ( $formAction != "" && $formAction != "list" ) { ?>
	<div class=Section1>
	<table>
		<tr>
			<td>
	<p class=MsoHeader><span style='position:relative;z-index:1'><span
	style='position:absolute;left:0px;top:-63px;width:673px;height:87px'><img
	width=673 height=87 src="PHP-images/HRFRCLogo.gif"></span></span><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><b><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

	<p class=MsoHeader><b><u><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'><span
	style='text-decoration:none'>&nbsp;</span></span></u></b></p>

	<p class=MsoHeader><b><u><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'><span
	style='text-decoration:none'>&nbsp;</span></span></u></b></p>

	<p class=MsoHeader><b><u><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'><span
	style='text-decoration:none'>&nbsp;</span></span></u></b></p>

	<br clear=ALL>

	<p class=MsoHeader><b><u><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>PLEASE
	TYPE OR PRINT IN BLUE OR BLACK INK.</span></u></b></p>

	<p class=MsoHeader><b><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Please
	submit resume`</span></b></p>

	<p class=MsoHeader><b><u><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'><span
	style='text-decoration:none'>&nbsp;</span></span></u></b></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>                                                                                    Date
	_________________</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Name
	________________________________________________________________________</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>                        Last                              First                              Middle/Maiden
	</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Address
	______________________________________________________________________</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>City,
	State ________________________________Zip _________________________________</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Home
	Phone ______________Work Phone _____________Social Security No.______________</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Date
	of Birth _____________      Are you a citizen of the United States?  ___Yes  
	___ No</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>If
	not, what origin? ______________________Position Desired
	__________________________</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Full-time
	___Part-time___ Co-op ___ Start Date ________ Salary Requirements_____________</span></p>

	<p class=MsoHeader align=center style='text-align:center'><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader align=center style='text-align:center'><b><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>SECURITY CLEARANCE
	INFORMATION </span></b></p>

	<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 align=left
	style='border-collapse:collapse;border:none;margin-left:6.75pt;margin-right:
	6.75pt'>
	<tr style='page-break-inside:avoid'>
	<td width=590 colspan=2 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Have
	you ever been convicted of an offense other than a minor traffic violation
	(including  Military)?</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='position:absolute;z-index:2;margin-left:-1px;
	margin-top:1px;width:11px;height:11px'><img width=11 height=11
	src="FRC-HR%2001%20%20APPLICATION_files/image002.gif"></span><span
	style='position:absolute;z-index:3;margin-left:57px;margin-top:1px;
	width:12px;height:11px'><img width=12 height=11
	src="FRC-HR%2001%20%20APPLICATION_files/image003.gif"></span><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>    Yes         
	No   (If yes, please explain):</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=590 colspan=2 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='position:absolute;z-index:4;margin-left:261px;
	margin-top:2px;width:11px;height:11px'><img width=11 height=11
	src="FRC-HR%2001%20%20APPLICATION_files/image004.gif"></span><span
	style='position:absolute;z-index:5;margin-left:318px;margin-top:1px;
	width:12px;height:12px'><img width=12 height=12
	src="FRC-HR%2001%20%20APPLICATION_files/image005.gif"></span><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Have you ever held
	a Security Clearance?         Yes          No</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='position:absolute;z-index:13;margin-left:
	401px;margin-top:0px;width:12px;height:12px'><img width=12 height=12
	src="FRC-HR%2001%20%20APPLICATION_files/image006.gif"></span><span
	style='position:absolute;z-index:6;margin-left:456px;margin-top:0px;
	width:11px;height:11px'><img width=11 height=11
	src="FRC-HR%2001%20%20APPLICATION_files/image007.gif"></span><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Has the U.S.
	Government ever denied you a Security Clearance?        Yes          No</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>(If
	yes, please explain):</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=320 valign=top style='width:240.0pt;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Level
	of Clearance:  </span></p>
	<p class=MsoNormal><span style='position:absolute;z-index:15;margin-left:
	106px;margin-top:3px;width:11px;height:11px'><img width=11 height=11
	src="FRC-HR%2001%20%20APPLICATION_files/image008.gif"></span><span
	style='position:absolute;z-index:14;margin-left:219px;margin-top:3px;
	width:12px;height:12px'><img width=12 height=12
	src="FRC-HR%2001%20%20APPLICATION_files/image005.gif"></span><span
	style='position:absolute;z-index:16;margin-left:1px;margin-top:2px;
	width:11px;height:11px'><img width=11 height=11
	src="FRC-HR%2001%20%20APPLICATION_files/image002.gif"></span><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>     Top
	Secret           Confidential           Secret     </span></p>
	</td>
	<td width=270 valign=top style='width:202.8pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Date
	Granted:</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=320 valign=top style='width:240.0pt;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Granting
	Agency:</span></p>
	</td>
	<td width=270 valign=top style='width:202.8pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Have
	you ever been terminated? </span></p>
	<p class=MsoNormal><span style='position:absolute;z-index:17;margin-left:
	5px;margin-top:0px;width:11px;height:11px'><img width=11 height=11
	src="FRC-HR%2001%20%20APPLICATION_files/image007.gif"></span><span
	style='position:absolute;z-index:18;margin-left:53px;margin-top:0px;
	width:11px;height:11px'><img width=11 height=11
	src="FRC-HR%2001%20%20APPLICATION_files/image007.gif"></span><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>     Yes       No</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=590 colspan=2 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Date
	Terminated:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Reason
	for Termination:</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=590 colspan=2 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><i><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>If
	the answer is “yes” to any of the above questions, complete details showing
	dates, places agencies, or courts involved and disposition of the case.  If
	you prefer, the required information may be included on a separate sheet,
	signed and sealed in an envelope, and addressed to the Secrurity Officer as “<b>Confidential
	Material</b>”, not to be circulated with this  application.</span></i></p>
	</td>
	</tr>
	<tr>
	<td>
	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader align=center style='text-align:center'><b><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>PROFESSIONAL
	AFFILIATIONS</span></b></p>
	</td>
	</tr>
	style='border-collapse:collapse;border:none'>
	<tr>
	<td width=590 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Registered
	Engineer                      Registered Number                                   State</span></p>
	<p class=MsoHeader><span style='position:relative;z-index:8'><span
	style='position:absolute;left:56px;top:-2px;width:14px;height:14px'><img
	width=14 height=14 src="FRC-HR%2001%20%20APPLICATION_files/image009.gif"></span></span><span
	style='position:relative;z-index:7'><span style='position:absolute;
	left:-1px;top:-2px;width:14px;height:14px'><img width=14 height=14
	src="FRC-HR%2001%20%20APPLICATION_files/image010.gif"></span></span><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>     Yes         No
	</span></p>
	</td>
	</tr>
	<tr>
	<td>
	<p class=MsoHeader align=center style='text-align:center'><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader align=center style='text-align:center'><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader align=center style='text-align:center'><b><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>EDUCATION</span></b></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=139 valign=top style='width:1.45in;border:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=168 valign=top style='width:1.75in;border:double windowtext 2.25pt;
	border-left:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Name
	of School/College</span></p>
	</td>
	<td width=132 valign=top style='width:99.0pt;border:double windowtext 2.25pt;
	border-left:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal style='margin-left:2.8pt'><span style='font-size:10.0pt;
	font-family:"Arial","sans-serif"'>City and State</span></p>
	</td>
	<td width=72 valign=top style='width:.75in;border:double windowtext 2.25pt;
	border-left:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Degree</span></p>
	</td>
	<td width=79 valign=top style='width:59.4pt;border:double windowtext 2.25pt;
	border-left:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Graduated</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=139 valign=top style='width:1.45in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>College
	(and major)</span></p>
	</td>
	<td width=168 valign=top style='width:1.75in;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=72 valign=top style='width:.75in;border-top:none;border-left:none;
	border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=79 valign=top style='width:59.4pt;border-top:none;border-left:none;
	border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Yes    
	No</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=139 valign=top style='width:1.45in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>High
	School</span></p>
	</td>
	<td width=168 valign=top style='width:1.75in;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=72 valign=top style='width:.75in;border-top:none;border-left:none;
	border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=79 valign=top style='width:59.4pt;border-top:none;border-left:none;
	border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Yes    
	No</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=139 valign=top style='width:1.45in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Other</span></p>
	</td>
	<td width=168 valign=top style='width:1.75in;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=132 valign=top style='width:99.0pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=72 valign=top style='width:.75in;border-top:none;border-left:none;
	border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=79 valign=top style='width:59.4pt;border-top:none;border-left:none;
	border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Yes    
	No</span></p>
	</td>
	</tr>
	<tr>
	<td>

	<p class=MsoHeader><b><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

	<p class=MsoHeader align=center style='text-align:center'><b><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>EMPLOYMENT HISTORY</span></b></p>

	</td>
	</tr>
	
	<tr style='page-break-inside:avoid'>
	<td width=368 colspan=3 valign=top style='width:276.0pt;border:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Present
	or Previous Employer:</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border:double windowtext 2.25pt;
	border-left:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Dates
	of Employment:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>From:                      
	To:</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=368 colspan=3 valign=top style='width:276.0pt;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Location:</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Job
	Title:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=145 valign=top style='width:108.9pt;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Phone
	&amp; Area Code:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=118 valign=top style='width:88.35pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>May
	we contact?</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'> Yes 
	or  No</span></p>
	</td>
	<td width=105 valign=top style='width:78.75pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Leaving
	Salary</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Reason
	for Leaving:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	</tr>
	<tr height=0>
	<td width=145 style='border:none'></td>
	<td width=118 style='border:none'></td>
	<td width=105 style='border:none'></td>
	<td width=222 style='border:none'></td>
	</tr>
	<tr>
	<td>
	<p class=MsoHeader><b><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>

	</td>
	</tr>

	<tr style='page-break-inside:avoid'>
	<td width=368 colspan=3 valign=top style='width:276.0pt;border:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Present
	or Previous Employer:</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border:double windowtext 2.25pt;
	border-left:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Dates
	of Employment:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>From:                      
	To:</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=368 colspan=3 valign=top style='width:276.0pt;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Location:</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Job
	Title:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=145 valign=top style='width:108.9pt;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Phone
	&amp; Area Code:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=118 valign=top style='width:88.35pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>May
	we contact?</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'> Yes 
	or  No</span></p>
	</td>
	<td width=105 valign=top style='width:78.75pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Leaving
	Salary</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Reason
	for Leaving:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	</tr>
	<tr height=0>
	<td width=145 style='border:none'></td>
	<td width=118 style='border:none'></td>
	<td width=105 style='border:none'></td>
	<td width=222 style='border:none'></td>
	</tr>
	</table>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0
	style='border-collapse:collapse;border:none'>
	<tr style='page-break-inside:avoid'>
	<td width=368 colspan=3 valign=top style='width:276.0pt;border:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Present
	or Previous Employer:</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border:double windowtext 2.25pt;
	border-left:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Dates
	of Employment:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>From:                      
	To:</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=368 colspan=3 valign=top style='width:276.0pt;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Location:</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Job
	Title:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=145 valign=top style='width:108.9pt;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Phone
	&amp; Area Code:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	<td width=118 valign=top style='width:88.35pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>May
	we contact?</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'> Yes
	 or  No</span></p>
	</td>
	<td width=105 valign=top style='width:78.75pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Leaving
	Salary</span></p>
	</td>
	<td width=222 valign=top style='width:166.8pt;border-top:none;border-left:
	none;border-bottom:double windowtext 2.25pt;border-right:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Reason
	for Leaving:</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=590 colspan=4 valign=top style='width:6.15in;border:none;
	border-bottom:double windowtext 2.25pt;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal align=center style='text-align:center'><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<h1><span style='font-family:"Arial","sans-serif"'>REFERENCES</span></h1>
	<h1><span style='font-family:"Arial","sans-serif"'>List Names, Company, Title
	and Phone</span></h1>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=590 colspan=4 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>(1)</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid'>
	<td width=590 colspan=4 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>(2)</span></p>
	</td>
	</tr>
	<tr style='page-break-inside:avoid;height:24.75pt'>
	<td width=590 colspan=4 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt;height:24.75pt'>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoNormal><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>(3)</span></p>
	</td>
	</tr>
	<tr height=0>
	<td width=145 style='border:none'></td>
	<td width=118 style='border:none'></td>
	<td width=105 style='border:none'></td>
	<td width=222 style='border:none'></td>
	</tr>
	</table>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader align=center style='text-align:center'><b><span
	style='font-size:10.0pt;font-family:"Arial","sans-serif"'>EMPLOYMENT DETAILS</span></b></p>

	<table class=MsoNormalTable border=1 cellspacing=0 cellpadding=0 align=left
	style='border-collapse:collapse;border:none;margin-left:6.75pt;margin-right:
	6.75pt'>
	<tr style='page-break-inside:avoid'>
	<td width=590 valign=top style='width:6.15in;border:double windowtext 2.25pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>FRC is an
	“at will” employer, meaning either FRC or its employees may terminate
	employment at any time, for any reason, with or without cause, and with or
	without notice.</span></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoBodyText><b><span style='font-family:"Arial","sans-serif"'>Equal
	Employment Opportunity and Affirmative Action</span></b></p>
	<p class=MsoBodyText><b><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>Future
	Research Corporation offers equal employment opportunities to all qualified
	persons without regard to race, color, religious preference, national origin,
	sex, ancestry, disability, veteran status or age.  It is our intent to
	provide equal opportunity not only in employment, but also in compensation,
	promotion, benefits, training and all other employee matters.  It is also the
	policy of FRC to comply voluntarily with the standard practices of
	Affirmative Action.</span></p>
	<p class=MsoBodyText><b><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>
	<p class=MsoBodyText><b><span style='font-family:"Arial","sans-serif"'>Illegal
	Substances</span></b></p>
	<p class=MsoBodyText><b><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>It is
	Future Research Corporation’s policy to maintain an environment free of drugs
	and alcohol abuse.</span></p>
	<p class=MsoBodyText><b><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>
	<p class=MsoBodyText><b><span style='font-family:"Arial","sans-serif"'>Sexual
	Harassment</span></b></p>
	<p class=MsoBodyText><b><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></b></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>Sexual
	Harassment in any form will not be tolerated in the workplace.  Any employee
	who feels that he or she has been subjected to sexual harassment is required
	to report the incident immediately.</span></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>I certify
	that the answers given by me to the questions and statements in this
	application are true and correct without consequential omissions of any kind
	whatsoever.  I agree that the company shall not be liable in any respect if
	my employment is terminated because of the falsity of statements, answers, or
	omissions made by me in this application.  I authorize the companies,
	schools, persons, or organizations named in this application to provide any
	accurate information they have about my background, and I release all
	concerned from any liability in connection therewith.   In the event of
	employment, I understand that I am required to abide by all the rules and
	regulations of Future Research Corporation. </span></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif"'>&nbsp;</span></p>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif";
	font-style:normal'>&nbsp;</span></p>
	<div style='border:none;border-bottom:solid windowtext 1.5pt;padding:0in 0in 1.0pt 0in'>
	<p class=MsoBodyText style='border:none;padding:0in'><span style='font-family:
	"Arial","sans-serif";font-style:normal'>&nbsp;</span></p>
	</div>
	<p class=MsoBodyText><span style='font-family:"Arial","sans-serif";
	font-style:normal'>Signature of
	Applicant                                                                  
	Date</span></p>
	<p class=MsoNormal>&nbsp;</p>
	</td>
	</tr>
	</table>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Please
	address all correspondence concerning employment to <b>Human Resources, Future
	Research Corporation, 675 Discovery Drive, Ste 102, Huntsville, AL  35806</b></span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Person
	to be notified in case of accident or emergency </span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Name_____________________________
	Phone___________________ </span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>Address
	______________________________________________________________________</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoHeader><span style='font-size:10.0pt;font-family:"Arial","sans-serif"'>             
	______________________________________________________________________</span></p>

	<p class=MsoHeader><b><i><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></i></b></p>

	<p class=MsoHeader align=center style='text-align:center'><b><i><span
	style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></i></b></p>

	<p class=MsoHeader align=center style='text-align:center'><b><i><span
	style='font-size:8.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></i></b></p>

	<p class=MsoHeader align=center style='text-align:center'><b><i><span
	style='font-size:14.0pt;font-family:"Arial","sans-serif"'>“Solving Tomorrow’s
	Problems Today”</span></i></b></p>

	<p class=MsoNormal><span style='position:absolute;z-index:9;margin-left:-12px;
	margin-top:15px;width:600px;height:13px'><img width=600 height=13
	src="FRC-HR%2001%20%20APPLICATION_files/image011.gif"></span><b><span
	style='font-family:"Arial","sans-serif"'>Applicant Data Record</span></b></p>

	<p class=MsoNormal><span style='font-size:8.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Applicants
	and employees are considered for all positions regardless of race, color, age,
	sex, religion, national origin, sexual orientation, marital or veteran status,
	or physical or mental disability, or other protected classification as defined
	by applicable law and regulation.</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>The
	information requested below is obtained solely to comply with specific
	government report, record keeping and other legal requirements. Future Research
	Corporation, an Equal Opportunity Employer, is required to monitor and report
	certain statistical data to the federal government. This voluntary information
	is kept in a confidential file separate from other records used for
	interviewing and making hiring decisions.</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Name<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Last, First, Middle Initial</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Home
	Address<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u></span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Address</span></p>

	<p class=MsoNormal><u><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'><span
	style='text-decoration:none'>&nbsp;</span></span></u></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Position
	Applying For<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;_______</u></span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Job Title</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Sex&nbsp;       
	<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Female</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Race/Ethnic
	Group&nbsp;&nbsp;&nbsp;(<i>Please see definitions on next page).</i></span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;
	<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>White&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                            <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Asian</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Black or African American&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                         <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Native Hawaiian or Pacific Islander </span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Hispanic or Latino
	White&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                       &nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>American Indian or Native Alaskan&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>                </span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Hispanic or Latino Other races&nbsp;&nbsp;                  &nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Two or more races&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><i><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></i></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Special
	Notice to Veterans </span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Government
	contractors are subject to the Vietnam Era Readjustment Assistance Act of 1974,
	which requires that they take affirmative action to employ and advance in
	employment qualified disabled veterans and veterans of the Vietnam Era, and
	Section 503 of the Rehabilitation Act of 1973, as amended, which requires that
	government contractors take affirmative action to employ and advance in
	employment qualified disabled individuals. The information provided below is
	voluntary and will be kept confidential except as allowed under federal law.</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>If
	you wish to be identified, please check the appropriate box <i>(Please see
	definitions on next page).</i></span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><u><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</span></u><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>Vietnam</span><span
	style='font-size:9.0pt;font-family:"Arial","sans-serif"'> Era Veteran <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Newly Separated Veteran <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</u>Other Protected Veterans</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></p>

	<p class=MsoNormal><u><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</span></u><span style='font-size:9.0pt;font-family:"Arial","sans-serif"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>Applicant’s
	Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Date</span></p>

	<p class=MsoNormal><b><span style='font-size:10.0pt;font-family:"Arial","sans-serif";
	color:black'>EEOC RACE/ETHNIC IDENTIFICATION CATEGORIES</span></b></p>

	<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0
	style='border-collapse:collapse'>
	<tr>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><b><i><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>American Indian or Alaskan Native</span></i></b></p>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></b></p>
	</td>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	border-left:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>All persons having origins in any of the original peoples of
	North America and South America (including Central America), and who maintain
	tribal affiliation or community attachment.</span></p>
	</td>
	</tr>
	<tr>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><b><i><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>Asian</span></i></b></p>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></b></p>
	</td>
	<td width=319 valign=top style='width:239.4pt;border-top:none;border-left:
	none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>All persons having origins in any of the original people of the
	Far East, Southeast Asia, or the Indian Subcontinent including for example Cambodia, China, India, Japan, Korea, Malaysia, Pakistan, the Philippine Islands, Thailand, and Vietnam  .</span></p>
	</td>
	</tr>
	<tr>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><b><i><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>Native Hawaiian or Other Pacific Islander</span></i></b></p>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></b></p>
	</td>
	<td width=319 valign=top style='width:239.4pt;border-top:none;border-left:
	none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>All persons having origins in any of the original peoples of Hawaii, Guam, Samoa, or other Pacific Islands.</span></p>
	</td>
	</tr>
	<tr>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><b><i><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>Black or African American</span></i></b></p>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></b></p>
	</td>
	<td width=319 valign=top style='width:239.4pt;border-top:none;border-left:
	none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>All persons having origins in any of the Black racial groups of Africa.</span></p>
	</td>
	</tr>
	<tr>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><b><i><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>White</span></i></b></p>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></b></p>
	</td>
	<td width=319 valign=top style='width:239.4pt;border-top:none;border-left:
	none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>All persons having origins in any of the original peoples of
	Europe, North Africa, or the Middle East.</span></p>
	</td>
	</tr>
	<tr>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><b><i><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>Hispanic or Latino (All Races)</span></i></b></p>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></b></p>
	</td>
	<td width=319 valign=top style='width:239.4pt;border-top:none;border-left:
	none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>All persons of Mexican, Puerto Rican, Cuban, Central or South
	American, or other Spanish culture or origin, regardless of race. </span></p>
	</td>
	</tr>
	<tr>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>- Hispanic or Latino (White race only)</span></b></p>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></b></p>
	</td>
	<td width=319 valign=top style='width:239.4pt;border-top:none;border-left:
	none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>A person of Mexican, Puerto Rican, Cuban, Central or South
	American, or other Spanish culture or origin, and of the White race.</span></p>
	</td>
	</tr>
	<tr>
	<td width=319 valign=top style='width:239.4pt;border:solid windowtext 1.0pt;
	border-top:none;padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>- Hispanic or Latino (All other races)</span></b></p>
	<p class=MsoNormal><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></b></p>
	</td>
	<td width=319 valign=top style='width:239.4pt;border-top:none;border-left:
	none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
	padding:0in 5.4pt 0in 5.4pt'>
	<p class=MsoNormal><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
	color:black'>A person of Mexican, Puerto Rican, Cuban, Central or South
	American or other Spanish culture or origin and of any race other than White.</span></p>
	</td>
	</tr>
	</table>

	<p class=MsoNormal><b><i><span style='font-size:10.0pt;font-family:"Arial","sans-serif";
	color:black'>&nbsp;</span></i></b></p>

	<p class=MsoNormal style='margin-left:2.0in;text-indent:-2.0in'><b><i><span
	style='font-size:8.0pt;font-family:"Arial","sans-serif";color:black'>Vietnam
	Era Veteran
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                </span></i></b><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
	color:black'>Defined as a veteran who (a) served on active duty in the Republic
	of Vietnam between February 28, 1961 and May 7, 1975, or (b) served on active
	duty for a period of more than 180 days, any part of which occurred between
	August 5, 1964 and May 7, 1975, and was discharged or released there from with
	other than a dishonorable discharge, or (c) was discharged or released from
	active duty for a service-connected disability if any part of his or her active
	duty was performed between August 5, 1964 and May 7, 1975/</span></p>

	<p class=MsoNormal style='margin-left:2.0in;text-indent:-2.0in'><b><i><span
	style='font-size:8.0pt;font-family:"Arial","sans-serif";color:black'>Newly
	Separated Veterans
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	                </span></i></b><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
	color:black'>Defined as a veteran who served on active duty in the U.S. military, ground, naval or air service during the one-year period beginning on the
	date of such veteran’s discharge or release from active duty. </span></p>

	<p class=MsoNormal style='margin-left:2.0in;text-indent:-2.0in'><b><i><span
	style='font-size:8.0pt;font-family:"Arial","sans-serif";color:black'>Other
	Protected Veteran
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
	</span></i></b><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
	color:black'>Defined as any veteran who served in a “war” declared by Congress,
	in a campaign or on an expedition for which a campaign badge, a service medal,
	or an expeditionary medal has been awarded. </span></p>

	<p class=MsoHeader><b><i><span style='font-size:14.0pt;font-family:"Arial","sans-serif"'>&nbsp;</span></i></b></p>
	</td>
	</tr>
	</table>
</div>
	<?php } else { ?>
	<table>
	<tr>
	<td>
	<h2>Application List</h2>
	</td>
	</tr>
	<tr>
	<td>
	<table border="3">
	<tr>
	<th>
	ID
	</th>
	<th>
	Applicant
	</th>
	<th colspan="3">&nbsp;</th>
	</tr>
					<?php 

					$applicationModels = convert2array($applicationModel);
					
					foreach ( $applicationModels as $applicationModel ){ ?>
	<tr>
	<td><?php echo $applicationModel->id; ?></td>
<td>
	<?php $sort = " where Id = '".$applicationModel->applicantId."'";
	$applicantModel = $applicantDAO->getRecord("applicant",$sort);
	echo $applicantModel->last_name.", ".$applicantModel->first_name." ".$applicantModel->middle_initial
	?>
	</td>
	<td><a href="/careers/FRCCareer.php?section=config&applicantId=<?php echo $applicationModel->applicantId; ?>&sub_section=applicationList&menuaction=application&table=application&edit=view&formAction=view">View</a></td>
	<td><a href="/careers//FRCCareer.php?section=config&applicantId=<?php echo $applicationModel->applicantId; ?>&sub_section=applicationList&menuaction=application&table=application&edit=view&formAction=view">Edit</a></td>
	<td><a href="/careers//FRCCareer.php?section=config&applicantId=<?php echo $applicationModel->applicantId; ?>&sub_section=applicationList&menuaction=application&table=application&edit=view&formAction=view">Delete</a></td>
	</tr>
	<?php } ?>	
</table>
</td>
</table>
		<?php } ?>
	</body>
</html>