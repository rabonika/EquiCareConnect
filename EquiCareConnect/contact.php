<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form fields and remove whitespace
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Check that data was sent to the mailer.
    if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Set a 400 (bad request) response code and exit.
        http_response_code(400);
        echo "Oops! There was a problem with your submission. Please complete the form and try again.";
        exit;
    }

    // Set the recipient email address.
    $recipient = "your-email@example.com";

    // Set the email subject.
    $subject = "New contact from $name";

    // Build the email content.
    $email_content = "Name: $name\n";
    $email_content = "Email: $email\n\n";
    $email_content = "Message:\n$message\n";

    // Build the email headers.
    $email_headers = "From: $name <$email>";

    // Send the email.
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Thank You</title>
            <style>
                body {
                    background-color: #f2f2f2;
                    color: #333;
                    margin: 0;
                    padding: 0;
                    transition: background-color 0.3s ease;
                    font-family: 'Gill Sans', 'Arial', sans-serif;
                }
                .container {
                    display: flex;
                    justify-content: space-around;
                    align-items: center;
                    margin: 20px auto;
                    padding: 20px;
                    background-color: white;
                    border-radius: 10px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    max-width: 1200px;
                    flex-direction: column;
                }

                .container h2 {
                    text-align: center;
                    margin-bottom: 20px;
                    color: #52a2db;
                    font-size: 40px;
                    font-weight: 50px;
                    font-family: 'Gill Sans', 'Arial', sans-serif;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <h2>Thank you for your message!</h2>
                <p>We will get back to you via e-mail as soon as possible.</p>
            </div>
        </body>
        </html>";
    } else {
        // Set a 500 (internal server error) response code.
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
} else {
    // Not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}
?>
