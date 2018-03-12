<?php

$pdo = connection();

function insert ($pdo, $data)
{
    try {
        $statement = $pdo->prepare('INSERT INTO users (firstname, lastname, email, currentemployer, username, password) VALUES (?, ?, ?, ?, ?, ?)');
        $statement->execute($data);
        if (null !== $statement->fetch(PDO::FETCH_ASSOC))
        {
            return true;
        }
        else {
            return false;
        }
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage() );
    }
}

function login($pdo, $data)
{
    try {
        $statement = $pdo->prepare( 'SELECT email, firstname, lastname, admin FROM users WHERE username = ? AND password = ?');
        $statement->execute($data);
        $row_count = $statement->rowCount();
        if ($row_count = 1) {
            $_SESSION['login'] = $statement->fetch(PDO::FETCH_ASSOC);
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage() );
    }
}

function connection()
{
    $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function logout()
{
    session_destroy();
}

