<?php

include_once '../src/Admin/function.php';

if(isset($_POST['updaterow'])) {
    updateUser();
}

if(isset($_POST['deletevisitor'])) {
    deleteVisitor();
}
if(isset($_POST['updatevisitor'])) {
    updateVisitor();
}

function getCurrentUser() : array{
    $pdo = connection();
    try {
        $statement = $pdo->prepare('SELECT * FROM users where id = ?');
        $statement->execute(array($_SESSION['userid']));
        return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
        }
}

function updateUser() {
    $pdo = connection();
    try{
        $statement = $pdo->prepare('UPDATE users SET firstname = ?, lastname = ?, email = ?, currentemployer = ?, username = ?, password = ? WHERE id = ?');
        $statement->execute(
            array($_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            $_POST['currentemployer'],
            $_POST['username'],
            md5($_POST['password']),
            $_POST['updaterow']
        ));
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}
function getMyVisitors() : array {
    $pdo = connection();
    try {
        $statement = $pdo->prepare('SELECT * FROM visitors WHERE inviteid = ?');
        $statement->execute(array($_SESSION['userid']));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
     } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

function deleteVisitor() {
    $pdo = connection();
    try{
            $statement = $pdo->prepare('DELETE FROM visitors WHERE id = ?');
            $statement->execute(array($_POST['deletevisitor']));
        } catch (PDOException $e) {
            die('error!: ' . $e->getMessage());
        }
}

function updateVisitor() {
    $pdo = connection();
    try{
        $statement = $pdo->prepare('UPDATE visitors SET firstname = ?, lastname = ?, email = ? WHERE id = ?');
        $statement->execute(
            array($_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            $_POST['updatevisitor']
        ));
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

