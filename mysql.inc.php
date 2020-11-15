<?php
  // mysql.inc.php - This file will be used to establish the database connection.
  class myConnectDB extends mysqli{
    public function __construct($hostname="localhost",
        $user="root",
        $password="",
        $dbname="kohwa"){
      parent::__construct($hostname, $user, $password, $dbname);
    }
  }
?>
