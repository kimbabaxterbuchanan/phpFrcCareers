<?php
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/EmailDAO.php';
require_once dirname(__FILE__) .'/../PHP-models/EmailModel.php';
require_once dirname(__FILE__) .'/../PHP-Mail/class.phpmailer.php';

function buildEmail($emailId, $tMail, $tName, $appMsg) {
    global $isHTML,$smtpAuth ,$smtpApplicantname,$smtpPassword,$port,$wordWrap,$defaultMailHost,$toMail;
    global $toName,$fromMail,$fromName,$replyMail,$replyName,$subject,$body,$altBody;
    global $notifyEmailId;

    $notifyEmailId = $emailId;
    $emailModel = new EmailModel;
    $emailDAO = new EmailDAO();
    $sort = " where id = '".$emailId."'";
    $emailModel = $emailDAO->getRecord('email',$sort);
    $stat = false;
    if ( $emailModel ) {
        if ($emailModel->toMail == "" ) {
            $emailModel->toMail = $tMail;
            $emailModel->toName = $tName;
        }

        $emailModel->smtpAuth = false;
        if ( $emailModel->smtpAuth == 'yes')
        $emailModel->smtpAuth = true;

        $emailModel->isHTML = true;
        if ( $emailModel->isHTML == 'no')
        $emailModel->isHTML = false;
        if ( $appMsg != "" ) {
            $emailModel->body .= " ".$appMsg;
            $emailModel->altBody .= " ".$appMsg;
        }
        $stat = new mailNotification ($emailModel->replyMail,$emailModel->replyName,$emailModel->mailHost,
            $emailModel->fromMail,$emailModel->fromName,$emailModel->smtpAuth,
            $emailModel->smtpApplicantname,$emailModel->smtpPassword,$emailModel->toMail,
            $emailModel->toName,$emailModel->ccMail,$emailModel->ccName,
            $emailModel->subject,$emailModel->body,$emailModel->altBody,$emailModel->isHTML,$port);
    }
    return $stat;
}

function getLabel($key,$locale){
    require_once dirname(__FILE__) .'/../PHP-DAOs/LanguageDAO.php';
    require_once dirname(__FILE__) .'/../PHP-models/LanguageModel.php';
    $hdrLabel = ucfirst($key);
    $langModel = new LanguageModel;
    $langDAO = new LanguageDAO();
    $sort = " where locale = '".$locale."' and resource_key = '".$key."'";
    $langModel = $langDAO->getRecord('language',$sort);
    if ( $langModel )
        $hdrLabel = $langModel->resource_value;
    return $hdrLabel;
}

function getMsg($key,$locale){
    require_once dirname(__FILE__) .'/../PHP-DAOs/LanguageDAO.php';
    require_once dirname(__FILE__) .'/../PHP-models/LanguageModel.php';
    $hdrLabel = "";
    $langModel = new LanguageModel;
    $langDAO = new LanguageDAO();
    $sort = " where locale = '".$locale."' and resource_key = '".$key."'";
    $langModel = $langDAO->getRecord('language',$sort);
    if ( $langModel )
        $hdrLabel = $langModel->resource_value;
    return $hdrLabel;
}

function rtnDate($dateModel){
    if ( $dateModel == "" ){
        return date("Y/m/d H:i:s");
    } else {
        foreach ( $dateModel as $key => $val) {
            if ( $val != "" ) {
                switch ($key){
                    case "hour":
                        if ( $dateModel->hopr == "-" ) {
                            $hour = date("h")-$dateModel->hour;
                        } else {
                            $hour = date("h")+$dateModel->hour;
                        }
                        break;

                    case "minute":
                        if ( $dateModel->iopr == "-" ) {
                            $minute = date("i")-$dateModel->iminute;
                        } else {
                            $minute = date("i")+$dateModel->iminute;
                        }
                        break;

                    case "second":
                        if ( $dateModel->sopr == "-" ) {
                            $second = date("s")-$dateModel->second;
                        } else {
                            $second = date("s")+$dateModel->second;
                        }
                        break;

                    case "day":
                        if ( $dateModel->dopr == "-" ) {
                            $day = date("d")-$dateModel->day;
                        } else {
                            $day = date("d")+$dateModel->day;
                        }
                        break;

                    case "month":
                        if ( $dateModel->mopr == "-" ) {
                            $month = date("m")-$dateModel->month;
                        } else {
                            $month = date("m")+$dateModel->month;
                        }
                        break;

                    case "year":
                        if ( $dateModel->yopr == "-" ) {
                            $year = date("y")-$dateModel->year;
                        } else {
                            $year = date("y")+$dateModel->year;
                        }
                        break;
                }
            } else {
                if ( strpos($key,"opr") === false && strpos($key,"create") === false && strpos($key,"date") === false) {
                    $t = substr($key,0,1);
                    $$key = date($t);
                }
            }
        }
        $dateStr = "Y-m-d H:i:s";
        if ( $dateModel->timeOrDate == "time" ) {
            $month = 0;
            $day = 0;
            $year = 0;
            $dateStr = "H:i:s";
        } else if ( $dateModel->timeOrDate == "date" ) {
            $hour = 0;
            $minute = 0;
            $second = 0;
            $dateStr = "Y-m-d";
        }
        $createTimestamp = mktime($hour,$minute,$second,$month,$day,$year);
        $dateModel->create_date = date($dateStr,$createTimestamp);
    }
    return $dateModel;
}

