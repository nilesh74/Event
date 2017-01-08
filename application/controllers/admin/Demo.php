<?php
ini_set('display_errors', 'On');
//set_error_handler("var_dump");
$email_to="ahernilesh74@gmail.com";
$email_subject="It works";
$email_message="Hello. I can send mail!";
$headers = "From: noreply@example.com\r\n"; 
$headers.= "MIME-Version: 1.0\r\n"; 
$headers.= "Content-Type: text/html; charset=ISO-8859-1\r\n"; 
$headers.= "X-Priority: 1\r\n"; 

if(mail($email_to, $email_subject, $email_message, $headers))
{	
echo "mail sent!";
}
?> 