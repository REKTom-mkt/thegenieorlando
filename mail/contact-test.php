<?php
$spam = $_POST['spam'];

if ($spam == "") {
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$data = [
	'secret' => "6Ld3Cx4sAAAAAGB9vROktw2NlAQRyESm1zws5ZHN",
	'response' => $_POST['token'],
	'remoteip' => $_SERVER['REMOTE_ADDR']
	];

	$options = array(
		'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data)
		)
	);

	$context  = stream_context_create($options);
	$response = file_get_contents($url, false, $context);
	$res = json_decode($response, true);

	if ($res['success'] == true && $res['score'] >= 0.3) {
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email_address = $_POST['email'];
		$phone = $_POST['phone'];
		$message = $_POST['msg'];
			
		// Create the email and send the message
		// $to = 'info@thegenieorlando.com';
		$to = 'dandyojeda@gmail.com';

		$email_subject = "New Message from The Genie Transportation Services.";
		$email_body = "You've received a new message from your website's contact form.\n\n"."Here are the details:
		\nName: $fname $lname
		\nEmail: $email_address
		\nPhone Number: $phone
		\nMessage: $message";

		$headers = "From: contact@thegenieorlando.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.

		$success = mail($to,$email_subject,$email_body,$headers, "-f noreply@thegenieorlando.com");
		if ($success) {
			$res['code'] = 200;
			echo json_encode($res);
			http_response_code(200);
		} else {
			$res['code'] = 500;
			echo json_encode($res);
			http_response_code(500);
		}
	} else {
		$res['code'] = 500;
		echo json_encode($res);
		http_response_code(500);
	}
} else {
    $res['code'] = 200;
    $res['spm'] = "true";
    echo json_encode($res);
    http_response_code(200);
}
?>