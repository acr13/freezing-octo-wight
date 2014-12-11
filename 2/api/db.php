<?php

class DB
{
  private $db = null;
  private $vtigerDB = null;
  
 	private $host = "host5.eidhosting.com";
 	private $user = "shawn";
 	private $pass = "s3cur1fy";
 	private $database = "wealthpreservationinstitute_com";
  private $vtiger_database = "thewealt_crm";
  private $email_database = "wealthpreservationinstitute";

  function __construct()
  {
    // set up mySQL DB connector
    $this->db = new mysqli($this->host, $this->user, $this->pass, $this->database);
    $this->vtigerDB = new mysqli($this->host, $this->user, $this->pass, $this->vtiger_database);
    $this->emailDB = new mysqli($this->host, $this->user, $this->pass, $this->email_database);
  }

  function saveRegistration($params)
  {    
    $sql = "INSERT INTO Users (FirstName, LastName, Phone, Email, LastUpdated, Status) 
            VALUES ('".$params['firstName']."', '".$params['lastName']."', '".$params['phone']."', '".$params['email']."', UNIX_TIMESTAMP(), 'actv')";
    $result = $this->db->query($sql);
    $params['UserID'] = $this->db->insert_id;
    
    $params['VtigerID'] = $params['UserID'];
    $this->generateLead($params);
    $params['EmailID'] = $this->addToEmailBroadcast($params);
    
    $sql = "UPDATE Users SET ContactID = ".$params['VtigerID'].", EmailBroadcastID = ".$params['EmailID']." WHERE UserID = ".$params['UserID'];
    $result = $this->db->query($sql);
    
    return $params['UserID'];
  }
  
  function generateLead($params)
  {
    $sql = "INSERT INTO thewealt_crm.vtiger_leaddetails (leadid, lead_no, email, firstname, lastname, annualrevenue) VALUES (".$params['UserID'].", 'LEA".$params['UserID']."', '".$params['email']."', '".$params['firstName']."', '".$params['lastName']."', '0.00000000')";
    $result = $this->vtigerDB->query($sql);
    $vtigerID = $this->vtigerDB->insert_id;
  }
  
  function addToEmailBroadcast($params)
  {
    $sql = "INSERT INTO email_subscribers (email_address, email_first_name, email_last_name) VALUES ('".$params['email']."', '".$params['firstName']."', '".$params['lastName']."')";
    $result = $this->emailDB->query($sql);
    $emailId = $this->emailDB->insert_id;

    $sql = "INSERT INTO email_subscriber_groups (email_sub_id, email_group_id, vtiger_user_id) VALUES ($emailId, -9, ".$params['VtigerID'].")";
    $result = $this->emailDB->query($sql);
    
    return $emailId;
  }
}

?>