<?php

namespace MG\Infrastructure\Persistence\InMemory\User;


use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Domain\Model\User\UserRepository;

class InMemoryUserRepository implements UserRepository
{
    private $users = [];

    public function ofId(UserId $userId): ?User
    {
        if (!isset($this->users[$userId->id()])) {
            return null;
        }

        return $this->users[$userId->id()];
    }

    public function ofEmail($email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->email() === $email) {
                return $user;
            }
        }

        return null;
    }

    public function add(User $user)
    {
        $this->users[$user->id()->id()] = $user;
    }

    public function nextIdentity(): UserId
    {
        return new UserId();
    }
}