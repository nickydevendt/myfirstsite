<?php

interface IUsersRepository
{
    public function add(User $user);
}

class UsersRepository implements IUsersRepository
{
    private static $connection_string;

    public static function set_connection_string($value)
    {
        UsersRepository::$connection_string = $value; 
    }

    private $connection;

    public function UsersRepository()
    {
        $connection = new pgsql("127.0.0.1", "nicky", "blarps", "nicky");
    }

    public function add(User $user)
    {
        $statement = $this->connection->prepare('INSERT INTO "users" ("firstname", "lastname", "email", "currentemployer", "username", "password") VALUES (?, ?, ?, ?, ?, ?)');
        $statement->bind_param("firstname", $user->get_firstname());
        $statement->bind_param("lastname", $user->get_lastname());
        $statement->bind_param("email", $user->get_email());
        $statement->bind_param("currentemployer", $user->get_currentemployer());
        $statement->bind_param("username", $user->get_username());
        $statement->bind_param("password", $user->get_password());

        if (!$statement->execute())
            throw new Exception("Execute failed: ({$stmt->errno}) {$stmt->error}");
        }
}
