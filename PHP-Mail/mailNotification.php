<?php
require_once dirname(__FILE__) .'/../PHP-Mail/class.phpmailer.php';
require_once dirname(__FILE__) .'/../PHP-GlobalIncludes/auth.php';
require_once dirname(__FILE__) .'/../PHP-DAOs/NotificationDAO.php';
require_once dirname(__FILE__) .'/../PHP-models/NotificationModel.php';

class mailNotification {

    function mailNotification ($replyMail,$replyName,$mailHost,$fromMail,$fromName,$smtpAuth,$smtpUsername,$smtpPassword,$toMail,$toName,$ccMail,$ccName,$subject,$body,$altBody,$isHTML,$port) {
        //        echo $replyMail."|".$replyName."|".$mailHost."|".$fromMail."|".$fromName."|".$smtpAuth."|".$smtpUsername."|".$smtpPassword."|".$toMail."|".$toName."|".$subject."|".$body."|".$altBody."<BR>";
        //exit();
        global $errflag, $errmsg_arr;
        global $notifyUserId, $notifyCareerId, $notifyEmailId;
        $notifyUserId = $_SESSION['SESS_MEMBER_ID'];
        $notificationModel = new NotificationModel;
        $notificationDAO = new NotificationDAO();
        $table = "notification";
        $mail = new PHPMailer();

        $mail->IsSMTP();                                      // set mailer to use SMTP
        $mail->Host = $mailHost;  // specify main and backup server

        $mail->SMTPAuth = $smtpAuth;     // turn on SMTP authentication
        $tpauth = "";
        if ( $smtpAuth ) {
            $mail->Username = $smtpUsername;  // SMTP username
            $mail->Password = $smtpPassword; // SMTP password
            $tpauth="set";
        }

        $mail->From = $fromMail;
        $mail->FromName = $fromName;
        if ( strpos($toMail,";") ) {
            $tmpMailAry = explode(";",$toMail);
            $tmpNameAry = explode(";",$toName);
            for ( $i = 0; $i < count($tmpMailAry); $i++ ) {
                $mail->AddAddress($tmpMailAry[$i], $tmpNameAry[$i]);
            }
        } else {
            if ( $toMail != "")
                $mail->AddAddress($toMail, $toName);
        }
        if ( strpos($replyMail,";") ) {
            $tmpMailAry = explode(";",$replyMail);
            $tmpNameAry = explode(";",$replyName);
            for ( $i = 0; $i < count($tmpMailAry); $i++ ) {
                $mail->AddReplyTo($replyMail, $replyName);
            }
        } else {
            if ( $replyMail != "")
                $mail->AddReplyTo($replyMail, $replyName);
        }

        $mail->Port = $port;
        if ( strpos($ccMail,";") ) {
            $tmpMailAry = explode(";",$ccMail);
            $tmpNameAry = explode(";",$ccName);
            for ( $i = 0; $i < count($tmpMailAry); $i++ ) {
                $mail->AddCC($replyMail, $replyName);
            }
        } else {
            if ( $ccMail != "")
                $mail->AddCC($ccMail, $ccName);
        }

        $mail->WordWrap = "50";                                 // set word wrap to 50 characters
        $mail->IsHTML($isHTML);                                  // set email format to HTML

        $mail->Subject = $subject;
        $mail->MsgHTML($body);
        //            $mail->Body    = $body;
        $mail->AltBody = $altBody;
        //            $mail->AddAttachment("../PHP-GlobalIncludes/globalVars.php");
        $stat = $mail->Send();
        if (! $stat ) {
            //Start session
            session_start();
            $errmsg_arr[] = $mail->ErrorInfo;
            echo $mail->ErrorInfo."<BR>";
            exit();
            $errflag = true;
            $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
            $_SESSION['ERRFLAG'] = "set";
            session_write_close();
        }
        $notificationModel->applicantId = $notifyUserId;
        $notificationModel->careerId = $notifyCareerId;
        $notificationModel->emailId = $notifyEmailId;
        $notificationModel->status = ( $stat ? "Message Sent" : "Message Failed");
        $notificationModel->toMail = $toMail;
        $notificationModel->replyMail = $replyMail;
        $notificationModel->ccMail = $ccMail;
        $notificationModel->message = $subject;
        $stt = $notificationDAO->saveUpdate($notificationModel, 'notification');
        return $stat;
    }
}
?>
