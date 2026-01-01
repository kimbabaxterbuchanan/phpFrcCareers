<?php
require_once dirname(__FILE__) .'/../PHP-models/BaseModel.php';


class ProfileModel  extends BaseModel
{
var $applicantId = "";
var $locale = "BASE";
var $current_salary = "";
var $desired_salary = "";
var $relocate = "yes";
var $clearance_type = "no";
var $status = "1";
var $super_applicant = "0";
var $uscitizen = "yes";
var $nationality = "US";
var $job_notification = "no";
}
?>