function getDbInfo($sql) {
    require_once  dirname(__FILE__) . '/../PHP-DAOs/DbDAO.php';
    $omitTables = "XxXtablelinkXxXlanguageXxXconfigurationXxXstateXxXcountryXxXemailXxXnotificationXxXforwarderXxXreportXxX";
    $omitFields = "XxXcreate_dateXxXlast_modifiedXxX";
    $daofile = new DbDAO();
    $tables = $daofile->executeBaseQry($sql);
    if ( $tables ) {
        $array = array();
        $cnt = 0;
        while ( $res = mysql_fetch_row($tables) ) {
            if (  strpos($omitTables,"XxX".$res[0]."XxX") === false &&  strpos($omitFields,"XxX".$res[0]."XxX") === false ){
                if ( ! strpos($res[0],'_') === false ) $res[0] = str_replace('_','-',$res[0]);
                $array[$cnt] = $res[0];
                $cnt += 1;
            }
        }
        return $array;
    }
    return $tables;
}

function getDbFunctionsWithId($sql) {
    require_once  dirname(__FILE__) . '/../PHP-DAOs/DbDAO.php';
    $omitTables = "XxXtablelinkXxXlanguageXxXconfigurationXxXstateXxXcountryXxXemailXxXnotificationXxXforwarderXxXreportXxX";
    $omitFields = "XxXcreate_dateXxXlast_modifiedXxX";
    $daofile = new DbDAO();
    $tables = $daofile->executeBaseQry($sql);
    if ( $tables ) {
        $array = array();
        $cnt = 0;
        while ( $res = mysql_fetch_row($tables) ) {
            if (  strpos($omitTables,"XxX".$res[0]."XxX") === false &&  strpos($omitFields,"XxX".$res[0]."XxX") === false ){
                if ( ! strpos($res[0],'_') === false ) $res[0] = str_replace('_','-',$res[0]);
                $array[$cnt] = $res[0]."_".$res[0];
                $cnt += 1;
            }
        }
        return $array;
    }
    return $tables;
}

function getDbFunctions($sql) {
    require_once  dirname(__FILE__) . '/../PHP-DAOs/DbDAO.php';
    $omitTables = "XxXtablelinkXxXlanguageXxXconfigurationXxXstateXxXcountryXxXemailXxXnotificationXxXforwarderXxXreportXxX";
    $omitFields = "XxXidXxXcreate_dateXxXlast_modifiedXxX";
    $daofile = new DbDAO();
    $tables = $daofile->executeBaseQry($sql);
    if ( $tables ) {
        $array = array();
        $cnt = 0;
        while ( $res = mysql_fetch_row($tables) ) {
            if (  strpos($omitTables,"XxX".$res[0]."XxX") === false &&  strpos($omitFields,"XxX".$res[0]."XxX") === false ){
                if ( ! strpos($res[0],'_') === false ) $res[0] = str_replace('_','-',$res[0]);
                $array[$cnt] = $res[0]."_".$res[0];
                $cnt += 1;
            }
        }
        return $array;
    }
    return $tables;
}

