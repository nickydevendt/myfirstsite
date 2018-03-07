<?php

class UsersController
{
    private $repository;

    public function UsersController(IUsersRepository $repository)
    {
        $this->repository = $repository;
    }

    public function register($params)
    {
        if (isset($params['username'])) {
        $user = new User($params['username'], $params['email'], $params['firstname'], $params['lastname'], $params['currentemployer'], $params['password']);
        $this->repository->add($user);

        return '/register.html.twig';
        }
    }
}
