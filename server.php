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



 if(isset($_POST['submitLogin'])){
    $user = htmlspecialchars($_POST['user']);
    $pw = htmlspecialchars($_POST['pw']);
    if(logon($db, $user, $pw, session_id())){
      header('Location: editor.php');
    }else{
      header('Location: login.php?error_msg="Username or Password do not match."');
    }
  }


$loggedIn = verify($db, session_id());


//if content, sunj, and date are set with POST: perform insertion of Posts
if(isset($_POST['content']) && isset($_POST['subj']) && isset($_POST['date']) && !empty($loggedIn)){


     $arr = json_encode($_POST['content']);
     //if if ID of Post was also sent through POST must perform update of existing post
     $subject = htmlspecialchars( $_POST['subj']);
     if(isset($_POST['id'])){
       updatePost($db, $subject, $arr, $_POST['thumbnail'], date('Y-m-d'), $_POST['id']);
     }else{
       //if thumbnail picture was sent through post, go ahead and insert it using the post value;
       if(isset($_POST['thumbnail'])){
          insertPost($db, $subject, $arr, $_POST['thumbnail'], date('Y-m-d'));

        }else{
          //if no ID was sent, insert new post
          insertPost($db, $subject, $arr, NULL, date('Y-m-d'));
        }
      }
    //GET for postID was sent, then return content of post
   }elseif(isset($_GET['postID'])){

        getPost($db, htmlspecialchars($_GET['postID']));
  //if GET action is set, get All Posts p
} else if(isset($_GET['action'])){
  if($_GET['action'] == 1){ //returns all Posts in DB
    //0 signifies all post will be returned
    getAllPosts($db, 0);
  }else if($_GET['action'] == 2){ //returns only 3
    //3 signifies only 3 posts will be returned
    if(isset($_GET['blog']) && $_GET['blog'] == 1){
      getAllPosts($db, 100, true);
    }else{
      getAllPosts($db, 3);
    }
  }else{
    echo 'Action was not recognized';
    $db->close();

  }

} else if(isset($_POST['id']) && isset($_POST['del']) && !empty($loggedIn)){
    if($_POST['del'] == 1){
      deletePost($db, htmlspecialchars($_POST['id']));
    }else{
      echo 'Action was not recognized |';
      $db->close();

    }

}else if(isset($_POST['logOut'])){
      logoff($db, session_id());
      $db->close();

}else{
  $db->close();
  //header('HTTP/1.0 403 Forbidden');
  echo 'Action was not recognized | You are not logged in';
  //var_dump($_POST);
  //echo verify($db, session_id());
}




  //verifies if user can log on
