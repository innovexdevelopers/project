<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $phone_number = htmlspecialchars($_POST['phone_number']);
    $email = htmlspecialchars($_POST['email']);
    $choice = htmlspecialchars($_POST['choice']);
    $description = htmlspecialchars($_POST['description']);

    // Email details
    $to = "ishabhama1@gmail.com"; // Your email address
    $subject = "New Contact Form Submission";
    $message = "You have received a new contact form submission:\n\n" .
               "Name: $name\n" .
               "Phone Number: $phone_number\n" .
               "Email: $email\n" .
               "Service Choice: $choice\n" .
               "Description: $description";
    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $message, $headers)) {
        echo "Thank you for contacting us! Your message has been sent.";
    } else {
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    echo "Invalid request.";
}
?>