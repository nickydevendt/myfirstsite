<?php

include_once 'visitor.php';

// deze functie haalt de visitor op vanuit de database waarbij de uuid's overeenkomen

function getVisitor()
{
    try {
        $visitorService = new VisitorService();
        return $visitorService->firstname;
        return $visitorService->lastname;
        return $visitorService->email;
        return $visitorService->Expiredate;
    } catch(PDOException $e) {
        die('error!: '. $e->getMessage());
    }
}
function updateVisitor()
{
}

