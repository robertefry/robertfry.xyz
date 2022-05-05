<!DOCTYPE html>

<?php

  if (isset($_POST['form-submit']))
  {
    unset($_POST['form-submit']);

    $form_name = filter_var($_POST['form-name'],FILTER_SANITIZE_STRING);
    $form_addr = filter_var($_POST['form-addr'],FILTER_SANITIZE_EMAIL);
    $form_subj = filter_var($_POST['form-subj'],FILTER_SANITIZE_STRING);
    $form_mesg = filter_var($_POST['form-mesg'],FILTER_SANITIZE_STRING);

    $address = "contact@robertfry.xyz";
    $subject = "".$form_subj;
    $message = "".$form_mesg;

    $header_from = "".$form_name." <".$form_addr.">";
    $headers = array('From'=>$header_from);

    mail($address,$subject,$message,$headers);
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
          <label for="form-name" class="input-required">Your Name</label>
          <input name="form-name" type="text" placeholder="Your Name" required>
        </div>
        <div class="form-field">
          <label for="form-addr" class="input-required">Your Email Address</label>
          <input name="form-addr" type="email" placeholder="Your Email Address" required>
        </div>
        <div class="form-field">
          <label for="form-subj" class="input-required">Message Subject</label>
          <input name="form-subj" type="text" placeholder="Message Subject" required>
        </div>
        <div class="form-field">
          <label for="form-mesg" class="input-required">Message</label>
          <textarea name="form-mesg" type="text" placeholder="Enter your message here..."
            cols="30" rows="10"></textarea>
        </div>
        <div>
          <input type="submit" class="button-glass" name="form-submit" value="Submit">
        </div>
        <!-- <?php if($message_sent): ?>
          <div class="banner-green collapse-up">Your message has been sent!</div>
        <?php endif; ?> -->
      </form>
    </div>
  </main>
  <?php include("assets/common/footer.htm"); ?>
</body>
</html>
