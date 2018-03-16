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
            $_SESSION['userid'] = $user['id'];
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

