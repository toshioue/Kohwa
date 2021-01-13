<?php
session_start();
//echo password_hash('Kohwa_FSM96941!<!>', PASSWORD_DEFAULT);
require_once('mysql.inc.php');
include 'functions.php';

//connect to DB if session match and user is authenticated
//connect to database
  $db = new myConnectDB();          # Connect to MySQL
  //check if connecting to DB draws error
  if (mysqli_connect_errno()) {
      echo "<h5>ERROR: " . mysqli_connect_errno() . ": " . mysqli_connect_error() . " </h5><br>";
    }



 ?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>Editor</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
      <!--  <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">-->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        <link href="https://getbootstrap.com/docs/4.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <!-- Include stylesheet -->
    </head>
<body>

    <!--================ Start Header Menu Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                            <ul class="nav navbar-nav menu_nav ml-auto">
                                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                                <li class="nav-item submenu dropdown">
                                  <a href="about-us.html" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About</a>
                                  <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="#Who">Who we are</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#Teams">Teams</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#Directors">Board of Directors</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#Advisors">Board of Advisors</a></li>
                                  </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="causes.html">Causes</a>
                                <li class="nav-item "><a class="nav-link" href="blog.html">Press Release</a></li>
                                <!--<li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                        <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                                    </ul>
                                </li>-->
                                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <section class="banner_area border-bottom border-info">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h2>LOGIN</h2>
                      <form method="POST" action="server.php">
                        <div id="logForm" class="form-group-sm  bg-light border border-dark shadow-lg">
                        <label class="text-danger" id="error_msg"></label><br>
                        <label>UserName: &nbsp; </label><input class="form-control-sm" type="text" name="user" id="user" required/></br></br>
                        <label>Password: &nbsp; </label><input  class="form-control-sm" type="password" name="pw" id="pw" required/></br></br>
                        <input class="btn btn-primary" type="submit" name="submitLogin" id="submitLogin"/>
                      </div>

                      </div>
                      </form>

                </div>
            </div>
        </div>
    </section>

      <!--======================WHO WE ARE =======================-->

   </section>


    <!--================ Start footer Area  =================-->
    <footer>
        <div class="footer-area text-light">
            <div class="container">
                <div class="row section_gap">
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title large_title">Our Mission</h4>
                            <p>
                              We work with communites to improve sustainable practices and promote environmental stewardship through
                                alternative livelihoods and community education on health, environment, and cultural heritage in Pohnpei.
                            </p>

                        </div>
                    </div>
                    <div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title">Quick Links</h4>
                            <ul class="list">
                              <li><a href="index.html">Home</a></li>
                              <li><a href="#">About</a></li>
                              <li><a href="causes.html">Causes</a></li>
                              <li><a href="blog.html">Press Release</a></li>
                              <li><a href="contact.php">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="single-footer-widget instafeed">
                            <h4 class="footer_title">Social Media</h6>
                            <ul class="list instafeed d-flex flex-wrap">
                              <li><a href="https://www.instagram.com/kohwa_fsm/"><i  class="fa fa-instagram fa-4x grow" aria-hidden="true"></i></a></li>
                              <li class="display-4">|</li>
                              <li><a href="https://www.facebook.com/pages/category/Environmental-Conservation-Organization/KOHWA-321488131899440/"><i class="fa fa-facebook fa-4x grow" aria-hidden="true"></i></a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
                        <div class="single-footer-widget tp_widgets">
                            <h4 class="footer_title">Contact Us</h4>
                            <div class="ml-40">
                                <p class="sm-head">
                                    <span class="fa fa-location-arrow"></span>
                                    Head Office
                                </p>
                                <p>Pohnpei, Micronesia 96941</p>

                                <p class="sm-head">
                                    <span class="fa fa-phone"></span>
                                    Phone Number
                                </p>
                                <p>
                                    +123 456 7890 <br>
                                    +123 456 7890
                                </p>

                                <p class="sm-head">
                                    <span class="fa fa-envelope"></span>
                                    Email
                                </p>
                                <p>
                                   kohwa-fsm@gmail.com<br>
                                    www.kohwa.fm
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row d-flex">
                    <p class="col-lg-12 footer-text text-center">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | KOHWA | template by <a href="https://colorlib.com" target="_blank">Colorlib</a> | developed by <a href="https://github.com/toshioue" target="_blank">toshioue</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
        </div>
    </footer>
    <!--================ End footer Area  =================-->

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/popper.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/stellar.js"></script>
        <script src="vendors/lightbox/simpleLightbox.min.js"></script>
        <script src="vendors/nice-select/js/jquery.nice-select.min.js"></script>
        <script src="js/jquery.ajaxchimp.min.js"></script>
        <script src="js/mail-script.js"></script>
        <!-- contact js -->
        <script src="js/jquery.form.js"></script>
        <script src="js/jquery.validate.min.js"></script>
        <script src="js/contact.js"></script>
        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="js/gmaps.min.js"></script>
        <script src="js/theme.js"></script>

        <!--custom js-->
        <script src="js/ajax.js"></script>

      <script>
        <?php
        //check if error_message was sent from server display in login
        if(isset($_GET['error_msg'])){
              echo '$("#error_msg").html(' . $_GET['error_msg']  . ');';
        }

        //verify if user is already logged in
        if(verify($db, session_id())){
           $msg = "<p>You are already logged in, click Here to make posts</p>";
           echo 'document.getElementById("logForm").innerHTML = "<p class=' . "text-dark" . '>You are already logged in please click <a href=' . "editor.php" . '>Here</a> to make posts</p>";';
        }

         ?>

       </script>
    </body>
</html>
