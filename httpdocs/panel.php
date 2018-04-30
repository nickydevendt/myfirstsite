<?php

include_once '../src/Admin/function.php';

if(isset($_POST['updateuser'])) {
    updateUser($_POST['firstname'],$_POST['prefix'],$_POST['lastname'],$_POST['currentemployer'],$_POST['id']);
}
if(isset($_POST['addvisitor'])) {
    $email = strtolower($_POST['email']);
    addVisitor($_POST['inviterid'], $_POST['firstname'], $_POST['lastname'], $email);
}
if(isset($_POST['deletevisitor'])) {
    deleteVis($_POST['deleteid']);
}

function updateUser($firstname,$prefix,$lastname,$currentemployer,$id) {
    $pdo = connection();
    try{
    $statement = $pdo->prepare('UPDATE users SET firstname = ?, prefix = ?,lastname = ?, currentemployer = ? WHERE id = ?');
    $statement->execute(
        array($firstname,
            $prefix,
            $lastname,
            $currentemployer,
            $id
        ));
    $count = $statement->rowCount();
    if($count == '0') {
        $message = '<div class="alert">
        <span class="closebtn">&times;</span>
        <strong>Warning!</strong> nothing was changed!.
        </div>';
        echo $message;
    }else {
        $message = '<div class="alert succes">
        <span class="closebtn">&times;</span>
        <strong>Succes!</strong> account info was updated.
        </div>';
        echo $message;
    }
    } catch (PDOException $e) {
        echo 'error!: ' . $e->getMessage();
    }
}

function addVisitor($inviteid, $firstname, $lastname, $email) {
    $pdo = connection();
    try{
        $statement = $pdo->prepare('INSERT INTO visitors (inviteid, firstname, lastname, email) VALUES(?,?,?,?)');
        $statement->execute(array($inviteid, $firstname, $lastname, $email));
        $lastid = $pdo->lastInsertId();
        if(isset($lastid)) {
            $stmt = $pdo->prepare('SELECT * FROM visitors where id = ?');
            $stmt->execute(array($lastid));
            $value = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $email = $value[0]['email'];
            $randomid = $value[0]['randomid'];

            echo "<tr>";
                echo '<form method="post" action="">';
                echo '<td id="freshinsert">'.$value[0]['randomid'].'</td>';
                echo '<td id="freshinsert">'.$value[0]['firstname'].'</td>';
                echo '<td id="freshinsert">'.$value[0]['lastname'].'</td>';
                echo '<td id="freshinsert">'.$value[0]['email'].'</td>';
                echo '<td id="freshinsert">'.$value[0]['expiredate'].'</td>';
                echo '<td><button class="deletebtn" type="submit" name="deletevisitor" value="' .$value[0]['id'] .' ">Delete</button></td>';
                echo "</form>";
            echo "</tr>";

            if(isset($email) && !empty($email) && isset($randomid) && !empty($randomid)) {
                emailNewVisitor($email, $randomid);
                }else {
                $message =  '<div class="alert warning">
                <span class="closebtn">&times;</span>
                <strong>Warning!</strong> nothing inserted try again.
                </div>';
                echo $message;
            }
        }
    } catch (Exception $e) {
        $message =  '<div class="alert">
        <span class="closebtn">&times;</span>
        <strong>Danger!</strong> something went wrong maybe this user is already in the database.
        </div>';
        echo $message;
    }
}

function deleteVis($deleteid) {
    $pdo = connection();
    try{
        $statement = $pdo->prepare('DELETE FROM visitors WHERE id = ?');
        $statement->execute(array($deleteid));
        $count = $statement->rowCount();
        if($count == 1) {
            $message = '<div class="alert succes">
            <span class="closebtn">&times;</span>
            <strong>Succes!</strong> Visitor deleted.
            </div>';
            echo $message;
        }
    } catch (PDOException $e) {
        $message =  '<div class="alert warning">
        <span class="closebtn">&times;</span>
        <strong>Warning!</strong> something went wrong try again or get back to the admin.
        </div>';
        echo $message;
    }
}

function emailNewVisitor($email, $randomid) {
    try{
        $to = $email;
        $subject = "Welcome to my personal website";
        $message = 'Welcome you are invited to my personal website I would really like it if you gave it a look your code is: <br/></br><strong>' .$randomid . '</strong> <br/><br/><br/><p>you can use this on the login page and scroll down where there is a visitor section for your visitor code!</p>';
        $headers = 'From: nicky@sensimedia.nl';
        $mail = mail($to,$subject,$message, $headers);
        if($mail){
            $message = '<div class="alert succes">
            <span class="closebtn">&times;</span>
            <strong>Succes!</strong> Visitor was added and E-mail was send your email will soon arive! tell ur visitor to check their spam.
            </div>';
            echo $message;
        }
    } catch(Exception $e) {
        $message =  '<div class="alert">
        <span class="closebtn">&times;</span>
        <strong>Danger!</strong> Nothing happend because user was already in the database.
        </div>';
        echo $message;
    }
}

