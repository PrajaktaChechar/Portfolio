<?php
// Replace with your actual receiving email
$receiving_email_address = 'checharprajakta1660@gmail.com';

// Load the PHP Email Form library
$php_email_form_path = '../assets/vendor/php-email-form/php-email-form.php';
if (file_exists($php_email_form_path)) {
    include($php_email_form_path);
} else {
    die('Unable to load the "PHP Email Form" Library!');
}

// Create a new instance
$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = isset($_POST['subject']) ? $_POST['subject'] : 'Contact Form Message';

// Optional: Use SMTP to send emails (uncomment and configure if needed)
/*
$contact->smtp = array(
    'host' => 'smtp.example.com',
    'username' => 'your_email@example.com',
    'password' => 'your_email_password',
    'port' => '587'
);
*/

// Add messages
$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Send the email and echo the result
echo $contact->send();
?>
