<?php

require_once './vendor/autoload.php';

use Postmark\Models\PostmarkException;
use Postmark\PostmarkClient;

try {

    $client = new PostmarkClient("POSTMARK_API_TEST");
    $sendResult = $client->sendEmail("admin@mostashari.com",
        "admin@mostashari.com",
        "Hello from Postmark!",
        "This is just a friendly hello from your friends at Postmark."
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
