<?php

include_once '../src/User/function.php';
include_once '../src/User/userpanel.php';
include_once '../src/resume/resume.php';

if(isset($_POST['createpdf'])) {
    pdfcreator($_POST['pdfname']);
}

if(isset($_POST['deleterow'])) {
    deleteUser($_POST['deleterow']);
}

function checkAdminLog()
{
    if($_SESSION['admin'] != 2) {
        header('refresh:0;url=/login');
        session_destroy();
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


function deleteUser($id)
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
            $statement = $pdo->prepare('delete from users where id = ?');
            $statement->execute(array($id));
            return $statement->fetch(PDO::FETCH_ASSOC);
        }
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
/*
if(isset($_POST['deletevisitor']))
{
    if(!isset($_SESSION['admin'])) {
        return [];
    }
    deleteVisitor($_POST['deletevisitor']);
}*/

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

