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



  if (!isset($_SESSION['user']) && !verify($db, session_id())){
    $db->close();
    header('Location: index.html');
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
                            <span class="icon-bar"></spanblog.php
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
                                <li class="nav-item "><a class="nav-link" href="blog.php">Press Release</a></li>
                                <!--<li class="nav-item submenu dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                                        <li class="nav-item"><a class="nav-link" href="single-blog.php">Blog Details</a></li>
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
                    <h2>Editor</h2>
                    <p class="lead">make posts for everyone to see</p>
                </div>
            </div>
        </div>
    </section>

      <!--======================WHO WE ARE =======================-->
    <section style="margin-top:5vh;" >
    <?php echo file_get_contents("modal.html"); ?>
        <!-- Create the editor container -->
<button id="back" class="float-left btn btn-warning" onclick=mainMenu()>Go back </button><br><br>
<div id="main" class="mb-4">
<div id="mainCreate">
<div  class="container">
<h5>Title: <h5S>
<input class="form-control-xlg" type="text" id="subj" name="subj" required minlength="5" maxlength="80" style="width:100%;"><br><br>
<label>Date Today: &nbsp;</label><input type="text" name="date" id="date" required value="<?php echo date('F', strtotime("2000-" .date("m") . "-01")) . " " . date("d, Y");?>" />
<input class="form-control" type="hidden" id="id" name="id">
</br><hr>
<div id="thumbnailPath">
  <label for="files">Select an image that will be used as a thumbnail post</label>
  <input type="file" id="timages" name="timages">  <br>
  <button class="btn btn-dark" id="uploadThumb">Upload</button>
</div>
  <br><br><hr>
<div id="imagePath">
  <label for="files">Select images that will be used in the Post:</label>
  <input type="file" id="images" name="images">  <br>
  <button class="btn btn-dark"  id="uploadImages">Upload</button>
</div>
  <br><br>
<br>
</div>
<!--prime placeholder for editor.js -->
<div id="editorjs" class="border border-dark"></div>
<!--end -->
<textarea name="text" style="display:none" id="textBox" name="textBox"></textarea>
<div class="container">
<button id="submit" class="btn btn-lg btn-block btn-primary mt-3" onclick="onSubmit()">Submit</button>
</div>

</div>
</div>
<div id="spinner" class="text-center">
  <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
  </div>
</div>

<!-- Load Tools -->
<!--
 You can upload Tools to your project's directory and use as in example below.
 Also you can load each Tool from CDN or use NPM/Yarn packages.
 Read more in Tool's README file. For example:
 https://github.com/editor-js/header#installation
 -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script><!-- Header -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script><!-- Image -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script><!-- Delimiter -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script><!-- List -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script><!-- Checklist -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script><!-- Quote -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script><!-- Code -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script><!-- Embed -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script><!-- Table -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script><!-- Link -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script><!-- Warning -->

<script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script><!-- Marker -->
<script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script><!-- Inline Code -->

<script src="js/editor.js"></script>


<!-- Initialize editor.js -->
<script>
var editor = new EditorJS({
    /**
     * Create a holder for the Editor and pass its ID
     */
    holder : 'editorjs',

    /**
     * Common Inline Toolbar settings
     * - if true (or not specified), the order from 'tool' property will be used
     * - if an array of tool names, this order will be used
     */
    // inlineToolbar: ['link', 'marker', 'bold', 'italic'],
    // inlineToolbar: true,


    /**
     * Available Tools list.
     * Pass Tool's class or Settings object for each Tool you want to use
     */
     tools: {
       /**
        * Each Tool is a Plugin. Pass them via 'class' option with necessary settings {@link docs/tools.md}
        */
       header: {
         class: Header,
         config: {
           placeholder: 'Enter a header',
           levels: [2, 3, 4],
           defaultLevel: 3
         }

       },

       /**
        * Or pass class directly without any configuration
        */
        image: {
       class: SimpleImage,

     },

       list: {
         class: List,
         inlineToolbar: true,
         shortcut: 'CMD+SHIFT+L'
       },

       checklist: {
         class: Checklist,
         inlineToolbar: true,
       },

       quote: {
         class: Quote,
         inlineToolbar: true,
         config: {
           quotePlaceholder: 'Enter a quote',
           captionPlaceholder: 'Quote\'s author',
         },
         shortcut: 'CMD+SHIFT+O'
       },

       warning: Warning,

       marker: {
         class:  Marker,
         shortcut: 'CMD+SHIFT+M'
       },

       code: {
         class:  CodeTool,
         shortcut: 'CMD+SHIFT+C'
       },

       delimiter: Delimiter,

       inlineCode: {
         class: InlineCode,
         shortcut: 'CMD+SHIFT+C'
       },

       linkTool: LinkTool,

       embed: Embed,

       table: {
         class: Table,
         inlineToolbar: true,
         shortcut: 'CMD+ALT+T'
       },
        // ...
    },

    /**
     * Previously saved data that should be rendered
     */
    data: {}
});

//editor is async load, using statement below to debug whether editor.js loads
editor.isReady
  .then(() => {
    console.log('Editor.js is ready to work!')
    /** Do anything you need after editor initialization */
  })
  .catch((reason) => {
    console.log(`Editor.js initialization failed because of ${reason}`)
  });






</script>

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
        <script src="js/contact.js"></script>
        <!--gmaps Js-->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
        <script src="js/gmaps.min.js"></script>
        <script src="js/theme.js"></script>

        <!--custom js-->
        <script src="js/ajax.js"></script>

      <script>


//for uploading images to the server and using them to make a post.
$('#uploadImages').on('click', function() {
    console.log($('#images').prop('files'));
    var file_data = $('#images').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    console.log(form_data);
    $.ajax({
        url: 'uploadFile.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
            //alert(php_script_response); // display response from the PHP script, if any
            $('#imagePath').append('<br><input type="text" value=' + php_script_response + " />");
        }
     });
});

