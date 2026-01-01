<?php
require_once dirname(__FILE__) .'/../PHP-DAOs/BaseDAO.php';

class EmailDAO extends BaseDAO {

    function EmailDAO() {
        }

    function getEmailById($id) {
            $qry = "select * from email where id = '$id'";
            return @mysql_query($qry);
        }

}

?>