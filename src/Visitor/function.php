<?php

include_once 'visitor.php';

function getVisitor($value)
{
    try {
        $pdo = connection();
        $stmt = $pdo->prepare('select * from visitors where randomid = ?');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Visitor');
        $stmt->execute(array($value));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        die('error!: '. $e->getMessage());
    }
}
function addVisitor()
{

}
function updateVisitor()
{

}
function deleteVisitor()
{

}
function expiredVisitor()
{

}

function connection()
{
    $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

