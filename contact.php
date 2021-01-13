<?php
$check = false;
if(isset($_POST['submit'])){
  $to = "yoshimistuyoshi@gmail.com";
  $from = $_POST['email'];
  $name = $_POST['name'];
  $subject = $_POST['subject'];
  //$number = $_POST['number'];
  $cmessage = $_POST['message'];

  $headers = "From: $from";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

  $subject = "Message from " . $name . ".";

  $logo = 'img/logo.png';
  $link = '#';

$body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
$body .= "<table style='width: 100%;'>";
$body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
$body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
$body .= "</td></tr></thead><tbody><tr>";
$body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
$body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
$body .= "</tr>";
$body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject}</td></tr>";
$body .= "<tr><td></td></tr>";
$body .= "<tr><td colspan='2' style='border:none;'>{$cmessage}</td></tr>";
$body .= "</tbody></table>";
$body .= "</body></html>";

if (mail($to, $subject, $body, $headers))
{
    $check = true;
    echo 'The message has been sent.';
}else{
    echo 'failed';
}

}

 ?>


<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="img/favicon.png" type="image/png">
        <title>Contact</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="vendors/linericon/style.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css">
        <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css">
        <!-- main css -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
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
                            <li class="nav-item "><a class="nav-link" href="index.html">Home</a></li>
                            <li class="nav-item submenu dropdown">
                              <a href="about-us.html" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About</a>
                              <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="about-us.html#Who">Who we are</a></li>
                                <li class="nav-item"><a class="nav-link" href="about-us.html#Teams">Teams</a></li>
                                <li class="nav-item"><a class="nav-link" href="about-us.html#Directors">Board of Directors</a></li>
                                <li class="nav-item"><a class="nav-link" href="about-us.html#Advisors">Board of Advisors</a></li>
                              </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="causes.html">Causes</a></li>
                            <li class="nav-item "><a class="nav-link" href="blog.php">Press Release</a></li>
                            <!--<li class="nav-item submenu dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Pages</a>
                              <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="events.html">Events</a>
                                <li class="nav-item"><a class="nav-link" href="event-details.html">Event Details</a>
                                <li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
                              </ul>
                            </li>-->
                          <!--	<li class="nav-item submenu dropdown">
                              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                              <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                                <li class="nav-item"><a class="nav-link" href="single-blog.php">Blog Details</a></li>
                              </ul>
                            </li> -->
                            <li class="nav-item active"><a class="nav-link" href="contact.php">Contact</a></li>
                          </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <!--================ End Header Menu Area =================-->

    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="overlay bg-parallax" data-stellar-ratio="0.9" data-stellar-vertical-offset="0" data-background=""></div>
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Contact Us</h2>
                    <p></p>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->

    <!--================Contact Area =================-->
    <section class="contact_area section_gap">
        <div class="container">
          <!--  <div id="mapBox" class="mapBox"
                data-lat="40.701083"
                data-lon="-74.1522848"
                data-zoom="13"
                data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia."
                data-mlat="40.701083"
                data-mlon="-74.1522848">
            </div>-->
            <div class="row">
                <div class="col-lg-4 border">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="lnr lnr-home"></i>
                            <h6>Kolonia, Pohnpei, 96941</h6>
                            <p>Federated States of Micronesia</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 border">
                <div class="contact_info">
                  <div class="info_item">
                      <i class="lnr lnr-phone-handset"></i>
                      <h6><a href="#">(691) 921-4522</a></h6>
                      <p>Mon to Fri 9am to 6 pm</p>
                  </div>
                  </div>

                </div>

                <div class="col-lg-4 border">
                <div class="contact_info">
                  <div class="info_item">
                      <i class="lnr lnr-envelope"></i>
                      <h6><a href="#">kohwa-fsm@gmail.com</a></h6>
                      <p>Send us your query anytime!</p>
                  </div>
                  </div>

                </div>
        </div>
        <div class="text-center"><h3>Follow Us on Social Media!</h3></hr></div>
        <div class="row text-center">
          <div class="col-lg-6">
            <a id="fa" href="#" class="fa fa_2 fa-facebook"></a>
        </div>
        <div class="col-lg-6">
          <a id="in" href="#" class="fa fa_2 fa-instagram"></a></div>
      </div>
      <div class="text-center mt-3"><h3>Donate to our Cause!</h3></hr>
        <form action="https://www.paypal.com/donate" method="post" target="_top">
        <input type="hidden" name="business" value="2DJMD32DSLEFU" />
        <input type="hidden" name="item_name" value="Koupwelihki Oh Wauneki Atail-sohso" />
        <input type="hidden" name="currency_code" value="USD" />
        <input type="submit" class="primary_btn mr-18" value="Donate Now" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
        <!--<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />-->
        </form>
      </div>

    </section>
    <!--================Contact Area =================-->

	<!--================ Start Subscribe Area =================-->
	<!--<div class="container">
            <div class="subscribe_area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center">
                            <h1 class="text-white">Do you have a question?</h1>
                            <div id="mc_embed_signup">
                                <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative">
                                    <div class="input-group d-flex flex-row">
                                        <input name="EMAIL" placeholder="Your email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address '" required="" type="email">
                                        <button class="ml-10 primary_btn yellow_btn btn sub-btn rounded">SUBSCRIBE</button>
                                    </div>
                                    <div class="info"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>-->
    <!--================ End Subscribe Area =================-->

    <!--================ Start footer Area  =================-->
    <footer>
        <div class="footer-area">
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
                              <li><a href="about-us.html">About</a></li>
                              <li><a href="causes.html">Causes</a></li>
                              <li><a href="blog.php">Press Release</a></li>
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
                                <p>Kolonia, Pohnpei Federated States of Micronesia 96941</p>

                                <p class="sm-head">
                                    <span class="fa fa-phone"></span>
                                    Phone Number
                                </p>
                                <p>
                                     (691) 921-4522
                                </p>

                                <p class="sm-head">
                                    <span class="fa fa-envelope"></span>
                                    Email
                                </p>
                                <p>
                                    kohwa-fsm@gmail.com <br>
                                    www.kohwa-fsm.org
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
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | KOHWA
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
        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="js/gmaps.min.js"></script>
        <script src="js/theme.js"></script>
    </body>

    <script>
  <?php
    if($check){
      echo "$('#success').modal('show');";
    }

    ?>
    </script>
</html>
