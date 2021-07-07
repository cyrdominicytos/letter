<?php

class Mail_sender
{

    private $mail;
    private $from = "me@mail.snpt.km";
    private $hostserver = "mail.snpt.km";
    private $fromname;

    function __construct()
    {
//require_once('class.phpmailer.php');
        require_once 'PHPMailerAutoload.php';

        $this->mail = new PHPMailer();

        if (defined('EMAILFROM')) $this->from = EMAILFROM;

        if (defined('EMAILFROMNAME')) $this->fromname = EMAILFROMNAME;

        if (defined('EMAILSERVER')) $this->hostserver = EMAILSERVER;

        $this->mail->IsHTML(true);
        $this->mail->CharSet = "utf-8";
        $this->mail->SetLanguage("en", 'language/');
    }

    public function sendMail($from, $to, $object, $message)
    {
        $this->mail->From = ($from);
        $this->mail->Subject = $object;
        $this->mail->Body = '<p><b>E-Mail</b> ' . $message . '.</p>';
        //$mail->AddEmbeddedImage('images/logo.png','mon_logo', 'logo.png');
        //$mail->Body .= '....<img src="cid:mon_logo" alt="Logo"/>...';
        //$mail->AddAttachment('./mon_fichier_joint.zip');
        $this->mail->AddAddress($to);
        if ($this->mail->Send()) {
            return true;
        } else {
            //echo $this->mail->ErrorInfo;
            return false;
        }

    }


    public function sendMailUsingFrom($to, $object, $message)
    {
        $this->mail->From = ($this->from);
        $this->mail->Subject = $object;
        $this->mail->Body = '<p><b>E-Mail</b> ' . $message . '.</p>';
        //$mail->AddEmbeddedImage('images/logo.png','mon_logo', 'logo.png');
        //$mail->Body .= '....<img src="cid:mon_logo" alt="Logo"/>...';
        //$mail->AddAttachment('./mon_fichier_joint.zip');
        $this->mail->AddAddress($to);
        if ($this->mail->Send()) {
            return true;
        } else {
            //echo $this->mail->ErrorInfo;
            return false;
        }

    }

    function sendMailSMTP($from, $to, $object, $message)
    {
        $this->mail->IsSMTP();
        $this->mail->Host = $this->hostserver;
        $this->mail->SMTPAuth = true;
        $this->mail->Port = 25;
        $this->mail->Username = "user";
        $this->mail->Password = "password";
        $this->mail->From = ($from);
        $this->mail->Subject = $object;
        $this->mail->Body = '<p><b>E-Mail</b> ' . $message . '.</p>';
        //$this->mail->AddEmbeddedImage('images/logo.png','mon_logo', 'logo.png');
        //$this->mail->Body .= '....<img src="cid:mon_logo" alt="Logo"/>...';
        //$this->mail->AddAttachment('./mon_fichier_joint.zip');
        $this->mail->AddAddress($to);
        if ($this->mail->Send()) {
            return true;
        } else {
            //echo $this->mail->ErrorInfo;
            return false;
        }
    }


    function sendMailSMTPUsingFrom($to, $object, $message)
    {
        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = $this->hostserver;
        $mail->SMTPAuth = true;
        $mail->Port = 25;
        $mail->Username = "user";
        $mail->Password = "password";
        $this->mail->From = ($this->from);
        $this->mail->Subject = $object;
        $this->mail->Body = '<p><b>E-Mail</b> ' . $message . '.</p>';
        //$mail->AddEmbeddedImage('images/logo.png','mon_logo', 'logo.png');
        //$mail->Body .= '....<img src="cid:mon_logo" alt="Logo"/>...';
        //$mail->AddAttachment('./mon_fichier_joint.zip');
        $this->mail->AddAddress($to);
        if ($this->mail->Send()) {
            return true;
        } else {
            // echo $this->mail->ErrorInfo;
            return false;
        }

    }

