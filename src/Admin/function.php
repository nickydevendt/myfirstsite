<?php

include_once '../src/User/function.php';
include_once '../src/User/userpanel.php';

function getAllUsers() : array
{
    $pdo = connection();
    try {
        $statement = $pdo->prepare('SELECT * FROM users');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

if(isset($_POST['deleterow'])) {
    deleteUser($_POST['deleterow']);
}

function deleteUser($id)
{
    $pdo = connection();
    try {
        $statement = $pdo->prepare('delete from users where id = ?');
        $statement->execute(array($id));
        return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

function getAllVisitors() : array
{
    $pdo = connection();
    try {
        $statement = $pdo->prepare('select * from visitors');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

if(isset($_POST['deletevisitor']))
{
    deleteVisitor($_POST['deletevisitor']);
}

function connection()
{
    $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

