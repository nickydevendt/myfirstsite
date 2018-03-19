<?php

include 'function.php';
include '../src/Visitor/function.php';
global $pdo;

$userData = "";
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
    $registerresult = insert($pdo, $data);
    if ($registerresult == true ){
        $_SESSION['register'] = true;
    }
}

if(isset($_REQUEST['logoutnow']))
{
    session_destroy();
    header( "refresh:0;url=/login" );
}

if(isset($_REQUEST['loginsubmit'])) {
    $userService = new UserService($_POST['username'], $_POST['password']);
    if($user = $userService->login()) {
        $userData = $userService->getUser();
        if($user['id'] == 2) {
            header( "refresh:0;url=/adminpanel" );
        }
        else{
            header( "refresh:0;url=/userpanel" );
        }
    } else {
        echo 'Invalid login';
    }
}

if(isset($_REQUEST['visitorsubmit'])) {
    $visitor = getVisitor($_REQUEST['visitorcode']);
    if($_REQUEST['visitorcode'] == $visitor['randomid'])
    {
        var_dump($visitor);
        $_SESSION['visitorlogin'] = $visitor['id'];
    }
}



