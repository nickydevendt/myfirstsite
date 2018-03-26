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
        $_REQUEST['lastname'],
        $_REQUEST['email'],
        $_REQUEST['currentemployer'],
        $_REQUEST['username'],
        md5($_REQUEST['password'])
        );
    $userService = new UserService();
    $registerresult = $userService->createUser($data);
    if ($registerresult == true ){
        echo "<script>alert('Registration compleet, try to login');</script>";
    }
}

if(isset($_REQUEST['logoutnow']))
{
    header( "refresh:0;url=/login" );
    session_destroy();
}

if(isset($_REQUEST['loginsubmit'])) {
    $userService = new UserService();
    $user = $userService->login($_POST['username'], $_POST['password']);
    if(isset($user)) {
        $userData = $userService->getUser();
        if($userData['admin'] == 2) {
            header( "refresh:0;url=/adminpanel" );
        }
        elseif($userData['admin'] == 1) {
            header( "refresh:0;url=/userpanel" );
        }
    } else {
        echo "<script>alert('failed to login!, try again');document.location='/login'</script>";
    }
}

if(isset($_REQUEST['visitorsubmit'])) {
    $visitorService = new VisitorService();
    $visitorcheck = $visitorService->login($_REQUEST['visitorcode']);
}

