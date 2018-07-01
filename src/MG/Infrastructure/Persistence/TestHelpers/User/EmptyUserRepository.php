<?php

namespace MG\Infrastructure\Persistence\TestHelpers\User;


use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Domain\Model\User\UserRepository;

class EmptyUserRepository implements UserRepository
{

    public function ofId(UserId $userId): ?User
    {
        return;
    }

    public function ofEmail($email): ?User
    {
        return;
    }

    public function add(User $user)
    {
        return;
    }

    public function nextIdentity(): UserId
    {
        return new UserId();
    }
}