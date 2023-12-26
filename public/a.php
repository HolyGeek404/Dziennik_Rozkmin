<?php
    session_start();
    
    if ( isset( $_POST[ 'sendmail' ] ) ) {
        $email = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );
        
        if ( empty( $email ) ) {
            $_SESSION[ 'email' ] = $_POST[ 'email' ];
            header( 'Location: index.php' );
        } else {
            // Przekieruj dane do pliku odpowiedzialnego za wysyłanie maila
            $_SESSION[ 'email' ] = $email;
            $_SESSION[ 'subject' ] = $_POST[ 'subject' ];
            $_SESSION[ 'message' ] = $_POST[ 'message' ];
            header( "Location: ./php/send_mail.php" );
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id="about_user_thinks">
    <span>Moje rozkminy</span>
    <form role="form" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-sm-9 form-group">
                <label for="email">To Email:</label>
                <input type="email" class="form-control" id="email" name="email"
                       placeholder="Enter your email" maxlength="50">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject"
                       value="Test Mail with attachments" maxlength="50">
            </div>
        </div>

        <div class="row">
            <div class="col-sm-9 form-group">
                <label for="name">Message:</label>
                <textarea class="form-control" type="textarea" id="message" name="message"
                          placeholder="Your Message Here" maxlength="6000" rows="4">Test mail using PHPMailer</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9 form-group">
                <button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block">Send</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>