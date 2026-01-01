<?php
//Start session
session_start();

//Include database connection details
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/config.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/ApplicantDAO.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/ProfileDAO.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/primeContactsDAO.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/companyDAO.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/companyProfileDAO.php';

//Create INSERT query
$profileDAO = new ProfileDAO();
$applicantDAO = new ApplicantDAO();
$primeContactsDAO = new primeContactsDAO();
$companyDAO = new companyDAO();
$companyProfileDAO = new companyProfileDAO();

$parentResult = $companyDAO->getCompanyByTeamNameAll();

//Check whether the query was successful or not

if(!$parentResult) {
    require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/SQLErrorInclude.php';
}
?>