//for uploading images to the server and using them to make a post.
$('#uploadThumb').on('click', function() {
    console.log($('#timages').prop('files'));
    var file_data = $('#timages').prop('files')[0];
    var form_data = new FormData();
    form_data.append('file', file_data);
    console.log(form_data);
    $.ajax({
        url: 'uploadFile.php', // point to server-side PHP script
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(php_script_response){
            //alert(php_script_response); // display response from the PHP script, if any
            $('#thumbnailPath').html('<br><input type="text" value=' + php_script_response + " />" + '<img id="thumbnailPic" src="' + php_script_response +'" alt="..." class="img-thumbnail">');
        }
     });
});





//binded to the submit button when user tries to submit to create/update a post
function onSubmit(){
  console.log("submit button was clicked");

  //set contents within the modal such as title and confirm message
  $('#modalTitle').empty();
  $('#modalTitle').append("TITLE: " + $('#subj').val());
  $('#Modal').modal('show');

  //change the button event and color located in the modal
  $("#post").attr("onclick","makePost()");
  $("#post").removeClass('btn-danger');
  $("#post").addClass('btn-primary');
}

function onDelete(){
  console.log('delete button was pressed');
  //set contents within the modal such as title and confirm message
  $('#modalTitle').empty();
  $('#modalTitle').append("TITLE: " + $('#subj').val());
  $('#Modal').modal('show');
  $('#modalBody').html('<p> Are You sure you want to delete this post?');

  //change the button event and color located in the modal
  $("#post").attr("onclick","deletePost()");
  $("#post").removeClass('btn-primary');
  $("#post").addClass('btn-danger');

}

//sequence of events after user closes the modal
$('#Modal').on('hidden.bs.modal', function () {
    //enable post button on modal & clear text
    $('#post').prop('disabled', false);
    $('#modalBody').html('<p> Are You sure you want to submit this post? Make sure to double check!');
});



function makePost(){
//grab blocks/content from the editors
editor.save().then((outputData) => {
  console.log('Article data: ', outputData);
  console.log(outputData.blocks);

  //Perform AJAX call to server.php and pass variables to interval
  var form_data = new FormData();
  //if posts already exists and has an id set to the hidden input, append to POST
  if(!$('#id').val().length < 1){
    form_data.append('id', $('#id').val());
  }

  form_data.append('subj', $('#subj').val());
  form_data.append('date', $('#date').val());
  form_data.append('content', JSON.stringify(outputData.blocks));
  //if user uploads a a thumbnail picture, then append src of thumbnail to the form for upload
  if($('#thumbnailPic').length != 0){
    form_data.append('thumbnail', $('#thumbnailPic').attr('src'));
  }
  $.ajax({
      url: 'server.php', // point to server-side PHP script
      dataType: 'text',  // what to expect back from the PHP script, if anything
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function(php_script_response){
          $('#post').prop('disabled', true);
          console.log(php_script_response);
          //if post is successfull, reload main menu
          mainMenu();
          $('#modalBody').html("<h1>" + php_script_response + "</h1>");
      }
   });

}).catch((error) => {
  console.log('Saving failed: ', error);
});
}


