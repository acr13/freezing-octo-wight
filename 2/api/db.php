<?php

class DB
{
  private $db = null;

 	private $host = "host5.eidhosting.com";
 	private $user = "shawn";
 	private $pass = "s3cur1fy";
 	private $database = "wealthpreservationinstitute_com";

  function __construct()
  {
    // set up mySQL DB connector
    $this->db = new mysqli($this->host, $this->user, $this->pass, $this->database);
  }

  function saveRegistration($params)
  {
    $sql = "INSERT INTO Users (FirstName, LastName, Phone, Email, LastUpdated, Status) 
            VALUES ('".$params['firstName']."', '".$params['lastName']."', '".$params['phone']."', '".$params['email']."', UNIX_TIMESTAMP(), 'actv')";
    $result = $this->db->query($sql);

    return $this->db->insert_id;
  }

}

?>