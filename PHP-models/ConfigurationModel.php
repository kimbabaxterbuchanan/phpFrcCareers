<?php
require_once dirname(__FILE__) .'/../PHP-models/BaseModel.php';


class ConfigurationModel  extends BaseModel
{
    var $conf_table = "";
    var $conf_type = "";
    var $conf_key = "";
    var $adminhtmltag = "";
    var $adminhtmltype = "";
    var $jobhtmltag = "";
    var $jobhtmltype = "";
    var $conf_value = "";
    var $selvaltype = "";
    var $conf_required = "";
    var $jscript = "";
    var $phpCode = "";
}
?>
