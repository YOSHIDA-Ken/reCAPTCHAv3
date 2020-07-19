<?php
$site_key = getenv('SITE_KEY');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>reCAPTCHA Sample</title>
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $site_key; ?>"></script>
  <script>
      grecaptcha.ready(function () {
	  grecaptcha.execute("<?php echo $site_key; ?>", {action: "sent"}).then(function(token) {
          var recaptchaResponse = document.getElementById("recaptchaResponse");
          recaptchaResponse.value = token;
        });
      });
  </script>
</head>
<body>
<div class="main">
  <div class="contact-form">
    <div class="form-title">Contact</div>
    <form method="post" action="./sent.php">
      <div class="for-group">
        <label>Name</label>
        <input type="text" name="name" class="form-control" />
      </div>
      <div class="form-group">
        <label>Message</label>
        <textarea name="body" class="form-control"></textarea>
      </div>
      <input type="hidden" name="recaptchaResponse" id="recaptchaResponse">
      <button type="submit" class="btn btn-primary">送信</button>
    </form>
  </div>
</div>
</body>
</html>
