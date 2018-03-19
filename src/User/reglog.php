<?php

include 'function.php';
include '../src/Visitor/function.php';

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
    $registerresult = insert($pdo, $data);
    if ($registerresult == true ){
        $_SESSION['register'] = true;
    }
}

if(isset($_REQUEST['logoutnow']))
{
    session_destroy();
    unset($visitor);
    header( "refresh:0;url=/login" );
}

if(isset($_REQUEST['loginsubmit'])) {
    $userService = new UserService($_POST['username'], $_POST['password']);
    if($user = $userService->login()) {
        $userData = $userService->getUser();
        if($user['id'] == 2) {
            $_SESSION['login'] = 2;
            header( "refresh:0;url=/adminpanel" );
        }
        else{
            $_SESSION['login'] = 1;
            header( "refresh:0;url=/userpanel" );
        }
    } else {
        echo 'Invalid login';
    }
}

if(isset($_REQUEST['visitorsubmit'])) {
    $visitorcheck = getVisitor($_REQUEST['visitorcode']);
    if($_REQUEST['visitorcode'] == $visitorcheck['randomid'] && strtotime($visitorcheck['expiredate']) > time()){
        $_SESSION['login'] = 1;
        return $visitor = $visitorcheck;
    } elseif(strtotime($visitorcheck['expiredate']) < time()) {
        echo 'Your Visitor code has expired. It was created on:  '. date("d,m,Y",strtotime($visitorcheck['datecreated']));
    }
}

