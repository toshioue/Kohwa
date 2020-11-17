<?php
require_once('mysql.inc.php');

//Need to do some authentication first with sessions variable,

//connect to DB if session match and user is authenticated
//connect to database
  $db = new myConnectDB();          # Connect to MySQL
  //check if connecting to DB draws error
  if (mysqli_connect_errno()) {
      echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
    }

if(isset($_POST['content']) && isset($_POST['subj']) && isset($_POST['date'])){


     $arr = json_encode($_POST['content']);
     insertPost($db, $_POST['subj'], $arr, date('Y-m-d'));


   }elseif(isset($_GET['postID'])){

        getPost($db, $_GET['postID']);

}else{

  echo 'no action done';
}

















  //verifies if user can log on
  function logon($db, $username, $password, $sessionid) {
    $query = "SELECT Password FROM Users WHERE Username =?";
    $query3 = "INSERT INTO Sessions (User, SessionID) VALUES (?, ?)";
    $hash = '';


    $stmt = $db->stmt_init();
    $stmt->prepare($query);

    //bind
    $stmt->bind_param('s', $username);
    $sucess = $stmt->execute();

    //check to see if DB insert was successful if not print DB error
    if(!$sucess || $db->affected_rows == 0){
      //echo "ERROR: " . $db->error . " for query"; // error statement
      //echo "username does not exists in DB";
      return False;
    }else{
        //check if returned hash is correct;
        $stmt->bind_result($hash);
    while($stmt->fetch()){
      //echo $hash . "\n";
      //echo password_hash($password, PASSWORD_DEFAULT);
          //check if passwords match
    if(password_verify($password, $hash)){

      $stmt->close();
      $stmt = $db->stmt_init();
      $stmt->prepare($query3);
      $stmt->bind_param('ss', $username, $sessionid);
      $sucess = $stmt->execute();
        if(!$sucess || $db->affected_rows == 0){
        //  echo "ERROR: " . $db->error . " for query*"; // error statement
          return False;
        }
     //echo "It worked, looged in";
     $stmt->close();
     return True;
    }else
    //  echo "password did not match";
      return False;
    }
      }
  }



//function for when user logs on, sessionID stores
function insertSessionID($db, $user, $sessionid){
  $insert = "INSERT INTO Sessions (User, SessionID) VALUES (?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($insert);
  //bind
  $stmt->bind_param('ss', $user, $sessionid);
  $sucess = $stmt->execute();


  //check to see if DB insert was successful if not print DB error
  if(!$sucess || $db->affected_rows == 0){
    echo "<h2>ERROR: " . $db->error . "for query</h2>"; // error statement
  }else{
    //echo "<h2>Signup Success!</h2>"; //print if entry is sucess!
  }
  $stmt->close();
}

//function for when user logs off save their sessionss
function logoff($db, $sessionid){
  $query = "DELETE FROM Sessions where SessionID=?";

  //prepare and bind database $query
  $stmt = $db->stmt_init();
  $stmt->prepare($query);
  $stmt->bind_param('s', $sessionid);
  $sucess = $stmt->execute();

  //check for query error
  if(!$sucess || $db->affected_rows == 0){
      echo "ERROR: " . $db->error . "for query"; // error statement
    //  return ;
    return false;
  }
  $stmt->close(); //close stmt
//  echo "It Worked!"; // just for testing purposes
    return true;
}

//function to insert a post from user
function insertPost($db, $title, $body, $date){
  /////////////////////////////////////////////

  $insert = "INSERT INTO Posts (Title, Content, DateCreated) VALUES (?, ?, ?)";
  $stmt = $db->stmt_init();
  $stmt->prepare($insert);
  //bind
  $stmt->bind_param('sss', $title, $body, $date);
  $sucess = $stmt->execute();


  //check to see if DB insert was successful if not print DB error
  if(!$sucess || $db->affected_rows == 0){
    echo "<h2>ERROR: " . $db->error . "for query</h2>"; // error statement
  }else{
    echo "<h2>Post was uploaded Successfully!</h2>"; //print if entry is sucess!

    $stmt->close();
  }
}

//function to get specific post and comments
function getPost($db, $postID){
  $content = '';
  $date = '';
  $title = '';

    $query = "SELECT Title, Content, DateCreated FROM Posts where PostID = ?";
    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    //bind
    $stmt->bind_param('i', $postID);
    $sucess = $stmt->execute();
    //check to see if DB insert was successful if not print DB error
    if(!$sucess || $db->affected_rows == 0){
      echo "ERROR: " . $db->error . " for query"; // error statement
      //echo "username does not exists in DB";
    //  echo 0;
    }else{
        $stmt->bind_result($title, $content, $date);

        while($stmt->fetch()){
          //$content = json_decode($content);
          $arr[0] = str_replace('[', '', $content);
          $arr[0] = str_replace(']', '', $arr[0]);
          $arr[1] = $date;
          $arr[2] = $title;

          echo json_encode($arr);

        }
        $stmt->close();
  }
}




 ?>
