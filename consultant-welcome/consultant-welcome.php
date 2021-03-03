<?php

require_once '../vendor/autoload.php';

use Postmark\Models\PostmarkException;
use Postmark\PostmarkClient;

try {
    die;
    $client = new PostmarkClient("04ac4c81-aa8f-48a3-8cb0-4a4b87c3b63d");

    // Send an email:
    $sendResult = $client->sendEmailWithTemplate(
        "admin@mostashari.com", // sender
        "azizbohra07@gmail.com", // recipient
        22425156, // template id
        [
            // template model
            "name" => "Aziz",
            "email" => "azizbohra07@gmail.com",
            "password" => "12345678",
        ],
        true, // inline css
        "consultant-welcome" // tag
    );

    $result = [
        "To" => $sendResult->To,
        "SubmittedAt" => $sendResult->SubmittedAt,
        "MessageID" => $sendResult->MessageID,
        "ErrorCode" => $sendResult->Message,
        "Message" => "OK",
    ];

    echo json_encode($result);

} catch (PostmarkException $ex) {
    // If client is able to communicate with the API in a timely fashion,
    // but the message data is invalid, or there's a server error,
    // a PostmarkException can be thrown.
    echo $ex->httpStatusCode;
    echo $ex->message;
    echo $ex->postmarkApiErrorCode;

} catch (Exception $generalException) {
    // A general exception is thrown if the API
    // was unreachable or times out.
}
