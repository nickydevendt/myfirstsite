<?php

$data = array(
    $_REQUEST['firstname'],
    $_REQUEST['lastname'],
    $_REQUEST['email'],
    $_REQUEST['currentemployer'],
    $_REQUEST['username'],
    $_REQUEST['password']
    );
if (isset($_REQUEST['submit']))
{
$result = insert($data);
}

function insert ($data)
{
    try {
        $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

