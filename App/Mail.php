<?php

namespace App;

use App\Config;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


/**
 * Mail
 *
 * PHP version 7.0
 */
class Mail
{

    /**
     * Send a message
     *
     * @param string $to Recipient
     * @param string $subject Subject
     * @param string $text Text-only content of the message
     * @param string $html HTML content of the message
     *
     * @return mixed
     */
    public static function send($to, $subject, $text, $html)
    {
        $mail = new PHPMailer(true);

		try {
			//--Server settings
			$mail->CharSet = 'UTF-8';
			//$mail->setLanguage('pl', '/vendor/phpmailer/phpmailer/language');
			$mail->isSMTP();                                            //Send using SMTP
			$mail->Host       = Config::PHP_MAILER_HOST;                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
			$mail->Username   = Config::PHP_MAILER_USERNAME;                     //SMTP username
			$mail->Password   = Config::PHP_MAILER_PASSWORD;                               //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
			$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`					
			//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Info about communciation with server SMTP
		
			//--Recipients				
			$mail->setFrom('no-replay@domain.com', "Aplikacja budżetowa");
			$mail->addAddress($to);               //Name is optional

			//--Content
			$mail->CharSet = "UTF-8";
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $text;
			$mail->AltBody = $html;

			$mail->send();
			//echo 'Message has been sent';
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
    }
}
