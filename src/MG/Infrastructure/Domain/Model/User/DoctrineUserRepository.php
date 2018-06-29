<?php

namespace MG\Infrastructure\Domain\Model\User;

use Doctrine\ORM\EntityRepository;
use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Domain\Model\User\UserRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{

    public function ofId(UserId $userId): User
    {
        // TODO: Implement ofId() method.
    }

    public function ofEmail($email): User
    {
        // TODO: Implement ofEmail() method.
    }

    public function add(User $user)
    {
        // TODO: Implement add() method.
    }

    public function nextIdentity(): UserId
    {
        // TODO: Implement nextIdentity() method.
    }
}