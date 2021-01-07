<?php
session_start();
require_once('mysql.inc.php');
include 'functions.php';

//connect to DB if session match and user is authenticated
//connect to database
  $db = new myConnectDB();          # Connect to MySQL
  //check if connecting to DB draws error
  if (mysqli_connect_errno()) {
      echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
    }

if($user = verify($db, session_id())){
  echo $user;
  echo $_SESSION['user'];
}else{
  echo "User does not exists";
}



?>
