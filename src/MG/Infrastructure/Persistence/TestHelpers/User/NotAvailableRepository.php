<?php

namespace MG\Infrastructure\Persistence\TestHelpers\User;


use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Domain\Model\User\UserRepository;
use MG\Domain\Model\User\UserRepositoryNotAvailableException;

class NotAvailableRepository implements UserRepository
{
    public function ofId(UserId $userId): ?User
    {
        throw new UserRepositoryNotAvailableException();
    }

    public function ofEmail($email): ?User
    {
        throw new UserRepositoryNotAvailableException();
    }

    public function add(User $user)
    {
        throw new UserRepositoryNotAvailableException();
    }

    public function nextIdentity(): UserId
    {
        return new UserId();
    }
}