function getSqlOptList($sql,$type) {
    global $homeDr;
    $sqlAry = split(",",$sql);
    $tbl = $sqlAry[0];
    $sqltxt = $sqlAry[1];
    $daofile = dirname(__FILE__) . '/../PHP-DAOs/'.ucfirst($tbl).'DAO.php';
    $modelfile = dirname(__FILE__) . '/../PHP-models/'.ucfirst($tbl).'Model.php';
    $modelVar = ucfirst($tbl)."Model";
    $daoVar = ucfirst($tbl)."DAO";
    require_once $daofile;
    require_once $modelfile;

    $dao = new $daoVar;
    $model = new $modelVar;

    $qry = $sqltxt;
    $models = $dao->executeQry($qry);
    $models = convert2array($models);
    $array = array();
    $cnt = 0;
    if ( ! strpos($type,",") === false ) {
        $tmpAry = explode(",",$type);
        foreach ( $models as $model ) {
            $conj = "";
            for ( $i = 0; $i < count($tmpAry); $i++ ) {
                $array[$cnt] .= $conj.$model->$tmpAry[$i];
                $conj = "_";
            }
            $cnt += 1;
        }
    } else {
        foreach ( $models as $model ) {
            $array[$cnt] = $model->$type;
            $cnt += 1;
        }
    }
    return $array;
}

function convert2array($obj) {
    if ( is_object($obj) ) {
        $array = array();
        $array[0] = array2object($obj);
    } else {
        $array = $obj;
    }
    if ( ! $array )
    $array = array();
    return $array;
}

function array2object($array) {

    if (is_array($array)) {
        $obj = new StdClass();

        foreach ($array as $key => $val){
            if ( $key != "" && ! is_numeric($key) )
            $obj->$key = $val;
        }
    }
    else { $obj = $array; }

    return $obj;
}

function shufflearray2object($array,$obj) {

    if (is_array($array)) {
        $objt = new StdClass();

        foreach ($array as $key => $val){
            if ( ! is_array($val) ) {
                foreach ($obj as $ky => $vl){
                    if ( $ky == $key && ! is_numeric($key)) {
                        if ($val != $vl) {
                            $obj->$ky = $val;
                        } else {
                            $obj->$ky = $vl;
                        }
                    }
                }
            }
        }
    } else {
        $obj = $array;
    }

    return $obj;
}

function shufflearray2array($array,$ary) {

    if (is_array($array)) {

        foreach ($array as $key => $val){
            foreach ($ary as $ky => $vl){
                if ( $ky == $key && ! is_numeric($key) ) {
                    $ary[$key] = $val;
                }
            }
        }
    }
    else { $ary = $array; }

    return $ary;
}

function object2array($object) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            $array[$key] = $value;
        }
    }
    else {
        $array = $object;
    }
    return $array;
}

function shuffleobject2array($object,$array) {
    global $val;
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            foreach ($ary as $ky => $vl){
                if ( $ky == $key  && ! is_numeric($key)) {
                    $ary[$key] = $val;
                }
            }
            $array[$key] = $value;
        }
    }
    else {
        $array = $object;
    }
    return $array;
}

function shuffleobject2object($object,$obj) {
    if (is_object($object)) {
        foreach ($object as $key => $value) {
            foreach ($obj as $ky => $vl){
                if ( $ky == $key  && ! is_numeric($key)) {
                    $obj->$key = $value;
                }
            }
        }
    }
    else {
        $obj = $object;
    }
    return $obj;
}

function checkEmailFormat($email) {
    $indx1 = strpos($email,"@");
    $indx2 = strpos($email,".");
    $correct = false;
    if ( $indx1 > 0 && $indx1 < $indx2 )
    $correct = "true";
    return $correct;
}

function generatePassword($length=6, $strength=0) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'BDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 2) {
        $vowels .= "AEUY";
    }
    if ($strength & 4) {
        $consonants .= '23456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }

    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}


