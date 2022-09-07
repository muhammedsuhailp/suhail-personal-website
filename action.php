<?php
  // hometechworld.complaints@gmail.com
 // Read POST request params into global vars
$to = 'iamsuhail.in@gmail.com'; //change to company email
$from = 'iamsuhail.in@gmail.com';
// $from = strip_tags($_POST['email']);
$subject = 'Complaint'; 

$message  = "Name: " . strip_tags($_POST['fname'])."\r\n";
$message .= "Email: " . strip_tags($_POST['email'])."\r\n";
$message .= "Phone: " . $_POST['phone']."\r\n";
$message .= "Service: " . $_POST['gender']."\r\n";
$message .= "Brand: " . $_POST['brand']."\r\n";
$message .= "Address: " . $_POST['address']."\r\n";
$message .= "Message: " . $_POST['message']."\r\n";



$headers = "From: $from";

if (is_uploaded_file($fileatt)) {
// Read the file to be attached ('rb' = read binary)
$file = fopen($fileatt,'rb');
$data = fread($file,filesize($fileatt));
fclose($file);

// Generate a boundary string
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

// Add the headers for a file attachment
$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";

// Add a multipart boundary above the plain message
$message = "This is a multi-part message in MIME format.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" .
$message . "\n\n";

// Base64 encode the file data
$data = chunk_split(base64_encode($data));

// Add file attachment to the message
$message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
//"Content-Disposition: attachment;\n" .
//" filename=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"--{$mime_boundary}--\n";
}

// Send the message
$ok = @mail($to, $subject, $message, $headers);
if ($ok) {
	//mail send back to the complainee
	 if($_POST['email']!=""){
 	$to_complainee=strip_tags($_POST['email']);
	 $subject1="Complaint Registered With Hometechworld";
	 $message  = "Your complaint registered with following details, "."\r\n";
	 $message .= "Service: " . $_POST['gender']."\r\n";
	 $message .= "Brand: " . $_POST['brand']."\r\n";
	 $message .= "Message: " . $_POST['message']."\r\n";
	 $complainee = @mail($to_complainee, $subject1, $message);
	 }
	 
	  echo "<link href='https://cdn.jsdelivr.net/npm/lobibox@1.2.7/css/lobibox.css' rel='stylesheet'> <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>  <script src='https://cdn.jsdelivr.net/npm/lobibox@1.0.0/dist/js/lobibox.min.js'></script><script type='text/javascript'>   setTimeout(function () {";
                                 echo " Lobibox.alert('info',{ msg: 'Mail Send Successfully!!'}); }, 100) ;  </script>";
      $mailsent = mail($to, $subject, $msgcontents, $headers);

         
                                echo " <script> setTimeout(function () { window.location.href ='index.html';";
                              echo " }, 1000) ; </script>";
// 	echo "<script>alert('mail sent');</script>";
	
// 	header('Location: index.html');

} else {
echo "<p>Mail could not be sent. Sorry!</p>";
}

?>