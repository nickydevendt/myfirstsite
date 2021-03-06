<?php

function getCompanys() : array {
    $stmt = connection()->prepare('SELECT * FROM affiliatedcompanys ORDER BY datecreated ASC LIMIT 5');
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getProjects() : array {
    $statement = connection()->prepare('SELECT * FROM projects ORDER BY id DESC LIMIT 3');
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function connection() {
    $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

