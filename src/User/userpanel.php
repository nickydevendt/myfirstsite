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
if(isset($_POST['addVisitor'])) {
    addVisitor($_POST['inviteid'], $_POST['firstname'], $_POST['lastname'], $_POST['email']);
}
if(isset($_POST['updateuserpassword'])) {
    $oldpw = $_POST['oldpw'];
    $newpw = $_POST['newpw'];
    $confirmpw = $_POST['confirmnewpw'];

    if($newpw == $confirmpw) {
        if(preg_match("^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$^",$confirmpw)) {
            $password = $confirmpw;
            updateUserPassword($oldpw, $password, $_POST['userid']);
        }else {
            $message = '<div class="alert">
                <span class="closebtn">&times;</span>
                <strong>Warning!</strong> passwords need to contain atleast: a Upper character, a lower case character, a number and atleast 8 characters long.
                </div>';
             echo $message;
        }
    }else {
        $message = '<div class="alert">
            <span class="closebtn">&times;</span>
            <strong>Warning!</strong> New passwords did not match, make sure they are the same!
                </div>';
         echo $message;
    }
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
        $statement = $pdo->prepare('UPDATE users SET firstname = ?, prefix = ?,lastname = ?, email = ?, currentemployer = ?, username = ? WHERE id = ?');
        $statement->execute(
            array($_POST['firstname'],
            $_POST['prefix'],
            $_POST['lastname'],
            $_POST['email'],
            $_POST['currentemployer'],
            $_POST['username'],
            $_POST['updaterow']
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
        die('error!: ' . $e->getMessage());
    }
}
function updateUserPassword($oldpw, $password, $userid) {
    $pdo = connection();
    try {
        if(isset($userid) && isset($password) && isset($oldpw)) {
            $statement = $pdo->prepare('SELECT password FROM users WHERE id = ?');
            $statement->execute(array($userid));
            $currentpassword = $statement->fetch(PDO::FETCH_ASSOC);
            $currentpwcheck = password_verify($oldpw, $currentpassword['password']);
            if($currentpwcheck == true) {
                if(isset($password) && !empty($password)) {
                    $statement = $pdo->prepare('UPDATE users set password = ? WHERE id = ?');
                    $statement->execute(array(
                        password_hash($password, PASSWORD_DEFAULT),
                        $userid
                    ));
                    $count = $statement->rowCount();
                    if($count == '0') {
                        $message = '<div class="alert">
                            <span class="closebtn">&times;</span>
                            <strong>Warning!</strong> the update went wrong try again.
                            </div>';
                        echo $message;
                    }else {
                        $message = '<div class="alert succes">
                            <span class="closebtn">&times;</span>
                            <strong>Succes!</strong> password is updated.
                            </div>';
                        echo $message;
                    }
                }
                else {
                    $message = '<div class="alert">
                        <span class="closebtn">&times;</span>
                        <strong>Warning!</strong> new password is not valid or empty? try again.
                        </div>';
                    echo $message;
                }
            }else {
                $message = '<div class="alert">
                    <span class="closebtn">&times;</span>
                    <strong>Warning!</strong> Invalid password.
                    </div>';
                 echo $message;
            }
        }else {
            $message = '<div class="alert">
                <span class="closebtn">&times;</span>
                <strong>Warning!</strong> Something is not set, make sure your containers with passwords are filled and correct!
                </div>';
             echo $message;
            return "<script>alert('$e');document.location='/userpanel'</script>";
        }
    } catch(PDOException $e) {
        echo "<script>alert('$e');document.location='/login'</script>";
        session_destroy();
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
            <strong>Warning!</strong> ' . $e . '.
            </div>';
            echo $message;
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
        $message =  '<div class="alert warning">
        <span class="closebtn">&times;</span>
        <strong>Warning!</strong> ' . $e . '.
        </div>';
        echo $message;
    }
}

function addVisitor($inviteid, $firstname, $lastname, $email) {
    $pdo = connection();
    try{
        $statement = $pdo->prepare('INSERT INTO visitors (inviteid, firstname, lastname, email) VALUES(?,?,?,?)');
        $statement->execute(array($inviteid, $firstname, $lastname, $email));
        $lastid = $pdo->lastInsertId();
        if(isset($lastid)) {
            $stmt = $pdo->prepare('SELECT email,randomid FROM visitors where id = ?');
            $stmt->execute(array($lastid));
            $value = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $email = $value[0]['email'];
            $randomid = $value[0]['randomid'];

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

function redirect() {
    header( "refresh:0;url=/login" );
    session_destroy();
}

