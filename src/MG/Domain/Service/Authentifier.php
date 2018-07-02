<?php

namespace MG\Domain\Service;

use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserRepository;

abstract class Authentifier
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function authenticate($email, $password)
    {
        if ($this->isAlreadyAuthenticated()) {
            return true;
        }

        $user = $this->userRepository->ofEmail($email);
        if (!$user) {
            return false;
        }

        if ($user->password() !== $password) {
            return false;
        }

        $this->persistAuthentication($user);

        return true;
    }

    abstract protected function persistAuthentication(User $user);
    abstract protected function isAlreadyAuthenticated();
    abstract public function logout();
}
