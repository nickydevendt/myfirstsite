<?php

include '../src/User/function.php';

function getAllUsers() : array
{
    global $pdo;
    try {
        $statement = $pdo->prepare('SELECT id, firstname, lastname, email FROM users');
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, User::class);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}



