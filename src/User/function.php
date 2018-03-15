<?php

class UserService
{

    protected $_username;
    protected $_password;

    protected $pdo;
    protected $_user;

    public function __construct($username, $password)
    {
        $this->pdo = $this->connection();
        $this->_username = $username;
        $this->_password = $password;
    }

    public function login()
    {
        $user = $this->checkCredentials();
        if($user) {
            $this->_user = $user;
            $_SESSION['admin'] = $user['admin'];
            return $user;
        }
        return false;
    }

    protected function checkCredentials()
    {
        $statement = $this->pdo->prepare('select * from users where username=?');
        $statement->execute(array($this->_username));
        if($statement->rowCount() > 0) {
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            $submitted_pass = md5($this->_password);
            if($submitted_pass == $user['password']) {
                return $user;
            }
        }
        return false;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function connection()
    {
        $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}

// building a class
/*
function addUser($data)
{
    global $pdo;
    try {
        $statement = $pdo->prepare('INSERT INTO users (firstname, lastname, email, currentemployer, username, password) VALUES (?, ?, ?, ?, ?, ?)');
        $statement->execute($data);
        return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}

function login($data)
{
    global $pdo;
    try {
        $statement = $pdo->prepare( 'SELECT email, firstname, lastname, admin FROM users WHERE username = ? AND password = ?');
        $statement->execute($data);
        $row_count = $statement->rowCount();
        if ($row_count = 1) {
            return $_SESSION['login'] = $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    } catch (PDOException $e) {
        die('error!: ' . $e->getMessage());
    }
}*/

