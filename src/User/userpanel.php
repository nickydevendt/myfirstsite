<?php

include_once '../src/Admin/function.php';

if(isset($_POST['updaterow'])) {
    updateUser();
}

if(isset($_POST['deletevisitor'])) {
    deleteVisitor();
}
if(isset($_POST['updatevisitor'])) {
    updateVisitor();
}
if(isset($_POST['addVisitor']))
{
    addVisitor($_POST['inviteid'], $_POST['firstname'], $_POST['lastname'], $_POST['email']);
}
function getCurrentUser() : array{
    $pdo = connection();
    try {
        if(isset($_SESSION['userid'])) {
            $statement = $pdo->prepare('SELECT * FROM users where id = ?');
            $statement->execute(array($_SESSION['userid']));
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            echo "<script>alert('You are not logged in or are doing shady stuff you are redirected!');document.location='/login'</script>";
            session_destroy();
        }
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
        }
}

function updateUser() {
    $pdo = connection();
    try{
        $statement = $pdo->prepare('UPDATE users SET firstname = ?, lastname = ?, email = ?, currentemployer = ?, username = ?, password = ? WHERE id = ?');
        $statement->execute(
            array($_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            $_POST['currentemployer'],
            $_POST['username'],
            md5($_POST['password']),
            $_POST['updaterow']
        ));
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}
function getMyVisitors() : array {
    $pdo = connection();
    try {
        if(isset($_SESSION['userid'])) {
            $statement = $pdo->prepare('SELECT * FROM visitors WHERE inviteid = ?');
            $statement->execute(array($_SESSION['userid']));
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else {
            return array();
        }
     } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

function checkLogin() {
    if(!isset($_SESSION['admin']) || !isset($_SESSION['userid'])) {
        echo "<script>alert('You are not logged in and you are redirected!');document.location='/login'</script>";
    }
}

function deleteVisitor() {
    $pdo = connection();
    try{
            $statement = $pdo->prepare('DELETE FROM visitors WHERE id = ?');
            $statement->execute(array($_POST['deletevisitor']));
        } catch (PDOException $e) {
            die('error!: ' . $e->getMessage());
        }
}

function updateVisitor() {
    $pdo = connection();
    try{
        $statement = $pdo->prepare('UPDATE visitors SET firstname = ?, lastname = ?, email = ? WHERE id = ?');
        $statement->execute(
            array($_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            $_POST['updatevisitor']
        ));
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}
function addVisitor($inviteid, $firstname, $lastname, $email) {
    $pdo = connection();
    try{
        $statement = $pdo->prepare('INSERT INTO visitors (inviteid, firstname, lastname, email) VALUES(?,?,?,?)');
        $statement->execute(array($inviteid, $firstname, $lastname, $email));
        $lastid = $pdo->lastInsertId();
/*
        if(isset($lastid)) {
            $stmt = $pdo->prepare('SELECT email,randomid FROM visitors where id = ?');
            $stmt->execute(array($lastid));
            $value = $stmt->fetchAll(PDO::FETCH_ASSOC);

            var_dump($value['email']);
            $email = $value['email'];
            $randomid = $value['randomid'];
            die();

            if(isset($email) && !empty($email) && isset($randomid) && !empty($randomid)) {
                emailNewVisitor($email, $randomid);
            }
        }
        */
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}
/*
function emailNewVisitor($email, $randomid) {
    $to = $email;
    $subject = "Your Visitor code";
    $message = 'Welcome you are invited to My first website I would really like it if you gave it a look your code is: ' .$randomid . 'you can use this on the login page and scroll down where there is a personalize section for your visitor code!';
    $headers = array(
        'from' => 'Nickydevendt@hotmail.com',
        'Reply-To' => 'nickydevendt@hotmail.com',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    mail($to,$subject,$message, $headers);
}
*/
function redirect() {
    header( "refresh:0;url=/login" );
    session_destroy();
}

