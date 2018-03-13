<?php

include 'function.php';

$registerresult = "";
$loginresult = "";
// if statement voor registratie formulier:
if (isset($_REQUEST['registersubmit']))
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
        header( "refresh:0.1;url=/login" );
    }
}
if (isset($_REQUEST['loginsubmit']))
{
    $data = array(
        $_REQUEST['username'],
        md5($_REQUEST['password'])
    );
    $loginresult = login($pdo, $data);
    if ($loginresult == true)
    {
        header( "refresh:0.1;url=/home" );
    }
    if ($loginresult == false)
    {
        header( "refresh:0.1;url=/login" );
    }

}
if (isset($_REQUEST['logoutnow']))
{
    session_destroy();
    header( "refresh:0.1;url=/login" );
}
