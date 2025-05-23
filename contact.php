<?php
// filepath: z:\royan.at\royan cleaning\www\contact.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Daten aus dem Formular holen und bereinigen
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone   = strip_tags(trim($_POST["phone"]));
    $message = strip_tags(trim($_POST["message"]));

    // Pflichtfelder prüfen
    if (empty($name) || empty($email) || empty($message)) {
        echo "Bitte füllen Sie alle Pflichtfelder aus.";
        exit;
    }

    // E-Mail-Inhalt
    $to      = "info@royanian.com";
    $subject = "Neue Kontaktanfrage von $name";
    $body    = "Name: $name\n";
    $body   .= "Email: $email\n";
    $body   .= "Telefon: $phone\n";
    $body   .= "Nachricht:\n$message\n";

    $headers = "From: $name <$email>";

    // E-Mail senden
    if (mail($to, $subject, $body, $headers)) {
        echo "Vielen Dank für Ihre Anfrage! Wir melden uns so bald wie möglich.";
    } else {
        echo "Es gab ein Problem beim Senden Ihrer Nachricht. Bitte versuchen Sie es später erneut.";
    }
} else {
    echo "Ungültige Anfrage.";
}
?>