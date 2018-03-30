<?php

if(isset($_POST['contactsend']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    try {
    $to         = 'nicky@sensimedia.nl';
    $subject    = "message from contact page!";
    $message    = array(
        $_POST['name'],
        $_POST['phone'],
        $_POST['message']
    );
    $headers    = "from: " . $_POST['email'];
    $mail = mail($to,$subject,implode("\r\n", $message), $headers);
        if($mail){
            $message =  '<div class="alert succes">
                <span class="closebtn">&times;</span>
                <strong>Succes!</strong> The email was send I will come back to you shortly.
                </div>';
            echo $message;
        }
        } catch(Exception $e) {
             $message =  '<div class="alert">
                <span class="closebtn">&times;</span>
                <strong>Danger!!</strong> something went wrong try again or comeback at a later time.
                </div>';
            echo $message;
        }
}

