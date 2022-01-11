<!DOCTYPE html>

<?php
  $message_sent = false;

  $contact_name = filter_var($_POST['contact-name'],FILTER_SANITIZE_STRING);
  $contact_address = filter_var($_POST['contact-address'],FILTER_SANITIZE_EMAIL);
  $contact_subject = filter_var($_POST['contact-subject'],FILTER_SANITIZE_STRING);
  $contact_message = filter_var($_POST['contact-message'],FILTER_SANITIZE_STRING);

  function is_valid($string)
  {
    $valid = isset($string) && $string != "";
    return $valid;
  }
  function is_email($string)
  {
    return is_valid($string) && filter_var($string,FILTER_VALIDATE_EMAIL);
  }

  $all_valid = true;
  $all_valid &= is_valid($contact_name);
  $all_valid &= is_email($contact_address);
  $all_valid &= is_valid($contact_subject);
  $all_valid &= is_valid($contact_message);

  if ($all_valid && !$message_sent)
  {
    $address = "contact@robertfry.xyz";
    $subject = "New message from robertfry.xyz";
    $message = "";

    $message .= "Sender: ".$contact_name." (".$contact_address.")\r\n";
    $message .= "Subject: ".$contact_subject."\r\n";
    $message .= "\r\n".$contact_message."\r\n";

    mail($address,$subject,$message);
    $message_sent = true;
  }
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <?php include("assets/common/header.htm"); ?>
  <main>
    <?php include("assets/common/dashboard.htm"); ?>
    <div class="contents">
      <h3>Contact Me</h3>
      <hr>
      <form class="contact-form" action="contact.php" method="POST">
        <div class="form-field">
          <label for="contact-name" class="input-required">Your Name</label>
          <input type="text" id="contact-name"
            name="contact-name" placeholder="Your Name" required>
        </div>
        <div class="form-field">
          <label for="contact-address" class="input-required">Your Email</label>
          <input type="email" id="contact-email"
            name="contact-address" placeholder="Your Email" required>
        </div>
        <div class="form-field">
          <label for="contact-subject" class="input-required">Subject</label>
          <input type="text" id="contact-subject"
            name="contact-subject" placeholder="Subject" required>
        </div>
        <div class="form-field">
          <label for="contact-message" class="input-required">Message</label>
          <textarea name="contact-message" id="contact-message"
            cols="30" rows="10" placeholder="Enter your message..."></textarea>
        </div>
        <div>
          <button class="button-glass" type="contact-submit">Submit</button>
        </div>
        <?php if($message_sent): ?>
          <div class="green banner collapse-up">Your message has been sent!</div>
        <?php endif; ?>
      </form>
    </div>
  </main>
  <?php include("assets/common/footer.htm"); ?>
</body>
</html>
