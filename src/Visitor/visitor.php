<?php

class VisitorService {

    private $id;
    private $randomid;
    private $inviteid;
    private $firstname;
    private $lastname;
    private $email;
    private $datecreated;
    private $expiredate;
    private $pdo;

    public function login($value) {
        $this->randomid = $value;
        $this->pdo = $this->connection();
        try {
            if(isset($value)) {
                $stmt = $this->pdo->prepare('select * from visitors where randomid = ?');
                $stmt->setFetchMode(PDO::FETCH_CLASS, 'VisitorService');
                $stmt->execute(array($value));
                $visitorarray = $stmt->fetch(PDO::FETCH_ASSOC);
                if($value == $visitorarray['randomid']) {
                    $expiredVisitor = $this->expiredVisitor($visitorarray['expiredate']);
                    if($expiredVisitor == false) {
                            $_SESSION['visitor'] = true;
                            $this->id = $visitorarray['id'];
                            $this->inviteid = $visitorarray['inviteid'];
                            $this->firstname = $visitorarray['firstname'];
                            $this->lastname = $visitorarray['lastname'];
                            $this->email = $visitorarray['email'];
                            $this->datecreated = $visitorarray['datecreated'];
                            $this->expiredate = $visitorarray['expiredate'];
                            return $visitorarray;
                    }elseif ($expiredVisitor == true) {
                           echo 'user was expired and now deleted make contact with your inviter to get a new code';
                           $stmt = $this->pdo->prepare('DELETE FROM visitors where randomid = ?');
                           $stmt->execute(array($visitorarray['randomid']));
                    }
                }
                else {
                    echo 'Wrong code try again!';
                }
            }
        } catch(PDOException $e) {
            echo 'error!: '. $e->getMessage();
        }
    }
    public function expiredVisitor($value){
        if( strtotime(date('Y-m-d')) <= strtotime($value)) {
            return false;
        } elseif(strtotime(date('Y-m-d')) > $value)  {
            return true;
        }
    }
    function connection()
    {
        $pdo = new PDO('pgsql:host=localhost;dbname=nicky;', 'nicky', 'blarps');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}

