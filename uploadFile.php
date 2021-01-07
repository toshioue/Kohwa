<?php

//determine if action is from file or urldecode
if(isset($_FILES['file'])){

  /** UPLOAD FILE TO SERVER*/
  if ( 0 < $_FILES['file']['error'] ) {
       echo 'Error: ' . $_FILES['file']['error'] . '<br>';
   }
   else {
       if(move_uploaded_file($_FILES['file']['tmp_name'], 'img/posts/' . $_FILES['file']['name'])){

         echo 'http://192.168.43.205/KOHWA/img/posts/' . $_FILES['file']['name'];
     }else{
       echo "failed to upload";
     }

   }

}


 ?>
