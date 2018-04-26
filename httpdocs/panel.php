<?php

include_once '../src/Admin/function.php';

if($_POST['updateuser']) {
    updateUser($_POST['firstname'],$_POST['prefix'],$_POST['lastname'],$_POST['currentemployer'],$_POST['id']);
}

function updateUser($firstname,$prefix,$lastname,$currentemployer,$id) {
    $pdo = connection();
    try{
    $statement = $pdo->prepare('UPDATE users SET firstname = ?, prefix = ?,lastname = ?, currentemployer = ? WHERE id = ?');
    $statement->execute(
        array($firstname,
            $prefix,
            $lastname,
            $currentemployer,
            $id
        ));
    $count = $statement->rowCount();
    if($count == '0') {
        $message = '<div class="alert">
        <span class="closebtn">&times;</span>
        <strong>Warning!</strong> nothing was changed!.
        </div>';
        echo $message;
    }else {
        $message = '<div class="alert succes">
        <span class="closebtn">&times;</span>
        <strong>Succes!</strong> account info was updated.
        </div>';
        echo $message;
    }
    } catch (PDOException $e) {
        echo 'error!: ' . $e->getMessage();
    }
}



