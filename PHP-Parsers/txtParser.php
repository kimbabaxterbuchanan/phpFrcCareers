<?php 
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
class txtParser
{
    function txtParser () {
        
        }

    function loadFile ($filename,$table) {
            $daofile = dirname(__FILE__) . '/../PHP-DAOs/'.ucfirst($table).'DAO.php';
            $modelfile = dirname(__FILE__) . '/../PHP-models/'.ucfirst($table).'Model.php';
            $modelVar = ucfirst($table)."Model";
            $daoVar = ucfirst($table)."DAO";
            require_once $daofile;
            require_once $modelfile;
        
            $dao = new $daoVar;
            $model = new $modelVar;
        
            $qry = "delete from ".$table;
            $stat = $dao->executeQry($qry);
            $fp = fopen($filename, "r") or die("Couldn't open $filename"); 
                
                // parsing stuff 
            $count = 0; 
            $keyAry = array();
            while (!feof($fp)){ 
                    $string = fgets($fp);
                    if ( count($keyAry) == 0 ){ 
                            $keyAry = split("\|",$string);
                        } else {
                            $valAry = split("\|",$string);
                            for ( $idx = 0; $idx < count($keyAry); $idx += 1 ) {
                                    $key = $keyAry[$idx];
                                    foreach ($model as $mkey => $mval ) {
                                            if ( trim($key) == $mkey ) {
                                                    $val = trim($valAry[$idx]);
                                                    if ( $val == "na") 
                                                         $val = ""; 
                                                 if ( $mkey == "sellist") {
                                                        $model->$mkey = $model->code."_".$model->name;
                                                    } else {
                                                        $model->$mkey = $val;
                                                    }
                                                }
                                        }
                                }
                            $result = $dao->saveUpdate($model,$table);
                        }
                
                }
            fclose($fp);
        }
}
?>