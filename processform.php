<?php
session_start();
?>
<?php


  
  //Email information
  $admin_email = "callumquigley61@gmail.com";
  $name = $_REQUEST['name'];
  $email = $_REQUEST['email'];
  $BusinessName = $_REQUEST['BusinessName'];
    $ExtraInfo = $_REQUEST['ExtraInfo'];

    //send confirmation email
 
    mail(email,
        "This is the message subject",
        "This is the message body",
        "From: contact@callumquigley.com" . "\r\n" . "Content-Type: text/plain; charset=utf-8",
        "-fcontact@callumquigley.com");

  //Email response
  echo "Thank you for contacting us!";
  
  
  //if "email" variable is not filled out, display the form

?>