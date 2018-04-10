<?php

include 'function.php';
include '../src/Visitor/visitor.php';

global $pdo;

$userData = "";
$visitor = "";

// if statement voor registratie formulier:
if(isset($_REQUEST['registersubmit']))
{
    $data = array( 
        $_REQUEST['firstname'],
        $_REQUEST['prefix'],
        $_REQUEST['lastname'],
        $_REQUEST['email'],
        $_REQUEST['currentemployer'],
        $_REQUEST['username'],
        password_hash($_REQUEST['password'], PASSWORD_DEFAULT)
        );
    $userService = new UserService();
    $registerresult = $userService->createUser($data);
    if ($registerresult == true ){
        echo "<script>alert('Registration compleet, try to login');</script>";
    }
}

if(isset($_REQUEST['logoutnow']))
{
    session_destroy();
    header( "refresh:0;url=/login" );
}

if(isset($_REQUEST['loginsubmit'])) {
    $userService = new UserService();
    $user = $userService->login($_POST['username'], $_POST['password']);
    if($user == true) {
        $userData = $userService->getUser();
        if($userData['admin'] == 2) {
            header( "refresh:0;url=/adminpanel" );
        }
        elseif($userData['admin'] == 1) {
            header( "refresh:0;url=/userpanel" );
        }
        elseif($userData['admin'] == 0) {
            session_destroy();
        }
    } else {
       // echo "<script>alert('failed to login!, try again');document.location='/login'</script>"
        $message =  '<div class="alert">
        <span class="closebtn">&times;</span>
        <strong>Error</strong> Wrong credentials try again, <strong>Or get in contact with the admin <a href="mailto:nicky@sensimedia.nl">Admin</a>.</strong>
        </div>';
        echo $message;
    }
}

if(isset($_REQUEST['visitorsubmit'])) {
    $visitorService = new VisitorService();
    $visitorcheck = $visitorService->login($_POST['visitorcode']);
    if(isset($visitorcheck)) {
        header( "refresh:0;url=/" );
    }
}

