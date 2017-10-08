<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>EmailTester</title>
      <!-- Add Shared Stylesheet For Input -->
      <!--<link rel="stylesheet" href="style.css">-->
    </head>
    <body>
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

//Debuging
if (isset($_POST['d'])){
  //Get text from url
  echo '<div class="email">Email: '.$to.'</div>';
  echo '<div class="subject">Subject: '.$subject.'</div>';
  //Remove script tags (Not good sanitization but it will break it so it doesnt work)
  $message = str_ireplace ("<script","<p",$message);
  $message = str_ireplace ("/script>","/p>",$message);
  //Script to Style - Remove inline JavaScript
  $inline = array("onchange","onclick","onmouseover","onmouseout","onkeydown","onload");
  for ($i=0; $i <= count($inline) ; $i++) {
    $message = str_ireplace ($inline[$i],"style",$message);
  }
  //Remove php tags (Not good sanitization but it will break it so it doesnt work)
  $message = str_ireplace ("<?php","<p>",$message);
  $message = str_ireplace ("?>",",</p>",$message);

  echo '<div class="email-body">'.$message.'</div>';
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
</body>
</html>