/*  function logon($db, $username, $password, $sessionid) {
  //  echo "hello " . $username . " password: " . $password;
    $query = "SELECT Password FROM Users WHERE Username =?";
    $query3 = "INSERT INTO Sessions (User, SessionID) VALUES (?, ?)";
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
        $hash = '';
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
    // echo "It worked, looged in";
     $stmt->close();
     return True;
  }else{
    // echo "password did not match";
    return False;
   }
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


//verifier function that will determine if user is inactive,
//if user is not inactive, the lastvist collumn in Users table will be updated
function verify($db, $sessionid){
  //$user ='';

  /*$temp = "SELECT s.user, a.session
              FROM  auth_user a join auth_session s ON a.user = s.user
              WHERE (NOW() < (DATE_ADD(s.lastvisit, INTERVAL 1 HOUR)))
              AND (NOW() < (DATE_ADD(a.lastlogin, INTERVAL 1 YEAR)))
              AND s.id=?";*/
  //echo $sessionid;
  /*$query = "SELECT User FROM Sessions WHERE (NOW() < (DATE_ADD(LastVisit, INTERVAL 3 HOUR))) AND SessionID = ?";
  $query2 = "UPDATE Users SET LastLogin = NOW() WHERE Username = ?";
  //$temp2 = "UPDATE auth_user set lastlogin = NOW() WHERE user=?";
  $user = '';

    $stmt = $db->stmt_init();
    $stmt->prepare($query);


    //bind
    $stmt->bind_param('s', $sessionid);
    $sucess = $stmt->execute();
    if(!$sucess || $db->affected_rows == 0){
    //  echo "ERROR: " . $db->error . " for query1"; // error statement
      //echo "<h3>username does not exists in DB</h3>";
      return '';
    }
    //bind the user to $user variable
    $stmt->bind_result($user);
    //$stmt->bind_result($user, $storedsession);
    //fetch data to the last row --not sure if neccessary--
   while($stmt->fetch()) {}

     //restore the session to the logged in user
    //session_decode($storedsession);
      //close the first query
     $stmt->close();

     //start query to update lastvisit
     $stmt = $db->stmt_init();
     $stmt->prepare($query2);


     //bind
     $stmt->bind_param('s', $user);
     $sucess = $stmt->execute();

     if(!$sucess || $db->affected_rows == 0){
       //echo "ERROR: " . $db->error . " for query*"; // error statement
       //return 'this failed to update users visit';
       return '';
     }
     $stmt->close();

     return $user;
  }




//function for when user logs off save their sessionss
function logoff($db){
  $query = "DELETE FROM Sessions";

  //prepare and bind database $query
  $stmt = $db->stmt_init();
  $stmt->prepare($query);
  //$stmt->bind_param('s', $sessionid);
  $sucess = $stmt->execute();

  //check for query error
  if(!$sucess || $db->affected_rows == 0){
      echo "ERROR: " . $db->error . "for query"; // error statement
    //  return ;
    //return false;
    header('Location: editor.php');
  }
  $stmt->close(); //close stmt
//  echo "It Worked!"; // just for testing purposes
    //return true;
    header('Location: index.html');
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

//update post using ID
function updatePost($db, $title, $body, $date, $id){
  /////////////////////////////////////////////

  $insert = "UPDATE Posts SET Title = ?, Content = ?, DateCreated = ? WHERE PostID = ?";
  $stmt = $db->stmt_init();
  $stmt->prepare($insert);
  //bind
  $stmt->bind_param('sssi', $title, $body, $date, $id);
  $sucess = $stmt->execute();


  //check to see if DB insert was successful if not print DB error
  if(!$sucess || $db->affected_rows == 0){
    echo "<h2>ERROR: " . $db->error . "for query</h2>"; // error statement
  }else{
    echo "<h2>Post was updated Successfully!</h2>"; //print if entry is sucess!

    $stmt->close();
  }
}

//delete post using ID
function deletePost($db, $id){
  /////////////////////////////////////////////

  $insert = "DELETE FROM  Posts WHERE PostID = ?";
  $stmt = $db->stmt_init();
  $stmt->prepare($insert);
  //bind
  $stmt->bind_param('i', $id);
  $sucess = $stmt->execute();


  //check to see if DB insert was successful if not print DB error
  if(!$sucess || $db->affected_rows == 0){
    echo "<h2>ERROR: " . $db->error . "for query</h2>"; // error statement
  }else{
    echo "<h2>Post has been Deleted.</h2>"; //print if entry is sucess!

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

//function to get all posts from DB
function getAllPosts($db){
  $content = '';
  $date = '';
  $title = '';
  $id = '';
  $posts = [];

    $query = "SELECT * FROM Posts";
    $stmt = $db->stmt_init();
    $stmt->prepare($query);
    //bind
    //$stmt->bind_param('i', $postID);
    $sucess = $stmt->execute();
    //check to see if DB insert was successful if not print DB error
    if(!$sucess || $db->affected_rows == 0){
      echo "ERROR: " . $db->error . " for query"; // error statement
      //echo "username does not exists in DB";
    //  echo 0;
    }else{
        $stmt->bind_result($id, $title, $content, $date);
        $cards = '';
        while($stmt->fetch()){
          //$content = json_decode($content);
          $content = str_replace('[', '', $content);
          $content = str_replace(']', '', $content);
          $posts[$id] = array('title' => $title, 'content' => $content, 'date' => $date);
          $cards .= '<div class="card"> <div class="card-body"><h5 class="card-title">' . $id . '. ' . $title . '</h5><p class="card-text">' . $date .'</p><button onclick="loadPost(' . $id . ')" class="btn btn-secondary">View</button></div></div>';

        }
        $send = array($cards, $posts);
        echo json_encode($send);
        $stmt->close();
  }
}*/





 ?>
