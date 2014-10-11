<?php

require_once('../api/db.php');
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

$status = $db->saveRegistration($params);

if ($status)
{
  die(json_encode(array("status" => true, "userid" => $status)));
}
else
{
  die(json_encode(array("status" => false, "reason" => "error saving new registration")));
}

?>