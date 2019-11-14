<?php
header('Content-type: application/json');

$response = array();
$to = "enyinnai@phreetech.com";

if ($_POST) {
    $regex = '/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
    $email = trim($_POST['email']);

    $from = $email;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "Reply-To: ".$from." <".$from.">\r\n";

    $message_body="
    <html>
    <head><title>
        Newsletter
    </title>
   
    </head>

    <body>
    <h2><strong>Sign Up for Newsletter by ".strtoupper($email).
    "</strong></h2><br>
    <p>The following Email signed up for the sites Newsletter:</p><br>
    <p><b>$email</b></p>
    </body>
    </html>
    ";

    if(!empty($email) && !preg_match($regex,trim($email))) {
        $response['error']['caption'] = 'Please Check The Fields Below';
        $response['error']['text'] = '(' . $email . ') is not a valid email address';
        $response['newsletter']='newsletter';
    }
    else{
        mail($to,$email." -  Online Appartment Management System  for Newsletter",$message_body,$headers);
        $response['success']="sent";
    }
}

echo json_encode($response);

?>