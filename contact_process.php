<?php
header('Content-type: application/json');

$response = array();
$to = "enyinnai@phreetech.com";

if ($_POST) {

    $regex = '/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
    $regex_name= '/^([a-zA-Z ])+$/';
    $regex_num= '/^([\+0-9])+$/';

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);
    $user_phone = trim($_POST['phone']);
    $from = $email;
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "Reply-To: ".$from." <".$from.">\r\n";
    $headers .= "From: "."Online Appartment Management System"." <".$to.">\r\n";
	$url="";
	if(stripos($_SERVER['SERVER_NAME'], "127.0") !==FALSE){
		$url="http://127.0.0.1/appartment_system/";
	}elseif(stripos($_SERVER['SERVER_NAME'], "local.") !==FALSE){
		$url="http://localhost/appartment_system/";
	}else{
		$url="http://".$_SERVER['SERVER_NAME']."/";
	}
    $message_body="
    <html>
    <head><title>
        Contact Form
    </title>
   
    </head>

    <body>
    <h2><strong>CONTACT FORM INQUIRY SENT BY ".strtoupper($name);
    $message_body .="
        </strong></h2><br>
    <p>The following information below relates to the Contact Inquiry sent from <a target='_blank' href='".$url."'>Online Student Registration System</a> </p><br>
    <table style='border:3px solid #eee;padding:20px'>
        <tr>
            <th>Student Name: <br><br></th><td>$name <br><br></td>

        </tr> 
        <tr>
            <th>Student Email:<br><br></th><td>$email<br><br></td>
        </tr> 
        <tr>
            <th>Phone Number:<br><br></th><td>$user_phone<br><br></td>
        </tr> 
        <tr>
            <th>Message:</th><td>".wordwrap($message,50);
    $message_body .="</td>
        </tr>
    </table>
    </body>
    </html>
    ";

    if(!empty($email) && !preg_match($regex,trim($email))) {
        $response['error']['caption'] = 'Please Check The Fields Below';
        $response['error']['text'] = '(' . $email . ') is not a valid email address';
        $response['error_field']='email';
    }
    elseif(!empty($name) && !preg_match($regex_name,trim($name))){
        $response['error']['caption'] = 'Please Check The Fields Below';
        $response['error']['text'] = 'Name can only contain text';
        $response['error_field']='name';
    }
    elseif(!empty($user_phone) && !preg_match($regex_num,$user_phone)){
        $response['error']['caption'] = 'Please Check The Fields Below';
        $response['error']['text'] = 'Phone Number must be Numeric';
        $response['error_field']='phone';
    }
    else{
        mail($to,$name." - Online Appartment Management System Contact Form",$message_body,$headers);
        $response['success']="sent";
    }
}

echo json_encode($response);

?>