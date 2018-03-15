<?php

include '../src/User/function.php';

function getAllUsers() : array
{
    $pdo = connection();
    try {
        $statement = $pdo->prepare('SELECT id, firstname, lastname, email, admin FROM users');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
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

function deleteUser()
{
    $pdo = connection();
    try {
        $statement = $pdo->prepare('delete from user where id = ?');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}


function connection()
{
    $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}
