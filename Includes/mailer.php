<?php

class Mailer {

    function sendConfirm($user, $email, $adress, $city, $time, $date) {
      $headers = "From: radvilt@gmail.com";
      $subject = "Registracijos patvirtinimas";
      $body = $user . ",\n\n"
              . "Sveiki! Administratorius patvirtino jūsu rezervaciją "
              . "su sekančiais duomenimis:\n\n"
              . "Restoranas: " . $adress." ".$city. "\n"
              . "Data: " . $date . "\n"
              . "Laikas: " . $time ."\n";
      return mail($email, $subject, $body, $headers);
    }

    function sendDeny($user,$email) {
      $headers = "From: radvilt@gmail.com";
      $subject = "Registracijos atmetimas";
      $body = $user . ",\n\n"
              . "Sveiki! Administratorius atmetė jūsu rezervaciją "
              . "susisiekite su mūsų administratoriumi dėl atmetimo priežasčių:\n\n";
      return mail($email, $subject, $body, $headers);
    }

}

/* Initialize mailer object */
$mailer = new Mailer;
?>
