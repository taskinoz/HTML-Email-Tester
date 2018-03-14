<!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>EmailTester</title>
      <style>
        .html-email-tester-title{
          text-align: center;
          font-size: 40px;
          margin: 20px 40px;
          font-family: Arial;
        }
        .html-email-tester-email,
        .html-email-tester-subject{
          display:block;
          padding:3px 2px;
          font-family: Arial;
        }
        .html-email-tester-email span,
        .html-email-tester-subject span{
          background:#000;
          color:#fff;
          padding:2px 4px;
          border-radius:2px;
          font-family: Arial;
        }
        .html-email-tester-message{
          text-align: center;
          font-family: Arial;
          padding: 20% 0;
        }
        .html-email-tester-success,
        .html-email-tester-error{
          font-size: 40px;
        }
        .html-email-tester-error{
          color: red;
          margin: 40px 0;
        }
        .html-email-tester-container{
          background: #fff;
          margin: 40px 15%;
          padding: 40px;
          box-shadow: 2px 2px 8px 2px #999;
        }
        .html-email-tester-container-button{
          padding: 10px 60px;
          font-size: 20px;
          background: #943939;
          color: #fff;
          border: 0;
        }
        @media screen and (max-width:1000px) {
          .html-email-tester-container{
            margin: 30px 10%;
          }
        }
        @media screen and (max-width:700px) {
          .html-email-tester-container{
            margin: 20px 5%;
          }
        }
        @media screen and (max-width:500px) {
          .html-email-tester-container{
            padding: 20px;
            margin: 20px 0;
          }
        }
      </style>
      <!-- Add Shared Stylesheet For Input -->
      <!--<link rel="stylesheet" href="style.css">-->
    </head>
    <body>
<?php
// $POST DATA
// Email recipiant
if (isset($_POST['to'])){
  $to = $_POST['to'];
}
// Email Subject
if (isset($_POST['subject'])){
  $subject = $_POST['subject'];
}
// HTML Message
if (isset($_POST['body'])){
  $message = $_POST['body'];
}

$from = 'EmailTester';

//Full set of headers from https://stackoverflow.com/questions/566182/complete-mail-header
$headers  = "From: $from < example@example.com >\n";
//$headers .= "Cc: testsite < mail@domain.com >\n";
$headers .= "X-Sender: $from < example@example.com >\n";
$headers .= 'X-Mailer: PHP/' . phpversion();
//$headers .= "X-Priority: 1\n"; // Urgent message!
$headers .= "Return-Path: $from\n"; // Return path for errors
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=iso-8859-1\n";



// View in browser
if (isset($_POST['d'])){
  // Show email and subject
  echo '<div class="html-email-tester-email"><span>Email:</span> '.$to.'</div>';
  echo '<div class="html-email-tester-subject"><span>Subject:</span> '.$subject.'</div>';

  //Remove script tags (Not good sanitization but it will break the tags so they don't work)
  $message = str_ireplace ("<script","<p",$message);
  $message = str_ireplace ("/script>","/p>",$message);

  //Script to Style - Remove inline JavaScript
  $inline = array("onchange","onclick","onmouseover","onmouseout","onkeydown","onload");
  for ($i=0; $i <= count($inline) ; $i++) {
    $message = str_ireplace ($inline[$i],"style",$message);
  }

  //Remove php tags (Not good sanitization but it will break the tags so they don't work)
  $message = str_ireplace ("<?php","<p>",$message);
  $message = str_ireplace ("?>",",</p>",$message);

  echo '<div class="html-email-tester-email-body">'.$message.'</div>';
}
else {
  echo '<style>body{background:#ccc;}</style><h1 class="html-email-tester-title">HTML Email Tester</h1><div class="html-email-tester-container"><div class="html-email-tester-message">';
  // Sending email
  if(mail($to, $subject, $message, $headers)){
      echo '<div class="html-email-tester-success">Your mail has been sent successfully.</div>';
  } else{
      echo '<div class="html-email-tester-error">Unable to send email. Please try again.</div><button class="html-email-tester-container-button" onclick="window.history.back();">Retry</button>';
  }
  echo '</div></div>';
}

?>
</body>
</html>
