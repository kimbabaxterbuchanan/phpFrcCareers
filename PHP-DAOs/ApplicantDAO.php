<?php
require_once dirname(__FILE__) .'/../PHP-DAOs/BaseDAO.php';

class ApplicantDAO extends BaseDAO {

    function ApplicantDAO() {
        }

    function getApplicantByQuery($query) {
            $qry = "select * from applicant ".$query;    
            return @mysql_query($qry);
        }

    function getApplicantById($id) {
            $qry = "select * from applicant where id = $id";
            return @mysql_query($qry);
        }

    function getApplicantByApplicantName($email) {
            $qry = "select * from applicant where email = '$email'";
            return @mysql_query($qry);
        }

    function getApplicantByLoginPassword($email,$password) {
            $qry="SELECT * FROM applicant WHERE email='$email' AND password='".md5($password)."'";
            return @mysql_query($qry);
        }

    function checkSignature($email,$password){
            $valid_login = false;
            $result = $this->getApplicantByLoginPassword($email,$password);
            if($result) {
                    if(mysql_num_rows($result) == 1) {
                            $valid_login = true;
                        }
                }
            return $valid_login;
        }

    function updatePassword ($password, $id){
            $qry = "update applicant set password = '".md5($password)."' where id = ".$id;
            return @mysql_query($qry);
        }

}

?>