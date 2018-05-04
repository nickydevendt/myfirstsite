<?php

include_once '../src/User/function.php';
include_once '../src/resume/resume.php';
/*
if(isset($_POST['createpdf'])) {
    pdfcreator($_POST['pdfname']);
}*///fix create pdf!

function checkAdminLog()
{
    if($_SESSION['admin'] != 2) {
        header('refresh:0;url=/login');
        session_destroy();
    }else {
        return true;
    }
}

function getAllUsers() : array
{
    $pdo = connection();

    if(!isset($_SESSION['admin'])) {
        return [];
    } else {
        if ($_SESSION['admin'] != 2) {
            return [];
        }
    }

    try {
        if($_SESSION['admin'] == 2) {
            $statement = $pdo->prepare('SELECT * FROM users');
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS);
        }
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }

    return [];
}

function updateUser($firstname, $prefix, $lastname, $email, $currentemployer, $role, $id) : boolean {
        $pdo = connection();
    try {
        checkAdminLog();
            $statement = $pdo->prepare('UPDATE users set firstname = ?,prefix = ?,lastname = ?,email = ?,currentemployer = ? ,admin = ? WHERE id = ?');
            $statement->execute(array(
                $firstname,
                $prefix,
                $lastname,
                $email,
                $currentemployer,
                $role,
                $id));
            return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

function deleteUser($id)
{
    $pdo = connection();
    try {
        checkAdminLog();
        if($_SESSION['admin'] == 2) {
            $statement = $pdo->prepare('delete from users where id = ?');
            $statement->execute(array($id));
            return $statement->fetch(PDO::FETCH_ASSOC);
        }else {
        return [];
        }
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

function adminDeleteVisitor($visitorid)
{
    $pdo = connection();
    try {
        checkAdminLog();
            $statement = $pdo->prepare('DELETE FROM visitors WHERE id = ?');
            $statement->execute(array($visitorid));
            return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

function getAllVisitors() : array
{
    if(!isset($_SESSION['admin'])) {
        return [];
    } else {
        if ($_SESSION['admin'] != 2) {
            return [];
        }
    }
    $pdo = connection();
    try {
        if($_SESSION['admin'] == 2) {
            $statement = $pdo->prepare('select * from visitors');
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_CLASS);
        }
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }

    return [];
}

function connection()
{
    if(isset($_SESSION['admin']) || isset($_SESSION['userid']))
    {
        $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }else {
        header( "refresh:0;url=/login" );
        session_destroy();
    }
}