    function sendSMTPMail2($to, $tonom, $object, $message, $attachement = null)
    {
//date_default_timezone_set('Etc/UTC');
        global $errormsg;
        global $succesmsg;
//require_once 'PHPMailerAutoload.php';

        $this->mail = new PHPMailer;
        $this->mail->isSMTP();
        $this->mail->CharSet = "utf-8";
        $this->mail->SetLanguage("fr", 'language/');
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $this->mail->SMTPDebug = 2;
        $this->mail->Debugoutput = 'html';

        if (defined('SMTPEMAILSERVER'))
            $this->mail->Host = SMTPEMAILSERVER;
//Set the SMTP port number - likely to be 25, 465 or 587
        $this->mail->Port = 25;

        if (defined('SMTPPORT'))
            $this->mail->Port = SMTPPORT;
        $this->mail->SMTPAuth = false;

        /******************AUTH**************/
        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "ssl";
        $this->mail->Host = GMAILSMTPSERVER;//
        $this->hostserver = GMAILSMTPSERVER;
//if(defined('EMAILSERVER')) $this->hostserver=SMTPEMAILSERVER;
        $this->mail->Port = GMAILSMTPPORT;//465//GMAILSMTPPORT2//587
        $this->mail->Username = GMAILSMTPUSERNAME;
        $this->mail->Password = GMAILSMTPPASSWORD;
        $this->mail->CharSet = "UTF-8";
        $this->mail->SMTPSecureSMTPSecure = 'ssl';//465
//$this->mail->SMTPSecure = 'tls';//587 
        $this->mail->AddReplyTo('', 'Information');
        /************************************/

        $this->mail->setFrom(($this->from), $this->fromname);
//Set an alternative reply-to address
//$this->mail->addReplyTo('replyto@example.com', 'First Last');
        $this->mail->addAddress($to, $tonom);
//$this->mail->AddAddress($address, "user2");
        /*
        //Whether to use SMTP authentication
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "yourname@example.com";
        $this->mail->Password = "yourpassword";
        $this->mail->setFrom('from@example.com', 'First Last');
        */

        /**
         * $this->mail->isSMTP();                                      // Set mailer to use SMTP
         * $this->mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
         * $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
         * $this->mail->Username = 'user@example.com';                 // SMTP username
         * $this->mail->Password = 'secret';                           // SMTP password
         * $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
         * $this->mail->Port = 587;
         */

        $this->mail->IsHTML(true);

        $this->mail->Subject = $object;
        $this->mail->Body = '<p><b>E-Mail</b><br/> ' . $message . '</p>';
        $this->mail->AltBody = $message;
        //$mail->MsgHTML('<p><b>E-Mail</b><br/> '.$message.'</p>');
        if ($attachement != null && !empty($attachement)) {
            $this->mail->AddAttachment($attachement);
        }
        //$this->mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//send the message, check for errors
        if (!$this->mail->send()) {
            $errormsg = "Erreur d'envoie du mail : " . $this->mail->ErrorInfo;
            return array("result" => false, "message" => $errormsg);;
        } else {
            $succesmsg = "Mail envoyé!";
            return true;
        }
    }

    function sendSMTPMail22($to, $object, $message)
    {
//date_default_timezone_set('Etc/UTC');
        global $errormsg;
        global $succesmsg;
//require_once 'PHPMailerAutoload.php';

        $this->mail = new PHPMailer;
        $this->mail->isSMTP();
        $this->mail->CharSet = "utf-8";
        $this->mail->SetLanguage("fr", 'language/');
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
        $this->mail->SMTPDebug = 0;
        $this->mail->Debugoutput = 'html';

        if (defined('SMTPEMAILSERVER'))
            $this->mail->Host = SMTPEMAILSERVER;
//Set the SMTP port number - likely to be 25, 465 or 587
        $this->mail->Port = 25;

        if (defined('SMTPPORT'))
            $this->mail->Port = SMTPPORT;

        $this->mail->SMTPAuth = false;
        $this->mail->setFrom(($this->from), $this->fromname);
//Set an alternative reply-to address
//$this->mail->addReplyTo('replyto@example.com', 'First Last');
        $this->mail->addAddress($to);

        /*
        //Whether to use SMTP authentication
        $this->mail->SMTPAuth = true;
        $this->mail->Username = "yourname@example.com";
        $this->mail->Password = "yourpassword";
        $this->mail->setFrom('from@example.com', 'First Last');
        */

        /**
         * $this->mail->isSMTP();                                      // Set mailer to use SMTP
         * $this->mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
         * $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
         * $this->mail->Username = 'user@example.com';                 // SMTP username
         * $this->mail->Password = 'secret';                           // SMTP password
         * $this->mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
         * $this->mail->Port = 587;
         */

        $this->mail->IsHTML(true);

        $this->mail->Subject = $object;
        $this->mail->Body = '<p><b>E-Mail</b><br/> ' . $message . '</p>';
        //$this->mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//send the message, check for errors
        if (!$this->mail->send()) {
            $errormsg = "Erreur d'envoie du mail : " . $this->mail->ErrorInfo;
            return false;
        } else {
            $succesmsg = "Mail envoyé!";
            return true;
        }
    }
}

?>

