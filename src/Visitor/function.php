<?php

include_once 'visitor.php';

// deze functie haalt de visitor op vanuit de database waarbij de uuid's overeenkomen

function getVisitor($visitorcode)
{
    try {
        $pdo = connection();
        $stmt = $pdo->prepare('select * from visitors where randomid = ?');
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Visitor');
        $stmt->execute(array($visitorcode));
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

