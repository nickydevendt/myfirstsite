<?php

include_once 'visitor.php';

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

