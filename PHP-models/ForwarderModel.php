<?php
require_once dirname(__FILE__) .'/../PHP-models/BaseModel.php';


class ForwarderModel  extends BaseModel
{
    var $level = "";
    var $type = "";
    var $cur_page = "";
    var $page = "";
    var $action = "";
    var $forward_section = "";
    var $forward_sub_section = "";
    var $forward_params = "";
}
?>
