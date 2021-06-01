<?php

namespace Blog\Services;

use Blog\Repository\UserRepository;

class Authenticator
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function login(string $email,string $pass): ?array
    {
        $user = $this->userRepository->getOneByEmail($email);
        if ($user !== null) {
            if (password_verify($pass, $user['password'])) {
                $_SESSION['uid'] = $user['id'];
            }
            else {
                return ['error' => 'Password incorrect'];
            }
        } else {
            return ['error' => 'User with such email not found'];
        }

        return null;
    }
}
