<?php

namespace MG\Infrastructure\Domain\Model\User;

use MG\Infrastructure\Domain\Model\DoctrineEntityId;

class DoctrineUserId extends DoctrineEntityId
{
    private const USER_ID                 = 'UserId';
    private const DOMAIN_MODEL_USER_CLASS = 'MG\Domain\Model\User';

    public function getName(): string
    {
        return self::USER_ID;
    }

    public function getNamespace(): string
    {
        return self::DOMAIN_MODEL_USER_CLASS;
    }
}