//function to send POST request to delete a Post
function deletePost(){
//Perform AJAX call to server.php and pass post id variable
var form_data = new FormData();

//if posts already exists and has an id set to the hidden input, append to POST
if(!$('#id').val().length < 1){
  form_data.append('id', $('#id').val());
  form_data.append('del', 1);
//send AJAX call
$.ajax({
    url: 'server.php', // point to server-side PHP script
    dataType: 'text',  // what to expect back from the PHP script, if anything
    cache: false,
    contentType: false,
    processData: false,
    data: form_data,
    type: 'post',
    success: function(php_script_response){
        $('#post').prop('disabled', true);
        console.log(php_script_response);
        //when success display result and reload mainmenu
        mainMenu();
        $('#modalBody').html("<h1>" + php_script_response + "</h1>");
    }
 });
}else{
  console.log('id of post does not exist or is not set');
}
}


//initializes editor
//create new Posts
function create(){
  console.log('Create button pressed');
  //load main editor div
  $('#main').html(globe);
  //show the back button
  $('#back').show();
  //clear all content from posts in case view() was called beforehand
  editor.blocks.clear();
  $('#subj').val(''); //clear title input
  $('#id').val(''); //clear id input
}
//grabs all posts via GET Ajax to see all views in DB
function view(){
  $('#spinner').show();
  //load
  $('#main').empty();
  console.log('View button pressed');
  //load main div with posts from DB
  AJAX_GET('server.php', {'action' : '1'}, loadAll, '');

}

//result from AJAX call from view function, laod it onto main div
function loadAll(result){
// conver to json object
result = JSON.parse(result);
console.log(result);
//console.log(posts[1][0].title);
//hide spinner and show back button
$('#spinner').hide();
$('#back').show();
//load this onto the div:
if(result[0].length != 0){
$('#main').append(result[0]);
}else{
$('#main').append("There are no saved posts");
}
//set the global function to posts for future use
posts = result[1];

}

//shows main menu
//store editing feature to a variable for later use
var globe = null;
var posts;
var del = '<div><button id="deletePost" class="mt-4 btn btn-block btn-danger" onclick="onDelete()">Delete</button>';

console.log(globe);
//create button object and append to main div
var choices = '<div class="text-center" id="choice" ><button class="btn btn-primary" onclick="create()">Create New Post</button><button class="btn btn-success" onclick="view()">View Posts</button><br><br>';
choices += '<form action="server.php" method="POST"><div class="form-group"><input type="submit" class="btn btn-warning" name="logOut" id="logOut" value="Sign out"></div></form>';

//runs this function to show view and create buttons
mainMenu();


//loads two buttons for view and create
function mainMenu(){

if(globe == null){
globe = $('#mainCreate').detach();
}

//removes delete button
if($('#deletePost').length){
  $('#deletePost').remove();
}

console.log("main menu called");
$('#main').empty();
$('#main').append(choices);
//hide spinner and back button
$('#spinner').hide();
$('#back').hide();

}


function loadPost(id){
    console.log('clicked on post #: ' + id);
    $('#main').empty();
    $('#main').append(globe);
    console.log(posts);
    $('#subj').val(posts[id].title);
    $('#id').val(id);

    //add the delete button to div
    $('#submit').after(del);

    //configure blocks
    posts[id].content = JSON.parse(posts[id].content);
   var arr = posts[id].content.split("}}");
    console.log(arr);
    for(var i = 0; i < arr.length; i++){
      if(i >= 1){
        arr[i] = arr[i].replace(',', '');
      }

      arr[i] = arr[i].concat('}}');

    //  console.log(arr[i]);
    }

    console.log(arr.pop());
    //arr.splice(-1, 1);
    console.log(arr[arr.length-1]);
    console.log(arr);
    editor.blocks.clear();
    for (var i in arr){
     editor.blocks.insert(JSON.parse(arr[i]).type, JSON.parse(arr[i]).data);
    }
}




       </script>
    </body>



</html>
