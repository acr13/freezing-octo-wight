<?php

require_once('../api/db.php');
$db = new DB();

$firstName = isset($_REQUEST['firstName']) ? $_REQUEST['firstName'] : -1;
$lastName = isset($_REQUEST['lastName']) ? $_REQUEST['lastName'] : -1;
$email = isset($_REQUEST['emailAddress']) ? $_REQUEST['emailAddress'] : -1;

if ($firstName == -1 || $lastName == -1 || $email == -1)
{
  die(json_encode(array("status" => false, "reason" => "invalid params")));
}

$status = $db->saveRegistration($firstName, $lastName, $emailAddress);

if ($status)
{
  die(json_encode(array("status" => true, "reason" => "")));
}
else
{
  die(json_encode(array("status" => false, "reason" => "error saving new registration")));
}

?>