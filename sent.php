<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>reCAPTCHAテスト</title>
</head>
<body>
  <div class="main">
<?php
try {
	$recaptchaResponse = filter_input(INPUT_POST, 'recaptchaResponse');
	if ( ! is_string($recaptchaResponse)) {
		throw new Exception('no reCAPTCHA');
	}
	$secret = getenv('SITE_SECRET');
	$verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptchaResponse}");
	$reCAPTCHA = json_decode($verifyResponse);
	if (! $reCAPTCHA) {
		throw new Excpetion('Connection Error');
	}

	if (! $reCAPTCHA->success) {
		throw new Exception('Authentification Error'.$verifyResponse);
	}

	$name = filter_input(INPUT_POST, 'name');
	if ( ! is_string($name)) {
		throw new Exception('no name');
	}
	
	$body = filter_input(INPUT_POST, 'body');
	if ( ! is_string($name)) {
		throw new Exception('no body');
	}
	echo <<<EOD
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Thank you for your contacting us!</h5>
    <h6 class="card-subtitle">Your Inquiry</h6>
    <dl>
      <dt>Name</dt><dd>{$name}</dd>
      <dt>Message</dt><dd>{$body}</dd>
    </dl>
</div>
EOD;
}
catch (Exception $e) {
	echo <<<EOD
<div class="error-message">{$e->getMessage()}</div>
EOD;
}
?>
  </div>
</body>
</html>
