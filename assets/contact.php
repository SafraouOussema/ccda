<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        $language = trim($_POST["language"]);

        // Check that data was sent to the mailer.
        if ( empty($name)  OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            if ($language == "fr") {
                echo "Veuillez remplir le formulaire et réessayer.";
            } else {
                echo "Please complete the form and try again.";
            }
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "contact@root-development.com";

        // Set the email subject.
        $subject = "New contact from $name";

        // Build the email content.
        $email_content = "First Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            if ($language == "fr") {
                echo "Nous vous remercions! Votre message a été envoyé.";
            } else {
                echo "Thank You! Your message has been sent.";
            }
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            if ($language == "fr") {
                echo "Oups! Une erreur s'est produite et nous n'avons pas pu envoyer votre message.";
            } else {
                echo "Oops! Something went wrong and we couldn't send your message.";
            }
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        if ($language == "fr") {
            echo "Il y a eu un problème avec votre soumission, veuillez réessayer.";
        } else {
            echo "There was a problem with your submission, please try again.";
        }
    }

?>

