<?php

namespace MG\Infrastructure\Domain\Model\User;

use MG\Infrastructure\Domain\Model\DoctrineEntityId;

class DoctrineUserId extends DoctrineEntityId
{
    public function getName(): string
    {
        return 'UserId';
    }

    public function getNamespace(): string
    {
        return 'MG\Domain\Model\User';
    }
}