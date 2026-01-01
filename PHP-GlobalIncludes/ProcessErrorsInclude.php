<?php
if ( isset($_SESSION['ERRFLAG']) && $_SESSION['ERRFLAG'] != "" ) {
        $errflag = true;
}
if( $errflag && isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0 ) {
    echo '<ul class="err">';
    foreach($_SESSION['ERRMSG_ARR'] as $msg) {
            echo '<li>',$msg,'</li>';
        }
    echo '</ul>';
    $_SESSION['ERRMSG_ARR'] = "";
    unset($_SESSION['ERRMSG_ARR']);
    unset($_SESSION['ERRFLAG']);
}
if( $jobmsg_waiting && isset($jobmsg_arr) && is_array($jobmsg_arr) && count($jobmsg_arr) > 0 ) {
    echo '<ul class="err">';
    foreach($jobmsg_arr as $msg) {
            echo '<li>',$msg,'</li>';
        }
    echo '</ul>';
    $jobmsg_arr = "";
}
?>