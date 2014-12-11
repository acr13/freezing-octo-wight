<?php

require_once('../api/db.php');
require_once('../api/emailer.php');

$db = new DB();

// set our params
$params['firstName'] = isset($_REQUEST['firstName']) ? $_REQUEST['firstName'] : -1;
$params['lastName'] = isset($_REQUEST['lastName']) ? $_REQUEST['lastName'] : -1;
$params['phone'] = isset($_REQUEST['phoneNumber']) ? $_REQUEST['phoneNumber'] : -1;
$params['email'] = isset($_REQUEST['emailAddress']) ? $_REQUEST['emailAddress'] : -1;

// fail on any bad input
foreach ($params as $key => $value)
{
	if ($params[$key] == -1)
	{
  	die(json_encode(array("status" => false, "reason" => "invalid params")));
  	exit;
	}
}

$userId = $db->saveRegistration($params);

if ($userId)
{
	// send email
	$mail = new PHPMailer;
	$mail->From = 'no_reply@thewealthpreservationinstitute.com';
	$mail->FromName = 'Mailer';
	$mail->addAddress('roccy@thewpi.org'); 
	$mail->addAddress('shawn.oosterlinck@gmail.com ');

	$mail->isHTML(true);

	$mail->Subject = 'New Lead Sign-Up';
	$mail->Body = $params['firstName'].', '.$params['lastName'].' has completed the I want my worry free retirement kit sign-up.';
	$mail->AltBody = $params['firstName'].', '.$params['lastName'].' has completed the I want my worry free retirement kit sign-up.';

	if($mail->send()) {
  	die(json_encode(array("status" => true, "userid" => $userId)));
	} else {
	  die(json_encode(array("status" => false, "reason" => "error sending confirmation email")));
	}
}
else
{
  die(json_encode(array("status" => false, "reason" => "error saving new registration")));
}

?>