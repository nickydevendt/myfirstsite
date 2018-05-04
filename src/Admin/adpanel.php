<?php

include_once '../src/Admin/function.php';
include_once '../src/resume/resume.php';
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
if(isset($_POST['admindeletevisitor']) && isset($_POST['visitorid'])) {
    adminDeleteVisitor($_POST['visitorid']);
}
if(isset($_POST['createPDF']) && isset($_POST['name'])) {
    pdfcreator($_POST['name']);
}

