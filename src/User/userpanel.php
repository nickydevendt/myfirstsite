<?php

include_once '../src/Admin/function.php';

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
function getCurrentUser() {
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
    } catch (PDOException $e) { // this die needs to change into something more flowinglee instead of a cold hard die!
        $message = '<div class="alert">
            <span class="closebtn">&times;</span>
            <strong>ERROR!</strong>' . $e->getMessage() . '
                </div>';
         echo $message;
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

