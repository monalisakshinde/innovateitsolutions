<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	try {   
		//Server settings
		$mail->SMTPDebug  = 2;										//SMTP::DEBUG_SERVER;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     	//Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'kks.0403043@gmail.com';                //SMTP username
		$mail->Password   = 'kfbswxlgexaxesdu';                     //SMTP password
		$mail->SMTPSecure = 'TLS';									//PHPMailer::ENCRYPTION_SMTPS;			//Enable implicit TLS encryption
		$mail->Port       = 587;									//465;                               

		// Email headers
		$mail->setFrom($_POST['Email'], 'Website Contact');
		$mail->addAddress('kks.0403043@gmail.com'); // Receiver
		$mail->addReplyTo($_POST['Email'], $_POST['Name']);

		// Email content
		$mail->isHTML(true);
		$mail->Subject = 'New Contact Form Message';
		$mail->Body    = "
			<b>Name:</b> {$_POST['Name']}<br>
			<b>Email:</b> {$_POST['Email']}<br><br>
			<b>Message:</b><br>
			{$_POST['Message']}
		";

		$mail->send();
		echo 'Email sent successfully!';
	} catch (Exception $e) {
		echo "Mailer Error: {$mail->ErrorInfo}";
	}
}
?>
