<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "kartikpatel5544@gmail.com";
    $from = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Check for any potential email injection attempts
    if (preg_match("/[\r\n]/", $name) || preg_match("/[\r\n]/", $from) || preg_match("/bcc:|cc:/i", $message)) {
        die("Invalid input detected.");
    }

    $headers = "From: $from\r\n";
    $headers .= "Reply-To: $from\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

    $subject = "You have a message from your Bitmap Photography.";

    $logo = 'img/logo.png';
    $link = '#';

    $body = "<!DOCTYPE html><html lang='en'><head><meta charset='UTF-8'><title>Express Mail</title></head><body>";
    $body .= "<table style='width: 100%;'>";
    $body .= "<thead style='text-align: center;'><tr><td style='border:none;' colspan='2'>";
    $body .= "<a href='{$link}'><img src='{$logo}' alt=''></a><br><br>";
    $body .= "</td></tr></thead><tbody><tr>";
    $body .= "<td style='border:none;'><strong>Name:</strong> {$name}</td>";
    $body .= "<td style='border:none;'><strong>Email:</strong> {$from}</td>";
    $body .= "</tr>";
    $body .= "<tr><td style='border:none;'><strong>Subject:</strong> {$subject}</td></tr>";
    $body .= "<tr><td></td></tr>";
    $body .= "<tr><td colspan='2' style='border:none;'>{$message}</td></tr>";
    $body .= "</tbody></table>";
    $body .= "</body></html>";

    // Send the email
    $send = mail($to, $subject, $body, $headers);

    if ($send) {
        echo "Message sent successfully!";
    } else {
        echo "Message could not be sent. Please try again later.";
    }
}
?>
