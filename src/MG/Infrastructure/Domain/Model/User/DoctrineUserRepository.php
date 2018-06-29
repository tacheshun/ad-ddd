<?php

namespace MG\Infrastructure\Domain\Model\User;

use Doctrine\ORM\EntityRepository;
use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Domain\Model\User\UserRepository;

class DoctrineUserRepository extends EntityRepository implements UserRepository
{
    public function ofId(UserId $userId): ?User
    {
        return $this->find($userId);
    }

    public function ofEmail($email): ?User
    {
        return $this->findOneBy(['email' => $email]);
    }

    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
    }

    public function nextIdentity(): UserId
    {
        return new UserId();
    }
}