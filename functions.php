<?php
session_start();

//verifies if user can log on
function logon($db, $username, $password, $sessionid) {
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
   //set the user to a session var
   $_SESSION['user'] = $username;
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
$query = "SELECT User FROM Sessions WHERE (NOW() < (DATE_ADD(LastVisit, INTERVAL 3 HOUR))) AND SessionID = ?";
$query2 = "UPDATE Users SET LastLogin = NOW() WHERE Username = ?";
$query3 = "UPDATE Sessions SET LastVisit = NOW() WHERE User = ?";
//$temp2 = "UPDATE auth_user set lastlogin = NOW() WHERE user=?";
$user = '';

  $stmt = $db->stmt_init();
  $stmt->prepare($query);


  //bind
  $stmt->bind_param('s', $sessionid);
  $sucess = $stmt->execute();
  if(!$sucess || $db->affected_rows == 0){
    //echo "ERROR: " . $db->error . " for query1"; // error statement
    //return "<h3>username does not exists in DB</h3>";
    return 0;
  }
  //bind the user to $user variable
  $stmt->bind_result($user);
  //$stmt->bind_result($user, $storedsession);
  //fetch data to the last row --not sure if neccessary--
 while($stmt->fetch()) {
 }

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
     //if User does not have a session this is where the error will be thrown **IMPORTANT**
    // echo "ERROR: " . $db->error . " for query*"; // error statement
     return 0;
     //return "user does not exists ";
   }
   $stmt->close();


   //run 3rd query
   //start query to update lastvisit
   $stmt = $db->stmt_init();
   $stmt->prepare($query3);

   //bind
   $stmt->bind_param('s', $user);
   $sucess = $stmt->execute();

   if(!$sucess || $db->affected_rows == 0){
     //if User does not have a session this is where the error will be thrown **IMPORTANT**
    // echo "ERROR: " . $db->error . " for query*"; // error statement
     return 0;
     //return "user does not exists ";
   }

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
  unset($_SESSION['user']);
  header('Location: index.html');
}

//function to insert a post from user
function insertPost($db, $title, $body, $thumb, $date){
/////////////////////////////////////////////

$insert = "INSERT INTO Posts (Title, Content, Thumbnail, DateCreated) VALUES (?, ?, ?, ?)";
$stmt = $db->stmt_init();
$stmt->prepare($insert);
//bind
$stmt->bind_param('ssss', $title, $body, $thumb, $date);
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
function updatePost($db, $title, $body, $thumb, $date, $id){
/////////////////////////////////////////////

$insert = "UPDATE Posts SET Title = ?, Content = ?, Thumbnail = ?, DateCreated = ? WHERE PostID = ?";
$stmt = $db->stmt_init();
$stmt->prepare($insert);
//bind
$stmt->bind_param('ssssi', $title, $body, $thumb, $date, $id);
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
function getAllPosts($db, $getThree, $blog = false){
$content = '';
$date = '';
$title = '';
$id = '';
$thumb = '';
$posts = [];

  $query = "SELECT PostID, Title, Content, DateCreated FROM Posts";
  /*
  PostID INT NOT NULL AUTO_INCREMENT,
  Title VARCHAR(100) NOT NULL,
  Content TEXT NOT NULL,
  Thumbnail VARCHAR(100) NULL,
  DateCreated Date NOT NULL,
  */
  if($getThree){
  $query = "SELECT PostID, Title, Content, Thumbnail, DateCreated  FROM Posts ORDER BY PostID DESC LIMIT ?";
  }
  $stmt = $db->stmt_init();
  $stmt->prepare($query);
  //bind
  if($getThree){
  $stmt->bind_param('i', $getThree);
}
  $sucess = $stmt->execute();
  //check to see if DB insert was successful if not print DB error
  if(!$sucess || $db->affected_rows == 0){
    echo "ERROR: " . $db->error . " for query"; // error statement
    //echo "username does not exists in DB";
  //  echo 0;
  }else{
      if($getThree){
      $stmt->bind_result($id, $title, $content, $thumb, $date);
    }else{
      $stmt->bind_result($id, $title, $content, $date);
    }
      $cards = '';
      while($stmt->fetch()){
        //$content = json_decode($content);
        $content = str_replace('[', '', $content);
        $content = str_replace(']', '', $content);
        $posts[$id] = array('title' => $title, 'content' => $content, 'date' => $date);
        if($getThree){
            if(!$thumb){
              $thumb = 'img/story/s1.jpg"';
            }
          if(!$blog){
          $cards .= '<div class="col-lg-4 col-md-6">
            <div class="single-story">
              <div class="story-thumb">
              <a href="single-blog.php?postID=' . $id . '"> <img style="float: left; min-width: 300px; height: 300px; object-fit: cover;" class="img-fluid border border-dark shadow shadow-md" src="'. $thumb . '" alt=""></a>
              </div>
              <div class="story-details">
                <div class="story-meta">
                  <a href="single-blog.php?postID=' . $id . '">
                    <span class="lnr lnr-calendar-full"></span>' .
                    $date
                  . '</a>
                  <a href="single-blog.php?postID=' . $id . '">
                    <span class="lnr lnr-book"></span>
                    Admin
                  </a>
                </div>
                <h5>
                  <a href="single-blog.php?postID=' . $id . '">' .
                    $title
                . '</a>
                </h5>
              </div>
            </div>
          </div>';
        }else{
          $cards .= '<article class="row blog_item">
               <div class="col-md-3">
                   <div class="blog_info text-right">
                        <div class="post_tag">
                            <!--<a href="#">Food,</a>
                            <a class="active" href="#">Technology,</a>
                            <a href="#">Politics,</a>
                            <a href="#">Lifestyle</a>-->
                        </div>
                        <ul class="blog_meta list">
                            <li><a href="#">Admin<i class="lnr lnr-user"></i></a></li>
                            <li><a href="#">'. $date . '<i class="lnr lnr-calendar-full"></i></a></li>
                            <!--<li><a href="#">1.2M Views<i class="lnr lnr-eye"></i></a></li>
                            <li><a href="#">06 Comments<i class="lnr lnr-bubble"></i></a></li>-->
                        </ul>
                    </div>
               </div>
                <div class="col-md-9">
                    <div class="blog_post">
                      <a href="single-blog.php?postID=' . $id . '"><h2>' . $title . '</h2></a>
                        <img src=" '. $thumb .'" alt=" ' . $title .'">
                        <div class="blog_details">
                            <p>MCSE boot camps have its supporters and its detractors. Some people do not understand why you should have to spend money on boot camp when you can get the MCSE study materials yourself at a fraction.</p>
                            <a href="single-blog.php?postID='. $id . '" class="primary_btn btn-lg btn-block">Read More</a>
                        </div>
                    </div>
                </div>
            </article>';
        }

        }else{
        $cards .= '<div class="card"> <div class="card-body"><h5 class="card-title">' . $id . '. ' . $title . '</h5><p class="card-text">' . $date .'</p><button onclick="loadPost(' . $id . ')" class="btn btn-secondary">View</button></div></div>';
        }
      }
      $send = array($cards, $posts);
      echo json_encode($send);
      $stmt->close();
}
}





 ?>
