<?php

class UserService
{

    protected $_username;
    protected $_password;

    protected $pdo;
    protected $_user;

    public function __construct()
    {
        $this->pdo = $this->connection();
    }

    public function login($username, $password)
    {
        $this->_username = $username;
        $this->_password = $password;
        $user = $this->checkCredentials();
        if($user) {
            $this->_user = $user;
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['userid'] = $user['id'];
            if($user['admin'] = 1 || $user['admin'] = 2) {
                $_SESSION['login'] = $user['admin'];
            }
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
            $submitted_pass = $this->_password;
            if(password_verify($submitted_pass,$user['password'])) {
                return $user;
            }else{
            return false;
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

    public function createUser(array $data)
    {
        try {
            $stmt = $this->pdo->prepare('INSERT INTO users(firstname, prefix ,lastname,email,currentemployer,username,password) VALUES(?,?,?,?,?,?,?)');
            $stmt->execute($data);
        } catch (PDOException $e) {
            die('error!: '. $e->getMessage());
        }
    }
}

