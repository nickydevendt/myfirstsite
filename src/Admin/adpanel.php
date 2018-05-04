<?php

include_once '../src/Admin/function.php';
//update delete users with confirm & delete visitors with confirm & pdf creator function;

if(isset($_POST['adminupdateuser']) && isset($_POST['userid'])) {
    updateUser(
    $_POST['firstname'],
    $_POST['prefix'],
    $_POST['lastname'],
    $_POST['email'],
    $_POST['currentemployer'],
    $_POST['role'],
    $_POST['userid']);
}
if(isset($_POST['admindeleteuser']) && isset($_POST['userid'])) {
    deleteUser($_POST['userid']);
}

