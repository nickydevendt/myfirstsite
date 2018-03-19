<?php
class Users
{
    private $firstname;
    private $lastname;
    private $email;
    private $currentemployer;
    private $username;
    private $password;
      
    public function User($firstname, $lastname, $email, $currentemployer, $username, $password)
    {
        $this->set_firstname($firstname);
        $this->set_lastname($lastname);
        $this->set_email($email);
        $this->set_currentemployer($currentemployer);
        $this->set_username($username);
        $this->set_password($password);
    }
    
    public function get_firstname()
    {   
        return $this->firstname;
    }

    public function set_firstname($value)
    {
        $this->firstname = $value;
    }

    public function get_lastname()
    {   
        return $this->lastname;
    }

    public function set_lastname()
    {
        $this->lastname = $value;
    }

    public function get_currentemployer()
    {   
        return $this->currentemployer;
    }

    public function set_currentemployer()
    {
        $this->currentemployer = $value;
    }

    public function get_username()
    {
        return $this->username;
    }

    public function set_username($value)
    {
        $this->username = $value;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function set_email($value)
    {
        $this->email = $value;
    }

    public function get_password()
    {
        return $this->password;
    }

    public function set_password($value)
    {
    $this->password = $value;
    }
}

