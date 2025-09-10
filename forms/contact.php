<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method Not Allowed. Please submit the form.";
    exit;
}

// Set your email address
$to = "amolkamble6999@gmail.com";

// Get POST data and sanitize
$name = isset($_POST['name']) ? strip_tags(trim($_POST['name'])) : '';
$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
$subject = isset($_POST['subject']) ? strip_tags(trim($_POST['subject'])) : '';
$message = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

if ($name && $email && $subject && $message) {
    $email_subject = "Contact Form: $subject";
    $email_body = "You have received a new message from your website contact form:\n\n"
        . "Name: $name\n"
        . "Email: $email\n"
        . "Subject: $subject\n"
        . "Message:\n$message\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "OK";
    } else {
        echo "Sorry, your message could not be sent.";
    }
} else {
    echo "Please fill in all fields.";
}
?>
