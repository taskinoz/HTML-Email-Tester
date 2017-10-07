<?php

if (isset($_POST['to'])){
  //Get text from url
  $to = $_POST['to'];
}
if (isset($_POST['subject'])){
  //Get text from url
  $subject = $_POST['subject'];
}

$from = 'EmailTester';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
if (isset($_POST['body'])){
  //Get text from url
  $message = $_POST['body'];
}
//$message = file_get_contents("/var/www/html/Cannon-Email-Reorganised.html");

//Debuging
if (isset($_POST['d'])){
  //Get text from url
  echo $to;
  echo $subject;
  echo $message;
}
else {
  // Sending email
  if(mail($to, $subject, $message, $headers)){
      echo 'Your mail has been sent successfully.';
  } else{
      echo 'Unable to send email. Please try again.';
  }
}
?>
