<?php

require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

$error = null;
if (count($_POST) > 0) {

    $sid = 'ACb5ab2232d3937f6f431a5ae594da14fa';
    $token = 'e5445e8d557030d856f55437367c9623';
    $client = new Client($sid, $token);

    $to = $_POST['phone'];
    $message = $_POST['message'];

    try {
        // Use the client to do fun stuff like send text messages!
        $client->messages->create(
            // the number you'd like to send the message to
            $to,
            [
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+12058609512',
                // the body of the text message you'd like to send
                'body' => $message,
            ]
        );

        $error = -1;
        //sent successfully
    } catch (Exception $e) {
        $error = $e->getCode() . ' : ' . $e->getMessage() . "<br>";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>This is Twilio Test</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    </head>
    <body>
        <div class="container pt-5">

        <?php if ($error === -1) : ?>

        <div class="alert alert-success" role="alert">
        This is a success alert—check it out!
        </div>

        <?php elseif (isset($error)) : ?>

        <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
        </div>

        <?php endif; ?>

        <h1>Sending SMS using Twilio</h1>
        <form action="" method="POST">
        <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="emailHelp" placeholder="+1XXXXXXXXXX">
            <small id="emailHelp" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Enter your message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>
    </body>
</html>
