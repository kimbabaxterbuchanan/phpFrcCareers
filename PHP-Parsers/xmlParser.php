<?php 
//Start session
session_start();
//Include database connection details
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';

class xmlParser
{

    function xmlParser(){}

    function contents($parser, $data){
        global $info;
        $info .= $data; 
        } 

    function startHtmlTag($parser, $data){
        global $info;
        $info .= "<tr><td>"; 
        } 

    function endHtmlTag($parser, $data){
        global $info;
        $info .= "</td></tr>"; 
        } 

    function loadXML ($filename,$table ) {
        
        }
}
?> 