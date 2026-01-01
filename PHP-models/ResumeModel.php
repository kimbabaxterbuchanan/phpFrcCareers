<?php
require_once dirname(__FILE__) .'/../PHP-models/BaseModel.php';


class ResumeModel  extends BaseModel
{
    var $applicantId = "";
    var $file_name = "";
    var $description = "";
    var $orig_file_name = "";
    var $file_size = "";
    var $attachment_type = "";
}
?>
