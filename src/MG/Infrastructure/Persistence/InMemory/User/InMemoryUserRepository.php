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
        if (!isset($this->users[$userId->userId()])) {
            return;
        }

        return $this->users[$userId->userId()];
    }

    public function ofEmail($email): ?User
    {
        foreach ($this->users as $user) {
            if ($user->email() === $email) {
                return $user;
            }
        }

        return;
    }

    public function add(User $user)
    {
        $this->users[$user->id()->userId()] = $user;
    }

    public function nextIdentity(): UserId
    {
        return new UserId();
    }
}