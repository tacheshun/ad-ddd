<?php

namespace MG\Infrastructure\Domain\Model\User;


use MG\Domain\Model\User\User;
use MG\Domain\Model\User\UserId;
use MG\Infrastructure\Domain\Model\DoctrineEntityId;

class DoctrineUserId extends DoctrineEntityId
{
    public function getName(): string
    {
        return UserId::class;
    }

    protected function getNamespace(): string
    {
        return User::class;
    }
}