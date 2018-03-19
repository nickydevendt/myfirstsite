<?php

class Visitor {

    private $id;
    private $randomid;
    private $inviteid;
    private $firstname;
    private $lastname;
    private $email;
    private $datecreated;
    private $expiredate;

    public function __construct($id, $randomid, $inviteid, $firstname, $lastname, $email, $datecreated, $expiredate) {
        $this->set_id($id);
        $this->set_randomid($randomid);
        $this->set_inviteid($inviteid);
        $this->set_firstname($firstname);
        $this->set_lastname($lastname);
        $this->set_email($email);
        $this->set_datecreated($datecreated);
        $this->set_expiredate($expiredate);
    }
    
    public function set_id($value)
    {
        $this->id = $value;
    }
    public function get_id()
    {
        return $this->id;
    }
    public function set_randomid($value)
    {
        $this->randomid = $value;
    }
    public function get_randomid()
    {
        return $this->randomid;
    }
    public function set_inviteid($value)
    {
        $this->inviteid = $value;
    }
    public function get_inviteid()
    {
        return $this->inviteid;
    }
    public function set_firstname($value)
    {
        $this->firstname = $value;
    }
    public function get_firstname()
    {
        return $this->inviteid;
    }
    public function set_lastname($value)
    {
        $this->lastname = $value;
    }
    public function get_lastname()
    {
        return $this->lastname;
    }
    public function set_email($value)
    {
        $this->email = $value;
    }
    public function get_email()
    {
        return $this->email;
    }
    public function set_datecreated($value)
    {
        $this->datecreated = $value;
    }
    public function get_datecreated()
    {
        return $this->datecreated;
    }
    public function set_expiredate($value)
    {
        $this->expiredate = $value;
    }
    public function get_expiredate()
    {
        return $this->expiredate;
    }
}

