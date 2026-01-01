<?php
session_start();
require_once dirname(__FILE__) .'/../../PHP-GlobalIncludes/auth.php';
$sort = " where locale = 'All'";
$langModel = $langDAO->getRecord("language",$sort);
if ( $langModel == "" ) {
    $langModel = new LanguageModel;
    $langModel->locale = $locale;
}
$localeAry = split(",",$langModel->resource_value);
$hdrLabel = getLabel('language',$locale);
?>

  <table width="1026" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="1026" bgcolor="#C0C0C0"><table width="200" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_01.jpg" width="1027" height="106" /></td>
      </tr>
      <tr>
        <td><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_02.jpg" width="113" height="29" /><img src="<?php echo $homeDir?>PHP-images/_01MarchOvers_03.jpg" alt="Home" name="Image15" width="70" height="29" border="0" id="Image15" /><a href="aboutUs.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image26','','images/_01MarchOvers_04.jpg',1)"><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_04.jpg" alt="Learn More About FRC" name="Image26" width="81" height="29" border="0" id="Image26" /></a><a href="capaba.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image31','','images/_01MarchOvers_05.jpg',1)"><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_05.jpg" alt="FRC's Capabilities" name="Image31" width="76" height="29" border="0" id="Image31" /></a><a href="careersFRC.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image41','','images/_01MarchOvers_06.jpg',1)"><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_06.jpg" alt="Careers With FRC" name="Image41" width="77" height="29" border="0" id="Image41" /></a><a href="contactFRC.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image51','','images/_01MarchOvers_07.jpg',1)"><img src="<?=$homeDir?>PHP-images/_01MarchSlices_07.jpg" alt="Contact FRC" name="Image51" width="99" height="29" border="0" id="Image51" /></a><img src="<?=$homeDir?>PHP-images/_01MarchSlices_08.jpg" width="511" height="29" /></td>
      </tr>
      <tr>
        <td><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_09.jpg" width="1027" height="92" /></td>
      </tr>
      <tr>
        <td><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_10.jpg" width="297" height="30" /><a href="FRCcontractInfo.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image61','','images/_01MarchOvers_11.jpg',1)"><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_11.jpg" alt="Contracts With FRC" name="Image61" width="97" height="30" border="0" id="Image61" /></a><a href="customersFRC.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71','','images/_01MarchOvers_12.jpg',1)"><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_12.jpg" alt="FRC's Valued Customers" name="Image71" width="100" height="30" border="0" id="Image71" /></a><a href="employeeFRC.html" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image81','','images/_01MarchOvers_13.jpg',1)"><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_13.jpg" alt="FRC Employee Site" name="Image81" width="91" height="30" border="0" id="Image81" /></a><img src="<?php echo $homeDir?>PHP-images/_01MarchSlices_14.jpg" width="442" height="30" /></td>
      </tr>
    </table>