function doUrl($hdrLocation, $paramString, $section, $sub_section, $table) {
    global $homeURL, $homeLoc, $homeDir;
    $url = $hdrLocation;
    $paramDelimiter = '?';
    if ( $hdrLocation == "" ) {
        $url = "http://".$homeURL."/".$homeLoc;
    }

    if ( $section != "" ) {
        $str = $paramDelimiter."section=";
        $url .= $paramDelimiter."section=".$section;
        $paramDelimiter = '&';
    }

    if ( $sub_section != "" ) {
        $url .= $paramDelimiter."sub_section=".$sub_section;
    }
    if ( $table != "" ) {
        $url .= $paramDelimiter."table=".$table;
    }
    if ( $paramString != "" ) {
        $url .= $paramDelimiter.$paramString;
        $paramDelimiter = '&';
    }
    if ( $hdrLocation == "" ) {

        echo "<script language=\"Javascript\">
                location.href=\"".$url."\";
                </script>";
    } else {
        header("location: ".$url);
    }
}
function clean($str) {
    $str = @trim($str);
    if(get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return mysql_real_escape_string($str);
}


function html_entity_decode_for_php4_compatibility ($string)  {
    $trans_tbl = get_html_translation_table (HTML_ENTITIES);
    $trans_tbl = array_flip ($trans_tbl);
    $ret = strtr ($string, $trans_tbl);
    return  preg_replace('/\&\#([0-9]+)\;/me',
        "chr('\\1')",$ret);
}
function htmldecode($str){
    if (is_string($str)){
        if (get_magic_quotes_gpc()) return stripslashes(html_entity_decode_for_php4_compatibility($str));
        else return html_entity_decode($str);
    } else return $str;
}

function randomPassword($length) {
    list($usec, $sec) = explode(' ', microtime());
    srand((float) $sec + ((float) $usec * 100000));
    $possible_characters = "23456789abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";
    // note that 0 and O, 1 and l (that's zero and 'oh', one and 'el')
    // have been omitted as they are easily confused
    $passstring = "";
    while(strlen($passstring)<$length) {
        $passstring .= substr($possible_characters, rand(0,strlen($possible_characters)),1);
    }
    return($passstring);
}

function checkPassword($password, $errmsg_arr)
{
    //Makes it easy to implement grammar rules.
    //Array to store validation errors
//    session_start();

    //Validation error flag
    $errflag = false;

    $strlen = strlen($password);

    if($strlen < 5) {
        $errmsg_arr[] = "Password is too short";
        $errflag = true;
    }

    $count_chars = count_chars($password, 3);

    $password = trim($password);
        /* Check if applicantname is not alphanumeric */
    if( !eregi("([a-z])", $password ) || !eregi("([0-9])", $password ) ){
        $errmsg_arr[] = "Password is not alphanumeric";
        $errflag = true;
    }

    $_SESSION['ERRMSG_ARR'] = $errmsg_arr;

    return($errflag);
}

function DateRange ($string, $range)  {
    $jb0=cal_to_jd(CAL_GREGORIAN,date("m"),date("d"),date("Y"));
    $jb1 = $jb0 + $range +1;
    $jb2=cal_from_jd($jb1,CAL_GREGORIAN);
    $jb0 .= " 00:00:00";
    $jb2 .= " 00:00:00";
    $drange="('".$jb0."','".$jb2."')";
    return $drange;
}

function phpDateToMysqlDate ($pdate)  {
    $tmpDt = split("/",$pdate);
    $mdate = $tmpDt[2]."-".$tmpDt[0]."-".$tmpDt[1]." 00:00:00";
    return $mdate;

}
function mysqlDateToPhpDate ($mydate)  {

    $tmpDt = split("-",$mydate);
    if ( strpos($mydate," ") > 0 ){
        $mdate = split(" ",$mydate);
        $tmpDt = split("-",$mdate[0]);
    }
    $pdate = $tmpDt[1]."/".$tmpDt[2]."/".$tmpDt[0];
    return $pdate;
}

function mkDirectory($dest) {
    if(!file_exists($dest)) {
        mkdir($dest,0777);
    }
}

function rmDirectory($dest) {
    removeRessource($dest);
}

function removeRessource( $_target ) {

    //file?
    if( is_file($_target) ) {
        if( is_writable($_target) ) {
            if( @unlink($_target) ) {
                return true;
            }
        }

        return false;
    }

    //dir?
    if( is_dir($_target) ) {
        if( is_writeable($_target) ) {
            foreach( new DirectoryIterator($_target) as $_res ) {
                if( $_res->isDot() ) {
                    unset($_res);
                    continue;
                }

                if( $_res->isFile() ) {
                    removeRessource( $_res->getPathName() );
                } elseif( $_res->isDir() ) {
                    removeRessource( $_res->getRealPath() );
                }

                unset($_res);
            }

            if( @rmdir($_target) ) {
                return true;
            }
        }

        return false;
    }
}

?>