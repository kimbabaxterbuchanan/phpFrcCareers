<?php
require_once dirname(__FILE__) .'/PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/PHP-DAOs/ResumeDAO.php';
require_once dirname(__FILE__) .'/PHP-models/ResumeModel.php';

$resumeModel = new ResumeModel;
$resumeDAO = new ResumeDAO();
$table = "resume";

$sort = " where id = '".$id."'";
$resumeModel =$resumeDAO->getRecord($table,$sort);
$file_path = $directoryHome.$resumeModel->applicantId."_".$resumeModel->file_name;
$fname = $resumeModel->orig_file_name;

$fsize = filesize($file_path); 

$mtype = filetype($file_path);

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: ".$mtype);
header("Content-Disposition: attachment; filename=\"".$fname."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: " . $fsize);

// file size in bytes
// download
// @readfile($file_path);
$file = @fopen($file_path,"rb");
if ($file) {
  while(!feof($file)) {
    print(fread($file, 1024*8));
    flush();
    if (connection_status()!=0) {
      @fclose($file);
//      die();
    }
  }
  @fclose($file);
}

unlink($tmpDownloadFile);

?>

<script>
    history.go(-1);
</script>

